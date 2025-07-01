<x-layout title="Dashboard">
    <!-- Bagian Monitoring Gizi Anak --> 
    <div class="container">
            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif
        
            @auth
                <p>You are logged in as: {{ Auth::user()->name }} ({{ Auth::user()->email }})</p>
            @else
                <p>You are not logged in.</p>
                <p><a href="{{ route('login') }}">Login</a> or <a href="{{ route('register') }}">Register</a></p>
            @endauth
            <br>
            @if (isset($selectedAnak) && $selectedAnak)
                <div class="selected-anak-info">
                    <h2>Data Anak Terpilih:</h2>
                    <p><strong>Nama:</strong> {{ $selectedAnak->name }}</p>
                    <p><strong>NIK:</strong> {{ $selectedAnak->anak_NIK }}</p>
                    <p><strong>Tanggal Lahir:</strong> {{ $selectedAnak->tanggalLahir->format('d M Y') }}</p>
                    <p><strong>Jenis Kelamin:</strong> {{ $selectedAnak->jenisKelamin == 1 ? 'Laki-laki' : 'Perempuan' }}</p>
                    <p><strong>Usia Kategori:</strong> {{ $selectedAnak->usia == 0 ? '0-3 Tahun' : '3-5 Tahun' }}</p>

                    <!-- {{-- Contoh fitur yang membutuhkan anak_NIK --}}
                    <a href="{{ route('monitoring.pertumbuhan', ['anak_NIK' => $selectedAnak->anak_NIK]) }}">
                        <button>Lanjutkan ke Monitoring Anak Ini</button>
                    </a>
                    <button onclick="alert('Fitur lain untuk anak {{ $selectedAnak->name }} (NIK: {{ $selectedAnak->anak_NIK }})')">Jalankan Fitur A</button> -->
                </div>
                @else
                    <div class="no-anak-selected">
                        <p>Belum ada anak yang dipilih atau Anda belum memiliki data anak.</p>
                        <p>Silakan pilih anak dari menu "Anak Saya" di navigasi, atau <a href="{{ route('anak.create') }}">tambahkan data anak baru</a>.</p>
                    </div>
                @endif
                <br>
                <h2>TumbuhKu - Monitoring Pertumbuhan Anak</h2>
                <div class="feature-boxes">
                    @auth
                    @if (isset($selectedAnak) && $selectedAnak)
                        <a href="{{ route('monitoring.pertumbuhan',['anak_NIK' => $selectedAnak->anak_NIK]) }}"><div class="feature-box">📊 Monitoring Pertumbuhan</div></a>
                    @endif
                    @endauth
                    @guest
                        <a href="{{ route('monitoring.guest') }}"><div class="feature-box">📊 Monitoring Pertumbuhan</div></a>
                    @endguest
                    <a href="/rekomendasimenusehat"><div class="feature-box">🥗 Rekomendasi Menu Sehat</div></a>
                    <a href="https://www.halodoc.com/tanya-dokter/dr-gracia-deswita-natalya-fau-sp-a" target="_blank"
  rel="noopener noreferrer"><div class="feature-box">👩‍⚕️ Konsultasi Ahli</div></a>
                </div>
            </div>
    
        <!-- Bagian Perkembangan Anak -->
        <div class="growth-section">
            <h2>Perkembangan Anak dari Bayi hingga Usia 5 Tahun 
                <a href="{{ route('selfChecking.form')}}" style="display: flex; align-items: center; gap: 5px; text-decoration: none; color: #333;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                Self Checking
                </a>
            </h2>
        <div class="growth-container">
                <div class="growth-card">
                    <img src="{{('storage/dashboard/0-3bulan.jpeg')}}" alt="0-3 Bulan">
                    <h3>0-3 Bulan</h3>
                    <p>Bayi mulai menatap ke ibu, mengeluarkan suara "o..o..o.."</p>
                </div>
                <div class="growth-card">
                    <img src="{{('storage/dashboard/4-6bulan.jpg')}}" alt="4-6 Bulan">
                    <h3>4-6 Bulan</h3>
                    <p>Bayi mulai berbalik dari telungkup ke telentang.</p>
                </div>
                <div class="growth-card">
                    <img src="{{('storage/dashboard/7-9bulan.jpeg')}}" alt="7-9 Bulan">
                <h3>7-9 Bulan</h3>
            <p>Bayi mulai merangkak dan mengucapkan "ma..ma..", "da..da.."</p>
        </div>
    <div class="growth-card">
        <img src="{{('storage/dashboard/10-12bulan.jpeg')}}" alt="10-12 Bulan">
                    <h3>10-12 Bulan</h3>
                    <p>Bayi mulai berdiri sendiri dan belajar berjalan.</p>
                </div>
                <div class="growth-card">
                    <img src="{{('storage/dashboard/1-3tahun.jpeg')}}" alt="1-3 Tahun">
                    <h3>1-3 Tahun</h3>
                <p>Anak mulai berbicara kata-kata sederhana dan berjalan dengan lebih stabil.</p>
            </div>
                <div class="growth-card">
                    <img src="{{('storage/dashboard/4-6tahun.jpeg')}}" alt="4-6 Tahun">
                    <h3>4-5 Tahun</h3>
                <p>Anak mulai belajar menulis, membaca huruf, dan bersosialisasi dengan teman sebaya.</p>
                </div>
                <!-- <div class="growth-card">
                    <img src="{{('storage/dashboard/7-12tahun.jpeg')}}" alt="7-12 Tahun">
                    <h3>7-12 Tahun</h3>
                <p>Anak lebih mandiri, belajar lebih kompleks, dan mengembangkan keterampilan sosial.</p>
            </div>
        <div class="growth-card">
                    <img src="{{('storage/dashboard/13-18tahun.jpeg')}}" alt="13-18 Tahun">
                    <h3>13-18 Tahun</h3>
                <p>Masa remaja, perkembangan fisik dan emosional yang pesat, mulai memahami tanggung jawab.</p>
            </div> -->
        </div>
    </div>
</x-layout>