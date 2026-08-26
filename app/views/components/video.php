<?php
$compactDesktop ??= false;
$figmaMobile ??= false;
$videoAspectClass = $figmaMobile ? 'aspect-[2/1] md:aspect-video' : 'aspect-video';
?>
<section aria-label="Music video" class="w-full py-6 <?= $figmaMobile ? 'px-[25px] md:px-4' : 'px-4' ?> <?= $compactDesktop ? 'md:py-2' : '' ?>">
    <div class="mx-auto max-w-sm <?= $compactDesktop ? 'md:max-w-[280px]' : '' ?>">
        <?php if ($site['video']['id'] !== ''): ?>
        <button type="button" data-video="<?= e($site['video']['id']) ?>" data-title="<?= e($site['video']['title']) ?>" aria-label="Play video: <?= e($site['video']['title']) ?>" class="group relative block <?= $videoAspectClass ?> w-full touch-manipulation cursor-pointer overflow-hidden rounded-2xl bg-black text-left shadow-[0_12px_36px_rgba(0,0,0,0.35)] ring-1 ring-white/15 transition duration-300 hover:-translate-y-0.5 hover:ring-white/30 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-red-500/70">
        <?php else: ?>
        <a href="<?= e($site['video']['href']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Watch on YouTube: <?= e($site['video']['title']) ?>" class="group relative block <?= $videoAspectClass ?> w-full touch-manipulation cursor-pointer overflow-hidden rounded-2xl bg-black text-left shadow-[0_12px_36px_rgba(0,0,0,0.35)] ring-1 ring-white/15 transition duration-300 hover:-translate-y-0.5 hover:ring-white/30 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-red-500/70">
        <?php endif; ?>
            <img src="<?= e($site['video']['poster']) ?>" alt="" class="absolute inset-0 size-full object-cover transition-transform duration-500 group-hover:scale-[1.03]">
            <span class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-black/10"></span>
            <span class="absolute inset-0 flex flex-col items-center justify-center gap-3">
                <span class="flex h-[52px] w-[74px] items-center justify-center rounded-[16px] bg-[#ff0033] shadow-[0_8px_24px_rgba(255,0,51,0.4)] transition-transform group-hover:scale-110"><svg viewBox="0 0 24 24" aria-hidden="true" class="ml-1 size-8 fill-white"><path d="M9 6.5v11l9-5.5z"/></svg></span>
                <span class="rounded-full bg-black/55 px-3 py-1 font-mono text-[11px] font-semibold uppercase tracking-[0.12em] text-white backdrop-blur-sm">Play video</span>
            </span>
            <span class="absolute inset-x-0 bottom-0 flex items-end justify-between gap-3 p-4 text-white">
                <span class="min-w-0 truncate font-display text-lg leading-none tracking-wide drop-shadow-md"><?= e($site['video']['title']) ?></span>
                <span class="shrink-0 font-mono text-[10px] uppercase tracking-wider text-white/75">YouTube</span>
            </span>
        <?= $site['video']['id'] !== '' ? '</button>' : '</a>' ?>
    </div>
</section>
