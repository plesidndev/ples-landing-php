<main class="arta relative flex-1 overflow-clip">
    <div class="arta-background" aria-hidden="true"><?= responsive_img('/images/arta/background.webp', '', '100vw', ['decoding' => 'async', 'class' => 'size-full object-cover']) ?></div>
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'leftClass' => 'h-[31px] w-[136px] object-contain object-left', 'rightClass' => 'h-[27px] w-[24px]']); ?>
    <h1 class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></h1>

    <div class="arta-layout relative">
        <section class="arta-portrait" aria-label="ARTA portrait">
            <?= responsive_img('/images/arta/hero.png', 'ARTA seated in a burgundy jacket and red knitted mask', '(min-width: 768px) 60vw, 872px', ['width' => 804, 'height' => 1608, 'fetchpriority' => 'high', 'decoding' => 'async', 'class' => 'arta-hero']) ?>
            <?= responsive_img('/images/arta/wordmark.png', 'ARTA', '(min-width: 768px) 45vw, 565px', ['width' => 3000, 'height' => 3000, 'decoding' => 'async', 'class' => 'arta-wordmark']) ?>
        </section>

        <div class="arta-content">
            <section aria-labelledby="arta-release" class="arta-release">
                <div class="arta-release-artwork">
                    <p class="arta-out-now">OUT NOW!!</p>
                    <h2 id="arta-release" class="arta-release-title"><?= e($site['release']) ?></h2>
                </div>
                <?php render('components/video-card', ['video' => $site['feature_video'], 'className' => 'arta-video']); ?>
                <div class="arta-links" aria-label="Listen to <?= e($site['release']) ?>">
                    <?php foreach ($site['feature_platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 28]); ?>
                </div>
            </section>

            <section class="arta-zone" aria-labelledby="arta-zone-title">
                <h2 id="arta-zone-title">-ARZEN ZONE-</h2>
                <?php render('components/video-card', ['video' => $site['video'], 'className' => 'arta-video']); ?>
                <?php if ($site['platforms'] !== []): ?>
                <div class="arta-links" aria-label="Discover ARTA">
                    <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 28, 'releaseLabel' => 'music']); ?>
                </div>
                <?php endif; ?>
            </section>

            <?php render('components/photo-carousel', ['photos' => $site['photos'], 'label' => 'ARTA photo gallery', 'className' => 'arta-gallery']); ?>
            <?php render('components/footer', ['site' => $site]); ?>
        </div>
    </div>
</main>
