<?php
include '../admin/db.php'; // Koneksi ke database

// Tambah data penduduk
if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    $sql = "INSERT INTO penduduk (nama, gender, age) VALUES ('$nama', '$gender', '$age')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Hapus data penduduk
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM penduduk WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Edit data penduduk
if (isset($_POST['edit'])) {
    $edit_id = $_POST['edit_id'];
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    $sql = "UPDATE penduduk SET nama='$nama', gender='$gender', age='$age' WHERE id=$edit_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diubah');</script>";
        echo "<script>window.location.href='admin_info_penduduk.php';</script>"; // Redirect setelah update
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil semua data penduduk
$search_keyword = '';
if (isset($_POST['search'])) {
    $search_keyword = $_POST['search_keyword'];
    $sql = "SELECT * FROM penduduk WHERE nama LIKE '%$search_keyword%' OR gender LIKE '%$search_keyword%' OR age LIKE '%$search_keyword%'";
} else {
    $sql = "SELECT * FROM penduduk";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Informasi Penduduk</title>
</head>
<style>
:root {
  --primary: #006ba8;
  --bg: #010101;
}

* {
  font-family: "poppins", sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  outline: none;
  border: none;
  text-decoration: none;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 100px;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    background-color: var(--bg);
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.4rem 7%;
  background-color: rgb(1, 1, 1, 0.8);
  border-bottom: 1px solid #513c28;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 9999;
}

.logo-image {
    height: 30px; /* Sesuaikan ukuran logo */
    margin-right: 8px; /* Jarak antara logo dan teks */
    vertical-align: middle; /* Agar sejajar dengan teks */
}

.navbar-nav {
  display: flex; /* Ensure it uses flexbox */
  gap: 2rem; /* Space between links */
}

.hidden {
  display: none; /* Hide menu */
}

.navbar .navbar-logo {
  font-size: 2rem;
  font-weight: 700;
  color: #fff;
  font-style: italic;
}

.navbar .navbar-logo span {
  color: var(--primary);
}

.navbar .navbar-nav a {
  color: #fff;
  display: inline-block;
  font-size: 1.2rem;
  margin: 0 1rem;
  transition: color 0.3s; /* Smooth color transition */
}

.navbar .navbar-nav a:hover {
  color: var(--primary);
}

.navbar .navbar-nav a::after {
  content: "";
  display: block;
  padding-bottom: 0.5rem;
  border-bottom: 0.1rem solid var(--primary);
  transform: scaleX(0);
  transition: 0.2s linear;
}

.navbar .navbar-nav a:hover::after {
  transform: scaleX(0.5);
}

.navbar .navbar-extra a {
  color: #fff;
  margin: 0 0.5rem;
}

.navbar .navbar-extra a:hover {
  color: var(--primary);
}

h2, h3 {
    color: var(--primary);
    text-align: center;
    margin: 20px 0;
}

/* Formulir */
/* Container untuk menyusun form secara horizontal */
.form-container {
    display: flex; /* Gunakan flexbox untuk tata letak horizontal */
    justify-content: space-between; /* Berikan ruang di antara form */
    gap: 20px; /* Jarak antara form */
    width: 90%; /* Lebar keseluruhan container */
    margin: 20px auto; /* Pusatkan secara horizontal */
}

/* Form individual */
.form-item {
    flex: 1; /* Membagi ruang form secara proporsional */
    padding: 20px;
    background-color: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Input dan tombol dalam form */
.form-item form input[type="text"],
.form-item form input[type="number"],
.form-item form select {
    width: 100%; /* Lebar penuh */
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 14px;
    color: #495057;
}

.form-item form button {
    background-color: #007bff;
    color: #ffffff;
    padding: 12px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
}

.form-item form button:hover {
    background-color: #0056b3;
}


/* Tabel */
table {
    width: 90%;
    max-width: 800px;
    margin: 20px auto;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    border-radius: 8px;
    overflow: hidden;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #dee2e6;
}

table th {
    background-color: #007bff;
    color: #ffffff;
    text-transform: uppercase;
    font-size: 14px;
}

table tr:hover {
    background-color: #f1f3f5;
}

table tr:nth-child(even) {
    background-color: #f8f9fa;
}

table td {
    font-size: 14px;
    color: #495057;
}

/* Aksi */
table a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
    margin-right: 10px;
}

table a:hover {
    text-decoration: underline;
}

table a.delete-link {
    color: #dc3545;
}

table a.delete-link:hover {
    color: #c82333;
}

/* Footer */
footer {
    margin-top: 20px;
    font-size: 14px;
    color: #6c757d;
}

/* Form Edit Penduduk - Efek khusus hanya untuk form edit */
form[method="post"]:has(input[name="edit_id"]) {
    margin-top: 20px;
    padding: 20px;
    background-color: #f0f8ff; /* Warna latar biru muda untuk membedakan */
    border: 2px solid #92c9e9; /* Border biru */
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3); /* Efek bayangan */
    width: 90%;
    max-width: 600px;
    animation: fadeInEdit 0.5s ease-in-out;
}

/* Efek animasi muncul untuk form edit */
@keyframes fadeInEdit {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Input dan Select dalam Form Edit */
form[method="post"]:has(input[name="edit_id"]) input,
form[method="post"]:has(input[name="edit_id"]) select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ced4da;
    border-radius: 5px;
    font-size: 14px;
    color: #495057;
}

/* Tombol Simpan Perubahan */
form[method="post"]:has(input[name="edit_id"]) button {
    background-color: #28a745; /* Warna hijau */
    color: #ffffff;
    font-weight: bold;
    text-transform: uppercase;
    border: none;
    border-radius: 5px;
    padding: 12px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
}

form[method="post"]:has(input[name="edit_id"]) button:hover {
    background-color: #218838; /* Hijau lebih gelap saat hover */
}

/* Tambahkan judul untuk form edit */
form[method="post"]:has(input[name="edit_id"])::before {
    content: "Edit Data Penduduk";
    display: block;
    font-size: 18px;
    font-weight: bold;
    color: #92c9e9;
    margin-bottom: 10px;
    text-align: center;
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
    </div>
</nav>

<h2>Manajemen Data Penduduk</h2>

<!-- Form Tambah dan Pencarian - Diletakkan dalam container -->
<div class="form-container">
    <!-- Form Pencarian -->
    <div class="form-item">
        <h3>Pencarian Data Penduduk</h3>
        <form method="post">
            <input type="text" name="search_keyword" placeholder="Cari berdasarkan nama, gender, atau umur" value="<?php echo $search_keyword; ?>" required>
            <button type="submit" name="search">Cari</button>
        </form>
    </div>

    <!-- Form Tambah Penduduk -->
    <div class="form-item">
        <h3>Tambah Penduduk</h3>
        <form method="post">
            <input type="text" name="nama" placeholder="Nama" required>
            <select name="gender" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <input type="number" name="age" placeholder="Umur" required>
            <button type="submit" name="add">Tambah</button>
        </form>
    </div>
</div>


<hr>

<!-- Tabel Data Penduduk -->
<h3>Data Penduduk</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Gender</th>
        <th>Umur</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['nama']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['age']; ?></td>
        <td>
            <a href="admin_info_penduduk.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
            <a href="admin_info_penduduk.php?edit_id=<?php echo $row['id']; ?>">Edit</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<!-- Form Edit Penduduk -->
<?php if (isset($_GET['edit_id'])): ?>
<?php
    $edit_id = $_GET['edit_id'];
    $sql = "SELECT * FROM penduduk WHERE id = $edit_id";
    $result_edit = $conn->query($sql);
    $row_edit = $result_edit->fetch_assoc();
?>
<h3>Edit Penduduk</h3>
<form method="post">
    <input type="hidden" name="edit_id" value="<?php echo $row_edit['id']; ?>">
    <input type="text" name="nama" value="<?php echo $row_edit['nama']; ?>" required>
    <select name="gender" required>
        <option value="Laki-laki" <?php if ($row_edit['gender'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
        <option value="Perempuan" <?php if ($row_edit['gender'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
    </select>
    <input type="number" name="age" value="<?php echo $row_edit['age']; ?>" required>
    <button type="submit" name="edit">Simpan Perubahan</button>
</form>
<?php endif; ?>

<?php $conn->close(); // Tutup koneksi di bagian akhir ?>
</body>
</html>
