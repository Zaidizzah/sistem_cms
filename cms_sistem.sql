-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2023 pada 14.33
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_sistem`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `captcha`
--

CREATE TABLE `captcha` (
  `captcha_id` int(11) UNSIGNED NOT NULL,
  `captcha_time` int(11) UNSIGNED NOT NULL,
  `word` varchar(8) NOT NULL,
  `filename` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `word`, `filename`) VALUES
(6, 1701249474, 'E4iqeriX', '1701249473.7605.jpg'),
(7, 1701249573, '0QJckP6O', '1701249572.8778.jpg'),
(8, 1701249599, 'Mq1zYucA', '1701249598.5446.jpg'),
(9, 1701249669, 'hL5ELwnD', '1701249669.4146.jpg'),
(10, 1701249695, 'jsaOQRlx', '1701249695.1325.jpg'),
(12, 1701249720, 'CnUxf0E7', '1701249720.0868.jpg'),
(13, 1701249727, 'croSQgqn', '1701249727.4834.jpg'),
(14, 1701249735, 'fmrj5Mk8', '1701249735.131.jpg'),
(15, 1701249743, 'RIsYz1SZ', '1701249743.2081.jpg'),
(16, 1701249751, 'suwahgvV', '1701249750.652.jpg'),
(17, 1701249783, 'KlMP2Nmx', '1701249782.9867.jpg'),
(37, 1701253762, '4CnKw06B', '20231129-4CnKw06B-1701253762.png'),
(38, 1701253778, 'vVKkhnDf', '20231129-vVKkhnDf-1701253778.png'),
(39, 1701253825, 'rvt1fZ2R', '20231129-rvt1fZ2R-1701253825.png'),
(40, 1701253843, 'CZSbosLW', '20231129-CZSbosLW-1701253843.png'),
(41, 1701253866, 'XT8EEihp', '20231129-XT8EEihp-1701253866.png'),
(43, 1701253912, '11iOjgyw', '20231129-11iOjgyw-1701253912.png'),
(44, 1701253956, 'OP6u4XKo', '20231129-OP6u4XKo-1701253956.png'),
(45, 1701253980, 'Z2xTaI3j', '20231129-Z2xTaI3j-1701253980.png'),
(46, 1701254016, '8fooIq1Z', '20231129-8fooIq1Z-1701254016.png'),
(47, 1701643650, 'vX1UjpG8', '20231204-vX1UjpG8-1701643650.png'),
(54, 1701664006, 'KELrAkdQ', '20231204-KELrAkdQ-1701664006.png'),
(55, 1701664348, 'RaMaELek', '20231204-RaMaELek-1701664348.png'),
(56, 1701665108, 'Xs6e7UnP', '20231204-Xs6e7UnP-1701665108.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `caraousel`
--

CREATE TABLE `caraousel` (
  `id_caraousel` int(11) NOT NULL,
  `judul` varchar(42) NOT NULL,
  `foto` varchar(47) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `caraousel`
--

INSERT INTO `caraousel` (`id_caraousel`, `judul`, `foto`) VALUES
(13, 'Perpustakaan', 'library-5612441_640.jpg'),
(15, 'impresionis', '20231116001712.jpg'),
(16, 'Star Rail or Milkyways', '20231121233734.jpg'),
(17, 'For Love in Another World', '20231116111228.jpg'),
(18, 'Asikin aj banggg', '1656458661430.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(11) NOT NULL,
  `judul` varchar(47) NOT NULL,
  `deskripsi` varchar(87) NOT NULL,
  `foto` varchar(47) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`id_galeri`, `judul`, `deskripsi`, `foto`, `tanggal`) VALUES
(4, 'Galeri pertama si akyuu', 'Ku isikan dengan Pemandangan yang amat Cantik seklai, Mantappu geyss,,,', '355055773_743711477502505_51.jpg', '2023-12-06'),
(5, 'Pixellated Mantappu', 'Karya seni alam pixels yang menawan,', '355425597_3417501788511603_.jpg', '2023-11-12'),
(6, 'Wawa_wah Mantaapu', 'Gambar yang agak wah, xixixi asek yahhh...', '358404214_816160193414997_6.jpg', '2023-11-12'),
(7, 'Konten Galeri kece,', 'Kalsem amat dah', '355446481_812847103364466_5.jpg', '2023-11-08'),
(8, 'Sunset', 'Sunset paling keren betsss,,', '358948502_601923765467436_6.jpg', '2023-11-08'),
(9, 'asekkk', 'wishhsih asek gak banhh,,', 'orange-g2b6399575_1280.jpg', '2023-11-08'),
(10, 'sikatt kang', 'wishh keren lagi nih banhh', '355251903_1285967442278822_.jpg', '2023-11-08'),
(11, 'Bbe kankcis', 'Waduhhh gimana nihhch', '355225567_295239892850324_8.jpg', '2023-11-08'),
(12, 'Galeri baru', 'Galeri ini agak lain suchh...', '355103420_223917313300884_7.jpg', '2023-11-12'),
(14, 'Hhhh', 'Hhhhhhh', '403864049_1245215053091785_.jpg', '2023-11-23'),
(15, 'Mesh of moshi', 'teh mesh yang enak', 'barleyfield1684052_640.jpg', '2023-11-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL,
  `digunakan` varchar(64) NOT NULL,
  `dibuat_pada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `digunakan`, `dibuat_pada`) VALUES
