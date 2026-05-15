<?php
// Define BASE_URL dinamicamente para tornar o projeto portátil
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";
$sys_host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$dir = str_replace('\\', '/', __DIR__);
$docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? '');
$baseDir = str_replace($docRoot, '', $dir);
define('BASE_URL', rtrim($protocol . $sys_host . $baseDir, '/'));

$host = 'localhost';
$dbname = 'guiartcc';
$username = 'root';
$password = '';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}
catch(PDOException $e){
    echo 'Erro na conexão: '.$e->getMessage();
}

?>