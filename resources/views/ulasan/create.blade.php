@extends('layouts.app')

@section('title', 'Beri Ulasan - TravelKu')

@section('content')
<div class="max-w-lg mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Beri Ulasan</h1>

    <div class="bg-white rounded-xl shadow p-6 mb-6">
        <h2 class="font-bold text-gray-700 mb-2">Informasi Pesanan</h2>
        <p class="text-sm text-gray-600">Mobil: <span class="font-medium text-gray-800">{{ $pemesanan->mobil->nama ?? '-' }}</span></p>
        <p class="text-sm text-gray-600">Tujuan: <span class="font-medium text-gray-800">{{ $pemesanan->alamat_tujuan }}</span></p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form method="POST" action="{{ route('ulasan.store', $pemesanan->id) }}">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-3">Rating</label>
                <div class="flex space-x-2 text-3xl" id="ratingStars">
                    @for($i = 1; $i <= 5; $i++)
                    <label class="cursor-pointer">
                        <input type="radio" name="rating" value="{{ $i }}" class="hidden rating-input" {{ old('rating') == $i ? 'checked' : '' }}>
                        <i class="fas fa-star text-gray-300 hover:text-yellow-400 rating-star" data-value="{{ $i }}"></i>
                    </label>
                    @endfor
                </div>
                @error('rating')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-medium mb-2">Komentar</label>
                <textarea name="komentar" rows="5" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('komentar') border-red-500 @enderror">{{ old('komentar') }}</textarea>
                @error('komentar')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                <i class="fas fa-paper-plane mr-2"></i>Kirim Ulasan
            </button>
        </form>
    </div>
</div>

<script>
document.querySelectorAll('.rating-star').forEach(star => {
    star.addEventListener('click', function() {
        const value = parseInt(this.dataset.value);
        document.querySelectorAll('.rating-star').forEach((s, i) => {
            if (i < value) {
                s.classList.remove('text-gray-300');
                s.classList.add('text-yellow-400');
            } else {
                s.classList.remove('text-yellow-400');
                s.classList.add('text-gray-300');
            }
        });
        this.closest('label').querySelector('.rating-input').checked = true;
    });
});
</script>
@endsection
