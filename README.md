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

The script creates the local environment file when needed, builds missing CSS, and starts the PHP server. Available artists are `default`, `callii`, `devadata`, `blingsatan`, `kayl`, `maf`, and `lili`.

You can also run the setup manually:

```bash
cp app/environment.example.php app/environment.php
npm install
npm run build
ARTIST_ID=lili php -S localhost:8080 -t public
```

Use `callii`, `devadata`, `blingsatan`, `kayl`, `maf`, `lili`, or `default` for `ARTIST_ID`. Environment variables take precedence over `app/environment.php`; the file is ignored by Git.

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

The active photo is centered in an upright square frame; side cards tilt and shrink. Supply `centerSrc` when `src` already contains a perspective effect, using the original untransformed photo. Alternatively, `centerTransform` accepts an asset-specific inverse CSS perspective matrix calibrated for the 144px active card. This correction only applies to the active image and is ignored when `centerSrc` is provided. Controls are generated from the photo count; empty galleries render nothing and single photos have no controls. Each carousel supports arrow keys and swiping independently.

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
