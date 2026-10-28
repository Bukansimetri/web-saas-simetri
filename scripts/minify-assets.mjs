// Minify the theme's unminified CSS/JS. Re-run after editing any source file:  node scripts/minify-assets.mjs
// CSS -> public/assets/css/<name>.min.css (same folder, so relative font/image urls keep working)
// JS  -> public/assets/js/min/<name>.js
import { transformSync } from 'esbuild';
import { readFileSync, writeFileSync, mkdirSync } from 'node:fs';

const css = ['fontawesome', 'flaticon', 'pbminfotech-base-icons', 'themify-icons', 'magnific-popup', 'twentytwenty', 'aos', 'shortcode', 'base', 'style', 'responsive'];
const js = ['circle-progress', 'aos', 'gsap', 'ScrollTrigger', 'SplitText', 'magnetic', 'gsap-animation', 'jquery.appear', 'jquery.event.move', 'jquery.twentytwenty', 'scripts'];
const kb = (n) => (n / 1024).toFixed(1) + 'KB';

mkdirSync('public/assets/js/min', { recursive: true });
for (const n of css) {
    const src = readFileSync(`public/assets/css/${n}.css`, 'utf8');
    const out = transformSync(src, { loader: 'css', minify: true }).code;
    writeFileSync(`public/assets/css/${n}.min.css`, out);
    console.log(`css/${n}: ${kb(src.length)} -> ${kb(out.length)}`);
}
// Render-blocking theme CSS as one file, in the original <link> order
const bundle = ['bootstrap.min', 'fontawesome.min', 'flaticon.min', 'pbminfotech-base-icons.min', 'themify-icons.min', 'swiper.min', 'aos.min', 'shortcode.min', 'base.min', 'style.min', 'responsive.min']
    .map((n) => readFileSync(`public/assets/css/${n}.css`, 'utf8'))
    .join('\n');
writeFileSync('public/assets/css/bundle.min.css', bundle);
console.log(`css/bundle: ${kb(bundle.length)}`);

for (const n of js) {
    const src = readFileSync(`public/assets/js/${n}.js`, 'utf8');
    const out = transformSync(src, { minify: true, target: 'es2017', legalComments: 'none' }).code;
    writeFileSync(`public/assets/js/min/${n}.js`, out);
    console.log(`js/${n}: ${kb(src.length)} -> ${kb(out.length)}`);
}
