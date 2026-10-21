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
            <section data-photo-carousel aria-label="BLINGSATAN photo gallery" aria-roledescription="carousel" class="blingsatan-gallery">
                <div data-photo-stage class="blingsatan-photo-stage" tabindex="0" aria-label="Use the arrow keys to browse band photos">
                    <?php foreach ([2, 4, 5, 3, 1] as $index => $photo): ?>
                        <img data-photo-slide data-position="<?= $index ?>" src="/images/blingsatan/photo-<?= $photo ?>.png" alt="BLINGSATAN band photo <?= $photo ?>" width="<?= $photo === 2 ? 288 : (in_array($photo, [1, 4]) ? 264 : 240) ?>" height="<?= $photo === 2 ? 288 : (in_array($photo, [1, 4]) ? 252 : 228) ?>" loading="lazy" decoding="async">
                    <?php endforeach; ?>
                </div>
                <div class="blingsatan-photo-controls">
                    <button type="button" data-photo-previous aria-label="Previous photo">&#8592;</button>
                    <div class="flex items-center gap-[7px]">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <button type="button" data-photo-go="<?= $i ?>" aria-label="Show band photo <?= $i + 1 ?>" <?= $i === 0 ? 'aria-current="true"' : '' ?>></button>
                        <?php endfor; ?>
                    </div>
                    <button type="button" data-photo-next aria-label="Next photo">&#8594;</button>
                </div>
                <p data-photo-status class="sr-only" aria-live="polite">Photo 1 of 5</p>
            </section>
            <?php render('components/footer', ['site' => $site]); ?>
        </div>
    </div>
</main>
