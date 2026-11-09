<main class="nnc relative flex-1 overflow-clip">
    <div class="nnc-background" aria-hidden="true"><?= responsive_img('/images/nyamnyamcheese/background.jpg', '', '(min-width: 768px) 100vw, 1253px', ['decoding' => 'async']) ?></div>
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'leftClass' => 'h-[31px] w-[136px] object-contain object-left', 'rightClass' => 'h-[27px] w-[24px]']); ?>
    <h1 class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></h1>

    <div class="nnc-layout relative">
        <section class="nnc-portrait" aria-label="NYAM NYAM CHEESE portrait">
            <div class="nnc-hero"><?= responsive_img('/images/nyamnyamcheese/hero.jpg', 'NYAM NYAM CHEESE band standing in a warehouse', '(min-width: 768px) 50vw, 402px', ['width' => 909, 'height' => 1616, 'fetchpriority' => 'high', 'decoding' => 'async']) ?></div>
            <div class="nnc-wordmark"><?= responsive_img('/images/nyamnyamcheese/wordmark.png', 'NYAM NYAM CHEESE', '393px', ['width' => 2737, 'height' => 1063, 'decoding' => 'async']) ?></div>
        </section>

        <div class="nnc-content">
            <section aria-labelledby="nnc-release" class="nnc-release">
                <h2 id="nnc-release" class="nnc-release-title">OUT NOW!!<br><?= e($site['release']) ?></h2>
                <?php if ($site['release_date'] ?? null): ?><time class="nnc-release-date" datetime="<?= e($site['release_date']['iso']) ?>"><?= e($site['release_date']['label']) ?></time><?php endif; ?>
                <?php if ($site['feature_video']) render('components/video-card', ['video' => $site['feature_video'], 'className' => 'nnc-video']); ?>
                <div class="nnc-presave">
                    <?php if ($site['presave']['href'] !== ''): ?>
                        <a href="<?= e($site['presave']['href']) ?>" target="_blank" rel="noopener noreferrer" data-dsp="presave" aria-label="Pre-save <?= e($site['release']) ?> by <?= e($site['name']) ?>"><?= e($site['presave']['label']) ?></a>
                    <?php else: ?>
                        <span role="link" aria-disabled="true" aria-label="Pre-save link coming soon"><?= e($site['presave']['label']) ?></span>
                    <?php endif; ?>
                </div>
            </section>

            <section aria-label="Listen to NYAM NYAM CHEESE" class="nnc-music">
                <?php render('components/video-card', ['video' => $site['video'], 'className' => 'nnc-video']); ?>
                <div class="nnc-links">
                    <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 27, 'releaseLabel' => 'music']); ?>
                </div>
            </section>

            <?php render('components/photo-carousel', ['photos' => $site['photos'], 'label' => 'NYAM NYAM CHEESE photo gallery', 'className' => 'nnc-gallery']); ?>
            <?php render('components/footer', ['site' => $site]); ?>
        </div>
    </div>
</main>
