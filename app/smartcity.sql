-- Adminer 4.6.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
(162,	3,	'Nama judul',	'',	0,	0),
(163,	3,	'Waktu',	'',	0,	162),
(190,	2,	'Tata Kota',	'TK',	1,	0),
(191,	2,	'Sampah',	'S',	2,	0),
(192,	2,	'Air',	'A',	3,	0);

CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL COMMENT 'users.id',
  `pertanyaan` int(11) NOT NULL COMMENT 'pertanyaan.id',
  `created` datetime NOT NULL COMMENT 'tanggal pengisian',
  `history` text NOT NULL COMMENT 'menyimpan riwayat jawaban, dg format: "datetime:jawaban|datetime:jawaban|..."',
  `pengisi` enum('tester','reviewer','kota') NOT NULL,
  `jawaban` text NOT NULL COMMENT 'tertangung jenis jawaban di pertanyaan ybs. angka-->isian user, teks-->isian user, enum-->jenis_jawaban_enum.id, multi-->array of jenis_jawaban_multi.id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='menyimpan jawaban user utk tiap pertanyaan';


CREATE TABLE `jenis_jawaban_angka` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` int(11) NOT NULL COMMENT 'pertanyaan.id',
  `hint` text NOT NULL COMMENT 'teks untuk ditampilkan sebagai tooltip untuk guide/bantuan bagi user',
  `min` float NOT NULL,
  `max` float NOT NULL,
  `decimal_place` int(11) NOT NULL COMMENT 'jumlah angka di belakang koma. bila 0 berarti angka bulat',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `jenis_jawaban_angka` (`id`, `pertanyaan`, `hint`, `min`, `max`, `decimal_place`) VALUES
(6,	43,	'',	0,	0,	0),
(10,	50,	'',	0,	100,	2);

CREATE TABLE `jenis_jawaban_enum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` int(11) NOT NULL COMMENT 'pertanyaan.id',
  `jenis` enum('radio','checklist') NOT NULL,
  `urutan` int(11) NOT NULL,
  `hint` text NOT NULL COMMENT 'teks untuk ditampilkan sebagai tooltip untuk guide/bantuan bagi user',
  `teks` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'sebenarnya teks yg tampil bisa digenerate oleh sistem berdasarkan inputan user di min_border, min, max_border, dan max.. kalo field ini diisi, teks akan dioverride dengan teks yg di sini',
  `min_border` enum('>','>=','<','<=') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `min` float NOT NULL,
  `max_border` enum('>','>=','<','<=') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `max` float NOT NULL,
  `persentase` float NOT NULL COMMENT '0-100, tanpa tanda persen. bila user memilih opsi ini, di soal ybs user ini akan mendapat skor sebanyak = pertanyaan.skor * jenis_jawaban_enum.persentase',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tiap entry adalah opsi jawaban dalam suatu pertanyaan';

INSERT INTO `jenis_jawaban_enum` (`id`, `pertanyaan`, `jenis`, `urutan`, `hint`, `teks`, `min_border`, `min`, `max_border`, `max`, `persentase`) VALUES
(18,	54,	'radio',	1,	'',	'kurang dari 1%',	'<',	1,	'<',	1,	0),
(19,	54,	'radio',	2,	'',	'dari 1% hingga kurang dari 3%',	'>=',	1,	'<',	3,	30),
(20,	54,	'radio',	3,	'',	'dari 3% hingga kurang dari 5%',	'>=',	3,	'<',	5,	75),
(21,	54,	'radio',	4,	'',	'5% ke atas',	'>=',	5,	'>=',	5,	100);

CREATE TABLE `jenis_jawaban_teks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` int(11) NOT NULL COMMENT 'pertanyaan.id',
  `jenis` enum('pendek','panjang','panjang, HTML') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `kuesioner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(160) NOT NULL,
  `status` enum('active','hidden','inactive') NOT NULL COMMENT 'aktif:bisa diisi user, inactive: tidak bisa diisi namun riwayat pengisian yg pernah dilakukan dapat dilihat (read only), hidden: tidak dapat dilihat, diedit, ataupun diisi oleh user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `kuesioner` (`id`, `name`, `status`) VALUES
