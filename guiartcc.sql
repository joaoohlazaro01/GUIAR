-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/05/2026 às 02:56
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `guiartcc`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `administrador`
--

CREATE TABLE `administrador` (
  `id_adm` int(11) NOT NULL,
  `nome_adm` varchar(100) DEFAULT NULL,
  `nome_usuario` varchar(100) DEFAULT NULL,
  `nome_foto` varchar(200) NOT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `FK_EMPRESA_id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `administrador`
--

INSERT INTO `administrador` (`id_adm`, `nome_adm`, `nome_usuario`, `nome_foto`, `senha`, `FK_EMPRESA_id_empresa`) VALUES
(20, 'Vinicius Mira', 'Vini', '6706fd02bd6bd.jpg', '1234', 9),
(21, 'Lorena Santos', 'Loris29', '670700ff75165.jpg', '123', 9),
(22, 'Chay Castro', 'ChayBigBoca', '6736cd896d788.jpg', '123', 9),
(23, 'Chay da Cunha', 'ChayLD', '673abc45a7e77.jpg', '123456', 10),
(24, 'Cleiton Braga', 'Cleiton', '69eab80e11e93.png', '123', 13),
(25, 'Amstel', 'Amstel', '69f2392b9bf3a.png', '123', 13),
(26, 'Brahma', 'usuBrahama', '69f2a64503cf9.png', '123', 17),
(27, 'João lázaro', 'lala', '69f3eb38385e1.png', '123', 18),
(28, 'Cleiton Braga', 'Cleiton', '6a07aae5ad374.png', '123', 20),
(29, 'João Lázaro Tavares Vieira', 'joaoLazaro', '6a0b9074e1245.png', '123', 20),
(30, 'Mario', 'Mario', '6a0bb1698464e.png', '123', 20),
(31, 'Graziela Stefany', 'GraziS', '6a0ce1fb0edec.webp', '123', 21),
(32, 'Samara', 'SamaraD', '6a0cec9e07817.png', '123', 21),
(33, 'teste', 'teste', '6a0fa8ae844f6.jpeg', '123', 22);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mensagem` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contato`
--

INSERT INTO `contato` (`id`, `nome`, `email`, `mensagem`) VALUES
(1, 'teste', 'testemp@gmail.com', 'fadsfasdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresa`
--

CREATE TABLE `empresa` (
  `id_empresa` int(11) NOT NULL,
  `CNPJ` varchar(100) DEFAULT NULL,
  `nome_empresa` varchar(100) DEFAULT NULL,
  `nome_usuario` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `nome_arquivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `CNPJ`, `nome_empresa`, `nome_usuario`, `email`, `senha`, `nome_arquivo`) VALUES
(9, '23.232.323/2323-33', 'Big Boca', 'bigboca01', 'bigb@gmail.com', '123', 'Isabely Faria_1.png'),
(10, '54.546.575/6455-65', 'DoceriaLD', 'DocesLD', 'lorena.aa295@gmail.com', '123', 'docess.png'),
(13, '33.333.333/3333-33', 'empresa03', 'emp03', 'pedroh.nunesbueno@gmail.com', 'jaime123', '1.png'),
(17, '55.555.555/5555-55', 'emp05', 'usu05', 'pedroh.nunesbueno@gmail.com', '123', '1.png'),
(18, '55.555.555/5555-55', 'Big Bom', 'joana', 'joo007br@gmail.com', '123', '1.png'),
(19, '13.265.497/1111-12', 'jpenterprise', 'joao', 'joaopedrbpav@gmail.com', '123', '1.png'),
(20, '15.646.513/6546-21', 'doces&cia', 'grazi', 'grazieladilanydasilva@gmail.com', '123', '1.png'),
(21, '09.090.909/0909-09', 'BuenoAlimentos', 'BuenoH', 'pedrohnbnunes@gmail.com', '123', '240px-Mario_-_MyNintendo.png'),
(22, '56.419.198/5448-95', 'teste', 'teste', 'backupbuenopedro@gmail.com', '123', 'logoFatecLink.jpeg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `entregador`
--

CREATE TABLE `entregador` (
  `id_entregador` int(11) NOT NULL,
  `nome_completo` varchar(100) DEFAULT NULL,
  `CPF` varchar(100) DEFAULT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  `nome_foto3x4` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nome_usuario` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `nome_cnh` varchar(100) NOT NULL,
  `FK_EMPRESA_id_empresa` int(11) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `entregador`
--

INSERT INTO `entregador` (`id_entregador`, `nome_completo`, `CPF`, `telefone`, `nome_foto3x4`, `email`, `nome_usuario`, `senha`, `nome_cnh`, `FK_EMPRESA_id_empresa`, `latitude`, `longitude`) VALUES
(14, 'Pedro h', '22222222222', '1994161981', '', 'BBBadsafa@gmail.com', 'pedro01', '123', '', 9, NULL, NULL),
(17, 'Lorena Silva', '746.523.856-54', '19 986341234', 'images.jpeg', 'lorena.aa295@gmail.com', 'loris29', '123456', 'cnh.jpeg', 9, -22.3529114, -46.914247),
(18, 'Paulo Vitor', '423.745.752-98', '19 986341232', '3X4.jpeg', 'lorismigz.pam@gmail.coml', 'Paulo', '12345', 'cnh2.jpeg', 9, NULL, NULL),
(19, 'Cleiton Braga', '213423455555', '123234525235', '69f9300b2e852_1.png', 'pedroh.nunesbueno@gmail.com', 'joana', '123', '69f9300b2e856_depositphotos_312423786-stock-photo-bank-robbery-male-robber-black.webp', 13, NULL, NULL),
(20, 'Jaime do Grau', '2134234', '12314334', '69f93149d2f72_depositphotos_312423786-stock-photo-bank-robbery-male-robber-black.webp', 'adsaAAAAfa@gmail.com', 'Pedempresa', '123', '69f93149d2f77_1.png', 13, -22.3674, -46.9428),
(21, 'Cleiton Braga', '11111111111111111', '123234525235', '6a07ab07a1ede_1.png', 'adsafa@gmail.com', 'joana', '123', '6a07ab07a1eea_1.png', 20, NULL, NULL),
(22, 'Cleiton Bueno', '48082359862', '19971335737', '6a0ce2d025270_1.png', 'Cleiton01@gmail.com', 'CleitonB01', '123', '6a0ce2d025278_1.png', 21, -22.430627285349, -46.834595812641),
(23, 'Jaime do Grau', '480823598', '19993433297', '6a0cfd7113a74_240px-Mario_-_MyNintendo.png', 'jaime01@gmail.com', 'jaime', '123', '6a0cfd7113a79_240px-Mario_-_MyNintendo.png', 21, -22.43063113644, -46.834545201678);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `password_resets`
--

INSERT INTO `password_resets` (`id`, `user_id`, `token`, `expiry`) VALUES
(32, 10, '60490c7c715c5d25a5e23201f5c83d7b6cd492360f037af43801b5f239c55018', '2024-11-19 03:06:44'),
(42, 10, 'cbf608003f8eeb985ae413c1c455c54c676b9536050443b58a3166df1a9a914c', '2024-11-19 03:29:18'),
(44, 10, '64fbe438a9d325b7dd0d36a309126293f995f1f2934d7078d7bffb62efe36319', '2024-11-19 03:31:38'),
(46, 10, '6f71d4081a121287551770c732d7d0a902174f1dfdfcf8e4352bd84453dce88f', '2024-11-19 03:34:36'),
(55, 13, '70beaf94ae6b5523058f764d93e9ef390f609c2f0d3fff162a9f94ab6f7a825d', '2026-04-28 01:37:10'),
(56, 13, '2e0028bf08e9c719331743c1e1d5964fcde2417b599c293bc3c311a97042fa84', '2026-04-28 01:42:44'),
(57, 13, '5e2ccfafe8771df3dd69610164c2b2e2292cd4a76a9af50094aff4395b37da92', '2026-04-28 01:55:07'),
(60, 18, '0c5f643ab437b5489c1a890890645a4d4dff8ee3e0d192da78efc4890de4240e', '2026-05-01 02:53:08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `nome_cliente` varchar(100) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `id_entregador` int(11) DEFAULT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_adm` int(11) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `nome_cliente`, `preco`, `endereco`, `bairro`, `descricao`, `id_entregador`, `id_empresa`, `id_adm`, `latitude`, `longitude`, `status`) VALUES
(21, 'Nome', 12.00, 'Rua Miguel de Paula Oliveira', 'Jardim Alto dos Ypês', 'asg', 19, 13, 24, -22.3282663, -46.9447954, 'entregue'),
(22, 'Joaquim', 139.00, 'Rua Serra Negra', 'Vila São Carlos', '123', 20, 13, 24, -22.3527537, -46.9456229, 'A caminho'),
(23, 'Bruna', 10.00, 'Rua Chico de Paula', 'Centro', 'a', 20, 13, 24, -22.3686834, -46.9425497, 'A caminho'),
(24, 'Joaquim', 12.00, 'Rua Miguel de Paula Oliveira', 'Jardim Alto dos Ypês', 'dfasdf', 21, 20, 24, -22.3282663, -46.9447954, 'entregue'),
(29, 'Joaquim', 12.00, 'Rua Miguel de Paula Oliveira', 'Jardim Alto dos Ypês', '', 22, 21, 32, -22.3282663, -46.9447954, 'entregue'),
(30, 'Bruna', 111.00, 'Rua Bauru', 'Vila São Carlos', 'asdf', 22, 21, 32, -22.3549801, -46.9400536, 'entregue'),
(31, 'Bruno', 333.00, 'Avenida dos Italianos', 'Centro', '', 23, 21, 32, -22.4368673, -46.8180675, 'A caminho'),
(32, 'Jhenifer', 222.00, 'Avenida Jacareí', 'Santa Fé', '', 23, 21, 32, -22.4318388, -46.8410027, 'A caminho'),
(33, 'Gabriel', 59.80, 'Rua Tambaú', 'Jardim Santo Antônio', '', 22, 21, 32, -22.3497104, -46.9429847, 'A caminho'),
(34, 'Pedro', 12.12, 'Rua Treze de Maio', 'Centro', '', 22, 21, 32, -22.3710227, -46.9432524, 'A caminho'),
(35, 'Bruna', 200.00, 'Rua Bauru', 'Vila São Carlos', '', NULL, 22, 33, -22.3549801, -46.9400536, 'Pendente');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_adm`),
  ADD KEY `id_adm` (`id_adm`),
  ADD KEY `FK_ADMINISTRADOR_2` (`FK_EMPRESA_id_empresa`);

--
-- Índices de tabela `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id_empresa`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Índices de tabela `entregador`
--
ALTER TABLE `entregador`
  ADD PRIMARY KEY (`id_entregador`),
  ADD KEY `id_entregador` (`id_entregador`),
  ADD KEY `FK_ENTREGADOR_2` (`FK_EMPRESA_id_empresa`);

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_entregador` (`id_entregador`),
  ADD KEY `fk_empresa` (`id_empresa`),
  ADD KEY `fk_pedido_administrador` (`id_adm`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `entregador`
--
ALTER TABLE `entregador`
  MODIFY `id_entregador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `FK_ADMINISTRADOR_2` FOREIGN KEY (`FK_EMPRESA_id_empresa`) REFERENCES `empresa` (`id_empresa`);

--
-- Restrições para tabelas `entregador`
--
ALTER TABLE `entregador`
  ADD CONSTRAINT `FK_ENTREGADOR_2` FOREIGN KEY (`FK_EMPRESA_id_empresa`) REFERENCES `empresa` (`id_empresa`) ON DELETE CASCADE;

--
-- Restrições para tabelas `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `empresa` (`id_empresa`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`),
  ADD CONSTRAINT `fk_entregador` FOREIGN KEY (`id_entregador`) REFERENCES `entregador` (`id_entregador`),
  ADD CONSTRAINT `fk_pedido_administrador` FOREIGN KEY (`id_adm`) REFERENCES `administrador` (`id_adm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
