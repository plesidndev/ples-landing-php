#!/usr/bin/env sh
# Generates responsive derivatives (WebP + original format) for the layout images.
# Requires macOS `sips` and `cwebp`. Re-run after replacing any source image, then
# commit the derivatives — production has no image pipeline.
#
#   ./tools/build-images.sh

set -eu

ROOT=$(CDPATH= cd -- "$(dirname -- "$0")/.." && pwd)
IMG="$ROOT/public/images"
WIDTHS="480 768 1200 1600"

for t in sips cwebp; do
    command -v "$t" >/dev/null 2>&1 || { echo "Missing required tool: $t"; exit 1; }
done

# Sources that are rendered at layout scale and therefore need size variants.
SOURCES="
devadata/artwork.png
devadata/hero.jpg
devadata/devabackgr.jpg
kayl/hero.jpg
kayl/bg-pattern.jpg
lili/hero.jpg
lili/bg-pattern.jpg
callii/hero-swirl-bg.jpg
callii/photo-collage.jpg
maf/hero.png
"

for rel in $SOURCES; do
    src="$IMG/$rel"
    [ -f "$src" ] || { echo "skip (missing): $rel"; continue; }

    ext=${rel##*.}
    stem=${src%.*}
    srcw=$(sips -g pixelWidth "$src" | awk '/pixelWidth/{print $2}')

    for w in $WIDTHS; do
        # Never upscale past the source.
        [ "$w" -ge "$srcw" ] && continue

        out="$stem-$w.$ext"
        if [ "$ext" = "png" ]; then
            sips --resampleWidth "$w" "$src" --out "$out" >/dev/null
        else
            sips --resampleWidth "$w" -s format jpeg -s formatOptions 78 "$src" --out "$out" >/dev/null
        fi
        cwebp -quiet -q 80 -alpha_q 90 "$out" -o "$stem-$w.webp"
    done

    # Full-size WebP alongside the original, for viewports at or above the source width.
    cwebp -quiet -q 80 -alpha_q 90 "$src" -o "$stem.webp"
    echo "built: $rel (source ${srcw}px)"
done

echo
echo "Derivatives written next to their sources. Commit them with the source image."
