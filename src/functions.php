<?php

declare(strict_types=1);

@$_SERVER['REQUEST_SCHEME'] = 'http';
if (!in_array(@$_SERVER['HTTP_HOST'], ['localhost:3000', 'tailwebs.test'], true)) {
    $_SERVER['REQUEST_SCHEME'] = 'https';
}

function getUrl(): string
{
    return ($_SERVER['REQUEST_SCHEME'] ?: 'http') . '://' . $_SERVER['HTTP_HOST'];
}

function getAssetsUrl($path = ''): string
{
    return getUrl() . '/' . $path;
}

function getActiveUrl(string|array $url): string
{
    if (@is_array($url)) {
        return in_array($_SERVER['REQUEST_URI'], $url, true) ? 'active' : '';
    }

    return $_SERVER['REQUEST_URI'] === $url ? 'active' : '';
}

function getMetaSeo(array $props): array
{
    $brand = 'Tailwebs';
    $data = ['brand' => $brand];
    $data['title'] = isset($props['title']) ? $props['title'] . " | " . $brand : $brand;
    $data['url'] = ($_SERVER['REQUEST_SCHEME'] ?: 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    return $data;
}