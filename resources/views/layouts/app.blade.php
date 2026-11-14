<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PT Solusi Net Nusantara - Provider jasa layanan internet dan jaringan profesional">
    <title>{{ $title ?? 'PT Solusi Net Nusantara' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --snn-primary: #111111;
            --snn-primary-dark: #000000;
            --snn-accent: #555555;
            --snn-dark: #000000;
        }
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            color: #111111;
            background: #FFFFFF;
        }
        .text-primary { color: var(--snn-primary); }
        .bg-primary { background-color: var(--snn-primary); }
        .bg-primary-dark { background-color: var(--snn-primary-dark); }
        .bg-accent { background-color: var(--snn-accent); }
        .border-primary { border-color: var(--snn-primary); }
        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            border-radius: .75rem;
            background: var(--snn-primary);
            color: #fff;
            font-weight: 600;
            padding: .85rem 1.5rem;
            transition: all .2s ease;
            box-shadow: 0 8px 24px rgba(17, 17, 17, .25);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(17, 17, 17, .32);
        }
        .btn-outline {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            border-radius: .75rem;
            border: 1px solid rgba(17, 17, 17, .25);
            background: #fff;
            color: var(--snn-primary);
            font-weight: 600;
            padding: .85rem 1.5rem;
            transition: all .2s ease;
        }
        .btn-outline:hover {
            border-color: var(--snn-primary);
            background: #F3F4F6;
        }
        .card {
            background: #fff;
            border: 1px solid #E2E8F0;
            border-radius: .75rem;
            box-shadow: 0 10px 30px rgba(15, 23, 42, .06);
            transition: all .25s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(17, 17, 17, .12);
            border-color: rgba(17, 17, 17, .2);
        }
        .nav-link {
            position: relative;
            font-weight: 600;
            color: #334155;
            padding: .35rem 0;
            transition: color .2s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--snn-primary);
        }
        .nav-link.active::after,
        .nav-link:hover::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: -4px;
            height: 2px;
            border-radius: 999px;
            background: var(--snn-primary);
        }
        .hero-bg {
            background: #FFFFFF;
            color: #111111;
        }
        .section-title {
            font-size: clamp(1.75rem, 2.5vw, 2.5rem);
            font-weight: 800;
            color: #111111;
        }
        .section-kicker {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            color: var(--snn-primary);
            font-weight: 700;
            font-size: .875rem;
            letter-spacing: .08em;
            text-transform: uppercase;
        }
        .prose-snn p { margin-bottom: 1rem; color: #334155; line-height: 1.8; }
        .prose-snn h2, .prose-snn h3 {
            font-weight: 800;
            color: #111111;
            margin: 1.75rem 0 .75rem;
        }
        .prose-snn ul { margin: 1rem 0; padding-left: 1.25rem; list-style: disc; color: #334155; }
        .prose-snn li { margin-bottom: .4rem; line-height: 1.7; }
        .alert {
            border-radius: .9rem;
            padding: .9rem 1.1rem;
            font-weight: 600;
        }
        .alert-success { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
        .alert-error { background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca; }
        .field {
            width: 100%;
            border-radius: .75rem;
            border: 1px solid #CBD5E1;
            background: #fff;
            padding: .8rem 1rem;
            transition: all .2s ease;
        }
        .field:focus {
            outline: none;
            border-color: var(--snn-primary);
            box-shadow: 0 0 0 4px rgba(17, 17, 17, .12);
        }
        .label {
            display: block;
            margin-bottom: .4rem;
            font-size: .875rem;
            font-weight: 700;
            color: #111111;
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.06);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
<header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-200">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-18 items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('assets/img/logosolnetnusa.png') }}" alt="Logo PT Solusi Net Nusantara" class="h-16 w-64 object-contain object-left">
            </a>

            <nav class="hidden lg:flex items-center gap-7" aria-label="Navigasi utama">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">Profile</a>
                <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Produk</a>
                <a href="{{ route('galleries.index') }}" class="nav-link {{ request()->routeIs('galleries.*') ? 'active' : '' }}">Galeri</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </nav>

            <div class="hidden lg:flex items-center gap-3">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="/admin" class="btn-outline text-sm"><i class="fa-solid fa-gauge-high"></i> Admin</a>
                    @else
                        <a href="{{ route('subscriptions.create') }}" class="btn-outline text-sm"><i class="fa-solid fa-box"></i> Langganan</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-primary text-sm">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-outline text-sm">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm">Register</a>
                @endauth
            </div>

            <button type="button" id="mobile-toggle" class="lg:hidden inline-flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 text-slate-700">
                <i class="fa-solid fa-bars text-lg"></i>
            </button>
        </div>
    </div>

    <div id="mobile-menu" class="lg:hidden hidden border-t border-slate-200 bg-white px-4 py-4">
        <div class="flex flex-col gap-3">
            <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-700 hover:bg-slate-50">Home</a>
            <a href="{{ route('profile') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-700 hover:bg-slate-50">Profile</a>
            <a href="{{ route('products.index') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-700 hover:bg-slate-50">Produk</a>
            <a href="{{ route('galleries.index') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-700 hover:bg-slate-50">Galeri</a>
            <a href="{{ route('contact') }}" class="rounded-lg px-3 py-2 font-semibold text-slate-700 hover:bg-slate-50">Contact</a>
            <div class="mt-2 border-t border-slate-200 pt-3">
                @auth
                    <div class="flex flex-col gap-2">
                        @if(auth()->user()->isAdmin())
                            <a href="/admin" class="btn-outline text-sm w-full">Admin Panel</a>
                        @else
                            <a href="{{ route('subscriptions.create') }}" class="btn-outline text-sm w-full">Langganan</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn-primary text-sm w-full">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('login') }}" class="btn-outline text-sm w-full">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary text-sm w-full">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>

@if(session('success'))
    <div class="flash-message mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
        <div class="alert alert-success"><i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}</div>
    </div>
@endif
@if(session('error'))
    <div class="flash-message mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
        <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation mr-2"></i>{{ session('error') }}</div>
    </div>
@endif
<script>
    window.setTimeout(() => {
        document.querySelectorAll('.flash-message').forEach((message) => message.remove());
    }, 5000);
</script>

<main class="flex-1">
    {{ $slot ?? '' }}
    @yield('content')
</main>

<footer class="mt-16" style="background:#000000">
    <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
            <div>
                <div class="flex items-center">
                    <img src="{{ asset('assets/img/logosolnetnusa.png') }}" alt="Logo PT Solusi Net Nusantara" class="h-16 w-64 object-contain object-left"> 
                </div>
                <p class="mt-4 text-sm leading-relaxed text-slate-300">
                    Penyedia jasa layanan internet dan jaringan profesional untuk rumah, UMKM, dan korporasi.
                    Koneksi stabil, layanan cepat, dan dukungan teknis berkelanjutan.
                </p>
                <div class="mt-5 flex gap-3">
                    <a href="#" class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white transition hover:bg-white/20" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white transition hover:bg-white/20" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white transition hover:bg-white/20" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-white transition hover:bg-white/20" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-extrabold uppercase tracking-wider text-white">About</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-300">
                    <li><a href="{{ route('profile') }}" class="transition hover:text-gray-300">Tentang Kami</a></li>
                    <li><a href="{{ route('products.index') }}" class="transition hover:text-gray-300">Produk & Layanan</a></li>
                    <li><a href="{{ route('galleries.index') }}" class="transition hover:text-gray-300">Galeri</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-extrabold uppercase tracking-wider text-white">Support</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-300">
                    <li><a href="{{ route('contact') }}" class="transition hover:text-gray-300">Hubungi Kami</a></li>
                    <li><a href="{{ route('login') }}" class="transition hover:text-gray-300">Login Member</a></li>
                    <li><a href="{{ route('register') }}" class="transition hover:text-gray-300">Register</a></li>
                    <li><a href="{{ route('subscriptions.create') }}" class="transition hover:text-gray-300">Ajukan Langganan</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-extrabold uppercase tracking-wider text-white">Contact</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-300">
                    <li class="flex gap-3"><i class="fa-solid fa-location-dot mt-1 text-gray-300"></i><span>Jl. Koneksi Raya No. 21, Jakarta Selatan, DKI Jakarta</span></li>
                    <li class="flex gap-3"><i class="fa-solid fa-phone mt-1 text-gray-300"></i><a href="tel:+622112345678" class="transition hover:text-gray-300">+62 21 1234 5678</a></li>
                    <li class="flex gap-3"><i class="fa-solid fa-envelope mt-1 text-gray-300"></i><a href="mailto:info@solusinetnusantara.id" class="transition hover:text-gray-300">info@solusinetnusantara.id</a></li>
                    <li class="flex gap-3"><i class="fa-solid fa-clock mt-1 text-gray-300"></i><span>Senin - Sabtu, 08.00 - 20.00 WIB</span></li>
                </ul>
                <div class="mt-5 overflow-hidden rounded-2xl border border-white/10 bg-white/5">
                    <iframe
                        title="Lokasi PT Solusi Net Nusantara"
                        class="h-36 w-full"
                        style="border:0;filter:grayscale(.3) contrast(1.1)"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps?q=Jakarta%20Selatan&output=embed">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="mt-10 border-t border-white/10 pt-6 text-center text-sm text-slate-400">
            Copyright &copy; {{ date('Y') }} PT Solusi Net Nusantara. All rights reserved.
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle = document.getElementById('mobile-toggle');
        const menu = document.getElementById('mobile-menu');
        if (toggle && menu) {
            toggle.addEventListener('click', function () {
                menu.classList.toggle('hidden');
            });
        }
    });
</script>
@stack('scripts')
</body>
</html>
