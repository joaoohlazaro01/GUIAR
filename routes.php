<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


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
    case 'index':
        header("Location: " . BASE_URL . "/index.html");
        break;
    case 'loginEmpresa':
        $controller = new \mvc\Controllers\EmpresaController($pdo);
        $controller->login();
        break;

    case 'logoutEmpresa':
        $controller = new \mvc\Controllers\EmpresaController($pdo);
        $controller->logout();
        break;

    case 'cadastroEmpresa':
        $controller = new \mvc\Controllers\EmpresaController($pdo);
        $controller->cadastro();
        break;
    case 'esqueceuSenha':
        $controller = new \mvc\Controllers\EmpresaController($pdo);
        $controller->esqueceuSenha();
        break;
    case 'verificarCodigo':
        $controller = new \mvc\Controllers\EmpresaController($pdo);
        $controller->verificarCodigo();
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

    case 'sair':
    case 'logoutAdm':
        $controller = new \mvc\Controllers\AdministradorController($pdo);
        $controller->logout();
        break;

    case 'dashboardAdm':
        $controller = new \mvc\Controllers\AdministradorController($pdo);
        $controller->dashboard();
        break;

    case 'mapaAdm':
        $controller = new \mvc\Controllers\AdministradorController($pdo);
        $controller->mapa();
        break;

    case 'apiAcompanharEntregadores':
        $controller = new \mvc\Controllers\AdministradorController($pdo);
        $controller->apiAcompanharEntregadores();
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

    // --- Rotas de Entregador ---
    case 'loginEntregador':
        $controller = new \mvc\Controllers\EntregadorController($pdo);
        $controller->login();
        break;

    case 'logoutEntregador':
        $controller = new \mvc\Controllers\EntregadorController($pdo);
        $controller->logout();
        break;

    case 'meusPedidosEntregador':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->meusPedidos();
        break;

    case 'entregadores':
        $controller = new \mvc\Controllers\EntregadorController($pdo);
        $controller->index();
        break;

    case 'cadastrarEntregador':
        $controller = new \mvc\Controllers\EntregadorController($pdo);
        $controller->cadastrar();
        break;

    case 'editarEntregador':
        $controller = new \mvc\Controllers\EntregadorController($pdo);
        $controller->editar();
        break;

    case 'excluirEntregador':
        $controller = new \mvc\Controllers\EntregadorController($pdo);
        $controller->excluir();
        break;

    case 'mapaEntregador':
        $controller = new \mvc\Controllers\EntregadorController($pdo);
        $controller->mapa();
        break;

    case 'apiLocalizacaoEntregador':
        $controller = new \mvc\Controllers\EntregadorController($pdo);
        $controller->atualizarLocalizacao();
        break;

    case 'apiPedidosMapa':
        $controller = new \mvc\Controllers\PedidoController($pdo);
        $controller->getPedidosMapa();
        break;

    default:
        // Por padrão, se a rota não for encontrada, redireciona para a home
        header("Location: " . BASE_URL . "/index.html");
        exit;
}
