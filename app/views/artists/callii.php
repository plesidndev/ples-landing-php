<main class="relative flex-1">
    <div class="fixed inset-0 -z-10"><img src="/images/callii/hero-swirl-bg.png" alt="" class="size-full object-cover"></div>
    <?php render('components/artist-header', ['site' => $site]); ?>
    <div class="md:grid md:h-screen md:grid-cols-2">
        <div class="relative flex flex-col md:h-screen md:overflow-hidden">
            <div class="relative aspect-square w-full md:aspect-auto md:min-h-0 md:flex-1"><img src="/images/callii/photo-collage.jpg" alt="CALLII photo collage from the MULAI LAGI era" class="absolute inset-0 size-full object-cover md:object-contain"></div>
            <section class="relative w-full px-4 pb-6 pt-16 text-center">
                <h1 class="relative z-10 mx-auto w-48"><span class="sr-only"><?= e($site['name']) ?> — <?= e($site['release']) ?></span><img src="/images/callii/callii-logo.png" alt="" width="1322" height="550" class="w-full drop-shadow-[4px_4px_0_rgba(0,0,0,0.6)]"></h1>
                <div class="mx-auto mt-4 max-w-sm rounded-2xl border border-white/10 bg-black/40 px-4 py-6 backdrop-blur-sm"><p class="font-mono text-xs leading-relaxed text-white"><?= e($site['tagline'][0]) ?><br><br><?= e($site['tagline'][1]) ?></p></div>
            </section>
        </div>
        <div class="flex flex-col md:h-screen">
            <div class="flex flex-col md:min-h-0 md:flex-1 md:justify-center md:overflow-y-auto">
                <section aria-label="Streaming links" class="w-full px-4 py-6"><div class="mx-auto flex max-w-sm flex-col gap-3"><?php foreach ($site['platforms'] as $platform) render('components/dsp-card', compact('site', 'platform')); ?></div></section>
                <?php render('components/video', ['site' => $site]); ?>
            </div>
            <?php render('components/footer', ['site' => $site]); ?>
        </div>
    </div>
</main>
