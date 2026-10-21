<?php
$className ??= '';
$available = ($video['id'] ?? '') !== '' || ($video['href'] ?? '') !== '';
$isEmbed = ($video['id'] ?? '') !== '';
?>
<?php if ($isEmbed): ?>
<button type="button" data-video="<?= e($video['id']) ?>" data-title="<?= e($video['title']) ?>" aria-label="Play <?= e($video['title']) ?>" class="video-card <?= e($className) ?>">
<?php elseif ($available): ?>
<a href="<?= e($video['href']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Watch <?= e($video['title']) ?>" class="video-card <?= e($className) ?>">
<?php else: ?>
<div role="img" aria-label="<?= e($video['title']) ?> — video coming soon" class="video-card video-card-pending <?= e($className) ?>">
<?php endif; ?>
    <?php if (($video['poster'] ?? '') !== ''): ?>
        <img src="<?= e($video['poster']) ?>" alt="" width="1280" height="720" loading="lazy" decoding="async" class="absolute inset-0 size-full object-cover">
    <?php elseif ($isEmbed): ?>
        <img src="https://i.ytimg.com/vi/<?= e($video['id']) ?>/hqdefault.jpg" alt="" width="480" height="360" loading="lazy" decoding="async" class="absolute inset-0 size-full object-cover">
    <?php else: ?>
        <span class="video-card-title"><?= e($video['title']) ?></span>
    <?php endif; ?>
    <span aria-hidden="true" class="absolute inset-0 flex items-center justify-center"><span class="flex h-[40px] w-[59px] items-center justify-center rounded-[10px] bg-[#ff0033]"><svg viewBox="0 0 24 24" class="ml-1 size-7 fill-white"><path d="M9 6.5v11l9-5.5z"/></svg></span></span>
<?= $isEmbed ? '</button>' : ($available ? '</a>' : '</div>') ?>
