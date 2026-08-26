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
