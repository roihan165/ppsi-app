<x-layout title="Lupa Password">
    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif
    <div class="container">
    <x-form title="Forget Form" method="POST" action="{{ route('password.email') }}">
        <label for="email" class="block text-sm font-medium text-gray-700" style="text-align: left;"><b>Email:</b></label>
        <input type="email" id="email" name="email" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
        placeholder="email@gmail.com"
        required>
        <div class="mt-6">
            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                Kirim Link Reset
            </button>
        </div>
    </x-form>
    </div>
</x-layout>