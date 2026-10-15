<?php

use PHPMailer\PHPMailer\PHPMailer;
use mvc\Services\EmailService;

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
session_start();

function contactResponse(int $status, array $data): void
{
    http_response_code($status);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'] ?? '';
if (!isset($_SESSION['contact_csrf'])) {
    $_SESSION['contact_csrf'] = bin2hex(random_bytes(32));
}
if ($method === 'GET') {
    contactResponse(200, ['csrf_token' => $_SESSION['contact_csrf']]);
}
if ($method !== 'POST') {
    header('Allow: GET, POST');
    contactResponse(405, ['success' => false, 'message' => 'Método não permitido.']);
}

$token = $_POST['csrf_token'] ?? '';
if (!is_string($token) || !hash_equals($_SESSION['contact_csrf'], $token)) {
    contactResponse(403, ['success' => false, 'message' => 'Sua sessão expirou. Tente enviar novamente.']);
}

$fields = [];
foreach (['nome' => 100, 'email' => 254, 'mensagem' => 5000] as $key => $limit) {
    $value = $_POST[$key] ?? '';
    if (!is_string($value) || !mb_check_encoding($value, 'UTF-8')) {
        contactResponse(422, ['success' => false, 'message' => 'Verifique os campos do formulário.']);
    }
    $value = trim($value);
    if ($value === '' || mb_strlen($value, 'UTF-8') > $limit) {
        contactResponse(422, ['success' => false, 'message' => 'Preencha todos os campos e respeite o limite de caracteres.']);
    }
    $fields[$key] = $value;
}
if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL) || preg_match('/[\r\n\x00]/', $fields['nome'] . $fields['email'])) {
    contactResponse(422, ['success' => false, 'message' => 'Informe um nome e um e-mail válidos.']);
}
if (time() - ($_SESSION['contact_last_attempt'] ?? 0) < 30) {
    header('Retry-After: 30');
    contactResponse(429, ['success' => false, 'message' => 'Aguarde 30 segundos antes de enviar outra mensagem.']);
}

$_SESSION['contact_last_attempt'] = time();
session_write_close();

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/mvc/Services/EmailService.php';
try {
    $mail = new PHPMailer(true);
    EmailService::configure($mail);
    $mail->Timeout = 15;
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($mail->Username, 'GUIAR');
    $mail->addAddress('projGuiar@gmail.com', 'Equipe GUIAR');
    $mail->addReplyTo($fields['email'], $fields['nome']);
    $mail->Subject = 'GUIAR - Nova mensagem de contato';
    $mail->isHTML(false);
    $mail->Body = "Nome: {$fields['nome']}\nE-mail: {$fields['email']}\n\nMensagem:\n{$fields['mensagem']}";
    $mail->send();
    contactResponse(200, ['success' => true, 'message' => 'Mensagem enviada! Nossa equipe responderá pelo e-mail informado.']);
} catch (Throwable $error) {
    error_log('GUIAR: falha no envio do formulário de contato.');
    contactResponse(502, ['success' => false, 'message' => 'Não foi possível enviar agora. Tente novamente mais tarde.']);
}
