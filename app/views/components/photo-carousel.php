<?php
// Each photo accepts src, alt, and an optional untransformed centerSrc.
$photos = array_values($photos ?? []);
$label ??= 'Photo gallery';
$className ??= '';
$photoCount = count($photos);
// Repeat small galleries to provide enough physical slides for centered loop mode.
$renderedPhotos = $photos;
if ($photoCount > 1 && $photoCount < 5) {
    $renderedPhotos = array_merge(...array_fill(0, (int) ceil(5 / $photoCount), $photos));
}
?>
<?php if ($photoCount > 0): ?>
<section data-photo-carousel data-photo-count="<?= $photoCount ?>" aria-label="<?= e($label) ?>" aria-roledescription="carousel" class="photo-carousel <?= e($className) ?>">
    <div data-photo-stage class="swiper photo-carousel-stage" tabindex="0" aria-label="Use the arrow keys to browse photos">
        <div class="swiper-wrapper">
        <?php foreach ($renderedPhotos as $index => $photo): ?>
            <div data-photo-slide class="swiper-slide photo-carousel-slide" role="group" aria-roledescription="slide" aria-label="<?= $index % $photoCount + 1 ?> of <?= $photoCount ?>" aria-hidden="<?= $index === 0 ? 'false' : 'true' ?>">
                <div class="swiper-slide-transform photo-carousel-image">
                <img data-photo-center src="<?= e($photo['centerSrc'] ?? $photo['src']) ?>" alt="<?= e($photo['alt'] ?? '') ?>" <?= !isset($photo['centerSrc']) && isset($photo['centerTransform']) ? 'style="object-fit: fill; transform: ' . e($photo['centerTransform']) . '; transform-origin: 0 0;"' : '' ?> width="288" height="288" loading="lazy" decoding="async">
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php if ($photoCount > 1): ?>
        <div class="photo-carousel-controls" aria-label="Photo carousel controls">
            <button type="button" data-photo-previous aria-label="Previous photo">&#8592;</button>
            <div class="photo-carousel-dots">
                <?php foreach ($photos as $index => $photo): ?>
                    <button type="button" data-photo-go="<?= $index ?>" aria-label="Show photo <?= $index + 1 ?>" <?= $index === 0 ? 'aria-current="true"' : '' ?>></button>
                <?php endforeach; ?>
            </div>
            <button type="button" data-photo-next aria-label="Next photo">&#8594;</button>
        </div>
    <?php endif; ?>
    <p data-photo-status class="sr-only" aria-live="polite">Photo 1 of <?= $photoCount ?></p>
</section>
<?php endif; ?>
