<?php
session_start();

spl_autoload_register(function ($class_name) {
    $prefix = 'mvc\\';

    $base_dir = __DIR__ . '/mvc/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class_name, $len) !== 0) {
        return;
    }
    $relative_class_name = substr($class_name, $len);
    $relative_class = substr($class_name, $len);
    
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once __DIR__ . '/config.php';

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
    case 'esqueceuSenha':
        $controller = new \mvc\Controllers\EmpresaController($pdo);
        $controller->esqueceuSenha();
        break;
    case 'redefinirSenha':
        $controller = new \mvc\Controllers\EmpresaController($pdo);
        $controller->redefinirSenha();
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

    case 'pedidos':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->index();
        break;

    case 'pedidosEntregues':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->entregues();
        break;

    case 'adicionarPedido':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->adicionar();
        break;

    case 'editarPedido':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->editar();
        break;

    case 'excluirPedido':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->excluir();
        break;

    case 'enviarPedidos':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->enviar();
        break;

    case 'finalizarTurno':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->finalizarTurno();
        break;

    case 'concluirEntrega':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->concluirEntrega();
        break;

    default:
        // Por padrão, se a rota não for encontrada, redireciona para a home
        header("Location: /GUIAR_desfunc/index.html");
        exit;
}
