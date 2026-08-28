# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
./run.sh <artist> [port]     # main dev entry; artist = default|callii|devadata|kayl|maf|lili
./run.sh lili 9000

npm run build                # compile Tailwind -> public/assets/app.css (minified)
npm run dev                  # same, in --watch mode

php -l <file>                # syntax check; there is no test suite, linter, or CI in this repo
```

`run.sh` creates `app/environment.php` from the example if missing, builds CSS if absent, and starts the server. It passes `public/index.php` as the router script so `robots.txt`, `sitemap.xml`, and the redirect rules behave locally the way they do behind Apache — plain `php -S -t public` skips all of that.

## Architecture

One codebase serves five artist microsites plus a `default` site, each on its own subdomain. Every site is a **single page**; there are no internal routes.

### Artist resolution (`app/bootstrap.php`)

Precedence: `ARTIST_ID` env var → `artist_id` in `app/environment.php` → hostname → `default`.

The hostname map is **derived from each artist's `default_url`** in `artists.php`, not maintained by hand, so adding an artist there registers its hostname automatically.

The `default` fallback is a silent failure mode worth knowing: it renders `noindex, nofollow`, serves `Disallow: /`, and canonicalises to `plesconnect.app`. An unknown or misspelled `artist_id` de-indexes the site rather than raising an error.

### `app/artists.php` is the single source of truth

Every per-artist value lives here — copy, SEO metadata, DSP links, `same_as`, video, OG image and its dimensions, `genre`, LCP image. Adding an artist means one entry here plus one view in `app/views/artists/`. Prefer extending this config over branching inside templates.

Fields that carry real consequences:

- `genre` / `artist_same_as` — emitted as JSON-LD. Wrong values are incorrect structured data; leave `artist_same_as` empty rather than pointing it at track URLs (it is for artist profiles).
- `video.upload_date` — optional. `layout.php` emits `VideoObject` without it, which is valid but not eligible for video rich results. Only fill it with a real date.
- `og_size` must match the actual pixel dimensions of `og_image`.
- `lcp_image` / `lcp_image_desktop` — when both are set, `layout.php` emits two `media`-scoped preloads. Only needed when the largest above-the-fold image differs between breakpoints (currently just devadata).

### Rendering

`public/index.php` → `app/bootstrap.php` (defines `$site`, `$environment`) → renders the artist view into `$content` → renders `layout` around it. `render()` in `app/helpers.php` is `extract()` + `require`, so view variables are passed as an array. Note `absolute_url()` and `site_last_modified()` reach for `global $site`, which resolves to the one bootstrap defines.

`index.php` also serves `/robots.txt`, `/sitemap.xml`, and `/manifest.webmanifest` dynamically — they are not files on disk. Any other path 301s to the canonical root, except paths that look like assets (`\.[a-z0-9]{2,5}$`), which return a plain 404. This split is deliberate: serving the full home page under a 404 is a soft 404, and redirecting a missing image to an HTML page is worse than 404ing it.

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

`asset_url()` appends `?v=<filemtime>` to CSS/JS, which is what allows `.htaccess` to set a one-year cache on them. Images keep stable filenames and get one month, so a changed image needs a new filename to bust caches.

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
