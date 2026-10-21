<?php

declare(strict_types=1);

// Card order follows this list; an artist opts in per platform by supplying a link.
$dspBrands = [
    'spotify' => ['name' => 'Spotify', 'icon' => '/images/dsp/spotify.svg', 'aspect' => 90.19 / 29.53],
    'apple-music' => ['name' => 'Apple Music', 'icon' => '/images/dsp/apple-music.png', 'aspect' => 920 / 221],
    'youtube-music' => ['name' => 'YouTube Music', 'icon' => '/images/dsp/youtube-music.svg', 'aspect' => 122 / 32],
    'tiktok' => ['name' => 'TikTok', 'icon' => '/images/dsp/tiktok.png', 'aspect' => 658 / 161],
];

/**
 * Every link is written as ['href' => ..., 'active' => bool] so the on/off state of each
 * platform is visible at a glance. Flipping 'active' to false keeps the URL on file while
 * removing the card and dropping it from the derived sameAs at the same time.
 *
 * A bare URL string is still accepted and treated as active.
 */
$platforms = static function (array $links) use ($dspBrands): array {
    $cards = [];

    foreach ($dspBrands as $id => $brand) {
        if (!isset($links[$id])) {
            continue;
        }

        $link = $links[$id];
        $href = is_array($link) ? (string) ($link['href'] ?? '') : (string) $link;
        $active = is_array($link) ? (bool) ($link['active'] ?? true) : true;

        if (!$active || $href === '') {
            continue;
        }

        $cards[] = ['id' => $id, 'href' => $href] + $brand;
    }

    return $cards;
};

$common = [
    'locale' => 'id_ID',
    'background_color' => '#000000',
    'hub_url' => 'https://plesconnect.app',
    'app_stores' => ['google_play' => 'https://play.google.com', 'apple_store' => 'https://apps.apple.com'],
];

