@extends('layouts.app')

@section('content')
<section class="hero-bg">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold">Dokumentasi Kegiatan & Instalasi</h1>
        <p class="mt-3 max-w-2xl text-gray-800">
            Lihat proses kerja, instalasi jaringan, dan momen tim PT Solusi Net Nusantara.
        </p>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($galleries as $gallery)
            <figure class="card gallery-item relative overflow-hidden">
                <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                    <img src="{{ $gallery->image ? asset('storage/'.$gallery->image) : asset('assets/img/gallery-placeholder.svg') }}" alt="{{ $gallery->title }}">
                </div>
                <figcaption class="p-5">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="font-extrabold text-slate-900">{{ $gallery->title }}</h2>
                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-bold text-gray-700">{{ ucfirst($gallery->category ?? 'umum') }}</span>
                    </div>
                    @if($gallery->description)
                        <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $gallery->description }}</p>
                    @endif
                </figcaption>
            </figure>
        @empty
            <div class="card col-span-full p-10 text-center text-slate-500">Belum ada foto pada galeri.</div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $galleries->links() }}
    </div>
</section>
@endsection
