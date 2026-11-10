<?php

namespace mvc\Controllers;

use mvc\Models\Administrador;
use mvc\Models\Empresa;

class AdministradorController
{
    private $administradorModel;
    private $empresaModel;
    private $entregadorModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->administradorModel = new Administrador($pdo);
        $this->empresaModel = new Empresa($pdo);
        $this->entregadorModel = new \mvc\Models\Entregador($pdo);
    }

    public function escolher()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        $company_id = $_SESSION['company_id'];
        $empresa = $this->empresaModel->getById($company_id);

        if (!$empresa) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        $nome_empresa = $empresa['nome_empresa'];
        $administradores = $this->administradorModel->getByEmpresaId($company_id);

        $erro = $_GET['erro'] ?? null;

        require_once __DIR__ . '/../Views/Administrador/escolher.php';
    }

    public function adicionar()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $company_id = $_SESSION['company_id'];
            $empresa = $this->empresaModel->getById($company_id);

            if (!$empresa) {
                header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
                exit;
            }

            $nome_empresa = $empresa['nome_empresa'];
            $nome_adm = $_POST['adminNome'] ?? '';
            $nome_usuario = $_POST['adminUsername'] ?? '';
            $senha = $_POST['adminPassword'] ?? '';

            // Diretório legado original: 'admin_fotos/' . $nome_empresa . '/'
            // Para manter compatibilidade com a view antiga (até que as views sejam totalmente atualizadas para public/uploads)
            // vamos usar public/uploads/empresas/$nome_empresa/
            $diretorioDestino = __DIR__ . '/../../public/uploads/empresas/' . $nome_empresa . '/';

            // Também vamos manter na pasta antiga por segurança caso algo de fora dependa dela, mas o ideal é concentrar em public.
            // Para refatoração limpa, vamos salvar no diretório raiz do projeto "admin_fotos/..." ou public/uploads
            // Vamos adotar "public/uploads/empresas/..." para centralização.

            // Replicando o comportamento antigo que salva na raiz do site em admin_fotos/
            $diretorioDestinoLegado = __DIR__ . '/../../public/uploads/empresas/' . $nome_empresa . '/';

            if (!is_dir($diretorioDestinoLegado)) {
                mkdir($diretorioDestinoLegado, 0777, true);
            }

            $fotoNomeUnico = '';
            if (isset($_FILES['adminFoto']) && $_FILES['adminFoto']['error'] == 0) {
                $fotoNome = basename($_FILES['adminFoto']['name']);
                $extensaoArquivo = pathinfo($fotoNome, PATHINFO_EXTENSION);
                $fotoNomeUnico = uniqid() . '.' . $extensaoArquivo;

                $fotoDestino = $diretorioDestinoLegado . $fotoNomeUnico;

                if (!move_uploaded_file($_FILES['adminFoto']['tmp_name'], $fotoDestino)) {
                    $fotoNomeUnico = ''; // Falha ao mover
                }
            }

            if ($fotoNomeUnico) {
                $data = [
                    'nome_adm' => $nome_adm,
                    'nome_usuario' => $nome_usuario,
                    'nome_foto' => $fotoNomeUnico,
                    'senha' => $senha,
                    'company_id' => $company_id
                ];

                if ($this->administradorModel->create($data)) {
                    header("Location: " . BASE_URL . "/routes.php?action=escolherAdm");
                    exit();
                } else {
                    $erro = "Erro ao adicionar administrador no banco de dados.";
                    header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode($erro));
                    exit();
                }
            } else {
                $erro = "Erro ao fazer upload da foto.";
                header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode($erro));
                exit();
            }
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminUsername = $_POST['adminUsername'] ?? '';
            $adminPassword = $_POST['adminPassword'] ?? '';

            $admin = $this->administradorModel->login($adminUsername, $adminPassword);

            if ($admin) {
                $_SESSION['id_adm'] = $admin['id_adm'];
                $_SESSION['nome_usuario'] = $admin['nome_usuario'];
                echo "success";
            } else {
                echo "error";
            }
            exit; // Importante para as chamadas AJAX
        }
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['id_adm'], $_SESSION['nome_usuario']);

        header("Location: " . BASE_URL . "/routes.php?action=escolherAdm");
        exit();
    }

    public function dashboard()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        if (!isset($_SESSION['nome_usuario'])) {
            header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode("Administrador não identificado"));
            exit;
        }

        $nomeAdmin  = $_SESSION['nome_usuario'];
        $company_id = $_SESSION['company_id'];
        $adminFotoUrl = $this->administradorModel->getPhotoUrlForCompany($_SESSION['id_adm'] ?? 0, $company_id);
        $logoEmpresaSidebar = $this->empresaModel->getLogoUrlById($company_id);

        // Modelos
        $pedidoModel = new \mvc\Models\Pedido($this->pdo);

        // Estatísticas (total, entregues, em andamento, pendentes)
        $stats              = $pedidoModel->getDashboardStats($company_id);
        $totalPedidos       = (int)($stats['total']        ?? 0);
        $pedidosEntregues   = (int)($stats['entregues']    ?? 0);
        $pedidosEmAndamento = (int)($stats['em_andamento'] ?? 0);
        $pedidosPendentes   = (int)($stats['pendentes']    ?? 0);

        // Pedidos recentes (últimos 8)
        $pedidosRecentes = $pedidoModel->getRecent($company_id, 8);

        // Entregadores com contagem de entregas (top 5)
        $entregadoresComContagem = $this->entregadorModel->getAllByEmpresaComContagem($company_id, 5);
        $totalEntregadores       = count($this->entregadorModel->getAllByEmpresa($company_id));

        require_once __DIR__ . '/../Views/Administrador/dashboard.php';
    }

    public function mapa()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        if (!isset($_SESSION['nome_usuario'])) {
            header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode("Administrador não identificado"));
            exit;
        }

        $nomeAdmin = $_SESSION['nome_usuario'];
        $adminFotoUrl = $this->administradorModel->getPhotoUrlForCompany($_SESSION['id_adm'] ?? 0, $_SESSION['company_id']);
        $logoEmpresaSidebar = $this->empresaModel->getLogoUrlById($_SESSION['company_id']);

        require_once __DIR__ . '/../Views/Administrador/mapa.php';
    }

    public function apiAcompanharEntregadores()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['company_id'])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Não autenticado']);
            exit;
        }

        $company_id = $_SESSION['company_id'];

        $entregadores = $this->entregadorModel->getAllByEmpresa($company_id);
        $pedidoModel = new \mvc\Models\Pedido($this->pdo);

        $dados = [];
        foreach ($entregadores as $e) {
            $pedidos = $pedidoModel->getAllByEntregador($e['id_entregador']);
            $dados[] = [
                'id_entregador' => $e['id_entregador'],
                'nome_completo' => $e['nome_completo'],
                'latitude' => $e['latitude'],
                'longitude' => $e['longitude'],
                'pedidos' => $pedidos
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($dados);
        exit;
    }

    private function simuladorAdminAutenticado()
    {
        return isset($_SESSION['company_id'], $_SESSION['id_adm'], $_SESSION['nome_usuario']);
    }

    public function simuladorGPS()
    {
        if (!$this->simuladorAdminAutenticado()) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }
        if (empty($_SESSION['gps_simulator_csrf'])) {
            $_SESSION['gps_simulator_csrf'] = bin2hex(random_bytes(32));
        }
        $entregadores = $this->entregadorModel->getAllByEmpresa((int)$_SESSION['company_id']);
        $csrfToken = $_SESSION['gps_simulator_csrf'];
        require __DIR__ . '/../Views/Administrador/simuladorGPS.php';
    }

    public function apiSimuladorGPS()
    {
        header('Content-Type: application/json; charset=utf-8');
        if (!$this->simuladorAdminAutenticado()) {
            http_response_code(401);
            echo json_encode(['success' => false, 'error' => 'Sessão administrativa necessária.']);
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Método não permitido.']);
            exit;
        }
        $input = json_decode(file_get_contents('php://input'), true);
        if (!is_array($input) || empty($_SESSION['gps_simulator_csrf']) ||
            !hash_equals($_SESSION['gps_simulator_csrf'], (string)($input['csrf'] ?? ''))) {
            http_response_code(403);
            echo json_encode(['success' => false, 'error' => 'Token CSRF inválido.']);
            exit;
        }
        $id = filter_var($input['id_entregador'] ?? null, FILTER_VALIDATE_INT);
        $action = $input['operation'] ?? '';
        if (!$id || !in_array($action, ['destinations', 'start', 'update', 'restore'], true)) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Operação ou entregador inválido.']);
            exit;
        }
        $company = (int)$_SESSION['company_id'];
        $q = $this->pdo->prepare('SELECT id_entregador, nome_completo, latitude, longitude FROM entregador WHERE id_entregador = :id AND FK_EMPRESA_id_empresa = :company');
        $q->execute(['id' => $id, 'company' => $company]);
        $driver = $q->fetch(\PDO::FETCH_ASSOC);
        if (!$driver) {
            http_response_code(404);
            echo json_encode(['success' => false, 'error' => 'Entregador não pertence à empresa autenticada.']);
            exit;
        }
        if ($action === 'destinations') {
            $dest = $this->pdo->prepare("SELECT p.id_pedido, p.nome_cliente, p.endereco, p.latitude, p.longitude FROM pedido p WHERE p.id_entregador = :id AND p.id_empresa = :company AND LOWER(p.status) <> 'entregue' AND p.latitude IS NOT NULL AND p.longitude IS NOT NULL ORDER BY p.id_pedido");
            $dest->execute(['id' => $id, 'company' => $company]);
            $points = [];
            foreach ($dest->fetchAll(\PDO::FETCH_ASSOC) as $point) {
                $lat = filter_var($point['latitude'], FILTER_VALIDATE_FLOAT);
                $lng = filter_var($point['longitude'], FILTER_VALIDATE_FLOAT);
                if ($lat !== false && $lng !== false && $lat >= -90 && $lat <= 90 && $lng >= -180 && $lng <= 180) {
                    $points[] = ['latitude' => (float)$lat, 'longitude' => (float)$lng, 'label' => 'Pedido #' . $point['id_pedido'] . ' — ' . $point['nome_cliente'] . ' (' . $point['endereco'] . ')'];
                }
            }
            echo json_encode(['success' => true, 'driver' => $driver['nome_completo'], 'current' => ['latitude' => $driver['latitude'] === null ? null : (float)$driver['latitude'], 'longitude' => $driver['longitude'] === null ? null : (float)$driver['longitude']], 'points' => $points]);
            exit;
        }
        $key = $company . ':' . $id;
        if ($action === 'start') {
            if (!isset($_SESSION['gps_simulator_original'][$key])) {
                $_SESSION['gps_simulator_original'][$key] = ['latitude' => $driver['latitude'], 'longitude' => $driver['longitude']];
            }
        } elseif ($action === 'restore') {
            if (!isset($_SESSION['gps_simulator_original'][$key])) {
                http_response_code(409);
                echo json_encode(['success' => false, 'error' => 'Nenhuma posição original salva nesta sessão.']);
                exit;
            }
            $original = $_SESSION['gps_simulator_original'][$key];
            $u = $this->pdo->prepare('UPDATE entregador SET latitude = :lat, longitude = :lng WHERE id_entregador = :id AND FK_EMPRESA_id_empresa = :company');
            $u->execute(['lat' => $original['latitude'], 'lng' => $original['longitude'], 'id' => $id, 'company' => $company]);
            unset($_SESSION['gps_simulator_original'][$key]);
            echo json_encode(['success' => true, 'latitude' => $original['latitude'], 'longitude' => $original['longitude']]);
            exit;
        } else {
            $lat = filter_var($input['latitude'] ?? null, FILTER_VALIDATE_FLOAT);
            $lng = filter_var($input['longitude'] ?? null, FILTER_VALIDATE_FLOAT);
            if ($lat === false || $lng === false || $lat < -90 || $lat > 90 || $lng < -180 || $lng > 180) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Latitude ou longitude fora dos limites válidos.']);
                exit;
            }
            $u = $this->pdo->prepare('UPDATE entregador SET latitude = :lat, longitude = :lng WHERE id_entregador = :id AND FK_EMPRESA_id_empresa = :company');
            $u->execute(['lat' => $lat, 'lng' => $lng, 'id' => $id, 'company' => $company]);
        }
        echo json_encode(['success' => true, 'latitude' => $action === 'update' ? $lat : $driver['latitude'], 'longitude' => $action === 'update' ? $lng : $driver['longitude'], 'nome' => $driver['nome_completo']]);
        exit;
    }

    public function perfil()
    {
        if (!isset($_SESSION['company_id'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        if (!isset($_SESSION['nome_usuario']) || !isset($_SESSION['id_adm'])) {
            header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode("Administrador não identificado"));
            exit;
        }

        $company_id = $_SESSION['company_id'];
        $empresa = $this->empresaModel->getById($company_id);
        if (!$empresa) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        $nome_empresa = $empresa['nome_empresa'];
        $admin = $this->administradorModel->getById($_SESSION['id_adm']);

        if (!$admin) {
            header("Location: " . BASE_URL . "/routes.php?action=escolherAdm&erro=" . urlencode("Administrador não encontrado"));
            exit;
        }

        $adminFotoUrl = $this->administradorModel->getPhotoUrlForCompany($_SESSION['id_adm'], $company_id);
        $logoEmpresaSidebar = $this->empresaModel->getLogoUrlById($company_id);
        $erro = $_GET['erro'] ?? null;
        $sucesso = $_GET['sucesso'] ?? null;

        require_once __DIR__ . '/../Views/Administrador/meuPerfil.php';
    }

    public function editarPerfil()
    {
        if (!isset($_SESSION['company_id']) || !isset($_SESSION['id_adm'])) {
            header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $company_id = $_SESSION['company_id'];
            $empresa = $this->empresaModel->getById($company_id);

            if (!$empresa) {
                header("Location: " . BASE_URL . "/routes.php?action=loginEmpresa");
                exit;
            }

            $nome_empresa = $empresa['nome_empresa'];
            $id_adm = $_SESSION['id_adm'];

            // Fetch current admin to preserve existing photo or password if not changed
            $currentAdmin = $this->administradorModel->getById($id_adm);

            $nome_adm = $_POST['nome_adm'] ?? '';
            $nome_usuario = $_POST['nome_usuario'] ?? '';
            $senha = $_POST['senha'] ?? '';
            if (empty($senha)) {
                $senha = $currentAdmin['senha'];
            }

            $diretorioDestino = __DIR__ . '/../../public/uploads/empresas/' . $nome_empresa . '/';
            if (!is_dir($diretorioDestino)) {
                mkdir($diretorioDestino, 0777, true);
            }

            $fotoNomeUnico = '';
            if (isset($_FILES['adminFoto']) && $_FILES['adminFoto']['error'] == 0) {
                $fotoNome = basename($_FILES['adminFoto']['name']);
                $extensaoArquivo = pathinfo($fotoNome, PATHINFO_EXTENSION);
                $fotoNomeUnico = uniqid() . '.' . $extensaoArquivo;
                $fotoDestino = $diretorioDestino . $fotoNomeUnico;

                if (!move_uploaded_file($_FILES['adminFoto']['tmp_name'], $fotoDestino)) {
                    $fotoNomeUnico = ''; // Upload failure
                }
            }

            $data = [
                'nome_adm' => $nome_adm,
                'nome_usuario' => $nome_usuario,
                'senha' => $senha,
                'nome_foto' => $fotoNomeUnico ?: $currentAdmin['nome_foto']
            ];

            if ($this->administradorModel->update($id_adm, $data)) {
                // Update session username since it might have changed
                $_SESSION['nome_usuario'] = $nome_usuario;
                header("Location: " . BASE_URL . "/routes.php?action=perfilAdm&sucesso=" . urlencode("Perfil atualizado com sucesso!"));
            } else {
                header("Location: " . BASE_URL . "/routes.php?action=perfilAdm&erro=" . urlencode("Erro ao atualizar o perfil."));
            }
            exit();
        }
    }
}
