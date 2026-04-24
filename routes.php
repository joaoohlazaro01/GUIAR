<?php
session_start();

// Autoloader simples para as classes MVC
spl_autoload_register(function ($class_name) {
    // A classe virá como "mvc\Controllers\EmpresaController"
    // O prefixo do namespace
    $prefix = 'mvc\\';
    
    // O diretório base para o prefixo do namespace
    $base_dir = __DIR__ . '/mvc/';
    
    // Verifica se a classe usa o prefixo do namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class_name, $len) !== 0) {
        // Não, move para o próximo autoloader registrado
        return;
    }
    
    // Pega o nome da classe relativa
    $relative_class = substr($class_name, $len);
    
    // Substitui o separador de namespace pelo separador de diretório na classe relativa
    // e anexa com .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // Se o arquivo existir, require ele
    if (file_exists($file)) {
        require_once $file;
    }
});

// Inclui a configuração do banco de dados (que define $pdo)
require_once __DIR__ . '/config.php';

// Necessário para PHPMailer (que ainda está no vendor)
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'loginEmpresa':
        $controller = new \mvc\Controllers\EmpresaController($pdo);
        $controller->login();
        break;

    case 'cadastroEmpresa':
        $controller = new \mvc\Controllers\EmpresaController($pdo);
        $controller->cadastro();
        break;

    case 'escolherAdm':
        $controller = new \mvc\Controllers\AdministradorController($pdo);
        $controller->escolher();
        break;

    case 'adicionarAdm':
        $controller = new \mvc\Controllers\AdministradorController($pdo);
        $controller->adicionar();
        break;

    case 'loginAdm':
        $controller = new \mvc\Controllers\AdministradorController($pdo);
        $controller->login();
        break;

    case 'logoutAdm':
        $controller = new \mvc\Controllers\AdministradorController($pdo);
        $controller->logout();
        break;

    case 'dashboardAdm':
        $controller = new \mvc\Controllers\AdministradorController($pdo);
        $controller->dashboard();
        break;

    default:
        // Por padrão, se a rota não for encontrada, redireciona para a home
        header("Location: /GUIAR_desfunc/index.html");
        exit;
}
