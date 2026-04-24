<?php
namespace mvc\Controllers;

use mvc\Models\Administrador;
use mvc\Models\Empresa;

class AdministradorController {
    private $administradorModel;
    private $empresaModel;

    public function __construct($pdo) {
        $this->administradorModel = new Administrador($pdo);
        $this->empresaModel = new Empresa($pdo);
    }

    public function escolher() {
        if (!isset($_SESSION['company_id'])) {
            header("Location: /GUIAR_desfunc/routes.php?action=loginEmpresa");
            exit;
        }

        $company_id = $_SESSION['company_id'];
        $empresa = $this->empresaModel->getById($company_id);
        
        if (!$empresa) {
            header("Location: /GUIAR_desfunc/routes.php?action=loginEmpresa");
            exit;
        }

        $nome_empresa = $empresa['nome_empresa'];
        $administradores = $this->administradorModel->getByEmpresaId($company_id);

        $erro = $_GET['erro'] ?? null;

        require_once __DIR__ . '/../Views/Administrador/escolher.php';
    }

    public function adicionar() {
        if (!isset($_SESSION['company_id'])) {
            header("Location: /GUIAR_desfunc/routes.php?action=loginEmpresa");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $company_id = $_SESSION['company_id'];
            $empresa = $this->empresaModel->getById($company_id);
            
            if (!$empresa) {
                header("Location: /GUIAR_desfunc/routes.php?action=loginEmpresa");
                exit;
            }

            $nome_empresa = $empresa['nome_empresa'];
            $nome_adm = $_POST['adminNome'] ?? '';
            $nome_usuario = $_POST['adminUsername'] ?? '';
            $senha = $_POST['adminPassword'] ?? '';
            
            // Diretório legado original: 'admin_fotos/' . $nome_empresa . '/'
            // Para manter compatibilidade com a view antiga (até que as views sejam totalmente atualizadas para public/uploads)
            // vamos usar public/uploads/admins/$nome_empresa/
            $diretorioDestino = __DIR__ . '/../../public/uploads/admins/' . $nome_empresa . '/';

            // Também vamos manter na pasta antiga por segurança caso algo de fora dependa dela, mas o ideal é concentrar em public.
            // Para refatoração limpa, vamos salvar no diretório raiz do projeto "admin_fotos/..." ou public/uploads
            // Vamos adotar "public/uploads/admins/..." para centralização.
            
            // Replicando o comportamento antigo que salva na raiz do site em admin_fotos/
            $diretorioDestinoLegado = __DIR__ . '/../../PHP ADM/admin_fotos/' . $nome_empresa . '/';
            
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
                    header("Location: /GUIAR_desfunc/routes.php?action=escolherAdm");
                    exit();
                } else {
                    $erro = "Erro ao adicionar administrador no banco de dados.";
                    header("Location: /GUIAR_desfunc/routes.php?action=escolherAdm&erro=" . urlencode($erro));
                    exit();
                }
            } else {
                $erro = "Erro ao fazer upload da foto.";
                header("Location: /GUIAR_desfunc/routes.php?action=escolherAdm&erro=" . urlencode($erro));
                exit();
            }
        }
    }

    public function login() {
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

    public function logout() {
        // Apenas remove a sessão do administrador
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['id_adm']);
        
        header("Location: /GUIAR_desfunc/routes.php?action=escolherAdm");
        exit();
    }

    public function dashboard() {
        if (!isset($_SESSION['company_id'])) {
            header("Location: /GUIAR_desfunc/routes.php?action=loginEmpresa");
            exit;
        }

        if (!isset($_SESSION['nome_usuario'])) {
            header("Location: /GUIAR_desfunc/routes.php?action=escolherAdm&erro=" . urlencode("Administrador não identificado"));
            exit;
        }

        $nomeAdmin = $_SESSION['nome_usuario'];
        
        require_once __DIR__ . '/../Views/Administrador/dashboard.php';
    }
}
