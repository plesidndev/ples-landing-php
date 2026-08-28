<main class="relative flex flex-1 flex-col items-center justify-center px-6 py-20 text-center">
    <p class="font-display text-[88px] leading-none tracking-wide text-white/90">404</p>
    <h1 class="mt-2 font-display text-2xl tracking-wide text-white">Halaman tidak ditemukan</h1>
    <p class="mt-3 max-w-sm font-mono text-xs leading-relaxed text-white/70">
        Halaman yang kamu cari tidak ada atau sudah dipindahkan.
    </p>

    <a href="/" class="mt-8 inline-flex items-center justify-center rounded-full bg-white px-6 py-2.5 font-mono text-sm font-medium text-black transition-colors hover:bg-zinc-200">
        Kembali ke beranda
    </a>

    <?php if ($site['platforms'] !== []): ?>
        <section aria-label="Streaming links" class="mt-10 w-full max-w-sm">
            <p class="mb-3 font-mono text-[11px] uppercase tracking-[0.12em] text-white/50">
                Dengarkan <?= e($site['release']) ?>
            </p>
            <div class="flex flex-col gap-3">
                <?php foreach ($site['platforms'] as $platform) render('components/dsp-card', compact('site', 'platform')); ?>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php render('components/footer', ['site' => $site]); ?>
