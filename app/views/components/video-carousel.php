<?php
$videos ??= [];
$videos = array_values($videos);
$label ??= 'YouTube videos';
$className ??= '';
$trackPaddingClass ??= 'px-4';
$slideCount = count($videos);
?>
<?php if ($slideCount > 0): ?>
<section aria-label="<?= e($label) ?>" data-video-carousel class="<?= e($className) ?>">
    <h2 class="sr-only"><?= e($label) ?></h2>
    <div data-carousel-track tabindex="0" role="group" aria-roledescription="carousel" aria-label="Swipe or use the arrow keys to choose a video" class="video-carousel-track relative flex snap-x snap-mandatory gap-3 overflow-x-auto <?= e($trackPaddingClass) ?>">
        <?php foreach ($videos as $index => $video): ?>
            <div data-carousel-slide role="group" aria-roledescription="slide" aria-label="<?= ($index + 1) ?> of <?= $slideCount ?>: <?= e($video['title']) ?>" class="w-full shrink-0 snap-center">
                <button type="button" data-video="<?= e($video['id']) ?>" data-title="<?= e($video['title']) ?>" aria-label="Play <?= e($video['title']) ?> on YouTube" class="group relative block aspect-video w-full cursor-pointer overflow-hidden rounded-[16px] bg-black text-left focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-red-500/70">
                    <img src="<?= e($video['poster']) ?>" alt="" width="<?= (int) ($video['poster_size'][0] ?? 1280) ?>" height="<?= (int) ($video['poster_size'][1] ?? 720) ?>" loading="lazy" decoding="async" class="absolute inset-0 size-full object-cover">
                    <span class="absolute inset-0 flex items-center justify-center"><span class="flex h-[40px] w-[59px] items-center justify-center rounded-[10px] bg-[#ff0033] shadow-[0_4px_12px_rgba(0,0,0,0.3)] transition-transform group-hover:scale-110"><svg viewBox="0 0 24 24" aria-hidden="true" class="ml-1 size-7 fill-white"><path d="M9 6.5v11l9-5.5z"/></svg></span></span>
                </button>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="mt-2 flex items-center justify-center gap-4" aria-label="Video carousel controls">
        <button type="button" data-carousel-previous aria-label="Previous video" disabled class="flex size-8 items-center justify-center rounded-full bg-white/15 text-white transition hover:bg-white/25 disabled:cursor-not-allowed disabled:opacity-40">&#8592;</button>
        <div class="flex items-center gap-2">
            <?php foreach ($videos as $index => $video): ?>
                <button type="button" data-carousel-go="<?= $index ?>" aria-label="Show <?= e($video['title']) ?>" <?= $index === 0 ? 'aria-current="true"' : '' ?> class="size-2.5 rounded-full bg-white transition-opacity <?= $index === 0 ? '' : 'opacity-40' ?>"></button>
            <?php endforeach; ?>
        </div>
        <button type="button" data-carousel-next aria-label="Next video" class="flex size-8 items-center justify-center rounded-full bg-white/15 text-white transition hover:bg-white/25 disabled:cursor-not-allowed disabled:opacity-40">&#8594;</button>
    </div>
</section>
<?php endif; ?>
