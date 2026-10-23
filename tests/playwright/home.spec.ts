import { expect, test } from '@playwright/test';

test('home page renders the Vue app', async ({ page }) => {
    await page.goto('/');

    await expect(page).toHaveTitle(/^Rick and Morty/);
});
