import { expect, test } from '@playwright/test';

test('home apresenta navegação e abre o formulário de contato', async ({ page }) => {
  await page.goto('/index.html');

  await expect(page).toHaveTitle('GUIAR');
  await expect(page.locator('nav a', { hasText: 'Empresa' })).toHaveAttribute(
    'href',
    'routes.php?action=loginEmpresa'
  );
  await expect(page.locator('#contato-abrir')).toBeVisible();

  await page.locator('#contato-abrir').click();
  await expect(page.locator('#contato')).toBeVisible();
  await expect(page.locator('#home-contato-form')).toBeVisible();

  await page.locator('#home-contato-nome').fill('Teste CI');
  await page.locator('#home-contato-email').fill('teste@example.com');
  await page.locator('#home-contato-mensagem').fill('Mensagem de teste do frontend.');
  await expect(page.locator('#home-contato-enviar')).toBeEnabled();

  await page.locator('#contato-fechar').click();
  await expect(page.locator('#contato')).toBeHidden();
});
