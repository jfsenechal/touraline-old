@props(['concert'])

<article class="group relative flex h-full flex-col overflow-hidden rounded-3xl bg-brand-50 ring-1 ring-brand-500/10 transition hover:shadow-md hover:ring-brand-500/30">
  @if ($concert->image_url)
    <img src="{{ $concert->image_url }}" alt="" class="aspect-[3/2] w-full object-cover outline-1 -outline-offset-1 outline-black/10" />
  @else
    <img src="{{ asset('assets/img/concert-1.jpg') }}" alt="" class="aspect-[3/2] w-full object-cover outline-1 -outline-offset-1 outline-black/10" />
  @endif
  <div class="flex flex-1 flex-col p-6">
    <h3 class="font-display text-lg font-semibold text-balance text-stone-900">
      <a href="{{ route('concerts.show', $concert) }}" class="focus-visible:outline-none">
        <span class="absolute inset-0" aria-hidden="true"></span>
        {{ $concert->title }}
      </a>
    </h3>
    <p class="mt-2 text-sm text-pretty text-stone-600">{{ $concert->excerpt }}</p>
    <span class="mt-auto inline-flex items-center gap-1 pt-4 text-sm font-semibold text-brand-700">En savoir plus
      <svg class="size-4 shrink-0 fill-current transition group-hover:translate-x-0.5" viewBox="0 0 16 16" aria-hidden="true"><path d="M3 8a.75.75 0 0 1 .75-.75h6.638L8.23 5.29a.75.75 0 1 1 1.04-1.08l3.5 3.25a.75.75 0 0 1 0 1.08l-3.5 3.25a.75.75 0 1 1-1.04-1.08l2.158-1.96H3.75A.75.75 0 0 1 3 8z" /></svg>
    </span>
  </div>
</article>
