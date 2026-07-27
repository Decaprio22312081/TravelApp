@extends('layouts.app')

@section('title', 'Lupa Password - TravelKu')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <div class="bg-white rounded-xl shadow p-8">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Lupa Password</h2>
        <p class="text-gray-600 text-sm text-center mb-6">Masukkan email Anda dan kami akan mengirimkan tautan reset password.</p>

        @if(session('status'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4">
                <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none @error('email') border-red-500 @enderror">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">Kirim Tautan Reset Password</button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline"><i class="fas fa-arrow-left mr-1"></i>Kembali ke Login</a>
        </p>
    </div>
</div>
@endsection
