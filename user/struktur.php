<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur Organisasi</title>
    <style>
        /* Reset default margin dan padding */
body, h1, h2, h3, p {
    margin: 0;
    padding: 0;
}

/* Gaya untuk body */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f6f9; /* Warna latar belakang yang lebih lembut */
    color: #333;
    line-height: 1.6;
    padding: 0;
}

/* Gaya untuk navbar */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.4rem 7%;
    background-color:rgb(21, 22, 23); /* Warna navbar lebih elegan */
    border-bottom: 1px solid #513c28;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 9999;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan untuk navbar */
}

.navbar-logo {
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    font-style: italic;
    text-decoration: none;
}

.navbar-logo span {
    color: #92c9e9;
}

.navbar-nav {
    display: flex;
    gap: 2rem;
}

.navbar-nav a {
    color: #fff;
    font-size: 1.1rem;
    text-decoration: none;
    transition: color 0.3s;
}

.navbar-nav a:hover {
    color: #92c9e9;
}

/* Gaya untuk container utama */
.container {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1); /* Bayangan lebih kuat untuk kesan elegan */
    border-radius: 15px; /* Sudut melengkung untuk elemen */
    margin-top: 100px; /* Agar konten tidak tertutup navbar */
}

/* Gaya untuk header */
.header {
    text-align: center;
    margin-bottom: 40px;
}

/* Gaya untuk judul */
h1 {
    font-size: 2.5rem;
    color: #2c3e50;
    margin-bottom: 20px;
    font-weight: 700;
}

/* Gaya untuk subjudul */
h2 {
    font-size: 1.8rem;
    color: #2c3e50;
    margin-top: 40px;
    margin-bottom: 15px;
    font-weight: 600;
}

/* Gaya untuk paragraf */
p {
    font-size: 1rem;
    line-height: 1.8;
    margin-bottom: 20px;
    color: #555;
}

/* Gaya untuk gambar */
img {
    width: 100%; /* Mengatur gambar untuk mengisi lebar kontainer */
    height: auto; /* Mempertahankan rasio aspek asli */
    display: block;
    margin: 20px 0;
    border: 3px solid #2c3e50;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}


/* Gaya untuk footer */
.footer {
    text-align: center;
    margin-top: 40px;
    font-size: 14px;
    color: #777;
    padding-top: 20px;
    border-top: 1px solid #ddd;
}

.footer a {
    color: #2c3e50;
    text-decoration: none;
    font-weight: 600;
}

.footer a:hover {
    text-decoration: underline;
}

/* Responsivitas untuk tampilan mobile */
@media (max-width: 768px) {
    .navbar {
        padding: 1rem 5%;
    }
    .container {
        padding: 20px;
        margin-top: 120px;
    }
    h1 {
        font-size: 2rem;
    }
    h2 {
        font-size: 1.5rem;
    }
}
    </style>
</head>
<body>
<nav class="navbar">
    <a href="#home" class="navbar-logo">Kelurahan<span>Pane</span></a>
    <div class="navbar-nav">
        <a href="#home">Home</a>
        <a href="#about">Tentang</a>
        <a href="#berita">Berita</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>

    <div class="container">
        <div class="header">
            <h1>Struktur Organisasi Kelurahan Pane</h1>
        </div>

        <p>ORGANISASI PEMERINTAHAN KELURAHAN PANE</p>
        <img src="../img/strukturlurah.jpg" alt="struktur organisasi">
        
        <h2>Struktur Organisasi Pemerintahan</h2>
        <p>Berikut adalah struktur organisasi pemerintahan Kelurahan Pane:</p>
        <img src="../img/strukturrt.jpg" alt="struktur organisasi pemerintahan">
    </div>
    <div class="footer">
        <p>Created By <a href="#">iis muzdalifah</a> | &copy; 2024</p>
    </div>
</body>
</html>
