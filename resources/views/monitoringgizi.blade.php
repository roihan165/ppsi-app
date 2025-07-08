<x-layout title="Monitoring Pertumbuhan Anak">
    <!-- <h5>Monitoring Pertumbuhan Anak</h5> -->
    <div class="container">

        <x-form title="Form Monitoring" action="{{ route('submit.data') }}" method="POST">
            @auth
            <!-- NIK Anak (hidden, akan dikirim bersama form) -->
            {{-- Kita asumsikan $anak sudah ada jika form ini diakses melalui pemilihan anak --}}
            @if($anak)
            <div class="mb-4">
                <label for="anakNIK" style="text-align: left;"><b>NIK:</b></label>
                <input type="type" id="anakNIK" name="anak_NIK" value="{{ $anak->anak_NIK }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" readonly>
            </div>
            @endif
            <!-- Name -->
            <div class="mb-4">
                <label for="nama" style="text-align: left;"><b>Nama:</b></label>
                {{-- Isi value dengan $anak->name jika $anak ada, jika tidak, pakai old('nama') --}}
                <input type="text" id="nama" name="nama" required
                       value="{{ $anak ? $anak->name : old('nama') }}"
                       {{ $anak ? 'readonly' : '' }} class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"> {{-- Opsional: buat readonly jika data sudah ada --}}
                @error('nama') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
    
            <div class="mb-4">
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700"><b>Jenis Kelamin:</b></label>
                {{-- Mengisi radio button Jenis Kelamin --}}
                <input type="radio" name="jenis_kelamin" id="laki-laki" value="1" {{ $anak && $anak->jenisKelamin == 1 ? 'checked' : '' }} required>
                <label for="laki-laki">Laki-laki</label>
                <input type="radio" name="jenis_kelamin" id="perempuan" value="0" {{ $anak && $anak->jenisKelamin == 0 ? 'checked' : '' }} required>
                <label for="perempuan">Perempuan</label>
                @error('jenis_kelamin') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
    
            <div class="mb-4">
                <label for="usia" class="block text-sm font-medium text-gray-700"><b>Usia (Berdasarkan Kategori):</b></label>
                {{-- Mengisi radio button Usia --}}
                <input type="radio" name="usia" id="usia_0_2" value="0" {{ $anak && $anak->usia == 0 ? 'checked' : '' }} required>
                <label for="usia_0_2">0-2 Tahun</label>
                <input type="radio" name="usia" id="usia_3_5" value="1" {{ $anak && $anak->usia == 1 ? 'checked' : '' }} required>
                <label for="usia_3_5">3-5 Tahun</label>
                @error('usia') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div>
    
            <div class="mb-4">
                <label for="tinggi" class="block text-sm font-medium text-gray-700" style="text-align: left;"><b>Tinggi (Cm):</b></label>
                <input type="number" step="any" name="tinggi" id="tinggi" value="{{ old('tinggi') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
    
            <div class="mb-4">
                <label for="berat" class="block text-sm font-medium text-gray-700" style="text-align: left;"><b>Berat (Kg)</b></label>
                <input type="number" step="any"name="berat" id="berat" value="{{ old('berat') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
    
            <div class="mb-4">
                <label for="daymonth"><b>Bulan Isi Form:</b></label>
                <input type="month" id="daymonth" name="daymonth">
            </div>
            
    
            <!-- <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">
                @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
            </div> -->
            <!-- <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div> -->
    
            <!-- Submit -->
            <div class="mt-6">
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                    Submit
                </button>
            </div>
            <small> Harap Tunggu Selama 15 Menit untuk Update Grafik, Lalu Refresh Kembali Website!!! </small>
            @endauth
        </x-form>
    </div>
    <div class="dashboard-section">
            <h2>Grafik Pertumbuhan</h2>
            @if (isset($finalEmbedUrl))
                <iframe src="{{ $finalEmbedUrl }}" allowfullscreen></iframe>
            @else
                <div class="error-message">
                    <p>Dashboard tidak tersedia. Pastikan Anda sudah login atau hubungi admin.</p>
                </div>
            @endif
        </div>
</x-layout>