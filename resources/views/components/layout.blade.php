<!-- <div>
    Smile, breathe, and go slowly. - Thich Nhat Hanh
</div> -->
    <!DOCTYPE html>
    <html lang="id">
        <head>
            <!-- <meta charset="UTF-8"> -->
            <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
            <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- Penting untuk permintaan AJAX --}}
            <title>{{ $title ?? "TumbuhKu - Monitoring Perkembangan Anak" }}</title>
            <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
            <!-- Font Awesome Icons -->
            <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> -->
            <script src="https://kit.fontawesome.com/bab8d9a137.js" crossorigin="anonymous"></script>
            <script>
            // Optional: log Alpine loaded
            document.addEventListener('alpine:init', () => {
                console.log('Alpine is ready');
            });
            </script>
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="https://public.tableau.com/javascripts/api/tableau-2.min.js"></script>
            <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f8f9fa;
            }
            /* Navbar */
            .navbar {
                display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            background-color: #4CAF50;
            position: sticky;
            top: 0;
            z-index: 1000;
            }
            .logo {
                display: flex; /* Menggunakan Flexbox untuk mengatur tata letak anak-anaknya */
                align-items: center; /* Menyelaraskan item secara vertikal di tengah */
                gap: 10px; /* Memberikan jarak antara gambar dan teks (bisa disesuaikan) */
                /* Anda bisa menambahkan properti lain di sini jika diperlukan,
                   misalnya font-size, color, dll. untuk teks 'TumbuhKu' */
                font-size: 2em; /* Contoh ukuran font untuk TumbuhKu */
                color: #333;
            }
        
            /* Opsional: Jika Anda ingin lebih spesifik menata teks TumbuhKu */
            .logo .logo-text {
                /* Anda bisa tambahkan gaya spesifik di sini jika diinginkan */
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                color: white;
            }
            .nav-links {
            display: flex;
            gap: 10px;
            }
            .nav-links button {
                background: white;
            border: none;
            padding: 10px 15px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s;
            }
            .nav-links button:hover {
                background: #ddd;
                }
                
                /* Section Monitoring */
                .container {
            text-align: center;
            margin-top: 60px;
            padding: 20px;
            }
        .container h2 {
            font-size: 26px;
            margin-bottom: 20px;
            }
        .feature-boxes {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        .feature-box {
            width: 250px;
            height: 120px;
            background: #e0f2f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            border-radius: 12px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, background 0.3s;
            }
        .feature-box:hover {
            transform: scale(1.05);
            background: #b2dfdb;
        }
        h1, h2 { color: #2c3e50; text-align: center; margin-bottom: 25px; }
        .section-input { margin-bottom: 20px; padding: 15px; background-color: #e8f5e9; border-radius: 5px; }
        .section-input label { font-weight: bold; display: block; margin-bottom: 8px; }
        .section-input input[type="number"], .section-input select { padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 100%; max-width: 250px; font-size: 1em; }
        .section-title { color: #3498db; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px; margin-top: 30px; margin-bottom: 20px; }
        .question-item { margin-bottom: 15px; padding: 10px; background-color: #ecf0f1; border-radius: 5px; display: flex; align-items: center; justify-content: space-between; }
        .question-item label { flex-grow: 1; font-weight: 500; cursor: pointer; }
        .question-item input[type="radio"] { margin-left: 15px; transform: scale(1.2); cursor: pointer; }
        .button-group { text-align: center; margin-top: 30px; }
        button { padding: 12px 25px; background-color: #27ae60; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease; }
        button:hover { background-color: #2ecc71; }
        #overallResult { margin-top: 30px; padding: 20px; border-radius: 8px; font-size: 1.1em; line-height: 1.6; text-align: center; font-weight: bold; }
        #detailedResults { margin-top: 20px; padding: 15px; border-radius: 8px; background-color: #f9f9f9; border: 1px solid #eee; }
        .milestone-result-item { padding: 8px; margin-bottom: 5px; border-radius: 4px; display: flex; justify-content: space-between; align-items: center; }
        .milestone-result-item.good { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .milestone-result-item.warning { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        .milestone-result-item.danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .disclaimer { font-size: 0.9em; color: #777; text-align: center; margin-top: 40px; padding: 15px; background-color: #f0f0f0; border-radius: 5px; border-left: 5px solid #ffc107; }
        /* Section Perkembangan Anak */
        .growth-section {
            margin-top: 80px;
            text-align: center;
            padding: 20px;
            }
        .growth-section h2 {
            font-size: 26px;
            margin-bottom: 30px;
        }
        .growth-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            justify-content: center;
            padding: 0 30px;
            }
        .growth-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
            padding-left: 20px;
            }
        .growth-card:hover {
            transform: scale(1.05);
        }
        .growth-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
        }
        .growth-card h3 {
            margin: 15px 0;
            font-size: 18px;
            }
        .growth-card p {
            font-size: 14px;
            color: #555;
            }
        li {
            list-style-type: circle;
            text-align: justify;
        }
        ul {
            list-style-type: circle;
            text-align: justify;
            overflow-y: auto;
            padding-left: 40px;
            max-height: 210px;
        }
        a {
            text-decoration: none;
            color: inherit; /* or pick your own color like #000 */
            }
        .sliding-container {
            width: 100%; /* Set width of the sliding container */
            height: 50px; /* Set fixed height */
            overflow: hidden; /* Hides the content that exceeds the container */
            margin: 20px auto; /* Center the container */
            background-color: rgba(76, 175, 80, 0.8);; /* Light background to contrast the sliding text */
            position: relative;
        }
        .dashboard-section {
            height: 600px; /* Tinggi spesifik untuk iframe agar tidak terlalu pendek */
            display: flex;
            flex-direction: column;
        }
        /* Sliding Text Styles */
        .sliding-text {
            font-size: 24px;
            font-weight: bold;
            font-style: italic; /* Make the text italic */
            color: white; /* Set text color to white */
            white-space: nowrap; /* Prevent the text from wrapping */
            position: absolute;
            animation: slide-in 50s ease-out infinite; /* Controls the sliding animation */
            padding: 10px;
        }
        /* Gaya Dropdown */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            /* Perubahan untuk animasi */
            opacity: 0; /* Mulai dari tidak terlihat */
            visibility: hidden; /* Sembunyikan sepenuhnya dari interaksi */
            transform: translateY(10px); /* Geser sedikit ke bawah untuk efek pop-up */
            transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease; /* Transisi yang lebih lambat */
        
            position: absolute;
            background-color: #f9f9f9;
            min-width: 180px; /* Sedikit lebih lebar untuk "+ Tambah Anak" */
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            margin-top: 5px; /* Sedikit spasi dari tombol */
            left: 0; /* Pastikan dropdown muncul di bawah tombol */
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            white-space: nowrap; /* Mencegah teks wrapping */
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Gaya untuk link "+ Tambah Anak" di dalam dropdown */
        .dropdown-content a.add-child-link {
            border-top: 1px solid #eee; /* Garis pemisah */
            color: #007bff; /* Warna biru */
            font-weight: bold;
        }
        .dropdown-content a.add-child-link:hover {
            background-color: #e6f7ff; /* Warna hover yang berbeda */
        }


        .dropdown:hover .dropdown-content {
            /* Ketika di-hover, tampilkan dengan efek animasi */
            opacity: 1; /* Sepenuhnya terlihat */
            visibility: visible; /* Terlihat dan bisa diinteraksi */
            transform: translateY(0); /* Kembali ke posisi asli */
        }

        /* Gaya Tombol Dropdown */
        .dropbtn {
            background-color: #007bff; /* Warna tombol default */
            color: black; /* Warna teks tombol */
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease; /* Transisi untuk hover tombol */
        }

        .dropbtn:hover {
            background-color: #0056b3;
        }

        /* Gaya untuk tombol 'Belum Ada Anak' jika tidak ada data anak */
        /* Ini juga menggunakan gaya dropbtn agar konsisten di navbar */
        .nav-links a button.dropbtn {
            /* Sesuaikan jika perlu ada gaya khusus saat tidak ada anak */
            background-color: #6c757d; /* Contoh: abu-abu */
        }
        .nav-links a button.dropbtn:hover {
            background-color: #5a6268;
        }
        /* Anda mungkin tidak perlu CSS ini jika menggunakan kelas Tailwind dengan benar */
        /* Hanya untuk referensi jika Anda tidak menggunakan Tailwind secara penuh */
        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
        }

        .inset-y-0 {
            top: 0;
            bottom: 0;
        }

        .right-0 {
            right: 0;
        }

        .pr-3 {
            padding-right: 0.75rem; /* 12px */
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .cursor-pointer {
            cursor: pointer;
        }
        .selected-anak-info {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 16px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 12px rgba(4, 100, 55, 0.1);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .selected-anak-info h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 16px;
        }

        .selected-anak-info p {
            margin: 8px 0;
            font-size: 15px;
        }

        .selected-anak-info p strong {
            color: #2d3436;
        }

        .selected-anak-info button {
            margin-top: 15px;
            padding: 10px 16px;
            width: 100%;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .selected-anak-info button:hover {
            background-color: #2980b9;
        }

        .selected-anak-info a {
            text-decoration: none;
        }

        /* Sembunyikan mata tertutup secara default, akan di-toggle oleh JS */
        #togglePassword #eye-closed {
            display: none;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50;
            color: #ecfdf0;
            font-size: 0.9rem;
        }
        .error-message { color: red; font-size: 0.9em; margin-top: 5px; }
        .success-message { color: green; font-size: 0.9em; margin-top: 5px; text-align: center; }
        .links { text-align: center; margin-top: 15px; }
        .links a { color: #007bff; text-decoration: none; }
        .links a:hover { text-decoration: underline; }
        .alert { padding: 12px; margin-bottom: 20px; border-radius: 5px; font-size: 15px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        iframe { flex-grow: 1; border: none; } /* Iframe mengisi ruang yang tersedia */

        @media (max-width: 900px) {
            .form-section, .dashboard-section {
                max-width: 100%; /* Pada layar kecil, tumpuk vertikal */
            }
        }
        @keyframes slide-in {
            0% {
                transform: translateX(100%); /* Start from the right side */
            }
            100% {
                transform: translateX(-100%); /* End at the left side */
            }
            }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">
            <img src="{{('storage/logo/logo_pertumbuhan-removebg-preview.png')}}" alt="" style="width: 50px; height: 50px;">
            <span class="logo-text">TumbuhKu</span>
        </div>
        <div class="nav-links">
            <a href="{{route('dashboard')}}"><button>Home</button></a>
            <a href="https://www.halodoc.com/tanya-dokter/dr-gracia-deswita-natalya-fau-sp-a" target="_blank" rel="noopener noreferrer">
                <button>Konsultasi</button></a>
            <a href="{{route('tentangKami')}}"><button>Tentang Kami</button></a>
            @auth
            {{-- Tombol untuk pengguna yang sudah login --}}
            <a href="{{ route('selfChecking.history') }}"><button>Riwayat Motorik Anak</button></a>

            {{-- Menampilkan NIK dan Nama anak-anak yang terkait --}}
            @if($anaksData->isNotEmpty())
                <div class="dropdown">
                    <button class="dropbtn">Anak Saya</button>
                    <div class="dropdown-content">
                        @foreach($anaksData as $anak)
                            <a href="{{ route('monitoring.pertumbuhan', ['anak_NIK' => $anak->anak_NIK]) }}">
                                {{ $anak->name }} ({{ $anak->anak_NIK }})
                            </a>
                        @endforeach
                        {{-- TOMBOL TAMBAH ANAK BARU DI DALAM DROPDOWN --}}
                        {{-- Mengubahnya menjadi link agar seragam dengan item dropdown lainnya --}}
                        <a href="{{ route('anak.create') }}" class="add-child-link">
                            + Tambah Anak
                        </a>
                    </div>
                </div>
            @else
                {{-- Jika belum ada data anak, tetap tawarkan tombol untuk menambah --}}
                {{-- Ini akan ditampilkan di tempat 'Anak Saya' seharusnya berada --}}
                <a href="{{ route('anak.create') }}"><button class="dropbtn">Tambah Anak Pertama</button></a>
            @endif

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endauth

        @guest
            {{-- Tombol untuk pengguna yang BELUM login --}}
            <a href="/login"><button>Login</button></a>
            <a href="/register"><button>Daftar</button></a>
        @endguest
            </div>
            </div>
            <div class="sliding-container">
                <div class="sliding-text">
                    Bersama Tumbuh, Bersama Bahagia : "Mari Pantau dan dukung setiap fase pertumbuhan anak Anda!"
        </div>
    </div>
    
    {{ $slot }}
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk mendapatkan cookie berdasarkan nama
        // Fungsi untuk mendapatkan cookie berdasarkan nama
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
            return null;
        }

        // Fungsi yang diperbaiki untuk mendapatkan XSRF token dari cookie
        function getSanctumXsrfToken() {
            const xsrfTokenCookie = getCookie('XSRF-TOKEN');
            console.log('DEBUG: Nilai raw cookie XSRF-TOKEN:', xsrfTokenCookie);
        
            if (xsrfTokenCookie) {
                try {
                    // 1. URL-decode nilai cookie
                    const decodedUriComponent = decodeURIComponent(xsrfTokenCookie);
                    console.log('DEBUG: Nilai URL-decoded XSRF-TOKEN:', decodedUriComponent);
                
                    // 2. Parse string JSON menjadi objek
                    const parsedJson = JSON.parse(decodedUriComponent);
                    console.log('DEBUG: Nilai JSON parsed XSRF-TOKEN:', parsedJson);
                
                    // 3. Ambil properti 'value' yang berisi token sebenarnya
                    if (parsedJson && parsedJson.value) {
                        return parsedJson.value;
                    } else {
                        console.error("DEBUG: Properti 'value' tidak ditemukan dalam JSON XSRF-TOKEN.");
                        return null;
                    }
                } catch (e) {
                    console.error("DEBUG: Error saat memproses XSRF-TOKEN cookie (URL decode atau JSON parse):", e);
                    return null;
                }
            }
            console.log('DEBUG: Cookie XSRF-TOKEN tidak ditemukan atau kosong.');
            return null;
        }
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/sanctum/csrf-cookie', {
            method: 'GET',
            credentials: 'include'
        })
        .then(response => {
            if (!response.ok) {
                console.error('Failed to get CSRF cookie:', response.statusText);
                throw new Error('Failed to get CSRF cookie');
            }
            console.log('CSRF cookie successfully obtained.');
        })
        .catch(error => {
            console.error('Error fetching CSRF cookie:', error);
            alert('Aplikasi gagal memuat cookie CSRF. Mohon refresh halaman.');
        });
        
        // Logika untuk mengubah label Tinggi/Panjang (Tidak Berubah)
        const usiaRadios = document.querySelectorAll('input[name="usia"]');
        const tinggiLabel = document.querySelector('label[for="tinggi"]');
        const tinggiInput = document.getElementById('tinggi');
    
        usiaRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === '0') {
                    tinggiLabel.textContent = 'Panjang (Cm)';
                    tinggiInput.name = 'panjang';
                } else if (this.value === '1') {
                    tinggiLabel.textContent = 'Tinggi (Cm)';
                    tinggiInput.name = 'tinggi';
                }
            });
        });
    
        // Atur status awal berdasarkan pilihan default (jika ada) (Tidak Berubah)
        const selectedUsia = document.querySelector('input[name="usia"]:checked');
        if (selectedUsia) {
            if (selectedUsia.value === '0') {
                tinggiLabel.textContent = 'Panjang (Cm)';
                tinggiInput.name = 'panjang';
            } else if (selectedUsia.value === '1') {
                tinggiLabel.textContent = 'Tinggi (Cm)';
                tinggiInput.name = 'tinggi';
            }
        }

        // Logika untuk toggle password (Tidak Berubah)
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');
            
        if (togglePassword && passwordInput && eyeOpen && eyeClosed) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
            
                if (type === 'text') {
                    eyeOpen.style.display = 'none';
                    eyeClosed.style.display = 'inline';
                } else {
                    eyeOpen.style.display = 'inline';
                    eyeClosed.style.display = 'none';
                }
            });
        }
    });

    // 1. Data Tonggak Perkembangan (WHO Percentiles in Months) (SAMA)
    const milestonesData = [
        { id: 'sitting', question: '1. Duduk tanpa dukungan (setidaknya 1 menit)?', p3: 4.1, p50: 5.9, p97: 8.4, displayThresholdMonths: 4.1 },
        { id: 'standing_assistance', question: '2. Berdiri dengan bantuan (berpegangan pada furnitur, dll.)?', p3: 5.2, p50: 7.4, p97: 10.5, displayThresholdMonths: 5.2 },
        { id: 'crawling', question: '3. Merangkak dengan tangan dan lutut (merangkak sejati)?', p3: 5.8, p50: 8.3, p97: 12.0, displayThresholdMonths: 5.8 },
        { id: 'walking_assistance', question: '4. Berjalan dengan bantuan (berpegangan pada tangan orang dewasa/furnitur)?', p3: 6.6, p50: 9.0, p97: 12.4, displayThresholdMonths: 6.6 },
        { id: 'standing_alone', question: '5. Berdiri sendiri (setidaknya beberapa detik)?', p3: 7.7, p50: 10.8, p97: 15.2, displayThresholdMonths: 7.7 },
        { id: 'walking_alone', question: '6. Berjalan sendiri (beberapa langkah tanpa jatuh)?', p3: 9.0, p50: 12.0, p97: 16.0, displayThresholdMonths: 9.0 }
    ];
    const isGuest = @json(Auth::guest());
    if (isGuest) {
        // Tampilkan form input usia manual
        document.getElementById('guestInputBox').style.display = 'block';

        function startGuestSelfCheck() {
            const usia = parseFloat(document.getElementById('manualAge').value);
            if (isNaN(usia) || usia <= 0) {
                alert("Usia tidak valid.");
                return;
            
            }
            
            performSelfCheckForGuest(usia);
        }

        function performSelfCheckForGuest(ageInMonths) {
            const relevantMilestones = milestonesData.filter(m => ageInMonths >= m.displayThresholdMonths);

            if (relevantMilestones.length === 0) {
                document.getElementById('resultContainer').innerHTML = `
                    <div class="result-box warning">Belum ada Tonggak Perkembangan Motorik Kasar untuk usia ${ageInMonths} bulan.</div>
                `;
                return;
            }
            const container = document.getElementById('resultContainer');
            container.innerHTML = `
                <form id="milestoneForm">
                    ${relevantMilestones.map(m => `
                        <div class="milestone-question">
                            <label><strong>${m.question}</strong></label><br>
                            <label><input type="radio" name="${m.id}" value="yes" required> Ya</label>
                            <label><input type="radio" name="${m.id}" value="no"> Tidak</label>
                        </div>
                    `).join('')}
                    <button type="submit">Evaluasi</button>
                </form>
            `;
            console.log(container.innerHTML);
            console.log('menampilkan pertanyaan sesuai usia yang dimasukkan');

            // TUNGGU DOM update, lalu pasang event listener
            setTimeout(() => {
                const form = document.getElementById('milestoneForm');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        evaluateGuestForm(ageInMonths);
                    });
                } else {
                    console.error("Form milestone tidak ditemukan.");
                }
            }, 60);

        }
        function evaluationText(evaluation) {
            if (evaluation === 'good') return 'Sesuai rentang usia normal 👍';
            if (evaluation === 'warning') return 'Masih dalam batas wajar, perlu pantauan 👀';
            return 'Perlu perhatian khusus ⚠️';
        }

        function evaluateGuestForm(ageInMonths) {
            const form = document.getElementById('milestoneForm');
            const results = [];
            
            milestonesData.forEach(m => {
                if (ageInMonths >= m.displayThresholdMonths) {
                    const answer = form[m.id]?.value;
                    if (!answer) {
                        alert(`Silakan isi semua pertanyaan sebelum evaluasi.`);
                        throw new Error("Jawaban belum lengkap.");
                    }
                
                    const achieved = answer === 'yes';
                    let evaluation = '';
                
                    if (achieved && ageInMonths <= m.p97) {
                        evaluation = 'good';
                    } else if (!achieved && ageInMonths > m.p97) {
                        evaluation = 'danger';
                    } else {
                        evaluation = 'warning';
                    }
                
                    results.push({
                        milestoneId: m.id,
                        achieved,
                        evaluation,
                        message: `<b>${m.question}</b>: ${achieved ? 'Sudah' : 'Belum'} tercapai pada usia ${ageInMonths} bulan. <b>${evaluationText(evaluation)}</b>`,
                    });
                }
            });
        
            showSelfCheckResult(results, ageInMonths);
        }


        function showSelfCheckResult(result, usia = null) {
            const container = document.getElementById('resultContainer');
            
            if (!result || result.length === 0) {
                container.innerHTML = `<div class="result-box warning">Belum ada hasil evaluasi yang dapat ditampilkan.</div>`;
                return;
            }
        
            const hasilHtml = `
                <div class="result-box">
                    <h4>Hasil Evaluasi${usia !== null ? ` (Usia: ${usia} bulan)` : ''}</h4>
                    <ul class="milestone-list">
                        ${result.map(r => `
                            <li class="milestone-item ${r.evaluation}">
                                ${r.message}
                            </li>
                        `).join('')}
                    </ul>
                </div>
            `;
        
            container.innerHTML = hasilHtml;
        }
    }else{

        // 2. Fungsi untuk menghasilkan pertanyaan secara dinamis berdasarkan usia (SAMA)
        function generateMilestoneQuestions(childAgeMonths) {
            const milestoneQuestionsDiv = document.getElementById('milestoneQuestions');
            milestoneQuestionsDiv.innerHTML = '';
            if(childAgeMonths < 5){
                const questionItem = document.createElement('div');
                questionItem.className = 'question-item';
                questionItem.innerHTML = `
                    Belum ada Tonggak Perkembangan Motorik Kasar untuk usia ${childAgeMonths} bulan.
                `;
                milestoneQuestionsDiv.appendChild(questionItem);
            }
            milestonesData.forEach(milestone => {
                if (childAgeMonths >= milestone.displayThresholdMonths) {
                    const questionItem = document.createElement('div');
                    questionItem.className = 'question-item';
                    questionItem.innerHTML = `
                        <label for="${milestone.id}">${milestone.question}</label>
                        <div>
                            <input type="radio" id="${milestone.id}_yes" name="${milestone.id}" value="yes" required> Ya
                            <input type="radio" id="${milestone.id}_no" name="${milestone.id}" value="no"> Tidak
                        </div>
                    `;
                    milestoneQuestionsDiv.appendChild(questionItem);
                }
            });
        }
    
        // Fungsi untuk menghitung usia dalam bulan dari tanggal lahir (SAMA)
        function calculateAgeInMonths(dobString) {
            const dob = new Date(dobString);
            const now = new Date();
            let years = now.getFullYear() - dob.getFullYear();
            let months = now.getMonth() - dob.getMonth();
            let days = now.getDate() - dob.getDate();
    
            if (days < 0) {
                months--;
                const prevMonth = new Date(now.getFullYear(), now.getMonth(), 0);
                days = prevMonth.getDate() + days;
            }
    
            if (months < 0) {
                years--;
                months += 12;
            }
            
            const totalMonthsExact = years * 12 + months + (days / 30.4375);
            return parseFloat(totalMonthsExact.toFixed(1));
        }
    
        // Event listener untuk perubahan pilihan anak (MODIFIED)
        document.getElementById('selectedChildId').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const childAgeMonthsInput = document.getElementById('childAgeMonths'); // Input tersembunyi
            const childAgeDisplay = document.getElementById('childAgeDisplay'); // Elemen <small> yang baru diberi ID
    
            if (selectedOption.value) {
                const dob = selectedOption.dataset.dob;
                const ageInMonthsExact = calculateAgeInMonths(dob);
                
                const totalMonths = Math.floor(ageInMonthsExact);
                const fractionalPart = ageInMonthsExact - totalMonths;
                const daysPart = Math.round(fractionalPart * 30.4375);
    
                childAgeMonthsInput.value = ageInMonthsExact; // Tetap set nilai di input tersembunyi
    
                // Perbarui teks keterangan usia di elemen <small>
                let displayString = '';
                if (totalMonths < 1) { // Jika usia kurang dari 1 bulan
                    displayString = `${daysPart} hari`;
                } else if (daysPart === 0) { // Jika tidak ada sisa hari
                    displayString = `${totalMonths} bulan`;
                } else {
                    displayString = `${totalMonths} bulan ${daysPart} hari`;
                }
                childAgeDisplay.textContent = displayString;
                
                generateMilestoneQuestions(ageInMonthsExact);
            } else {
                childAgeMonthsInput.value = ''; // Reset input tersembunyi
                childAgeDisplay.textContent = `(Anak Belum dipilih)`; // Reset teks keterangan
                document.getElementById('milestoneQuestions').innerHTML = 'Belum Ada Tonggak Perkembangan';
            }
        });
    
        // Event Listener Form Submission (SAMA)
        document.getElementById('milestoneChecklist').addEventListener('submit', function(event) {
            event.preventDefault();
            
            const selectedAnakNIK = document.getElementById('selectedChildId').value;
            // Ambil nilai dari input tersembunyi
            const childAgeMonths = parseFloat(document.getElementById('childAgeMonths').value); 
            
            const overallResultDiv = document.getElementById('overallResult');
            const detailedResultsDiv = document.getElementById('detailedResults');
            
            overallResultDiv.className = '';
            detailedResultsDiv.innerHTML = '';
    
            let totalOnTrack = 0;
            let totalWarning = 0;
            let totalDanger = 0;
            let allInputsValid = true;
    
            const detailedResultsHtml = [];
            const resultsToSave = [];
    
            const relevantMilestones = milestonesData.filter(milestone => childAgeMonths >= milestone.displayThresholdMonths);
    
            relevantMilestones.forEach(milestone => {
                const hasAchievedInput = document.querySelector(`input[name="${milestone.id}"]:checked`);
    
                if (isNaN(childAgeMonths) || childAgeMonths < 0 || !hasAchievedInput) {
                    allInputsValid = false;
                    return;
                }
    
                const hasAchieved = hasAchievedInput.value === 'yes';
                let statusClass = '';
                let message = '';
                let currentEvaluation = '';
    
                // --- Logika evaluasi (SAMA) ---
                if (hasAchieved) {
                    if (childAgeMonths < milestone.p3) { message = `<b>${milestone.question.split('.')[1].trim()}</b>: Sudah tercapai pada usia ${childAgeMonths} bulan. <b>Sangat awal!</b> 🎉`; statusClass = 'good'; currentEvaluation = 'good'; }
                    else if (childAgeMonths >= milestone.p3 && childAgeMonths <= milestone.p97) { message = `<b>${milestone.question.split('.')[1].trim()}</b>: Sudah tercapai pada usia ${childAgeMonths} bulan. <b>Sesuai rentang usia normal.</b> 👍`; statusClass = 'good'; currentEvaluation = 'good'; }
                    else { message = `<b>${milestone.question.split('.')[1].trim()}</b>  : Sudah tercapai pada usia ${childAgeMonths} bulan. Sedikit lebih lambat dari mayoritas, namun <b>tetap dalam variasi normal yang luas.</b>`; statusClass = 'warning'; currentEvaluation = 'warning'; }
                } else { // Not achieved
                    if (childAgeMonths < milestone.p3) { message = `<b>${milestone.question.split('.')[1].trim()}</b>: Belum tercapai pada usia ${childAgeMonths} bulan. <b>Masih terlalu dini untuk khawatir.</b>`; statusClass = 'good'; currentEvaluation = 'good'; }
                    else if (childAgeMonths >= milestone.p3 && childAgeMonths < milestone.p50) { message = `<b>${milestone.question.split('.')[1].trim()}</b>: Belum tercapai pada usia ${childAgeMonths} bulan. <b>Perhatian:</b> Beberapa anak sudah mulai mencapai ini. Terus stimulasi dan pantau.`; statusClass = 'warning'; currentEvaluation = 'warning'; }
                    else if (childAgeMonths >= milestone.p50 && childAgeMonths < milestone.p97) { message = `<b>${milestone.question.split('.')[1].trim()}</b>: Belum tercapai pada usia ${childAgeMonths} bulan. <b>Penting:</b> Mayoritas anak sudah mencapai ini. Disarankan konsultasi dengan dokter.`; statusClass = 'danger'; currentEvaluation = 'danger'; }
                    else { message = `<b>${milestone.question.split('.')[1].trim()}</b>: Belum tercapai pada usia ${childAgeMonths} bulan. <b>Sangat Penting:</b> Ini sudah melewati usia di mana hampir semua anak mencapai tonggak ini. <b>SEGERA konsultasi dengan dokter/ahli tumbuh kembang.</b>`; statusClass = 'danger'; currentEvaluation = 'danger'; }
                }
                // --- Akhir logika evaluasi ---
                
                resultsToSave.push({
                    milestoneId: milestone.id,
                    achieved: hasAchieved,
                    evaluation: currentEvaluation,
                    message: message.replace(/\*\*/g, '')
                });
    
                if (currentEvaluation === 'good') { totalOnTrack++; }
                else if (currentEvaluation === 'warning') { totalWarning++; }
                else if (currentEvaluation === 'danger') { totalDanger++; }
                
                detailedResultsHtml.push(`<div class="milestone-result-item ${statusClass}">${message}</div>`);
            });
    
            let overallStatus = 'good';
            if (totalDanger > 0) { overallStatus = 'danger'; }
            else if (totalWarning > 0) { overallStatus = 'warning'; }
    
            if (!selectedAnakNIK || isNaN(childAgeMonths) || childAgeMonths < 0 || !allInputsValid) {
                overallResultDiv.innerHTML = '<p style="color: #d9534f;">Mohon pilih anak, lengkapi usia anak, dan semua jawaban pertanyaan.</p>';
                overallResultDiv.classList.add('result-warning');
                return;
            } else {
                let overallMessage = '';
                if (overallStatus === 'danger') { overallMessage = `🚨 <b>PERHATIAN KHUSUS!<b> Ada ${totalDanger} tonggak perkembangan yang memerlukan evaluasi segera oleh profesional.`; overallResultDiv.classList.add('result-danger'); }
                else if (overallStatus === 'warning') { overallMessage = `⚠️ <b>BEBERAPA PERHATIAN.<b> Ada ${totalWarning} tonggak perkembangan yang mungkin memerlukan observasi lebih lanjut atau konsultasi.`; overallResultDiv.classList.add('result-warning'); }
                else { overallMessage = `🎉 <b>PERKEMBANGAN BAIK!<b> Semua ${totalOnTrack} tonggak perkembangan tampak sesuai usia.`; overallResultDiv.classList.add('result-good'); }
                overallResultDiv.innerHTML = `<p>${overallMessage}</p>`;
                detailedResultsDiv.innerHTML = `<h3 class="section-title">Rincian Perkembangan Anda:</h3>` + detailedResultsHtml.join('');
    
                // --- Bagian PENGIRIMAN DATA MODIFIED untuk Laravel Backend ---
                fetch('/self-checking/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    credentials: 'same-origin', // wajib untuk kirim cookie sesi Laravel
                    body: JSON.stringify({
                        anak_nik: selectedAnakNIK,
                        childAgeMonths: childAgeMonths,
                        results: resultsToSave,
                        overallStatus: overallStatus
                    })
                })
                .then(async response => {
                    const contentType = response.headers.get('content-type');
    
                    // Jika gagal (bukan HTTP 200+)
                    if (!response.ok) {
                        // Coba parse sebagai JSON jika bisa
                        if (contentType && contentType.includes('application/json')) {
                            const errorData = await response.json();
                            throw new Error(errorData.message || 'Gagal menyimpan data');
                        } else {
                            // Kalau bukan JSON (misalnya HTML karena redirect), ambil teksnya
                            const errorText = await response.text();
                            console.error('Respon non-JSON:', errorText); // log HTML error
                            throw new Error('Respon server tidak sesuai. Mungkin redirect atau error server.');
                        }
                    }
                
                    // Kalau berhasil dan JSON
                    return response.json();
                })
                .then(data => {
                    alert('Berhasil disimpan!');
                    console.log(data);
                })
                .catch(error => {
                    console.error('Terjadi error:', error);
                    alert('Terjadi kesalahan saat menyimpan hasil: ' + error.message);
                });
                // --- Akhir Bagian PENGIRIMAN DATA ---
            }
        });
    }

</script>
    <footer>
        &copy; 2025 Monitoring Anak | Dibuat dengan ♥ untuk masa depan generasi sehat
    </footer>
</body>
</html>
