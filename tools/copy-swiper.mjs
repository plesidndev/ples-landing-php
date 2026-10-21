import { copyFileSync, mkdirSync } from 'node:fs';
import { fileURLToPath } from 'node:url';

const root = new URL('../', import.meta.url);
const destination = new URL('public/assets/vendor/swiper/', root);
mkdirSync(destination, { recursive: true });
for (const file of ['swiper-bundle.min.js', 'swiper-bundle.min.css', 'LICENSE']) {
  copyFileSync(fileURLToPath(new URL(`node_modules/swiper/${file}`, root)), new URL(file, destination));
}
