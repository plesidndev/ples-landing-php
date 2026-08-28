<?php
$isArtist = $site['id'] !== 'default';
$isError ??= false;
$robots ??= $isArtist ? 'index, follow, max-image-preview:large, max-video-preview:-1, max-snippet:-1' : 'noindex, nofollow';
$title ??= $site['title'];

$schema = [];
if ($isArtist && !$isError) {
    $artistNode = [
        '@context' => 'https://schema.org', '@type' => 'MusicGroup',
        '@id' => $site['url'] . '#artist', 'name' => $site['name'], 'url' => $site['url'],
        'image' => absolute_url($site['og_image']),
    ];
    if ($site['genre'] !== '') {
        $artistNode['genre'] = $site['genre'];
    }
    if ($site['artist_same_as'] !== []) {
        $artistNode['sameAs'] = $site['artist_same_as'];
    }
    $schema[] = $artistNode;

    $schema[] = [
        '@context' => 'https://schema.org', '@type' => 'MusicRecording',
        '@id' => $site['url'] . '#recording', 'name' => $site['release'], 'url' => $site['url'],
        'image' => absolute_url($site['og_image']), 'inLanguage' => 'id',
        'byArtist' => ['@id' => $site['url'] . '#artist'],
        'sameAs' => $site['same_as'],
    ];

    if ($site['video']['id'] !== '') {
        $videoNode = [
            '@context' => 'https://schema.org', '@type' => 'VideoObject',
            'name' => $site['video']['title'], 'description' => $site['description'],
            'thumbnailUrl' => 'https://i.ytimg.com/vi/' . $site['video']['id'] . '/maxresdefault.jpg',
            'embedUrl' => 'https://www.youtube-nocookie.com/embed/' . $site['video']['id'],
            'contentUrl' => 'https://www.youtube.com/watch?v=' . $site['video']['id'],
        ];
        // Google needs uploadDate for video rich results; omitted until a real date is known.
        if (($site['video']['upload_date'] ?? '') !== '') {
            $videoNode['uploadDate'] = $site['video']['upload_date'];
        }
        $schema[] = $videoNode;
    }
}
?>
<!doctype html>
<html lang="id" class="h-full antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title) ?></title>
    <meta name="description" content="<?= e($site['description']) ?>">
    <meta name="theme-color" content="<?= e($site['theme_color']) ?>">
    <meta name="robots" content="<?= e($robots) ?>">
    <link rel="canonical" href="<?= e($site['url']) ?>">
    <link rel="icon" href="/icon.svg" type="image/svg+xml">
    <link rel="manifest" href="/manifest.webmanifest">
    <?php $css = inline_css(); ?>
    <?php if ($css !== ''): ?>
        <style><?= $css ?></style>
    <?php else: ?>
        <link rel="stylesheet" href="<?= e(asset_url('/assets/app.css')) ?>">
    <?php endif; ?>
    <?php if (!$isError && $site['lcp_image'] !== '' && $site['lcp_image_desktop'] !== ''): ?>
        <?= preload_image($site['lcp_image'], '100vw', '(max-width: 767px)') ?>
        <?= preload_image($site['lcp_image_desktop'], '50vw', '(min-width: 768px)') ?>
    <?php elseif (!$isError && $site['lcp_image'] !== ''): ?>
        <?= preload_image($site['lcp_image'], '(min-width: 768px) 50vw, 100vw') ?>
    <?php endif; ?>
    <?php if ($isArtist && $site['video']['id'] !== ''): ?>
        <link rel="preconnect" href="https://www.youtube-nocookie.com" crossorigin>
    <?php endif; ?>
    <?php if ($environment['ga_id'] !== ''): ?>
        <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
    <?php endif; ?>
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= e($site['locale']) ?>">
    <meta property="og:url" content="<?= e($site['url']) ?>">
    <meta property="og:site_name" content="Ples+ Connect">
    <meta property="og:title" content="<?= e($title) ?>">
    <meta property="og:description" content="<?= e($site['description']) ?>">
    <meta property="og:image" content="<?= e(absolute_url($site['og_image'])) ?>">
    <meta property="og:image:width" content="<?= e($site['og_size'][0]) ?>">
    <meta property="og:image:height" content="<?= e($site['og_size'][1]) ?>">
    <meta property="og:image:alt" content="<?= e($site['og_image_alt']) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($title) ?>">
    <meta name="twitter:description" content="<?= e($site['description']) ?>">
    <meta name="twitter:image" content="<?= e(absolute_url($site['og_image'])) ?>">
    <meta name="twitter:image:alt" content="<?= e($site['og_image_alt']) ?>">
    <?php if ($environment['google_site_verification'] !== ''): ?>
        <meta name="google-site-verification" content="<?= e($environment['google_site_verification']) ?>">
    <?php endif; ?>
    <script src="<?= e(asset_url('/assets/app.js')) ?>" defer></script>
    <?php foreach ($schema as $node): ?>
        <script type="application/ld+json"><?= json_script($node) ?></script>
    <?php endforeach; ?>
    <?php if ($environment['ga_id'] !== ''): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= rawurlencode($environment['ga_id']) ?>"></script>
        <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag('js',new Date());gtag('config',<?= json_encode($environment['ga_id']) ?>);</script>
    <?php endif; ?>
</head>
<body class="flex min-h-full flex-col bg-black">
<?= $content ?>
</body>
</html>