(45, 'laporan', '1', '2023-10-17'),
(49, 'Sejarah', '2', '2023-11-30'),
(50, 'Bahasa Jawa', '1', '2023-12-06'),
(51, 'Matematika', '1', '2023-12-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_konten` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `blocked` enum('0','1') NOT NULL,
  `nama_pengguna` varchar(47) NOT NULL,
  `email` varchar(37) NOT NULL,
  `keterangan` text NOT NULL,
  `membalas` varchar(24) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_konten`, `parent_id`, `blocked`, `nama_pengguna`, `email`, `keterangan`, `membalas`, `waktu`) VALUES
(20, 25, 0, '1', 'Denis', 'DenisKece224@yahoo.co.id', 'Konten kali ini agak keren aku suka', '', '2023-10-31 04:42:55'),
(21, 25, 20, '0', 'Pande', 'siTamvan@gmail.com', 'Iya sih, Aku juga pen jadi Kontributor deh. minnn adminnnn tolongggg!!!', 'Denis', '2023-10-31 04:47:05'),
(22, 25, 0, '0', 'zaid izzah nurbaain', 'nailaaqila31@gmail.com', 'wkwkwk', '', '2023-11-22 08:26:53'),
(26, 25, 20, '0', 'Admin <i class=\"fa fa-check\"></i>', '', 'pakyu brohhh....', 'Denis', '2023-11-22 08:56:31'),
(30, 25, 22, '0', 'Admin <i class=\"fa fa-check\"></i>', '', 'asikkkin banggg', 'zaid izzah nurbaain', '2023-11-22 09:06:47'),
(31, 25, 30, '0', 'Zaid <i class=\"fa fa-check\"></i>', '', 'gg bang', 'Admin', '2023-11-22 09:08:32'),
(32, 25, 31, '0', 'Zaid <i class=\"fa fa-check\"></i>', '', 'kkkjjjajaja', 'Zaid', '2023-11-22 09:12:20'),
(33, 25, 32, '0', 'Admin <i class=\"fa fa-check\"></i>', '', 'masa sih bang?', 'Zaid', '2023-11-22 09:13:07'),
(34, 25, 33, '0', 'Admin <i class=\"fa fa-check\"></i>', '', 'iy sihhhh, hhe...', 'Admin', '2023-11-22 09:13:25'),
(35, 25, 0, '0', 'sopopaling gg', 'DenisKece224@yahoo.co.id', 'asekkk mamang', '', '2023-11-22 16:13:18'),
(36, 25, 0, '0', 'Yjl', '6ujkl@gmail.com', 'Gjkhggf', '', '2023-11-23 11:03:28'),
(37, 25, 35, '0', 'Zaid kun elek', 'ardinur2007@gmail.com', 'Koe elelelwlwk', 'sopopaling gg', '2023-11-23 11:06:10'),
(38, 25, 0, '0', 'admin', 'admin_31@yahoo.co.id', 'pantes lu bang', '', '2023-11-29 18:56:25'),
(42, 25, 0, '0', 'bwee ', 'admin_31@yahoo.co.id', 'sincan', '', '2023-11-29 19:09:10'),
(43, 25, 0, '0', 'Anonymous', 'siTamvan@gmail.com', 'kece parah', '', '2023-11-29 19:11:26'),
(44, 25, 0, '0', 'bababui', 'siTamvan@gmail.com', 'test bang', '', '2023-11-30 07:42:24'),
(45, 25, 43, '0', 'bababui', 'baba_31@yahoo.co.id', 'kece bet', 'Anonymous', '2023-11-30 07:43:31'),
(47, 25, 20, '0', 'saia', 'baba_31@yahoo.co.id', 'Lah si Denis kenapa yuh?', 'Denis', '2023-11-30 09:22:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `judul_website` varchar(17) NOT NULL,
  `profile_website` text NOT NULL,
  `instagram` varchar(24) NOT NULL,
  `facebook` varchar(24) NOT NULL,
  `email` varchar(37) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `latitude` varchar(46) NOT NULL,
  `longitude` varchar(46) NOT NULL,
  `no_wa` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `judul_website`, `profile_website`, `instagram`, `facebook`, `email`, `alamat`, `latitude`, `longitude`, `no_wa`) VALUES
(1, 'Zaidunss', '<div>\r\n<p class=\"paragraph\">Hai, Perkenalkan saya Zaid Izzah Nurbaain, Jika teman-teman melihat nama saya adalah nama yang rumit, teman-teman bisa menyebut saya dengan sebutan Zaid :).</p>\r\n<p class=\"paragraph\">Saya adalah seorang pelajar, saya mempunyai cita-cita untuk menjadi seorang Penulis Cerita. Yang menulis betapa kerennya sebuah cerita dimana saya ingin menjadi programmer.</p>\r\n<p class=\"paragraph\">Saya adalah seorang pelajar dari sekolah bergengsi SMK Negeri 2 Karanganyar.</p>\r\n</div>', 'ardiipaidi', 'pacebook saya', 'akuiwan@gmail.com', 'karanganyar, Jln Yos sudarsono', '-7.59031', '110.95080', '088806089256');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konten`
--

CREATE TABLE `konten` (
  `id_konten` int(11) NOT NULL,
  `judul` varchar(72) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(47) NOT NULL,
  `slug` varchar(82) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `username` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `konten`
--

INSERT INTO `konten` (`id_konten`, `judul`, `keterangan`, `foto`, `slug`, `id_kategori`, `tanggal`, `username`) VALUES
(25, 'Kamu yang ada disana', '<p>\"Kamu yang ada disana\" adalah sebuah kalimat yang penuh makna dan terkadang digunakan untuk menyampaikan rasa kangen atau perhatian kepada seseorang yang berada di tempat yang jauh atau terpisah.</p>\r\n<p>Kalimat ini seringkali digunakan dalam konteks hubungan jarak jauh atau untuk mengingatkan bahwa seseorang selalu ada dalam pikiran kita meskipun tidak berada di dekat. Ini mencerminkan perasaan kerinduan, cinta, dan perhatian terhadap seseorang yang berada di tempat yang berbeda. Kalimat ini sering digunakan dalam pesan-pesan romantis atau komunikasi antarorang yang merindukan kehadiran satu sama lain.</p>\r\n<p>- Salam hangat dari aku \"Kontributor\"</p>', 'Another_bunch_of_mumus._Whi.jpg', 'kamu+yang+ada+disana', 45, '2023-11-29', 'admin'),
(35, 'Perjuangan Melawan Kolonialisme dan Faktor Pendorong Organisasi Pergerak', '<p><strong><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">Sejak tahun 1908,&nbsp;</span></strong><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">perjuangan melawan kolonialisme di Indonesia dipandu oleh beberapa ciri utama:</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">1. **Dipimpin oleh Kaum Terpelajar:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Kaum terpelajar seperti dr. Sutomo, Soekarno, dan Moh. Hatta memainkan peran utama setelah tahun 1908, dipengaruhi oleh Politik Etis Belanda.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Menggunakan jalur organisasi modern, seperti diplomasi, kampanye media, dan rapat besar.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">2. **Organisasi dan Diplomasi:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Kaum terpelajar menggunakan jalur organisasi modern dengan cara diplomasi, kampanye media, dan rapat besar.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Media massa digunakan untuk kritik dan agitasi terhadap kebijakan Belanda.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">3. **Kaderisasi dan Keberlanjutan:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Perlawanan tidak lagi tergantung pada tokoh kharismatis, melainkan pada organisasi pergerakan dengan sistem kaderisasi yang terorganisir.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">4. **Visi dan Misi Kemerdekaan Indonesia:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Organisasi-organisasi pergerakan memiliki visi dan misi bersama: kemerdekaan Indonesia.</span></p>\r\n<p><strong><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">Faktor pendorong lahirnya organisasi pergerakan meliputi:</span></strong></p>\r\n<p><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">1. **Kondisi Sosial, Politik, dan Ekonomi yang Parah:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Penindasan, kekejaman, eksploitasi, dan ketidakadilan pemerintah kolonial memicu perlawanan rakyat.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">2. **Munculnya Kaum Terpelajar:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Terpelajar seperti Soekarno, Moh. Hatta, dan lainnya mengalami pendidikan modern dan membentuk organisasi pergerakan.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">3. **Kenangan akan Kejayaan Masa Lampau:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Kesadaran akan masa kejayaan Nusantara pada Kerajaan Sriwijaya dan Majapahit membangkitkan rasa harga diri dan kepercayaan diri.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">4. **Faktor Eksternal:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Kesuksesan pergerakan nasional di negara-negara Asia-Afrika, kemenangan Jepang atas Rusia, dan masuknya paham-paham baru dari Eropa dan Amerika memotivasi perjuangan kemerdekaan.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\"><strong>Rangkuman: Perkembangan Pergerakan Nasional Indonesia</strong></span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">**A. Periode Awal Perkembangan:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">Pada periode ini, gerakan nasionalisme di Indonesia diwarnai perjuangan untuk memperbaiki kondisi sosial dan budaya. Sifat gerakannya moderat dan kooperatif dengan pemerintah kolonial Belanda. Beberapa organisasi yang muncul pada periode ini adalah Budi Utomo, Sarekat Islam, dan Muhammadiyah.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Dimulai sebelum 1908, perjuangan melawan Belanda dipimpin oleh raja, bangsawan, dan tokoh agama.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Setelah 1908, kaum terpelajar memainkan peran utama dalam organisasi pergerakan, dipengaruhi oleh Politik Etis Belanda.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">**B. Periode Nasionalisme Politik:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">Dalam periode ini, gerakan nasionalisme di Indonesia mulai bergerak dalam bidang politik untuk meraih kemerdekaan Indonesia. Organisasi yang muncul pada periode ini adalah Indische Partij, Gerakan Pemuda, dan Gerakan Perempuan.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Setelah 1908, pergerakan dipimpin oleh kaum terpelajar melalui organisasi modern dengan jalur diplomasi, kampanye media, dan rapat besar.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Media massa digunakan untuk kritik terhadap kebijakan Belanda.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Organisasi memiliki sistem kaderisasi untuk keberlanjutan.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">**C. Periode Radikal:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">Periode radikal adalah masa di mana organisasi-organisasi pergerakan menolak bekerja sama atau bersikap nonkooperatif dengan pemerintah kolonial Belanda dan secara tegas menuntut kemerdekaan. Organisasi yang bergerak secara nonkooperatif di antaranya adalah Perhimpunan Indonesia (PI), PKI, dan PNI</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Faktor eksternal seperti kesuksesan pergerakan nasional di negara-negara Asia-Afrika memotivasi semangat nasionalisme.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Periode ini melibatkan ideologi radikal dan menolak bekerja sama dengan pemerintah kolonial.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Terjadi pemberontakan PKI pada tahun 1926-1927 di Jawa dan Sumatera Barat.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">**D. Periode Bertahan:**</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">Periode bertahan adalah periode di mana gerakan nasionalisme di Indonesia berupaya lebih moderat dan menahan diri. Sikap moderat berarti kembali bekerja sama dengan pemerintah kolonial Belanda. Sikap ini diambil agar organisasi pergerakan tidak dibubarkan Belanda dan para tokohnya tidak ditangkap ataupun diasingkan. Dengan demikian, diharapkan kelangsungan hidup organisasi pergerakan serta kesinambungan perjuangan menuju Indonesia merdeka tetap terjaga. Kaum pergerakan belajar dari pengalaman sebelumnya bahwa sikap radikal merugikan bangsa Indonesia.</span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">Organisasi yang berkembang pada periode ini adalah Parindra, GAPI, Gerindo. Mereka memaksimalkan Volksraad sebagai wadah perjuangan meraih kemerdekaan. Sebab, hanya organisasi yang moderat-kooperatif yang dapat mengirimkan wakilnya di Volksraad.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp;</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Periode ini ditandai dengan perlawanan melalui cara-cara non-kekerasan dan upaya mempertahankan identitas nasional.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Kaum terpelajar berperan dalam membentuk visi dan misi kemerdekaan Indonesia.</span><br><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">&nbsp; &nbsp;- Kesadaran akan kejayaan masa lampau dan faktor eksternal memotivasi perjuangan.</span></p>\r\n<p>&nbsp;</p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif; font-size: 14pt;\">- Sejarah.</span></p>', '397320573_18361193839076163.jpg', 'perjuangan+melawan+kolonialisme+dan+faktor+pendorong+organisasi+pergerak', 49, '2023-12-06', 'admin');
INSERT INTO `konten` (`id_konten`, `judul`, `keterangan`, `foto`, `slug`, `id_kategori`, `tanggal`, `username`) VALUES
(36, 'Timus', '<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif; color: rgb(37, 37, 37);\">Timus, Timus yaiku panganan tradisional khas wilayah Karanganyar, Jawa tengah.</span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif; color: rgb(37, 37, 37);\">Panganan iki asalle saking hasil bumi sing kerep didadekakke sumber karbohidrat yaiku Rowotan. Panganan iki uga nduweni rasa kang legi lan lembut. Bahan baku panganan iki didamel saking Rowotan wau, utawa uga telo madu, telo ungu, lan jenising telo sak liyane. Panganan iki dadi primadonane oleh-oleh kangge para wisatawan.</span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif; color: rgb(37, 37, 37);\">Bahan dasar ngaweni panganan iki yaiku:</span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\">&nbsp;</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal; page-break-before: always;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif;\"><!-- [if gte vml 1]><o:wrapblock><v:shapetype id=\"_x0000_t75\"\r\n  coordsize=\"21600,21600\" o:spt=\"75\" o:preferrelative=\"t\" path=\"m@4@5l@4@11@9@11@9@5xe\"\r\n  filled=\"f\" stroked=\"f\">\r\n  <v:stroke joinstyle=\"miter\"/>\r\n  <v:formulas>\r\n   <v:f eqn=\"if lineDrawn pixelLineWidth 0\"/>\r\n   <v:f eqn=\"sum @0 1 0\"/>\r\n   <v:f eqn=\"sum 0 0 @1\"/>\r\n   <v:f eqn=\"prod @2 1 2\"/>\r\n   <v:f eqn=\"prod @3 21600 pixelWidth\"/>\r\n   <v:f eqn=\"prod @3 21600 pixelHeight\"/>\r\n   <v:f eqn=\"sum @0 0 1\"/>\r\n   <v:f eqn=\"prod @6 1 2\"/>\r\n   <v:f eqn=\"prod @7 21600 pixelWidth\"/>\r\n   <v:f eqn=\"sum @8 21600 0\"/>\r\n   <v:f eqn=\"prod @7 21600 pixelHeight\"/>\r\n   <v:f eqn=\"sum @10 21600 0\"/>\r\n  </v:formulas>\r\n  <v:path o:extrusionok=\"f\" gradientshapeok=\"t\" o:connecttype=\"rect\"/>\r\n  <o:lock v:ext=\"edit\" aspectratio=\"t\"/>\r\n </v:shapetype><v:shape id=\"Drawing_x0020_0\" o:spid=\"_x0000_s1026\" type=\"#_x0000_t75\"\r\n  alt=\"image1695955033570.png\" style=\'position:absolute;margin-left:7.55pt;\r\n  margin-top:16.55pt;width:517.35pt;height:791.15pt;z-index:251658240;\r\n  visibility:visible;mso-wrap-style:square;mso-wrap-distance-left:9pt;\r\n  mso-wrap-distance-top:0;mso-wrap-distance-right:9pt;\r\n  mso-wrap-distance-bottom:0;mso-position-horizontal:absolute;\r\n  mso-position-horizontal-relative:text;mso-position-vertical:absolute;\r\n  mso-position-vertical-relative:text\'>\r\n  <v:imagedata src=\"file:///C:/Users/asusb/AppData/Local/Packages/oice_16_974fa576_32c1d314_23a3/AC/Temp/msohtmlclip1/01/clip_image001.jpg\"\r\n   o:title=\"image1695955033570\"/>\r\n  <w:wrap type=\"topAndBottom\"/>\r\n </v:shape><![endif]--><!-- [if !vml]--></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal; page-break-before: always;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif;\"><!--[endif]--><!-- [if gte vml 1]></o:wrapblock><![endif]--></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal; page-break-before: always;\"><img src=\"data:image/jpeg;base64,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\" width=\"530\" height=\"376\"></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal; page-break-before: always;\">&nbsp;</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif; color: rgb(37, 37, 37);\">Rowotan utawa jenising telo liyane kang ditambahi gula lan sekedik tepung tapioka. </span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif; color: rgb(37, 37, 37);\">Proses ngaweni timus uga prasaja lan saged digawe dewe.</span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif; color: rgb(37, 37, 37);\">Proses ngawe utawa masak timus diwiwiti kanthi dioncekki lan diwasuh tekan resik, banjur didang lan ditumbuk kanthi alus. Adonan Rowotan kang sampun alus banjur diwenehi utawa dicampur karo tepung tapioka lan gula pasir bar iku diaduk kanthi kecampur rata. Sak sampunipun kecampur, Adonan dibentuk dadi bund&ecirc;r lonjong banjur agi digoreng kanthi kecoklatan.</span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: 112%;\"><span style=\"font-size: 14pt; line-height: 112%; font-family: \'times new roman\', times, serif;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif; color: rgb(37, 37, 37);\">Timus cocok didahar meniko tasih anget nalika nduweni sensasi krispi ing njobo lan lembut ing njerone. Sakliyane nduweni rasa gurih, manis, enak, lan murah timus nduweni katah manfaat kangge kesehatan </span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal; page-break-before: always;\">&nbsp;</p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0cm; line-height: normal;\"><span style=\"font-size: 14pt; font-family: \'times new roman\', times, serif; color: rgb(37, 37, 37);\">awak sebab didamel saking Rowotan utowo telo-teloan sing katah nduweni Vitamin A dan C, Beta Karotin, Serat, lan sitik kalori. Serat kang duwur saka Rowotan bisa marai warek suwe sahingga cocok', '44.jpeg', 'timus', 50, '2023-12-06', 'admin');
INSERT INTO `konten` (`id_konten`, `judul`, `keterangan`, `foto`, `slug`, `id_kategori`, `tanggal`, `username`) VALUES
(37, 'SPLDV', '<p><strong>Sistem persamaan linear dua variabel (SPLDV)</strong>&nbsp;adalah pasangan dari dua nilai peubah x atau y yang ekuivalen dengan bentuk umumnya yang mempunyai pasangan terurut (xo, yo). Bentuk umum dari SPLDV adalah sebagai berikut :&nbsp;</p>\r\n<p>ax + by = p</p>\r\n<p>cx + dy = q</p>\r\n<p>Sedangkan solusi dari hasil bentuk umum di atas disebut (xo,yo) disebut&nbsp;<strong>himpunan penyelesaiannya.&nbsp;</strong>Contoh SPLDV adalah sebagai berikut :&nbsp;</p>\r\n<p>3x + 2y = 10</p>\r\n<p>9x &ndash; 7y = 43</p>\r\n<p>Dan Himpunan Penyelesaiannya adalah {(x,y) (4,-1)}.</p>\r\n<h3><span id=\"1_Metode_Grafik\"><strong>1. Metode Grafik</strong>&nbsp;</span></h3>\r\n<p><strong>Metode grafik</strong>&nbsp;adalah menentukan titik potong antara dua persamaan garis sehingga di dapatkan himpunan penyelesaian dari persamaan linear dua variabel tersebut. Apabila diperoleh persamaan dua garis tersebut&nbsp;<strong>saling sejajar</strong>, maka himpunan penyelesaiannya adalah&nbsp;<strong>himpunan kosong</strong>. Sedangkan jika&nbsp;<strong>garisnya saling berhimpit</strong>&nbsp;maka&nbsp;<strong>jumlah himpunan penyelesaiannya tak berhingga</strong>. Langkah-langkah penyelesaian menggunakan metode grafik adalah sebagai berikut :&nbsp;</p>\r\n<ol>\r\n<li>Gambarkan grafik garis ax + by = p dan cx + dy = q pada sebuah sistem koordinat Cartesius. Pada langkah ini, kita harus menentukan titik potong sumbu X dan titik potong sumbu Y nya yaitu titik potong sumbu X saat y = 0 dan titik potong sumbu Y saat x = 0. Lalu kemudian hubungan kedua titik potong tersebut sehingga diperoleh garis persamaan.</li>\r\n<li>Tentukan koordinat titik potong kedua garis ax + by = p dan cx + dy = q (jika ada).</li>\r\n<li>Tuliskan himpunan penyelesainnya.</li>\r\n</ol>\r\n<p><strong>Contoh soal :</strong><br>Tentukan himpunan penyelesaian dibawah ini menggunakan metode grafik.</p>\r\n<p>2x &ndash; y = 2</p>\r\n<p>x + y = 4</p>\r\n<p><strong>Pembahasan :&nbsp;</strong></p>\r\n<p><img class=\"alignnone size-full wp-image-277643\" src=\"https://www.quipper.com/id/blog/wp-content/uploads/2019/11/Persamaan-Linear-Dua-Variabel-Matematika-Kelas-10-1.png\" sizes=\"(max-width: 444px) 100vw, 444px\" srcset=\"https://www.quipper.com/id/blog/wp-content/uploads/2019/11/Persamaan-Linear-Dua-Variabel-Matematika-Kelas-10-1.png 444w, https://www.quipper.com/id/blog/wp-content/uploads/2019/11/Persamaan-Linear-Dua-Variabel-Matematika-Kelas-10-1-300x168.png 300w\" alt=\"\" width=\"444\" height=\"248\"></p>\r\n<p>Titik potong kedua garis yang diperoleh adalah&nbsp;<strong>(2,2).</strong>&nbsp;Jadi himpunan penyelesaiannya dari sistem persamaan tersebut adalah&nbsp;<strong>(2,2).</strong></p>\r\n<p><strong>Contoh soal :</strong></p>\r\n<p>Tentukan himpunan penyelesaian dari sistem di bawah ini menggunakan metode grafik :&nbsp;</p>\r\n<p>x &ndash; y = 2</p>\r\n<p>2x &ndash; 2y = -4</p>\r\n<p><strong>Pembahasan :</strong>&nbsp;</p>\r\n<p><img class=\"alignnone size-full wp-image-277642\" src=\"https://www.quipper.com/id/blog/wp-content/uploads/2019/11/Persamaan-Linear-Dua-Variabel-Matematika-Kelas-10-2.png\" sizes=\"(max-width: 526px) 100vw, 526px\" srcset=\"https://www.quipper.com/id/blog/wp-content/uploads/2019/11/Persamaan-Linear-Dua-Variabel-Matematika-Kelas-10-2.png 526w, https://www.quipper.com/id/blog/wp-content/uploads/2019/11/Persamaan-Linear-Dua-Variabel-Matematika-Kelas-10-2-300x153.png 300w\" alt=\"\" width=\"526\" height=\"269\"></p>\r\n<p>Kedua garis yang dihasilkan ternyata&nbsp;<strong>saling sejajar</strong>, oleh sebab itu&nbsp;<strong>tidak ada titik potong</strong>&nbsp;yang di hasilkan. Jadi himpunan penyelesaiannya adalah&nbsp;<strong>himpunan kosong {&nbsp; }&nbsp;</strong>.&nbsp;</p>\r\n<p><strong>Contoh soal :</strong></p>\r\n<p>Tentukan himpunan penyelesaian dari sistem persamaan di bawah ini menggunakan metode grafik :&nbsp;</p>\r\n<p>x &ndash; y = -2</p>\r\n<p>2x &ndash; 2y = -4</p>\r\n<p><strong>Pembahasan :</strong>&nbsp;</p>\r\n<p><img class=\"alignnone size-full wp-image-277641\" src=\"https://www.quipper.com/id/blog/wp-content/uploads/2019/11/Persamaan-Linear-Dua-Variabel-Matematika-Kelas-10-3.png\" sizes=\"(max-width: 432px) 100vw, 432px\" srcset=\"https://www.quipper.com/id/blog/wp-content/uploads/2019/11/Persamaan-Linear-Dua-Variabel-Matematika-Kelas-10-3.png 432w, https://www.quipper.com/id/blog/wp-content/uploads/2019/11/Persamaan-Linear-Dua-Variabel-Matematika-Kelas-10-3-300x194.png 300w\" alt=\"\" width=\"432\" height=\"280\"></p>\r\n<p>Kedua garis yang dihasilkan ternyata&nbsp;<strong>saling berimpit</strong>. Maka himpunan penyelesaian dari sistem persamaan linear dua variabel tersebut&nbsp;<strong>tak berhingga banyaknya.</strong>&nbsp;</p>\r\n<p>Keunggulan dari metode grafik adalah kita dapat menentukan himpunan penyelesaiannya secara visual. Artinya&nbsp;<strong>hasilnya dapat diketahui secara langsung sekali lihat</strong>. Kelemahan dari metode grafik adalah&nbsp;<strong>tidak efektif untuk menyelesaikan soal untuk aplikasi SPLDV</strong>, tidak baik apabila angka yang ada pada persamaan linear dua variabel&nbsp;<strong>berbentuk desimal</strong>&nbsp;karena&nbsp;<strong>kelihatan tidak presisi</strong> pada media grafiknya.&nbsp;</p>', '20231201152913.jpg', 'spldv', 51, '2023-12-06', 'admin'),
(38, 'Pendudukan jepang di Indonesia dan Tanggapan Pergerakan Nasional', '<h2><strong>Pendudukan Jepang dan Tanggapan Pergerakan Nasional</strong></h2>\r\n<p><strong>A. Pendudukan Jepang di Indonesia:</strong><br>- Dimulai pada 11 Januari 1942, Jepang menduduki sejumlah kota strategis seperti Tarakan, Pontianak, Makassar, dan Palembang.<br>- Palembang dianggap penting karena letaknya di antara pusat kekuasaan Belanda (Batavia) dan wilayah Inggris (Singapura).<br>- Indonesia sepenuhnya berada di bawah kekuasaan Jepang sejak Maret 1942.<br>- Tujuan Jepang: menguasai sumber daya alam, terutama minyak bumi, untuk mendukung industri dan kampanye perang.</p>\r\n<p><strong>B. Tanggapan Tokoh Pergerakan Nasional:</strong><br>1. **Penerimaan Awal:**<br>&nbsp; &nbsp;- Beberapa tokoh seperti Sukarno, Hatta, dan Ki Hajar Dewantara menyambut baik kedatangan Jepang.<br>&nbsp; &nbsp;- Optimisme muncul dengan keyakinan bahwa kedatangan Jepang akan membawa kemerdekaan nantinya, seiring dengan janji jepang itu sendiri.</p>\r\n<p>2. **Alasan Optimisme:**<br>&nbsp; &nbsp;a. Menyerahnya Belanda dianggap akhir penjajahan, dimulainya era baru bagi bangsa Asia yang dipimpin Jepang.<br>&nbsp; &nbsp;b. Jepang berjanji memberikan kemerdekaan jika memenangkan Perang Pasifik dan menciptakan kemakmuran bersama di Asia.<br>&nbsp; &nbsp;c. Pembicaraan tentang kemerdekaan oleh Jepang membuat tokoh Indonesia bersedia bekerja sama.<br>&nbsp; &nbsp;d. Sikap simpatik Jepang terhadap aktivitas pergerakan nasional.<br>&nbsp; &nbsp;e. Jepang memberikan kemudahan seperti penggunaan bahasa Indonesia dan lagu kebangsaan \"Indonesia Raya\".</p>\r\n<p><strong>C. Realitas Dibalik Janji:</strong><br>- Rakyat awalnya tidak menyadari bahwa mereka dimanfaatkan untuk mendukung ambisi imperialisme Jepang, bukan untuk kemerdekaan sejati.<br>- Jepang memanfaatkan Indonesia untuk mendukung industrialisasi dan ambisi perangnya di Asia Timur Raya.</p>\r\n<p><strong>D. Kebijakan Ekonomi Jepang:</strong><br>Jepang mengambil alih ekonomi Indonesia untuk memenuhi kebutuhan perang mereka.Penggunaan romusha (tenaga kerja paksa) untuk proyek-proyek infrastruktur Jepang.</p>\r\n<p><strong>E. Kebijakan Sosial dan Budaya:</strong><br>Jepang memberlakukan kebijakan sosial dan budaya, seperti memaksa pemakaian bahasa Jepang, mengganti mata uang, dan mengganti sistem pendidikan.</p>\r\n<p><strong>F. Kekerasan dan Pemberontakan:</strong><br>Terjadi kekerasan dan penindasan terhadap penduduk Indonesia.Pemberontakan terjadi, seperti Pemberontakan PETA dan Pembela Tanah Air (PETA) di Blitar.</p>\r\n<p><strong>G. Dampak dan Legacy:</strong><br>Masa pendudukan Jepang meninggalkan dampak yang kompleks di Indonesia, memicu perubahan sosial dan politik yang akan memengaruhi jalan menuju kemerdekaan.</p>\r\n<h2><strong>Dampak Pendudukan Jepang di Indonesia:</strong></h2>\r\n<p><strong>A. Bidang Politik:</strong><br>- Pergantian pemerintahan kolonial Belanda dengan pemerintahan militer Jepang.<br>- Pembentukan organisasi-organisasi pergerakan yang kemudian memainkan peran penting dalam perjuangan kemerdekaan Indonesia.</p>\r\n<p><strong>B. Bidang Ekonomi:</strong><br>- Jepang menguasai ekonomi Indonesia untuk mendukung kebutuhan perangnya.<br>- Penggunaan romusha (tenaga kerja paksa) untuk proyek-proyek infrastruktur Jepang.</p>\r\n<p><strong>C. Bidang Sosial:</strong><br>- Perubahan sosial melalui kebijakan-kebijakan Jepang, termasuk pemberlakuan bahasa Jepang dan perubahan sistem pendidikan.<br>- Kondisi sosial yang memburuk akibat eksploitasi ekonomi dan kerja paksa.</p>\r\n<p><strong>D. Bidang Kebudayaan:</strong><br>- Pemberlakuan kebijakan-kebijakan kebudayaan Jepang, seperti penggantian mata uang dan kontrol terhadap media.<br>- Pengaruh budaya Jepang yang meninggalkan jejak dalam seni, mode, dan gaya hidup.</p>\r\n<p><strong>Dampak keseluruhan:</strong><br>- Membawa perubahan yang kompleks dalam struktur dan dinamika masyarakat Indonesia.<br>- Memengaruhi jalannya perjuangan menuju kemerdekaan Indonesia setelah Perang Dunia II.</p>\r\n<p>&nbsp;</p>\r\n<h2><strong>Perjuangan Meraih Kemerdekaan pada Masa Pendudukan Jepang:</strong></h2>\r\n<p><strong>A. Perjuangan Kooperatif:</strong><br>- Pihak-pihak terlibat dalam cara kooperatif, seperti Bung Hatta, Soekarno, dan Ki Hajar Dewantara, berusaha bekerja sama dengan pemerintah Jepang dalam upaya memperoleh kemerdekaan.<br>- Menyusun strategi diplomasi dan pendekatan yang bersifat kooperatif untuk memperoleh kemerdekaan.</p>\r\n<p><strong>B. Perjuangan Melalui Gerakan Bawah Tanah:</strong><br>- Terbentuknya organisasi-organisasi pergerakan bawah tanah, seperti PETA dan Barisan Pelopor, yang bertujuan melalui jalur organisasi untuk mencapai kemerdekaan.<br>- Kegiatan perlawanan tanpa kekerasan, seperti propaganda dan sabotase terhadap pemerintahan Jepang.</p>\r\n<p><strong>C. Perlawanan Bersenjata:</strong><br>- Terjadinya perlawanan bersenjata di beberapa daerah, seperti Pemberontakan PETA di Blitar, yang mencoba melawan Jepang secara langsung.<br>- Meskipun tidak merata, beberapa kelompok bersenjata mencoba menghadapi pendudukan Jepang secara langsung melalui konflik bersenjata.&nbsp;</p>\r\n<p><strong>Dampak keseluruhan:</strong><br>- Perjuangan yang beragam dengan berbagai metode, dari diplomasi hingga perlawanan bersenjata, membentuk kerangka kerja perjuangan untuk mencapai kemerdekaan Indonesia.</p>', 'BukuAntikKulitSapiMenggamba.jpg', 'pendudukan-jepang-di-indonesia-dan-tanggapan-pergerakan-nasional', 49, '2023-12-06', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_user`
--

CREATE TABLE `log_user` (
  `id_log` int(11) NOT NULL,
  `pengguna` varchar(24) NOT NULL,
  `tanggal` datetime NOT NULL,
  `aktivitas` enum('Telah melakukan Login','Telah melakukan Logout') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_user`
--

INSERT INTO `log_user` (`id_log`, `pengguna`, `tanggal`, `aktivitas`) VALUES
(74, 'zaid(7)', '2023-10-06 14:27:50', 'Telah melakukan Logout'),
(75, 'zaid(7)', '2023-10-06 14:29:01', 'Telah melakukan Logout'),
(76, 'admin(1)', '2023-10-06 14:29:16', 'Telah melakukan Login'),
(77, 'admin(1)', '2023-10-06 18:03:24', 'Telah melakukan Login'),
(78, 'admin(1)', '2023-10-07 04:21:30', 'Telah melakukan Login'),
(79, 'admin(1)', '2023-10-07 07:10:55', 'Telah melakukan Login'),
(80, 'admin(1)', '2023-10-08 00:47:07', 'Telah melakukan Login'),
(81, 'admin(1)', '2023-10-08 12:24:45', 'Telah melakukan Login'),
(82, 'admin(1)', '2023-10-08 12:25:01', 'Telah melakukan Logout'),
(83, 'zaid(7)', '2023-10-08 12:25:15', 'Telah melakukan Logout'),
(84, 'zaid(7)', '2023-10-08 12:27:37', 'Telah melakukan Logout'),
(85, 'admin(1)', '2023-10-08 12:27:47', 'Telah melakukan Login'),
(86, 'admin(1)', '2023-10-08 23:26:48', 'Telah melakukan Login'),
(87, 'admin(1)', '2023-10-09 07:59:40', 'Telah melakukan Login'),
(88, 'admin(1)', '2023-10-09 13:59:13', 'Telah melakukan Login'),
(89, 'admin(1)', '2023-10-10 11:09:30', 'Telah melakukan Login'),
(90, 'admin(1)', '2023-10-10 12:06:35', 'Telah melakukan Logout'),
(91, 'admin(1)', '2023-10-11 04:57:02', 'Telah melakukan Login'),
(92, 'admin(1)', '2023-10-11 05:19:49', 'Telah melakukan Logout'),
(93, 'admin(1)', '2023-10-11 12:46:58', 'Telah melakukan Login'),
(94, 'admin(1)', '2023-10-11 12:47:36', 'Telah melakukan Logout'),
(95, 'admin(1)', '2023-10-12 00:59:34', 'Telah melakukan Login'),
(96, 'admin(1)', '2023-10-12 01:01:28', 'Telah melakukan Logout'),
(97, 'admin(1)', '2023-10-17 14:35:34', 'Telah melakukan Login'),
(98, 'admin(1)', '2023-10-17 14:38:23', 'Telah melakukan Logout'),
(99, 'admin(1)', '2023-10-17 15:02:09', 'Telah melakukan Login'),
(100, 'admin(1)', '2023-10-17 16:02:57', 'Telah melakukan Logout'),
(101, 'mamadidun(16)', '2023-10-17 16:03:10', 'Telah melakukan Logout'),
(102, 'mamadidun(16)', '2023-10-17 16:03:22', 'Telah melakukan Logout'),
(103, 'admin(1)', '2023-10-17 16:04:03', 'Telah melakukan Login'),
(104, 'admin(1)', '2023-10-17 16:05:02', 'Telah melakukan Logout'),
(105, 'admin(1)', '2023-10-17 16:06:13', 'Telah melakukan Login'),
(106, 'admin(1)', '2023-10-17 16:14:52', 'Telah melakukan Logout'),
(107, 'admin(1)', '2023-10-20 07:59:59', 'Telah melakukan Login'),
(108, 'admin(1)', '2023-10-20 08:18:24', 'Telah melakukan Logout'),
(109, 'admin(1)', '2023-10-23 00:19:37', 'Telah melakukan Login'),
(110, 'admin(1)', '2023-10-23 07:18:01', 'Telah melakukan Login'),
(111, 'admin(1)', '2023-10-24 12:31:24', 'Telah melakukan Login'),
(112, 'admin(1)', '2023-10-26 04:19:50', 'Telah melakukan Login'),
(113, 'admin(1)', '2023-10-27 14:03:34', 'Telah melakukan Login'),
(114, 'admin(1)', '2023-10-27 14:14:51', 'Telah melakukan Logout'),
(115, 'admin(1)', '2023-10-28 10:50:21', 'Telah melakukan Login'),
(116, 'admin(1)', '2023-10-29 08:14:16', 'Telah melakukan Login'),
(117, 'admin(1)', '2023-10-30 12:55:16', 'Telah melakukan Login'),
(118, 'admin(1)', '2023-10-30 21:56:54', 'Telah melakukan Login'),
(119, 'admin(1)', '2023-10-31 10:29:22', 'Telah melakukan Login'),
(120, 'admin(1)', '2023-10-31 23:42:50', 'Telah melakukan Login'),
(121, 'admin(1)', '2023-11-01 15:13:47', 'Telah melakukan Login'),
(122, 'admin(1)', '2023-11-01 23:26:24', 'Telah melakukan Login'),
(123, 'admin(1)', '2023-11-02 11:05:49', 'Telah melakukan Login'),
(124, 'admin(1)', '2023-11-02 18:32:37', 'Telah melakukan Login'),
(125, 'admin(1)', '2023-11-02 22:50:51', 'Telah melakukan Login'),
(126, 'admin(1)', '2023-11-03 10:35:44', 'Telah melakukan Login'),
(127, 'admin(1)', '2023-11-03 15:39:53', 'Telah melakukan Login'),
(128, 'admin(1)', '2023-11-04 01:00:11', 'Telah melakukan Login'),
(129, 'admin(20)', '2023-11-04 06:07:51', 'Telah melakukan Login'),
(130, 'admin(20)', '2023-11-04 12:40:46', 'Telah melakukan Login'),
(131, 'admin(20)', '2023-11-04 23:45:21', 'Telah melakukan Login'),
(132, '()', '2023-11-05 11:57:49', 'Telah melakukan Logout'),
(133, 'admin(20)', '2023-11-05 12:33:09', 'Telah melakukan Login'),
(134, 'admin(20)', '2023-11-06 10:40:35', 'Telah melakukan Login'),
(135, 'admin(20)', '2023-11-06 16:03:51', 'Telah melakukan Login'),
(136, 'admin(20)', '2023-11-07 23:19:35', 'Telah melakukan Login'),
(137, 'admin(20)', '2023-11-09 12:20:09', 'Telah melakukan Login'),
(138, 'admin(20)', '2023-11-11 04:33:22', 'Telah melakukan Login'),
(139, 'admin(20)', '2023-11-11 11:03:07', 'Telah melakukan Login'),
(140, 'admin(20)', '2023-11-11 23:29:28', 'Telah melakukan Login'),
(141, 'admin(20)', '2023-11-12 01:34:58', 'Telah melakukan Login'),
(142, 'admin(20)', '2023-11-12 12:15:08', 'Telah melakukan Login'),
(143, 'admin(20)', '2023-11-12 23:50:07', 'Telah melakukan Login'),
(144, 'admin(20)', '2023-11-13 10:32:56', 'Telah melakukan Login'),
(145, 'admin(20)', '2023-11-14 21:46:08', 'Telah melakukan Login'),
(146, 'admin(20)', '2023-11-15 23:40:20', 'Telah melakukan Login'),
(147, 'admin(20)', '2023-11-16 11:05:16', 'Telah melakukan Login'),
(148, 'admin(20)', '2023-11-21 23:34:03', 'Telah melakukan Login'),
(149, 'admin(20)', '2023-11-22 03:07:31', 'Telah melakukan Logout'),
(150, 'zaid(7)', '2023-11-22 03:07:39', 'Telah melakukan Logout'),
(151, 'zaid(7)', '2023-11-22 03:12:44', 'Telah melakukan Logout'),
(152, 'admin(20)', '2023-11-22 03:12:54', 'Telah melakukan Login'),
(153, 'admin(20)', '2023-11-22 10:19:51', 'Telah melakukan Login'),
(154, 'admin(20)', '2023-11-22 13:26:50', 'Telah melakukan Login'),
(155, 'admin(20)', '2023-11-22 23:17:58', 'Telah melakukan Login'),
(156, 'admin(20)', '2023-11-23 05:12:00', 'Telah melakukan Login'),
(157, 'admin(20)', '2023-11-26 01:43:16', 'Telah melakukan Login'),
(158, 'admin(20)', '2023-11-26 04:37:18', 'Telah melakukan Login'),
(159, 'admin(20)', '2023-11-28 08:47:31', 'Telah melakukan Login'),
(160, 'admin(20)', '2023-11-28 21:55:52', 'Telah melakukan Login'),
(161, 'admin(20)', '2023-11-28 21:56:27', 'Telah melakukan Logout'),
(162, 'admin(20)', '2023-11-28 22:23:55', 'Telah melakukan Login'),
(163, 'admin(20)', '2023-11-28 23:57:40', 'Telah melakukan Logout'),
(164, 'admin(20)', '2023-11-29 13:16:12', 'Telah melakukan Login'),
(165, 'admin(20)', '2023-11-29 23:33:49', 'Telah melakukan Login'),
(166, 'admin(20)', '2023-11-30 12:36:25', 'Telah melakukan Logout'),
(167, 'admin(20)', '2023-11-30 12:36:33', 'Telah melakukan Login'),
(168, 'admin(20)', '2023-11-30 13:00:45', 'Telah melakukan Logout'),
(169, 'admin(20)', '2023-11-30 13:46:46', 'Telah melakukan Login'),
(170, 'admin(20)', '2023-12-01 03:57:02', 'Telah melakukan Login'),
(171, 'admin(20)', '2023-12-01 12:15:02', 'Telah melakukan Login'),
(172, 'admin(20)', '2023-12-01 15:30:37', 'Telah melakukan Login'),
(173, 'admin(20)', '2023-12-02 23:59:12', 'Telah melakukan Login'),
(174, 'admin(20)', '2023-12-03 05:24:03', 'Telah melakukan Login'),
(175, '()', '2023-12-03 11:58:02', 'Telah melakukan Logout'),
(176, 'admin(20)', '2023-12-04 04:39:09', 'Telah melakukan Login'),
(177, 'admin(20)', '2023-12-04 08:39:35', 'Telah melakukan Login'),
(178, 'admin(20)', '2023-12-04 09:00:23', 'Telah melakukan Logout'),
(179, 'admin(20)', '2023-12-04 09:37:55', 'Telah melakukan Login'),
(180, 'admin(20)', '2023-12-04 17:16:50', 'Telah melakukan Login'),
(181, 'admin(20)', '2023-12-05 05:53:28', 'Telah melakukan Login'),
(182, '()', '2023-12-05 14:45:36', 'Telah melakukan Logout'),
(183, 'admin(20)', '2023-12-05 15:07:10', 'Telah melakukan Login'),
(184, 'admin(20)', '2023-12-05 15:35:20', 'Telah melakukan Logout'),
(185, 'admin(20)', '2023-12-05 16:13:59', 'Telah melakukan Login'),
(186, 'admin(20)', '2023-12-05 20:21:49', 'Telah melakukan Login'),
(187, 'admin(20)', '2023-12-05 23:14:09', 'Telah melakukan Logout'),
(188, 'zaid(7)', '2023-12-05 23:16:08', 'Telah melakukan Logout'),
(189, 'zaid(7)', '2023-12-05 23:45:53', 'Telah melakukan Logout'),
(190, 'admin(20)', '2023-12-05 23:46:28', 'Telah melakukan Login'),
(191, 'admin(20)', '2023-12-05 23:55:06', 'Telah melakukan Logout'),
(192, 'admin(20)', '2023-12-05 23:55:42', 'Telah melakukan Login'),
(193, 'admin(20)', '2023-12-06 05:22:13', 'Telah melakukan Login'),
(194, 'admin(20)', '2023-12-06 10:45:48', 'Telah melakukan Logout'),
(195, 'admin(20)', '2023-12-06 10:49:08', 'Telah melakukan Login'),
(196, 'admin(20)', '2023-12-06 11:11:26', 'Telah melakukan Logout'),
(197, 'admin(20)', '2023-12-06 11:15:57', 'Telah melakukan Login'),
(198, 'admin(20)', '2023-12-06 11:17:15', 'Telah melakukan Logout'),
(199, 'admin(20)', '2023-12-06 11:23:08', 'Telah melakukan Login'),
(200, 'admin(20)', '2023-12-06 11:25:09', 'Telah melakukan Logout'),
(201, 'admin(20)', '2023-12-06 11:40:52', 'Telah melakukan Login'),
(202, 'admin(20)', '2023-12-06 15:22:50', 'Telah melakukan Login');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nontifikasi`
--

CREATE TABLE `nontifikasi` (
  `id_nontifikasi` int(11) NOT NULL,
  `penerima_pesan_nontifikasi` varchar(24) NOT NULL,
  `Judul_pesan_nontifikasi` varchar(64) NOT NULL,
  `Isi_pesan_nontifikasi` text NOT NULL,
  `dibuat_pada` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `saran`
--

CREATE TABLE `saran` (
  `id_saran` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `email` varchar(37) NOT NULL,
  `saran` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saran`
--

INSERT INTO `saran` (`id_saran`, `nama`, `email`, `saran`, `tanggal`) VALUES
(3, 'ahmed', 'ahmed27552@yahoo.co.id', 'Kureng warnanya bang', '2023-12-05'),
(4, 'bang bro gantenggg', 'nailaaqila31@gmail.com', 'asekkk', '2023-12-05'),
(5, 'zaidunss', 'nailaaqila31@gmail.com', 'waduh kanggg', '2023-12-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(24) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `password` varchar(12) NOT NULL,
  `level` enum('Admin','Kontributor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nama`, `password`, `level`) VALUES
(7, 'zaid', 'zaid izzah nurbaain', 'zaidKontribu', 'Kontributor'),
(8, 'pardy', 'ardy saputros', 'promaxPardy', 'Admin'),
(10, 'admin2', 'admin ganteng n gelok', 'gelokituadmi', 'Admin'),
(11, 'lastKontibutor', 'kontrisamsunl', 'samsula12', 'Kontributor'),
(13, 'ana', 'nama aa pardikers', '11223', 'Kontributor'),
(15, 'pendol', 'pendolottok', 'pendolgayeng', 'Kontributor'),
(16, 'mamadidun', 'mamadGayeng', 'mamadkece', 'Kontributor'),
(20, 'admin', 'admin konten', 'adminkonten1', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indeks untuk tabel `caraousel`
--
ALTER TABLE `caraousel`
  ADD PRIMARY KEY (`id_caraousel`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indeks untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indeks untuk tabel `konten`
--
ALTER TABLE `konten`
  ADD PRIMARY KEY (`id_konten`);

--
-- Indeks untuk tabel `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `nontifikasi`
--
ALTER TABLE `nontifikasi`
  ADD PRIMARY KEY (`id_nontifikasi`);

--
-- Indeks untuk tabel `saran`
--
ALTER TABLE `saran`
  ADD PRIMARY KEY (`id_saran`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `captcha`
--
ALTER TABLE `captcha`
  MODIFY `captcha_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `caraousel`
--
ALTER TABLE `caraousel`
  MODIFY `id_caraousel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `konten`
--
ALTER TABLE `konten`
  MODIFY `id_konten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT untuk tabel `nontifikasi`
--
ALTER TABLE `nontifikasi`
  MODIFY `id_nontifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `saran`
--
ALTER TABLE `saran`
  MODIFY `id_saran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
