<x-layout title="Reset Password">
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
        @endforeach
    </ul>
    @endif
    <div class="container">
        <x-form title="Reset Form" method="POST" action="{{ route('password.update') }}">
            <input type="hidden" name="token" value="{{ $token }}">
    
            <label for="email" class="block text-sm font-medium text-gray-700" style="text-align: left;"><b>Email:</b></label>
            <input type="email" name="email" id="email"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="email@gmail.com"
            required>

            <label for="password" class="block text-sm font-medium text-gray-700" style="text-align: left;"><b>Password Baru:</b></label>
            <input type="password" name="password" id="password"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="12345678"
            required>
            <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" id="togglePassword">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path id="eye-open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path id="eye-closed" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </span>
            <p class="text-gray-500 text-xs mt-1">Minimal 8 karakter.</p>

            <label for="password_confirmation" style="text-align: left;"><b>Konfirmasi Password:</b></label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
            required>

            <button type="submit" 
            class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
            Ubah Password
            </button>
        </x-form>
    </div>
</x-layout>