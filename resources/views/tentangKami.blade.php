<x-layout title="Tentang Kami">
    <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #ffffff;
      color: #333;
    }

    .container {
      max-width: 1000px;
      margin: 30px auto;
      padding: 0 20px;
    }

    .about-card {
      background-color: #f7fdf8;
      padding: 20px;
      border-radius: 16px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 20px;
    }

    .about-card img {
      width: 120px;
      height: 120px;
      object-fit: contain;
    }

    .about-text {
      flex: 1;
      min-width: 250px;
    }

    .about-text h2 {
      color: #27ae60;
      margin-bottom: 10px;
    }

    .about-text p {
      font-size: 1rem;
      line-height: 1.6;
    }

    @media (max-width: 600px) {
      .about-card {
        flex-direction: column;
        text-align: center;
      }

      .about-text h2 {
        font-size: 1.3rem;
      }

      .about-card img {
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="about-card">
      <!-- Ganti src dengan path logo kamu -->
      <img src="{{('storage/logo/logo_tumbuhku-removebg-preview.png')}}" alt="Logo Monitoring Anak" />
      <div class="about-text">
        <h2>Monitoring Pertumbuhan Anak</h2>
        <p>
          Kami adalah tim yang berdedikasi untuk menciptakan solusi digital guna membantu orang tua dan tenaga kesehatan memantau pertumbuhan anak usia 0–5 tahun. Dengan sistem ini, kami berharap dapat mendorong deteksi dini dan intervensi cepat terhadap masalah tumbuh kembang anak.
        </p>
      </div>
    </div>
  </div>
</x-layout>