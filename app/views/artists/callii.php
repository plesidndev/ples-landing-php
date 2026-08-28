<main class="relative flex-1">
    <div class="fixed inset-0 -z-10"><img src="/images/callii/hero-swirl-bg.jpg" alt="" decoding="async" class="size-full object-cover"></div>
    <?php render('components/artist-header', ['site' => $site]); ?>
    <div class="md:grid md:min-h-screen md:grid-cols-2">
        <section aria-label="CALLII photo collage" class="relative aspect-square w-full overflow-hidden md:sticky md:top-0 md:h-screen md:aspect-auto">
            <img src="/images/callii/photo-collage.jpg" alt="CALLII photo collage from the MULAI LAGI era" width="600" height="600" fetchpriority="high" decoding="async" class="absolute inset-0 size-full object-cover">
        </section>
        <div class="flex min-w-0 flex-col md:min-h-screen md:pt-16">
            <section class="relative w-full px-4 pb-6 pt-16 text-center md:pt-6">
                <h1 class="relative z-10 mx-auto w-48"><span class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></span><img src="/images/callii/callii-logo.png" alt="" width="700" height="291" decoding="async" class="w-full drop-shadow-[4px_4px_0_rgba(0,0,0,0.6)]"></h1>
                <div class="mx-auto mt-4 max-w-sm rounded-2xl border border-white/10 bg-black/40 px-4 py-6 backdrop-blur-sm"><p class="font-mono text-xs leading-relaxed text-white"><?= e($site['tagline'][0]) ?><br><br><?= e($site['tagline'][1]) ?></p></div>
            </section>
            <section aria-label="Streaming links" class="w-full px-4 py-6"><div class="mx-auto flex max-w-sm flex-col gap-3"><?php foreach ($site['platforms'] as $platform) render('components/dsp-card', compact('site', 'platform')); ?></div></section>
            <?php render('components/video', ['site' => $site]); ?>
            <div class="md:mt-auto"><?php render('components/footer', ['site' => $site]); ?></div>
        </div>
    </div>
</main>