(2,	'Self Assessment 2021',	'active'),
(3,	'Banjir',	'inactive'),
(5,	'Self Assessment 2021 - Indonesia Timur',	'active');

CREATE TABLE `pertanyaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grup` int(11) NOT NULL COMMENT 'grup.id',
  `visibility` enum('show','hidden') NOT NULL COMMENT 'dibutuhkan karena ada pertanyaan luas bangunan dan luas taman yg harus diisi user. tapi yg dinilai sebenarnya rasio luas bangunan terhadap taman. rasio ini ga usah diiisi user, jadi hidden saja',
  `kode` varchar(30) NOT NULL COMMENT 'kode pertanyaan, utk keperluan administasi',
  `urutan` int(11) NOT NULL COMMENT 'urutan ditampilkan dalam satu grup',
  `teks` text NOT NULL COMMENT 'teks pertanyaan. teks dg format HTML',
  `hint` text NOT NULL COMMENT 'petunjuk untuk user. teks dg format HTML',
  `lampiran` tinytext NOT NULL COMMENT 'file location',
  `wajib` enum('ya','tidak') NOT NULL,
  `formula` text NOT NULL COMMENT 'isinya id_pertanyaan dan operator *+-/%() dan angka. hasil formula ini yg nantinya akan dikalikan dg pertanyaan.score dan dijumlah dg score dari pertanyaan2 lain untuk menjadi total score. input user mesti diamankan agar tidak error/jadi SQL injection',
  `show_if` text NOT NULL COMMENT 'isinya id_pertanyaan dan operator ''&=><|()+-*/% dan teks dan angka. id_pertanyaan harus milik pertanyaan yg ada di group yang ditampilkan sebelumnya. input user mesti diamankan agar tidak error/jadi SQL injection',
  `max_score` int(11) NOT NULL,
  `jenis_jawaban` enum('Pendek','Panjang','Panjang, HTML','Radio','Checklist','Angka') NOT NULL COMMENT 'angka, enum, multi, teks',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `pertanyaan` (`id`, `grup`, `visibility`, `kode`, `urutan`, `teks`, `hint`, `lampiran`, `wajib`, `formula`, `show_if`, `max_score`, `jenis_jawaban`) VALUES
(40,	152,	'show',	'',	0,	'Kapan?',	'',	'',	'ya',	'0',	'0',	0,	''),
(43,	163,	'show',	'',	0,	'ewfwewe',	'',	'',	'tidak',	'0',	'0',	0,	'Checklist'),
(50,	187,	'show',	'',	0,	'Apa itu mainan?',	'',	'',	'tidak',	'0',	'0',	0,	'Checklist'),
(51,	187,	'show',	'',	1,	'',	'',	'',	'ya',	'0',	'0',	0,	'Radio'),
(52,	190,	'show',	'TK1',	1,	'<p>\n	Luas kota</p>\n',	'<p>\n	Dalam Km2, gunakan titik untuk desimal, tanpa pembagi ribuan. Contoh:&nbsp;<em>12345.012</em></p>\n',	'',	'ya',	'',	'',	0,	'Angka'),
(53,	190,	'show',	'TK2',	2,	'<p>\n	Luas area resapan</p>\n',	'<p>\n	Dalam Km<sup>2</sup>, gunakan titik untuk desimal, tanpa pembagi ribuan. Contoh: <em>12345.012</em></p>\n',	'',	'ya',	'',	'',	0,	'Angka'),
(54,	190,	'hidden',	'TK3',	3,	'<p>\n	Persentase Area Resapan&nbsp;</p>\n',	'',	'',	'',	'<p>\n	100*TK.TK2/TK.TK1</p>\n',	'',	20,	'Radio');

CREATE TABLE `reset_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `reset_pass_key` varchar(40) NOT NULL,
  `expiration` datetime NOT NULL,
  `used` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'kalo udh reset password, maka akan jadi 1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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


CREATE TABLE `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'nama ruangan',
  `capacity` int(3) NOT NULL COMMENT 'kapasitas',
  `type` enum('ruang kelas','ruang rapat','ruang kerja/kantor') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='skor per makul per';

