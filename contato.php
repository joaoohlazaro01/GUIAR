<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato | GUIAR</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="Shortcut Icon" type="image/png" href="img/G.png">
</head>

<body class="bg-[#F5F5F5] overflow-x-hidden text-gray-900 flex flex-col min-h-screen">

    <!-- CABEÇALHO -->
    <header class="bg-white shadow-md py-0 px-8 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- LOGO -->
            <div class="flex items-center -my-6">
                <a href="index.html">
                    <img src="img/LogoGuiar.png" alt="Logo GUIAR" class="w-52 h-auto object-contain">
                </a>
            </div>

            <!-- MENU -->
            <nav class="hidden md:flex items-center gap-12 font-semibold text-xl">
                <a href="index.html" class="text-[#1B138F] hover:text-[#FFD400] transition duration-300">Home</a>
                <a href="routes.php?action=loginEmpresa" class="text-[#1B138F] hover:text-[#FFD400] transition duration-300">Empresa</a>
                <a href="routes.php?action=loginEntregador" class="text-[#1B138F] hover:text-[#FFD400] transition duration-300">Entregador</a>
                <a href="contato.php" class="text-[#FFD400] transition duration-300">Contato</a>
            </nav>
        </div>
    </header>

    <!-- CONTEÚDO PRINCIPAL (FLEX GROW PARA EMPURRAR FOOTER) -->
    <main class="flex-grow py-12 px-8 flex items-center">
        <div class="max-w-7xl mx-auto w-full">
            <!-- Container com Imagem de Fundo -->
            <div class="relative rounded-[40px] overflow-hidden h-[700px] shadow-2xl bg-cover bg-center bg-no-repeat"
                style="background-image: url('img/contatosR.png');">

                <!-- Gradiente Escuro (Overlay) - Direcionado para a direita onde ficará o form -->
                <div class="absolute inset-0 bg-gradient-to-l from-[#1B138F]/95 via-[#1B138F]/70 to-transparent"></div>

                <!-- Card de Formulário com Efeito Glassmorphism -->
                <div class="absolute bottom-10 right-10 left-10 md:top-16 md:bottom-16 md:right-16 md:left-auto md:w-[500px] z-10 flex flex-col justify-center">

                    <div class="backdrop-blur-md bg-white/10 border border-white/20 p-10 rounded-3xl shadow-[0_8px_32px_0_rgba(31,38,135,0.37)] h-full overflow-y-auto custom-scrollbar">

                        <h2 class="text-4xl font-black text-[#FFD400] mb-8 drop-shadow-md text-center">
                            FALE CONOSCO
                        </h2>

                        <!-- FORM -->
                        <form action="contato.php" method="POST" class="space-y-5">

                            <div>
                                <input type="text" name="name" placeholder="Seu Nome:" required
                                    class="w-full bg-white/70 backdrop-blur-sm border border-white/40 text-gray-900 placeholder-gray-700 rounded-xl px-6 py-4 outline-none focus:ring-2 focus:ring-[#FFD400] transition">
                            </div>

                            <div>
                                <input type="email" name="email" placeholder="E-mail:" required
                                    class="w-full bg-white/70 backdrop-blur-sm border border-white/40 text-gray-900 placeholder-gray-700 rounded-xl px-6 py-4 outline-none focus:ring-2 focus:ring-[#FFD400] transition">
                            </div>

                            <div>
                                <textarea rows="4" name="message" placeholder="Sua Mensagem..." required
                                    class="w-full bg-white/70 backdrop-blur-sm border border-white/40 text-gray-900 placeholder-gray-700 rounded-xl px-6 py-4 outline-none resize-none focus:ring-2 focus:ring-[#FFD400] transition"></textarea>
                            </div>

                            <!-- BOTÃO -->
                            <button type="submit"
                                class="w-full bg-[#FFD400] text-[#1B138F] py-4 rounded-xl font-black text-lg hover:scale-[1.03] hover:shadow-xl transition">
                                ENVIAR MENSAGEM
                            </button>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#1B138F] text-white py-10 px-8 overflow-hidden mt-auto">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-10 items-start">
                <!-- LOGO -->
                <div>
                    <img src="img/Glogo.png" alt="Logo GUIAR" class="w-20 h-auto object-contain mb-4">
                </div>

                <!-- LINKS -->
                <div class="border-l border-white/20 pl-8">
                    <ul class="space-y-3">
                        <li><a href="index.html" class="hover:text-[#FFD400] transition">Home</a></li>
                        <li><a href="routes.php?action=loginEmpresa" class="hover:text-[#FFD400] transition">Empresa</a></li>
                        <li><a href="routes.php?action=loginEntregador" class="hover:text-[#FFD400] transition">Entregador</a></li>
                        <li><a href="contato.php" class="hover:text-[#FFD400] transition">Contato</a></li>
                    </ul>
                </div>


                <!-- CONTATO -->
                <div class="border-l border-white/20 pl-8">
                    <h3 class="font-bold text-xl mb-4">Ligue para nós</h3>
                    <p>+55 11 99999-9999</p>
                </div>

                <!-- EMAIL -->
                <div class="border-l border-white/20 pl-8">
                    <h3 class="font-bold text-xl mb-4">Envie-nos um e-mail</h3>
                    <p>contato@guiar.com</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
<?php
session_start();
require 'config.php';

// ===== SALVAR DADOS =====
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensagem = $_POST['message'] ?? '';

    if (!empty($nome) && !empty($email) && !empty($mensagem)) {

        try {
            $stmt = $pdo->prepare("INSERT INTO contato (nome, email, mensagem) VALUES (:nome, :email, :mensagem)");

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mensagem', $mensagem);

            $stmt->execute();

            echo "<script>alert('Mensagem enviada com sucesso!');</script>";
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Preencha todos os campos!');</script>";
    }
}
?>