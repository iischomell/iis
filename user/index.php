<?php
include '../admin/db.php'; // Koneksi ke database

// Initialize the query to select from berita table
$query = "SELECT * FROM berita";

// Check if a search term is provided
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query .= " WHERE name LIKE '%$search%'";
}

// Add ORDER BY and LIMIT clauses
$query .= " ORDER BY tanggal DESC LIMIT 8";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelurahan Pane</title>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />
    
    <!-- feather icons-->
    <script src="https://unpkg.com/feather-icons"></script>
    
    <!-- style css -->
    <link rel="stylesheet" href="../css/index.css" />
</head>
<style>
.navbar-logo {
    font-size: 1.8rem;
    font-weight: bold;
}
.logo-image {
    height: 30px; /* Sesuaikan ukuran logo */
    margin-right: 8px; /* Jarak antara logo dan teks */
    vertical-align: middle; /* Agar sejajar dengan teks */
}

body {
  background-color: white; /* Ubah latar belakang halaman menjadi putih */
  color: black; /* Pastikan teks tetap terlihat dengan warna hitam */
  margin: 0; /* Hilangkan margin default pada body */
  padding: 0; /* Hilangkan padding default pada body */
  font-family: Arial, sans-serif; /* Pilih font yang nyaman dibaca */
}
.hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  background-image: url("../img/bgg.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  position: relative;
  opacity: 1;
}
.features {
  text-align: center;
  padding: 50px 20px;
  background-color: #f9f9f9;
}

.features h2 {
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

.features h2 span {
  color: #2980b9; /* Warna biru untuk highlight */
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
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.feature-item img {
  width: 80px;
  height: 80px;
  margin-bottom: 10px;
}

.feature-item p {
  font-size: 16px;
  color: #333;
  margin: 0;
}

.feature-item a {
  text-decoration: none;
  color: inherit;
}


.news-container {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    justify-content: center;
    align-items: stretch;
    padding: 1.5rem 0;
    max-width: 1200px;
    margin: 0 auto;
}

.news-card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 300px;
    display: flex;
    flex-direction: column;
    position: relative;
    margin-bottom: 1rem;
    padding-bottom: 3.5rem; /* Added padding to make space for date and link */
}

.news-card p {
    color: black;
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
    height: 100%;
}

.news-card-title {
    font-size: 1.2rem;
    margin-bottom: 10px;
}

.news-card-date {
    font-size: 0.9rem;
    color: #666;
    position: absolute;
    bottom: 3rem;
    left: 1rem;
    margin: 0;
}

.news-card-link {
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.news-card-link:hover {
    text-decoration: underline;
}

/* Button styles remain the same */
.button-container {
    text-align: center;
    margin-top: 1rem;
}

.read-more-btn {
    display: inline-block;
    padding: 0.3rem 0.8rem;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.8rem;
    transition: background-color 0.3s;
}

.read-more-btn:hover {
    background-color: #0056b3;
}
  </style>
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
        <a href="../admin/login-admin.php">admin</a>
    </div>
</nav>
    <!-- Navbar End -->

    <!-- Hero Section Start -->
    <section class="hero" id="home">
        <main class="content">
            <h1>Selamat Datang Di Website Kelurahan <span>Pane</span></h1>
            <h3>Anda bisa melihat beberapa informasi kelurahan yang kami sediakan pada website ini</h3>
            <a href="detail.php" class="cta">Berita Terkini</a>
        </main>
    </section>
    <!-- Hero Section End -->

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
    
    <!-- Berita Section Start -->
    <section id="berita" class="menu">
    <h2><span>Berita</span> Terkini</h2>
    <p>Berikut adalah berita-berita terbaru seputar Kelurahan Pane:</p>

    <div class="news-container">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="news-card">
            <img src="../img/menu/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="news-card-img">
            <div class="news-card-content">
                <h3 class="news-card-title"><?php echo htmlspecialchars($row['name']); ?></h3>
                <p class="news-card-date">Tanggal: <?php echo date("d-m-Y", strtotime($row['tanggal'])); ?></p>
                </p>
                <a href="lihat_berita.php?berita_id=<?php echo $row['id']; ?>" class="news-card-link">Lihat Berita</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <div class="button-container">
    <a href="detail.php" class="read-more-btn">Berita Terkini</a>
</div>

</section>


    <!-- Berita Section End -->

    <!-- Features Section Start -->
    <section id="features" class="features">
        <h2><span>Informasi</span> Lanjutan</h2>
        <div class="feature-grid">
            <div class="feature-item">
                <a href="info_penduduk.php"><img src="../img/diagram.jpeg" alt="Data Wilayah" /></a>
                <p>Informasi Penduduk</p>
            </div>
            <div class="feature-item">
                <a href="struktur.php"><img src="../img/kerja.jpg" alt="Golongan Darah" /></a>
                <p>Struktur Organisasi</p>
            </div>
            <div class="feature-item">
                <a href="peta.php"><img src="../img/map.jpeg" alt="Pembangunan" /></a>
                <p>Peta</p>
            </div>
            <div class="feature-item">
                <a href="penghargaan.php"><img src="../img/penghargaan.jpeg" alt="Pembangunan" /></a>
                <p>Penghargaan</p>
            </div>
        </div>
    </section>
    <!-- Features Section End -->

    <!-- Footer Start -->
    <footer>
        <div class="socials">
            <a href="https://www.instagram.com/"><i data-feather="instagram"></i></a>
            <a href="https://www.facebook.com/share/15YDm5YEix/?mibextid=wwXIfr"><i data-feather="facebook"></i></a>
            <a href="https://wa.me/qr/MOLWMNOP7DXZM1"><i data-feather="phone"></i></a>
        </div>
        <div class="credit">
            <p>Created By <a href="#">Iis Muzdalifah</a> | &copy; 2024</p>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

    <!-- Custom JavaScript -->
    <script src="js/script.js"></script>
</body>
</html>