<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Redefinir senha | Guiar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="<?= BASE_URL ?>/img/logoIcon.png">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] }, animation: { float: 'float 6s ease-in-out infinite' }, keyframes: { float: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-15px)' } } } } } };
    </script>
    <style>
        body { background-color: #eef5ff; color: #102b61; font-family: 'Inter', sans-serif; }
        body > header { min-height: 80px; background: #fff; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 10%), 0 2px 4px -2px rgb(0 0 0 / 10%); }
        body > header img { height: 56px; width: auto; }
        body > header nav { gap: 48px; font-size: 24px; }
        body > header nav a, body > header #nav-menu a { color: #1b138f; }
        body > header nav a:hover, body > header #nav-menu a:hover { color: #2b6dd6; }
        body > header #nav-toggle { color: #fff; background: #1b138f; }
        body > main { min-height: calc(100vh - 164px); background: #eef5ff; }
        .reset-card { max-width: 1024px; min-height: 496px; border-radius: 14px; box-shadow: 0 24px 60px rgb(31 91 166 / 16%); }
        .reset-panel { position: relative; width: 48%; background: linear-gradient(135deg, transparent 0 73%, rgb(10 42 151 / 88%) 73% 84%, transparent 84%), linear-gradient(135deg, transparent 0 86%, #101c8b 86% 100%), #111979; }
        .reset-panel .panel-map { position: absolute; top: -10%; left: -20%; width: 150%; height: 150%; max-width: none; object-fit: contain; opacity: .16; filter: brightness(0) invert(1); mix-blend-mode: overlay; }
        .reset-form-panel { width: 52%; }
        .reset-form-panel input[name="password"] { height: 60px; border: 1px solid #c4d8ff; border-radius: 11px; background: #fff; color: #102b61; box-shadow: 0 1px 3px rgb(16 43 97 / 5%); }
        .reset-form-panel input[name="password"]:focus { border-color: #1b42da; box-shadow: 0 0 0 3px rgb(27 66 218 / 12%); }
        body > footer { border-color: #e1ebf8; background: #fff; color: #58769f; box-shadow: 0 -2px 12px rgb(16 43 97 / 4%); }
        body > footer a { color: #31567f; } body > footer a:hover { color: #0878f9; }
        @media (max-width: 767px) { body > header img { height: 40px; } body > header nav { font-size: 20px; } body > main { min-height: 0; } .reset-card { max-width: 520px; min-height: 0; border-radius: 12px; } .reset-panel, .reset-form-panel { width: 100%; } .reset-panel { min-height: 340px; } .reset-panel .panel-map { width: 150%; height: 150%; } body > footer > div { gap: 8px; text-align: center; } }
    </style>
</head>

<body class="overflow-x-hidden text-gray-900 flex flex-col min-h-screen">
    <header class="bg-white shadow-md py-0 px-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex min-h-20 items-center justify-between">
            <div class="flex items-center"><a href="<?= BASE_URL ?>/index.html"><img src="<?= BASE_URL ?>/img/LogoGAzul.png" alt="Logo GUIAR" class="h-10 md:h-14 w-auto object-contain"></a></div>
            <nav class="hidden md:flex items-center font-semibold">
                <a href="<?= BASE_URL ?>/index.html" class="transition duration-300">Home</a>
                <a href="<?= BASE_URL ?>/routes.php?action=loginEmpresa" class="transition duration-300">Empresa</a>
                <a href="<?= BASE_URL ?>/routes.php?action=loginEntregador" class="transition duration-300">Entregador</a>
            </nav>
            <button id="nav-toggle" class="md:hidden p-2 focus:outline-none rounded-lg transition-colors" type="button" aria-label="Abrir menu"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
        </div>
        <div id="nav-menu" class="hidden w-full md:hidden pb-4"><div class="flex flex-col gap-4 text-lg font-semibold mt-4"><a href="<?= BASE_URL ?>/index.html">Home</a><a href="<?= BASE_URL ?>/routes.php?action=loginEmpresa">Empresa</a><a href="<?= BASE_URL ?>/routes.php?action=loginEntregador" class="font-bold">Entregador</a></div></div>
    </header>

    <main class="flex-grow flex items-center justify-center px-6 py-16">
        <div class="reset-card flex flex-col md:flex-row w-full my-10 bg-white overflow-hidden">
            <div class="reset-panel p-10 flex flex-col justify-center relative overflow-hidden text-white">
                <img src="<?= BASE_URL ?>/img/Mapa.png" alt="" aria-hidden="true" class="panel-map animate-float pointer-events-none z-0">
                <div class="relative z-10 flex flex-col h-full">
                    <div class="mb-8"><img src="<?= BASE_URL ?>/img/LogoGuiar.png" alt="Logo GUIAR" class="w-32 brightness-0 invert"></div>
                    <div class="my-auto"><h1 class="text-white text-[2rem] leading-[1.2] font-bold mb-5 tracking-tight">Um novo começo.<br>Sua conta segura.</h1><div class="h-1 w-20 bg-[#0878F9]"></div></div>
                </div>
            </div>

            <div class="reset-form-panel p-8 md:p-12 flex flex-col justify-center bg-white relative">
                <div class="w-full max-w-[508px] mx-auto">
                    <div class="flex items-center gap-4 mb-8"><div class="flex items-center justify-center flex-shrink-0 text-[#001b69]"><svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg></div><h2 class="text-2xl font-black text-gray-900">Redefinir senha</h2></div>

                    <?php if (isset($erro)): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6 font-semibold" role="alert"><?= htmlspecialchars($erro); ?></div>
                    <?php endif; ?>

                    <?php if (isset($sucesso)): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6 font-semibold" role="alert"><?= htmlspecialchars($sucesso); ?></div>
                    <?php else: ?>
                        <form method="POST" class="space-y-6">
                            <input type="hidden" name="token" value="<?= htmlspecialchars($_GET['token'] ?? $_POST['token'] ?? ''); ?>">
                            <div><label for="password" class="block text-sm font-semibold text-gray-600 mb-2">Nova senha</label><input type="password" name="password" id="password" required placeholder="Digite sua nova senha" class="w-full bg-gray-50 text-gray-900 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-[#F37B1D] transition font-medium"></div>
                            <div class="pt-2"><button type="submit" class="w-full bg-[#FFB800] text-gray-900 py-4 rounded-2xl font-black text-xl hover:bg-[#F5B000] hover:scale-[1.02] hover:shadow-lg transition cursor-pointer">Redefinir Senha</button></div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="w-full px-6 py-4 mt-auto border-t shadow-inner z-50"><div class="w-full flex flex-col md:flex-row items-center justify-between text-[0.85rem]"><p class="mb-2 md:mb-0">&copy; <?= date('Y') ?> GUIAR. Todos os direitos reservados.</p><div class="flex space-x-4 font-medium"><a href="#" class="transition-colors">Política de Privacidade</a><a href="<?= BASE_URL ?>/routes.php?action=termosUso" class="transition-colors">Termos de Serviço</a></div></div></footer>

    <script>
        const btn = document.getElementById('nav-toggle');
        const menu = document.getElementById('nav-menu');
        if (btn && menu) { btn.addEventListener('click', () => { menu.classList.toggle('hidden'); menu.classList.toggle('flex'); }); }
    </script>
</body>
</html>
