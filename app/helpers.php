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
    $file = public_path($path);
    $version = is_file($file) ? (int) filemtime($file) : 0;

    return $version > 0 ? $path . '?v=' . $version : $path;
}

function public_path(string $path): string
{
    return dirname(APP_PATH) . '/public' . $path;
}

/**
 * Compiled CSS is small enough that inlining it removes the only render-blocking
 * request on the page. Returns '' if unreadable so the caller can fall back to <link>.
 */
function inline_css(string $path = '/assets/app.css'): string
{
    $file = public_path($path);

    return is_file($file) ? (string) file_get_contents($file) : '';
}

/**
 * Emits a <picture> that offers WebP plus the original format, with a srcset built
 * from whatever `<name>-<width>.<ext>` derivatives ./tools/build-images.sh produced.
 * Falls back to a plain <img> when no derivatives exist.
 */
function image_srcset(string $src, string $targetExt): string
{
    $ext = strtolower(pathinfo($src, PATHINFO_EXTENSION));
    $stem = substr($src, 0, -(strlen($ext) + 1));

    $widths = [];
    foreach (glob(public_path($stem) . '-*.' . $ext) ?: [] as $file) {
        if (preg_match('/-(\d+)\.' . preg_quote($ext, '/') . '$/', $file, $m)) {
            $widths[] = (int) $m[1];
        }
    }
    sort($widths);

    $parts = [];
    foreach ($widths as $w) {
        $parts[] = $stem . '-' . $w . '.' . $targetExt . ' ' . $w . 'w';
    }

    $full = $targetExt === $ext ? $src : $stem . '.' . $targetExt;
    if (is_file(public_path($full)) && ($size = @getimagesize(public_path($full)))) {
        $parts[] = $full . ' ' . (int) $size[0] . 'w';
    }

    return $parts === [] ? '' : implode(', ', $parts);
}

/**
 * Preloads the LCP image using the same WebP candidate list the <picture> will pick
 * from, so the preload and the render agree instead of downloading two files.
 */
function preload_image(string $src, string $sizes, string $media = ''): string
{
    $srcset = image_srcset($src, 'webp');
    if ($srcset === '') {
        return '<link rel="preload" as="image" href="' . e($src) . '"'
            . ($media !== '' ? ' media="' . e($media) . '"' : '') . ' fetchpriority="high">';
    }

    return '<link rel="preload" as="image" type="image/webp" imagesrcset="' . e($srcset)
        . '" imagesizes="' . e($sizes) . '"'
        . ($media !== '' ? ' media="' . e($media) . '"' : '') . ' fetchpriority="high">';
}

function responsive_img(string $src, string $alt, string $sizes, array $attrs = []): string
{
    $ext = strtolower(pathinfo($src, PATHINFO_EXTENSION));

    $rendered = '';
    foreach ($attrs as $key => $value) {
        if ($value === null || $value === false) {
            continue;
        }
        $rendered .= ' ' . $key . '="' . e((string) $value) . '"';
    }

    $imgSrcset = image_srcset($src, $ext);
    if ($imgSrcset === '' || !str_contains($imgSrcset, '-')) {
        return '<img src="' . e($src) . '" alt="' . e($alt) . '"' . $rendered . '>';
    }

    $webpSrcset = image_srcset($src, 'webp');
    $out = '<picture>';
    if ($webpSrcset !== '') {
        $out .= '<source type="image/webp" srcset="' . e($webpSrcset) . '" sizes="' . e($sizes) . '">';
    }
    $out .= '<img src="' . e($src) . '" srcset="' . e($imgSrcset) . '" sizes="' . e($sizes) . '" alt="' . e($alt) . '"' . $rendered . '>';

    return $out . '</picture>';
}
