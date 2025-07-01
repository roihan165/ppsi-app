<x-layout title="Self Checking WHO Standard">
    <div class="container">
        <h1>Cek Perkembangan Motorik Kasar Anak</h1>
        <h2>Berdasarkan Standar WHO</h2>
        <p>Alat ini membantu Anda mengecek perkembangan motorik kasar anak Anda. Pilih anak, lalu jawab pertanyaan-pertanyaan berikut:</p>

        @guest
            <small>Usia minimal Monitoring: 5 Bulan</small>
            <div id="guestInputBox" style="display: none; margin-bottom: 1em;">
                <label for="manualAge">Masukkan usia anak (bulan):</label>
                <input type="number" id="manualAge" min="1" step="0.1" placeholder="cth: 5.5" />
                <button type="button" onclick="startGuestSelfCheck()">Lanjut</button>
            </div>

            <div id="resultContainer"></div>
        @endguest

        @auth
        <form id="milestoneChecklist">
            <div class="section-input">
                <label for="selectedChildId">Pilih Anak yang Diperiksa:</label>
                <select id="selectedChildId" required>
                    <option value="">-- Pilih Anak --</option>
                    {{-- Loop melalui anak-anak yang dimiliki user yang sedang login --}}
                    {{-- Variabel $anaks dikirim dari controller 'showForm' --}}
                    @foreach($anaks as $anak)
                        {{-- Penting: value adalah anak_NIK karena itu primary key di tabel anak Anda --}}
                        <option value="{{ $anak->anak_NIK }}" data-dob="{{ $anak->tanggalLahir }}">{{ $anak->name }} (NIK: {{ $anak->anak_NIK }})</option>
                    @endforeach
                </select>
            </div>

            <div class="section-input">
                <label for="childAgeMonths" style="display: none;">Usia Anak Terpilih Saat Ini (akan otomatis terisi):</label>
                <input type="number" id="childAgeMonths" min="0" max="60" value="" placeholder="Otomatis" required readonly style="display: none;">
                <h2><b>Usia:</b></h2>
                <h2 id="childAgeDisplay"></h2>
            </div>

            <h3 class="section-title">Tonggak Perkembangan Motorik Kasar</h3>
            <div id="milestoneQuestions">
            </div>

            <div class="button-group">
                <button type="submit">Cek Perkembangan</button>
            </div>
        </form>
        @endauth            

        <div id="overallResult">
        </div>

        <div id="detailedResults">
        </div>

        <div class="disclaimer">
            <b>Penting:</b> Alat ini menggunakan data standar WHO namun hanya sebagai panduan awal dan bukan pengganti diagnosis medis profesional. Jika Anda memiliki kekhawatiran tentang perkembangan anak Anda, <b>segera konsultasikan dengan dokter anak atau ahli tumbuh kembang</b>. Variasi antar anak adalah normal.
        </div>
    </div>
</x-layout>