@extends('layouts.app')

@section('content')
<section class="hero-bg">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <h1 class="mt-3 text-4xl font-extrabold">Ajukan Langganan Anda</h1>
        <p class="mt-3 max-w-2xl text-gray-800">
            Pilih paket, isi data pemasangan, dan pantau status pengajuan langganan Anda.
        </p>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mb-10">
        <h2 class="section-title">Pilih Paket</h2>
        <p class="mt-2 text-slate-600">Klik salah satu paket untuk mengajukan langganan cepat.</p>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($products as $product)
            <article class="card flex flex-col p-6">
                <h3 class="text-lg font-extrabold text-slate-900">{{ $product->name }}</h3>
                @if($product->speed)
                    <p class="mt-1 text-sm font-semibold text-primary">{{ $product->speed }}</p>
                @endif
                <div class="mt-3 text-2xl font-extrabold text-primary">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                    <span class="text-sm text-slate-500">/bulan</span>
                </div>
                @if($product->description)
                    <p class="mt-3 flex-1 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($product->description, 100) }}</p>
                @endif
                <button type="button" class="btn-primary mt-5 w-full" onclick="document.getElementById('sub-form-{{ $product->id }}').classList.toggle('hidden')">
                    Pilih Paket Ini
                </button>
            </article>
        @empty
            <div class="card col-span-full p-10 text-center text-slate-500">Belum ada paket tersedia.</div>
        @endforelse
    </div>

    <div class="mt-12 grid gap-6 lg:grid-cols-2">
        <div class="card p-6 sm:p-8">
            <h2 class="text-xl font-extrabold text-slate-900">Formulir Pengajuan</h2>
            <p class="mt-1 text-sm text-slate-600">Isi data berikut untuk setiap paket yang dipilih.</p>

            <div class="mt-6 space-y-6">
                @foreach($products as $product)
                    <form id="sub-form-{{ $product->id }}" method="POST" action="{{ route('products.subscribe', $product) }}" enctype="multipart/form-data" class="hidden rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        @csrf
                        <div class="mb-4 flex items-center justify-between">
                            <div>
                                <div class="font-extrabold text-slate-900">{{ $product->name }}</div>
                                <div class="text-sm text-slate-600">Rp {{ number_format($product->price, 0, ',', '.') }}/bulan</div>
                            </div>
                            <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-primary">Dipilih</span>
                        </div>

                        <div class="space-y-3">
                            <div>
                                <label class="label">Nama Lengkap</label>
                                <input class="field" type="text" name="full_name" value="{{ old('full_name', auth()->user()->name) }}" required>
                            </div>
                            <div>
                                <label class="label">No. HP / WA</label>
                                <input class="field" type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="08xxxxxxxxxx" required>
                            </div>
                            <div>
                                <label class="label">Alamat Instalasi</label>
                                <textarea class="field" name="address" rows="3" required>{{ old('address') }}</textarea>
                            </div>
                            <div>
                                <label class="label">Bukti Pembayaran</label>
                                <input class="field" type="file" name="payment_proof" accept="image/jpeg,image/png" required>
                               <!-- // <p class="mt-1 text-xs text-slate-500">Format JPG atau PNG, maksimal 5 MB.</p> -->
                            </div>
                            <button type="submit" class="btn-primary w-full">Kirim Pengajuan</button>
                        </div>
                    </form>
                @endforeach
            </div>
        </div>

        <div class="card p-6 sm:p-8">
            <h2 class="text-xl font-extrabold text-slate-900">Riwayat Pengajuan</h2>
            <div class="mt-5 space-y-4">
                @forelse($subscriptions as $sub)
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <div class="font-bold text-slate-900">{{ $sub->product?->name }}</div>
                                <div class="text-xs text-slate-500">{{ $sub->created_at->format('d M Y H:i') }}</div>
                            </div>
                            @php
                                $statusColor = match($sub->status) {
                                    'approved' => 'bg-gray-200 text-gray-800',
                                    'rejected' => 'bg-gray-100 text-gray-700',
                                    'process' => 'bg-gray-300 text-gray-800',
                                    default => 'bg-slate-100 text-slate-700',
                                };
                            @endphp
                            <span class="rounded-full px-3 py-1 text-xs font-bold {{ $statusColor }}">{{ ucfirst($sub->status) }}</span>
                        </div>
                        <div class="mt-3 text-sm text-slate-600">
                            <div><strong>Alamat:</strong> {{ $sub->address }}</div>
                            <div><strong>HP:</strong> {{ $sub->phone }}</div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl bg-slate-50 p-6 text-center text-sm text-slate-500">
                        Belum ada pengajuan langganan.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
@endsection
