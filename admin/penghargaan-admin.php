<?php
include 'db.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_penghargaan = $_POST['nama_penghargaan'];
    $tahun = $_POST['tahun'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES['foto'];

    // Upload foto
    $foto_nama = null;
    if ($foto['error'] === 0) {
        $foto_nama = time() . '_' . $foto['name'];
        move_uploaded_file($foto['tmp_name'], '../img/menu/' . $foto_nama);
    }

    // Simpan data ke database
    $stmt = $conn->prepare("INSERT INTO penghargaan (nama_penghargaan, tahun, deskripsi, foto) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $nama_penghargaan, $tahun, $deskripsi, $foto_nama);
    if ($stmt->execute()) {
        $success = "Penghargaan berhasil ditambahkan!";
    } else {
        $error = "Gagal menambahkan penghargaan: " . $conn->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penghargaan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
        }
        form div {
            margin-bottom: 15px;
        }
        form label {
            display: block;
            font-weight: bold;
        }
        form input, form textarea, form button {
            width: 100%;
            padding: 8px;
        }
        form button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .error, .success {
            text-align: center;
            font-weight: bold;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
    </style>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <h2>Tambah Penghargaan</h2>
        <?php if (isset($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <div>
            <label for="nama_penghargaan">Nama Penghargaan</label>
            <input type="text" id="nama_penghargaan" name="nama_penghargaan" required>
        </div>
        <div>
            <label for="tahun">Tahun</label>
            <input type="number" id="tahun" name="tahun" required>
        </div>
        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" rows="4"></textarea>
        </div>
        <div>
            <label for="foto">Foto</label>
            <input type="file" id="foto" name="foto" accept="image/*">
        </div>
        <button type="submit">Tambah Penghargaan</button>
    </form>
</body>
</html>