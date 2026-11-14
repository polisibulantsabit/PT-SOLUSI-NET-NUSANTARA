@extends('layouts.app')

@section('content')
<section class="hero-bg">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
        <div class="flex min-h-[420px] w-full max-w-[1400px] justify-center rounded-2xl border border-gray-200 bg-white px-8 py-20 text-center shadow-2xl shadow-gray-400/40 sm:px-12 lg:min-h-[520px] lg:py-28">
            <div class="max-w-4xl">
                <h1 class="text-5xl font-black leading-[1.05] tracking-tight text-black sm:text-6xl lg:text-7xl" style="-webkit-text-stroke: 1px currentColor;">
                    Temukan koneksi terbaik Anda disini
                </h1>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-relaxed text-gray-800">
                    PT Solusi Net Nusantara menghadirkan layanan internet stabil, instalasi jaringan profesional,
                    dan maintenance berkala untuk kebutuhan rumah hingga bisnis.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <a href="{{ route('products.index') }}" class="btn-primary">
                        Lihat Paket <i class="fa-solid fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mb-10 text-center">
        <h2 class="section-title mt-3">Paket Layanan Unggulan</h2>
        <p class="mx-auto mt-3 max-w-2xl text-slate-600">
            Pilih paket internet sesuai kebutuhan Anda. Semua paket sudah termasuk instalasi dan support teknis.
        </p>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($products as $product)
            <article class="card flex flex-col p-6">
                <h3 class="text-xl font-extrabold text-slate-900">{{ $product->name }}</h3>
                @if($product->speed)
                    <p class="mt-1 text-sm font-semibold text-primary">{{ $product->speed }}</p>
                @endif
                <div class="mt-4 text-3xl font-extrabold text-primary">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                    <span class="text-sm font-semibold text-slate-500">/bulan</span>
                </div>
                @if($product->description)
                    <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ \Illuminate\Support\Str::limit($product->description, 120) }}</p>
                @endif
                @if($product->features_list)
                    <ul class="mt-4 space-y-2 text-sm text-slate-700">
                        @foreach(array_slice($product->features_list, 0, 4) as $feature)
                            <li class="flex gap-2">
                                <i class="fa-solid fa-circle-check mt-1 text-gray-700"></i>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <div class="mt-6 pt-auto">
                    <a href="{{ route('products.index') }}" class="btn-outline mt-3 w-full">Selengkapnya</a>
                </div>
            </article>
        @empty
            <div class="card col-span-full p-10 text-center text-slate-500">
                Belum ada paket produk. Silakan hubungi admin.
            </div>
        @endforelse
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mb-10 text-center">
        <div class="section-kicker text-gray-500"><i class="fa-solid fa-images"></i> Galeri</div>
        <h2 class="section-title mt-3">Dokumentasi Perusahaan</h2>
    </div>

    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($galleries as $gallery)
            <a href="{{ route('galleries.index') }}" class="gallery-item group relative block aspect-[4/3] overflow-hidden rounded-2xl border border-slate-200 bg-slate-100">
                <img src="{{ $gallery->image ? asset('storage/'.$gallery->image) : asset('assets/img/gallery-placeholder.svg') }}" alt="{{ $gallery->title }}">
                <div class="absolute inset-0 flex items-end bg-slate-900/80 p-4 opacity-0 transition group-hover:opacity-100">
                    <div class="text-white">
                        <div class="font-bold">{{ $gallery->title }}</div>
                        <div class="text-xs text-gray-200">{{ ucfirst($gallery->category ?? 'dokumentasi') }}</div>
                    </div>
                </div>
            </a>
        @empty
            <div class="card col-span-full p-10 text-center text-slate-500">Belum ada foto galeri.</div>
        @endforelse
    </div>
</section>

@endsection
