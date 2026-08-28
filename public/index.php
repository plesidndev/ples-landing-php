<?php

declare(strict_types=1);

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Under `php -S ... public/index.php` this file is the router, so hand real files
// back to the built-in server the way Apache's rewrite conditions do in production.
if (PHP_SAPI === 'cli-server' && $path !== '/' && is_file(__DIR__ . $path)) {
    return false;
}

// Supports both local `php -S -t public` and hPanel, where this repository sits beside public_html.
$localApp = dirname(__DIR__) . '/app/bootstrap.php';
$deployedApp = dirname(__DIR__) . '/ples-landing-php/app/bootstrap.php';
$bootstrap = is_file($localApp) ? $localApp : $deployedApp;

if (!is_file($bootstrap)) {
    http_response_code(500);
    exit('Application bootstrap not found.');
}

require $bootstrap;

if ($path === '/robots.txt') {
    header('Content-Type: text/plain; charset=utf-8');
    echo "User-agent: *\n";
    echo $site['id'] === 'default' ? "Disallow: /\n" : "Allow: /\nSitemap: {$site['url']}/sitemap.xml\n";
    exit;
}

if ($path === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>' . e($site['url']) . '</loc><lastmod>' . e(site_last_modified()) . '</lastmod><changefreq>weekly</changefreq><priority>1.0</priority></url></urlset>';
    exit;
}

if ($path === '/manifest.webmanifest') {
    header('Content-Type: application/manifest+json; charset=utf-8');
    echo json_encode([
        'name' => $site['title'], 'short_name' => $site['name'], 'description' => $site['description'],
        'start_url' => '/', 'display' => 'standalone', 'background_color' => '#000000',
        'theme_color' => $site['theme_color'], 'icons' => [['src' => '/icon.svg', 'sizes' => 'any', 'type' => 'image/svg+xml']],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}

// A single-page site has exactly one real URL. Consolidate every other page path
// onto it instead of serving the full home page under a 404 (a soft 404), but let
// missing static assets 404 properly rather than redirecting them to HTML.
if ($path !== '/') {
    if (preg_match('/\.[a-z0-9]{2,5}$/i', $path)) {
        http_response_code(404);
        header('Content-Type: text/plain; charset=utf-8');
        exit("Not Found\n");
    }

    http_response_code(301);
    header('Location: ' . $site['url'] . '/');
    exit;
}

ob_start();
render($site['view'], ['site' => $site]);
$content = (string) ob_get_clean();

render('layout', compact('site', 'environment', 'content'));
