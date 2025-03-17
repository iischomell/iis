<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login-admin.php');
    exit();
}
include 'db.php';

if (isset($_POST['submit'])) {
    // Sanitasi dan validasi input
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    
    // Penanganan upload file dengan pemeriksaan keamanan
    $tipe_diizinkan = ['image/jpeg', 'image/png', 'image/gif'];
    $ukuran_maksimal = 5 * 1024 * 1024; // 5MB
    $error_upload = false;
    $nama_file_gambar = '';
    
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $tipe_mime = finfo_file($file_info, $_FILES['gambar']['tmp_name']);
        finfo_close($file_info);
        
        if (!in_array($tipe_mime, $tipe_diizinkan)) {
            echo "<script>alert('Tipe file tidak valid. Hanya JPG, PNG dan GIF yang diperbolehkan.');</script>";
            $error_upload = true;
        } elseif ($_FILES['gambar']['size'] > $ukuran_maksimal) {
            echo "<script>alert('Ukuran file terlalu besar. Maksimal 5MB.');</script>";
            $error_upload = true;
        } else {
            // Membuat nama file yang aman
            $ekstensi = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
            $nama_file_gambar = uniqid() . '_' . time() . '.' . $ekstensi;
            $target = "../img/menu/" . $nama_file_gambar;
            
            // Memastikan direktori upload ada dan bisa ditulis
            if (!is_dir("../img/menu/")) {
                mkdir("../img/menu/", 0755, true);
            }
        }
    } else {
        echo "<script>alert('Silakan pilih file gambar.');</script>";
        $error_upload = true;
    }
    
    if (!$error_upload) {
        // Menggunakan prepared statement untuk mencegah SQL injection
        $stmt = $conn->prepare("INSERT INTO berita (name, tanggal, description, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul, $tanggal, $deskripsi, $nama_file_gambar);
        
        if ($stmt->execute()) {
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
                echo "<script>
                    alert('Berita berhasil ditambahkan');
                    window.location.href = 'index-admin.php';
                    </script>";
            } else {
                // Jika upload file gagal, hapus record database
                $id_terakhir = $conn->insert_id;
                $conn->query("DELETE FROM berita WHERE id = " . $id_terakhir);
                echo "<script>alert('Gagal mengupload gambar');</script>";
            }
        } else {
            echo "<script>alert('Gagal menambahkan berita: " . htmlspecialchars($stmt->error) . "');</script>";
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Berita</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        :root {
            --primary:#92c9e9;
            --bg: #010101;
        }

        .navbar {
            background-color: var(--bg);
            padding: 20px;
            text-align: center;
            color: white;
        }

        .navbar a {
            font-size: 24px;
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }

        .navbar-logo span {
            font-weight: bold;
            color: var(--primary);
        }

        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="file"] {
            margin: 10px 0;
        }

        button {
            background-color: var(--primary);
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Start -->
    <div class="navbar">
        <a href="index-admin.php" class="navbar-logo">Dashboard<span>Admin</span>.</a>
    </div>
    <!-- Navbar End -->

    <h2>Selamat Datang, Admin</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="judul" placeholder="Judul Berita" required maxlength="255">
        <input type="date" name="tanggal" required>
        <textarea name="deskripsi" placeholder="Deskripsi Berita" required maxlength="65535"></textarea>
        <input type="file" name="gambar" required accept="image/jpeg,image/png,image/gif">
        <button type="submit" name="submit">Tambah Berita</button>
    </form>
</body>
</html>