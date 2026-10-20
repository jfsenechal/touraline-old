<x-layouts.site :title="$concert->title.' — Chorale La Touraline'" :description="$concert->excerpt">
  <article class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-linear-180 from-brand-100 via-brand-50 to-brand-50"></div>

    <div class="mx-auto max-w-3xl px-6 pt-12 pb-16 sm:pt-16 lg:px-8 lg:pb-24">
      <a href="{{ route('home') }}#concerts" class="inline-flex items-center gap-1 text-sm font-semibold text-brand-700 hover:text-brand-500">
        <svg class="size-4 shrink-0 rotate-180 fill-current" viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8a.75.75 0 0 1 .75-.75h6.638L8.23 5.29a.75.75 0 1 1 1.04-1.08l3.5 3.25a.75.75 0 0 1 0 1.08l-3.5 3.25a.75.75 0 1 1-1.04-1.08l2.158-1.96H3.75A.75.75 0 0 1 3 8z" /></svg>
        Tous nos concerts
      </a>

      <p class="mt-8 text-sm font-semibold tracking-wide text-brand-600">Sur scène</p>
      <h1 class="mt-3 font-display text-4xl font-semibold tracking-tight text-balance text-stone-900 sm:text-5xl">
        {{ $concert->title }}
      </h1>
      <p class="mt-6 text-lg text-pretty text-stone-600">{{ $concert->excerpt }}</p>

      @if ($concert->image_url)
        <figure class="mt-10">
          <img src="{{ $concert->image_url }}" alt="{{ $concert->title }}" class="w-full rounded-3xl object-cover shadow-xl outline-1 -outline-offset-1 outline-black/10" />
        </figure>
      @endif

      @if ($concert->description_html !== '')
        <div class="prose prose-stone mt-10 max-w-none prose-headings:font-display prose-a:text-brand-700 hover:prose-a:text-brand-500">
          {!! $concert->description_html !!}
        </div>
      @endif

      <div class="mt-12">
        <a href="{{ route('home') }}#rejoindre" class="rounded-full bg-brand-500 px-6 py-3 text-base font-semibold text-white shadow-sm transition hover:bg-brand-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">
          Venez chanter avec nous
        </a>
      </div>
    </div>
  </article>
</x-layouts.site>
