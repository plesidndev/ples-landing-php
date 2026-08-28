# Deploy KAYL to Hostinger

This guide deploys the KAYL landing page to:

```text
https://kayl.plesconnect.app
```

The PHP application is kept outside the public web directory. Only files from
the repository's `public` directory are copied into `public_html`.

## 1. Create the subdomain

In Hostinger hPanel:

1. Open **Websites** and select the website.
2. Open **Domains → Subdomains**.
3. Create `kayl.plesconnect.app`.
4. Set its document root to `public_html` for that subdomain.

The expected directory layout is:

```text
/home/YOUR_USERNAME/domains/kayl.plesconnect.app/
├── ples-landing-php/
└── public_html/
```

Replace `YOUR_USERNAME` with the Hostinger account username.

## 2. Set the PHP version

In hPanel, open **Websites → Manage → Advanced → PHP Configuration** and
select **PHP 8.3**.

## 3. Clone the repository

Open the Hostinger terminal or connect through SSH, then run:

```bash
cd /home/YOUR_USERNAME/domains/kayl.plesconnect.app
git clone YOUR_GIT_REPOSITORY_URL ples-landing-php
cd ples-landing-php
```

Replace `YOUR_GIT_REPOSITORY_URL` with the Git repository's SSH or HTTPS URL.

If the repository is private, configure an SSH deploy key or use Hostinger's
Git deployment feature before cloning it.

## 4. Create the production configuration

Copy the example environment file:

```bash
cp app/environment.example.php app/environment.php
```

Edit `app/environment.php` so it contains:

```php
<?php

return [
    'artist_id' => 'kayl',
    'site_url' => 'https://kayl.plesconnect.app',
    'ga_id' => '',
    'google_site_verification' => '',
];
```

Add the Google Analytics and site-verification values later if needed. This
file is ignored by Git and must remain outside `public_html`.

## 5. Copy the public files

From the `ples-landing-php` directory, run:

```bash
rsync -a public/ ../public_html/
```

This copies the compiled CSS, JavaScript, images, fonts, and public entry point.
Node.js and `npm install` are not required on Hostinger because the compiled CSS
is committed to the repository.

If `public_html` contains Hostinger's default page, the project's `index.php`
must replace the default `index.php`.

## 6. Enable HTTPS

In hPanel:

1. Open **Websites → Manage → Security → SSL**.
2. Install or enable SSL for `kayl.plesconnect.app`.
3. Enable **Force HTTPS** after the certificate becomes active.

## 7. Verify the deployment

Open these URLs:

```text
https://kayl.plesconnect.app
https://kayl.plesconnect.app/robots.txt
https://kayl.plesconnect.app/sitemap.xml
```

The home page should display the KAYL design. If it displays another artist,
confirm that `app/environment.php` contains `'artist_id' => 'kayl'`.

## Deploy future updates

After changes are pushed to Git, connect to Hostinger and run:

```bash
cd /home/YOUR_USERNAME/domains/kayl.plesconnect.app/ples-landing-php
git pull --ff-only
rsync -a public/ ../public_html/
```

Do not copy the complete repository, `.git`, `node_modules`, `resources`, or
`app/environment.php` into `public_html`.

## Common errors

### Application bootstrap not found

The deployed `public_html/index.php` expects the repository directory to be
named `ples-landing-php` and located beside `public_html`:

```text
ples-landing-php/app/bootstrap.php
public_html/index.php
```

If the repository has another directory name, rename it to `ples-landing-php`
or update `$deployedApp` in `public/index.php` before deploying.

### HTTP 500 error

Check that PHP 8.3 is enabled and that Hostinger can read:

```text
ples-landing-php/app/bootstrap.php
ples-landing-php/app/environment.php
```

Also check the error log under **hPanel → Advanced → Error Logs**.

### Styles or images are missing

Run the public-file copy again from inside the repository:

```bash
rsync -a public/ ../public_html/
```
