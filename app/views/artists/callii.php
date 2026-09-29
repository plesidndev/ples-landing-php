<main class="relative flex-1 overflow-hidden bg-black md:h-screen">
    <img src="/images/callii/brngakas-background.png" alt="" aria-hidden="true" class="absolute left-0 top-0 aspect-[402/1253] w-full object-fill md:aspect-auto md:h-full md:object-cover" decoding="async">
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'paddingClass' => 'px-2', 'leftClass' => 'h-[31px] w-[137px] object-contain object-left', 'rightClass' => 'shrink-0 scale-[0.75]', 'leftImage' => '/images/callii/figma-core.png', 'rightImage' => '/images/callii/figma-home-logo.svg', 'leftDimensions' => [3972, 906], 'rightDimensions' => [32, 35]]); ?>

    <div class="relative mx-auto flex w-full max-w-[402px] flex-col gap-[11px] md:grid md:h-screen md:max-w-none md:grid-cols-2 md:grid-rows-[minmax(0,1fr)] md:gap-0">
        <section aria-label="CALLii BRANKAS artwork" class="relative aspect-square w-full overflow-hidden md:h-full md:aspect-auto">
            <?= responsive_img('/images/callii/brngakas-hero.png', 'Illustrated portrait of CALLii and 6SENTANI for BRANKAS', '(min-width: 768px) 50vw, 100vw', ['width' => 4000, 'height' => 4000, 'fetchpriority' => 'high', 'decoding' => 'async', 'class' => 'absolute inset-0 size-full object-cover']) ?>
        </section>

        <div role="region" aria-label="CALLII content" tabindex="0" class="flex min-w-0 flex-col gap-[11px] md:h-full md:min-h-0 md:gap-5 md:overflow-y-auto md:overscroll-contain md:pt-[72px]">
            <section class="relative h-[99px] shrink-0 text-center md:mt-8" aria-label="CALLii tagline">
                <div class="absolute inset-x-[3.5%] top-0 h-[99px] border border-white/15 bg-black/45"></div>
                <h1 class="absolute left-1/2 top-[-75px] z-10 w-[308px] max-w-[80%] -translate-x-1/2 drop-shadow-[4px_4px_0_rgba(0,0,0,0.6)] md:top-[-85px]"><span class="sr-only">CALLii — BRANKAS featuring 6SENTANI</span><img src="/images/callii/brngakas-logo.png" alt="" width="1322" height="550" decoding="async" class="w-full"></h1>
                <p class="absolute inset-x-0 top-[52px] font-mono text-[15px] text-white">BARat!!!</p>
            </section>

            <section aria-label="Listen to BRANKAS" class="relative shrink-0 pb-[29px] pt-[29px] md:pb-8">
                <div class="absolute inset-x-0 bottom-0 top-[29px] bg-[#d9d9d9]/20"></div>
                <div class="relative pt-[16px] text-center font-mono text-[15px] leading-[21px] text-white">
                    <p>OUT NOW!!<br>BRANKAS ft 6SENTANI</p>
                </div>
                <div class="relative mx-auto mt-[20px] flex w-[calc(100%-36px)] max-w-[365px] flex-col gap-3">
                    <?php foreach ($site['feature_platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'releaseLabel' => 'BRANKAS']); ?>
                </div>
            </section>

            <?php render('components/video-carousel', [
                'videos' => [$site['feature_video'], $site['video']],
                'label' => 'CALLII YouTube videos',
                'className' => 'mt-[-7px] min-w-0 md:mx-auto md:mt-0 md:w-full md:max-w-[450px] md:shrink-0',
                'trackPaddingClass' => 'px-[25px] md:px-4',
            ]); ?>

            <section aria-label="Listen to MULAI LAGI" class="flex flex-col gap-3 px-[18px] pb-4 md:mt-0 md:shrink-0">
                <h2 class="sr-only">Listen to MULAI LAGI on streaming platforms</h2>
                <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'releaseLabel' => 'MULAI LAGI']); ?>
            </section>

            <div class="md:mt-auto md:shrink-0"><?php render('components/footer', ['site' => $site]); ?></div>
        </div>
    </div>
</main>
