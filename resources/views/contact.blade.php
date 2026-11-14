@extends('layouts.app')

@section('content')
<section class="hero-bg">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold">Hubungi PT Solusi Net Nusantara</h1>
        <p class="mt-3 max-w-2xl text-gray-800">
            Kami siap membantu kebutuhan internet, instalasi jaringan, dan pertanyaan layanan lainnya.
        </p>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="card p-6 sm:p-8">
            <h2 class="text-xl font-extrabold text-slate-900">Kirim Pesan</h2>
            <p class="mt-1 text-sm text-slate-600">Isi formulir berikut, tim kami akan menghubungi Anda.</p>

            <form method="POST" action="{{ route('contact.submit') }}" class="mt-6 space-y-4">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="label" for="name">Nama</label>
                        <input class="field" id="name" name="name" type="text" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                    </div>
                    <div>
                        <label class="label" for="email">Email</label>
                        <input class="field" id="email" name="email" type="email" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                    </div>
                </div>
                <div>
                    <label class="label" for="subject">Subjek</label>
                    <input class="field" id="subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="cth: Pemasangan internet kantor" required>
                </div>
                <div>
                    <label class="label" for="message">Pesan</label>
                    <textarea class="field" id="message" name="message" rows="5" placeholder="Tuliskan kebutuhan Anda..." required>{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn-primary w-full sm:w-auto">
                    <i class="fa-solid fa-paper-plane"></i> Kirim Pesan
                </button>
                <p id="contact-success" class="hidden rounded-xl bg-gray-100 px-4 py-3 text-sm font-semibold text-gray-700">
                    Terima kasih! Pesan Anda berhasil disimpan. Kami akan segera menghubungi Anda.
                </p>
            </form>
        </div>

        <div class="space-y-5">
            <div class="card p-6">
                <h3 class="font-extrabold text-slate-900">Informasi Kantor</h3>
                <ul class="mt-4 space-y-4 text-sm text-slate-600">
                    <li class="flex gap-3">
                        <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-primary"><i class="fa-solid fa-location-dot"></i></span>
                        <span>Jl. Koneksi Raya No. 21, Kebayoran Baru, Jakarta Selatan, DKI Jakarta 12160</span>
                    </li>
                    <li class="flex gap-3">
                        <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-primary"><i class="fa-solid fa-phone"></i></span>
                        <a href="tel:+622112345678" class="hover:text-primary">+62 21 1234 5678</a>
                    </li>
                    <li class="flex gap-3">
                        <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-primary"><i class="fa-solid fa-envelope"></i></span>
                        <a href="mailto:info@solusinetnusantara.id" class="hover:text-primary">info@solusinetnusantara.id</a>
                    </li>
                    <li class="flex gap-3">
                        <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-primary"><i class="fa-brands fa-whatsapp"></i></span>
                        <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-primary">+62 812 3456 7890</a>
                    </li>
                    <li class="flex gap-3">
                        <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-100 text-primary"><i class="fa-solid fa-clock"></i></span>
                        <span>Senin - Sabtu, 08.00 - 20.00 WIB</span>
                    </li>
                </ul>
            </div>

            <div class="card overflow-hidden">
                <iframe
                    title="Peta lokasi kantor"
                    class="h-64 w-full"
                    style="border:0"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps?q=Jakarta%20Selatan&output=embed">
                </iframe>
            </div>

            <div class="card p-6">
                <h3 class="font-extrabold text-slate-900">Ikuti Kami</h3>
                <div class="mt-4 flex gap-3">
                    <a href="#" class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-primary hover:bg-rose-100" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-100" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-700 hover:bg-gray-200" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection