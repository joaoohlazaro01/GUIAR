<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Shortcut Icon" type="image/png" href="img/Glogo.png">
    <title>Dashboard dos Motoboys</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/style/sidebar.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .sidebar-page {
            background:
                radial-gradient(ellipse at 60% -10%, rgba(255, 255, 255, .98), transparent 48%),
                #f1f4fa !important;
            overflow-x: hidden;
        }

        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
                transition: transform .3s ease;
                border-radius: 0 !important;
                top: 0 !important;
                left: 0 !important;
                margin: 0 !important;
                height: 100vh !important;
                width: 280px !important;
            }
            #sidebar.mobile-open { transform: translateX(0); }
            #overlay.active { display: block; }
            #hamburger {
                display: flex !important;
                flex: 0 0 auto;
            }
            .entregadores-main { margin-left: 0 !important; }
            #closeSidebar { color: #475569; }
        }

        .entregadores-main {
            min-width: 0;
            width: 100%;
            min-height: 100vh;
        }
        [hidden] { display: none !important; }

        /* ─── HEADER ─── */
        .entregadores-header {
            min-height: clamp(64px, 8vh, 84px);
            padding: 12px clamp(14px, 2.4vw, 36px);
            background:
                radial-gradient(ellipse at 65% -125%, rgba(226, 218, 238, .62), transparent 48%),
                rgba(255, 255, 255, .72);
            border: 0;
        }
        .entregadores-page-title {
            color: #172b4d;
            font-size: clamp(16px, 1.35vw, 21px);
            font-weight: 800;
            letter-spacing: -.035em;
        }
        .entregadores-page-icon { color: var(--emp-primary, #4f46e5); }
        .entregadores-page-subtitle {
            margin-top: 2px;
            color: #8390a8;
            font-size: clamp(10px, .72vw, 12px);
            line-height: 1.45;
        }

        /* ─── CONTENT ─── */
        .entregadores-content {
            width: 100%;
            max-width: 1760px;
            margin: 0 auto;
            padding: clamp(12px, 1.8vw, 28px) clamp(12px, 2vw, 36px) 96px;
        }

        /* ─── TOOLBAR ─── */
        .entregadores-toolbar {
            width: 100%;
            min-width: 0;
            min-height: 44px;
            padding: 6px 10px;
            border: 1px solid #edf0f6;
            border-radius: 14px;
            background: rgba(255, 255, 255, .86);
            box-shadow: 0 5px 16px rgba(27, 48, 82, .035);
        }
        .entregadores-search:focus { outline: none; }
        .entregadores-search-wrap {
            min-width: 0;
            flex: 1 1 auto;
        }
        .entregadores-search {
            min-width: 0;
            font-size: clamp(10px, .8vw, 12px);
        }
        .entregadores-search-wrap:focus-within {
            border-color: var(--emp-primary, #cad5e7);
            box-shadow: 0 0 0 3px var(--emp-primary-ring, rgba(105, 132, 178, .09));
        }

        /* ─── RESULTS TABLE ─── */
        .entregadores-results {
            width: 100%;
            min-width: 0;
            margin-top: clamp(10px, 1.4vw, 18px);
            border: 1px solid #edf0f6;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 8px 22px rgba(27, 48, 82, .045);
        }
        .entregadores-list-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 20px;
            border-bottom: 1px solid #edf0f6;
        }
        .entregadores-list-title { color: #172b4d; font-size: 14px; font-weight: 800; }
        .entregadores-count {
            padding: 5px 10px;
            border-radius: 999px;
            background: var(--emp-primary-light, #eef2ff);
            color: var(--emp-primary, #4f46e5);
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* ─── GRID COLUMNS ─── */
        .entregadores-columns,
        .entregador-card {
            display: grid;
            grid-template-columns: minmax(50px, .4fr) minmax(140px, 1.4fr) minmax(130px, 1fr) minmax(120px, 1fr) minmax(160px, 1.2fr) minmax(100px, .7fr) minmax(130px, .9fr);
            align-items: center;
            gap: 14px;
        }
        .entregadores-columns {
            padding: 11px 20px;
            background: #f8fafc;
            color: #8290a7;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .045em;
        }
        .entregadores-grid {
            display: block;
            position: relative;
            padding: 0;
        }
        .entregador-card {
            padding: 16px 20px;
            border: 0;
            border-bottom: 1px solid #edf0f6;
            border-left: 3px solid var(--emp-primary, #4f46e5);
            border-radius: 0;
            background: #fff;
            box-shadow: none;
            transition: background-color .18s ease;
        }
        .entregador-card:last-child { border-bottom: 0; }
        .entregador-card:hover { background: #fafbfe; }
        .entregador-cell { min-width: 0; }
        .entregador-mobile-label { display: none; }
        .entregador-reference { color: #172b4d; font-size: 13px; font-weight: 800; }
        .entregador-primary-text {
            display: block;
            overflow: hidden;
            color: #263957;
            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .entregador-secondary-text {
            display: block;
            margin-top: 3px;
            overflow: hidden;
            color: #8793a9;
            font-size: 10px;
            line-height: 1.4;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .entregador-status-badge {
            display: inline-flex;
            align-items: center;
            width: fit-content;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 999px;
            background: var(--emp-primary-light, #eef2ff);
            color: var(--emp-primary, #4f46e5);
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }
        .entregador-status-badge::before {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
            content: "";
        }
        .entregador-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--emp-primary-light, #eef2ff);
            color: var(--emp-primary, #4f46e5);
            font-size: 11px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .entregador-actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .entregador-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: all .18s ease;
            border: 1px solid transparent;
        }
        .entregador-action-btn svg { width: 13px; height: 13px; }
        .entregador-action-edit {
            color: #3b82f6;
            background: #eff6ff;
            border-color: #dbeafe;
        }
        .entregador-action-edit:hover {
            background: #dbeafe;
            color: #2563eb;
        }
        .entregador-action-delete {
            color: #ef4444;
            background: #fef2f2;
            border-color: #fecaca;
        }
        .entregador-action-delete:hover {
            background: #fecaca;
            color: #dc2626;
        }

        /* ─── EMPTY STATE ─── */
        .entregadores-empty-state {
            position: relative;
            z-index: 1;
            min-height: clamp(280px, 48vh, 560px);
            padding: 25px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .entregadores-empty-illustration {
            width: clamp(112px, 12vw, 164px);
            height: auto;
        }
        .entregadores-illustration-accent { fill: var(--emp-primary, #4f46e5); }
        .entregadores-illustration-accent-stroke { stroke: var(--emp-primary, #4f46e5); }
        .entregadores-empty-title {
            margin-top: 6px;
            color: #172b4d;
            font-size: clamp(15px, 1.2vw, 19px);
            font-weight: 800;
        }
        .entregadores-empty-copy {
            max-width: min(100%, 340px);
            margin-top: 4px;
            color: #8793a9;
            font-size: clamp(11px, .8vw, 13px);
            line-height: 1.5;
        }
        .entregadores-retry {
            margin-top: 12px;
            padding: 9px 16px;
            border-radius: 999px;
            background: var(--emp-primary, #4f46e5);
            color: var(--emp-primary-contrast, #fff);
            font-size: 11px;
            font-weight: 700;
            box-shadow: 0 5px 12px var(--emp-primary-ring, rgba(79, 70, 229, .2));
            cursor: pointer;
            transition: all .18s ease;
        }
        .entregadores-retry:hover {
            background: var(--emp-primary-hover, #4338ca);
        }

        /* ─── ADD BUTTON (FAB) ─── */
        .entregador-add-fab {
            position: fixed;
            right: clamp(12px, 2vw, 32px);
            bottom: clamp(12px, 2vh, 24px);
            z-index: 20;
        }
        .entregador-add-fab button {
            padding: clamp(12px, 1vw, 16px) clamp(18px, 1.8vw, 28px);
            font-size: clamp(12px, .9vw, 14px);
            background: var(--emp-primary, #4f46e5);
            color: var(--emp-primary-contrast, #fff);
            box-shadow: 0 8px 24px var(--emp-primary-ring, rgba(79, 70, 229, .25));
            border-radius: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all .18s ease;
        }
        .entregador-add-fab button:hover {
            background: var(--emp-primary-hover, #4338ca);
            transform: translateY(-2px);
            box-shadow: 0 12px 32px var(--emp-primary-ring, rgba(79, 70, 229, .35));
        }

        /* ─── MODAL ─── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 60;
            background: rgba(12, 17, 32, .65);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            display: none;
            overflow-y: auto;
        }
        .modal-overlay.active { display: block; }
        .modal-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 16px;
        }
        .modal-panel {
            position: relative;
            width: 100%;
            max-width: 520px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 24px 60px rgba(12, 17, 32, .22);
            padding: 0;
            transform: scale(.95);
            opacity: 0;
            transition: transform .25s cubic-bezier(.4,0,.2,1), opacity .25s ease;
        }
        .modal-overlay.active .modal-panel {
            transform: scale(1);
            opacity: 1;
        }
        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 24px 28px 0;
        }
        .modal-title {
            color: #172b4d;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.02em;
        }
        .modal-close {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            color: #8793a9;
            cursor: pointer;
            transition: all .18s ease;
        }
        .modal-close:hover {
            background: #f1f5f9;
            color: #334155;
        }
        .modal-body {
            padding: 20px 28px 28px;
        }
        .modal-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .modal-input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            color: #1e293b;
            background: #f8fafc;
            transition: all .18s ease;
        }
        .modal-input:focus {
            outline: none;
            border-color: var(--emp-primary, #4f46e5);
            box-shadow: 0 0 0 3px var(--emp-primary-ring, rgba(79, 70, 229, .12));
            background: #fff;
        }
        .modal-input-file {
            width: 100%;
            font-size: 12px;
            color: #64748b;
            cursor: pointer;
        }
        .modal-input-file::file-selector-button {
            padding: 8px 14px;
            margin-right: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
            color: #475569;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            transition: all .18s ease;
        }
        .modal-input-file::file-selector-button:hover {
            background: #e2e8f0;
        }
        .modal-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }
        .modal-form-full { grid-column: span 2; }
        .modal-submit {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            cursor: pointer;
            transition: all .18s ease;
            border: none;
        }
        .modal-submit-primary {
            background: var(--emp-primary, #4f46e5);
            color: var(--emp-primary-contrast, #fff);
            box-shadow: 0 4px 14px var(--emp-primary-ring, rgba(79, 70, 229, .2));
        }
        .modal-submit-primary:hover {
            background: var(--emp-primary-hover, #4338ca);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px var(--emp-primary-ring, rgba(79, 70, 229, .3));
        }
        .modal-submit-danger {
            background: #ef4444;
            color: #fff;
            box-shadow: 0 4px 14px rgba(239, 68, 68, .2);
        }
        .modal-submit-danger:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }
        .modal-submit-cancel {
            background: #f1f5f9;
            color: #475569;
        }
        .modal-submit-cancel:hover {
            background: #e2e8f0;
        }
        .modal-delete-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fef2f2;
        }
        .modal-delete-title {
            color: #172b4d;
            font-size: 18px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 6px;
        }
        .modal-delete-text {
            color: #8793a9;
            font-size: 13px;
            text-align: center;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        /* ─── HEADER BUTTON ─── */
        .header-add-btn {
            display: none;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 10px;
            background: var(--emp-primary, #4f46e5);
            color: var(--emp-primary-contrast, #fff);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all .18s ease;
            box-shadow: 0 4px 12px var(--emp-primary-ring, rgba(79, 70, 229, .18));
            border: none;
        }
        .header-add-btn:hover {
            background: var(--emp-primary-hover, #4338ca);
            transform: translateY(-1px);
        }

        /* ─── RESPONSIVE ─── */
        @media (min-width: 769px) {
            .header-add-btn { display: flex; }
        }
        @media (min-width: 769px) and (max-width: 1100px) {
            .entregadores-content { padding-right: 16px; padding-left: 16px; }
            .entregadores-columns,
            .entregador-card {
                grid-template-columns: minmax(40px, .35fr) minmax(110px, 1.2fr) minmax(100px, .9fr) minmax(100px, .9fr) minmax(130px, 1.1fr) minmax(80px, .6fr) minmax(110px, .8fr);
                gap: 9px;
                padding-right: 14px;
                padding-left: 14px;
            }
        }
        @media (max-width: 768px) {
            .entregadores-columns { display: none; }
            .entregador-card {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 13px 12px;
                padding: 15px 14px;
            }
            .entregador-cell { display: flex; flex-direction: column; gap: 4px; }
            .entregador-mobile-label {
                display: block;
                color: #8793a9;
                font-size: 9px;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: .04em;
            }
            .entregador-primary-text,
            .entregador-secondary-text { white-space: normal; overflow-wrap: anywhere; }
            .entregadores-list-heading { padding: 13px 14px; }
            .entregadores-empty-state { min-height: clamp(260px, 55vh, 520px); }
            .entregador-actions { flex-wrap: wrap; }
            .modal-form-grid {
                grid-template-columns: 1fr;
            }
            .modal-form-full { grid-column: span 1; }
        }
        @media (max-width: 480px) {
            .entregadores-header {
                display: grid;
                grid-template-columns: 34px minmax(0, 1fr) auto;
                align-items: center;
                gap: 8px;
                padding: 12px;
            }
            .entregadores-header > #hamburger {
                width: 32px;
                height: 32px;
            }
            .entregadores-header > .entregadores-title-group {
                min-width: 0;
                gap: 6px;
            }
            .entregadores-header > .entregadores-title-group > span {
                width: 22px;
                height: 28px;
            }
            .entregadores-header > .entregadores-title-group > span svg {
                width: 17px;
                height: 17px;
            }
            .entregadores-page-title {
                font-size: clamp(14px, 4vw, 16px);
                line-height: 1.2;
            }
            .entregadores-page-subtitle {
                max-width: 100%;
                font-size: clamp(9px, 2.8vw, 10px);
                line-height: 1.35;
            }
            .entregadores-content { padding: 12px 10px 88px; }
            .entregadores-toolbar { gap: 6px; padding: 5px; }
            .entregadores-toolbar > label { gap: 6px; padding-right: 8px; padding-left: 8px; }
            .entregadores-search::placeholder { font-size: clamp(9px, 2.7vw, 10px); }
            .entregador-card {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 13px 12px;
                padding: 15px 12px;
            }
            .entregadores-list-heading { padding: 13px 12px; }
            .entregadores-list-title { font-size: 13px; }
            .entregadores-empty-state { padding: 20px 12px; }
            .entregador-card { padding: 16px; }
            .entregador-add-fab { right: 12px; bottom: 12px; }
            .entregador-add-fab button { padding: 10px 16px; font-size: 12px; }
            .modal-header { padding: 20px 20px 0; }
            .modal-body { padding: 16px 20px 24px; }
        }
        @media (max-height: 480px) and (min-width: 481px) {
            .entregadores-empty-state { padding-top: 14px; padding-bottom: 14px; }
            .entregadores-empty-illustration { width: 96px; }
        }
    </style>
</head>

<body class="sidebar-page bg-[#F3F4F6] text-gray-800 antialiased min-h-screen">

    <div class="flex min-h-screen relative">

        <!-- OVERLAY MOBILE -->
        <div id="overlay"
            class="hidden fixed inset-0 bg-black/40 z-30 md:hidden">
        </div>

        <!-- SIDEBAR -->
         <?php
$nomeAdmin = $_SESSION['nome_usuario'] ?? ($admin["nome_adm"] ?? "Admin");
?>
        <aside id="sidebar"
    class="w-72 bg-[#ffff] flex flex-col fixed top-0 left-0 text-white z-40 transition-all rounded-none overflow-hidden h-screen">

    <div class="flex flex-col h-full">

        <!-- BOTÃO FECHAR MOBILE -->
        <button id="closeSidebar"
            class="absolute top-5 right-5 md:hidden text-white text-2xl z-50">

            ✕
        </button>

        <!-- LOGO -->
        <div class="p-8 mb-4 flex justify-center">
            <img src="<?= BASE_URL ?>/img/LogoPreto.png"
                alt="Logo GUIAR"
                class="w-32 h-auto object-contain">
        </div>

        <!-- MENU -->
        <nav class="sidebar-menu px-4 space-y-2 flex-grow">

            <!-- INÍCIO -->
            <a href="<?= BASE_URL ?>/routes.php?action=dashboardAdm"
                 class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>

                Início
            </a>

            <!-- PEDIDOS -->
            <a href="<?= BASE_URL ?>/routes.php?action=pedidos"
                 class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>

                Pedidos
            </a>

            <!-- ENTREGADORES -->
            <a href="<?= BASE_URL ?>/routes.php?action=entregadores"
                class="menu-item active flex items-center gap-3.5 px-5 py-3 rounded-xl font-bold text-sm bg-[#4F46E5] text-black shadow-lg shadow-indigo-500/10 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 4a2 2 0 100-4 2 2 0 000 4zM3 20v-2a2 2 0 012-2h1" />
                </svg>

                Entregadores
            </a>

            <!-- PEDIDOS ENTREGUES -->
            <a href="<?= BASE_URL ?>/routes.php?action=pedidosEntregues"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>

                Pedidos Entregues
            </a>

            <!-- MAPA -->
            <a href="<?= BASE_URL ?>/routes.php?action=mapaAdm"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>

                Acompanhar Rotas
            </a>

            <!-- PERFIL -->
            <a href="<?= BASE_URL ?>/routes.php?action=perfilAdm"
                class="menu-item flex items-center gap-3.5 px-5 py-3 rounded-xl font-semibold text-sm text-slate-400 hover:text-black hover:bg-white/5 transition-all">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 opacity-70"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>

                Meu Perfil
            </a>
        </nav>

        <!-- FOOTER -->
        <div class="p-4 mt-auto">
            <div class="px-4 pb-4 flex flex-col items-center gap-1.5">
                <img src="<?= BASE_URL ?>/img/LogoPreto.png"
                    alt="GUIAR"
                    class="w-24 h-auto object-contain">
                <p class="text-[10px] text-slate-400 text-center leading-tight">
                    Conectando você ao seu destino.
                </p>
            </div>

            <div class="admin-user-card flex items-center gap-3.5 p-3 rounded-2xl bg-white/5 border border-white/5">

                <div class="admin-user-avatar w-10 h-10 rounded-full bg-[#FFD400] text-[#0B0D2F] font-black text-sm flex items-center justify-center shadow-lg">
                    <?= strtoupper(substr($nomeAdmin, 0, 2)) ?>
                </div>

                <div class="flex-grow min-w-0">

                    <p class="admin-user-name font-bold text-xs text-black truncate">
                        <?= htmlspecialchars($nomeAdmin) ?>
                    </p>

                    <p class="admin-user-role text-[10px] text-slate-500 font-bold tracking-wider uppercase">
                        Admin
                    </p>
                </div>

                <!-- LOGOUT -->
                <a href="<?= BASE_URL ?>/routes.php?action=logoutAdm"
                    class="text-slate-500 hover:text-rose-500 transition-colors p-1">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</aside>

    <!-- MAIN -->
    <main class="entregadores-main flex-1 flex flex-col min-h-screen w-full md:ml-72">

        <!-- HEADER -->
        <header class="entregadores-header backdrop-blur-md flex items-center gap-3 sticky top-0 z-10">

            <!-- MENU MOBILE -->
            <button id="hamburger"
                class="md:hidden flex items-center justify-center w-9 h-9 rounded-xl bg-white shadow-sm">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5 text-gray-700"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="entregadores-title-group flex min-w-0 flex-1 items-center gap-3">
                <span class="entregadores-page-icon flex h-8 w-8 shrink-0 items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 100-8 4 4 0 000 8zm6 4a2 2 0 100-4 2 2 0 000 4zM3 20v-2a2 2 0 012-2h1" />
                    </svg>
                </span>
                <div class="min-w-0">
                    <h1 class="entregadores-page-title">Nossos Entregadores</h1>
                    <p class="entregadores-page-subtitle">Gerencie os entregadores com acesso ao sistema.</p>
                </div>
            </div>

            <button id="openNewMotoboyModal" class="header-add-btn" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                </svg>
                Novo Entregador
            </button>
        </header>

        <!-- CONTEÚDO -->
        <div class="entregadores-content flex flex-1 flex-col">

            <!-- TOOLBAR -->
            <div class="entregadores-toolbar flex items-center gap-2">
                <label class="entregadores-search-wrap flex min-w-0 flex-1 items-center gap-2 rounded-full border border-slate-100 px-3 py-1.5 text-slate-400 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" stroke-width="1.8" />
                        <path stroke-linecap="round" stroke-width="1.8" d="m16 16 4 4" />
                    </svg>
                    <input id="searchInput" type="search" class="entregadores-search w-full bg-transparent text-[9px] text-slate-700 placeholder:text-slate-400" placeholder="Buscar por nome, CPF, email ou telefone..." aria-label="Buscar entregadores">
                </label>
            </div>

            <!-- TABLE -->
            <section class="entregadores-results" aria-live="polite">
                <div class="entregadores-list-heading">
                    <h2 class="entregadores-list-title">Lista de Entregadores</h2>
                    <span id="entregadoresCount" class="entregadores-count"><?= !empty($result) ? count($result) : 0 ?> entregadores</span>
                </div>

                <!-- COLUMN HEADERS -->
                <div class="entregadores-columns" aria-hidden="true">
                    <span>ID</span>
                    <span>Nome</span>
                    <span>CPF</span>
                    <span>Telefone</span>
                    <span>Email</span>
                    <span>Status</span>
                    <span>Ações</span>
                </div>

                <!-- EMPTY STATE -->
                <div id="entregadoresEmptyState" class="entregadores-empty-state" <?= !empty($result) ? 'hidden' : '' ?>>
                    <svg class="entregadores-empty-illustration" viewBox="0 0 160 130" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <ellipse cx="78" cy="112" rx="48" ry="8" fill="#E9EEF6"/>
                        <path d="m42 45 38-17 38 17-38 20-38-20Z" fill="#F6F8FC"/>
                        <path d="M42 45v42l38 20V65L42 45Z" fill="#E9EEF6"/>
                        <path d="M118 45v42l-38 20V65l38-20Z" fill="#DCE4F0"/>
                        <path d="m42 45 38-17 38 17-38 20-38-20Z" stroke="#D7DFEC" stroke-width="2"/>
                        <path d="m66 34 38 18-14 8-38-20 14-6Z" fill="#7C6FF7"/>
                        <path d="M80 65v42" stroke="#D3DCE9" stroke-width="2"/>
                        <path class="entregadores-illustration-accent" d="M119 12c-8 0-14 6-14 14 0 11 14 25 14 25s14-14 14-25c0-8-6-14-14-14Z"/>
                        <circle cx="119" cy="26" r="5" fill="white"/>
                        <circle class="entregadores-illustration-accent" cx="55" cy="77" r="12"/>
                        <path d="m50 77 4 4 7-8" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path class="entregadores-illustration-accent-stroke" d="m24 55 5 3-5 3m-1-6 1 6m105 13 5 3-5 3m-1-6 1 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h2 id="entregadoresEmptyTitle" class="entregadores-empty-title"><?= !empty($result) ? 'Nenhum entregador corresponde à busca' : 'Nenhum entregador cadastrado' ?></h2>
                    <p class="entregadores-empty-copy">Cadastre entregadores para que eles possam receber pedidos e realizar entregas.</p>
                    <button id="entregadoresRetry" type="button" class="entregadores-retry">Tentar novamente</button>
                </div>

                <!-- ROWS -->
                <div id="entregadoresGrid" class="entregadores-grid" <?= empty($result) ? 'hidden' : '' ?>>
                    <?php if (!empty($result)): ?>
                        <?php foreach ($result as $row):
                            $searchIndex = implode(' ', [
                                $row['id_entregador'] ?? '',
                                $row['nome_completo'] ?? '',
                                $row['CPF'] ?? '',
                                $row['telefone'] ?? '',
                                $row['email'] ?? ''
                            ]);
                        ?>
                        <article class="entregador-card"
                            data-search="<?= htmlspecialchars($searchIndex, ENT_QUOTES, 'UTF-8') ?>">

                            <div class="entregador-cell entregador-reference">
                                <span class="entregador-mobile-label">ID</span>
                                <span>#<?= htmlspecialchars($row["id_entregador"]) ?></span>
                            </div>

                            <div class="entregador-cell">
                                <span class="entregador-mobile-label">Nome</span>
                                <div class="flex items-center gap-2.5">
                                    <span class="entregador-avatar">
                                        <?= strtoupper(substr($row["nome_completo"], 0, 2)) ?>
                                    </span>
                                    <span class="entregador-primary-text"><?= htmlspecialchars($row["nome_completo"]) ?></span>
                                </div>
                            </div>

                            <div class="entregador-cell">
                                <span class="entregador-mobile-label">CPF</span>
                                <span class="entregador-primary-text"><?= htmlspecialchars($row["CPF"]) ?></span>
                            </div>

                            <div class="entregador-cell">
                                <span class="entregador-mobile-label">Telefone</span>
                                <span class="entregador-primary-text"><?= htmlspecialchars($row["telefone"]) ?></span>
                            </div>

                            <div class="entregador-cell">
                                <span class="entregador-mobile-label">Email</span>
                                <span class="entregador-primary-text"><?= htmlspecialchars($row["email"]) ?></span>
                                <span class="entregador-secondary-text">Entregador</span>
                            </div>

                            <div class="entregador-cell">
                                <span class="entregador-mobile-label">Status</span>
                                <span class="entregador-status-badge">Ativo</span>
                            </div>

                            <div class="entregador-cell">
                                <span class="entregador-mobile-label">Ações</span>
                                <div class="entregador-actions">
                                    <button class="btn-edit entregador-action-btn entregador-action-edit"
                                        data-id='<?= htmlspecialchars($row["id_entregador"]) ?>'
                                        data-nome='<?= htmlspecialchars($row["nome_completo"]) ?>'
                                        data-cpf='<?= htmlspecialchars($row["CPF"]) ?>'
                                        data-telefone='<?= htmlspecialchars($row["telefone"]) ?>'
                                        data-email='<?= htmlspecialchars($row["email"]) ?>'>
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        Editar
                                    </button>
                                    <button class="btn-delete entregador-action-btn entregador-action-delete"
                                        data-id='<?= htmlspecialchars($row["id_entregador"]) ?>'>
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Remover
                                    </button>
                                </div>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </main>
</div>

<!-- ═══════════════════════════════════════════════ -->
<!-- MODAL: NOVO ENTREGADOR                        -->
<!-- ═══════════════════════════════════════════════ -->
<div id="newMotoboyModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-panel">
            <div class="modal-header">
                <h2 class="modal-title">Cadastrar Entregador</h2>
                <button type="button" class="modal-close" id="closeNewMotoboyModal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="newMotoboyForm" method="POST" action="<?= BASE_URL ?>/routes.php?action=cadastrarEntregador" enctype="multipart/form-data">
                    <div class="modal-form-grid" style="gap: 16px;">

                        <div class="modal-form-full">
                            <label for="nome_completo" class="modal-label">Nome completo</label>
                            <input type="text" id="nome_completo" name="nome_completo" required class="modal-input" placeholder="Nome do entregador">
                        </div>

                        <div>
                            <label for="cpf" class="modal-label">CPF</label>
                            <input type="text" id="cpf" name="cpf" required minlength="14" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" oninput="this.value = formatCPF(this.value)" class="modal-input" placeholder="000.000.000-00">
                        </div>

                        <div>
                            <label for="telefone" class="modal-label">Telefone</label>
                            <input type="text" id="telefone" name="telefone" required minlength="14" maxlength="15" pattern="\(\d{2}\)\s\d{4,5}-\d{4}" oninput="this.value = formatPhone(this.value)" class="modal-input" placeholder="(00) 00000-0000">
                        </div>

                        <div class="modal-form-full">
                            <label for="email" class="modal-label">Email</label>
                            <input type="email" id="email" name="email" required class="modal-input" placeholder="email@exemplo.com">
                        </div>

                        <div>
                            <label for="nome_usuario" class="modal-label">Usuário</label>
                            <input type="text" id="nome_usuario" name="nome_usuario" required class="modal-input" placeholder="Nome de usuário">
                        </div>

                        <div>
                            <label for="senha" class="modal-label">Senha</label>
                            <input type="password" id="senha" name="senha" required class="modal-input" placeholder="••••••••">
                        </div>

                        <div>
                            <label for="foto_3x4" class="modal-label">Foto 3x4</label>
                            <input type="file" id="foto_3x4" name="foto_3x4" required class="modal-input-file">
                        </div>

                        <div>
                            <label for="foto_CNH" class="modal-label">Foto CNH</label>
                            <input type="file" id="foto_CNH" name="foto_CNH" required class="modal-input-file">
                        </div>

                        <div class="modal-form-full" style="margin-top: 8px;">
                            <button type="submit" class="modal-submit modal-submit-primary">Salvar Cadastro</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════ -->
<!-- MODAL: EDITAR ENTREGADOR                      -->
<!-- ═══════════════════════════════════════════════ -->
<div id="editModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-panel">
            <div class="modal-header">
                <h2 class="modal-title">Editar Entregador</h2>
                <button type="button" class="modal-close" id="closeEdit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="<?= BASE_URL ?>/routes.php?action=editarEntregador">
                    <div class="modal-form-grid" style="gap: 16px;">

                        <div class="modal-form-full">
                            <label for="edit_nome_completo" class="modal-label">Nome Completo</label>
                            <input type="text" id="edit_nome_completo" name="nome_completo" required class="modal-input">
                        </div>

                        <div>
                            <label for="edit_CPF" class="modal-label">CPF</label>
                            <input type="text" id="edit_CPF" name="CPF" required minlength="14" maxlength="14" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" oninput="this.value = formatCPF(this.value)" class="modal-input">
                        </div>

                        <div>
                            <label for="edit_telefone" class="modal-label">Telefone</label>
                            <input type="text" id="edit_telefone" name="telefone" required minlength="14" maxlength="15" pattern="\(\d{2}\)\s\d{4,5}-\d{4}" oninput="this.value = formatPhone(this.value)" class="modal-input">
                        </div>

                        <div class="modal-form-full">
                            <label for="edit_email" class="modal-label">Email</label>
                            <input type="email" id="edit_email" name="email" required class="modal-input">
                        </div>

                        <input type="hidden" id="edit_id" name="id">

                        <div class="modal-form-full" style="margin-top: 8px;">
                            <button type="submit" class="modal-submit modal-submit-primary">Atualizar Dados</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════ -->
<!-- MODAL: EXCLUIR ENTREGADOR                     -->
<!-- ═══════════════════════════════════════════════ -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-panel" style="max-width: 400px;">
            <div class="modal-header" style="justify-content: flex-end;">
                <button type="button" class="modal-close" id="closeDelete">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="modal-body" style="padding-top: 0;">
                <div class="modal-delete-icon">
                    <svg class="h-7 w-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <h2 class="modal-delete-title">Atenção!</h2>
                <p class="modal-delete-text">Tem certeza de que deseja excluir este entregador? Essa ação não poderá ser desfeita.</p>

                <form id="deleteForm" method="GET" action="<?= BASE_URL ?>/routes.php">
                    <input type="hidden" name="action" value="excluirEntregador">
                    <input type="hidden" id="delete_id" name="id">
                    <div class="flex gap-3">
                        <button type="button" id="cancelDelete" class="modal-submit modal-submit-cancel" style="flex:1;">Cancelar</button>
                        <button type="submit" class="modal-submit modal-submit-danger" style="flex:1;">Excluir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- FAB MOBILE -->
<div class="entregador-add-fab md:hidden">
    <button type="button" id="fabAddMotoboy">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
        </svg>
        Adicionar
    </button>
</div>

<script>
    // ─── Formatação ───
    function formatCPF(cpf) {
        cpf = cpf.replace(/\D/g, "");
        cpf = cpf.replace(/^(\d{3})(\d)/, "$1.$2");
        cpf = cpf.replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3");
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
        return cpf;
    }

    function formatPhone(phone) {
        phone = phone.replace(/\D/g, "");
        phone = phone.replace(/^(\d{2})(\d)/g, "($1) $2");
        phone = phone.replace(/(\d)(\d{4})$/, "$1-$2");
        return phone;
    }

    // ─── Sidebar Mobile ───
    const menuBtn = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const overlay = document.getElementById('overlay');

    if (menuBtn && sidebar && overlay) {
        menuBtn.addEventListener('click', () => {
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
        });
        closeSidebar.addEventListener('click', () => {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        });
    }

    // ─── Modal Helpers ───
    function openModal(id) {
        document.getElementById(id).classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function closeModal(id) {
        document.getElementById(id).classList.remove('active');
        document.body.style.overflow = '';
    }

    // ─── NEW MOTOBOY MODAL ───
    const openNewBtn = document.getElementById('openNewMotoboyModal');
    const fabAddBtn = document.getElementById('fabAddMotoboy');
    const closeNewBtn = document.getElementById('closeNewMotoboyModal');

    if (openNewBtn) openNewBtn.addEventListener('click', () => openModal('newMotoboyModal'));
    if (fabAddBtn) fabAddBtn.addEventListener('click', () => openModal('newMotoboyModal'));
    if (closeNewBtn) closeNewBtn.addEventListener('click', () => closeModal('newMotoboyModal'));

    // ─── EDIT MODAL ───
    const editModal = document.getElementById('editModal');
    const closeEditBtn = document.getElementById('closeEdit');

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit_id').value = this.dataset.id;
            document.getElementById('edit_nome_completo').value = this.dataset.nome;
            document.getElementById('edit_CPF').value = formatCPF(this.dataset.cpf);
            document.getElementById('edit_telefone').value = formatPhone(this.dataset.telefone);
            document.getElementById('edit_email').value = this.dataset.email;
            openModal('editModal');
        });
    });

    if (closeEditBtn) closeEditBtn.addEventListener('click', () => closeModal('editModal'));

    // ─── DELETE MODAL ───
    const deleteModal = document.getElementById('deleteModal');
    const closeDeleteBtn = document.getElementById('closeDelete');
    const cancelDeleteBtn = document.getElementById('cancelDelete');

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('delete_id').value = this.dataset.id;
            openModal('deleteModal');
        });
    });

    if (closeDeleteBtn) closeDeleteBtn.addEventListener('click', () => closeModal('deleteModal'));
    if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', () => closeModal('deleteModal'));

    // ─── Close modals on overlay click ───
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        });
    });

    // ─── SEARCH ───
    const searchInput = document.getElementById('searchInput');
    const entregadorCards = Array.from(document.querySelectorAll('.entregador-card'));
    const emptyState = document.getElementById('entregadoresEmptyState');
    const emptyTitle = document.getElementById('entregadoresEmptyTitle');
    const retryButton = document.getElementById('entregadoresRetry');
    const entregadoresCount = document.getElementById('entregadoresCount');
    const entregadoresGrid = document.getElementById('entregadoresGrid');

    function filterEntregadores() {
        const query = searchInput.value.trim().toLocaleLowerCase('pt-BR');
        let visibleCount = 0;

        entregadorCards.forEach(card => {
            const matchesSearch = card.dataset.search.toLocaleLowerCase('pt-BR').includes(query);
            card.hidden = !matchesSearch;
            visibleCount += Number(matchesSearch);
        });

        const showEmptyState = visibleCount === 0;
        emptyState.hidden = !showEmptyState;
        if (entregadoresGrid) entregadoresGrid.hidden = showEmptyState && entregadorCards.length > 0 ? false : (entregadorCards.length === 0);

        entregadoresCount.textContent = `${visibleCount} ${visibleCount === 1 ? 'entregador' : 'entregadores'}`;
        emptyTitle.textContent = entregadorCards.length > 0 && showEmptyState
            ? 'Nenhum entregador corresponde à busca'
            : 'Nenhum entregador cadastrado';
        retryButton.textContent = entregadorCards.length > 0 && showEmptyState
            ? 'Limpar busca'
            : 'Tentar novamente';
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterEntregadores);
    }

    if (retryButton) {
        retryButton.addEventListener('click', () => {
            if (entregadorCards.length > 0) {
                searchInput.value = '';
                filterEntregadores();
                return;
            }
            window.location.reload();
        });
    }
</script>

    <?php
    $logoEmpresaDashboard = '';
    if (isset($empresa['nome_arquivo'])) {
        $logoEmpresaDashboard = BASE_URL . '/public/uploads/empresas/' . htmlspecialchars($empresa['nome_arquivo']);
    } elseif (isset($company_id) && isset($this->empresaModel)) {
        $empresaInfo = $this->empresaModel->getById($company_id);
        if (!empty($empresaInfo['nome_arquivo'])) {
            $logoEmpresaDashboard = BASE_URL . '/public/uploads/empresas/' . htmlspecialchars($empresaInfo['nome_arquivo']);
        }
    } elseif (isset($_SESSION['company_id']) && isset($pdo)) {
        try {
            $stmtLogo = $pdo->prepare("SELECT nome_arquivo FROM empresa WHERE id_empresa = :id");
            $stmtLogo->execute([':id' => $_SESSION['company_id']]);
            $arqLogo = $stmtLogo->fetchColumn();
            if ($arqLogo) {
                $logoEmpresaDashboard = BASE_URL . '/public/uploads/empresas/' . htmlspecialchars($arqLogo);
            }
        } catch (\Exception $e) {}
    }
    ?>
    <script>
        window.GUIAR_EMPRESA_LOGO = <?= json_encode($logoEmpresaDashboard) ?>;
    </script>
    <script src="<?= BASE_URL ?>/public/js/empresa-palette.js"></script>
</body>
</html>