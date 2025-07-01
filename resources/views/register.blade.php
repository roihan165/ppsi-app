<x-layout title="Halaman Daftar">
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    <div class="container">
        <x-form title="Form Daftar" method="POST" action="/userAdd">
    
            <!-- Full Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700" style="text-align: left;"><b>Nama Lengkap:</b></label>
                <input type="name" name="name" id="name" value="{{ old('name') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="contoh:Budi Doremi"
                       required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4" >
                <label for="nik" class="block text-sm font-medium text-gray-700" style="text-align: left;"><b>NIK:</b></label>
                <input type="text" id="nik" name="nik" value="{{ old('nik') }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required 
                placeholder="Masukkan NIK Anda">
                <p class="text-gray-500 text-xs mt-1">Minimal 16 karakter.</p>
                @error('nik')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700" style="text-align: left;"><b>Email:</b></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                       placeholder="namaemail@gmail.com"
                       required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <!-- Email -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700" style="text-align: left;"><b>Password:</b></label>
                <div class="relative">
                    <input type="password" name="password" id="password" value="{{ old('password') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" id="togglePassword">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path id="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path id="eye-closed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </span>
                </div>
                <p class="text-gray-500 text-xs mt-1">Minimal 8 karakter.</p>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
    
            <div class="mb-4">
                <label for="password_confirmation" style="text-align: left;"><b>Confirm Password</b></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
    
            <!-- Submit -->
            <div class="mt-6">
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    Submit
                </button>
            </div>
            <div class="links">
                Sudah Punya Akun? <a href="{{ route('login') }}">Login disini</a>
            </div>
        </x-form>
    </div>
</x-layout>