INSERT INTO `room` (`id`, `name`, `capacity`, `type`) VALUES
(1,	'A101',	26,	'ruang kelas'),
(2,	'A102',	30,	'ruang kelas'),
(3,	'A103',	20,	'ruang kelas'),
(5,	'A201',	20,	'ruang kelas'),
(6,	'A301',	30,	'');

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

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL COMMENT 'nama lengkap',
  `title_front` varchar(80) NOT NULL COMMENT 'gelar di depan nama',
  `title_back` varchar(80) NOT NULL COMMENT 'gelar di belakang nama',
  `username` varchar(50) NOT NULL COMMENT 'username untuk login, unique',
  `email` varchar(50) NOT NULL COMMENT 'unique',
  `kota` enum('Aceh Barat','Aceh Barat Daya','Aceh Besar','Aceh Jaya','Aceh Selatan','Aceh Singkil','Aceh Tamiang','Aceh Tengah','Aceh Tenggara','Aceh Timur','Aceh Utara','Agam','Alor','Ambon','Asahan','Asmat','Badung','Balangan','Balikpapan','Banda Aceh','Bandar Lampung','Bandung Kabupaten','Bandung Kota','Bandung Barat','Banggai','Banggai Kepulauan','Banggai Laut','Bangka','Bangka Barat','Bangka Selatan','Bangka Tengah','Bangkalan','Bangli','Banjar Kabupaten','Banjar Kota','Banjarbaru','Banjarmasin','Banjarnegara','Bantaeng','Bantul','Banyuasin','Banyumas','Banyuwangi','Barito Kuala','Barito Selatan','Barito Timur','Barito Utara','Barru','Batam','Batang','Batanghari','Batu','Batu Bara','Bau-Bau','Bekasi Kabupaten','Bekasi Kota','Belitung','Belitung Timur','Belu','Bener Meriah','Bengkalis','Bengkayang','Bengkulu','Bengkulu Selatan','Bengkulu Tengah','Bengkulu Utara','Berau','Biak Numfor','Bima Kabupaten','Bima Kota','Binjai','Bintan','Bireuen','Bitung','Blitar Kabupaten','Blitar Kota','Blora','Boalemo','Bogor Kabupaten','Bogor Kota','Bojonegoro','Bolaang Mongondow','Bolaang Mongondow Selatan','Bolaang Mongondow Timur','Bolaang Mongondow Utara','Bombana','Bondowoso','Bone','Bone Bolango','Bontang','Boven Digoel','Boyolali','Brebes','Bukittinggi','Buleleng','Bulukumba','Bulungan','Bungo','Buol','Buru','Buru Selatan','Buton','Buton Selatan','Buton Tengah','Buton Utara','Ciamis','Cianjur','Cilacap','Cilegon','Cimahi','Cirebon Kabupaten','Cirebon Kota','Dairi','Deiyai','Deli Serdang','Demak','Denpasar','Depok','Dharmasraya','Dogiyai','Dompu','Donggala','Dumai','Empat Lawang','Ende','Enrekang','Fakfak','Flores Timur','Garut','Gayo Lues','Gianyar','Gorontalo Kabupaten','Gorontalo Kota','Gorontalo Utara','Gowa','Gresik','Grobogan','Gunung Mas','Gunungkidul','Gunungsitoli','Halmahera Barat','Halmahera Selatan','Halmahera Tengah','Halmahera Timur','Halmahera Utara','Hulu Sungai Selatan','Hulu Sungai Tengah','Hulu Sungai Utara','Humbang Hasundutan','Indragiri Hilir','Indragiri Hulu','Indramayu','Intan Jaya','Jakarta Barat','Jakarta Pusat','Jakarta Selatan','Jakarta Timur','Jakarta Utara','Jambi','Jayapura Kabupaten','Jayapura Kota','Jayawijaya','Jember','Jembrana','Jeneponto','Jepara','Jombang','Kaimana','Kampar','Kapuas','Kapuas Hulu','Karanganyar','Karangasem','Karawang','Karimun','Karo','Katingan','Kaur','Kayong Utara','Kebumen','Kediri Kabupaten','Kediri Kota','Keerom','Kendal','Kendari','Kepahiang','Kepulauan Anambas','Kepulauan Aru','Kepulauan Mentawai','Kepulauan Meranti','Kepulauan Sangihe','Kepulauan Selayar','Kepulauan Seribu','Kepulauan Siau Tagulandang Biaro','Kepulauan Sula','Kepulauan Talaud','Kepulauan Tanimbar','Kepulauan Yapen','Kerinci','Ketapang','Klaten','Klungkung','Kolaka','Kolaka Timur','Kolaka Utara','Konawe','Konawe Kepulauan','Konawe Selatan','Konawe Utara','Kotabaru','Kotamobagu','Kotawaringin Barat','Kotawaringin Timur','Kuantan Singingi','Kubu Raya','Kudus','Kulon Progo','Kuningan','Kupang Kabupaten','Kupang Kota','Kutai Barat','Kutai Kartanegara','Kutai Timur','Labuhanbatu','Labuhanbatu Selatan','Labuhanbatu Utara','Lahat','Lamandau','Lamongan','Lampung Barat','Lampung Selatan','Lampung Tengah','Lampung Timur','Lampung Utara','Landak','Langkat','Langsa','Lanny Jaya','Lebak','Lebong','Lembata','Lhokseumawe','Lima Puluh Kota','Lingga','Lombok Barat','Lombok Tengah','Lombok Timur','Lombok Utara','Lubuklinggau','Lumajang','Luwu','Luwu Timur','Luwu Utara','Madiun Kabupaten','Madiun Kota','Magelang Kabupaten','Magelang Kota','Magetan','Mahakam Ulu','Majalengka','Majene','Makassar','Malaka','Malang Kabupaten','Malang Kota','Malinau','Maluku Barat Daya','Maluku Tengah','Maluku Tenggara','Mamasa','Mamberamo Raya','Mamberamo Tengah','Mamuju','Mamuju Tengah','Manado','Mandailing Natal','Manggarai','Manggarai Barat','Manggarai Timur','Manokwari','Manokwari Selatan','Mappi','Maros','Mataram','Maybrat','Medan','Melawi','Mempawah','Merangin','Merauke','Mesuji','Metro','Mimika','Minahasa','Minahasa Selatan','Minahasa Tenggara','Minahasa Utara','Mojokerto Kabupaten','Mojokerto Kota','Morowali','Morowali Utara','Muara Enim','Muaro Jambi','Mukomuko','Muna','Muna Barat','Murung Raya','Musi Banyuasin','Musi Rawas','Musi Rawas Utara','Nabire','Nagan Raya','Nagekeo','Natuna','Nduga','Ngada','Nganjuk','Ngawi','Nias','Nias Barat','Nias Selatan','Nias Utara','Nunukan','Ogan Ilir','Ogan Komering Ilir','Ogan Komering Ulu','Ogan Komering Ulu Selatan','Ogan Komering Ulu Timur','Pacitan','Padang','Padang Lawas','Padang Lawas Utara','Padang Pariaman','Padangpanjang','Padangsidempuan','Pagar Alam','Pakpak Bharat','Palangka Raya','Palembang','Palopo','Palu','Pamekasan','Pandeglang','Pangandaran','Pangkajene dan Kepulauan','Pangkal Pinang','Paniai','Parepare','Pariaman','Parigi Moutong','Pasaman','Pasaman Barat','Pasangkayu','Paser','Pasuruan Kabupaten','Pasuruan Kota','Pati','Payakumbuh','Pegunungan Arfak','Pegunungan Bintang','Pekalongan Kabupaten','Pekalongan Kota','Pekanbaru','Pelalawan','Pemalang','Pematangsiantar','Penajam Paser Utara','Penukal Abab Lematang Ilir','Pesawaran','Pesisir Barat','Pesisir Selatan','Pidie','Pidie Jaya','Pinrang','Pohuwato','Polewali Mandar','Ponorogo','Pontianak','Poso','Prabumulih','Pringsewu','Probolinggo Kabupaten','Probolinggo Kota','Pulang Pisau','Pulau Morotai','Pulau Taliabu','Puncak','Puncak Jaya','Purbalingga','Purwakarta','Purworejo','Raja Ampat','Rejang Lebong','Rembang','Rokan Hilir','Rokan Hulu','Rote Ndao','Sabang','Sabu Raijua','Salatiga','Samarinda','Sambas','Samosir','Sampang','Sanggau','Sarmi','Sarolangun','Sawahlunto','Sekadau','Seluma','Semarang Kabupaten','Semarang Kota','Seram Bagian Barat','Seram Bagian Timur','Serang Kabupaten','Serang Kota','Serdang Bedagai','Seruyan','Siak','Sibolga','Sidenreng Rappang','Sidoarjo','Sigi','Sijunjung','Sikka','Simalungun','Simeulue','Singkawang','Sinjai','Sintang','Situbondo','Sleman','Solok Kabupaten','Solok Kota','Solok Selatan','Soppeng','Sorong Kabupaten','Sorong Kota','Sorong Selatan','Sragen','Subang','Subulussalam','Sukabumi Kabupaten','Sukabumi Kota','Sukamara','Sukoharjo','Sumba Barat','Sumba Barat Daya','Sumba Tengah','Sumba Timur','Sumbawa','Sumbawa Barat','Sumedang','Sumenep','Sungaipenuh','Supiori','Surabaya','Surakarta','Tabalong','Tabanan','Takalar','Tambrauw','Tana Tidung','Tana Toraja','Tanah Bumbu','Tanah Datar','Tanah Laut','Tangerang Kabupaten','Tangerang Kota','Tangerang Selatan','Tanggamus','Tanjung Jabung Barat','Tanjung Jabung Timur','Tanjung Pinang','Tanjungbalai','Tapanuli Selatan','Tapanuli Tengah','Tapanuli Utara','Tapin','Tarakan','Tasikmalaya Kabupaten','Tasikmalaya Kota','Tebing Tinggi','Tebo','Tegal Kabupaten','Tegal Kota','Teluk Bintuni','Teluk Wondama','Temanggung','Ternate','Tidore Kepulauan','Timor Tengah Selatan','Timor Tengah Utara','Toba Samosir','Tojo Una-Una','Tolikara','Tolitoli','Tomohon','Toraja Utara','Trenggalek','Tual','Tuban','Tulang Bawang','Tulang Bawang Barat','Tulungagung','Wajo','Wakatobi','Waropen','Way Kanan','Wonogiri','Wonosobo','Yahukimo','Yalimo','Yogyakarta') NOT NULL,
  `provinsi` varchar(80) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `photo` varchar(50) NOT NULL COMMENT 'URL lokal utk foto (diisi saat user upload pasfoto)',
  `NIP_NPM` varchar(50) NOT NULL COMMENT 'nomor induk pegawai atau nomor pokok mahasiswa',
  `no_KTP` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL COMMENT 'no telp, diawali kode negara, tanpa tanda plus',
  `address` tinytext NOT NULL COMMENT 'alamat pos',
  `address_map_URL` tinytext NOT NULL COMMENT 'link ke alamat rumah di google map',
  `SMA` tinytext NOT NULL COMMENT 'asal SMA',
  `tahun_lulus_SMA` int(11) NOT NULL,
  `term_masuk` int(11) NOT NULL COMMENT 'timing',
  `batch` int(11) NOT NULL COMMENT 'tahun masuk (hanya untuk student dan alumni)',
  `major` int(11) DEFAULT NULL,
  `jalur` varchar(30) DEFAULT NULL COMMENT 'jalur masuk (regular, PNJ, etc.)',
  `password` varchar(80) NOT NULL,
  `reset_password` varchar(80) NOT NULL,
  `status` enum('Active','Empty','On Leave','Resign','Blocked') NOT NULL DEFAULT 'Blocked' COMMENT 'resign gabisa akses sistem. blocked jg gbsa akses sistem tapi ga cuma buat yg resign (bisa buat pegawai, mhs yg kena sanksi akademik, dll). kalo alumni: empty dan role nya alumni',
  `role` enum('Admin','Student Candidate','Student','Alumni','Lecturer','Finance','Manager','Marketing','SAA','School Representative') DEFAULT 'Student Candidate',
  `agama` enum('Islam','Kristen','Katolik','Hindu','Buddha','Kong Hu Cu') DEFAULT NULL,
  `suku` varchar(30) DEFAULT NULL,
  `nama_ibu` varchar(30) DEFAULT NULL,
  `nama_ayah` varchar(30) DEFAULT NULL,
  `pekerjaan_ibu` tinytext,
  `pendidikan_ayah` enum('Tidak sekolah','SD','SMP','SMA','D1','D2','D3','D4/S1','S2','S3') DEFAULT NULL,
  `pendidikan_ibu` enum('Tidak sekolah','SD','SMP','SMA','D1','D2','D3','D4/S1','S2','S3') DEFAULT NULL,
  `pekerjaan_ayah` tinytext,
  `penghasilan_orang_tua` int(11) DEFAULT NULL,
  `jumlah_kakak_kandung` int(11) DEFAULT NULL,
  `jumlah_adik_kandung` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `session` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `major` (`major`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='''Admin'',''Calon mahasiswa'',''Mahasiswa'',''Alumni'',''Dosen'',''Pensiunan'',''Pegawai'',''Manajer'',''Sekretariat''';

INSERT INTO `users` (`id`, `name`, `title_front`, `title_back`, `username`, `email`, `kota`, `provinsi`, `tanggal_lahir`, `gender`, `photo`, `NIP_NPM`, `no_KTP`, `phone`, `address`, `address_map_URL`, `SMA`, `tahun_lulus_SMA`, `term_masuk`, `batch`, `major`, `jalur`, `password`, `reset_password`, `status`, `role`, `agama`, `suku`, `nama_ibu`, `nama_ayah`, `pekerjaan_ibu`, `pendidikan_ayah`, `pendidikan_ibu`, `pekerjaan_ayah`, `penghasilan_orang_tua`, `jumlah_kakak_kandung`, `jumlah_adik_kandung`, `created`, `last_login`, `session`) VALUES
(1,	'Demoman Admin',	'',	'',	'demo',	'demo@admin.com',	'Aceh Barat',	'Aceh',	NULL,	'Male',	'11497-wmm.png',	'',	'',	'',	'',	'',	'',	0,	0,	0,	NULL,	NULL,	'e10adc3949ba59abbe56e057f20f883e',	'',	'Active',	'Admin',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2017-06-26 14:37:16',	'2020-04-23 16:43:49',	'f7316aa100396df3690958daf3e270'),
(3,	'Mahasiswa',	'',	'',	'mhs',	'demo@mhs.com',	'Aceh Barat',	'Aceh',	'2020-03-11',	'Female',	'07c08-win_20180926_17_52_11_pro.jpg',	'111',	'4567-qwerty',	'23456',	'konyol',	'',	'',	0,	0,	2019,	2,	NULL,	'e807f1fcf82d132f9bb018ca6738a19f',	'',	'Active',	'Student',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2019-05-26 14:06:55',	'2020-03-31 01:35:50',	''),
(341,	'Fuadhli Rahman Katam ',	'',	'',	'1913020291@ruki.web.id',	'1913020291@ruki.web.id',	'Aceh Barat',	'',	NULL,	'Male',	'',	'1913020291',	'',	'',	'',	'',	'',	0,	6,	0,	6,	'Reguler',	'Pa!1913020291',	'',	'Active',	'Student',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2020-03-24 18:43:13',	NULL,	''),
(348,	'Fatih',	'',	'',	'user',	'indokan1945@gmail.com',	'Bandung Kota',	'Jawa Barat',	NULL,	'Male',	'',	'',	'',	'',	'',	'',	'',	0,	0,	0,	NULL,	NULL,	'77963b7a931377ad4ab5ad6a9cd718aa',	'',	'Active',	'Student Candidate',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'2020-04-05 16:13:23',	'');

-- 2020-04-24 05:10:24
