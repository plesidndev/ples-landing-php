<main class="fff relative flex-1 overflow-clip">
    <div class="fff-background" aria-hidden="true"><?= responsive_img('/images/funfunforme/background.jpg', '', '(min-width: 768px) 100vw, 736px', ['decoding' => 'async']) ?></div>
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'leftClass' => 'h-[31px] w-[136px] object-contain object-left', 'rightClass' => 'h-[27px] w-[24px]']); ?>
    <h1 class="sr-only"><?= e($site['name']) ?></h1>

    <div class="fff-layout relative">
        <section class="fff-portrait" aria-label="Fun Fun For Me portrait">
            <div class="fff-hero"><?= responsive_img('/images/funfunforme/hero.jpg', 'Fun Fun For Me members posing in front of a stone wall', '(min-width: 768px) 50vw, 402px', ['width' => 1600, 'height' => 1577, 'fetchpriority' => 'high', 'decoding' => 'async']) ?></div>
            <div class="fff-wordmark"><?= responsive_img('/images/funfunforme/wordmark.png', 'Fun Fun For Me', '334px', ['width' => 1336, 'height' => 680, 'decoding' => 'async']) ?></div>
        </section>

        <div class="fff-content">
            <section aria-label="Listen to Fun Fun For Me" class="fff-music">
                <?php render('components/video-card', ['video' => $site['video'], 'className' => 'fff-video']); ?>
                <div class="fff-links">
                    <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 27, 'releaseLabel' => 'music']); ?>
                </div>
            </section>

            <?php render('components/photo-carousel', ['photos' => $site['photos'], 'label' => 'Fun Fun For Me photo gallery', 'className' => 'fff-gallery']); ?>
            <?php render('components/footer', ['site' => $site]); ?>
        </div>
    </div>
</main>
