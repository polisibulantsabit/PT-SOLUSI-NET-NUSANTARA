@extends('layouts.app')

@section('content')
<section class="hero-bg">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold">Tentang PT Solusi Net Nusantara</h1>
        <p class="mt-3 max-w-2xl text-gray-800">
            Partner terpercaya untuk kebutuhan internet dan jaringan di Indonesia.
        </p>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="flex justify-center">
        <div class="max-w-4xl">
            <h2 class="section-title mt-3">Kami menghubungkan bisnis dengan koneksi yang handal</h2>
            <div class="mt-5 space-y-4 text-slate-600 leading-relaxed">
                <p>
                    PT Solusi Net Nusantara adalah perusahaan jasa layanan internet dan jaringan yang berkomitmen
                    menghadirkan konektivitas stabil, aman, dan terukur untuk pelanggan rumah, UMKM, hingga korporasi.
                </p>
                <p>
                    Kami menyediakan layanan broadband, instalasi jaringan, monitoring, serta maintenance berkala
                    dengan dukungan teknisi berpengalaman dan sistem support yang responsif.
                </p>
                <p>
                    Visi kami menjadi partner digital yang tepercaya, membantu pelanggan tumbuh melalui infrastruktur
                    jaringan yang berkualitas.
                </p>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <div class="text-sm font-bold text-primary">Visi</div>
                    <p class="mt-2 text-sm text-slate-600">Menjadi penyedia jasa internet terpercaya dengan layanan prima di Indonesia.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">
                    <div class="text-sm font-bold text-primary">Misi</div>
                    <p class="mt-2 text-sm text-slate-600">Menghadirkan koneksi stabil, harga transparan, dan dukungan teknis 24/7.</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
