-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `activate_account`;
CREATE TABLE `activate_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `reset_pass_key` varchar(40) NOT NULL,
  `expiration` datetime NOT NULL,
  `used` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `activate_account` (`id`, `user`, `reset_pass_key`, `expiration`, `used`) VALUES
(1,	348,	'e9816a8ad009a68f4daa085da416d3',	'2020-04-03 04:56:49',	0),
(2,	348,	'6a353cd29c08e170e5da0fa7fa168a',	'2020-04-03 04:56:59',	1);

DROP TABLE IF EXISTS `grup`;
CREATE TABLE `grup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kuesioner` int(11) NOT NULL COMMENT 'kuesioner.id',
  `name` varchar(160) NOT NULL,
  `kode` varchar(30) NOT NULL,
  `urutan` int(11) NOT NULL,
  `parent_grup` int(11) NOT NULL COMMENT 'group.id yang kalo diisi, berarti ini bukan judul tab, tapi judul heading/separator aja',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tab/heading untuk mengelompokkan pertanyaan2 dalam suatu kuesioner';

INSERT INTO `grup` (`id`, `kuesioner`, `name`, `kode`, `urutan`, `parent_grup`) VALUES
(190,	2,	'Tata Kota',	'TK',	1,	0),
(191,	2,	'Sampah',	'S',	2,	0),
(192,	2,	'Air',	'A',	3,	0),
(193,	5,	'Kategori 1',	'K1',	1,	0),
(194,	5,	'Coba',	'CB',	2,	0),
(195,	6,	'Ekonomi',	'EK',	1,	0),
(196,	6,	'Energi',	'EN',	2,	0),
(197,	6,	'Air',	'A',	3,	0),
(198,	6,	'Air Limbah',	'AL',	4,	0),
(199,	6,	'Data Tambahan',	'DT',	5,	0),
(200,	7,	'Ekonomi',	'E',	0,	0),
(202,	7,	'Air',	'A',	0,	0),
(204,	7,	'Kesehatan',	'Kes',	0,	0),
(206,	7,	'Pendidikan',	'Pd',	0,	0),
(207,	7,	'Perencanaan Perkotaan',	'PP',	0,	0),
(208,	7,	'Populasi dan Kondisi Sosial',	'PKS',	0,	0),
(209,	7,	'Transportasi',	'T',	0,	0),
(210,	7,	'Data Tambahan',	'DT',	0,	0),
(211,	7,	'Air Limbah',	'AL',	0,	0);

DROP TABLE IF EXISTS `jawaban`;
CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL COMMENT 'users.id',
  `pertanyaan` int(11) NOT NULL COMMENT 'pertanyaan.id',
  `created` datetime DEFAULT NULL COMMENT 'tanggal pengisian',
  `history` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'menyimpan riwayat jawaban, dg format: "datetime:jawaban|datetime:jawaban|..."',
  `pengisi` enum('Tester','Reviewer','Kota','Admin') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `jawaban` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'tertangung jenis jawaban di pertanyaan ybs. angka-->isian user, teks-->isian user, enum-->jenis_jawaban_enum.id, multi-->array of jenis_jawaban_multi.id',
  `pesan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `date_attach` datetime DEFAULT NULL,
  `attachment` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='menyimpan jawaban user utk tiap pertanyaan';

