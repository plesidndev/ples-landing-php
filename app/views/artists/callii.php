<main class="relative flex-1 overflow-hidden bg-black">
    <img src="/images/callii/brngakas-background.png" alt="" aria-hidden="true" class="absolute left-0 top-0 aspect-[402/1253] w-full object-fill md:aspect-auto md:h-full md:object-cover" decoding="async">
    <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[402px] md:max-w-none', 'paddingClass' => 'px-2', 'leftClass' => 'h-[31px] w-[137px] object-contain object-left', 'rightClass' => 'shrink-0 scale-[0.75]', 'leftImage' => '/images/callii/figma-core.png', 'rightImage' => '/images/callii/figma-home-logo.svg', 'leftDimensions' => [3972, 906], 'rightDimensions' => [32, 35]]); ?>

    <div class="relative mx-auto flex w-full max-w-[402px] flex-col gap-[11px] md:max-w-none md:grid md:min-h-screen md:grid-cols-2 md:gap-0">
        <section aria-label="CALLii BRANKAS artwork" class="relative aspect-square w-full overflow-hidden md:sticky md:top-0 md:h-screen md:aspect-auto">
            <?= responsive_img('/images/callii/brngakas-hero.png', 'Illustrated portrait of CALLii and 6SENTANI for BRANKAS', '(min-width: 768px) 50vw, 100vw', ['width' => 4000, 'height' => 4000, 'fetchpriority' => 'high', 'decoding' => 'async', 'class' => 'absolute inset-0 size-full object-cover']) ?>
        </section>

        <div class="flex min-w-0 flex-col gap-[11px] md:min-h-screen md:gap-5 md:pt-[72px]">
            <section class="relative h-[99px] shrink-0 text-center md:mt-8" aria-label="CALLii tagline">
                <div class="absolute inset-x-[3.5%] top-0 h-[99px] border border-white/15 bg-black/45"></div>
                <h1 class="absolute left-1/2 top-[-75px] z-10 w-[308px] max-w-[80%] -translate-x-1/2 drop-shadow-[4px_4px_0_rgba(0,0,0,0.6)] md:top-[-85px]"><span class="sr-only">CALLii — BRANKAS featuring 6SENTANI</span><img src="/images/callii/brngakas-logo.png" alt="" width="1322" height="550" decoding="async" class="w-full"></h1>
                <p class="absolute inset-x-0 top-[52px] font-mono text-[15px] text-white">BARat!!!</p>
            </section>

            <section aria-label="Listen to BRANKAS" class="relative h-[332px] shrink-0 pt-[29px] md:h-auto md:pb-8">
                <div class="absolute inset-x-0 top-[29px] h-[282px] bg-[#d9d9d9]/20 md:bottom-0 md:h-auto"></div>
                <div class="relative pt-[16px] text-center font-mono text-[15px] leading-[21px] text-white">
                    <p>OUT NOW!!<br>BRANKAS ft 6SENTANI</p>
                </div>
                <div class="relative mx-auto mt-[20px] flex w-[calc(100%-36px)] max-w-[365px] flex-col gap-[9px]">
                    <?php foreach ($site['feature_platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'callii', 'releaseLabel' => 'BRANKAS']); ?>
                </div>
            </section>

            <section aria-label="MULAI LAGI music video" class="mx-[25px] mt-[-7px] md:mt-0 md:mx-4">
                <button type="button" data-video="<?= e($site['video']['id']) ?>" data-title="<?= e($site['video']['title']) ?>" aria-label="Play video: <?= e($site['video']['title']) ?>" class="group relative block aspect-video w-full cursor-pointer overflow-hidden rounded-[16px] bg-black text-left focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-red-500/70">
                    <img src="https://i.ytimg.com/vi/<?= e($site['video']['id']) ?>/maxresdefault.jpg" alt="" loading="lazy" decoding="async" class="absolute inset-0 size-full object-cover">
                    <span class="absolute inset-0 flex items-center justify-center"><span class="flex h-[40px] w-[59px] items-center justify-center rounded-[10px] bg-[#ff0033] shadow-[0_4px_12px_rgba(0,0,0,0.3)] transition-transform group-hover:scale-110"><svg viewBox="0 0 24 24" aria-hidden="true" class="ml-1 size-7 fill-white"><path d="M9 6.5v11l9-5.5z"/></svg></span></span>
                </button>
            </section>

            <section aria-label="Listen to MULAI LAGI" class="flex flex-col gap-[9px] px-[18px] pb-4 md:mt-0">
                <h2 class="sr-only">Listen to MULAI LAGI on streaming platforms</h2>
                <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', ['site' => $site, 'platform' => $platform, 'variant' => 'callii', 'releaseLabel' => 'MULAI LAGI']); ?>
            </section>

            <div class="md:mt-auto"><?php render('components/footer', ['site' => $site]); ?></div>
        </div>
    </div>
</main>
