<x-layout title="Dashboard">
    
    <!-- Bagian Monitoring Gizi Anak --> 
        <div class="container">
            <h2>TumbuhKu - Monitoring Pertumbuhan Anak</h2>
            <div class="feature-boxes">
                <a href="/monitoringPertumbuhan"><div class="feature-box">📊 Monitoring Pertumbuhan</div></a>
                <a href="/rekomendasimenusehat"><div class="feature-box">🥗 Rekomendasi Menu Sehat</div></a>
                <div class="feature-box">👩‍⚕️ Konsultasi Ahli</div>
            </div>
        </div>
    
        <!-- Bagian Perkembangan Anak -->
        <div class="growth-section">
            <h2>Perkembangan Anak dari Bayi hingga Usia 5 Tahun</h2>
        <div class="growth-container">
            <x-card title="0-6 Bulan" image="{{('storage/dashboard/0-3bulan.jpeg')}}" :bahan="$motorik" >
                    <p>Bayi mulai menatap ke ibu, mengeluarkan suara "o..o..o.."</p>
            </x-card>
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