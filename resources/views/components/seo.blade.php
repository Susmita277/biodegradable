@props(['seo'])
<x-slot name="seo">

    <!-- Essential SEO Tags -->
    <title>{{ data_get($seo, 'meta_title') }}</title>

    <meta name="description" content="{{ data_get($seo, 'meta_description') }}">

    <meta name="keywords" content="{{ data_get($seo, 'meta_keywords') }}">

    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="robots" content="index, follow">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="{{ data_get($seo, 'og_title') }}">

    <meta property="og:description" content="{{ data_get($seo, 'og_description') }}">

    <meta property="og:image" content="{{ broccoli_asset(data_get($seo, 'og_image')) }}">

    <meta property="og:url" content="{{ url()->current() }}">

    <meta property="og:type" content="website">

    <!-- Twitter Card Tags -->
    <meta name="twitter:card" content="summary_large_image">

    <meta name="twitter:title" content="{{ data_get($seo, 'twitter_title') }}">

    <meta name="twitter:description" content="{{ data_get($seo, 'twitter_description') }}">

    <meta name="twitter:image" content="{{ broccoli_asset(data_get($seo, 'twitter_image')) }}">

    <!-- Favicon & App Tags -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/seo/favicon-16x16.png') }}" />

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/seo/favicon-32x32.png') }}" />

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('images/seo/android-chrome-192x192.png') }}" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/seo/apple-touch-icon.png') }}" />

    <meta name="apple-mobile-web-app-title" content="batuly" />

    <link rel="manifest" href="{{ asset('images/seo/site.webmanifest') }}" />

    <script type="application/ld+json">
        {!! data_get($seo, 'json_ld') !!}
    </script>

</x-slot>
