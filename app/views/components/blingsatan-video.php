<div class="blingsatan-video">
    <?php if ($video['id'] !== ''): ?>
    <button type="button" data-video="<?= e($video['id']) ?>" data-title="<?= e($video['title']) ?>" aria-label="Play <?= e($video['title']) ?>" class="relative block aspect-video w-full overflow-hidden rounded-2xl bg-black">
    <?php else: ?>
    <a href="<?= e($video['href']) ?>" target="_blank" rel="noopener noreferrer" aria-label="Watch <?= e($video['title']) ?> on YouTube" class="relative block aspect-video w-full overflow-hidden rounded-2xl bg-black">
    <?php endif; ?>
        <img src="<?= e($video['poster']) ?>" alt="" width="1280" height="720" loading="lazy" decoding="async" class="absolute inset-0 size-full object-cover">
        <span class="absolute inset-0 flex items-center justify-center"><span class="flex h-[40px] w-[59px] items-center justify-center rounded-[10px] bg-[#ff0033]"><svg viewBox="0 0 24 24" aria-hidden="true" class="ml-1 size-7 fill-white"><path d="M9 6.5v11l9-5.5z"/></svg></span></span>
    <?= $video['id'] !== '' ? '</button>' : '</a>' ?>
</div>
