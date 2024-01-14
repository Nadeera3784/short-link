<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@linkShort">
        <meta name="twitter:creator" content="@linkShort">
        <meta name="keywords" content="free URL shortener">
        <meta property="og:type" content="article">
        <meta name="description" content="Simple and fast URL shortener">
        <meta property="og:description" content="Simple and fast URL shortener">
        <meta name="twitter:description" content="Simple and fast URL shortener">
        <meta name="apple-mobile-web-app-title" content="LinkShort">
        <meta name="application-name" content="LinkShort">
        <meta name="msapplication-TileColor" content="#4338ca">
        <meta name="theme-color" content="#4338ca">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div id="app"></div>
    </body>
</html>
