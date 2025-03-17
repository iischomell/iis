<?php
include '../admin/db.php'; // Connect to database

// Initialize the query for fetching news items
$query = "SELECT * FROM berita";

// Check if a search term is provided and escape it to prevent SQL injection
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query .= " WHERE title LIKE '%$search%'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESA PANE - Berita</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;700&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- CSS Styles -->
    <link rel="stylesheet" href="../css/detail.css">
    <style>
        /* Custom styles */
        :root {
            --primary:#92c9e9;
            --bg: #010101;
        }

        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg);
            color: #fff;
            padding: 90px;
        }

        .logo-image {
            height: 30px; /* Sesuaikan ukuran logo */
            margin-right: 8px; /* Jarak antara logo dan teks */
            vertical-align: middle; /* Agar sejajar dengan teks */
        }

        .news-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: center;
            align-items: stretch;
            padding: 1.5rem 0;
        }

        .news-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s;
        }

        .news-card p {
            color: black;
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
            justify-content: space-between;
        }

        .news-card-title {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .news-card-date {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.75rem;
        }

        .news-card-link {
            color: #92c9e9;
            text-decoration: none;
            font-weight: bold;
        }

        .news-card-link:hover {
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

    <!-- News Section -->
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
                    <a href="lihat_berita.php?berita_id=<?php echo $row['id']; ?>" class="news-card-link">Lihat Berita</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="socials">
            <a href="https://www.instagram.com/kyy2ez/?hl=en"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
            <a href="https://wa.me/qr/MOLWMNOP7DXZM1"><i data-feather="phone"></i></a>
        </div>

        <div class="credit">
            <p>Created By <a href="#">Iis muzdalifah</a>. | &copy; 2024</p>
        </div>
    </footer>

    <!-- Feather Icons Script -->
    <script>
        feather.replace();
    </script>
</body>
</html>
