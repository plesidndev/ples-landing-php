# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
./run.sh <artist> [port]     # main dev entry; artist = default|callii|devadata|kayl|maf|lili
./run.sh lili 9000

npm run build                # compile Tailwind -> public/assets/app.css (minified)
npm run dev                  # same, in --watch mode

./tools/build-images.sh      # regenerate responsive WebP/JPEG/PNG derivatives

php -l <file>                # syntax check; there is no test suite, linter, or CI in this repo
```

`run.sh` creates `app/environment.php` from the example if missing, builds CSS if absent, and starts the server. It passes `public/index.php` as the router script so `robots.txt`, `sitemap.xml`, and the redirect rules behave locally the way they do behind Apache — plain `php -S -t public` skips all of that.

## Architecture

One codebase serves five artist microsites plus a `default` site, each on its own subdomain. Every site is a **single page**; there are no internal routes.

### Artist resolution (`app/bootstrap.php`)

Precedence: `ARTIST_ID` env var → `artist_id` in `app/environment.php` → hostname → `default`.

The hostname map is **derived from each artist's `default_url`** in `artists.php`, not maintained by hand, so adding an artist there registers its hostname automatically.

The `default` fallback is a silent failure mode worth knowing: it renders `noindex, nofollow`, serves `Disallow: /`, and canonicalises to `plesconnect.app`. An unknown or misspelled `artist_id` de-indexes the site rather than raising an error.

`plesconnect.app` is deliberately excluded from search **while it is only a logo placeholder** — indexing a thin page now would put a weak result on record before the real landing page ships. Indexability is the per-artist `indexable` flag, which drives both the robots meta tag and `robots.txt`. It is intentionally separate from `$isArtist` in `layout.php`: `$isArtist` gates the `MusicGroup`/`MusicRecording` JSON-LD, so the hub can be made indexable without also claiming to be a music release. When real hub content lands, flip `indexable` to true — do not reintroduce an `id === 'default'` check.

Note `$common + [...]` keeps `$common`'s value on key collision, so anything an artist must be able to override (like `indexable`) belongs in the artist's own array, not in `$common`.

### `app/artists.php` is the single source of truth

Every per-artist value lives here — copy, SEO metadata, DSP links, `same_as`, video, OG image and its dimensions, `genre`, LCP image. Adding an artist means one entry here plus one view in `app/views/artists/`. Prefer extending this config over branching inside templates.

Fields that carry real consequences:

- `genre` / `artist_same_as` — emitted as JSON-LD. Wrong values are incorrect structured data; leave `artist_same_as` empty rather than pointing it at track URLs (it is for artist profiles).
- `video.upload_date` — optional. `layout.php` emits `VideoObject` without it, which is valid but not eligible for video rich results. Only fill it with a real date.
- DSP links are opt-in per artist and every one is written as `['href' => '...', 'active' => true|false]`, so each platform's state is explicit. Setting `active` to false hides the card but keeps the URL. A bare URL string still works and counts as active, but prefer the explicit form to match the rest of the file. Card order follows `$dspBrands`, not the order links are written in.
- `same_as` is **derived** at the bottom of the file from the active platform hrefs plus `extra_same_as` (non-DSP URLs: YouTube, Instagram, found.ee). Do not hand-write `same_as` — deactivating a platform must remove it from both the buttons and the JSON-LD, and deriving is what guarantees that.
- `og_size` must match the actual pixel dimensions of `og_image`.
- `lcp_image` / `lcp_image_desktop` — when both are set, `layout.php` emits two `media`-scoped preloads. Only needed when the largest above-the-fold image differs between breakpoints (currently just devadata).

### Rendering

`public/index.php` → `app/bootstrap.php` (defines `$site`, `$environment`) → renders the artist view into `$content` → renders `layout` around it. `render()` in `app/helpers.php` is `extract()` + `require`, so view variables are passed as an array. Note `absolute_url()` and `site_last_modified()` reach for `global $site`, which resolves to the one bootstrap defines.

`index.php` also serves `/robots.txt`, `/sitemap.xml`, and `/manifest.webmanifest` dynamically — they are not files on disk.

Request handling order, all of it deliberate:

1. **Canonical origin.** A request whose scheme or host differs from the artist's `site_url` (http, `www.`, a server alias) 301s to the canonical URL, preserving path and query. `bootstrap.php` strips a leading `www.` before the hostname lookup so `www.<artist>` resolves to that artist rather than falling through to the noindex default. Only enforced when the canonical is https, so local http development is untouched.
2. **Genuine equivalents** (`/index.php`, `/index.html`) 301 to `/`.
3. **Everything else 404s** — a branded `app/views/not-found.php` for page paths, plain text for asset-looking paths (`\.[a-z0-9]{2,5}$`) so a missing image does not cost a full HTML render.

Do not "fix" step 3 by redirecting unknown paths to the home page. Serving the home page *under* a 404 is a soft 404, but so is mass-redirecting missing URLs to the home page — Google treats both the same way. A single-page site has exactly one real URL; everything else is genuinely missing.

`layout.php` accepts `robots`, `title`, and `isError` overrides so the 404 can suppress the JSON-LD, the LCP preload, and indexing without a second layout.

### Desktop layout pattern

All five artists share one structure, with KAYL as the reference implementation:

```
md:grid md:min-h-screen md:grid-cols-2
├── <section> image panel   — md:sticky md:top-0 md:h-screen, img object-cover
└── <div> content column    — md:min-h-screen md:pt-16, footer wrapped in md:mt-auto
```

The left image is pinned with `sticky` and the **page** scrolls. Do not reintroduce `overflow-y-auto` on the content column — nested scroll containers give two scrollbars, chain badly on trackpads, and need focus before keyboard scroll works. The visual result is identical.

Mobile is the same markup unstacked, so content order in the right column is also the mobile order below the image.

## Asset conventions

**Compiled CSS is committed on purpose** — production runs PHP only, with no Node. After changing any template or Tailwind style, run `npm run build` and commit `public/assets/app.css`. Tailwind scans the `@source` globs declared in `resources/css/app.css`.

The compiled CSS is **inlined** into `<style>` by `inline_css()`, not linked — it is the only render-blocking request the page would otherwise have, and these are single-visit landing pages where a cached stylesheet rarely pays off. `layout.php` falls back to a `<link>` if the file cannot be read. `asset_url()` still appends `?v=<filemtime>` to the JS, which is what allows `.htaccess` to cache it for a year.

Layout images go through `responsive_img($src, $alt, $sizes, $attrs)`, which emits a `<picture>` with a WebP source plus the original format, building both srcsets from whatever `<name>-<width>.<ext>` files `./tools/build-images.sh` produced. Add a new source to the `SOURCES` list in that script, re-run it, and commit the derivatives — production has no image pipeline, same reason the CSS is committed.

The LCP preload uses `preload_image()`, which shares `image_srcset()` with `responsive_img()` so the preload and the render pick the same file. A plain `<link rel="preload" href="...">` next to a `srcset` downloads two images; do not reintroduce one.

Images keep stable filenames and get a one-month cache, so a changed image needs a new filename to bust caches.

Image format rule: opaque photos are JPEG, genuine transparency stays PNG. `sips -g hasAlpha` reports an alpha *channel*, which photos routinely carry unused — decode and check whether any pixel is actually non-opaque before converting, or you will convert something that needs its transparency. `sips` also flattens alpha to **white**, so an image destined for a coloured background must be composited first.

## Deployment (Hostinger hPanel)

The repository sits *beside* `public_html`, and only `public/` is copied in:

```
domains/<subdomain>/
├── ples-landing-php/     # git clone; app/ stays outside the web root
└── public_html/          # rsync -a public/ ../public_html/
```

`public/index.php` locates the bootstrap at `../app/bootstrap.php` (local) or `../ples-landing-php/app/bootstrap.php` (deployed) — renaming the repo directory breaks the deployed path unless `$deployedApp` is updated.

`app/environment.php` is gitignored, lives outside the web root, and holds `artist_id`, `site_url`, `ga_id`, `google_site_verification`. It is created once per host and survives pulls. See `docs/DEPLOY_HOSTINGER.md`.

The HTTPS redirect block in `public/.htaccess` is intentionally commented out; Hostinger's "Force HTTPS" handles it, and enabling both risks a redirect loop behind the proxy.
