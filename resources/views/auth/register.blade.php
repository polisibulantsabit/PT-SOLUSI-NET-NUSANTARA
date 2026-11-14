@extends('layouts.app')

@section('content')
<section class="hero-bg">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="section-kicker text-gray-200"><i class="fa-solid fa-user-plus"></i> Register</div>
        <h1 class="mt-3 text-4xl font-extrabold">Buat akun member</h1>
        <p class="mt-3 max-w-2xl text-gray-800">Daftar gratis untuk mengajukan langganan paket internet.</p>
    </div>
</section>

<section class="mx-auto max-w-md px-4 py-16 sm:px-6">
    <div class="card p-6 sm:p-8">
        <h2 class="text-xl font-extrabold text-slate-900">Registrasi Akun</h2>

        @if($errors->any())
            <div class="alert alert-error mt-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="label" for="name">Nama Lengkap</label>
                <input class="field" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            </div>
            <div>
                <label class="label" for="email">Email</label>
                <input class="field" id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label class="label" for="phone">No. HP (opsional)</label>
                <input class="field" id="phone" type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx">
            </div>
            <div>
                <label class="label" for="password">Password</label>
                <input class="field" id="password" type="password" name="password" required>
            </div>
            <div>
                <label class="label" for="password_confirmation">Konfirmasi Password</label>
                <input class="field" id="password_confirmation" type="password" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn-primary w-full">
                <i class="fa-solid fa-user-plus"></i> Register
            </button>
        </form>

        <p class="mt-5 text-center text-sm text-slate-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-primary">Login</a>
        </p>
    </div>
</section>
@endsection
