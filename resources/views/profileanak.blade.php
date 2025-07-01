<x-layout title="Profile Anak">
    <div class="container">
        <x-form title="Form Anak" method="POST" action="/anakAdd">
            <div class="mb-4">
                    <label for="anak_NIK" style="text-align: left;"><b>NIK Anak:</b></label>
                    <input type="text" id="anak_NIK" name="anak_NIK" required placeholder="Masukkan NIK Anak"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-gray-500 text-xs mt-1">Harus 16 karakter.</p>
                    @error('anak_NIK')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
            </div>

            <div class="mb-4">
                <label for="name"><b>Nama Anak:</b></label>
                <input type="text" id="name" name="name" required placeholder="Masukkan Nama Lengkap Anak"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggalLahir"><b>Tanggal Lahir:</b></label>
                <input type="date" id="tanggalLahir" name="tanggalLahir" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                required>
                @error('tanggalLahir')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label><b>Jenis Kelamin:</b></label>
                <div class="radio-group">
                    <label for="jenisKelamin_laki">
                        <input type="radio" id="jenisKelamin_laki" name="jenisKelamin" value="1" required> Laki-laki
                    </label>
                    <label for="jenisKelamin_perempuan">
                        <input type="radio" id="jenisKelamin_perempuan" name="jenisKelamin" value="0" required> Perempuan
                    </label>
                </div>
                @error('jenisKelamin')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label><b>Usia (0-2 Tahun atau 3-5 Tahun):</b></label>
                <div class="radio-group">
                    <label for="usia_0_2">
                        <input type="radio" id="usia_0_2" name="usia" value="0" required> 0-2 Tahun
                    </label>
                    <label for="usia_3_5">
                        <input type="radio" id="usia_3_5" name="usia" value="1" required> 3-5 Tahun
                    </label>
                </div>
                @error('usia')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <!-- Submit -->
            <div class="mt-6">
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    Simpan Data Anak
                </button>
            </div>
        </x-form>
    </div>
</x-layout>