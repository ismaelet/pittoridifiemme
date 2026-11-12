<!DOCTYPE html>
<html
    lang="{{ $lang }}"
    data-theme="light"
>

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1.0"
    >
    <meta
        name="description"
        content="{{ $description }}"
    >
    <meta
        property="og:image"
        content="{{ $thumbnail }}"
    >

    <title>{{ $title }}</title>

    @vite(['resources/css/site.css', 'resources/js/site.ts'])
    @stack('assets')

    <link
        rel="icon"
        href="{{ asset('favicon.ico') }}"
    >
</head>

<body>
    {{ $slot }}
</body>

</html>
