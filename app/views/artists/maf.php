<main class="min-h-screen bg-black">
    <div class="relative mx-auto min-h-screen w-full max-w-[420px] overflow-hidden bg-gradient-to-b from-[#163a32] via-[#071914] to-black shadow-2xl md:max-w-none">
        <?php render('components/artist-header', ['site' => $site, 'maxWidth' => 'max-w-[420px] md:max-w-none', 'blur' => true, 'leftClass' => 'h-[31px] w-[136px] object-contain object-left', 'rightClass' => 'h-[35px] w-[32px]']); ?>
        <div class="md:grid md:min-h-screen md:grid-cols-2">
            <section aria-label="MAF artwork" class="h-[549px] w-full overflow-hidden md:sticky md:top-0 md:h-screen"><div class="relative h-full w-full"><?= responsive_img('/images/maf/hero.png', 'Classical marble statue representing MAF', '(min-width: 768px) 50vw, 100vw', ['width' => 736, 'height' => 1030, 'fetchpriority' => 'high', 'decoding' => 'async', 'class' => 'absolute inset-0 size-full object-contain object-bottom md:object-cover md:object-top']) ?></div></section>
            <div class="flex min-w-0 flex-col md:min-h-screen md:pt-16">
                <section class="px-3 pb-8 pt-3 text-center md:mx-auto md:w-full md:max-w-xl md:px-10 md:pb-10 md:pt-6">
                    <h1 class="sr-only">MAF — StarBoy</h1>
                    <div class="relative mx-auto h-[88px] w-full max-w-[374px] overflow-hidden md:h-[112px] md:max-w-[480px]"><img src="/images/maf/maf-wordmark.png" alt="MAF" width="736" height="1030" decoding="async" class="absolute inset-0 size-full scale-[1.02] object-cover object-[center_50%]"></div>
                    <p class="mt-1 border border-white/30 py-1 font-mono text-xs text-white">“StarBoy”</p>
                </section>
                <section class="px-[18px] pb-6 md:mx-auto md:w-full md:max-w-xl md:px-10"><div class="flex flex-col gap-3"><?php foreach ($site['platforms'] as $platform) render('components/dsp-card', compact('site', 'platform')); ?></div></section>
                <div class="md:mt-auto"><?php render('components/video', ['site' => $site]); ?><?php render('components/footer', ['site' => $site, 'maf' => true]); ?></div>
            </div>
        </div>
    </div>
</main>
