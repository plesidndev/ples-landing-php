<!doctype html>
<html lang="id" class="h-full antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($site['title']) ?></title>
    <meta name="description" content="<?= e($site['description']) ?>">
    <meta name="keywords" content="<?= e(implode(', ', $site['keywords'])) ?>">
    <meta name="theme-color" content="<?= e($site['theme_color']) ?>">
    <meta name="robots" content="<?= $site['id'] === 'default' ? 'noindex, nofollow' : 'index, follow, max-image-preview:large, max-video-preview:-1, max-snippet:-1' ?>">
    <link rel="canonical" href="<?= e($site['url']) ?>">
    <link rel="icon" href="/icon.svg" type="image/svg+xml">
    <link rel="manifest" href="/manifest.webmanifest">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="<?= e($site['locale']) ?>">
    <meta property="og:url" content="<?= e($site['url']) ?>">
    <meta property="og:site_name" content="<?= e($site['name']) ?>">
    <meta property="og:title" content="<?= e($site['title']) ?>">
    <meta property="og:description" content="<?= e($site['description']) ?>">
    <meta property="og:image" content="<?= e(absolute_url($site['og_image'])) ?>">
    <meta property="og:image:width" content="<?= e($site['og_size'][0]) ?>">
    <meta property="og:image:height" content="<?= e($site['og_size'][1]) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($site['title']) ?>">
    <meta name="twitter:description" content="<?= e($site['description']) ?>">
    <meta name="twitter:image" content="<?= e(absolute_url($site['og_image'])) ?>">
    <?php if ($environment['google_site_verification'] !== ''): ?>
        <meta name="google-site-verification" content="<?= e($environment['google_site_verification']) ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="/assets/app.css">
    <script src="/assets/app.js" defer></script>
    <?php if ($site['id'] !== 'default'): ?>
        <script type="application/ld+json"><?= json_script(['@context' => 'https://schema.org', '@type' => 'MusicGroup', 'name' => $site['name'], 'url' => $site['url'], 'genre' => 'Hip-Hop']) ?></script>
        <script type="application/ld+json"><?= json_script(['@context' => 'https://schema.org', '@type' => 'MusicRecording', 'name' => $site['release'], 'url' => $site['url'], 'byArtist' => ['@type' => 'MusicGroup', 'name' => $site['name']], 'sameAs' => $site['same_as']]) ?></script>
    <?php endif; ?>
    <?php if ($environment['ga_id'] !== ''): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= rawurlencode($environment['ga_id']) ?>"></script>
        <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)}gtag('js',new Date());gtag('config',<?= json_encode($environment['ga_id']) ?>);</script>
    <?php endif; ?>
</head>
<body class="flex min-h-full flex-col bg-black">
<?= $content ?>
</body>
</html>
