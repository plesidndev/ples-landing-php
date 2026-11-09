<main class="relative min-h-screen overflow-hidden md:h-screen">
    <div class="fixed inset-0 -z-10 bg-black"><?= responsive_img('/images/kayl/bg-pattern.jpg', '', '100vw', ['decoding' => 'async', 'class' => 'size-full object-cover']) ?></div>
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'leftClass' => 'h-[31px] w-[136px] object-cover object-left', 'rightClass' => 'h-[27px] w-[24px]']); ?>

    <div class="mx-auto flex w-full max-w-[402px] flex-col gap-[13px] md:max-w-none md:grid md:h-screen md:grid-cols-2 md:grid-rows-[minmax(0,1fr)] md:gap-0">
        <section aria-label="KAYL artwork" class="relative aspect-video w-full overflow-hidden md:h-full md:aspect-auto">
            <?= responsive_img('/images/kayl/hero.jpg', 'KAYL portrait', '(min-width: 768px) 50vw, 100vw', ['width' => 1920, 'height' => 1082, 'fetchpriority' => 'high', 'decoding' => 'async', 'class' => 'absolute inset-0 size-full object-cover']) ?>
        </section>

        <div role="region" aria-label="KAYL content" tabindex="0" class="flex min-w-0 flex-col gap-[13px] md:h-full md:min-h-0 md:overflow-y-auto md:overscroll-contain md:pt-16">
            <?php if (isset($site['feature'])): $feature = $site['feature']; ?>
            <section aria-labelledby="kayl-feature" class="flex flex-col items-center pt-4 pb-5 text-center md:shrink-0">
                <p class="text-[32px] leading-8 font-bold">OUT NOW!!</p>
                <h2 id="kayl-feature" class="mt-2 pt-[.12em] font-['Koulen'] text-[min(128px,31.8vw)] leading-[.8] font-normal"><?= e($feature['release']) ?></h2>
                <div class="mt-2 w-[calc(100%-50px)] max-w-[384px]"><?php render('components/video-card', ['video' => $feature['video']]); ?></div>
                <div class="mt-[26px] flex w-full flex-col gap-3 px-[18px]" aria-label="Listen to <?= e($feature['release']) ?>">
                    <?php foreach ($feature['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 26, 'releaseLabel' => $feature['release']]); ?>
                </div>
            </section>
            <?php endif; ?>
            <section class="relative h-[134px] shrink-0">
                <h1 class="absolute left-1/2 top-[-12px] h-[116px] w-[379px] -translate-x-1/2"><span class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></span><img src="/images/kayl/wordmark.png" alt="" width="900" height="450" decoding="async" class="size-full object-cover"></h1>
                <p class="absolute left-1/2 top-[105px] flex h-6 w-[157px] -translate-x-1/2 items-center justify-center rounded-full bg-[#d9d9d9]/20 font-display text-xs text-white"><?= e($site['tagline'][0]) ?></p>
            </section>

            <div class="md:shrink-0"><?php render('components/video', ['site' => $site]); ?></div>

            <section aria-label="Streaming links" class="flex flex-col gap-3 px-[18px] md:shrink-0">
                <h2 class="sr-only">Dengarkan <?= e($site['release']) ?> dari <?= e($site['name']) ?></h2>
                <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => $platform['id'] === 'tiktok' ? 28 : 26]); ?>
            </section>

            <div class="md:mt-auto md:shrink-0"><?php render('components/footer', ['site' => $site]); ?></div>
        </div>
    </div>
</main>
