<?php
$variant ??= 'default';
$logoHeight ??= 22;
$rowClass = $variant === 'glass'
    ? 'h-14 gap-4 bg-[#d9d9d9]/20 pl-6 pr-4'
    : 'gap-4 border border-white/10 bg-white/10 px-4 py-2 backdrop-blur-sm';
$logoWidth = (int) round($logoHeight * $platform['aspect']);
?>
<div class="flex items-center justify-between rounded-full <?= $rowClass ?>">
    <img src="<?= e($platform['icon']) ?>" alt="<?= e($platform['name']) ?>" height="<?= $logoHeight ?>" width="<?= $logoWidth ?>" class="shrink-0 object-contain" style="height:<?= $logoHeight ?>px;width:<?= $logoWidth ?>px">
    <a href="<?= e($platform['href']) ?>" target="_blank" rel="noopener noreferrer" data-dsp="<?= e($platform['id']) ?>" aria-label="Listen Now: <?= e($site['name']) ?> on <?= e($platform['name']) ?>" class="inline-flex items-center justify-center rounded-full bg-white px-4 py-2 font-mono text-sm font-medium text-black drop-shadow-[0_4px_2px_rgba(0,0,0,0.25)] transition-colors hover:bg-zinc-200">Listen Now</a>
</div>
