export default async function run(page, ui) {
  const aboutSection = page.locator('#tentang');
  await aboutSection.scrollIntoViewIfNeeded();
  await page.waitForTimeout(400);
  await aboutSection.screenshot({ path: 'D:/Jobs/Nirwana-Tour-Lampung/screenshot-about.png' });
  return { done: true };
}
