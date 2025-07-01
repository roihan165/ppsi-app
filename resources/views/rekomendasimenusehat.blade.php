<x-layout title="Rekomendasi Menu Sehat">
    <!-- Bagian Perkembangan Anak -->
    <div class="growth-section">
            <h2>Rekomendasi Menu Sehat</h2><a href="https://drive.google.com/file/d/1o04fnO9fzCxxouteXCBiuSOCchi35kH2/view?usp=sharing" target="_blank"
  rel="noopener noreferrer" download="Resep_MPASI_Anak.pdf">
        <i class="fas fa-file-pdf"></i> Unduh Resep MPASI</a>
    </a>
        <div class="growth-container">
            <x-card
                    title="Cara Pembuatan:" {{-- Ini akan jadi judul modal pop-up --}}
                    image="{{ asset('storage/Resep_Bubur_Singkong_Isi_Ikan.png') }}"
                    url="https://drive.google.com/file/d/1kiIbh3Q_7MTZUtVM0t_B-G8X-qjk5lSC/view?usp=sharing"
                    cardTitle="Bubur Singkong Isi Ikan dan Ayam dengan Saus Jeruk" {{-- Ini akan jadi judul di dalam card --}}
                    :bahan="$pembuatan['BuburSingkong']"
                >
                    {{-- Konten slot untuk card utama --}}
                    <ul><b>Bahan Utama:</b>
                        <li>75 gr singkong putih, rebus dan haluskan</li>
                        <li>15 gr (2 sdm datar) daging ikan kembung cincang halus</li>
                        <li>15 gr daging ayam cincang rebus</li>
                        <li>250 ml air kaldu ayam</li>
                        <li>5 gr (1 sdt) minyak kelapa</li>
                        <li>20 gr (2 sdm) bayam segar, potong halus</li>
                        <br>
                        <b>Bumbu:</b>
                        <li>1 lembar daun salam</li>
                        <li>1 batang sereh</li>
                        <br>
                        <b>Bumbu Halus</b>
                        <li>1 siung bawang merah</li>
                        <li>1 siung bawang putih Buah</li>
                        <li>100 gr (3 buah kecil) jeruk manis diambil sarinya</li>
                    </ul>
                </x-card>
            <x-card
                    title="Cara Pembuatan:" {{-- Ini akan jadi judul modal pop-up --}}
                    image="{{ asset('storage/Resep_Bubur_Soto_Ayam.png') }}"
                    url="https://drive.google.com/file/d/1T0Q_szhxKLjfh_x7gobDNtmF41vfIg0a/view?usp=sharing"
                    cardTitle="Bubur Soto Ayam Santan" {{-- Ini akan jadi judul di dalam card --}}
                    :bahan="$pembuatan['BuburSotoAyam']"
                >
                    {{-- Konten slot untuk card utama --}}
                    <ul><b>Bahan Utama:</b>
                        <li>60 gr (6 sdm) Nasi putih</li>
                        <li>45 gr (4.5 sdm) Daging</li>
                        <li>ayam cincang</li>
                        <li>30 gr (1 buah kecil) Tahu</li>
                        <li>30 gr (3 sdm) Labu siam</li>
                        <li>15 gr (1.5 sdm) wortel</li>
                        <li>1 lembar Salam</li>
                        <li>1 batang Sereh</li>
                        <li>1 lembar Daun jeruk</li>
                        <li>5 gr (1 sdm) Minyak goreng</li>
                        <li>30 ml (3 sdm) Santan</li>
                        <li>300 ml Air kaldu ayam</li>
                        <br>
                        <b>Bumbu Halus:</b>
                        <li>1 siung bawang merah</li>
                        <li>1 siung bawang putih</li>
                        <li>1 cm Kunyit</li>
                        <li>1 cm Jahe</li>
                        <br>
                        <b>Buah:</b>
                        <li>100 gr (3 buah kecil) Jeruk (diambil sarinya)</li>
                    </ul>
                </x-card>
            <x-card
                    title="Cara Pembuatan:" {{-- Ini akan jadi judul modal pop-up --}}
                    image="{{ asset('storage/Resep_Bubur_Sup_Daging.png') }}"
                    url="https://drive.google.com/file/d/1Z_MlTqoWGKnjWqwlZ2KAetPHg2jJytcN/view?usp=sharing"
                    cardTitle="Bubur Sup Daging Kacang Merah" {{-- Ini akan jadi judul di dalam card --}}
                    :bahan="$pembuatan['BuburSupDaging']"
                >
                    {{-- Konten slot untuk card utama --}}
                    <ul><b>Bahan Utama:</b>
                        <li>50 gr (6 sdm) nasi</li>
                        <li>30 gr (3 sdm) daging ayam cincang</li>
                        <li>25 gr (1/2 butir) telur ayam</li>
                        <li>10 gr (1 sdm) buncis</li>
                        <li>10 gr (1 sdm) wortel</li>
                        <li>10 gr (1 sdm) kacang merah</li>
                        <li>10 gr (1 batang) bawang daun</li>
                        <li>1 batang seledri</li>
                        <li>300 ml kaldu ayam</li>
                        <li>2.5 gr (1/2 sdt) minyak untuk menumis.</li>
                        <br>
                        <b>Bumbu Halus:</b>
                        <li>2 siung bawang merah</li>
                        <li>2 siung bawang putih</li>
                        <br>
                        <b>Buah:</b>
                        <li>100 gr (2 buah) Jeruk (diambil sarinya)</li>
                    </ul>
                </x-card>
        </div>
    </div>
</x-layout>