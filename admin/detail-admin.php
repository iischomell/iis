<?php
include 'db.php'; // Koneksi ke database

// Initialize the query
$query = "SELECT * FROM products";

// Check if a search term is provided
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $query .= " WHERE name LIKE '%$search%'";
}

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
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- feather icons-->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- style css -->
    <link rel="stylesheet" href="css/detail.css" />
  </head>
  <body>
    <!-- navbar start -->
    <nav class="navbar">
      <a href="index-admin.php" class="navbar-logo">Kelurahan<span>Pane</span>.</a>
      <div class="navbar-nav">
        <a href="index-admin.php">Home</a>
        <a href="index-admin.php#about">Tentang</a>
        <a href="index-admin.php#berita">Berita</a>
      </div>

      <div class="navbar-extra">
        <!-- Search bar added here -->
        <form method="GET" action="" class="search-form">
                <input type="text" name="search" placeholder="Cari produk..." class="search-input" required />
                <button type="submit" id="search-btn"><i data-feather="search"></i></button>
            </form>
        <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
      </div>
    </nav>
    <!-- navbar end -->

<!-- menu section start -->
<section id="menu" class="menu">
    <h2><span>Berita</span> Terkini</h2>
    <p>Berikut adalah berita-berita seputar kelurahan:</p>

    <div class="row" id="productRow">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="menu-card">
            <img src="img/menu/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="menu-card-img">
            <h3 class="menu-card-title"><?php echo htmlspecialchars($row['name']); ?></h3>
            <p class="menu-card-date">Tanggal: <?php echo date("d-m-Y", strtotime($row['tanggal'])); ?></p>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
            <a href="edit_berita.php?berita_id=<?php echo $row['id']; ?>" class="cta">Edit Berita</a>
        </div>
        <?php endwhile; ?>
    </div>
</section>
    <!-- menu section end -->


    <!-- footer start -->
    <footer>
      <div class="socials">
        <a href="https://www.instagram.com/kyy2ez/?hl=en"
          ><i data-feather="instagram"></i
        ></a>
        <a href="#"><i data-feather="facebook"></i></a>
        <a href="https://wa.me/qr/MOLWMNOP7DXZM1"
          ><i data-feather="phone"></i
        ></a>
      </div>

      <div class="credit">
        <p>Created By <a href="">Iis muzdalifah</a>. | &copy; 2024</p>
      </div>
    </footer>
    <!-- footer end -->

    <!-- feather icons-->
    <script>
      feather.replace();
    </script>
  </body>
</html>