INSERT INTO `jawaban` (`id`, `user`, `pertanyaan`, `created`, `history`, `pengisi`, `jawaban`, `pesan`, `date_attach`, `attachment`) VALUES
(44,	349,	52,	'2020-06-11 22:41:16',	'{\"2020-06-10 21:39:24\":\"\",\"2020-06-10 23:06:38\":\"\",\"2020-06-11 02:35:22\":\"\",\"2020-06-11 02:35:27\":\"\",\"2020-06-11 21:29:43\":\"\",\"2020-06-11 21:58:30\":\"\",\"2020-06-11 22:02:40\":\"\",\"2020-06-11 22:17:58\":\"\",\"2020-06-11 22:41:16\":\"\"}',	'Kota',	'',	'',	NULL,	''),
(45,	349,	53,	'2020-06-11 22:41:16',	'{\"2020-06-10 21:39:24\":\"1\",\"2020-06-10 23:06:38\":\"2\",\"2020-06-11 02:35:22\":\"2\",\"2020-06-11 02:35:27\":\"2\",\"2020-06-11 21:29:43\":\"2\",\"2020-06-11 21:58:30\":\"2\",\"2020-06-11 22:02:40\":\"2\",\"2020-06-11 22:17:58\":\"2\",\"2020-06-11 22:41:16\":\"2\"}',	'Kota',	'2',	'',	'2020-06-12 10:14:04',	'53-349.pdf'),
(46,	349,	54,	'2020-06-11 22:41:16',	'{\"2020-06-10 21:39:24\":\"[\\\"1\\\"]\",\"2020-06-10 23:06:38\":\"[\\\"2\\\"]\",\"2020-06-11 02:35:22\":\"[\\\"2\\\"]\",\"2020-06-11 02:35:27\":\"[\\\"2\\\"]\",\"2020-06-11 21:29:43\":\"[\\\"2\\\"]\",\"2020-06-11 21:58:30\":\"[\\\"2\\\"]\",\"2020-06-11 22:02:40\":\"[\\\"2\\\"]\",\"2020-06-11 22:17:58\":\"[\\\"2\\\"]\",\"2020-06-11 22:41:16\":\"[\\\"2\\\"]\"}',	'Kota',	'[\"2\"]',	'',	NULL,	''),
(47,	349,	82,	'2020-06-11 22:41:16',	'{\"2020-06-10 21:39:24\":\"satu\",\"2020-06-10 23:06:38\":\"dua\",\"2020-06-11 02:35:22\":\"dua asfadfa adsf\",\"2020-06-11 02:35:27\":\"dua asfadfa adsf\",\"2020-06-11 21:29:43\":\"dua asfadfa adsf\",\"2020-06-11 21:58:30\":\"dua asfadfa adsf\",\"2020-06-11 22:02:40\":\"dua asfadfa adsf\",\"2020-06-11 22:17:58\":\"dua asfadfa adsf\",\"2020-06-11 22:41:16\":\"dua dua\"}',	'Kota',	'dua dua',	'',	NULL,	''),
(48,	349,	83,	'2020-06-11 22:41:16',	'{\"2020-06-10 21:39:24\":\"[]\",\"2020-06-10 23:06:38\":\"[\\\"2\\\"]\",\"2020-06-11 02:35:22\":\"[\\\"2\\\"]\",\"2020-06-11 02:35:27\":\"[\\\"1\\\",\\\"2\\\"]\",\"2020-06-11 21:29:43\":\"[\\\"1\\\",\\\"2\\\"]\",\"2020-06-11 21:58:30\":\"[\\\"1\\\",\\\"2\\\"]\",\"2020-06-11 22:02:40\":\"[\\\"1\\\",\\\"2\\\"]\",\"2020-06-11 22:17:58\":\"[\\\"1\\\",\\\"2\\\"]\",\"2020-06-11 22:41:16\":\"[\\\"1\\\",\\\"2\\\"]\"}',	'Kota',	'[\"1\",\"2\"]',	'',	NULL,	''),
(49,	349,	51,	'2020-06-11 22:41:16',	'{\"2020-06-10 21:39:24\":\"\",\"2020-06-10 23:06:38\":\"\",\"2020-06-11 02:35:22\":\"\",\"2020-06-11 02:35:27\":\"\",\"2020-06-11 21:29:43\":\"\",\"2020-06-11 21:58:30\":\"\",\"2020-06-11 22:02:40\":\"\",\"2020-06-11 22:17:58\":\"\",\"2020-06-11 22:41:16\":\"\"}',	'Kota',	'',	'',	NULL,	'');

DROP TABLE IF EXISTS `jawaban_final`;
CREATE TABLE `jawaban_final` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kuesioner` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `date` datetime NOT NULL COMMENT 'tanggal kapan ini dibuat final.',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='menyimpan id kuesioner dan user yg jawabannya sudah final.';

INSERT INTO `jawaban_final` (`id`, `kuesioner`, `user`, `date`) VALUES
(5,	2,	349,	'2020-06-12 10:41:18');

DROP TABLE IF EXISTS `jenis_jawaban_angka`;
CREATE TABLE `jenis_jawaban_angka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` int(11) NOT NULL COMMENT 'pertanyaan.id',
  `hint` text NOT NULL COMMENT 'teks untuk ditampilkan sebagai tooltip untuk guide/bantuan bagi user',
  `min` float DEFAULT NULL,
  `max` float DEFAULT NULL,
  `decimal_place` int(11) NOT NULL DEFAULT '0' COMMENT 'jumlah angka di belakang koma. bila 0 berarti angka bulat',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `jenis_jawaban_angka` (`id`, `pertanyaan`, `hint`, `min`, `max`, `decimal_place`) VALUES
(10,	50,	'',	0,	100,	2),
(11,	53,	'Ini ceritanya hint',	5,	15,	2),
(12,	43,	'',	NULL,	NULL,	0);

DROP TABLE IF EXISTS `jenis_jawaban_enum`;
CREATE TABLE `jenis_jawaban_enum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` int(11) NOT NULL COMMENT 'pertanyaan.id',
  `urutan` int(11) DEFAULT NULL,
  `teks` text NOT NULL COMMENT 'sebenarnya teks yg tampil bisa digenerate oleh sistem berdasarkan inputan user di min_border, min, max_border, dan max.. kalo field ini diisi, teks akan dioverride dengan teks yg di sini',
  `hint` text NOT NULL COMMENT 'teks untuk ditampilkan sebagai tooltip untuk guide/bantuan bagi user',
  `min_border` enum('>','>=','<','<=') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `min` float DEFAULT NULL,
  `max_border` enum('>','>=','<','<=') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `max` float DEFAULT NULL,
  `persentase` float DEFAULT NULL COMMENT '0-100, tanpa tanda persen. bila user memilih opsi ini, di soal ybs user ini akan mendapat skor sebanyak = pertanyaan.skor * jenis_jawaban_enum.persentase',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tiap entry adalah opsi jawaban dalam suatu pertanyaan';

INSERT INTO `jenis_jawaban_enum` (`id`, `pertanyaan`, `urutan`, `teks`, `hint`, `min_border`, `min`, `max_border`, `max`, `persentase`) VALUES
(18,	54,	1,	'kurang dari 1%',	'',	'<',	1,	'<',	1,	0),
(19,	54,	2,	'dari 1% hingga kurang dari 3%',	'',	'>=',	1,	'<',	3,	30),
(20,	54,	3,	'dari 3% hingga kurang dari 5%',	'',	'>=',	3,	'<',	5,	75),
(21,	54,	4,	'5% ke atas',	'',	'>=',	5,	'>=',	5,	100),
(22,	53,	4,	'5% ke atas',	'',	'>=',	5,	'>=',	5,	100),
(24,	42,	NULL,	'',	'',	NULL,	NULL,	NULL,	NULL,	NULL),
(26,	83,	1,	'<p>\n	Sekitar 1 Km</p>\n',	'',	NULL,	NULL,	NULL,	NULL,	50),
(27,	83,	2,	'<p>\n	Sekitar 5 Km</p>\n',	'',	NULL,	NULL,	NULL,	NULL,	100),
(28,	41,	1,	'Ini adalah contoh',	'',	NULL,	NULL,	NULL,	NULL,	NULL);

DROP TABLE IF EXISTS `kuesioner`;
CREATE TABLE `kuesioner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(160) NOT NULL,
  `kode` varchar(160) NOT NULL COMMENT 'singkatan',
  `status` enum('open','closed','draft') NOT NULL COMMENT 'aktif:bisa diisi user, inactive: tidak bisa diisi namun riwayat pengisian yg pernah dilakukan dapat dilihat (read only), hidden: tidak dapat dilihat, diedit, ataupun diisi oleh user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `kuesioner` (`id`, `name`, `kode`, `status`) VALUES
(2,	'Self Assessment 2021',	'q2021',	'open'),
(5,	'Self Assessment 2021 - Indonesia Timur',	'q2021t',	'closed'),
(6,	'Tes12Mei2020',	'Tes1',	'draft'),
(7,	'Tes 05152020',	'T2',	'draft');

DROP TABLE IF EXISTS `nilai`;
CREATE TABLE `nilai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kota_kabupaten` varchar(30) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `nilai` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `pertanyaan`;
CREATE TABLE `pertanyaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grup` int(11) NOT NULL COMMENT 'grup.id',
  `urutan` int(11) NOT NULL COMMENT 'urutan ditampilkan dalam satu grup',
  `kode` varchar(30) NOT NULL COMMENT 'kode pertanyaan, utk keperluan administasi',
  `teks` text NOT NULL COMMENT 'teks pertanyaan. teks dg format HTML',
  `jenis_jawaban` enum('Teks Pendek','Teks Panjang','Teks Panjang, HTML','Radio','Checklist','Angka') NOT NULL COMMENT 'angka, enum, multi, teks',
  `hint` text NOT NULL COMMENT 'petunjuk untuk user. teks dg format HTML',
  `visibility` enum('show','hidden') NOT NULL DEFAULT 'show' COMMENT 'dibutuhkan karena ada pertanyaan luas bangunan dan luas taman yg harus diisi user. tapi yg dinilai sebenarnya rasio luas bangunan terhadap taman. rasio ini ga usah diiisi user, jadi hidden saja',
  `lampiran` tinytext NOT NULL COMMENT 'file location',
  `wajib` enum('ya','tidak') NOT NULL DEFAULT 'tidak',
  `formula` varchar(600) NOT NULL COMMENT 'isinya id_pertanyaan dan operator *+-/%() dan angka. hasil formula ini yg nantinya akan dikalikan dg pertanyaan.score dan dijumlah dg score dari pertanyaan2 lain untuk menjadi total score. input user mesti diamankan agar tidak error/jadi SQL injection',
  `show_if` varchar(600) NOT NULL COMMENT 'isinya id_pertanyaan dan operator ''&=><|()+-*/% dan teks dan angka. id_pertanyaan harus milik pertanyaan yg ada di group yang ditampilkan sebelumnya. input user mesti diamankan agar tidak error/jadi SQL injection',
  `max_score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `pertanyaan` (`id`, `grup`, `urutan`, `kode`, `teks`, `jenis_jawaban`, `hint`, `visibility`, `lampiran`, `wajib`, `formula`, `show_if`, `max_score`) VALUES
(51,	191,	1,	'S1',	'<p>\r\n	Rerata total berat sampah per hari</p>\r\n',	'Angka',	'',	'show',	'',	'tidak',	'<p>\r\n	0</p>\r\n',	'<p>\r\n	0</p>\r\n',	0),
(52,	190,	1,	'TK1',	'<p>\n	Luas kota</p>\n',	'Angka',	'<p>\n	Dalam Km<sup>2</sup>, gunakan titik untuk desimal, tanpa pembagi ribuan. Contoh:&nbsp;<em>12345.012</em></p>\n',	'show',	'test-2.pdf',	'tidak',	'',	'',	0),
(53,	190,	2,	'TK2',	'<p>\r\n	Luas area resapan</p>\r\n',	'Angka',	'<p>\r\n	Dalam Km<sup>2</sup>, gunakan titik untuk desimal, tanpa pembagi ribuan. Contoh: <em>12345.012</em></p>\r\n',	'show',	'test-2.pdf',	'ya',	'',	'',	0),
(54,	190,	3,	'TK3',	'<p>\n	Persentase Area Resapan&nbsp;</p>\n',	'Radio',	'',	'hidden',	'',	'',	'<p>\n	100*TK.TK2/TK.TK1</p>\n',	'',	20),
(56,	194,	1,	'QQ1',	'<p>\n	Jumlah ajudan walikota/bupati</p>\n',	'Angka',	'<p>\n	satuan: orang</p>\n',	'show',	'',	'ya',	'',	'',	10),
(57,	195,	3,	'3',	'<p>\n	Tingkat pengangguran perkotaan</p>\n',	'Angka',	'<p>\n	Angka pengangguran dibagi jumlah angkatan kerja</p>\n',	'hidden',	'',	'',	'',	'',	0),
(58,	195,	1,	'1',	'<p>\n	Jumlah angkatan kerja</p>\n',	'Angka',	'',	'show',	'',	'ya',	'',	'',	0),
(59,	195,	2,	'2',	'<p>\n	Jumlah pengangguran</p>\n',	'Angka',	'',	'show',	'',	'ya',	'',	'',	0),
(60,	197,	1,	'1',	'<p>\n	Akses air</p>\n',	'Angka',	'<p>\n	Persentase penduduk dengan akses air</p>\n',	'show',	'',	'ya',	'',	'',	0),
(61,	198,	1,	'1',	'<p>\n	Sanitasi</p>\n',	'Angka',	'<p>\n	Persentase penduduk dengan akses terhadap sanitasi yang sudah diperbaiki</p>\n',	'show',	'',	'ya',	'',	'',	0),
(62,	199,	1,	'1',	'<p>\n	Total penerimaan daerah</p>\n',	'Angka',	'<p>\n	dalam juta rupiah</p>\n',	'show',	'',	'ya',	'',	'',	0),
(63,	199,	2,	'2',	'<p>\n	Total PAD</p>\n',	'Angka',	'<p>\n	dalam juta rupiah</p>\n',	'show',	'',	'ya',	'',	'',	0),
(64,	199,	3,	'3',	'<p>\n	Persentase PAD</p>\n',	'Angka',	'<p>\n	Total PAD dibagi penerimaan daerah</p>\n',	'hidden',	'',	'',	'',	'',	0),
(65,	199,	4,	'4',	'<p>\n	Akses listrik</p>\n',	'Angka',	'<p>\n	Persentase penduduk dengan akses terhadap listrik</p>\n',	'show',	'',	'ya',	'',	'',	0),
(66,	202,	0,	'',	'<p>\r\n	akses air</p>\r\n',	'Angka',	'<p>\r\n	% penduduk dengan akses air&nbsp;</p>\r\n',	'show',	'',	'tidak',	'',	'',	0),
(67,	211,	0,	'',	'<p>\r\n	sanitasi</p>\r\n',	'Angka',	'<p>\r\n	Persentase penduduk dengan akses terhadap sanitasi yang sudah diperbaiki</p>\r\n',	'show',	'',	'tidak',	'',	'',	0),
(68,	210,	0,	'',	'<p>\n	akses listrik</p>\n',	'Angka',	'<p>\n	% penduduk dengan akses listrik</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(69,	200,	0,	'',	'<p>\n	GROWH</p>\n',	'Angka',	'<p>\n	Pertumbuhan ekonomi (pertumbuhan PDB)</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(70,	200,	0,	'',	'<p>\n	pengeluaran perkapita</p>\n',	'Angka',	'<p>\n	Pengeluaran Perkapita (Rp)</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(71,	204,	0,	'',	'<p>\n	Jumlah Dokter</p>\n',	'Angka',	'<p>\n	Jumlah Dokter per 1000 peduduk</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(72,	204,	0,	'',	'<p>\n	Jumlah Bidan</p>\n',	'Angka',	'<p>\n	Jumlah Bidan per 1000 peduduk</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(73,	204,	0,	'',	'<p>\n	Angka Harapan Hidup</p>\n',	'Angka',	'<p>\n	Angka Harapan Hidup</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(74,	206,	0,	'',	'<p>\n	net enrollment rate tingkat SD (%)</p>\n',	'Angka',	'<p>\n	Persentase populasi usia sekolah yang terdaftar di sekolah dasar</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(75,	206,	0,	'',	'<p>\r\n	net enrollment rate tingkat SMP (%)</p>\r\n',	'Angka',	'<p>\r\n	Persentase populasi usia sekolah yang terdaftar di sekolah dasar</p>\r\n',	'show',	'',	'tidak',	'',	'',	0),
(76,	206,	0,	'',	'<p>\r\n	net enrollment rate tingkat SMA (%)</p>\r\n',	'Angka',	'<p>\r\n	Persentase populasi usia sekolah yang terdaftar di sekolah dasar</p>\r\n',	'show',	'',	'tidak',	'',	'',	0),
(77,	206,	0,	'',	'<p>\r\n	angka harapan lama sekolah</p>\r\n',	'Angka',	'<p>\r\n	angka harapan lama sekolah</p>\r\n',	'show',	'',	'tidak',	'',	'',	0),
(78,	206,	0,	'',	'<p>\r\n	rata-rata lama sekolah</p>\r\n',	'Angka',	'<p>\r\n	angka rata-rata lama sekolah</p>\r\n',	'show',	'',	'tidak',	'',	'',	0),
(79,	207,	0,	'',	'<p>\n	Ruang terbuka hijau&nbsp;</p>\n',	'Angka',	'<p>\n	persentase ruang terbuka hijau&nbsp;</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(80,	208,	0,	'',	'<p>\n	%kemiskinan</p>\n',	'Angka',	'<p>\n	persentase populasi perkotaan yang hidup dibawah garis kemiskinan nasional</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(81,	209,	0,	'',	'<p>\n	% jalan yang diaspal</p>\n',	'Angka',	'<p>\n	persentase jalan yang diaspal</p>\n',	'show',	'',	'tidak',	'',	'',	0),
(82,	190,	4,	'TK4',	'<p>\n	Rerata jarak antar lampu merah</p>\n',	'Teks Pendek',	'',	'show',	'',	'ya',	'',	'',	0),
(83,	190,	5,	'TK5',	'<p>\r\n	Rerata jarak antar rumah sakit terdekat</p>\r\n',	'Checklist',	'',	'show',	'',	'tidak',	'',	'',	0);

DROP TABLE IF EXISTS `reset_account`;
CREATE TABLE `reset_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `reset_pass_key` varchar(40) NOT NULL,
  `expiration` datetime NOT NULL,
  `used` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'kalo udh reset password, maka akan jadi 1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ini kayanya ga kepake';

