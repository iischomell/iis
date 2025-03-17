<?php
include 'db.php'; // Koneksi ke database

// Initialize the query to select from berita table with limit and order
$query = "SELECT * FROM berita ORDER BY id DESC LIMIT 8";

// Check if a search term is provided
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query = "SELECT * FROM berita WHERE name LIKE '%$search%' ORDER BY id DESC LIMIT 8";
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM berita WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil dihapus',
                timer: 1500,
                showConfirmButton: false
            }).then(function() {
                window.location = 'index-admin.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan: " . $conn->error . "'
            });
        </script>";
    }
}

setlocale(LC_TIME, 'id_ID');
if (PHP_OS == 'WINNT') {
    setlocale(LC_TIME, 'Indonesian');
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelurahan Pane</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />
    
    
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/index.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(21, 22, 23);
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color:#2c3e50;
            padding: 1rem 2rem;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-logo {
            font-size: 1.8rem;
            font-weight: bold;
        }
        .logo-image {
            height: 30px; /* Sesuaikan ukuran logo */
            margin-right: 8px; /* Jarak antara logo dan teks */
            vertical-align: middle; /* Agar sejajar dengan teks */
        }

        .navbar-nav a {
            text-decoration: none;
            color: white;
            margin-left: 1.5rem;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav a:hover {
            color: #f1c40f;
        }

        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-image: url("../img/bgg.jpg");
            background-size: cover;
            background-position: center;
            text-align: center;
            color: white;
            padding: 0 1rem;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
        }

        .hero h3 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .cta {
            padding: 0.8rem 2rem;
            background-color:  #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .cta:hover {
            background-color: #2980b9;
        }

        .section-title {
            font-size: 2rem;
            text-align: center;
            margin: 2rem 0;
            color: #333;
        }

        .features, .about, .menu {
            padding: 3rem 1rem;
            background-color: white;
        }
        .about {
            color: black;
            text-align: center;
        }
        ul {
            list-style: none; /* Hilangkan bullet pada daftar */
            padding: 0; /* Hilangkan padding default */
            margin: 0 auto; /* Rata tengah elemen ul */
            text-align: center; /* Rata tengah teks dalam daftar */
        }

        ul li {
            margin-bottom: 10px; /* Tambahkan jarak antar item */
        }

.feature-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 20px;
  justify-items: center;
  max-width: 1200px;
  margin: 0 auto;
}

.feature-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  width: 100%;
  max-width: 180px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  text-align: center;
}

        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .feature-item img {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
        }
        .features .feature-item p {
            color: black;
        }
        .section-title span {
            color: black; /* Warna teks span menjadi hitam */
        }

        .news-container {
    display: flex;
    gap: 2rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.news-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 300px));
    gap: 1.5rem;
    justify-content: center;
    padding: 1.5rem 0;
}
.news-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    transition: transform 0.3s;
    height: 400px; /* Fixed height */
    
}

.news-card:hover {
    transform: translateY(-5px);
}

.news-card-img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.news-card-content {
    padding: 1rem;
    display: flex;
    flex-direction: column;
    flex: 1;
    position: relative;
}

