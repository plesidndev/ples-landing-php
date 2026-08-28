<?php
$maxWidth ??= '';
$blur ??= false;
$leftClass ??= 'h-8 w-auto';
$rightClass ??= 'h-8 w-auto';
?>
<header data-artist-header class="fixed left-1/2 top-0 z-20 flex h-13 w-full -translate-x-1/2 translate-y-0 items-center justify-between overflow-hidden rounded-b-[26px] bg-black/20 px-4 shadow-[0_4px_4px_rgba(0,0,0,0.25)] transition-transform duration-500 ease-out motion-reduce:transition-none <?= $blur ? 'backdrop-blur-[2px]' : '' ?> <?= e($maxWidth) ?>">
    <img src="/images/global/core-wordmark.png" alt="+CORE" width="600" height="137" decoding="async" class="<?= e($leftClass) ?>">
    <img src="/images/global/ples-mark.svg" alt="Ples+" width="31" height="35" class="<?= e($rightClass) ?>">
</header>
