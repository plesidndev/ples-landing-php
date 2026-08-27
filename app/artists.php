<?php

declare(strict_types=1);

$dspBrands = [
    'spotify' => ['name' => 'Spotify', 'icon' => '/images/dsp/spotify.svg', 'aspect' => 90.19 / 29.53],
    'apple-music' => ['name' => 'Apple Music', 'icon' => '/images/dsp/apple-music.png', 'aspect' => 920 / 221],
    'tiktok' => ['name' => 'TikTok', 'icon' => '/images/dsp/tiktok.png', 'aspect' => 658 / 161],
];

$platforms = static function (array $links) use ($dspBrands): array {
    return array_map(
        static fn (string $id): array => ['id' => $id, 'href' => $links[$id]] + $dspBrands[$id],
        array_keys($dspBrands),
    );
};

$common = [
    'locale' => 'id_ID',
    'background_color' => '#000000',
    'app_stores' => ['google_play' => 'https://play.google.com', 'apple_store' => 'https://apps.apple.com'],
];

return [
    'devadata' => $common + [
        'id' => 'devadata', 'view' => 'artists/devadata', 'name' => 'DEVADATA', 'release' => 'SAPUTANAH PAPUA',
        'title' => 'DEVADATA — SAPUTANAH PAPUA | Ples+',
        'description' => 'Dengarkan “SAPUTANAH PAPUA” dari DEVADATA sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://devadata.plesconnect.app', 'theme_color' => '#120b09',
        'og_image' => '/images/devadata/hero.png', 'og_size' => [1917, 1080],
        'keywords' => ['DEVADATA', 'SAPUTANAH PAPUA', 'Ples+', 'musik Indonesia', 'lagu baru'],
        'tagline' => ['SAPUTANAH PAPUA'],
        'platforms' => $platforms([
            'spotify' => 'https://open.spotify.com/search/DEVADATA%20SAPUTANAH%20PAPUA',
            'apple-music' => 'https://music.apple.com/id/search?term=DEVADATA%20SAPUTANAH%20PAPUA',
            'tiktok' => 'https://www.tiktok.com/search?q=DEVADATA%20SAPUTANAH%20PAPUA',
        ]),
        'same_as' => ['https://open.spotify.com/search/DEVADATA%20SAPUTANAH%20PAPUA', 'https://music.apple.com/id/search?term=DEVADATA%20SAPUTANAH%20PAPUA', 'https://www.tiktok.com/search?q=DEVADATA%20SAPUTANAH%20PAPUA', 'https://www.youtube.com/watch?v=k0Zc--bj2vc'],
        'video' => ['id' => 'k0Zc--bj2vc', 'href' => 'https://www.youtube.com/watch?v=k0Zc--bj2vc&list=RDk0Zc--bj2vc&start_radio=1', 'title' => 'DEVADATA — SAPUTANAH PAPUA', 'poster' => '/images/devadata/hero.png'],
    ],
    'kayl' => $common + [
        'id' => 'kayl', 'view' => 'artists/kayl', 'name' => 'KAYL', 'release' => 'dar der D0R!!',
        'title' => 'KAYL — dar der D0R!! | Ples+',
        'description' => 'Dengarkan “dar der D0R!!” dari KAYL sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://kayl.plesconnect.app', 'theme_color' => '#000000',
        'og_image' => '/images/kayl/hero.png', 'og_size' => [1917, 1080],
        'keywords' => ['KAYL', 'dar der D0R!!', 'Ples+', 'musik Indonesia', 'lagu baru'],
        'tagline' => ['dar der D0R!!'],
        'platforms' => $platforms([
            'spotify' => 'https://open.spotify.com/search/KAYL%20dar%20der%20D0R',
            'apple-music' => 'https://music.apple.com/id/search?term=KAYL%20dar%20der%20D0R',
            'tiktok' => 'https://www.tiktok.com/search?q=KAYL%20dar%20der%20D0R',
        ]),
        'same_as' => ['https://open.spotify.com/search/KAYL%20dar%20der%20D0R', 'https://music.apple.com/id/search?term=KAYL%20dar%20der%20D0R', 'https://www.tiktok.com/search?q=KAYL%20dar%20der%20D0R'],
        'video' => ['id' => '', 'href' => 'https://www.youtube.com/results?search_query=KAYL+dar+der+D0R', 'title' => 'KAYL — dar der D0R!!', 'poster' => '/images/kayl/hero.png'],
    ],
    'callii' => $common + [
        'id' => 'callii', 'view' => 'artists/callii', 'name' => 'CALLII', 'release' => 'MULAI LAGI',
        'title' => 'CALLII — MULAI LAGI | Ples+',
        'description' => 'Jatuh 7x, gw bangkit 8x. Dengerin “MULAI LAGI” dari CALLII sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://callii.plesconnect.app', 'theme_color' => '#000000',
        'og_image' => '/images/callii/og-image.jpg', 'og_size' => [1200, 630],
        'keywords' => ['CALLII', 'MULAI LAGI', 'Ples+', 'musik Indonesia', 'lagu baru'],
        'tagline' => ['Jatuh 7x, gw bangkit 8x', '“MULAI LAGI” out now on all platforms'],
        'platforms' => $platforms([
            'spotify' => 'https://open.spotify.com/track/5hPbcmpqnRJafzAJv35dvE',
            'apple-music' => 'https://music.apple.com/us/album/mulaii-llagi/6789538157',
            'tiktok' => 'https://www.tiktok.com/music/MULAii-LLAGI-7660836886660040721',
        ]),
        'same_as' => ['https://open.spotify.com/track/5hPbcmpqnRJafzAJv35dvE', 'https://music.apple.com/us/album/mulaii-llagi/6789538157', 'https://www.tiktok.com/music/MULAii-LLAGI-7660836886660040721', 'https://www.instagram.com/reels/audio/886346697863290', 'https://www.youtube.com/watch?v=ZTLtF80nvf4'],
        'video' => ['id' => 'ZTLtF80nvf4', 'title' => 'CALLII — MULAI LAGI', 'poster' => '/images/callii/photo-collage.jpg'],
    ],
    'maf' => $common + [
        'id' => 'maf', 'view' => 'artists/maf', 'name' => 'MAF', 'release' => 'StarBoy',
        'title' => 'MAF — StarBoy | Ples+', 'description' => 'Dengarkan StarBoy dari MAF sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://maf.plesconnect.app', 'theme_color' => '#0b241f',
        'og_image' => '/images/maf/hero.png', 'og_size' => [736, 1030],
        'keywords' => ['MAF', 'StarBoy', 'Ples+', 'musik Indonesia', 'lagu baru'], 'tagline' => ['StarBoy'],
        'platforms' => $platforms([
            'spotify' => 'https://open.spotify.com/track/0QMEYe6fAQkgbPMRxx4pX',
            'apple-music' => 'https://music.apple.com/id/album/maf/6795910681',
            'tiktok' => 'https://www.tiktok.com/@mafworld',
        ]),
        'same_as' => ['https://open.spotify.com/track/0QMEYe6fAQkgbPMRxx4pX', 'https://music.apple.com/id/album/maf/6795910681', 'https://www.tiktok.com/@mafworld', 'https://www.instagram.com/mafintheair', 'https://youtu.be/IRp4ClBpGPM'],
        'video' => ['id' => 'IRp4ClBpGPM', 'title' => 'MAF — StarBoy', 'poster' => '/images/maf/hero.png'],
    ],
    'lili' => $common + [
        'id' => 'lili', 'view' => 'artists/lili', 'name' => 'LiLi', 'release' => 'Honest',
        'title' => 'LiLi — Honest | Ples+', 'description' => 'Dengarkan “Honest” dari LiLi sekarang di Spotify, Apple Music, dan TikTok.',
        'default_url' => 'https://lili.plesconnect.app', 'theme_color' => '#0b0b0b',
        'og_image' => '/images/lili/hero.jpg', 'og_size' => [1600, 900],
        'keywords' => ['LiLi', 'Honest', 'Ples+', 'musik Indonesia', 'lagu baru'], 'tagline' => ['Honest'],
        'platforms' => $platforms([
            'spotify' => 'https://open.spotify.com/track/2hiz92sjwxQdcipghBRRDP',
            'apple-music' => 'https://music.apple.com/id/album/honest-single/6799972819',
            'tiktok' => 'https://vt.tiktok.com/ZS9khMsh2FdUy-O2UtG/',
        ]),
        'same_as' => ['https://open.spotify.com/track/2hiz92sjwxQdcipghBRRDP', 'https://music.apple.com/id/album/honest-single/6799972819', 'https://vt.tiktok.com/ZS9khMsh2FdUy-O2UtG/', 'https://found.ee/lili_honest', 'https://youtu.be/Lsx3tx8fve0'],
        'video' => ['id' => 'Lsx3tx8fve0', 'title' => 'LiLi — Honest', 'poster' => '/images/lili/video-poster.jpg'],
    ],
    'default' => $common + [
        'id' => 'default', 'view' => 'artists/default', 'name' => 'Ples+ Connect', 'release' => '',
        'title' => 'Ples+ Connect', 'description' => 'Make your own core.', 'default_url' => 'https://plesconnect.app',
        'theme_color' => '#000000', 'og_image' => '/images/global/ples-connect-logo.png', 'og_size' => [2518, 1314],
        'keywords' => ['Ples+', 'Ples Connect'], 'tagline' => [], 'platforms' => [], 'same_as' => [],
        'video' => ['id' => '', 'title' => '', 'poster' => ''],
    ],
];
