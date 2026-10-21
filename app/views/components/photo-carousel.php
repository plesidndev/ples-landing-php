<?php
// Each photo accepts src, alt, and an optional untransformed centerSrc.
$photos = array_values($photos ?? []);
$label ??= 'Photo gallery';
$className ??= '';
$photoCount = count($photos);
?>
<?php if ($photoCount > 0): ?>
<section data-photo-carousel aria-label="<?= e($label) ?>" aria-roledescription="carousel" class="photo-carousel <?= e($className) ?>">
    <div data-photo-stage class="photo-carousel-stage" tabindex="0" aria-label="Use the arrow keys to browse photos">
        <?php foreach ($photos as $index => $photo): ?>
            <?php
            $offset = $index > $photoCount / 2 ? $index - $photoCount : $index;
            $position = abs($offset) > 2 ? 'hidden' : ($offset < 0 ? 5 + $offset : $offset);
            ?>
            <div data-photo-slide data-position="<?= $position ?>" class="photo-carousel-slide" role="group" aria-roledescription="slide" aria-label="<?= $index + 1 ?> of <?= $photoCount ?>" aria-hidden="<?= $index === 0 ? 'false' : 'true' ?>">
                <img data-photo-center src="<?= e($photo['centerSrc'] ?? $photo['src']) ?>" alt="<?= e($photo['alt'] ?? '') ?>" width="288" height="288" loading="lazy" decoding="async">
                <img data-photo-side src="<?= e($photo['src']) ?>" alt="" aria-hidden="true" width="288" height="288" loading="lazy" decoding="async">
            </div>
        <?php endforeach; ?>
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
