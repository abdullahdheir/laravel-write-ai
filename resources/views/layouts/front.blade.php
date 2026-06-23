<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>{{ $title }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=Source+Serif+4:wght@400;600;700&amp;display=swap"
        rel="stylesheet" />
    {{ $style ?? '' }}
    {{ $headScripts ?? '' }}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-body-md text-body-md selection:bg-primary-fixed selection:text-on-primary-fixed">
    <!-- TopNavBar -->
    <header class="fixed top-0 z-50 w-full bg-surface border-b border-outline-variant">
        <div class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-16">
            <div class="flex items-center gap-8">
                <a class="font-display-lg-mobile text-display-lg-mobile font-bold text-on-surface"
                    href="{{ route('home') }}">{{ config('app.name') }}</a>
                <nav class="hidden md:flex items-center gap-6">
                    @section('nav')
                        <a class="text-primary font-bold border-b-2 border-primary pb-1 font-ui-label text-ui-label hover:text-primary transition-colors duration-200"
                            href="#">Feed</a>
                        <a class="text-on-surface-variant font-medium font-ui-label text-ui-label hover:text-primary transition-colors duration-200"
                            href="#">Authors</a>
                        <a class="text-on-surface-variant font-medium font-ui-label text-ui-label hover:text-primary transition-colors duration-200"
                            href="#">Dashboard</a>
                    @show
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <div
                    class="hidden lg:flex items-center bg-surface-container border border-outline-variant rounded-full px-4 py-1.5 gap-2">
                    <span class="material-symbols-outlined text-secondary" data-icon="search">search</span>
                    <input class="bg-transparent border-none focus:ring-0 text-ui-label font-ui-label w-48"
                        placeholder="Search..." type="text" />
                </div>
                <div class="flex items-center gap-2">
                    <button
                        class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-all">
                        <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                    </button>
                    <button
                        class="p-2 text-on-surface-variant hover:bg-surface-container-high rounded-full transition-all">
                        <span class="material-symbols-outlined" data-icon="bookmark">bookmark</span>
                    </button>
                    <x-user-menu />
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content Layout -->
    <main class="{{ $mainClass ?? '' }}">
        {{ $slot }}
    </main>
    <!-- Footer -->
    <footer class="bg-surface border-t border-outline-variant">
        <div
            class="w-full py-section-gap px-gutter max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex flex-col gap-2 items-center md:items-start">
                <span class="font-headline-md text-headline-md text-on-surface">Ink &amp; Paper</span>
                <p class="font-metadata text-metadata text-secondary">© 2024 Ink &amp; Paper Platform. All rights
                    reserved.</p>
            </div>
            <nav class="flex flex-wrap justify-center gap-8">
                <a class="text-secondary font-metadata text-metadata hover:text-on-surface underline transition-all"
                    href="#">About</a>
                <a class="text-secondary font-metadata text-metadata hover:text-on-surface underline transition-all"
                    href="#">Privacy</a>
                <a class="text-secondary font-metadata text-metadata hover:text-on-surface underline transition-all"
                    href="#">Terms</a>
                <a class="text-secondary font-metadata text-metadata hover:text-on-surface underline transition-all"
                    href="#">API</a>
                <a class="text-secondary font-metadata text-metadata hover:text-on-surface underline transition-all"
                    href="#">Help</a>
            </nav>
            <div class="flex gap-4">
                <button
                    class="p-2 text-secondary hover:text-primary transition-colors focus:outline-none ring-primary"><span
                        class="material-symbols-outlined">alternate_email</span></button>
                <button
                    class="p-2 text-secondary hover:text-primary transition-colors focus:outline-none ring-primary"><span
                        class="material-symbols-outlined">rss_feed</span></button>
            </div>
        </div>
    </footer>
    {{ $footerScripts ?? '' }}

</body>

</html>
