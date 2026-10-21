<main class="blingsatan relative min-h-screen overflow-hidden">
    <img src="/images/blingsatan/background.webp" alt="" class="blingsatan-background" decoding="async">
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'blur' => true, 'leftClass' => 'h-[31px] w-[136px] object-contain object-left', 'rightClass' => 'h-[27px] w-[24px]']); ?>
    <h1 class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></h1>
    <div class="blingsatan-layout relative mx-auto w-full max-w-[402px] md:max-w-none">
        <div class="blingsatan-portrait">
            <?= responsive_img('/images/blingsatan/hero.png', 'BLINGSATAN band portrait', '(min-width: 768px) 50vw, 100vw', ['width' => 1470, 'height' => 1961, 'fetchpriority' => 'high', 'decoding' => 'async', 'class' => 'blingsatan-hero']) ?>
            <img src="/images/blingsatan/wordmark.png" alt="Blingsatan" width="1776" height="649" class="blingsatan-logo" decoding="async">
        </div>
        <div role="region" aria-label="BLINGSATAN content" tabindex="0" class="blingsatan-content">
            <section aria-label="Petaruh — out now" class="blingsatan-release">
                <p class="blingsatan-out-now">OUT NOW!!</p>
                <?= responsive_img('/images/blingsatan/petaruh-artwork.png', 'Petaruh silver mask artwork', '295px', ['width' => 2048, 'height' => 2048, 'class' => 'blingsatan-mask', 'decoding' => 'async']) ?>
                <div class="blingsatan-release-title"><?= responsive_img('/images/blingsatan/petaruh-wordmark.png', 'Petaruh', '391px', ['width' => 2048, 'height' => 2048, 'decoding' => 'async']) ?></div>
            </section>
            <?php render('components/blingsatan-video', ['video' => $site['video']]); ?>
            <section aria-label="Listen to Petaruh" class="blingsatan-links">
                <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 27]); ?>
            </section>
            <section aria-labelledby="blingsatan-channel" class="blingsatan-channel">
                <h2 id="blingsatan-channel" class="text-center font-mono text-[32px] font-bold leading-none">Our Channel</h2>
                <?php render('components/blingsatan-video', ['video' => $site['channel_video']]); ?>
                <div class="blingsatan-links">
                    <?php foreach ($site['channel_platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 27, 'releaseLabel' => 'music']); ?>
                </div>
            </section>
            <?php render('components/photo-carousel', [
                'photos' => $site['photos'],
                'label' => 'BLINGSATAN photo gallery',
                'className' => 'blingsatan-gallery',
            ]); ?>
            <?php render('components/footer', ['site' => $site]); ?>
        </div>
    </div>
</main>
