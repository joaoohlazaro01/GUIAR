(() => {
    const panel = document.getElementById('contato');
    const launcher = document.getElementById('contato-abrir');
    const close = document.getElementById('contato-fechar');
    const form = document.getElementById('home-contato-form');
    if (!panel || !launcher || !form) return;

    const notice = document.getElementById('home-contato-aviso');
    const send = document.getElementById('home-contato-enviar');
    const sendText = document.getElementById('contato-enviar-texto');
    const message = document.getElementById('home-contato-mensagem');
    const token = form.elements.csrf_token;
    let tokenRequest;

    function showNotice(text, kind) {
        notice.textContent = text;
        notice.dataset.kind = kind;
        notice.classList.remove('hidden');
    }

    async function getToken() {
        if (!tokenRequest) {
            tokenRequest = fetch(form.action, { credentials: 'same-origin', cache: 'no-store' })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok || !data.csrf_token) throw new Error('token');
                    token.value = data.csrf_token;
                }).finally(() => { tokenRequest = null; });
        }
        return tokenRequest;
    }

    function togglePanel(open, restoreFocus = true) {
        panel.hidden = !open;
        launcher.setAttribute('aria-expanded', String(open));
        if (open) {
            document.getElementById('home-contato-nome').focus();
            if (!token.value) getToken().catch(() => {
                showNotice('Não foi possível conectar. Acesse o site pelo servidor e tente novamente.', 'error');
            });
        } else if (restoreFocus) launcher.focus();
    }

    launcher.addEventListener('click', () => togglePanel(panel.hidden));
    close.addEventListener('click', () => togglePanel(false));
    document.addEventListener('keydown', event => {
        if (event.key === 'Escape' && !panel.hidden) togglePanel(false);
    });
    document.addEventListener('click', event => {
        if (!panel.hidden && !panel.contains(event.target) && !launcher.contains(event.target)) {
            togglePanel(false, false);
        }
    });
    panel.addEventListener('focusout', event => {
        if (event.relatedTarget && !panel.contains(event.relatedTarget) && event.relatedTarget !== launcher) {
            togglePanel(false, false);
        }
    });
    const updateCounter = () => {
        document.getElementById('contato-contador').textContent = `${message.value.length.toLocaleString('pt-BR')} / 5.000 caracteres`;
    };
    message.addEventListener('input', updateCounter);

    form.addEventListener('submit', async event => {
        event.preventDefault();
        if (send.disabled || !form.reportValidity()) return;
        send.disabled = true;
        send.setAttribute('aria-busy', 'true');
        sendText.textContent = 'Enviando...';
        notice.classList.add('hidden');
        const controller = new AbortController();
        const timeout = setTimeout(() => controller.abort(), 45000);
        try {
            await getToken();
            const response = await fetch(form.action, {
                method: 'POST', body: new FormData(form), credentials: 'same-origin', signal: controller.signal
            });
            const data = await response.json();
            if (!response.ok || !data.success) {
                if (response.status === 403) token.value = '';
                showNotice(data.message || 'Não foi possível enviar. Tente novamente.', 'error');
                return;
            }
            form.reset();
            updateCounter();
            showNotice(data.message, 'success');
        } catch (error) {
            showNotice('Não foi possível confirmar o envio. Verifique sua conexão e tente novamente.', 'error');
        } finally {
            clearTimeout(timeout);
            send.disabled = false;
            send.setAttribute('aria-busy', 'false');
            sendText.textContent = 'Enviar mensagem';
        }
    });
})();
