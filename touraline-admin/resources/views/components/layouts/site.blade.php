<!DOCTYPE html>
<html lang="fr" class="scroll-smooth antialiased">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $title ?? 'Chorale La Touraline — Marche-en-Famenne' }}</title>
  <meta name="description" content="{{ $description ?? 'La chorale La Touraline de Marche-en-Famenne : un chœur à trois voix de variété française, dans une ambiance conviviale. Répétitions le jeudi soir. Venez chanter avec nous !' }}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://rsms.me/" />
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..600&display=swap" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-brand-50 font-sans text-stone-700 selection:bg-brand-500/20">
  <div class="isolate">

    <!-- ===================== HEADER ===================== -->
    <header class="sticky top-0 z-50 border-b border-stone-900/5 bg-brand-50/80 backdrop-blur-md">
      <nav class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-6 py-3 lg:px-8" aria-label="Navigation principale">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
          <img src="{{ asset('assets/img/logo.png') }}" alt="Chorale La Touraline" class="h-12 w-auto rounded-lg" />
          <span class="sr-only">Chorale La Touraline</span>
        </a>

        <div class="flex items-center gap-8 text-sm font-medium text-stone-600 max-lg:hidden">
          <a href="{{ route('home') }}#chorale" class="hover:text-brand-700">La chorale</a>
          <a href="{{ route('home') }}#concerts" class="hover:text-brand-700">Concerts</a>
          <a href="{{ route('home') }}#photos" class="hover:text-brand-700">Photos</a>
          <a href="{{ route('home') }}#rejoindre" class="hover:text-brand-700">Nous rejoindre</a>
          <a href="{{ route('home') }}#contact" class="hover:text-brand-700">Contact</a>
        </div>

        <div class="flex items-center gap-2">
          <a href="{{ route('home') }}#rejoindre" class="rounded-full bg-brand-500/10 px-4 py-2 text-sm font-semibold text-brand-700 transition hover:bg-brand-500/15 max-lg:hidden">
            Venez chanter
          </a>
          <!-- Mobile menu toggle -->
          <button type="button" id="menu-open" class="relative -mr-1 rounded-md p-2 text-stone-700 lg:hidden" aria-label="Ouvrir le menu">
            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
      </nav>
    </header>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="fixed inset-0 z-50 hidden lg:hidden" role="dialog" aria-modal="true">
      <div id="menu-backdrop" class="fixed inset-0 bg-stone-900/40 backdrop-blur-sm"></div>
      <div class="fixed inset-y-0 right-0 w-full max-w-xs bg-brand-50 px-6 py-5 shadow-xl">
        <div class="flex items-center justify-between">
          <img src="{{ asset('assets/img/logo.png') }}" alt="" class="h-11 w-auto rounded-lg" />
          <button type="button" id="menu-close" class="rounded-md p-2 text-stone-700" aria-label="Fermer le menu">
            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-8 flex flex-col gap-1 text-base font-medium text-stone-800">
          <a href="{{ route('home') }}#chorale" class="rounded-lg px-3 py-2.5 hover:bg-brand-500/10" data-nav>La chorale</a>
          <a href="{{ route('home') }}#concerts" class="rounded-lg px-3 py-2.5 hover:bg-brand-500/10" data-nav>Concerts</a>
          <a href="{{ route('home') }}#photos" class="rounded-lg px-3 py-2.5 hover:bg-brand-500/10" data-nav>Photos</a>
          <a href="{{ route('home') }}#rejoindre" class="rounded-lg px-3 py-2.5 hover:bg-brand-500/10" data-nav>Nous rejoindre</a>
          <a href="{{ route('home') }}#contact" class="rounded-lg px-3 py-2.5 hover:bg-brand-500/10" data-nav>Contact</a>
          <a href="{{ route('home') }}#rejoindre" class="mt-4 rounded-full bg-brand-500 px-4 py-2.5 text-center font-semibold text-white" data-nav>Venez chanter</a>
        </div>
      </div>
    </div>

    <main>
      {{ $slot }}
    </main>

    <!-- ===================== FOOTER ===================== -->
    <footer class="bg-stone-900 text-stone-300">
      <div class="mx-auto max-w-7xl px-6 py-14 lg:px-8">
        <div class="flex flex-col gap-10 md:flex-row md:items-start md:justify-between">
          <div class="max-w-sm">
            <span class="inline-flex rounded-xl bg-white p-2">
              <img src="{{ asset('assets/img/logo.png') }}" alt="Chorale La Touraline" class="h-12 w-auto" />
            </span>
            <p class="mt-5 text-sm text-pretty text-stone-400">
              Chorale amateur de Marche-en-Famenne depuis 1982. Un chœur à trois voix de variété française,
              dans une ambiance conviviale. Membre de la fédération « À Cœur Joie ».
            </p>
          </div>

          <nav class="grid grid-cols-2 gap-x-12 gap-y-3 text-sm sm:grid-cols-2" aria-label="Pied de page">
            <a href="{{ route('home') }}#chorale" class="font-normal text-stone-300 hover:text-white">La chorale</a>
            <a href="{{ route('home') }}#concerts" class="font-normal text-stone-300 hover:text-white">Concerts</a>
            <a href="{{ route('home') }}#photos" class="font-normal text-stone-300 hover:text-white">Photos</a>
            <a href="{{ route('home') }}#rejoindre" class="font-normal text-stone-300 hover:text-white">Nous rejoindre</a>
            <a href="{{ route('home') }}#contact" class="font-normal text-stone-300 hover:text-white">Contact</a>
            <a href="mailto:choralelatouraline@gmail.com" class="font-normal text-stone-300 hover:text-white">Nous écrire</a>
          </nav>
        </div>

        <div class="mt-12 flex flex-col gap-4 border-t border-white/10 pt-6 sm:flex-row sm:items-center sm:justify-between">
          <p class="text-sm text-stone-500">© <span class="tabular-nums">{{ now()->year }}</span> a.s.b.l. La Touraline — Marche-en-Famenne, Belgique.</p>
          <p class="text-sm text-stone-500">Chanter ensemble, c'est vivre en harmonie.</p>
        </div>
      </div>
    </footer>

  </div>
</body>
</html>