INSERT INTO `reset_account` (`id`, `user`, `reset_pass_key`, `expiration`, `used`) VALUES
(4,	31,	'61',	'2019-11-06 15:22:17',	0),
(5,	31,	'0',	'2019-11-06 15:23:23',	0),
(6,	31,	'6293927676ad7e4112b7bcf1adf904',	'2019-11-06 15:25:58',	0),
(7,	31,	'61f348dbfc99215070417b9d49da66',	'2019-11-16 11:00:00',	0),
(8,	31,	'ba00aa838a860ed2b972588ca0de1b',	'2019-11-16 11:30:13',	0),
(9,	7,	'2b656a60e22f12f0b84328d3ea4f05',	'2020-01-14 09:10:31',	0),
(10,	7,	'f98f139fec22f48c2b6ab9b8122823',	'2020-01-14 09:13:22',	0),
(11,	51,	'a9b965daa89a77d82532b919b4b672',	'2020-02-14 15:35:29',	1),
(12,	55,	'fd524e7073dda606a1689072b89bc3',	'2020-02-21 11:11:42',	0),
(13,	56,	'04803dfc72918feb86a495149b25b6',	'2020-02-21 11:12:49',	0),
(14,	57,	'3beeea01eb839e889cbbd824de3eaf',	'2020-02-21 11:18:38',	1),
(15,	342,	'1952a185302b9aa8103e4166b10e7d',	'2020-04-03 13:18:15',	1),
(16,	345,	'1c6d14b76b19c5f30b8afa56c6168a',	'2020-04-03 04:14:05',	1),
(17,	346,	'afe3ac96338b47eec2af264f7505b4',	'2020-04-03 04:23:05',	1),
(18,	347,	'ab5482430330b5059aab02f1d469fc',	'2020-04-03 04:37:23',	0),
(19,	347,	'c6f67e4de9b8d65108013947ba400e',	'2020-04-03 04:38:42',	1),
(20,	348,	'ab329c979c54be9eca9747819672b9',	'2020-04-03 05:43:28',	1),
(21,	348,	'bf251723b9b73b5243d67823e2d46e',	'2020-04-03 05:48:45',	1),
(22,	348,	'8f17f324200164df5571ecf2d8f23b',	'2020-04-03 05:51:44',	1);

