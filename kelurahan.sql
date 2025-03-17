-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2024 at 12:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kelurahan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '482c811da5d5b4bc6d497ffa98491e38'),
(2, 'Rizki', '0d61130a6dd5eea85c2c5facfe1c15a7');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `name`, `tanggal`, `description`, `image`) VALUES
(10, 'Mahasiswa UMB Atas nama  Rizki Fikriansyah Mendapatkan beasiswa S2 di KAIST Korea', '2026-03-27', 'Prestasi membanggakan kembali ditorehkan oleh mahasiswa Universitas Muhammadiyah Bima (UMB), Rizki Fikriansyah. Mahasiswa ini berhasil meraih beasiswa penuh untuk melanjutkan studi S2 di Korea Advanced Institute of Science and Technology (KAIST), salah satu universitas teknologi terkemuka di dunia yang berlokasi di Daejeon, Korea Selatan.\r\n\r\nRizki Fikriansyah, yang dikenal sebagai mahasiswa cerdas dan berprestasi di kampusnya, telah menunjukkan dedikasi tinggi dalam bidang akademik. Dengan latar belakang di bidang teknik, Rizki berhasil lolos seleksi beasiswa yang sangat kompetitif di KAIST. Beasiswa ini mencakup biaya pendidikan, tunjangan hidup, serta fasilitas penelitian selama masa studi.\r\n\r\nDalam wawancaranya, Rizki mengungkapkan rasa syukur dan kebanggaannya.\r\n\"Ini adalah kesempatan besar bagi saya untuk mengembangkan pengetahuan dan keterampilan di bidang teknologi. Saya berharap dapat membawa ilmu yang saya pelajari di KAIST untuk berkontribusi pada kemajuan Indonesia,\" ujarnya.\r\n\r\nMendapatkan beasiswa di KAIST bukanlah hal yang mudah. Rizki harus melalui proses seleksi yang ketat, termasuk evaluasi akademik, wawancara, serta pengajuan proposal penelitian. Berkat kerja keras, dukungan dari keluarga, serta bimbingan dosen UMB, Rizki berhasil memenuhi semua persyaratan dengan hasil yang gemilang.\r\n\r\nKeberhasilan Rizki ini juga menjadi kebanggaan bagi Universitas Mercu Buana. Rektor UMB, Prof. Dr. Ridwan, menyampaikan apresiasi kepada Rizki atas pencapaiannya.\r\n\"Kami bangga memiliki mahasiswa seperti Rizki Fikriansyah yang mampu bersaing di kancah internasional. Semoga prestasi ini menjadi inspirasi bagi mahasiswa lainnya untuk terus berusaha meraih mimpi,\" ungkapnya.', 'WhatsApp Image 2024-08-05 at 11.02.40.jpg'),
(11, 'Lomba 17an Kelurahan Panggi, Memperingati hari kemerdekaan republik indonesia', '2025-08-17', 'Kelurahan Panggi kembali menggelar rangkaian acara lomba dalam rangka memperingati Hari Kemerdekaan Republik Indonesia yang ke-79. Acara ini berlangsung meriah pada akhir pekan, diikuti oleh ratusan warga dari berbagai usia. Dengan tema “Bersama Kita Kuat, Bersama Kita Hebat”, kegiatan ini tidak hanya menjadi ajang hiburan, tetapi juga mempererat tali silaturahmi antarwarga.\r\n\r\nBeragam perlombaan tradisional dan modern menjadi daya tarik utama. Mulai dari balap karung, tarik tambang, makan kerupuk, hingga lomba catur dan karaoke. Antusiasme warga terlihat dari banyaknya peserta yang mendaftar dan penonton yang memadati area perlombaan di lapangan Kelurahan Panggi.\r\n\r\nAnak-anak hingga lansia ikut ambil bagian dalam kemeriahan ini. Salah satu lomba yang paling dinanti adalah panjat pinang, yang berhasil mengundang gelak tawa dan sorak sorai warga saat para peserta berjuang memanjat batang pinang untuk mengambil hadiah.\r\n\r\nLurah Panggi, Bapak Ijwan S.Sos, dalam sambutannya menyampaikan bahwa kegiatan ini merupakan wujud rasa syukur atas kemerdekaan yang diraih dengan perjuangan panjang.\r\n\"Melalui kegiatan ini, kita ingin mengenang jasa para pahlawan sekaligus memperkuat kebersamaan di tengah masyarakat Panggi. Mari kita terus menjaga semangat persatuan dan gotong royong,\" ungkapnya.', '27.png'),
(12, 'Ngobrol santai bareng narasumber kece dari luar kota, dengan host tim brida kota bima', '2024-11-30', 'Tim Brida Kota Bima kembali menghadirkan suasana berbeda melalui acara diskusi santai bertajuk “Ngobrol Santai Bareng Narasumber Kece”. Acara ini berlangsung di Aula Kantor Brida, menghadirkan narasumber inspiratif dari luar kota yang berbagi pengalaman dan wawasan di bidang teknologi, inovasi, dan pengembangan masyarakat.\r\n\r\nAcara yang digelar pada hari Sabtu ini menjadi magnet bagi masyarakat Bima, khususnya generasi muda yang ingin belajar dari para ahli. Dengan konsep yang santai namun tetap berbobot, diskusi ini dipandu oleh tim host Brida Kota Bima yang dikenal energik dan komunikatif.\r\n\r\nLurah acara, Ibu Hafizah, menyampaikan apresiasinya terhadap narasumber yang telah meluangkan waktu untuk berbagi ilmu.\r\n\"Kami ingin memberikan platform yang tidak hanya edukatif, tetapi juga menyenangkan. Narasumber kali ini benar-benar luar biasa, mampu menjawab pertanyaan peserta dengan detail dan mudah dipahami,\" ujarnya.\r\n\r\nDiskusi ini melibatkan pembahasan menarik seperti inovasi teknologi di dunia kerja, pemberdayaan masyarakat, hingga tren masa depan yang relevan bagi generasi muda. Narasumber, Bapak Teguh, seorang praktisi di bidang pengembangan teknologi komunitas, membagikan pengalamannya selama bertahun-tahun bekerja di berbagai daerah di Indonesia.\r\n\r\n\"Inovasi bukan hanya soal teknologi, tetapi juga bagaimana kita melihat peluang untuk mengembangkan potensi lokal,\" ungkapnya di sela-sela diskusi.', 'NGOBROL SANTAI.png'),
(14, '6 Mahasiswa asal Kampus UMB melalukan pengembangan website di kelurahan panggi', '2024-11-25', 'Sebagai bentuk pengabdian kepada masyarakat, enam mahasiswa Universitas Muhammadiyah Bima (UMB) tengah melakukan penelitian sekaligus pengembangan website resmi untuk Kelurahan Panggi. Kegiatan ini merupakan bagian dari program kolaborasi antara dunia akademik dan pemerintahan lokal untuk meningkatkan layanan publik berbasis teknologi.\r\n\r\nWebsite yang sedang dikembangkan ini dirancang untuk menjadi platform digital yang memudahkan warga dalam mengakses informasi, berita, serta layanan administrasi di Kelurahan Panggi. Fitur-fitur utama yang direncanakan meliputi informasi kelurahan, berita terkini, forum komunitas, dan layanan pengajuan dokumen secara daring.\r\n\r\nKoordinator tim mahasiswa, Rizki Fikriansyah, menjelaskan tujuan utama dari proyek ini.\r\n\"Kami ingin memberikan solusi digital yang dapat mempercepat dan mempermudah pelayanan di Kelurahan Panggi, serta menjadikan website ini sebagai wadah interaksi antara pemerintah kelurahan dan masyarakatnya,\" ungkapnya.\r\n\r\nProses pengembangan website dimulai dengan tahap penelitian untuk memahami kebutuhan masyarakat dan kelurahan. Para mahasiswa melakukan survei dan wawancara dengan aparat kelurahan serta warga. Hasil dari penelitian ini menjadi dasar dalam merancang desain dan fitur website.\r\n\r\nSelanjutnya, tim akan melakukan uji coba awal untuk memastikan website dapat berfungsi dengan baik dan sesuai kebutuhan.\r\n\"Kami juga membuka masukan dari masyarakat selama proses pengembangan untuk memastikan hasil akhirnya benar-benar bermanfaat,\" tambah salah satu anggota tim, Akbar.\r\n\r\nLurah Panggi, Bapak Ijwan S.Sos, memberikan apresiasi tinggi terhadap inisiatif para mahasiswa UMB.\r\n\"Kami sangat mendukung proyek ini karena akan membantu memodernisasi pelayanan kami. Semoga website ini menjadi contoh bagi kelurahan lain di Kota Bima,\" ujarnya.', 'kel.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `gender`, `age`) VALUES
(1, 'RIZKI FIKRIANSYAH', 'Laki-laki', 20),
(2, 'RIZNA AINUL HANUM', 'Perempuan', 21),
(3, 'SUKRON GOLIT', 'Laki-laki', 23),
(4, 'KARIMAH', 'Perempuan', 21),
(5, 'EL RUMI', 'Laki-laki', 3),
(6, 'SAFIA KAMALA ', 'Perempuan', 2),
(7, 'GILANG', 'Laki-laki', 10),
(8, 'GALANG', 'Laki-laki', 8),
(9, 'TEGUH ANSOR LOROSAE', 'Laki-laki', 30),
(10, 'MAEMUNAH', 'Perempuan', 61),
(12, 'HASA', 'Laki-laki', 66);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
