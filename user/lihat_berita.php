<?php
include '../admin/db.php'; // Connect to the database

// Get the berita ID from the URL
$berita_id = isset($_GET['berita_id']) ? intval($_GET['berita_id']) : 0;

// Fetch the berita details based on the ID
$query = "SELECT * FROM berita WHERE id = $berita_id";
$result = mysqli_query($conn, $query);
$berita = mysqli_fetch_assoc($result);

if (!$berita) {
    echo "Berita tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - <?php echo htmlspecialchars($berita['name']); ?></title>
    <link rel="stylesheet" href="../css/index.css">
    <style>
        .detail-section { width: 80%; margin: 20px auto; text-align: center; }
        .detail-section img { max-width: 100%; border-radius: 8px; }
        .detail-content { text-align: left; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .detail-title { font-size: 1.8em; color: #333; margin-bottom: 10px; }
        .detail-date { color: #666; font-size: 0.9em; margin-bottom: 15px; }
        .detail-description { color: #444; line-height: 1.6; }
        .back-link { display: inline-block; margin-top: 20px; color: #006ba8; text-decoration: none; font-weight: bold; }
        .back-link:hover { color: #004e76; }

        body {
    font-family: 'Poppins', sans-serif;
    background-color: #333;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}


.detail-section {
    width: 90%;
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.detail-section img {
    max-width: 100%;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
}

.detail-section img:hover {
    transform: scale(1.05);
}

.detail-title {
    font-size: 2rem;
    color: #333333;
    margin: 10px 0;
    font-weight: 700;
}

.detail-date {
    color: #888888;
    font-size: 0.95rem;
    margin-bottom: 20px;
}

.detail-content {
    text-align: left;
    padding: 20px;
    background-color: #fafafa;
    border-radius: 8px;
    line-height: 1.7;
    color: #555555;
}

.detail-description {
    font-size: 1rem;
    color: #444444;
}

.back-link {
    display: inline-block;
    margin-top: 30px;
    padding: 10px 20px;
    background-color: #92c9e9;
    color: #ffffff;
    border-radius: 5px;
    font-weight: bold;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.back-link:hover {
    background-color:rgb(26, 170, 247);
    color: #f0f0f0;
    transform: scale(1.05);
}

    </style>
</head>
<body>

<div class="detail-section">
    <h1 class="detail-title"><?php echo htmlspecialchars($berita['name']); ?></h1>
    <p class="detail-date">Tanggal: <?php echo date("d-m-Y", strtotime($berita['tanggal'])); ?></p>
    <img src="../img/menu/<?php echo htmlspecialchars($berita['image']); ?>" alt="<?php echo htmlspecialchars($berita['name']); ?>">
    <div class="detail-content">
        <p class="detail-description"><?php echo nl2br(htmlspecialchars($berita['description'])); ?></p>
    </div>
    <a href="index.php#berita" class="back-link">Kembali ke Berita Terkini</a>
</div>

</body>
</html>
