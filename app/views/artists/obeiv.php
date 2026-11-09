<main class="obeiv relative flex-1 overflow-clip">
    <div class="obeiv-background" aria-hidden="true"><?= responsive_img('/images/obeiv/background.jpg', '', '100vw', ['decoding' => 'async']) ?></div>
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'leftClass' => 'h-[31px] w-[136px] object-contain object-left', 'rightClass' => 'h-[27px] w-[24px]']); ?>
    <h1 class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></h1>

    <div class="obeiv-layout relative">
        <section class="obeiv-portrait" aria-label="OBEIV portrait">
            <div class="obeiv-hero"><?= responsive_img('/images/obeiv/hero.jpg', 'OBEIV band members posing together', '(min-width: 768px) 50vw, 402px', ['width' => 1058, 'height' => 1446, 'fetchpriority' => 'high', 'decoding' => 'async']) ?></div>
            <div class="obeiv-wordmark"><?= responsive_img('/images/obeiv/wordmark.png', 'OBEIV', '311px', ['width' => 3000, 'height' => 2170, 'decoding' => 'async']) ?></div>
        </section>

        <div class="obeiv-content">
            <section aria-labelledby="obeiv-release" class="obeiv-release">
                <h2 id="obeiv-release" class="obeiv-release-title">OUT NOW!!<br><?= e($site['release']) ?></h2>
                <?php render('components/video-card', ['video' => $site['feature_video'], 'className' => 'obeiv-video']); ?>
                <div class="obeiv-links" aria-label="Listen to <?= e($site['release']) ?>">
                    <?php foreach ($site['feature_platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 27]); ?>
                </div>
            </section>

            <section aria-label="Listen to OBEIV" class="obeiv-music">
                <?php render('components/video-card', ['video' => $site['video'], 'className' => 'obeiv-video']); ?>
                <div class="obeiv-links">
                    <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 27, 'releaseLabel' => 'music']); ?>
                </div>
            </section>

            <?php render('components/photo-carousel', ['photos' => $site['photos'], 'label' => 'OBEIV photo gallery', 'className' => 'obeiv-gallery']); ?>
            <?php render('components/footer', ['site' => $site]); ?>
        </div>
    </div>
</main>
