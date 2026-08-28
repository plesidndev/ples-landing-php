<?php

declare(strict_types=1);

define('APP_PATH', __DIR__);
require APP_PATH . '/helpers.php';

$artists = require APP_PATH . '/artists.php';
$host = strtolower(preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? '') ?? '');
// www.lili.plesconnect.app must resolve to the same artist as the apex so it can be
// redirected there, rather than falling through to the noindex default site.
$host = preg_replace('/^www\./', '', $host) ?? $host;
// Derived from artists.php so a new artist cannot be added without its hostname.
$hostMap = [];
foreach ($artists as $id => $artist) {
    if ($id === 'default') {
        continue;
    }
    $artistHost = strtolower((string) parse_url($artist['default_url'], PHP_URL_HOST));
    if ($artistHost !== '') {
        $hostMap[$artistHost] = $id;
    }
}

$fileEnvironment = is_file(APP_PATH . '/environment.php')
    ? require APP_PATH . '/environment.php'
    : [];

$configuredArtist = getenv('ARTIST_ID') ?: ($fileEnvironment['artist_id'] ?? '') ?: ($hostMap[$host] ?? 'default');
$artistId = array_key_exists($configuredArtist, $artists) ? $configuredArtist : 'default';
$site = $artists[$artistId];
$site['url'] = rtrim(getenv('SITE_URL') ?: ($fileEnvironment['site_url'] ?? '') ?: $site['default_url'], '/');

$environment = [
    'ga_id' => getenv('GA_ID') ?: ($fileEnvironment['ga_id'] ?? ''),
    'google_site_verification' => getenv('GOOGLE_SITE_VERIFICATION') ?: ($fileEnvironment['google_site_verification'] ?? ''),
];
