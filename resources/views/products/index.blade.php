@extends('layouts.app')

@section('content')
<section class="hero-bg">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold">Pilih paket internet terbaik</h1>
        <p class="mt-3 max-w-2xl text-gray-800">
            Daftar produk layanan kami, mulai dari paket rumahan hingga kebutuhan bisnis.
        </p>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($products as $product)
            <article class="card flex flex-col p-6">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="mb-4 h-40 w-full rounded-xl object-cover">
                @else
                    <div class="mb-4 flex h-40 w-full items-center justify-center rounded-xl bg-gray-100">
                        <i class="fa-solid fa-wifi text-4xl text-primary"></i>
                    </div>
                @endif

                <h2 class="text-xl font-extrabold text-slate-900">{{ $product->name }}</h2>
                @if($product->speed)
                    <p class="mt-1 text-sm font-semibold text-primary">{{ $product->speed }}</p>
                @endif

                <div class="mt-4 text-3xl font-extrabold text-primary">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                    <span class="text-sm font-semibold text-slate-500">/bulan</span>
                </div>

                @if($product->description)
                    <p class="mt-3 text-sm leading-relaxed text-slate-600">{{ $product->description }}</p>
                @endif

                @if($product->features_list)
                    <ul class="mt-4 space-y-2 text-sm text-slate-700">
                        @foreach($product->features_list as $feature)
                            <li class="flex gap-2">
                                <i class="fa-solid fa-circle-check mt-1 text-gray-700"></i>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div class="mt-auto pt-6">
                    @auth
                        <a href="{{ route('subscriptions.create') }}" class="btn-primary w-full">Ajukan Langganan</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary w-full">Login untuk Berlangganan</a>
                    @endauth
                </div>
            </article>
        @empty
            <div class="card col-span-full p-10 text-center text-slate-500">
                Belum ada produk tersedia.
            </div>
        @endforelse
    </div>
</section>

@auth
    @foreach($products as $product)
        <div id="subscribeModal{{ $product->id }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/50 p-4">
            <div class="card w-full max-w-lg p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">Ajukan Langganan</h3>
                        <p class="mt-1 text-sm text-slate-600">Paket {{ $product->name }} - Rp {{ number_format($product->price, 0, ',', '.') }}/bulan</p>
                    </div>
                    <button type="button" class="rounded-lg px-2 py-1 text-slate-500 hover:bg-slate-100" onclick="closeSubscribeModal({{ $product->id }})">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('products.subscribe', $product) }}" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label class="label" for="full_name_{{ $product->id }}">Nama Lengkap</label>
                        <input class="field" id="full_name_{{ $product->id }}" type="text" name="full_name" value="{{ old('full_name', auth()->user()->name) }}" required>
                    </div>
                    <div>
                        <label class="label" for="phone_{{ $product->id }}">No. HP / WA</label>
                        <input class="field" id="phone_{{ $product->id }}" type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div>
                        <label class="label" for="address_{{ $product->id }}">Alamat Instalasi</label>
                        <textarea class="field" id="address_{{ $product->id }}" name="address" rows="3" placeholder="Alamat lengkap pemasangan" required>{{ old('address') }}</textarea>
                    </div>
                    <div>
                        <label class="label" for="notes_{{ $product->id }}">Catatan (opsional)</label>
                        <textarea class="field" id="notes_{{ $product->id }}" name="notes" rows="2">{{ old('notes') }}</textarea>
                    </div>

                    @error('full_name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    @error('phone') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
                    @error('address') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

                    <div class="flex gap-3">
                        <button type="button" class="btn-outline flex-1" onclick="closeSubscribeModal({{ $product->id }})">Batal</button>
                        <button type="submit" class="btn-primary flex-1">Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endauth
@endsection

@push('scripts')
<script>
    function openSubscribeModal(id) {
        const modal = document.getElementById('subscribeModal' + id);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }
    function closeSubscribeModal(id) {
        const modal = document.getElementById('subscribeModal' + id);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
</script>
@endpush
