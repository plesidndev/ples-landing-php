<main class="flex flex-1 flex-col items-center justify-center gap-12 bg-black px-6 py-20">
    <div class="flex flex-col items-center gap-4">
        <h1 class="sr-only"><?= e($site['name']) ?></h1>
        <img src="/images/global/ples-connect-logo.png" alt="<?= e($site['name']) ?>" width="1200" height="626" fetchpriority="high" decoding="async" class="h-auto w-full max-w-[260px]">
        <p class="font-display text-[15px] leading-none tracking-[-0.333px] text-white/60">make your own core</p>
    </div>

    <?php if ($site['siblings'] !== []): ?>
        <nav aria-label="Artis" class="w-full max-w-sm">
            <h2 class="mb-3 text-center font-mono text-[10px] uppercase tracking-[0.14em] text-white/40">Artis</h2>
            <ul class="flex flex-col gap-2">
                <?php foreach ($site['siblings'] as $artist): ?>
                    <li>
                        <a href="<?= e($artist['url']) ?>" class="flex items-center justify-between gap-4 rounded-full border border-white/10 bg-white/5 px-5 py-3 transition-colors hover:border-white/25 hover:bg-white/10">
                            <span class="font-display text-lg leading-none tracking-wide text-white"><?= e($artist['name']) ?></span>
                            <span class="truncate font-mono text-[10px] uppercase tracking-wider text-white/45"><?= e($artist['release']) ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    <?php endif; ?>
</main>
