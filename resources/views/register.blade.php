<x-layout title="Halaman Daftar">
    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    <x-form title="Form Daftar" method="POST" action="/userAdd">

        <!-- Full Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <input type="name" name="name" id="name" value="{{ old('name') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <!-- Email -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Submit -->
        <div class="mt-6">
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                Submit
            </button>
        </div>
    
    </x-form>
</x-layout>