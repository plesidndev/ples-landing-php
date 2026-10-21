# Ples+ Landing PHP

Plain PHP 8.3, Tailwind CSS 4, and vanilla JavaScript version of the artist landing pages.

## Local development

The quickest way to start the site is:

```bash
./run.sh lili
```

The first argument is the artist and the optional second argument is the port:

```bash
./run.sh maf 9000
```

The script creates the local environment file when needed, builds missing CSS, and starts the PHP server. Available artists are `default`, `arta`, `callii`, `devadata`, `blingsatan`, `kayl`, `maf`, and `lili`.

You can also run the setup manually:

```bash
cp app/environment.example.php app/environment.php
npm install
npm run build
ARTIST_ID=lili php -S localhost:8080 -t public
```

Use `arta`, `callii`, `devadata`, `blingsatan`, `kayl`, `maf`, `lili`, or `default` for `ARTIST_ID`. Environment variables take precedence over `app/environment.php`; the file is ignored by Git.

## Photo carousel

Render `components/photo-carousel` with `photos`, an optional accessible `label`, and an optional `className` for page spacing:

```php
render('components/photo-carousel', [
    'photos' => [
        ['src' => '/images/artist/photo.jpg', 'alt' => 'Band portrait'],
        ['src' => '/images/artist/side.png', 'centerSrc' => '/images/artist/original.jpg', 'alt' => 'Live performance'],
    ],
    'label' => 'Artist photo gallery',
]);
```

The carousel uses a locally hosted Swiper 12 bundle with `effect: 'coverflow'`. The active photo stays centered and upright while side cards rotate in 3D. Supply `centerSrc` for an original untransformed image, or `centerTransform` for an inverse CSS perspective matrix calibrated for the 144px card. The correction applies to every card before Swiper adds its coverflow effect; `centerSrc` takes precedence. Controls follow the photo count, with swipe, scoped arrow keys and continuous looping for two or more photos. Small galleries repeat their slides to keep both sides filled, while dots and announcements still use the original photo count; empty galleries render nothing and single photos have no controls.

`npm run build` and `npm run dev` copy Swiper JS, CSS and its license into `public/assets/vendor/swiper/`. Commit these files with the compiled CSS so production only needs PHP. Swiper loads only on pages containing a photo carousel.

The compiled CSS is committed intentionally, so production only needs PHP. Run `npm run build` and commit `public/assets/app.css` after changing templates or Tailwind styles.

## hPanel layout

Clone the repository beside `public_html`:

```text
/home/u123456/domains/example.com/
├── ples-landing-php/
└── public_html/
```

Pull the repository and deploy only the already-built public files:

```bash
cd /home/u123456/domains/example.com/ples-landing-php
git pull --ff-only
rsync -a public/ ../public_html/
```

On the first deployment only, copy `app/environment.example.php` to `app/environment.php`. Edit that private file with the artist, canonical URL, GA4 ID, and Google verification token. It remains outside the web root and future pulls will not overwrite it. If each known artist uses its configured production hostname, `artist_id` and `site_url` may be left empty.

The deployed `public_html/index.php` automatically loads `ples-landing-php/app/bootstrap.php`. If you rename the repository directory, update `$deployedApp` in `public/index.php`.

Do not upload `.git`, `node_modules`, source CSS, configuration, or the complete repository into `public_html`.
# ples-landing-php

## ARTA

Run `./run.sh arta 8090` to preview ARTA. Its production hostname is `arta.plesconnect.app`.

Official links will be supplied later: set `feature_platforms` for SLOWLY, `platforms` for ARZEN ZONE, and `feature_video` / `video` for the two YouTube slots in `app/artists.php`. Pending cards stay visible without a navigation target. Entering an `href` enables a DSP card; a YouTube `id` enables inline playback. Set each video's `poster` when the final artwork is available.
