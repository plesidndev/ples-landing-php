<?php

declare(strict_types=1);

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function render(string $view, array $data = []): void
{
    if (!preg_match('/^[a-z0-9\/_-]+$/', $view)) {
        throw new InvalidArgumentException('Invalid view name.');
    }

    $path = APP_PATH . '/views/' . $view . '.php';
    if (!is_file($path)) {
        throw new RuntimeException('View not found: ' . $view);
    }

    extract($data, EXTR_SKIP);
    require $path;
}

function absolute_url(string $path = '/'): string
{
    global $site;
    return rtrim($site['url'], '/') . '/' . ltrim($path, '/');
}

function json_script(array $data): string
{
    return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?: '{}';
}

function site_last_modified(): string
{
    global $site;

    $sources = [APP_PATH . '/artists.php', APP_PATH . '/views/' . $site['view'] . '.php'];
    $times = array_filter(array_map(static fn (string $file): int => is_file($file) ? (int) filemtime($file) : 0, $sources));

    return gmdate('Y-m-d', $times ? max($times) : time());
}

function asset_url(string $path): string
{
    $file = dirname(APP_PATH) . '/public' . $path;
    $version = is_file($file) ? (int) filemtime($file) : 0;

    return $version > 0 ? $path . '?v=' . $version : $path;
}
