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
        'id' => 'callii', 'indexable' => true, 'crawlable' => true, 'view' => 'artists/callii', 'name' => 'CALLII', 'release' => 'MULAI LAGI',
        'title' => 'CALLII — MULAI LAGI | Ples+',
        'description' => 'Jatuh 7x, gw bangkit 8x. Dengerin “MULAI LAGI” dari CALLII sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://callii.plesconnect.app', 'theme_color' => '#000000',
        'og_image' => '/images/callii/og-image.jpg', 'og_size' => [1200, 630],
        'og_image_alt' => 'CALLII photo collage from the MULAI LAGI era',
        'lcp_image_desktop' => '', 'lcp_image' => '/images/callii/photo-collage.jpg', 'genre' => 'Hip-Hop', 'artist_same_as' => [],
        'keywords' => ['CALLII', 'MULAI LAGI', 'Ples+', 'musik Indonesia', 'lagu baru'],
        'tagline' => ['Jatuh 7x, gw bangkit 8x', '“MULAI LAGI” out now on all platforms'],
        'platforms' => $platforms([
            'spotify' => ['href' => 'https://open.spotify.com/track/5hPbcmpqnRJafzAJv35dvE', 'active' => true],
            'apple-music' => ['href' => 'https://music.apple.com/us/album/mulaii-llagi/6789538157', 'active' => true],
            'tiktok' => ['href' => 'https://www.tiktok.com/music/MULAii-LLAGI-7660836886660040721', 'active' => true],
        ]),
        'extra_same_as' => ['https://www.instagram.com/reels/audio/886346697863290', 'https://www.youtube.com/watch?v=ZTLtF80nvf4'],
        'video' => ['id' => 'ZTLtF80nvf4', 'title' => 'CALLII — MULAI LAGI', 'poster' => '/images/callii/photo-collage.jpg'],
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
        'description' => 'Dengarkan rilis terbaru dari DEVADATA, KAYL, CALLII, MAF, dan LiLi di Spotify, Apple Music, YouTube Music, dan TikTok.',
        'default_url' => 'https://plesconnect.app',
        // Dedicated card: the logo PNG is white-on-transparent, which social scrapers
        // flatten to white and render as a blank image.
        'theme_color' => '#000000', 'og_image' => '/images/global/og-image.jpg', 'og_size' => [1200, 630],
        'og_image_alt' => 'Ples+ Connect — make your own core', 'lcp_image_desktop' => '', 'lcp_image' => '', 'genre' => '', 'artist_same_as' => [],
        'keywords' => ['Ples+', 'Ples Connect'], 'tagline' => [], 'platforms' => [], 'extra_same_as' => [],
        'video' => ['id' => '', 'title' => '', 'poster' => ''],
    ],
];

// sameAs is derived so it can never drift from the buttons: an inactive platform is
// absent from both, and a changed URL only has to be edited in one place.
foreach ($artists as $id => $artist) {
    $artists[$id]['same_as'] = array_values(array_unique(array_merge(
        array_column($artist['platforms'], 'href'),
        $artist['extra_same_as'],
    )));
}

return $artists;
