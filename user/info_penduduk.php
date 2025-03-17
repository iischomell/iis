<?php
include '../admin/db.php'; // Koneksi ke database

$sql_gender = "SELECT gender, COUNT(*) as jumlah FROM penduduk GROUP BY gender";
$result_gender = $conn->query($sql_gender);

$jumlah_laki = 0;
$jumlah_perempuan = 0;

while ($row = $result_gender->fetch_assoc()) {
    if ($row['gender'] == 'Laki-laki') {
        $jumlah_laki = $row['jumlah'];
    } elseif ($row['gender'] == 'Perempuan') {
        $jumlah_perempuan = $row['jumlah'];
    }
}

// Ambil data jumlah penduduk berdasarkan kategori usia
$sql_age = "SELECT 
    SUM(age BETWEEN 0 AND 5) AS balita, 
    SUM(age BETWEEN 6 AND 17) AS anak_anak, 
    SUM(age BETWEEN 18 AND 49) AS dewasa, 
    SUM(age >= 50) AS orang_tua 
    FROM penduduk";
$result_age = $conn->query($sql_age);

$age_data = $result_age->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Penduduk</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">

</head>
<style>
body {
    font-family: 'Roboto', sans-serif;
    background-color: #eef2f5;
    margin: 0;
    padding: 20px;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
}

body h2 {
    padding: 70px;
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
h2 {
    font-size: 2rem;
    font-weight: 600;
    color: #222;
    margin-bottom: 20px;
    text-align: center;
}

h3 {
    font-size: 1.5rem;
    font-weight: 500;
    color: #444;
    margin-top: 30px;
    text-align: center;
}

/* Container untuk Diagram */
canvas {
    max-width: 90%;
    margin: 20px auto;
    border: 2px solid #d6d9dd;
    border-radius: 12px;
    background-color: #fff;
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
    padding: 10px;
}

/* Section Styling */
section {
    max-width: 900px;
    background-color: #ffffff;
    padding: 20px;
    margin: 20px auto;
    border-radius: 12px;
    box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.1);
}

/* Chart Colors */
.chart-legend {
    margin: 10px 0;
    text-align: center;
}

.legend-item {
    display: inline-block;
    margin: 0 10px;
    font-size: 0.9rem;
    color: #555;
}

.legend-color {
    display: inline-block;
    width: 12px;
    height: 12px;
    margin-right: 6px;
    border-radius: 50%;
}

/* Custom Colors */
.pieChart-color-laki {
    background-color:rgb(184, 227, 252);
}

.pieChart-color-perempuan {
    background-color:rgb(248, 119, 175);
}

/* Footer */ 
footer {
    margin-top: 40px;
    text-align: center;
    color: #666;
    font-size: 0.9rem;
}

/* Responsiveness */
@media (max-width: 768px) {
    h2 {
        font-size: 1.8rem;
    }

    h3 {
        font-size: 1.2rem;
    }

    canvas {
        max-width: 100%;
    }
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
    <h2>Informasi Jumlah Penduduk</h2>

    <h3>Jumlah Penduduk Berdasarkan Jenis Kelamin</h3>
    <canvas id="genderChart" width="400" height="200"></canvas>

    <h3>Jumlah Penduduk Berdasarkan Kategori Usia</h3>
    <canvas id="ageChart" width="400" height="200"></canvas>

    <h3>Informasi Penduduk Selengkapnya Klik Link berikut</h3>
    <a href ="https://docs.google.com/spreadsheets/d/1wnoYu7h-AoGxyA4OC1-o1klv9FkvX59-/edit?usp=drivesdk&ouid=101894008367662775215&rtpof=true&sd=true"><p target = blank_>https://docs.google.com/spreadsheets/d/1wnoYu7h-AoGxyA4OC1-o1klv9FkvX59-/edit?usp=drivesdk&ouid=101894008367662775215&rtpof=true&sd=true</p></a>


    <script>
        // Data untuk diagram jenis kelamin
        var genderData = {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                label: 'Jumlah Penduduk',
                data: [<?php echo $jumlah_laki; ?>, <?php echo $jumlah_perempuan; ?>],
                backgroundColor: ['#36A2EB', '#FF6384'],
                borderColor: ['#36A2EB', '#FF6384'],
                borderWidth: 1
            }]
        };

        // Opsi diagram jenis kelamin
        var genderOptions = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jumlah Penduduk Berdasarkan Jenis Kelamin'
                }
            }
        };

        // Render diagram jenis kelamin
        var genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'pie',
            data: genderData,
            options: genderOptions
        });

        // Data untuk diagram kategori usia
        var ageData = {
            labels: ['Balita (0-5)', 'Anak-anak (6-17)', 'Dewasa (18-49)', 'Orang Tua (50+)'],
            datasets: [{
                label: 'Jumlah Penduduk',
                data: [
                    <?php echo $age_data['balita']; ?>, 
                    <?php echo $age_data['anak_anak']; ?>, 
                    <?php echo $age_data['dewasa']; ?>, 
                    <?php echo $age_data['orang_tua']; ?>
                ],
                backgroundColor: ['#FF9F40', '#FFCD56', '#4BC0C0', '#9966FF'],
                borderColor: ['#FF9F40', '#FFCD56', '#4BC0C0', '#9966FF'],
                borderWidth: 1
            }]
        };

        // Opsi diagram kategori usia
        var ageOptions = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jumlah Penduduk Berdasarkan Kategori Usia'
                }
            }
        };

        // Render diagram kategori usia
        var ageCtx = document.getElementById('ageChart').getContext('2d');
        new Chart(ageCtx, {
            type: 'bar',
            data: ageData,
            options: ageOptions
        });
    </script>
</body>
</html>