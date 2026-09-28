/**
 * GUIAR - Sistema de Paleta Dinâmica da Empresa
 * Extração de cores da logo via JavaScript e aplicação exclusiva em escolher.php e dashboard.php.
 * 
 * Regra do projeto: Não altera regras de negócio do backend; funciona 100% via JavaScript no cliente.
 */
(function () {
    'use strict';

    const STORAGE_KEY_PALETTE = 'guiar_empresa_palette';
    const STORAGE_KEY_LOGO_URL = 'guiar_empresa_logo_url';
    const STORAGE_KEY_LOGO_DATA = 'guiar_empresa_logo_data';

    // ==========================================
    // UTILITÁRIOS DE COR (Manipulação matemática)
    // ==========================================

    function rgbToHex(r, g, b) {
        return '#' + [r, g, b].map(x => {
            const hex = Math.max(0, Math.min(255, Math.round(x))).toString(16);
            return hex.length === 1 ? '0' + hex : hex;
        }).join('').toUpperCase();
    }

    function hexToRgb(hex) {
        if (!hex) return { r: 79, g: 70, b: 229 };
        hex = hex.replace(/^#/, '');
        if (hex.length === 3) {
            hex = hex.split('').map(c => c + c).join('');
        }
        const num = parseInt(hex, 16);
        if (isNaN(num)) return { r: 79, g: 70, b: 229 };
        return {
            r: (num >> 16) & 255,
            g: (num >> 8) & 255,
            b: num & 255
        };
    }

    function getLuminance(hex) {
        const { r, g, b } = hexToRgb(hex);
        return 0.299 * r + 0.587 * g + 0.114 * b;
    }

    function darken(hex, amount) {
        const { r, g, b } = hexToRgb(hex);
        const factor = Math.max(0, 1 - amount);
        return rgbToHex(r * factor, g * factor, b * factor);
    }

    function lighten(hex, amount) {
        const { r, g, b } = hexToRgb(hex);
        return rgbToHex(
            r + (255 - r) * amount,
            g + (255 - g) * amount,
            b + (255 - b) * amount
        );
    }

    function rgba(hex, alpha) {
        const { r, g, b } = hexToRgb(hex);
        return `rgba(${r}, ${g}, ${b}, ${alpha})`;
    }

    function rgbToHsl(r, g, b) {
        r /= 255; g /= 255; b /= 255;
        const max = Math.max(r, g, b), min = Math.min(r, g, b);
        let h = 0, s = 0, l = (max + min) / 2;
        if (max !== min) {
            const d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            switch (max) {
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }
            h /= 6;
        }
        return { h: h * 360, s, l };
    }

    function hslToRgb(h, s, l) {
        h = (h % 360) / 360;
        if (h < 0) h += 1;
        let r, g, b;
        if (s === 0) {
            r = g = b = l;
        } else {
            const hue2rgb = (p, q, t) => {
                if (t < 0) t += 1;
                if (t > 1) t -= 1;
                if (t < 1 / 6) return p + (q - p) * 6 * t;
                if (t < 1 / 2) return q;
                if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
                return p;
            };
            const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            const p = 2 * l - q;
            r = hue2rgb(p, q, h + 1 / 3);
            g = hue2rgb(p, q, h);
            b = hue2rgb(p, q, h - 1 / 3);
        }
        return { r: Math.round(r * 255), g: Math.round(g * 255), b: Math.round(b * 255) };
    }

    function shiftHue(hex, degree) {
        const { r, g, b } = hexToRgb(hex);
        const hsl = rgbToHsl(r, g, b);
        const newRgb = hslToRgb(hsl.h + degree, Math.max(hsl.s, 0.65), Math.min(Math.max(hsl.l, 0.45), 0.60));
        return rgbToHex(newRgb.r, newRgb.g, newRgb.b);
    }

    // ==========================================
    // CONSTRUÇÃO DA ESTRUTURA DA PALETA
    // ==========================================

    function buildPalette(primaryHex, secondaryHex) {
        const primaryLum = getLuminance(primaryHex);
        const secondaryLum = getLuminance(secondaryHex);

        return {
            primary: primaryHex,
            primaryHover: darken(primaryHex, 0.12),
            primaryActive: darken(primaryHex, 0.22),
            primaryDark: darken(primaryHex, 0.35),
            primaryLight: lighten(primaryHex, 0.90), // Tom muito suave (10% de cor) para fundos de badges
            primaryLightBorder: lighten(primaryHex, 0.72), // Borda suave
            primaryGhost: rgba(primaryHex, 0.08),
            primaryRing: rgba(primaryHex, 0.28),
            primaryContrast: primaryLum > 165 ? '#0F172A' : '#FFFFFF',

            secondary: secondaryHex,
            secondaryHover: darken(secondaryHex, 0.12),
            secondaryLight: lighten(secondaryHex, 0.90),
            secondaryGhost: rgba(secondaryHex, 0.10),
            secondaryContrast: secondaryLum > 165 ? '#0F172A' : '#FFFFFF'
        };
    }

    // ==========================================
    // EXTRAÇÃO DE CORES DA IMAGEM VIA CANVAS
    // ==========================================

    function extractPaletteFromImage(img, callback) {
        try {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const maxDim = 120;
            let w = img.naturalWidth || img.width || 100;
            let h = img.naturalHeight || img.height || 100;

            if (w > maxDim || h > maxDim) {
                if (w > h) {
                    h = Math.round((h * maxDim) / w);
                    w = maxDim;
                } else {
                    w = Math.round((w * maxDim) / h);
                    h = maxDim;
                }
            }

            canvas.width = Math.max(1, w);
            canvas.height = Math.max(1, h);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

            const imgData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
            const colorBins = {};
            const step = 20;

            for (let i = 0; i < imgData.length; i += 4) {
                const r = imgData[i];
                const g = imgData[i + 1];
                const b = imgData[i + 2];
                const a = imgData[i + 3];

                // Ignora pixels transparentes
                if (a < 90) continue;

                const max = Math.max(r, g, b);
                const min = Math.min(r, g, b);
                const delta = max - min;
                const lum = (max + min) / (2 * 255);
                const sat = delta === 0 ? 0 : delta / (255 * (1 - Math.abs(2 * lum - 1)));

                // Quantização em faixas de 20
                const qr = Math.min(255, Math.round(r / step) * step);
                const qg = Math.min(255, Math.round(g / step) * step);
                const qb = Math.min(255, Math.round(b / step) * step);
                const key = `${qr},${qg},${qb}`;

                if (!colorBins[key]) {
                    colorBins[key] = {
                        r: qr,
                        g: qg,
                        b: qb,
                        count: 0,
                        sat: sat,
                        lum: lum,
                        isWhite: r > 240 && g > 240 && b > 240,
                        isBlack: r < 25 && g < 25 && b < 25,
                        isGray: delta < 18
                    };
                }
                colorBins[key].count++;
            }

            const candidates = Object.values(colorBins);
            if (candidates.length === 0) {
                callback(buildPalette('#4F46E5', '#FFD400'));
                return;
            }

            // Ponderação inteligente para encontrar a cor de maior identidade de marca
            candidates.forEach(c => {
                let weight = 1.0;
                if (c.isWhite) {
                    weight = 0.005; // Evita que fundos brancos dominem
                } else if (c.isBlack) {
                    weight = 0.08;  // Evita que preto domine a menos que seja logo monocromática
                } else if (c.isGray) {
                    weight = 0.25;
                } else {
                    weight = 1.5 + (c.sat * 3.0);
                    if (c.lum >= 0.20 && c.lum <= 0.80) {
                        weight += 1.2;
                    }
                }
                c.score = c.count * weight;
            });

            candidates.sort((a, b) => b.score - a.score);

            const primaryCandidate = candidates[0];
            const primaryHex = rgbToHex(primaryCandidate.r, primaryCandidate.g, primaryCandidate.b);

            // Segunda cor: deve ter distância perceptível da cor primária
            let secondaryHex = null;
            for (let i = 1; i < candidates.length; i++) {
                const c = candidates[i];
                if (c.isWhite) continue;

                const dist = Math.sqrt(
                    Math.pow(c.r - primaryCandidate.r, 2) +
                    Math.pow(c.g - primaryCandidate.g, 2) +
                    Math.pow(c.b - primaryCandidate.b, 2)
                );

                if (dist > 75) {
                    secondaryHex = rgbToHex(c.r, c.g, c.b);
                    break;
                }
            }

            // Caso a logo tenha apenas 1 tom, gera uma secundária harmoniosa
            if (!secondaryHex || secondaryHex === primaryHex) {
                secondaryHex = shiftHue(primaryHex, 40);
            }

            const palette = buildPalette(primaryHex, secondaryHex);
            callback(palette);
        } catch (err) {
            console.warn('Aviso: Falha ao extrair cores via canvas (CORS ou formato). Usando paleta padrão.', err);
            callback(buildPalette('#4F46E5', '#FFD400'));
        }
    }

    // ==========================================
    // PERSISTÊNCIA EM LOCALSTORAGE
    // ==========================================

    function savePalette(palette, logoUrlOrData) {
        try {
            localStorage.setItem(STORAGE_KEY_PALETTE, JSON.stringify(palette));
            if (logoUrlOrData) {
                if (logoUrlOrData.startsWith('data:')) {
                    localStorage.setItem(STORAGE_KEY_LOGO_DATA, logoUrlOrData);
                } else {
                    localStorage.setItem(STORAGE_KEY_LOGO_URL, logoUrlOrData);
                }
            }
        } catch (e) {
            console.error('Erro ao salvar paleta no localStorage:', e);
        }
    }

    function getStoredPalette() {
        try {
            const raw = localStorage.getItem(STORAGE_KEY_PALETTE);
            return raw ? JSON.parse(raw) : null;
        } catch (e) {
            return null;
        }
    }

    // ==========================================
    // APLICAÇÃO DO TEMA EM ESCOLHER.PHP E DASHBOARD.PHP
    // ==========================================

    function applyDynamicTheme(palette, pageType) {
        if (!palette || !palette.primary) return;

        let styleTag = document.getElementById('empresa-dynamic-theme');
        if (!styleTag) {
            styleTag = document.createElement('style');
            styleTag.id = 'empresa-dynamic-theme';
            document.head.appendChild(styleTag);
        }

        const cssVars = `
            :root {
                --emp-primary: ${palette.primary};
                --emp-primary-hover: ${palette.primaryHover};
                --emp-primary-active: ${palette.primaryActive};
                --emp-primary-dark: ${palette.primaryDark};
                --emp-primary-light: ${palette.primaryLight};
                --emp-primary-light-border: ${palette.primaryLightBorder};
                --emp-primary-ring: ${palette.primaryRing};
                --emp-primary-contrast: ${palette.primaryContrast};

                --emp-secondary: ${palette.secondary};
                --emp-secondary-hover: ${palette.secondaryHover};
                --emp-secondary-light: ${palette.secondaryLight};
                --emp-secondary-contrast: ${palette.secondaryContrast};
            }
        `;

        let pageCss = '';

        if (pageType === 'escolher') {
            pageCss = `
                /* Nome da Empresa em Destaque */
                header strong.text-\\[\\#1B138F\\],
                header strong.text-brand-blue,
                .empresa-nome-highlight {
                    color: var(--emp-primary) !important;
                }

                /* Botão Novo Administrador */
                button[data-target="#addAdminModal"] {
                    background-color: var(--emp-secondary) !important;
                    color: var(--emp-secondary-contrast) !important;
                    transition: all 0.2s ease !important;
                }
                button[data-target="#addAdminModal"]:hover {
                    background-color: var(--emp-secondary-hover) !important;
                    transform: translateY(-1px);
                }

                /* Badge "Administrador" nos Cards */
                .admin-card span.inline-block {
                    background-color: var(--emp-primary-light) !important;
                    color: var(--emp-primary) !important;
                    border-color: var(--emp-primary-light-border) !important;
                }

                /* Botão Entrar dos Cards */
                .admin-card button[data-target="#loginModal"] {
                    border-color: var(--emp-primary) !important;
                    color: var(--emp-primary) !important;
                    background-color: transparent !important;
                    transition: all 0.2s ease !important;
                }
                .admin-card button[data-target="#loginModal"]:hover {
                    background-color: var(--emp-primary) !important;
                    color: var(--emp-primary-contrast) !important;
                }

                /* Botões Principais dos Modais (Login e Adicionar) */
                #adminLoginForm button[type="submit"],
                #addAdminModal button[type="submit"] {
                    background-color: var(--emp-primary) !important;
                    color: var(--emp-primary-contrast) !important;
                    border: none !important;
                    transition: all 0.2s ease !important;
                }
                #adminLoginForm button[type="submit"]:hover,
                #addAdminModal button[type="submit"]:hover {
                    background-color: var(--emp-primary-hover) !important;
                }

                /* Foco nos Inputs dos Modais */
                .modal-input:focus {
                    border-color: var(--emp-primary) !important;
                    box-shadow: 0 0 0 4px var(--emp-primary-ring) !important;
                }

                /* Foco no Campo de Busca */
                div:has(> #searchInput):focus-within {
                    border-color: var(--emp-primary) !important;
                    box-shadow: 0 0 0 3px var(--emp-primary-ring) !important;
                }
            `;
        } else if (pageType === 'dashboard') {
            pageCss = `
                /* ========================================================
                   REGRAS GERAIS DO DASHBOARD & SIDEBAR (Todas as 6 telas)
                   ======================================================== */

                /* Sidebar: Item Ativo (Início, Pedidos, Mapa, Perfil, etc) */
                #sidebar a.menu-item.bg-\\[\\#FFD400\\],
                #sidebar a.menu-item.bg-brand-yellow,
                #sidebar a.menu-item.active,
                #sidebar a[href*="dashboardAdm"].bg-\\[\\#FFD400\\] {
                    background-color: var(--emp-primary) !important;
                    color: var(--emp-primary-contrast) !important;
                    box-shadow: 0 10px 15px -3px var(--emp-primary-ring) !important;
                }
                #sidebar a.menu-item.bg-\\[\\#FFD400\\] svg,
                #sidebar a.menu-item.bg-brand-yellow svg,
                #sidebar a.menu-item.active svg {
                    color: var(--emp-primary-contrast) !important;
                }
                .active-menu {
                    border-left-color: var(--emp-primary) !important;
                    color: var(--emp-primary) !important;
                }

                /* Avatar com iniciais do Admin no rodapé da Sidebar */
                #sidebar .w-10.h-10.rounded-full.bg-\\[\\#FFD400\\],
                #sidebar .w-10.h-10.rounded-full.bg-brand-yellow {
                    background-color: var(--emp-secondary) !important;
                    color: var(--emp-secondary-contrast) !important;
                }

                /* Headers Gerais: Nome do Admin ou Destaques */
                header h1 span.text-\\[\\#1B138F\\],
                header h1 span.text-brand-blue,
                header span.text-\\[\\#1B138F\\] {
                    color: var(--emp-primary) !important;
                }

                /* Headers Gerais: Botão de Logout */
                header a[href*="logoutAdm"],
                header a[href*="sair"] {
                    background-color: var(--emp-secondary) !important;
                    color: var(--emp-secondary-contrast) !important;
                    transition: all 0.2s ease !important;
                }
                header a[href*="logoutAdm"]:hover,
                header a[href*="sair"]:hover {
                    background-color: var(--emp-secondary-hover) !important;
                }

                /* Header: Foco na barra de busca */
                header div:has(> #campoBuscaPedidos):focus-within {
                    border-color: var(--emp-primary) !important;
                    box-shadow: 0 0 0 3px var(--emp-primary-ring) !important;
                }

                /* Indicadores / Stat Cards (Ícones em tom índigo) */
                .bg-indigo-50 {
                    background-color: var(--emp-primary-light) !important;
                }
                .text-indigo-500,
                .text-indigo-600,
                .text-indigo-700 {
                    color: var(--emp-primary) !important;
                }
                .bg-indigo-100 {
                    background-color: var(--emp-primary-light) !important;
                }

                /* Tabela de Pedidos Recentes (dashboard.php) */
                td.text-indigo-600 {
                    color: var(--emp-primary) !important;
                }
                a[href*="pedidos"].text-indigo-600 {
                    color: var(--emp-primary) !important;
                }
                a[href*="pedidos"].text-indigo-600:hover {
                    color: var(--emp-primary-dark) !important;
                }
                #filtroStatus:focus {
                    border-color: var(--emp-primary) !important;
                    box-shadow: 0 0 0 2px var(--emp-primary-ring) !important;
                }

                /* Links de Ação (Ver todos entregadores) */
                a[href*="entregadores"].text-indigo-600 {
                    color: var(--emp-primary) !important;
                }
                a[href*="entregadores"].text-indigo-600:hover {
                    color: var(--emp-primary-dark) !important;
                }

                /* GUIAR Academy Tag */
                span.text-\\[\\#1B138F\\] {
                    color: var(--emp-primary) !important;
                }

                /* ========================================================
                   TELA: mapa.php
                   ======================================================== */
                .bg-orange-100.text-orange-600,
                #totalDriversBadge {
                    background-color: var(--emp-primary-light) !important;
                    color: var(--emp-primary) !important;
                }
                .delivery-marker {
                    background: var(--emp-primary) !important;
                }
                .pulse-ring {
                    border-color: var(--emp-primary) !important;
                }

                /* ========================================================
                   TELA: meuPerfil.php
                   ======================================================== */
                /* Borda da foto de perfil */
                img.border-4.border-\\[\\#FFD400\\] {
                    border-color: var(--emp-secondary) !important;
                }
                /* Botão Editar Perfil */
                #openEditModalBtn,
                button.bg-\\[\\#fc8835\\] {
                    background-color: var(--emp-secondary) !important;
                    color: var(--emp-secondary-contrast) !important;
                    transition: all 0.2s ease !important;
                }
                #openEditModalBtn:hover,
                button.bg-\\[\\#fc8835\\]:hover {
                    background-color: var(--emp-secondary-hover) !important;
                }
                /* Botão Salvar no Modal do Perfil */
                #editProfileModal button[type="submit"] {
                    background-color: var(--emp-primary) !important;
                    color: var(--emp-primary-contrast) !important;
                    transition: all 0.2s ease !important;
                }
                #editProfileModal button[type="submit"]:hover {
                    background-color: var(--emp-primary-hover) !important;
                }
                #editProfileModal input:focus {
                    border-color: var(--emp-primary) !important;
                    box-shadow: 0 0 0 3px var(--emp-primary-ring) !important;
                }

                /* ========================================================
                   TELA: pedidos.php
                   ======================================================== */
                .fixed-buttons button {
                    background: var(--emp-primary) !important;
                    color: var(--emp-primary-contrast) !important;
                    box-shadow: 0 10px 30px var(--emp-primary-ring) !important;
                }
                .fixed-buttons button:hover {
                    background: var(--emp-primary-hover) !important;
                }
                .status {
                    color: var(--emp-primary) !important;
                }
                .form-group button,
                form[action*="Pedido"] button[type="submit"] {
                    background: var(--emp-primary) !important;
                    color: var(--emp-primary-contrast) !important;
                }
                .form-group button:hover,
                form[action*="Pedido"] button[type="submit"]:hover {
                    background: var(--emp-primary-hover) !important;
                }
                .form-group input:focus,
                .form-group textarea:focus,
                select:focus {
                    border-color: var(--emp-primary) !important;
                }
                input[type="checkbox"] {
                    accent-color: var(--emp-primary) !important;
                }

                /* ========================================================
                   TELA: pedidosEntregues.php
                   ======================================================== */
                .border-l-4.border-l-\\[\\#fc8835\\] {
                    border-left-color: var(--emp-primary) !important;
                }
                .text-\\[\\#fc8835\\] {
                    color: var(--emp-primary) !important;
                }

                /* ========================================================
                   TELA: entregadores.php
                   ======================================================== */
                #openNewMotoboyModal,
                button.bg-\\[\\#FFC107\\] {
                    background-color: var(--emp-secondary) !important;
                    color: var(--emp-secondary-contrast) !important;
                }
                #openNewMotoboyModal:hover,
                button.bg-\\[\\#FFC107\\]:hover {
                    background-color: var(--emp-secondary-hover) !important;
                }
                button[onclick*="newMotoboyModal"] {
                    background-color: var(--emp-secondary) !important;
                    color: var(--emp-secondary-contrast) !important;
                    box-shadow: 0 8px 30px var(--emp-secondary-light) !important;
                }
                #searchInput:focus {
                    box-shadow: 0 0 0 2px var(--emp-primary-ring) !important;
                }
                #newMotoboyForm button[type="submit"],
                #newMotoboyModal button[type="submit"] {
                    background-color: var(--emp-primary) !important;
                    color: var(--emp-primary-contrast) !important;
                }
                .motoboy-card .bg-blue-50.text-blue-600 {
                    background-color: var(--emp-primary-light) !important;
                    color: var(--emp-primary) !important;
                }
                .motoboy-card .btn-edit {
                    color: var(--emp-primary) !important;
                    border-color: var(--emp-primary-light-border) !important;
                }
                .motoboy-card .btn-edit:hover {
                    background-color: var(--emp-primary-light) !important;
                }
                #newMotoboyModal input:focus {
                    box-shadow: 0 0 0 2px var(--emp-primary-ring) !important;
                }
            `;
        }

        styleTag.textContent = cssVars + pageCss;

        // Atualização dos elementos SVG do gráfico no Dashboard (se presente)
        if (pageType === 'dashboard') {
            updateDashboardCharts(palette);
        }
    }

    function updateDashboardCharts(palette) {
        // Atualiza elementos específicos do SVG do gráfico
        const chartStop = document.querySelector('#chartGradient stop[offset="0%"]');
        if (chartStop) {
            chartStop.setAttribute('stop-color', palette.primary);
        }

        const chartPaths = document.querySelectorAll('svg path[stroke="#4F46E5"]');
        chartPaths.forEach(path => path.setAttribute('stroke', palette.primary));

        const chartCircles = document.querySelectorAll('svg circle[fill="#4F46E5"]');
        chartCircles.forEach(circle => circle.setAttribute('fill', palette.primary));

        const chartTooltips = document.querySelectorAll('svg text[fill="#FFD400"]');
        chartTooltips.forEach(txt => txt.setAttribute('fill', palette.secondary));
    }

    // ==========================================
    // INICIALIZAÇÃO E IDENTIFICAÇÃO DA PÁGINA
    // ==========================================

    function detectCurrentPage() {
        const url = window.location.href.toLowerCase();

        if (document.getElementById('adminGrid') || url.includes('escolheradm') || url.includes('escolher.php')) {
            return 'escolher';
        }
        if (document.getElementById('cadaForm') || url.includes('cadastroempresa') || url.includes('cadastro.php')) {
            return 'cadastro';
        }
        // Suporte a todas as páginas do ecossistema do Dashboard:
        // dashboard.php, mapa.php, meuPerfil.php, pedidos.php, pedidosEntregues.php, entregadores.php
        if (
            document.getElementById('sidebar') ||
            document.getElementById('tabelaPedidos') ||
            url.includes('dashboard') ||
            url.includes('mapa') ||
            url.includes('perfil') ||
            url.includes('pedidos') ||
            url.includes('entregadores')
        ) {
            return 'dashboard';
        }
        return 'other';
    }

    function initCadastroPage() {
        const fileInput = document.getElementById('formFile');
        if (!fileInput) return;

        // Container para exibir prévia visual das cores capturadas ao usuário
        let previewBox = document.getElementById('empresaPalettePreview');
        if (!previewBox) {
            previewBox = document.createElement('div');
            previewBox.id = 'empresaPalettePreview';
            previewBox.style.display = 'none';
            fileInput.parentElement.appendChild(previewBox);
        }

        fileInput.addEventListener('change', function (e) {
            const file = e.target.files && e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (event) {
                const dataUrl = event.target.result;
                const img = new Image();
                img.onload = function () {
                    extractPaletteFromImage(img, function (palette) {
                        savePalette(palette, dataUrl);

                        // Exibe feedback elegante abaixo do input de arquivo
                        previewBox.style.display = 'block';
                        previewBox.innerHTML = `
                            <div class="mt-2.5 p-3 rounded-xl bg-slate-50 border border-slate-200 flex flex-wrap items-center justify-between gap-2 text-xs transition-all shadow-sm">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    <span class="font-bold text-slate-700">Cores da sua logo identificadas:</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-[11px] font-bold" style="background-color: ${palette.primaryLight}; color: ${palette.primary}; border-color: ${palette.primaryLightBorder}">
                                        <span class="w-3 h-3 rounded-full border border-black/10 inline-block" style="background-color: ${palette.primary}"></span>
                                        <span>Principal: ${palette.primary}</span>
                                    </div>
                                    <div class="flex items-center gap-1.5 px-2.5 py-1 rounded-lg border text-[11px] font-bold" style="background-color: ${palette.secondaryLight}; color: ${palette.secondary}; border-color: rgba(0,0,0,0.1)">
                                        <span class="w-3 h-3 rounded-full border border-black/10 inline-block" style="background-color: ${palette.secondary}"></span>
                                        <span>Secundária: ${palette.secondary}</span>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                };
                img.src = dataUrl;
            };
            reader.readAsDataURL(file);
        });
    }

    function initThemedPage(pageType) {
        // Tenta carregar paleta salva
        const storedPalette = getStoredPalette();

        if (storedPalette) {
            applyDynamicTheme(storedPalette, pageType);
        }

        // Se houver uma logo informada pelo backend (ex: empresa já cadastrada)
        const serverLogoUrl = window.GUIAR_EMPRESA_LOGO || '';
        const storedLogoUrl = localStorage.getItem(STORAGE_KEY_LOGO_URL);

        if (serverLogoUrl && serverLogoUrl.trim() !== '') {
            // Se a logo do servidor mudou ou ainda não temos paleta armazenada, extrai e sincroniza
            if (!storedPalette || storedLogoUrl !== serverLogoUrl) {
                const img = new Image();
                img.crossOrigin = 'Anonymous';
                img.onload = function () {
                    extractPaletteFromImage(img, function (palette) {
                        savePalette(palette, serverLogoUrl);
                        applyDynamicTheme(palette, pageType);
                    });
                };
                img.src = serverLogoUrl;
            }
        }
    }

    // Executa ao inicializar
    function init() {
        const pageType = detectCurrentPage();

        if (pageType === 'cadastro') {
            initCadastroPage();
        } else if (pageType === 'escolher' || pageType === 'dashboard') {
            initThemedPage(pageType);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    // Exposição global para chamadas pontuais se necessário
    window.EmpresaPalette = {
        extractFromImage: extractPaletteFromImage,
        applyTheme: applyDynamicTheme,
        savePalette: savePalette,
        getStoredPalette: getStoredPalette
    };
})();
