<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelurahan Pane</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #92c9e9;
            --bg: #fff;  
            --text-color: #333;  
            --secondary-bg: #f4f4f4; 
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg);
            color: var(--text-color);
            line-height: 1.6;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.4rem 7%;
            background-color: rgba(1, 1, 1, 0.8);
            border-bottom: 1px solid #513c28;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
        }

        .navbar-logo {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-color);
            font-style: italic;
            text-decoration: none;
        }

        .kelurahan {
            color: white; /* Warna putih untuk "Kelurahan" */
        }

        .logo-image {
            height: 30px; /* Sesuaikan ukuran logo */
            margin-right: 8px; /* Jarak antara logo dan teks */
            vertical-align: middle; /* Agar sejajar dengan teks */
        }

        .navbar-logo span {
            color: var(--primary);
        }

        .navbar-nav {
            display: flex;
            gap: 2rem;
        }

        .navbar-nav a {
            color: var(--text-color);
            font-size: 1.2rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .navbar-nav a:hover {
            color: var(--primary);
        }

        #about {
            padding: 10rem 7% 3rem; /* Padding tambahan untuk memberi ruang setelah navbar */
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .about-img {
            flex: 1 1 45%;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .about-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .content {
            flex: 1 1 45%;
            padding: 2rem;
            background-color: var(--secondary-bg);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            font-size: 2.6rem;
            text-align: center;
            color: var(--primary);
            margin-bottom: 2rem;
        }

        .content h3 {
            color: var(--primary);
            font-size: 1.8rem;
            margin-top: 1rem;
        }

        .content p {
            font-size: 1.4rem;
            line-height: 1.6;
            margin-top: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            #about {
                padding: 8rem 5% 3rem;
            }

            .about-img, .content {
                flex: 1 1 100%;
            }

            .navbar-logo {
                font-size: 1.6rem;
            }

            .navbar-nav a {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="#" class="navbar-logo">
        <img src="../img/lambang1.png" alt="Logo" class="logo-image">
        Kelurahan<span>Pane</span>
    </a>
    <div class="navbar-nav">
        <a href="#">Home</a>
        <a href="#about">Tentang</a>
        <a href="#berita">Berita</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

    <section id="about" class="about">
        <div class="about-img">
            <img src="../img/iwan.jpg" alt="Struktur Organisasi Kelurahan Pane">
        </div>
        <div class="content">
            <h2><span>Data Monografi</span> Kelurahan</h2>
            <p>1. Kelurahan: Pane</p>
            <p>2. Nomor kode: 52.72.01.1013</p>
            <p>3. Tingkat Perkembangan: Cepat Berkembang</p>
            <p>4. Kecamatan: Rasanae Barat</p>
            <p>5. Kota: Bima</p>
            <p>6. Luas: 0,31 KM<sup>2</sup></p>
            <h3>Batas Wilayah</h3>
            <p>Sebelah Barat: Kelurahan Sambinae</p>
            <p>Sebelah Timur: Kelurahan Rontu</p>
            <p>Sebelah Utara: Kelurahan Mande</p>
            <p>Sebelah Selatan: Desa Teke Kab. Bima</p>
        </div>
    </section>

</body>
</html>
