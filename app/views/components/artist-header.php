<?php
$maxWidth ??= '';
$blur ??= false;
$leftClass ??= 'h-8 w-auto';
$rightClass ??= 'h-8 w-auto';
$leftImage ??= '/images/global/core-wordmark.png';
$rightImage ??= '/images/global/ples-mark.svg';
$leftDimensions ??= [600, 137];
$rightDimensions ??= [31, 35];
$paddingClass ??= 'px-4';
?>
<header data-artist-header class="fixed left-1/2 top-0 z-20 flex h-13 w-full -translate-x-1/2 translate-y-0 items-center justify-between overflow-hidden rounded-b-[26px] bg-black/20 <?= e($paddingClass) ?> shadow-[0_4px_4px_rgba(0,0,0,0.25)] transition-transform duration-500 ease-out motion-reduce:transition-none <?= $blur ? 'backdrop-blur-[2px]' : '' ?> <?= e($maxWidth) ?>">
    <img src="<?= e($leftImage) ?>" alt="+CORE" width="<?= (int) $leftDimensions[0] ?>" height="<?= (int) $leftDimensions[1] ?>" decoding="async" class="<?= e($leftClass) ?>">
    <img src="<?= e($rightImage) ?>" alt="Ples+" width="<?= (int) $rightDimensions[0] ?>" height="<?= (int) $rightDimensions[1] ?>" class="<?= e($rightClass) ?>">
</header>
