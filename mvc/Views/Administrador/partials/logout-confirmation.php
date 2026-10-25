<?php
$logoutAction = $logoutAction ?? 'logoutAdm';
$logoutConfirmationTitle = $logoutConfirmationTitle ?? 'Sair da conta?';
$logoutConfirmationMessage = $logoutConfirmationMessage ?? 'Tem certeza de que deseja sair do seu perfil?';
?>
<div data-logout-confirmation class="hidden fixed inset-0 z-[80] flex items-center justify-center bg-slate-950/50 p-4" role="dialog" aria-modal="true" aria-labelledby="logoutConfirmationTitle" aria-describedby="logoutConfirmationMessage">
    <div class="w-full max-w-sm rounded-2xl bg-white p-6 shadow-2xl">
        <h2 id="logoutConfirmationTitle" class="text-lg font-bold text-slate-900"><?= htmlspecialchars($logoutConfirmationTitle, ENT_QUOTES, 'UTF-8') ?></h2>
        <p id="logoutConfirmationMessage" class="mt-2 text-sm text-slate-600"><?= htmlspecialchars($logoutConfirmationMessage, ENT_QUOTES, 'UTF-8') ?></p>
        <div class="mt-6 flex justify-end gap-3">
            <button type="button" data-logout-cancel class="rounded-xl border px-4 py-2 text-sm font-semibold transition hover:bg-slate-50" style="border-color: var(--emp-primary, #f3243e); color: var(--emp-primary, #f3243e);">
                NÃO
            </button>
            <a href="<?= BASE_URL ?>/routes.php?action=<?= rawurlencode($logoutAction) ?>" class="rounded-xl px-4 py-2 text-sm font-semibold transition hover:opacity-90" style="background-color: var(--emp-primary, #f3243e); color: var(--emp-primary-contrast, #ffffff);">
                SIM
            </a>
        </div>
    </div>
</div>
<script>
    (() => {
        const dialog = document.querySelector('[data-logout-confirmation]');
        const trigger = document.querySelector('[data-logout-trigger]');
        const cancel = dialog?.querySelector('[data-logout-cancel]');

        if (!dialog || !trigger || !cancel) return;

        const closeDialog = () => {
            dialog.classList.add('hidden');
            trigger.focus();
        };

        trigger.addEventListener('click', () => {
            dialog.classList.remove('hidden');
            cancel.focus();
        });

        cancel.addEventListener('click', closeDialog);
        dialog.addEventListener('click', (event) => {
            if (event.target === dialog) closeDialog();
        });
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !dialog.classList.contains('hidden')) {
                closeDialog();
            }
        });
    })();
</script>
<?php
unset($logoutAction, $logoutConfirmationTitle, $logoutConfirmationMessage);
?>
