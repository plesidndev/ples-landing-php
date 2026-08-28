<?php $maf ??= false; ?>
<footer class="flex h-[52px] w-full items-center justify-between bg-[#d9d9d9]/20 px-4 shadow-[4px_0_4px_rgba(0,0,0,0.25)] backdrop-blur-lg <?= $maf ? '' : 'md:backdrop-blur-none' ?>">
    <img src="/images/global/ples-connect-logo.png" alt="Ples+ Connect" width="1200" height="626" loading="lazy" decoding="async" class="h-9 w-auto shrink-0">
    <div class="flex shrink-0 flex-col items-end gap-[3px]">
        <p class="font-display text-[15px] leading-none tracking-[-0.333px] text-white">make your own core</p>
        <div class="flex items-center gap-1.5">
            <a href="<?= e($site['app_stores']['google_play']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Get it on Google Play" class="relative block h-4 w-[49px] overflow-hidden"><img src="/images/global/google-play-badge.png" alt="" width="49" height="49" loading="lazy" decoding="async" class="absolute left-0 top-[-8.5px] max-w-none"></a>
            <a href="<?= e($site['app_stores']['apple_store']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Download on the App Store" class="flex h-[14px] w-[55px] items-center justify-center bg-[#d9d9d9]"><img src="/images/global/app-store-badge.png" alt="" width="600" height="132" loading="lazy" decoding="async" class="h-3 w-auto"></a>
        </div>
    </div>
</footer>
