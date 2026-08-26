<?php

declare(strict_types=1);

// Supports both local `php -S -t public` and hPanel, where this repository sits beside public_html.
$localApp = dirname(__DIR__) . '/app/bootstrap.php';
$deployedApp = dirname(__DIR__) . '/ples-landing-php/app/bootstrap.php';
$bootstrap = is_file($localApp) ? $localApp : $deployedApp;

if (!is_file($bootstrap)) {
    http_response_code(500);
    exit('Application bootstrap not found.');
}

require $bootstrap;

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if ($path === '/robots.txt') {
    header('Content-Type: text/plain; charset=utf-8');
    echo "User-agent: *\n";
    echo $site['id'] === 'default' ? "Disallow: /\n" : "Allow: /\nSitemap: {$site['url']}/sitemap.xml\n";
    exit;
}

if ($path === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>' . e($site['url']) . '</loc><changefreq>weekly</changefreq><priority>1.0</priority></url></urlset>';
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

if ($path !== '/') {
    http_response_code(404);
}

ob_start();
render($site['view'], ['site' => $site]);
$content = (string) ob_get_clean();

render('layout', compact('site', 'environment', 'content'));