DROP TABLE IF EXISTS `review_assignment`;
CREATE TABLE `review_assignment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kuesioner` int(11) NOT NULL COMMENT 'kuesioner.id',
  `user` int(11) NOT NULL COMMENT 'users.id',
  `reviewer` int(11) NOT NULL COMMENT 'users.id',
  `ronde` int(11) NOT NULL COMMENT '1,2,3 dst.',
  `assigned` datetime NOT NULL,
  `done` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT=' ';


DROP TABLE IF EXISTS `sendmail_log`;
CREATE TABLE `sendmail_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` tinytext NOT NULL,
  `subject` tinytext NOT NULL,
  `body` text NOT NULL,
  `time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` text NOT NULL COMMENT 'baru ditambah: kosong. terkirim: sent, gagal: pesan erronya',
  `time_sent` datetime NOT NULL COMMENT 'waktu dimana pesan ini terkirim',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sendmail_log` (`id`, `to`, `subject`, `body`, `time`, `status`, `time_sent`) VALUES
(1,	'indokan1945@gmail.com',	'[APPNAME] User Account Password Reset',	'Someone requested to reset the password for an account associated with this email. Please follow this link to reset your password at <b>ABCD</b> or <b>PSB CCIT</b>. This link will remain active 24 hours from now.<br><br>If you do not want to reset your password, please ignore this email.<br><br>http://localhost/Login/confirm/3e34f2750edbb46467a1aee149668f<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 13:07:26',	'',	'0000-00-00 00:00:00'),
(2,	'indokan1945@gmail.com',	'[APPNAME] User Account Password Reset',	'Someone requested to reset the password for an account associated with this email. Please follow this link to reset your password at <b>ABCD</b> or <b>PSB CCIT</b>. This link will remain active 24 hours from now.<br><br>If you do not want to reset your password, please ignore this email.<br><br>http://localhost/Login/confirm/1952a185302b9aa8103e4166b10e7d<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 13:18:15',	'',	'0000-00-00 00:00:00'),
(3,	'indokan1945@gmail.com',	'User Account Password Reset',	'Someone requested to reset the password for an account associated with this email. Please follow this link to reset your password at <b>ABCD</b> or <b>PSB CCIT</b>. This link will remain active 24 hours from now.<br><br>If you do not want to reset your password, please ignore this email.<br><br>http://localhost:8080/index.php/Login/confirm/1c6d14b76b19c5f30b8afa56c6168a<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 04:14:05',	'',	'0000-00-00 00:00:00'),
(4,	'indokan1945@gmail.com',	'User Account Password Reset',	'Someone has used your email to create an account on <b>ABCD</b> or <b>PSB CCIT</b>. Please click the link below to activate the account. This link will remain active 24 hours from now.<br><br>If you did not create an account, please ignore this email.<br><br>http://localhost:8080/index.php/Login/activate/afe3ac96338b47eec2af264f7505b4<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 04:23:05',	'',	'0000-00-00 00:00:00'),
(5,	'indokan1945@gmail.com',	'User Account Password Reset',	'Someone has used your email to create an account on <b>ABCD</b> or <b>PSB CCIT</b>. Please click the link below to activate the account. This link will remain active 24 hours from now.<br><br>If you did not create an account, please ignore this email.<br><br>http://localhost:8080/index.php/Login/activate/ab5482430330b5059aab02f1d469fc<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 04:37:23',	'',	'0000-00-00 00:00:00'),
(6,	'indokan1945@gmail.com',	'User Account Password Reset',	'Someone has used your email to create an account on <b>ABCD</b> or <b>PSB CCIT</b>. Please click the link below to activate the account. This link will remain active 24 hours from now.<br><br>If you did not create an account, please ignore this email.<br><br>http://localhost:8080/index.php/Login/activate/c6f67e4de9b8d65108013947ba400e<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 04:38:42',	'',	'0000-00-00 00:00:00'),
(7,	'indokan1945@gmail.com',	'User Account Password Reset',	'Someone has used your email to create an account on <b>ABCD</b> or <b>PSB CCIT</b>. Please click the link below to activate the account. This link will remain active 24 hours from now.<br><br>If you did not create an account, please ignore this email.<br><br>http://localhost:8080/index.php/Login/activate/e9816a8ad009a68f4daa085da416d3<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 04:56:49',	'',	'0000-00-00 00:00:00'),
(8,	'indokan1945@gmail.com',	'User Account Password Reset',	'Someone has used your email to create an account on <b>ABCD</b> or <b>PSB CCIT</b>. Please click the link below to activate the account. This link will remain active 24 hours from now.<br><br>If you did not create an account, please ignore this email.<br><br>http://localhost:8080/index.php/Login/activate/6a353cd29c08e170e5da0fa7fa168a<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 04:56:59',	'',	'0000-00-00 00:00:00'),
(9,	'indokan1945@gmail.com',	'User Account Password Reset',	'Someone requested to reset the password for an account associated with this email. Please follow this link to reset your password at <b>ABCD</b> or <b>PSB CCIT</b>. This link will remain active 24 hours from now.<br><br>If you do not want to reset your password, please ignore this email.<br><br>http://localhost:8080/index.php/Login/confirm/ab329c979c54be9eca9747819672b9<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 05:43:28',	'',	'0000-00-00 00:00:00'),
(10,	'indokan1945@gmail.com',	'User Account Password Reset',	'Someone requested to reset the password for an account associated with this email. Please follow this link to reset your password at <b>ABCD</b> or <b>PSB CCIT</b>. This link will remain active 24 hours from now.<br><br>If you do not want to reset your password, please ignore this email.<br><br>http://localhost:8080/index.php/Login/confirm/bf251723b9b73b5243d67823e2d46e<br><br>Regards,<br>ABCD Bot<br /><br><br>',	'2020-04-02 05:48:45',	'',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL COMMENT 'nama lengkap',
  `email` varchar(50) NOT NULL COMMENT 'unique',
  `kota` enum('Aceh Barat','Aceh Barat Daya','Aceh Besar','Aceh Jaya','Aceh Selatan','Aceh Singkil','Aceh Tamiang','Aceh Tengah','Aceh Tenggara','Aceh Timur','Aceh Utara','Agam','Alor','Ambon','Asahan','Asmat','Badung','Balangan','Balikpapan','Banda Aceh','Bandar Lampung','Bandung Kabupaten','Bandung Kota','Bandung Barat','Banggai','Banggai Kepulauan','Banggai Laut','Bangka','Bangka Barat','Bangka Selatan','Bangka Tengah','Bangkalan','Bangli','Banjar Kabupaten','Banjar Kota','Banjarbaru','Banjarmasin','Banjarnegara','Bantaeng','Bantul','Banyuasin','Banyumas','Banyuwangi','Barito Kuala','Barito Selatan','Barito Timur','Barito Utara','Barru','Batam','Batang','Batanghari','Batu','Batu Bara','Bau-Bau','Bekasi Kabupaten','Bekasi Kota','Belitung','Belitung Timur','Belu','Bener Meriah','Bengkalis','Bengkayang','Bengkulu','Bengkulu Selatan','Bengkulu Tengah','Bengkulu Utara','Berau','Biak Numfor','Bima Kabupaten','Bima Kota','Binjai','Bintan','Bireuen','Bitung','Blitar Kabupaten','Blitar Kota','Blora','Boalemo','Bogor Kabupaten','Bogor Kota','Bojonegoro','Bolaang Mongondow','Bolaang Mongondow Selatan','Bolaang Mongondow Timur','Bolaang Mongondow Utara','Bombana','Bondowoso','Bone','Bone Bolango','Bontang','Boven Digoel','Boyolali','Brebes','Bukittinggi','Buleleng','Bulukumba','Bulungan','Bungo','Buol','Buru','Buru Selatan','Buton','Buton Selatan','Buton Tengah','Buton Utara','Ciamis','Cianjur','Cilacap','Cilegon','Cimahi','Cirebon Kabupaten','Cirebon Kota','Dairi','Deiyai','Deli Serdang','Demak','Denpasar','Depok','Dharmasraya','Dogiyai','Dompu','Donggala','Dumai','Empat Lawang','Ende','Enrekang','Fakfak','Flores Timur','Garut','Gayo Lues','Gianyar','Gorontalo Kabupaten','Gorontalo Kota','Gorontalo Utara','Gowa','Gresik','Grobogan','Gunung Mas','Gunungkidul','Gunungsitoli','Halmahera Barat','Halmahera Selatan','Halmahera Tengah','Halmahera Timur','Halmahera Utara','Hulu Sungai Selatan','Hulu Sungai Tengah','Hulu Sungai Utara','Humbang Hasundutan','Indragiri Hilir','Indragiri Hulu','Indramayu','Intan Jaya','Jakarta Barat','Jakarta Pusat','Jakarta Selatan','Jakarta Timur','Jakarta Utara','Jambi','Jayapura Kabupaten','Jayapura Kota','Jayawijaya','Jember','Jembrana','Jeneponto','Jepara','Jombang','Kaimana','Kampar','Kapuas','Kapuas Hulu','Karanganyar','Karangasem','Karawang','Karimun','Karo','Katingan','Kaur','Kayong Utara','Kebumen','Kediri Kabupaten','Kediri Kota','Keerom','Kendal','Kendari','Kepahiang','Kepulauan Anambas','Kepulauan Aru','Kepulauan Mentawai','Kepulauan Meranti','Kepulauan Sangihe','Kepulauan Selayar','Kepulauan Seribu','Kepulauan Siau Tagulandang Biaro','Kepulauan Sula','Kepulauan Talaud','Kepulauan Tanimbar','Kepulauan Yapen','Kerinci','Ketapang','Klaten','Klungkung','Kolaka','Kolaka Timur','Kolaka Utara','Konawe','Konawe Kepulauan','Konawe Selatan','Konawe Utara','Kotabaru','Kotamobagu','Kotawaringin Barat','Kotawaringin Timur','Kuantan Singingi','Kubu Raya','Kudus','Kulon Progo','Kuningan','Kupang Kabupaten','Kupang Kota','Kutai Barat','Kutai Kartanegara','Kutai Timur','Labuhanbatu','Labuhanbatu Selatan','Labuhanbatu Utara','Lahat','Lamandau','Lamongan','Lampung Barat','Lampung Selatan','Lampung Tengah','Lampung Timur','Lampung Utara','Landak','Langkat','Langsa','Lanny Jaya','Lebak','Lebong','Lembata','Lhokseumawe','Lima Puluh Kota','Lingga','Lombok Barat','Lombok Tengah','Lombok Timur','Lombok Utara','Lubuklinggau','Lumajang','Luwu','Luwu Timur','Luwu Utara','Madiun Kabupaten','Madiun Kota','Magelang Kabupaten','Magelang Kota','Magetan','Mahakam Ulu','Majalengka','Majene','Makassar','Malaka','Malang Kabupaten','Malang Kota','Malinau','Maluku Barat Daya','Maluku Tengah','Maluku Tenggara','Mamasa','Mamberamo Raya','Mamberamo Tengah','Mamuju','Mamuju Tengah','Manado','Mandailing Natal','Manggarai','Manggarai Barat','Manggarai Timur','Manokwari','Manokwari Selatan','Mappi','Maros','Mataram','Maybrat','Medan','Melawi','Mempawah','Merangin','Merauke','Mesuji','Metro','Mimika','Minahasa','Minahasa Selatan','Minahasa Tenggara','Minahasa Utara','Mojokerto Kabupaten','Mojokerto Kota','Morowali','Morowali Utara','Muara Enim','Muaro Jambi','Mukomuko','Muna','Muna Barat','Murung Raya','Musi Banyuasin','Musi Rawas','Musi Rawas Utara','Nabire','Nagan Raya','Nagekeo','Natuna','Nduga','Ngada','Nganjuk','Ngawi','Nias','Nias Barat','Nias Selatan','Nias Utara','Nunukan','Ogan Ilir','Ogan Komering Ilir','Ogan Komering Ulu','Ogan Komering Ulu Selatan','Ogan Komering Ulu Timur','Pacitan','Padang','Padang Lawas','Padang Lawas Utara','Padang Pariaman','Padangpanjang','Padangsidempuan','Pagar Alam','Pakpak Bharat','Palangka Raya','Palembang','Palopo','Palu','Pamekasan','Pandeglang','Pangandaran','Pangkajene dan Kepulauan','Pangkal Pinang','Paniai','Parepare','Pariaman','Parigi Moutong','Pasaman','Pasaman Barat','Pasangkayu','Paser','Pasuruan Kabupaten','Pasuruan Kota','Pati','Payakumbuh','Pegunungan Arfak','Pegunungan Bintang','Pekalongan Kabupaten','Pekalongan Kota','Pekanbaru','Pelalawan','Pemalang','Pematangsiantar','Penajam Paser Utara','Penukal Abab Lematang Ilir','Pesawaran','Pesisir Barat','Pesisir Selatan','Pidie','Pidie Jaya','Pinrang','Pohuwato','Polewali Mandar','Ponorogo','Pontianak','Poso','Prabumulih','Pringsewu','Probolinggo Kabupaten','Probolinggo Kota','Pulang Pisau','Pulau Morotai','Pulau Taliabu','Puncak','Puncak Jaya','Purbalingga','Purwakarta','Purworejo','Raja Ampat','Rejang Lebong','Rembang','Rokan Hilir','Rokan Hulu','Rote Ndao','Sabang','Sabu Raijua','Salatiga','Samarinda','Sambas','Samosir','Sampang','Sanggau','Sarmi','Sarolangun','Sawahlunto','Sekadau','Seluma','Semarang Kabupaten','Semarang Kota','Seram Bagian Barat','Seram Bagian Timur','Serang Kabupaten','Serang Kota','Serdang Bedagai','Seruyan','Siak','Sibolga','Sidenreng Rappang','Sidoarjo','Sigi','Sijunjung','Sikka','Simalungun','Simeulue','Singkawang','Sinjai','Sintang','Situbondo','Sleman','Solok Kabupaten','Solok Kota','Solok Selatan','Soppeng','Sorong Kabupaten','Sorong Kota','Sorong Selatan','Sragen','Subang','Subulussalam','Sukabumi Kabupaten','Sukabumi Kota','Sukamara','Sukoharjo','Sumba Barat','Sumba Barat Daya','Sumba Tengah','Sumba Timur','Sumbawa','Sumbawa Barat','Sumedang','Sumenep','Sungaipenuh','Supiori','Surabaya','Surakarta','Tabalong','Tabanan','Takalar','Tambrauw','Tana Tidung','Tana Toraja','Tanah Bumbu','Tanah Datar','Tanah Laut','Tangerang Kabupaten','Tangerang Kota','Tangerang Selatan','Tanggamus','Tanjung Jabung Barat','Tanjung Jabung Timur','Tanjung Pinang','Tanjungbalai','Tapanuli Selatan','Tapanuli Tengah','Tapanuli Utara','Tapin','Tarakan','Tasikmalaya Kabupaten','Tasikmalaya Kota','Tebing Tinggi','Tebo','Tegal Kabupaten','Tegal Kota','Teluk Bintuni','Teluk Wondama','Temanggung','Ternate','Tidore Kepulauan','Timor Tengah Selatan','Timor Tengah Utara','Toba Samosir','Tojo Una-Una','Tolikara','Tolitoli','Tomohon','Toraja Utara','Trenggalek','Tual','Tuban','Tulang Bawang','Tulang Bawang Barat','Tulungagung','Wajo','Wakatobi','Waropen','Way Kanan','Wonogiri','Wonosobo','Yahukimo','Yalimo','Yogyakarta') NOT NULL,
  `provinsi` varchar(80) NOT NULL,
  `photo` varchar(50) NOT NULL COMMENT 'URL lokal utk foto (diisi saat user upload pasfoto)',
  `phone` varchar(50) NOT NULL COMMENT 'no telp, diawali kode negara, tanpa tanda plus',
  `address` tinytext NOT NULL COMMENT 'alamat pos',
  `password` varchar(80) NOT NULL,
  `reset_password` varchar(80) NOT NULL,
  `status` enum('Active','Blocked') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Blocked' COMMENT 'blocked: ga bisa login (e.g. blm aktivasi email)',
  `role` enum('Admin','Reviewer','Kota') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'Kota',
  `created` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='''Admin'',''Calon mahasiswa'',''Mahasiswa'',''Alumni'',''Dosen'',''Pensiunan'',''Pegawai'',''Manajer'',''Sekretariat''';

INSERT INTO `users` (`id`, `name`, `email`, `kota`, `provinsi`, `photo`, `phone`, `address`, `password`, `reset_password`, `status`, `role`, `created`, `last_login`) VALUES
(1,	'Demoman Admin',	'demo@admin.com',	'Aceh Barat',	'Aceh',	'11497-wmm.png',	'',	'',	'e10adc3949ba59abbe56e057f20f883e',	'',	'Active',	'Admin',	'2017-06-26 14:37:16',	'2020-06-11 03:20:07'),
(341,	'Fuadhli Rahman Katam ',	'1913020291@ruki.web.id',	'Bantul',	'',	'',	'',	'',	'Pa!1913020291',	'',	'Active',	'Admin',	'2020-03-24 18:43:13',	NULL),
(348,	'Fatih',	'indokan1945@gmail.com',	'Bandung Kota',	'Jawa Barat',	'',	'',	'',	'77963b7a931377ad4ab5ad6a9cd718aa',	'',	'Active',	'Admin',	NULL,	'2020-04-05 16:13:23'),
(349,	'Pemkot Depok',	'pemkot@depok.go.id',	'Depok',	'Jawa Barat',	'',	'',	'',	'e807f1fcf82d132f9bb018ca6738a19f',	'',	'Active',	'Kota',	'2020-05-14 17:37:50',	'2020-06-11 15:44:58'),
(350,	'Reviewer Satu',	'reviewer1@ruki.web.id',	'Kudus',	'Jawa Tengah',	'',	'',	'',	'e807f1fcf82d132f9bb018ca6738a19f',	'',	'Active',	'Reviewer',	NULL,	NULL),
(351,	'Reviewer Dua',	'reviewer2@ruki.web.id',	'Depok',	'Jawa Barat',	'',	'',	'',	'e807f1fcf82d132f9bb018ca6738a19f',	'',	'Active',	'Reviewer',	NULL,	NULL),
(352,	'Reviewer Tiga',	'reviewer3',	'Samarinda',	'Kalimantan Timur',	'',	'',	'',	'e807f1fcf82d132f9bb018ca6738a19f',	'',	'Active',	'Reviewer',	'2020-06-10 13:29:46',	NULL);

-- 2020-06-12 03:47:15