.news-card-title {
    font-size: 1.2rem;
    color: white;
    margin-bottom: 0.5rem;
    /* Add ellipsis for long titles */
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
.news-card .delete-btn {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    background-color: #007bff;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s;
}
.news-card .delete-btn:hover {
    background-color: #007bff;
}

.news-card-date {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.75rem;
}

.news-card-description {
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 1rem;
}

.news-card-link {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.news-card-link:hover {
    text-decoration: underline;
}
        .about-img {
            display: flex;
            justify-content: center; /* Menyusun gambar secara horizontal di tengah */
            align-items: center;     /* Menyusun gambar secara vertikal di tengah */
            height: 100%;            /* Membuat kontainer mengambil seluruh tinggi */
        }


        .menu .section-title span {
            color: #2980b9; /* Warna teks dalam span */
        }
        .menu .section-title {
            color: black; /* Mengubah warna font "Berita" menjadi hitam */
        }
        

        .menu p {
            color: black; /* Warna teks dalam paragraf */
        }

        .news-card {
            background-color: #1c1c1c; /* Latar belakang abu-abu gelap untuk kartu */
            border-radius: 8px; /* Membuat sudut kartu melengkung */
            overflow: hidden; /* Memastikan elemen dalam kartu tidak keluar */
            width: 300px; /* Lebar kartu berita */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Bayangan halus pada kartu */
            transition: transform 0.3s; /* Animasi untuk hover */
        }

        .news-card:hover {
            transform: scale(1.05); /* Efek zoom saat hover */
        }

        .news-card img {
            width: 100%; /* Gambar memenuhi lebar kartu */
            height: 200px; /* Tinggi gambar */
            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
        }

        .news-card-content {
            padding: 15px; /* Padding dalam konten kartu */
            text-align: left; /* Teks rata kiri */
        }

        .news-card-title {
            font-size: 1.2rem; /* Ukuran font untuk judul berita */
            margin-bottom: 10px; /* Jarak bawah judul */
        }

        .news-card-date {
            font-size: 0.9rem; /* Ukuran font untuk tanggal */
            color: white; /* Warna abu-abu terang untuk tanggal */
            margin-bottom: 15px; /* Jarak bawah tanggal */
        }

        .news-card-link {
            display: inline-block; /* Membuat link seperti tombol */
            padding: 10px 20px; /* Padding untuk tombol */
            background-color: #2980b9; /* Warna tombol biru */
            color: #000; /* Warna teks hitam */
            text-decoration: none; /* Hilangkan garis bawah */
            border-radius: 4px; /* Sudut tombol melengkung */
            font-weight: bold; /* Teks tebal */
        }

        .news-card-link:hover {
            background-color:rgb(148, 209, 249); /* Warna tombol saat hover */
        }
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 1.5rem 0;
            text-align: center;
            font-size: 0.9rem;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        footer a {
            color: white;
            text-decoration: underline;
        }

        .button-container {
            text-align: center;
            margin-top: 2rem;
        }

        .read-more-btn {
            padding: 1rem 2rem;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .read-more-btn:hover {
            background-color:  #2980b9;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            padding: 1.5rem 0;
            text-align: center;
            font-size: 0.9rem;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        footer a {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
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


    <!-- Hero Section -->
    <section class="hero" id="home">
        <h1>Selamat Datang di Website Kelurahan <span>Pane</span></h1>
        <h3>Informasi kelurahan yang lengkap dan transparan ada di sini</h3>
        <a href="edit_berita.php" class="cta">Tambah Berita</a>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <h2 class="section-title"><span>Tentang</span> Pane</h2>
        <div class="row">
            <div class="about-img">
                <img src="../img/strukturlurah.jpg" alt="Tentang Kami" />
                </div>
            <div class="content">
                <h3>Visi</h3>
                <p>"Terwujudnya Efisiensi, Efektifitas, Konsistensi, Kecepatan, Ketepatan, Transparansi Serta Akuntabilitas Penyelenggaraan Pelayanan Pemerintah Kelurahan Untuk Terciptanya Masyarakat Yang Sejahtera Dan Mandiri"</p>

                <h3>Misi</h3>
                <ul>
                    <li>Meningkatkan taraf pendidikan dan kesehatan masyarakat.</li>
                    <li>Meningkatnya pemahaman masyarakat akan nilai-nilai agama, keimanan dan ketakwaan masyarakat serta ketahanan sosial budaya.</li>
                </ul>
            </div>
        </div>
    </section>

    <section id="berita" class="menu">
        <h2 class="section-title">Berita <span>Terkini</span></h2>
        <p>Berikut adalah berita-berita terbaru seputar Kelurahan Pane:</p>

<div class="news-container">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
    <div class="news-card">
        <img src="../img/menu/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="news-card-img">
        <div class="news-card-content">
            <h3 class="news-card-title"><?php echo htmlspecialchars($row['name']); ?></h3>
            <p class="news-card-date">Tanggal: <?php echo date("d-m-Y", strtotime($row['tanggal'])); ?></p>
            <a href="index-admin.php?delete_id=<?php echo $row['id']; ?>" 
               onclick="return confirmDelete(this.href)" 
               class="delete-btn">Hapus</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>

        <div class="button-container">
            <a href="edit_berita.php" class="read-more-btn">Tambahkan Berita</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <h2 class="section-title"><span>Informasi</span> Lanjutan</h2>
        <div class="feature-grid">
            <div class="feature-item">
                <a href="admin_info_penduduk.php"><img src="../img/diagram.jpeg" alt="Data Wilayah" /></a>
                <p>Informasi Penduduk</p>
            </div>
            <div class="feature-item">
                <a href="#"><img src="../img/kerja.jpg" alt="Golongan Darah" /></a>
                <p>Struktur Organisasi</p>
            </div>
            <div class="feature-item">
                <a href="#"><img src="../img/map.jpeg" alt="Pembangunan" /></a>
                <p>Peta</p>
            </div>
            <div class="feature-item">
                <a href="penghargaan-admin.php"><img src="../img/penghargaan.jpeg" alt="Penghargaan" /></a>
                <p>Penghargaan</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="socials">
            <a href="https://www.instagram.com/kyy2ez/?hl=en"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
            <a href="https://wa.me/qr/MOLWMNOP7DXZM1"><i data-feather="phone"></i></a>
        </div>
        <p>Created By <a href="#">Iis Muzdalifah</a> | &copy; 2024</p>
    </footer>

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

    <!-- fungsi sweet alert -->
<script>
    function confirmDelete(deleteUrl) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = deleteUrl;
        }
    });
    return false;
}
</script>
</body>
</html>