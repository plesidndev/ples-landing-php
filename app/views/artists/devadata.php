<main class="relative min-h-screen overflow-hidden">
    <div class="fixed inset-0 -z-10 bg-black"><img src="/images/devadata/devabackgr.jpg" alt="" decoding="async" class="size-full object-cover"></div>
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'leftClass' => 'h-[31px] w-[136px] object-cover object-left', 'rightClass' => 'h-[27px] w-[24px]']); ?>

    <div class="mx-auto flex w-full max-w-[402px] flex-col gap-[13px] md:max-w-none md:grid md:min-h-screen md:grid-cols-2 md:gap-0">
        <section aria-label="Devadata band portrait" class="relative aspect-[1917/1080] w-full overflow-hidden md:hidden">
            <img src="/images/devadata/hero.jpg" alt="DEVADATA band portrait" width="1920" height="1280" fetchpriority="high" decoding="async" class="absolute inset-0 size-full object-cover">
        </section>

        <section aria-label="SAPUTANAH PAPUA artwork" class="relative mx-auto h-[418px] w-[388px] md:hidden">
            <h1 class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></h1>
            <img src="/images/devadata/artwork.png" alt="SAPUTANAH PAPUA cover artwork" width="1100" height="1466" decoding="async" class="absolute left-1/2 top-[-85px] h-[533px] w-[400px] max-w-none -translate-x-1/2 object-cover">
        </section>

        <section aria-label="Devadata artwork" class="relative hidden w-full overflow-hidden md:sticky md:top-0 md:block md:h-screen">
            <img src="/images/devadata/artwork.png" alt="SAPUTANAH PAPUA cover artwork" width="1100" height="1466" decoding="async" class="absolute inset-0 size-full object-contain object-center">
        </section>

        <div class="flex min-w-0 flex-col gap-4 md:min-h-screen md:gap-3 md:pt-16">
            <section class="relative hidden w-full shrink-0 overflow-hidden md:mx-auto md:block md:h-[clamp(220px,32vh,300px)] md:max-w-xl md:rounded-[28px]">
                <h1 class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></h1>
                <img src="/images/devadata/hero.jpg" alt="DEVADATA band portrait" width="1920" height="1280" fetchpriority="high" decoding="async" class="absolute inset-0 size-full object-cover">
            </section>

            <div><?php render('components/video', ['site' => $site]); ?></div>

            <section aria-label="Streaming links" class="flex flex-col gap-3 px-[18px]">
                <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', compact('site', 'platform')); ?>
            </section>

            <div class="md:mt-auto"><?php render('components/footer', ['site' => $site]); ?></div>
        </div>
    </div>
</main>
