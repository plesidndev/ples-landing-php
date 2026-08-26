<main class="relative min-h-screen overflow-hidden">
    <div class="fixed inset-0 -z-10 bg-black"><img src="/images/kayl/bg-pattern.png" alt="" class="size-full object-cover"></div>
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'leftClass' => 'h-[31px] w-[136px] object-cover object-left', 'rightClass' => 'h-[27px] w-[24px]']); ?>

    <div class="mx-auto flex w-full max-w-[402px] flex-col gap-[13px] pt-[54px] md:max-w-none md:grid md:min-h-screen md:grid-cols-2 md:gap-0 md:pt-0">
        <section aria-label="KAYL artwork" class="relative aspect-video w-full overflow-hidden md:sticky md:top-0 md:h-screen md:aspect-auto">
            <img src="/images/kayl/hero.png" alt="KAYL artwork" class="absolute inset-0 size-full object-cover">
        </section>

        <div class="flex min-w-0 flex-col gap-[13px] md:min-h-screen md:pt-16">
            <section class="relative h-[134px] shrink-0">
                <h1 class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></h1>
                <img src="/images/kayl/wordmark.png" alt="" width="632" height="316" class="absolute left-1/2 top-[-12px] h-[116px] w-[379px] -translate-x-1/2 object-cover">
                <p class="absolute left-1/2 top-[105px] flex h-6 w-[157px] -translate-x-1/2 items-center justify-center rounded-full bg-[#d9d9d9]/20 font-display text-xs text-white"><?= e($site['tagline'][0]) ?></p>
            </section>

            <section aria-label="Streaming links" class="flex flex-col gap-3 px-[18px]">
                <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'glass', 'logoHeight' => $platform['id'] === 'tiktok' ? 28 : 26]); ?>
            </section>

            <div class="md:mt-auto"><?php render('components/video', ['site' => $site]); ?><?php render('components/footer', ['site' => $site]); ?></div>
        </div>
    </div>
</main>
