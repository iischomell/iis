<?php
include '../admin/db.php'; // Koneksi ke database

$result = $conn->query("SELECT * FROM penghargaan ORDER BY tahun DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghargaan Kelurahan</title>
    <style>
        /* Global Styles */
        :root {
            --primary: #006ba8;
            --bg: #010101;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 70px;
            background-color: #f3f4f6;
            color: #333;
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
            color: #fff;
            font-style: italic;
            text-decoration: none;
        }

        .navbar-logo span {
            color: var(--primary);
        }

        .navbar-nav {
            display: flex;
            gap: 2rem;
        }

        .navbar-nav a {
            color: #fff;
            font-size: 1.2rem;
            text-decoration: none;
            transition: color 0.3s;
        }

        .navbar-nav a:hover {
            color: var(--primary);
        }
        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: black;
            margin-bottom: 30px;
        }

        /* Penghargaan Cards */
        .penghargaan {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
        }
        .penghargaan:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .penghargaan img {
            max-width: 200px;
            height: auto;
            border-radius: 6px;
            margin-right: 15px;
            object-fit: cover;
        }
        .penghargaan h3 {
            margin: 0;
            font-size: 1.2em;
            color: #007b3d;
        }
        .penghargaan p {
            margin: 10px 0 0;
            font-size: 0.95em;
            color: #555;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .penghargaan {
                flex-direction: column;
                align-items: center;
            }
            .penghargaan img {
                max-width: 100%;
                margin-bottom: 15px;
            }
            .penghargaan h3 {
                text-align: center;
            }
            .penghargaan p {
                text-align: justify;
            }
        }
    </style>
</head>
<body>

<nav class="navbar">
        <a href="index.php#" class="navbar-logo">Kelurahan<span>Pane</span>.</a>
        <div class="navbar-nav">
            <a href="index.php#">Home</a>
            <a href="index.php#about">Tentang</a>
            <a href="index.php#berita">Berita</a>
        </div>
    </nav>

    <div class="container">
        <h1>Penghargaan Kelurahan</h1>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="penghargaan">
                <?php if ($row['foto']): ?>
                    <img src="../img/menu/<?= $row['foto']; ?>" alt="Foto Penghargaan">
                <?php else: ?>
                    <img src="../img/menu/default.png" alt="Foto Default Penghargaan">
                <?php endif; ?>
                <div>
                    <h3><?= $row['nama_penghargaan']; ?> (<?= $row['tahun']; ?>)</h3>
                    <p><?= nl2br($row['deskripsi']); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>