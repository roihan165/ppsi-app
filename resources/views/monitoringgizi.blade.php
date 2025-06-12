<x-layout title="Monitoring Pertumbuhan Anak">
    <h5>Monitoring Pertumbuhan Anak</h5>
    <x-form title="Form Monitoring" method="POST" action="/">
        <!-- Name -->
        <div class="mb-4">
            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <input type="radio" name="Jenis_Kelamin" id="laki-laki" value="Laki-laki">
            <label for="laki_laki">Laki-laki</label>
            <input type="radio" name="Jenis_Kelamin" id="Perempuan" value="Perempuan">
            <label for="Perempuan">Perempuan</label>
        </div>

        <div class="mb-4">
            <label for="usia" class="block text-sm font-medium text-gray-700">Usia (Berdasar Bulan)</label>
            <input type="number" name="usia" id="usia" value="{{ old('usia') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="tinggi" class="block text-sm font-medium text-gray-700">Tinggi (Cm)</label>
            <input type="decimal" name="tinggi" id="tinggi" value="{{ old('tinggi') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="berat" class="block text-sm font-medium text-gray-700">Berat (Kg)</label>
            <input type="decimal" name="berat" id="berat" value="{{ old('berat') }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
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