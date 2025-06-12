<!-- <div>
    Smile, breathe, and go slowly. - Thich Nhat Hanh
</div> -->
    <!DOCTYPE html>
    <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                font-size: 22px;
                font-weight: bold;
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
                list-style-type: none;
                text-align: center;
                }
                ul {
                    text-align: center;
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
        <div class="logo">TumbuhKu</div>
        <div class="nav-links">
            <a href="/dashboard"><button>Home</button></a>
            <a href="/userChart/C001"><button>Monitoring</button></a>
            <button>Konsultasi</button>
            <button>Tentang Kami</button>
            <a href="/login"><button>Login</button></a>
            <a href="/register"><button>Daftar</button></a>
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
</body>
</html>
