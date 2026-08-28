<main class="relative flex-1">
    <div class="fixed inset-0 -z-10"><?= responsive_img('/images/lili/bg-pattern.jpg', '', '100vw', ['decoding' => 'async', 'class' => 'size-full object-cover']) ?></div>
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[430px] md:max-w-none', 'leftClass' => 'h-[31px] w-[136px] object-contain object-left', 'rightClass' => 'h-[27px] w-[24px]']); ?>
    <div class="md:grid md:min-h-screen md:grid-cols-2">
        <section aria-label="LiLi" class="relative h-[314px] w-full overflow-hidden md:sticky md:top-0 md:h-screen"><?= responsive_img('/images/lili/hero.jpg', 'LiLi lying across a bed scattered with rose petals', '(min-width: 768px) 50vw, 100vw', ['width' => 1600, 'height' => 900, 'fetchpriority' => 'high', 'decoding' => 'async', 'class' => 'absolute inset-0 size-full object-cover']) ?></section>
        <div class="mx-auto flex w-full max-w-[430px] flex-col gap-[13px] pt-[13px] md:min-h-screen md:max-w-none md:pt-16">
            <section class="relative h-[134px]"><h1 class="absolute left-1/2 top-[-5px] h-[110px] w-[152px] -translate-x-1/2"><span class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></span><img src="/images/lili/wordmark.png" alt="" width="456" height="329" decoding="async" class="size-full object-contain"></h1><p class="absolute left-1/2 top-[105px] flex h-6 w-[157px] -translate-x-1/2 items-center justify-center rounded-full bg-[#d9d9d9]/20 font-mono text-xs text-white"><?= e($site['release']) ?></p></section>
            <section aria-label="Streaming links" class="flex flex-col gap-3 px-[18px]"><h2 class="sr-only">Dengarkan <?= e($site['release']) ?> dari <?= e($site['name']) ?></h2><?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => 28]); ?></section>
            <div class="flex flex-col gap-[13px] md:mt-auto"><?php render('components/video', ['site' => $site]); ?><?php render('components/footer', ['site' => $site]); ?></div>
        </div>
    </div>
</main>