$artists = [
    'devadata' => $common + [
        'id' => 'devadata', 'indexable' => true, 'crawlable' => true, 'view' => 'artists/devadata', 'name' => 'DEVADATA', 'release' => 'SAPUTANAH PAPUA',
        'title' => 'DEVADATA — SAPUTANAH PAPUA | Ples+',
        'description' => 'Dengarkan “SAPUTANAH PAPUA” dari DEVADATA sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://devadata.plesconnect.app', 'theme_color' => '#120b09',
        'og_image' => '/images/devadata/og-image.jpg', 'og_size' => [1200, 630],
        'og_image_alt' => 'DEVADATA band portrait in front of a wall of red televisions',
        'lcp_image_desktop' => '/images/devadata/artwork.png', 'lcp_image' => '/images/devadata/hero.jpg', 'genre' => 'Metal', 'artist_same_as' => [],
        'keywords' => ['DEVADATA', 'SAPUTANAH PAPUA', 'Ples+', 'musik Indonesia', 'lagu baru'],
        'tagline' => ['SAPUTANAH PAPUA'],
        'platforms' => $platforms([
            'spotify' => ['href' => 'https://open.spotify.com/track/7bimHjV1lllUlChNnAMt5v', 'active' => true],
            'apple-music' => ['href' => 'https://music.apple.com/id/song/sa-pu-tanah-papua/6805356242', 'active' => true],
            'tiktok' => ['href' => 'https://www.tiktok.com/music/SA-PU-TANAH-PAPUA-7678227842179303441', 'active' => true],
        ]),
        'extra_same_as' => ['https://www.youtube.com/watch?v=k0Zc--bj2vc'],
        'video' => ['id' => 'k0Zc--bj2vc', 'href' => 'https://www.youtube.com/watch?v=k0Zc--bj2vc&list=RDk0Zc--bj2vc&start_radio=1', 'title' => 'DEVADATA — SAPUTANAH PAPUA', 'poster' => '/images/devadata/hero.jpg'],
        // Figma 192:1544: start with the center card, then continue clockwise.
        'photos' => [
            ['src' => '/images/devadata/photo-2.png', 'alt' => 'DEVADATA band photo 2'],
            ['src' => '/images/devadata/photo-4.png', 'alt' => 'DEVADATA band photo 4', 'centerTransform' => 'matrix3d(1.354167,.177083,0,.00245949,0,1.3125,0,0,0,0,1,0,0,-22.5,0,1)'],
            ['src' => '/images/devadata/photo-5.png', 'alt' => 'DEVADATA band photo 5', 'centerTransform' => 'matrix3d(1.356322,.178161,0,.00247446,0,1.310345,0,0,0,0,1,0,0,-22.344828,0,1)'],
            ['src' => '/images/devadata/photo-3.png', 'alt' => 'DEVADATA band photo 3', 'centerTransform' => 'matrix3d(.737288,-.131356,0,-.00182486,0,.966102,0,0,0,0,1,0,0,2.440678,0,1)'],
            ['src' => '/images/devadata/photo-1.png', 'alt' => 'DEVADATA band photo 1', 'centerTransform' => 'matrix3d(.738462,-.130769,0,-.00181624,0,.969231,0,0,0,0,1,0,0,2.215385,0,1)'],
        ],
    ],
    'blingsatan' => $common + [
        'id' => 'blingsatan', 'indexable' => true, 'crawlable' => true, 'view' => 'artists/blingsatan', 'name' => 'BLINGSATAN', 'release' => 'Petaruh',
        'title' => 'BLINGSATAN — Petaruh | Ples+',
        'description' => 'Dengarkan “Petaruh” dari BLINGSATAN dan temukan video serta musik lainnya di sini.',
        'default_url' => 'https://blingsatan.plesconnect.app', 'theme_color' => '#030923',
        'og_image' => '/images/blingsatan/hero-1200.png', 'og_size' => [1200, 1601],
        'og_image_alt' => 'BLINGSATAN band portrait',
        'lcp_image_desktop' => '/images/blingsatan/hero.png', 'lcp_image' => '/images/blingsatan/hero.png',
        'genre' => 'Rock', 'artist_same_as' => ['https://music.apple.com/us/artist/blingsatan/1429060178'],
        'keywords' => ['BLINGSATAN', 'Petaruh', 'Ples+', 'musik Indonesia', 'lagu baru'], 'tagline' => ['OUT NOW!!', 'Petaruh'],
        // Temporary destinations approved by the user; replace with artist-supplied links.
        'platforms' => $platforms([
            'spotify' => ['href' => 'https://open.spotify.com/search/Blingsatan%20Petaruh', 'active' => true],
            'apple-music' => ['href' => 'https://music.apple.com/us/album/petaruh-single/1895953767', 'active' => true],
            'tiktok' => ['href' => 'https://www.tiktok.com/search?q=Blingsatan%20Petaruh', 'active' => true],
        ]),
        'channel_platforms' => $platforms([
            'spotify' => ['href' => 'https://open.spotify.com/search/Blingsatan', 'active' => true],
            'apple-music' => ['href' => 'https://music.apple.com/us/artist/blingsatan/1429060178', 'active' => true],
            'tiktok' => ['href' => 'https://www.tiktok.com/search?q=Blingsatan', 'active' => true],
        ]),
        'extra_same_as' => [],
        'video' => ['id' => '', 'href' => 'https://www.youtube.com/results?search_query=Blingsatan+Petaruh', 'title' => 'BLINGSATAN — Petaruh', 'poster' => '/images/blingsatan/release-video.jpg'],
        'channel_video' => ['id' => '', 'href' => 'https://www.youtube.com/results?search_query=Blingsatan+Karna+Kita+Hidup+Di+Dunia', 'title' => 'BLINGSATAN — Karna Kita Hidup Di Dunia', 'poster' => '/images/blingsatan/channel-video.jpg'],
        'photos' => [
            ['src' => '/images/blingsatan/photo-2.png', 'alt' => 'BLINGSATAN band photo 2'],
            // Inverse perspective restores the baked trapezoid to a square for the active card.
            ['src' => '/images/blingsatan/photo-4.png', 'alt' => 'BLINGSATAN band photo 4', 'centerTransform' => 'matrix3d(1.354167,.177083,0,.00245949,0,1.3125,0,0,0,0,1,0,0,-22.5,0,1)'],
            ['src' => '/images/blingsatan/photo-5.png', 'alt' => 'BLINGSATAN band photo 5', 'centerTransform' => 'matrix3d(1.356322,.178161,0,.00247446,0,1.310345,0,0,0,0,1,0,0,-22.344828,0,1)'],
            ['src' => '/images/blingsatan/photo-1.png', 'alt' => 'BLINGSATAN band photo 1', 'centerTransform' => 'matrix3d(.738462,-.130769,0,-.00181624,0,.969231,0,0,0,0,1,0,0,2.215385,0,1)'],
        ],
    ],
    'kayl' => $common + [
        'id' => 'kayl', 'indexable' => true, 'crawlable' => true, 'view' => 'artists/kayl', 'name' => 'KAYL', 'release' => 'dar der D0R!!',
        'title' => 'KAYL — dar der D0R!! | Ples+',
        'description' => 'Dengarkan “dar der D0R!!” dari KAYL sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://kayl.plesconnect.app', 'theme_color' => '#000000',
        'og_image' => '/images/kayl/og-image.jpg', 'og_size' => [1200, 630],
        'og_image_alt' => 'KAYL portrait beside the dar der D0R!! wordmark',
        'lcp_image_desktop' => '', 'lcp_image' => '/images/kayl/hero.jpg', 'genre' => 'Hip-Hop', 'artist_same_as' => [],
        'keywords' => ['KAYL', 'dar der D0R!!', 'Ples+', 'musik Indonesia', 'lagu baru'],
        'tagline' => ['dar der D0R!!'],
        'platforms' => $platforms([
            'spotify' => ['href' => 'https://open.spotify.com/track/76485dUp19wqpqNRg2xYLo', 'active' => true],
            'apple-music' => ['href' => 'https://music.apple.com/id/song/meledak/6805356420', 'active' => true],
            'youtube-music' => ['href' => 'https://music.youtube.com/watch?v=3Up9jAEsDKE', 'active' => true],
            'tiktok' => ['href' => 'https://www.tiktok.com/music/Meledak-7678229289113176080', 'active' => true],
        ]),
        'extra_same_as' => ['https://www.youtube.com/watch?v=dgXfPAOGd4o'],
        'video' => ['id' => 'dgXfPAOGd4o', 'href' => 'https://www.youtube.com/watch?v=dgXfPAOGd4o', 'title' => 'KAYL — dar der D0R!!', 'poster' => '/images/kayl/hero.jpg'],
    ],
    'callii' => $common + [
        'id' => 'callii', 'indexable' => true, 'crawlable' => true, 'view' => 'artists/callii', 'name' => 'CALLII', 'release' => 'BRANKAS ft 6SENTANI',
        'title' => 'CALLII — BRANKAS ft 6SENTANI | Ples+',
        'description' => 'Dengarkan “BRANKAS” dari CALLII bersama 6SENTANI di Spotify dan YouTube.',
        'default_url' => 'https://callii.plesconnect.app', 'theme_color' => '#000000',
        'og_image' => '/images/callii/brngakas-hero-1200.png', 'og_size' => [1200, 1200],
        'og_image_alt' => 'Illustrated CALLII and 6SENTANI BRANKAS artwork',
        'lcp_image_desktop' => '', 'lcp_image' => '/images/callii/brngakas-hero.png', 'genre' => 'Hip-Hop', 'artist_same_as' => [],
        'keywords' => ['CALLII', 'BRANKAS', '6SENTANI', 'MULAI LAGI', 'Ples+', 'musik Indonesia', 'lagu baru'],
        'tagline' => ['BARat!!!', 'BRANKAS ft 6SENTANI out now'],
        'feature_platforms' => $platforms([
            'spotify' => ['href' => 'https://open.spotify.com/track/7lUG77qQc1HUcNZsA0ykfw', 'active' => true],
        ]),
        'platforms' => $platforms([
            'spotify' => ['href' => 'https://open.spotify.com/track/5hPbcmpqnRJafzAJv35dvE', 'active' => true],
            'apple-music' => ['href' => 'https://music.apple.com/us/album/mulaii-llagi/6789538157', 'active' => true],
            'tiktok' => ['href' => 'https://www.tiktok.com/music/MULAii-LLAGI-7660836886660040721', 'active' => true],
        ]),
        'extra_same_as' => ['https://www.instagram.com/reels/audio/886346697863290', 'https://www.youtube.com/watch?v=4HOZc9w9twY', 'https://www.youtube.com/watch?v=ZTLtF80nvf4'],
        'feature_video' => ['id' => '4HOZc9w9twY', 'title' => 'CALLII — BRANKAS ft 6SENTANI', 'description' => 'Dengarkan BRANKAS dari CALLII bersama 6SENTANI di YouTube.', 'poster' => '/images/callii/brankas-youtube-poster.jpg', 'poster_size' => [480, 360], 'thumbnail_url' => 'https://i.ytimg.com/vi/4HOZc9w9twY/hqdefault.jpg'],
        'video' => ['id' => 'ZTLtF80nvf4', 'title' => 'CALLII — MULAI LAGI', 'description' => 'Tonton video musik MULAI LAGI dari CALLII.', 'poster' => '/images/callii/mulai-lagi-video-poster.jpg'],
    ],
    'maf' => $common + [
        'id' => 'maf', 'indexable' => true, 'crawlable' => true, 'view' => 'artists/maf', 'name' => 'MAF', 'release' => 'StarBoy',
        'title' => 'MAF — StarBoy | Ples+', 'description' => 'Dengarkan StarBoy dari MAF sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://maf.plesconnect.app', 'theme_color' => '#0b241f',
        'og_image' => '/images/maf/og-image.jpg', 'og_size' => [1200, 630],
        'og_image_alt' => 'Classical marble statue representing MAF',
        'lcp_image_desktop' => '', 'lcp_image' => '/images/maf/hero.png', 'genre' => 'Hip-Hop', 'artist_same_as' => ['https://www.tiktok.com/@mafworld', 'https://www.instagram.com/mafintheair'],
        'keywords' => ['MAF', 'StarBoy', 'Ples+', 'musik Indonesia', 'lagu baru'], 'tagline' => ['StarBoy'],
        'platforms' => $platforms([
            'spotify' => ['href' => 'https://open.spotify.com/track/0QMEYe6fAQkgbPMRxx4pX', 'active' => true],
            'apple-music' => ['href' => 'https://music.apple.com/id/album/maf/6795910681', 'active' => true],
            'tiktok' => ['href' => 'https://www.tiktok.com/@mafworld', 'active' => true],
        ]),
        'extra_same_as' => ['https://www.instagram.com/mafintheair', 'https://youtu.be/IRp4ClBpGPM'],
        'video' => ['id' => 'IRp4ClBpGPM', 'title' => 'MAF — StarBoy', 'poster' => '/images/maf/hero.png'],
    ],
    'lili' => $common + [
        'id' => 'lili', 'indexable' => true, 'crawlable' => true, 'view' => 'artists/lili', 'name' => 'LiLi', 'release' => 'Honest',
        'title' => 'LiLi — Honest | Ples+', 'description' => 'Dengarkan “Honest” dari LiLi sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://lili.plesconnect.app', 'theme_color' => '#0b0b0b',
        'og_image' => '/images/lili/og-image.jpg', 'og_size' => [1200, 630],
        'og_image_alt' => 'LiLi lying across a bed scattered with rose petals',
        'lcp_image_desktop' => '', 'lcp_image' => '/images/lili/hero.jpg', 'genre' => 'Pop', 'artist_same_as' => [],
        'keywords' => ['LiLi', 'Honest', 'Ples+', 'musik Indonesia', 'lagu baru'], 'tagline' => ['Honest'],
        'platforms' => $platforms([
            'spotify' => ['href' => 'https://open.spotify.com/track/2hiz92sjwxQdcipghBRRDP', 'active' => true],
            'apple-music' => ['href' => 'https://music.apple.com/id/album/honest-single/6799972819', 'active' => true],
            'tiktok' => ['href' => 'https://vt.tiktok.com/ZS9khMsh2FdUy-O2UtG/', 'active' => true],
        ]),
        'extra_same_as' => ['https://found.ee/lili_honest', 'https://youtu.be/Lsx3tx8fve0'],
        'video' => ['id' => 'Lsx3tx8fve0', 'title' => 'LiLi — Honest', 'poster' => '/images/lili/video-poster.jpg'],
    ],
    'default' => $common + [
        'id' => 'default', 'indexable' => false, 'crawlable' => true, 'view' => 'artists/default', 'name' => 'Ples+ Connect', 'release' => '',
        'title' => 'Ples+ Connect — Make Your Own Core',
        'description' => 'Dengarkan rilis terbaru dari DEVADATA, BLINGSATAN, KAYL, CALLII, MAF, dan LiLi di Spotify, Apple Music, YouTube Music, dan TikTok.',
        'default_url' => 'https://plesconnect.app',
        // Dedicated card: the logo PNG is white-on-transparent, which social scrapers
        // flatten to white and render as a blank image.
        'theme_color' => '#000000', 'og_image' => '/images/global/og-image.jpg', 'og_size' => [1200, 630],
        'og_image_alt' => 'Ples+ Connect — make your own core', 'lcp_image_desktop' => '', 'lcp_image' => '', 'genre' => '', 'artist_same_as' => [],
        'keywords' => ['Ples+', 'Ples Connect'], 'tagline' => [], 'platforms' => [], 'extra_same_as' => [],
        'video' => ['id' => '', 'title' => '', 'poster' => ''],
    ],
];

// sameAs is derived from both featured and secondary buttons: an inactive platform
// is absent from the page and schema, and each URL only needs editing in one place.
foreach ($artists as $id => $artist) {
    $artists[$id]['same_as'] = array_values(array_unique(array_merge(
        array_column($artist['feature_platforms'] ?? [], 'href'),
        array_column($artist['platforms'], 'href'),
        $artist['extra_same_as'],
    )));
}

return $artists;
