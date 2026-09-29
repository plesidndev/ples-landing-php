<?php
$variant ??= 'default';
$logoHeight ??= 22;
$releaseLabel ??= $site['release'];
$callii = $variant === 'callii';
$rowClass = $variant === 'glass'
    ? 'h-14 gap-4 bg-[#d9d9d9]/20 pl-6 pr-4'
    : ($callii ? 'callii-dsp-row h-14 gap-4 pl-[18px] pr-[16px]' : 'gap-4 border border-white/10 bg-white/10 px-4 py-2 backdrop-blur-sm');
$logoHeight = $callii ? 28 : $logoHeight;
$logoWidth = (int) round($logoHeight * $platform['aspect']);
?>
<div class="flex items-center justify-between rounded-full <?= $rowClass ?>">
    <?php if ($callii && $platform['id'] === 'spotify'): ?>
        <img src="/images/callii/figma-spotify.svg" alt="Spotify" loading="lazy" decoding="async" class="shrink-0">
    <?php else: ?>
        <img src="<?= e($platform['icon']) ?>" alt="<?= e($platform['name']) ?>" height="<?= $logoHeight ?>" width="<?= $logoWidth ?>" loading="lazy" decoding="async" class="shrink-0 object-contain" style="height:<?= $logoHeight ?>px;width:<?= $logoWidth ?>px">
    <?php endif; ?>
    <a href="<?= e($platform['href']) ?>" target="_blank" rel="noopener noreferrer" data-dsp="<?= e($platform['id']) ?>" aria-label="Listen to <?= e($releaseLabel) ?> by <?= e($site['name']) ?> on <?= e($platform['name']) ?>" class="<?= $callii ? 'callii-listen-pill h-10 min-w-[113px] px-3 font-mono text-[12px] font-normal tracking-[0.02em]' : 'bg-white px-4 py-2 font-mono text-sm font-medium' ?> inline-flex items-center justify-center rounded-full text-black drop-shadow-[0_4px_2px_rgba(0,0,0,0.25)] transition-colors hover:brightness-95">Listen Now</a>
</div>
