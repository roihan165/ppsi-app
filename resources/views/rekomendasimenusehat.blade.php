<x-layout title="Rekomendasi Menu Sehat">
    <!-- Bagian Perkembangan Anak -->
    <div class="growth-section">
            <h2>Rekomendasi Menu Sehat</h2>
        <div class="growth-container">
            <x-card title="Telur Orak Arik" image="{{('storage/Telur_orak_arik.jpg')}}" cardTitle="Bahan-bahan:" :bahan="$bahanTelor" >
                <ul>Kandungan Gizi (Perkiraan):
                    <li>Kalori: 100 kcal</li>
                    <li>Protein: 6.7 g</li>
                    <li>Lemak: 7.5 g</li>
                    <li>Karbohidrat: 0.6 g</li>
                    <li>Zat Besi: 0.9 mg</li>
                    <li>Kolin: 147 mg</li>
                    <li>Vitamin D: 41 IU</li>
                    <li>Vitamin A: 270 IU</li>
                    <li>Vitamin B12: 0.6 mcg</li>
                </ul>
            </x-card>
                <div class="growth-card">
                    <img src="{{asset('storage/roti_gandum_utuh.jpeg')}}" alt="4-6 Bulan">
                    <h3>Roti Gandum Utuh (1 lembar)</h3>
                    <p>
                        <ul>Kandungan Gizi (Perkiraan):
                            <li>Kalori: 70-80 kcal</li>
                            <li>Protein: 3-4 g</li>
                            <li>Karbohidrat: 12-15 g</li>
                            <li>Serat: 2-3 g</li>
                            <li>Zat Besi: 0.7–1.2 mg</li>
                            <li>Vitamin B (folat, tiamin, dll.)</li>
                        </ul>
                    </p>
                </div>
                <div class="growth-card">
                    <img src="{{asset('storage/pisang.jpeg')}}" alt="7-9 Bulan">
                <h3>Pisang (½ buah pisang ukuran sedang)</h3>
                <p>
                        <ul>Kandungan Gizi (Perkiraan):
                            <li>Kalori: 50 kcal</li>
                            <li>Karbohidrat: 13 g</li>
                            <li>Gula Alami: 7 g</li>
                            <li>Serat: 15 g</li>
                            <li>Kalium: 210 mg</li>
                            <li>Vitamin C: 5 mg</li>    
                            <li>Vitamin B6: 0.2 mg</li>
                        </ul>
                    </p>
        </div>
    <div class="growth-card">
        <img src="{{asset('storage/yogurt.jpeg')}}" alt="10-12 Bulan">
                    <h3>Yogurt Plain Full-Fat (½ cangkir)</h3>
                    <p>
                        <ul>Kandungan Gizi (Perkiraan):
                            <li>Kalori: 80-100 kcal</li>
                            <li>Protein: 4-5 g</li>
                            <li>Lemak: 4-6 g</li>
                            <li>Kalsium: 150–200 mg</li>
                            <li>Probiotik (tergantung merek)</li>
                            <li>Vitamin D (jika difortifikasi)</li>
                        </ul>
                    </p>
                </div>
                <div class="growth-card">
                    <img src="{{asset('storage/daging_ayam_dada.jpeg')}}" alt="1-3 Tahun">
                    <h3>Ayam Dada/Daging Ayam (¼ cangkir matang, cincang)</h3>
                    <p>
                        <ul>Kandungan Gizi (Perkiraan):
                            <li>Kalori: 60-80 kcal</li>
                            <li>Protein: 10-12 g</li>
                            <li>Lemak: 2-4 g</li>
                            <li>Zat Besi: 0.4–0.6 mg</li>
                            <li>Mengandung Zinc, Vitamin B6, dan B12</li>
                        </ul>
                    </p>
            </div>
        </div>
    </div>
</x-layout>