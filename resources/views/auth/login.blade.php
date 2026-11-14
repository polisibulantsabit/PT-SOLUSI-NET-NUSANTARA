@extends('layouts.app')

@section('content')
<section class="hero-bg">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="section-kicker text-gray-200"><i class="fa-solid fa-right-to-bracket"></i> Login Member</div>
        <h1 class="mt-3 text-4xl font-extrabold">Masuk ke akun Anda</h1>
        <p class="mt-3 max-w-2xl text-gray-800">Kelola langganan dan ajukan paket layanan internet.</p>
    </div>
</section>

<section class="mx-auto max-w-md px-4 py-16 sm:px-6">
    <div class="card p-6 sm:p-8">
        <h2 class="text-xl font-extrabold text-slate-900">Welcome Back</h2>
        <p class="mt-1 text-sm text-slate-600">Silakan login dengan email dan password Anda.</p>

        @if($errors->any())
            <div class="alert alert-error mt-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="label" for="email">Email</label>
                <input class="field" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div>
                <label class="label" for="password">Password</label>
                <input class="field" id="password" type="password" name="password" required>
            </div>
            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300">
                Ingat saya
            </label>
            <button type="submit" class="btn-primary w-full">
                <i class="fa-solid fa-right-to-bracket"></i> Login
            </button>
        </form>

        <p class="mt-5 text-center text-sm text-slate-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold text-primary">Register</a>
        </p>
        <div class="mt-4 rounded-xl bg-slate-50 p-3 text-center text-xs text-slate-500">
            Demo admin: admin@solusinetnusantara.id / password
        </div>
    </div>
</section>
@endsection
