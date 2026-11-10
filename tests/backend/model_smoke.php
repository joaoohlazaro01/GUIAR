<?php

declare(strict_types=1);

define('BASE_URL', 'http://127.0.0.1:8080');

require_once __DIR__ . '/../../mvc/Models/Empresa.php';
require_once __DIR__ . '/../../mvc/Models/Administrador.php';
require_once __DIR__ . '/../../mvc/Models/Pedido.php';

use mvc\Models\Administrador;
use mvc\Models\Empresa;
use mvc\Models\Pedido;

function check(bool $condition, string $message): void
{
    if (!$condition) {
        fwrite(STDERR, "Falha: {$message}\n");
        exit(1);
    }
}

$pdo = new PDO('sqlite::memory:');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec(<<<'SQL'
CREATE TABLE empresa (
    id_empresa INTEGER PRIMARY KEY AUTOINCREMENT,
    nome_empresa TEXT NOT NULL,
    CNPJ TEXT NOT NULL,
    nome_usuario TEXT NOT NULL,
    email TEXT NOT NULL,
    senha TEXT NOT NULL,
    nome_arquivo TEXT
);
CREATE TABLE administrador (
    id_adm INTEGER PRIMARY KEY AUTOINCREMENT,
    nome_adm TEXT NOT NULL,
    nome_usuario TEXT NOT NULL,
    nome_foto TEXT,
    senha TEXT NOT NULL,
    FK_EMPRESA_id_empresa INTEGER NOT NULL
);
CREATE TABLE pedido (
    id_pedido INTEGER PRIMARY KEY AUTOINCREMENT,
    nome_cliente TEXT NOT NULL,
    preco REAL NOT NULL,
    endereco TEXT NOT NULL,
    bairro TEXT NOT NULL,
    descricao TEXT,
    id_empresa INTEGER NOT NULL,
    id_adm INTEGER NOT NULL,
    latitude REAL,
    longitude REAL,
    status TEXT NOT NULL
);
SQL);

$empresa = new Empresa($pdo);
check($empresa->create([
    'nome_empresa' => 'Empresa CI',
    'cnpj' => '00.000.000/0001-00',
    'nome_usuario' => 'empresa_ci',
    'email' => 'empresa-ci@example.com',
    'senha' => 'senha-teste',
    'nome_arquivo' => 'logo.png',
]), 'Empresa::create não inseriu o registro.');

$empresaRecord = $empresa->getById(1);
check($empresaRecord['nome_usuario'] === 'empresa_ci', 'Empresa::getById não retornou o registro.');

$administrador = new Administrador($pdo);
check($administrador->create([
    'nome_adm' => 'Administrador CI',
    'nome_usuario' => 'admin_ci',
    'nome_foto' => 'foto.png',
    'senha' => 'senha-teste',
    'company_id' => 1,
]), 'Administrador::create não inseriu o registro.');
check(count($administrador->getByEmpresaId(1)) === 1, 'Administrador::getByEmpresaId não retornou o registro.');

$pedido = new Pedido($pdo);
check($pedido->create([
    'nome_cliente' => 'Cliente CI',
    'preco' => 25.50,
    'endereco' => 'Rua de teste, 1',
    'bairro' => 'Centro',
    'descricao' => 'Pedido de teste',
    'id_empresa' => 1,
    'id_adm' => 1,
    'latitude' => -22.591,
    'longitude' => -46.523,
]), 'Pedido::create não inseriu o registro.');
check($pedido->getById(1)['nome_cliente'] === 'Cliente CI', 'Pedido::getById não retornou o registro.');

fwrite(STDOUT, "Smoke tests dos Models concluídos.\n");
