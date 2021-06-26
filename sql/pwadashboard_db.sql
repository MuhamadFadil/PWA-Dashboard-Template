-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2021 pada 10.50
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwadashboard_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activate_account`
--

CREATE TABLE `activate_account` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `reset_pass_key` varchar(40) NOT NULL,
  `expiration` datetime NOT NULL,
  `used` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `activate_account`
--

INSERT INTO `activate_account` (`id`, `user`, `reset_pass_key`, `expiration`, `used`) VALUES
(1, 348, 'e9816a8ad009a68f4daa085da416d3', '2020-04-03 04:56:49', 0),
(2, 348, '6a353cd29c08e170e5da0fa7fa168a', '2020-04-03 04:56:59', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(64) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(0, 'admin', 'e807f1fcf82d132f9bb018ca6738a19f', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_users`
--

CREATE TABLE `ci_users` (
  `id` int(11) NOT NULL,
  `name` varchar(160) NOT NULL,
  `kota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_jawaban_angka`
--

CREATE TABLE `jenis_jawaban_angka` (
  `id` int(11) NOT NULL,
  `pertanyaan` int(11) NOT NULL COMMENT 'pertanyaan.id',
  `hint` text NOT NULL COMMENT 'teks untuk ditampilkan sebagai tooltip untuk guide/bantuan bagi user',
  `min` float DEFAULT NULL COMMENT 'angka terkecil yg bisa diinput user sbg jawaban utk pertanyaan ini',
  `max` float DEFAULT NULL COMMENT 'angka terbesar yg bisa diinput user sbg jawaban utk pertanyaan ini',
  `decimal_place` int(11) NOT NULL DEFAULT 0 COMMENT 'jumlah angka di belakang koma. bila 0 berarti angka bulat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jenis_jawaban_angka`
--

INSERT INTO `jenis_jawaban_angka` (`id`, `pertanyaan`, `hint`, `min`, `max`, `decimal_place`) VALUES
(10, 50, '', 0, 100, 2),
(12, 43, '', NULL, NULL, 0),
(13, 84, '', NULL, NULL, 0),
(14, 85, '', NULL, NULL, 0),
(15, 70, '', NULL, NULL, 0),
(16, 69, '', 0, 100, 2),
(17, 87, '', NULL, 100, 0),
(18, 68, '', NULL, NULL, 0),
(19, 88, '', NULL, NULL, 0),
(20, 90, '', NULL, NULL, 0),
(21, 89, '', NULL, NULL, 0),
(22, 91, '', NULL, NULL, 0),
(23, 92, '', NULL, NULL, 0),
(24, 93, '', NULL, NULL, 0),
(25, 94, '', NULL, NULL, 0),
(26, 95, '', NULL, NULL, 0),
(27, 96, '', NULL, NULL, 0),
(28, 97, '', NULL, NULL, 0),
(29, 98, '', NULL, NULL, 0),
(30, 99, '', NULL, NULL, 0),
(31, 100, '', NULL, NULL, 0),
(32, 101, '', NULL, NULL, 0),
(33, 102, '', NULL, NULL, 0),
(34, 103, '', NULL, NULL, 0),
(35, 104, '', 0, 100, 2),
(36, 343, '', NULL, NULL, 0),
(37, 344, '', NULL, NULL, 0),
(38, 345, '', NULL, NULL, 0),
(39, 310, '', NULL, NULL, 0),
(40, 346, '', NULL, NULL, 0),
(41, 309, '', NULL, NULL, 0),
(42, 311, '', NULL, NULL, 0),
(43, 347, '', NULL, NULL, 0),
(44, 348, '', NULL, NULL, 0),
(45, 312, '', NULL, NULL, 0),
(46, 349, '', NULL, NULL, 0),
(47, 313, '', NULL, NULL, 0),
(48, 342, '', NULL, NULL, 0),
(49, 306, '', NULL, NULL, 0),
(50, 302, '', NULL, NULL, 0),
(51, 303, '', NULL, NULL, 0),
(52, 350, '', NULL, NULL, 0),
(53, 351, '', NULL, NULL, 0),
(54, 352, '', NULL, NULL, 0),
(55, 353, '', NULL, NULL, 0),
(56, 354, '', NULL, NULL, 0),
(57, 355, '', NULL, NULL, 0),
(58, 356, '', NULL, NULL, 0),
(59, 357, '', NULL, NULL, 0),
(60, 358, '', NULL, NULL, 0),
(87, 304, '', NULL, NULL, 0),
(88, 305, '', NULL, NULL, 0),
(89, 307, '', NULL, NULL, 0),
(90, 308, '', NULL, NULL, 0),
(91, 314, '', NULL, NULL, 0),
(92, 315, '', NULL, NULL, 0),
(93, 316, '', NULL, NULL, 0),
(94, 317, '', NULL, NULL, 0),
(95, 318, '', NULL, NULL, 0),
(96, 319, '', NULL, NULL, 0),
(97, 320, '', NULL, NULL, 0),
(98, 321, '', NULL, NULL, 0),
(99, 322, '', NULL, NULL, 0),
(100, 323, '', NULL, NULL, 0),
(101, 324, '', NULL, NULL, 0),
(102, 325, '', NULL, NULL, 0),
(103, 326, '', NULL, NULL, 0),
(104, 327, '', NULL, NULL, 0),
(105, 328, '', NULL, NULL, 0),
(106, 329, '', NULL, NULL, 0),
(107, 330, '', NULL, NULL, 0),
(108, 332, '', NULL, NULL, 0),
(109, 333, '', NULL, NULL, 0),
(110, 334, '', NULL, NULL, 0),
(111, 335, '', NULL, NULL, 0),
(112, 336, '', NULL, NULL, 0),
(113, 341, '', NULL, NULL, 0),
(114, 340, '', NULL, NULL, 0),
(115, 339, '', NULL, NULL, 0),
(116, 338, '', NULL, NULL, 0),
(117, 337, '', NULL, NULL, 0),
(118, 331, '', NULL, NULL, 0),
(119, 416, '', 10, NULL, 0),
(120, 417, '', NULL, NULL, 0),
(121, 418, '', NULL, NULL, 0),
(122, 423, '', 0, 100, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_jawaban_enum`
--

CREATE TABLE `jenis_jawaban_enum` (
  `id` int(11) NOT NULL,
  `pertanyaan` int(11) NOT NULL COMMENT 'pertanyaan.id',
  `urutan` int(11) DEFAULT NULL,
  `persentase` float DEFAULT NULL COMMENT '0-100, tanpa tanda persen. bila user memilih opsi ini, di soal ybs user ini akan mendapat skor sebanyak = pertanyaan.skor * jenis_jawaban_enum.persentase',
  `min_border` enum('>','>=','<','<=') DEFAULT NULL,
  `min` double DEFAULT NULL,
  `max_border` enum('>','>=','<','<=') DEFAULT NULL,
  `max` double DEFAULT NULL,
  `teks` text DEFAULT NULL COMMENT 'sebenarnya teks yg tampil bisa digenerate oleh sistem berdasarkan inputan user di min_border, min, max_border, dan max.. kalo field ini diisi, teks akan dioverride dengan teks yg di sini',
  `hint` text DEFAULT NULL COMMENT 'teks untuk ditampilkan sebagai tooltip untuk guide/bantuan bagi user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tiap entry adalah opsi jawaban dalam suatu pertanyaan';

--
-- Dumping data untuk tabel `jenis_jawaban_enum`
--

INSERT INTO `jenis_jawaban_enum` (`id`, `pertanyaan`, `urutan`, `persentase`, `min_border`, `min`, `max_border`, `max`, `teks`, `hint`) VALUES
(24, 42, NULL, NULL, NULL, NULL, NULL, NULL, '', ''),
(28, 41, 1, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(29, 86, 1, 100, NULL, NULL, '<=', 2.00819993019104, '', ''),
(30, 86, 2, 75, '<', 0.028200000524520874, '<=', 0.040800001472234726, '', ''),
(31, 86, 3, 50, '<', 0.040800001472234726, '<=', 0.05889999866485596, '', ''),
(32, 86, 4, 25, '<', 0.05889999866485596, NULL, NULL, '', ''),
(34, 70, 4, 25, '<=', 4131, '<=', 8366.5, '', ''),
(35, 70, 3, 50, '<', 8366.5, '<=', 10035, '', ''),
(36, 70, 2, 75, '<', 10035, '<=', 11511, '', ''),
(37, 70, 1, 100, '<', 11511, '<=', 23363, '', ''),
(38, 105, 1, 100, '<', 6.019999980926514, NULL, NULL, '', ''),
(39, 105, 2, 75, '<', 5.420000076293945, '<=', 6.019999980926514, '', ''),
(40, 105, 3, 50, '<', 4.980000019073486, '<=', 5.420000076293945, '', ''),
(41, 105, 4, 25, NULL, NULL, '<=', 4.980000019073486, '', ''),
(42, 201, 1, 100, NULL, NULL, '<=', 2.819999933242798, NULL, NULL),
(43, 201, 2, 75, '<', 2.819999933242798, '<=', 4.079999923706055, NULL, NULL),
(44, 201, 3, 50, '<', 4.079999923706055, '<=', 5.889999866485596, NULL, NULL),
(45, 201, 4, 25, '<', 5.889999866485596, NULL, NULL, NULL, NULL),
(46, 202, 1, 100, '<', 6.019999980926514, NULL, NULL, NULL, NULL),
(47, 202, 2, 75, '<', 5.420000076293945, '<=', 6.019999980926514, NULL, NULL),
(48, 202, 3, 50, '<', 4.980000019073486, '<=', 5.420000076293945, NULL, NULL),
(49, 202, 4, 25, NULL, NULL, '<=', 4.980000019073486, NULL, NULL),
(50, 203, 1, 100, '<', 11511, NULL, NULL, NULL, NULL),
(51, 203, 2, 75, '<', 10035, '<=', 11511, NULL, NULL),
(52, 203, 3, 50, '<', 8366.5, '<=', 10035, NULL, NULL),
(53, 203, 4, 25, NULL, NULL, '<=', 8366.5, NULL, NULL),
(54, 204, 1, 100, NULL, NULL, '<=', 132.02999877929688, NULL, NULL),
(55, 204, 2, 75, '<', 132.02999877929688, '<=', 134.99000549316406, NULL, NULL),
(56, 204, 3, 50, '<', 134.99000549316406, '<=', 139, NULL, NULL),
(57, 204, 4, 25, '<', 139, NULL, NULL, NULL, NULL),
(58, 205, 1, 100, '<', 99.88999938964844, NULL, NULL, NULL, NULL),
(59, 205, 2, 75, '<', 99.31999969482422, '<=', 99.88999938964844, NULL, NULL),
(60, 205, 3, 50, '<', 96.80999755859375, '<=', 99.31999969482422, NULL, NULL),
(61, 205, 4, 25, NULL, NULL, '<=', 96.80999755859375, NULL, NULL),
(62, 206, 1, 100, '<', 0.09000000357627869, NULL, NULL, NULL, NULL),
(63, 206, 2, 75, '<', 0.05000000074505806, '<=', 0.09000000357627869, NULL, NULL),
(64, 206, 3, 50, '<', 0.03999999910593033, '<=', 0.05000000074505806, NULL, NULL),
(65, 206, 4, 25, NULL, NULL, '<=', 0.03999999910593033, NULL, NULL),
(66, 207, 1, 100, '<', 81.08999633789062, NULL, NULL, NULL, NULL),
(67, 207, 2, 75, '<', 70.55000305175781, '<=', 81.08999633789062, NULL, NULL),
(68, 207, 3, 50, '<', 57.56999969482422, '<=', 70.55000305175781, NULL, NULL),
(69, 207, 4, 25, NULL, NULL, '<=', 57.56999969482422, NULL, NULL),
(70, 208, 1, 100, '<', 86.04000091552734, NULL, NULL, NULL, NULL),
(71, 208, 2, 75, '<', 78.9800033569336, '<=', 86.04000091552734, NULL, NULL),
(72, 208, 3, 50, '<', 67.81999969482422, '<=', 78.9800033569336, NULL, NULL),
(73, 208, 4, 25, NULL, NULL, '<=', 67.81999969482422, NULL, NULL),
(74, 209, 1, 100, '<', 14.489999771118164, NULL, NULL, NULL, NULL),
(75, 209, 2, 75, '<', 9.170000076293945, '<=', 14.489999771118164, NULL, NULL),
(76, 209, 3, 50, '<', 5.820000171661377, '<=', 9.170000076293945, NULL, NULL),
(77, 209, 4, 25, NULL, NULL, '<=', 5.820000171661377, NULL, NULL),
(78, 210, 1, 100, NULL, NULL, '<=', 0.11999999731779099, NULL, NULL),
(79, 210, 2, 75, '<', 0.11999999731779099, '<=', 0.49000000953674316, NULL, NULL),
(80, 210, 3, 50, '<', 0.49000000953674316, '<=', 1.899999976158142, NULL, NULL),
(81, 210, 4, 25, '<', 1.899999976158142, NULL, NULL, NULL, NULL),
(82, 211, 1, 100, '<', 4435617.5, NULL, NULL, NULL, NULL),
(83, 211, 2, 75, '<', 2994295.5, '<=', 4435617.5, NULL, NULL),
(84, 211, 3, 50, '<', 1984192.25, '<=', 2994295.5, NULL, NULL),
(85, 211, 4, 25, NULL, NULL, '<=', 1984192.25, NULL, NULL),
(86, 212, 1, 100, '<', 24.940000534057617, NULL, NULL, NULL, NULL),
(87, 212, 2, 75, '<', 20.579999923706055, '<=', 24.940000534057617, NULL, NULL),
(88, 212, 3, 50, '<', 15.859999656677246, '<=', 20.579999923706055, NULL, NULL),
(89, 212, 4, 25, NULL, NULL, '<=', 15.859999656677246, NULL, NULL),
(90, 213, 1, 100, '<', 0.03999999910593033, NULL, NULL, NULL, NULL),
(91, 213, 2, 75, '<', 0.019999999552965164, '<=', 0.03999999910593033, NULL, NULL),
(92, 213, 3, 50, '<', 0.009999999776482582, '<=', 0.019999999552965164, NULL, NULL),
(93, 213, 4, 25, NULL, NULL, '<=', 0.009999999776482582, NULL, NULL),
(94, 214, 1, 100, '<', 99.48999786376953, NULL, NULL, NULL, NULL),
(95, 214, 2, 75, '<', 98.44999694824219, '<=', 99.48999786376953, NULL, NULL),
(96, 214, 3, 50, '<', 96.30999755859375, '<=', 98.44999694824219, NULL, NULL),
(97, 214, 4, 25, NULL, NULL, '<=', 96.30999755859375, NULL, NULL),
(98, 215, 1, 100, '<', 82.94999694824219, NULL, NULL, NULL, NULL),
(99, 215, 2, 75, '<', 78, '<=', 82.94999694824219, NULL, NULL),
(100, 215, 3, 50, '<', 72.5199966430664, '<=', 78, NULL, NULL),
(101, 215, 4, 25, NULL, NULL, '<=', 72.5199966430664, NULL, NULL),
(102, 216, 1, 100, '<', 69.37999725341797, NULL, NULL, NULL, NULL),
(103, 216, 2, 75, '<', 61.970001220703125, '<=', 69.37999725341797, NULL, NULL),
(104, 216, 3, 50, '<', 54.97999954223633, '<=', 61.970001220703125, NULL, NULL),
(105, 216, 4, 25, NULL, NULL, '<=', 54.97999954223633, NULL, NULL),
(106, 217, 1, 100, '<', 13.489999771118164, NULL, NULL, NULL, NULL),
(107, 217, 2, 75, '<', 12.75, '<=', 13.489999771118164, NULL, NULL),
(108, 217, 3, 50, '<', 12.220000267028809, '<=', 12.75, NULL, NULL),
(109, 217, 4, 25, NULL, NULL, '<=', 12.220000267028809, NULL, NULL),
(110, 218, 1, 100, '<', 9.029999732971191, NULL, NULL, NULL, NULL),
(111, 218, 2, 75, '<', 7.949999809265137, '<=', 9.029999732971191, NULL, NULL),
(112, 218, 3, 50, '<', 7.190000057220459, '<=', 7.949999809265137, NULL, NULL),
(113, 218, 4, 25, NULL, NULL, '<=', 7.190000057220459, NULL, NULL),
(114, 219, 1, 100, '<', 126, NULL, NULL, NULL, NULL),
(115, 219, 2, 75, '<', 67, '<=', 126, NULL, NULL),
(116, 219, 3, 50, '<', 37, '<=', 67, NULL, NULL),
(117, 219, 4, 25, NULL, NULL, '<=', 37, NULL, NULL),
(118, 220, 1, 100, '<', 502.25, NULL, NULL, NULL, NULL),
(119, 220, 2, 75, '<', 270.5, '<=', 502.25, NULL, NULL),
(120, 220, 3, 50, '<', 158, '<=', 270.5, NULL, NULL),
(121, 220, 4, 25, NULL, NULL, '<=', 158, NULL, NULL),
(122, 221, 1, 100, '<', 71.48999786376953, NULL, NULL, NULL, NULL),
(123, 221, 2, 75, '<', 69.47000122070312, '<=', 71.48999786376953, NULL, NULL),
(124, 221, 3, 50, '<', 66.81999969482422, '<=', 69.47000122070312, NULL, NULL),
(125, 221, 4, 25, NULL, NULL, '<=', 66.81999969482422, NULL, NULL),
(126, 222, 1, 100, NULL, NULL, '<=', 26.200000762939453, NULL, NULL),
(127, 222, 2, 75, '<', 26.200000762939453, '<=', 31.899999618530273, NULL, NULL),
(128, 222, 3, 50, '<', 31.899999618530273, '<=', 36.849998474121094, NULL, NULL),
(129, 222, 4, 25, '<', 36.849998474121094, NULL, NULL, NULL, NULL),
(130, 223, 1, 100, NULL, NULL, '<=', 25.3799991607666, NULL, NULL),
(131, 223, 2, 75, '<', 25.3799991607666, '<=', 29.600000381469727, NULL, NULL),
(132, 223, 3, 50, '<', 29.600000381469727, '<=', 34.400001525878906, NULL, NULL),
(133, 223, 4, 25, '<', 34.400001525878906, NULL, NULL, NULL, NULL),
(134, 224, 1, 100, NULL, NULL, '<=', 1.100000023841858, NULL, NULL),
(135, 224, 2, 75, '<', 1.100000023841858, '<=', 1.7000000476837158, NULL, NULL),
(136, 224, 3, 50, '<', 1.7000000476837158, '<=', 2.4000000953674316, NULL, NULL),
(137, 224, 4, 25, '<', 2.4000000953674316, NULL, NULL, NULL, NULL),
(138, 225, 1, 100, NULL, NULL, '<=', 25.200000762939453, NULL, NULL),
(139, 225, 2, 75, '<', 25.200000762939453, '<=', 30.200000762939453, NULL, NULL),
(140, 225, 3, 50, '<', 30.200000762939453, '<=', 34.33000183105469, NULL, NULL),
(141, 225, 4, 25, '<', 34.33000183105469, NULL, NULL, NULL, NULL),
(142, 226, 1, 100, '<', 31.579999923706055, NULL, NULL, NULL, NULL),
(143, 226, 2, 75, '<', 20, '<=', 31.579999923706055, NULL, NULL),
(144, 226, 3, 50, '<', 6.909999847412109, '<=', 20, NULL, NULL),
(145, 226, 4, 25, NULL, NULL, '<=', 6.909999847412109, NULL, NULL),
(146, 227, 1, 100, '<', 98.79000091552734, NULL, NULL, NULL, NULL),
(147, 227, 2, 75, '<', 87.95999908447266, '<=', 98.79000091552734, NULL, NULL),
(148, 227, 3, 50, '<', 61.150001525878906, '<=', 87.95999908447266, NULL, NULL),
(149, 227, 4, 25, NULL, NULL, '<=', 61.150001525878906, NULL, NULL),
(150, 228, 1, 100, NULL, NULL, '<=', 6.989999771118164, NULL, NULL),
(151, 228, 2, 75, '<', 6.989999771118164, '<=', 10.220000267028809, NULL, NULL),
(152, 228, 3, 50, '<', 10.220000267028809, '<=', 15.130000114440918, NULL, NULL),
(153, 228, 4, 25, '<', 15.130000114440918, NULL, NULL, NULL, NULL),
(154, 229, 1, 100, NULL, NULL, '<=', 49.540000915527344, NULL, NULL),
(155, 229, 2, 75, '<', 49.540000915527344, '<=', 147, NULL, NULL),
(156, 229, 3, 50, '<', 147, '<=', 840.75, NULL, NULL),
(157, 229, 4, 25, '<', 840.75, NULL, NULL, NULL, NULL),
(158, 230, 1, 100, '<', 574858, NULL, NULL, NULL, NULL),
(159, 230, 2, 75, '<', 258339, '<=', 574858, NULL, NULL),
(160, 230, 3, 50, '<', 138928.25, '<=', 258339, NULL, NULL),
(161, 230, 4, 25, NULL, NULL, '<=', 138928.25, NULL, NULL),
(162, 231, 1, 100, '<', 77.7699966430664, NULL, NULL, NULL, NULL),
(163, 231, 2, 75, '<', 73.01000213623047, '<=', 77.7699966430664, NULL, NULL),
(164, 231, 3, 50, '<', 64.5199966430664, '<=', 73.01000213623047, NULL, NULL),
(165, 231, 4, 25, NULL, NULL, '<=', 64.5199966430664, NULL, NULL),
(166, 232, 1, 100, NULL, NULL, '<=', 3.2799999713897705, NULL, NULL),
(167, 232, 2, 75, '<', 3.2799999713897705, '<=', 9.270000457763672, NULL, NULL),
(168, 232, 3, 50, '<', 9.270000457763672, '<=', 23.65999984741211, NULL, NULL),
(169, 232, 4, 25, '<', 23.65999984741211, NULL, NULL, NULL, NULL),
(170, 233, 1, 100, NULL, NULL, '<=', 0, NULL, NULL),
(171, 233, 2, 75, '<', 0, '<=', 0, NULL, NULL),
(172, 233, 3, 50, '<', 0, '<=', 0.029999999329447746, NULL, NULL),
(173, 233, 4, 25, '<', 0.029999999329447746, NULL, NULL, NULL, NULL),
(174, 234, 1, 100, NULL, NULL, '<=', 0, NULL, NULL),
(175, 234, 2, 75, '<', 0, '<=', 0, NULL, NULL),
(176, 234, 3, 50, '<', 0, '<=', 0.05000000074505806, NULL, NULL),
(177, 234, 4, 25, '<', 0.05000000074505806, NULL, NULL, NULL, NULL),
(178, 235, 1, 100, NULL, NULL, '<=', 0, NULL, NULL),
(179, 235, 2, 75, '<', 0, '<=', 0, NULL, NULL),
(180, 235, 3, 50, '<', 0, '<=', 0, NULL, NULL),
(181, 235, 4, 25, '<', 0, NULL, NULL, NULL, NULL),
(182, 236, 1, 100, NULL, NULL, '<=', 0, NULL, NULL),
(183, 236, 2, 75, '<', 0, '<=', 0.009999999776482582, NULL, NULL),
(184, 236, 3, 50, '<', 0.009999999776482582, '<=', 0.3100000023841858, NULL, NULL),
(185, 236, 4, 25, '<', 0.3100000023841858, NULL, NULL, NULL, NULL),
(186, 237, 1, 100, '<', 17.729999542236328, NULL, NULL, NULL, NULL),
(187, 237, 2, 75, '<', 15.350000381469727, '<=', 17.729999542236328, NULL, NULL),
(188, 237, 3, 50, '<', 12.9399995803833, '<=', 15.350000381469727, NULL, NULL),
(189, 237, 4, 25, NULL, NULL, '<=', 12.9399995803833, NULL, NULL),
(190, 238, 1, 100, '<', 97.43250274658203, NULL, NULL, NULL, NULL),
(191, 238, 2, 75, '<', 74.04000091552734, '<=', 97.43250274658203, NULL, NULL),
(192, 238, 3, 50, '<', 28.762500762939453, '<=', 74.04000091552734, NULL, NULL),
(193, 238, 4, 25, NULL, NULL, '<=', 28.762500762939453, NULL, NULL),
(194, 239, 1, 100, '<', 100, NULL, NULL, NULL, NULL),
(195, 239, 2, 75, '<', 100, '<=', 100, NULL, NULL),
(196, 239, 3, 50, '<', 98.37000274658203, '<=', 100, NULL, NULL),
(197, 239, 4, 25, NULL, NULL, '<=', 98.37000274658203, NULL, NULL),
(198, 240, 1, 100, '<', 63.875, NULL, NULL, NULL, NULL),
(199, 240, 2, 75, '<', 62.599998474121094, '<=', 63.875, NULL, NULL),
(200, 240, 3, 50, '<', 61.474998474121094, '<=', 62.599998474121094, NULL, NULL),
(201, 240, 4, 25, NULL, NULL, '<=', 61.474998474121094, NULL, NULL),
(202, 241, 1, 100, '<', 143714.5, NULL, NULL, NULL, NULL),
(203, 241, 2, 75, '<', 64584.75, '<=', 143714.5, NULL, NULL),
(204, 241, 3, 50, '<', 34732.05859375, '<=', 64584.75, NULL, NULL),
(205, 241, 4, 25, NULL, NULL, '<=', 34732.05859375, NULL, NULL),
(206, 242, 1, 100, '<', 0.0009800000116229057, NULL, NULL, NULL, NULL),
(207, 242, 2, 75, '<', 0.0006600000197067857, '<=', 0.0009800000116229057, NULL, NULL),
(208, 242, 3, 50, '<', 0.0003800000122282654, '<=', 0.0006600000197067857, NULL, NULL),
(209, 242, 4, 25, NULL, NULL, '<=', 0.0003800000122282654, NULL, NULL),
(215, 409, 1, 100, '<', 141018, NULL, NULL, NULL, NULL),
(216, 410, 1, 100, '<', 40006.78125, NULL, NULL, NULL, NULL),
(217, 358, 1, 100, '<', 6.21, NULL, NULL, NULL, NULL),
(218, 409, 2, 75, '<', 31369, '<=', 141018, NULL, NULL),
(219, 409, 3, 50, '<', 8836, '<=', 31369, NULL, NULL),
(220, 409, 4, 25, NULL, NULL, '<=', 8836, NULL, NULL),
(221, 410, 2, 75, '<', 26109.197265625, '<=', 40006.78125, NULL, NULL),
(222, 410, 3, 50, '<', 18742.705078125, '<=', 26109.189453125, NULL, NULL),
(223, 410, 4, 25, NULL, NULL, '<=', 18742.705078125, NULL, NULL),
(224, 411, 1, 100, '<', 1744463.125, NULL, NULL, NULL, NULL),
(225, 411, 2, 75, '<', 975281.91, '<=', 1744463.17, NULL, NULL),
(226, 411, 3, 50, '<', 526771.39, '<=', 975281.91, NULL, NULL),
(227, 411, 4, 25, NULL, NULL, '<=', 526771.39, NULL, NULL),
(228, 412, 1, 100, '<', 30.26, NULL, NULL, NULL, NULL),
(229, 412, 2, 75, '<', 25.67, '<=', 30.26, NULL, NULL),
(230, 412, 3, 50, '<', 22.62, '<=', 25.67, NULL, NULL),
(231, 412, 4, 25, NULL, NULL, '<=', 22.62, NULL, NULL),
(232, 413, 1, 100, '<', 18.36, NULL, NULL, NULL, NULL),
(233, 413, 2, 75, '<', 15.48, '<=', 18.36, NULL, NULL),
(234, 413, 3, 50, '<', 12.84, '<=', 15.48, NULL, NULL),
(235, 413, 4, 25, NULL, NULL, '<=', 12.84, NULL, NULL),
(236, 414, 1, 100, NULL, NULL, '<=', 19.75, NULL, NULL),
(237, 414, 2, 75, '<', 19.75, '<=', 31.5, NULL, NULL),
(238, 414, 3, 50, '<', 31.5, '<=', 56.25, NULL, NULL),
(239, 414, 4, 25, '<', 56.25, NULL, NULL, NULL, NULL),
(240, 415, 1, 100, '<', 403003, NULL, NULL, NULL, NULL),
(241, 415, 2, 75, '<', 183733, '<=', 403003, NULL, NULL),
(242, 415, 3, 50, '<', 71486, '<=', 183733, NULL, NULL),
(243, 415, 4, 25, NULL, NULL, '<=', 71486, NULL, NULL),
(244, 358, 2, 75, '<', 2.76, '<=', 6.21, NULL, NULL),
(245, 358, 3, 50, '<', 1.09, '<=', 2.76, NULL, NULL),
(246, 358, 4, 25, NULL, NULL, '<=', 1.09, NULL, NULL),
(247, 417, 1, 100, NULL, NULL, NULL, NULL, 'Saudara', NULL),
(248, 417, 26, 0, NULL, NULL, NULL, NULL, 'Musuh', NULL),
(249, 421, 1, NULL, NULL, NULL, NULL, NULL, 'Ini adalah contoh pilihan', NULL),
(250, 422, 1, NULL, NULL, NULL, NULL, NULL, 'Ini adalah contoh pilihan', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reset_account`
--

CREATE TABLE `reset_account` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `reset_pass_key` varchar(40) NOT NULL,
  `expiration` datetime NOT NULL,
  `used` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'kalo udh reset password, maka akan jadi 1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ini kayanya ga kepake';

--
-- Dumping data untuk tabel `reset_account`
--

INSERT INTO `reset_account` (`id`, `user`, `reset_pass_key`, `expiration`, `used`) VALUES
(4, 31, '61', '2019-11-06 15:22:17', 0),
(5, 31, '0', '2019-11-06 15:23:23', 0),
(6, 31, '6293927676ad7e4112b7bcf1adf904', '2019-11-06 15:25:58', 0),
(7, 31, '61f348dbfc99215070417b9d49da66', '2019-11-16 11:00:00', 0),
(8, 31, 'ba00aa838a860ed2b972588ca0de1b', '2019-11-16 11:30:13', 0),
(9, 7, '2b656a60e22f12f0b84328d3ea4f05', '2020-01-14 09:10:31', 0),
(10, 7, 'f98f139fec22f48c2b6ab9b8122823', '2020-01-14 09:13:22', 0),
(11, 51, 'a9b965daa89a77d82532b919b4b672', '2020-02-14 15:35:29', 1),
(12, 55, 'fd524e7073dda606a1689072b89bc3', '2020-02-21 11:11:42', 0),
(13, 56, '04803dfc72918feb86a495149b25b6', '2020-02-21 11:12:49', 0),
(14, 57, '3beeea01eb839e889cbbd824de3eaf', '2020-02-21 11:18:38', 1),
(15, 342, '1952a185302b9aa8103e4166b10e7d', '2020-04-03 13:18:15', 1),
(16, 345, '1c6d14b76b19c5f30b8afa56c6168a', '2020-04-03 04:14:05', 1),
(17, 346, 'afe3ac96338b47eec2af264f7505b4', '2020-04-03 04:23:05', 1),
(18, 347, 'ab5482430330b5059aab02f1d469fc', '2020-04-03 04:37:23', 0),
(19, 347, 'c6f67e4de9b8d65108013947ba400e', '2020-04-03 04:38:42', 1),
(20, 348, 'ab329c979c54be9eca9747819672b9', '2020-04-03 05:43:28', 1),
(21, 348, 'bf251723b9b73b5243d67823e2d46e', '2020-04-03 05:48:45', 1),
(22, 348, '8f17f324200164df5571ecf2d8f23b', '2020-04-03 05:51:44', 1),
(23, 349, 'e5c293fc7f67c737fed6d1ffceeed6', '2020-08-26 06:05:33', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_commentmeta`
--

CREATE TABLE `scinstass_commentmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_comments`
--

CREATE TABLE `scinstass_comments` (
  `comment_ID` bigint(20) UNSIGNED NOT NULL,
  `comment_post_ID` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `comment_author` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT 0,
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'comment',
  `comment_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `scinstass_comments`
--

INSERT INTO `scinstass_comments` (`comment_ID`, `comment_post_ID`, `comment_author`, `comment_author_email`, `comment_author_url`, `comment_author_IP`, `comment_date`, `comment_date_gmt`, `comment_content`, `comment_karma`, `comment_approved`, `comment_agent`, `comment_type`, `comment_parent`, `user_id`) VALUES
(1, 1, 'A WordPress Commenter', 'wapuu@wordpress.example', 'https://wordpress.org/', '', '2020-08-18 05:27:51', '2020-08-18 05:27:51', 'Hi, this is a comment.\nTo get started with moderating, editing, and deleting comments, please visit the Comments screen in the dashboard.\nCommenter avatars come from <a href=\"https://gravatar.com\">Gravatar</a>.', 0, '1', '', 'comment', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_links`
--

CREATE TABLE `scinstass_links` (
  `link_id` bigint(20) UNSIGNED NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `link_rating` int(11) NOT NULL DEFAULT 0,
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_options`
--

CREATE TABLE `scinstass_options` (
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `scinstass_options`
--

INSERT INTO `scinstass_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(1, 'siteurl', 'https://smartcity.ui.ac.id/instrumentassessment', 'yes'),
(2, 'home', 'https://smartcity.ui.ac.id/instrumentassessment', 'yes'),
(3, 'blogname', 'Instrument Assessment Smartcity UI', 'yes'),
(4, 'blogdescription', 'Just another WordPress site', 'yes'),
(5, 'users_can_register', '0', 'yes'),
(6, 'admin_email', 'ccr.smartcity@ui.ac.id', 'yes'),
(7, 'start_of_week', '1', 'yes'),
(8, 'use_balanceTags', '0', 'yes'),
(9, 'use_smilies', '1', 'yes'),
(10, 'require_name_email', '1', 'yes'),
(11, 'comments_notify', '1', 'yes'),
(12, 'posts_per_rss', '10', 'yes'),
(13, 'rss_use_excerpt', '0', 'yes'),
(14, 'mailserver_url', 'mail.example.com', 'yes'),
(15, 'mailserver_login', 'login@example.com', 'yes'),
(16, 'mailserver_pass', 'password', 'yes'),
(17, 'mailserver_port', '110', 'yes'),
(18, 'default_category', '1', 'yes'),
(19, 'default_comment_status', 'open', 'yes'),
(20, 'default_ping_status', 'open', 'yes'),
(21, 'default_pingback_flag', '1', 'yes'),
(22, 'posts_per_page', '10', 'yes'),
(23, 'date_format', 'F j, Y', 'yes'),
(24, 'time_format', 'g:i a', 'yes'),
(25, 'links_updated_date_format', 'F j, Y g:i a', 'yes'),
(26, 'comment_moderation', '0', 'yes'),
(27, 'moderation_notify', '1', 'yes'),
(28, 'permalink_structure', '/index.php/%year%/%monthnum%/%day%/%postname%/', 'yes'),
(29, 'rewrite_rules', 'a:79:{s:11:\"^wp-json/?$\";s:22:\"index.php?rest_route=/\";s:14:\"^wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:21:\"^index.php/wp-json/?$\";s:22:\"index.php?rest_route=/\";s:24:\"^index.php/wp-json/(.*)?\";s:33:\"index.php?rest_route=/$matches[1]\";s:17:\"^wp-sitemap\\.xml$\";s:23:\"index.php?sitemap=index\";s:17:\"^wp-sitemap\\.xsl$\";s:36:\"index.php?sitemap-stylesheet=sitemap\";s:23:\"^wp-sitemap-index\\.xsl$\";s:34:\"index.php?sitemap-stylesheet=index\";s:48:\"^wp-sitemap-([a-z]+?)-([a-z\\d_-]+?)-(\\d+?)\\.xml$\";s:75:\"index.php?sitemap=$matches[1]&sitemap-subtype=$matches[2]&paged=$matches[3]\";s:34:\"^wp-sitemap-([a-z]+?)-(\\d+?)\\.xml$\";s:47:\"index.php?sitemap=$matches[1]&paged=$matches[2]\";s:48:\".*wp-(atom|rdf|rss|rss2|feed|commentsrss2)\\.php$\";s:18:\"index.php?feed=old\";s:20:\".*wp-app\\.php(/.*)?$\";s:19:\"index.php?error=403\";s:18:\".*wp-register.php$\";s:23:\"index.php?register=true\";s:42:\"index.php/feed/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:37:\"index.php/(feed|rdf|rss|rss2|atom)/?$\";s:27:\"index.php?&feed=$matches[1]\";s:18:\"index.php/embed/?$\";s:21:\"index.php?&embed=true\";s:30:\"index.php/page/?([0-9]{1,})/?$\";s:28:\"index.php?&paged=$matches[1]\";s:51:\"index.php/comments/feed/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:46:\"index.php/comments/(feed|rdf|rss|rss2|atom)/?$\";s:42:\"index.php?&feed=$matches[1]&withcomments=1\";s:27:\"index.php/comments/embed/?$\";s:21:\"index.php?&embed=true\";s:54:\"index.php/search/(.+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:49:\"index.php/search/(.+)/(feed|rdf|rss|rss2|atom)/?$\";s:40:\"index.php?s=$matches[1]&feed=$matches[2]\";s:30:\"index.php/search/(.+)/embed/?$\";s:34:\"index.php?s=$matches[1]&embed=true\";s:42:\"index.php/search/(.+)/page/?([0-9]{1,})/?$\";s:41:\"index.php?s=$matches[1]&paged=$matches[2]\";s:24:\"index.php/search/(.+)/?$\";s:23:\"index.php?s=$matches[1]\";s:57:\"index.php/author/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:52:\"index.php/author/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:50:\"index.php?author_name=$matches[1]&feed=$matches[2]\";s:33:\"index.php/author/([^/]+)/embed/?$\";s:44:\"index.php?author_name=$matches[1]&embed=true\";s:45:\"index.php/author/([^/]+)/page/?([0-9]{1,})/?$\";s:51:\"index.php?author_name=$matches[1]&paged=$matches[2]\";s:27:\"index.php/author/([^/]+)/?$\";s:33:\"index.php?author_name=$matches[1]\";s:79:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:74:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:80:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&feed=$matches[4]\";s:55:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/embed/?$\";s:74:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&embed=true\";s:67:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&paged=$matches[4]\";s:49:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/?$\";s:63:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]\";s:66:\"index.php/([0-9]{4})/([0-9]{1,2})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:61:\"index.php/([0-9]{4})/([0-9]{1,2})/(feed|rdf|rss|rss2|atom)/?$\";s:64:\"index.php?year=$matches[1]&monthnum=$matches[2]&feed=$matches[3]\";s:42:\"index.php/([0-9]{4})/([0-9]{1,2})/embed/?$\";s:58:\"index.php?year=$matches[1]&monthnum=$matches[2]&embed=true\";s:54:\"index.php/([0-9]{4})/([0-9]{1,2})/page/?([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]\";s:36:\"index.php/([0-9]{4})/([0-9]{1,2})/?$\";s:47:\"index.php?year=$matches[1]&monthnum=$matches[2]\";s:53:\"index.php/([0-9]{4})/feed/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:48:\"index.php/([0-9]{4})/(feed|rdf|rss|rss2|atom)/?$\";s:43:\"index.php?year=$matches[1]&feed=$matches[2]\";s:29:\"index.php/([0-9]{4})/embed/?$\";s:37:\"index.php?year=$matches[1]&embed=true\";s:41:\"index.php/([0-9]{4})/page/?([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&paged=$matches[2]\";s:23:\"index.php/([0-9]{4})/?$\";s:26:\"index.php?year=$matches[1]\";s:68:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:78:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:98:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:93:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:93:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:74:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:63:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/embed/?$\";s:91:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&embed=true\";s:67:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/trackback/?$\";s:85:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&tb=1\";s:87:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:82:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&feed=$matches[5]\";s:75:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/page/?([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&paged=$matches[5]\";s:82:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)/comment-page-([0-9]{1,})/?$\";s:98:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&cpage=$matches[5]\";s:71:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)(?:/([0-9]+))?/?$\";s:97:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&name=$matches[4]&page=$matches[5]\";s:57:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:67:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:87:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:82:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:82:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:63:\"index.php/[0-9]{4}/[0-9]{1,2}/[0-9]{1,2}/[^/]+/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:74:\"index.php/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:81:\"index.php?year=$matches[1]&monthnum=$matches[2]&day=$matches[3]&cpage=$matches[4]\";s:61:\"index.php/([0-9]{4})/([0-9]{1,2})/comment-page-([0-9]{1,})/?$\";s:65:\"index.php?year=$matches[1]&monthnum=$matches[2]&cpage=$matches[3]\";s:48:\"index.php/([0-9]{4})/comment-page-([0-9]{1,})/?$\";s:44:\"index.php?year=$matches[1]&cpage=$matches[2]\";s:37:\"index.php/.?.+?/attachment/([^/]+)/?$\";s:32:\"index.php?attachment=$matches[1]\";s:47:\"index.php/.?.+?/attachment/([^/]+)/trackback/?$\";s:37:\"index.php?attachment=$matches[1]&tb=1\";s:67:\"index.php/.?.+?/attachment/([^/]+)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"index.php/.?.+?/attachment/([^/]+)/(feed|rdf|rss|rss2|atom)/?$\";s:49:\"index.php?attachment=$matches[1]&feed=$matches[2]\";s:62:\"index.php/.?.+?/attachment/([^/]+)/comment-page-([0-9]{1,})/?$\";s:50:\"index.php?attachment=$matches[1]&cpage=$matches[2]\";s:43:\"index.php/.?.+?/attachment/([^/]+)/embed/?$\";s:43:\"index.php?attachment=$matches[1]&embed=true\";s:26:\"index.php/(.?.+?)/embed/?$\";s:41:\"index.php?pagename=$matches[1]&embed=true\";s:30:\"index.php/(.?.+?)/trackback/?$\";s:35:\"index.php?pagename=$matches[1]&tb=1\";s:50:\"index.php/(.?.+?)/feed/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:45:\"index.php/(.?.+?)/(feed|rdf|rss|rss2|atom)/?$\";s:47:\"index.php?pagename=$matches[1]&feed=$matches[2]\";s:38:\"index.php/(.?.+?)/page/?([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&paged=$matches[2]\";s:45:\"index.php/(.?.+?)/comment-page-([0-9]{1,})/?$\";s:48:\"index.php?pagename=$matches[1]&cpage=$matches[2]\";s:34:\"index.php/(.?.+?)(?:/([0-9]+))?/?$\";s:47:\"index.php?pagename=$matches[1]&page=$matches[2]\";}', 'yes'),
(30, 'hack_file', '0', 'yes'),
(31, 'blog_charset', 'UTF-8', 'yes'),
(32, 'moderation_keys', '', 'no'),
(33, 'active_plugins', 'a:0:{}', 'yes'),
(34, 'category_base', '', 'yes'),
(35, 'ping_sites', 'http://rpc.pingomatic.com/', 'yes'),
(36, 'comment_max_links', '2', 'yes'),
(37, 'gmt_offset', '0', 'yes'),
(38, 'default_email_category', '1', 'yes'),
(39, 'recently_edited', '', 'no'),
(40, 'template', 'twentytwenty', 'yes'),
(41, 'stylesheet', 'twentytwenty', 'yes'),
(42, 'comment_registration', '0', 'yes'),
(43, 'html_type', 'text/html', 'yes'),
(44, 'use_trackback', '0', 'yes'),
(45, 'default_role', 'subscriber', 'yes'),
(46, 'db_version', '48748', 'yes'),
(47, 'uploads_use_yearmonth_folders', '1', 'yes'),
(48, 'upload_path', '', 'yes'),
(49, 'blog_public', '1', 'yes'),
(50, 'default_link_category', '2', 'yes'),
(51, 'show_on_front', 'posts', 'yes'),
(52, 'tag_base', '', 'yes'),
(53, 'show_avatars', '1', 'yes'),
(54, 'avatar_rating', 'G', 'yes'),
(55, 'upload_url_path', '', 'yes'),
(56, 'thumbnail_size_w', '150', 'yes'),
(57, 'thumbnail_size_h', '150', 'yes'),
(58, 'thumbnail_crop', '1', 'yes'),
(59, 'medium_size_w', '300', 'yes'),
(60, 'medium_size_h', '300', 'yes'),
(61, 'avatar_default', 'mystery', 'yes'),
(62, 'large_size_w', '1024', 'yes'),
(63, 'large_size_h', '1024', 'yes'),
(64, 'image_default_link_type', 'none', 'yes'),
(65, 'image_default_size', '', 'yes'),
(66, 'image_default_align', '', 'yes'),
(67, 'close_comments_for_old_posts', '0', 'yes'),
(68, 'close_comments_days_old', '14', 'yes'),
(69, 'thread_comments', '1', 'yes'),
(70, 'thread_comments_depth', '5', 'yes'),
(71, 'page_comments', '0', 'yes'),
(72, 'comments_per_page', '50', 'yes'),
(73, 'default_comments_page', 'newest', 'yes'),
(74, 'comment_order', 'asc', 'yes'),
(75, 'sticky_posts', 'a:0:{}', 'yes'),
(76, 'widget_categories', 'a:2:{i:2;a:4:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:12:\"hierarchical\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(77, 'widget_text', 'a:0:{}', 'yes'),
(78, 'widget_rss', 'a:0:{}', 'yes'),
(79, 'uninstall_plugins', 'a:0:{}', 'no'),
(80, 'timezone_string', '', 'yes'),
(81, 'page_for_posts', '0', 'yes'),
(82, 'page_on_front', '0', 'yes'),
(83, 'default_post_format', '0', 'yes'),
(84, 'link_manager_enabled', '0', 'yes'),
(85, 'finished_splitting_shared_terms', '1', 'yes'),
(86, 'site_icon', '0', 'yes'),
(87, 'medium_large_size_w', '768', 'yes'),
(88, 'medium_large_size_h', '0', 'yes'),
(89, 'wp_page_for_privacy_policy', '3', 'yes'),
(90, 'show_comments_cookies_opt_in', '1', 'yes'),
(91, 'admin_email_lifespan', '1613280467', 'yes'),
(92, 'disallowed_keys', '', 'no'),
(93, 'comment_previously_approved', '1', 'yes'),
(94, 'auto_plugin_theme_update_emails', 'a:0:{}', 'no'),
(95, 'initial_db_version', '48748', 'yes'),
(96, 'SCinstass_user_roles', 'a:5:{s:13:\"administrator\";a:2:{s:4:\"name\";s:13:\"Administrator\";s:12:\"capabilities\";a:61:{s:13:\"switch_themes\";b:1;s:11:\"edit_themes\";b:1;s:16:\"activate_plugins\";b:1;s:12:\"edit_plugins\";b:1;s:10:\"edit_users\";b:1;s:10:\"edit_files\";b:1;s:14:\"manage_options\";b:1;s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:6:\"import\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:8:\"level_10\";b:1;s:7:\"level_9\";b:1;s:7:\"level_8\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;s:12:\"delete_users\";b:1;s:12:\"create_users\";b:1;s:17:\"unfiltered_upload\";b:1;s:14:\"edit_dashboard\";b:1;s:14:\"update_plugins\";b:1;s:14:\"delete_plugins\";b:1;s:15:\"install_plugins\";b:1;s:13:\"update_themes\";b:1;s:14:\"install_themes\";b:1;s:11:\"update_core\";b:1;s:10:\"list_users\";b:1;s:12:\"remove_users\";b:1;s:13:\"promote_users\";b:1;s:18:\"edit_theme_options\";b:1;s:13:\"delete_themes\";b:1;s:6:\"export\";b:1;}}s:6:\"editor\";a:2:{s:4:\"name\";s:6:\"Editor\";s:12:\"capabilities\";a:34:{s:17:\"moderate_comments\";b:1;s:17:\"manage_categories\";b:1;s:12:\"manage_links\";b:1;s:12:\"upload_files\";b:1;s:15:\"unfiltered_html\";b:1;s:10:\"edit_posts\";b:1;s:17:\"edit_others_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:10:\"edit_pages\";b:1;s:4:\"read\";b:1;s:7:\"level_7\";b:1;s:7:\"level_6\";b:1;s:7:\"level_5\";b:1;s:7:\"level_4\";b:1;s:7:\"level_3\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:17:\"edit_others_pages\";b:1;s:20:\"edit_published_pages\";b:1;s:13:\"publish_pages\";b:1;s:12:\"delete_pages\";b:1;s:19:\"delete_others_pages\";b:1;s:22:\"delete_published_pages\";b:1;s:12:\"delete_posts\";b:1;s:19:\"delete_others_posts\";b:1;s:22:\"delete_published_posts\";b:1;s:20:\"delete_private_posts\";b:1;s:18:\"edit_private_posts\";b:1;s:18:\"read_private_posts\";b:1;s:20:\"delete_private_pages\";b:1;s:18:\"edit_private_pages\";b:1;s:18:\"read_private_pages\";b:1;}}s:6:\"author\";a:2:{s:4:\"name\";s:6:\"Author\";s:12:\"capabilities\";a:10:{s:12:\"upload_files\";b:1;s:10:\"edit_posts\";b:1;s:20:\"edit_published_posts\";b:1;s:13:\"publish_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_2\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;s:22:\"delete_published_posts\";b:1;}}s:11:\"contributor\";a:2:{s:4:\"name\";s:11:\"Contributor\";s:12:\"capabilities\";a:5:{s:10:\"edit_posts\";b:1;s:4:\"read\";b:1;s:7:\"level_1\";b:1;s:7:\"level_0\";b:1;s:12:\"delete_posts\";b:1;}}s:10:\"subscriber\";a:2:{s:4:\"name\";s:10:\"Subscriber\";s:12:\"capabilities\";a:2:{s:4:\"read\";b:1;s:7:\"level_0\";b:1;}}}', 'yes'),
(97, 'fresh_site', '1', 'yes'),
(98, 'widget_search', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(99, 'widget_recent-posts', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(100, 'widget_recent-comments', 'a:2:{i:2;a:2:{s:5:\"title\";s:0:\"\";s:6:\"number\";i:5;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(101, 'widget_archives', 'a:2:{i:2;a:3:{s:5:\"title\";s:0:\"\";s:5:\"count\";i:0;s:8:\"dropdown\";i:0;}s:12:\"_multiwidget\";i:1;}', 'yes'),
(102, 'widget_meta', 'a:2:{i:2;a:1:{s:5:\"title\";s:0:\"\";}s:12:\"_multiwidget\";i:1;}', 'yes'),
(103, 'sidebars_widgets', 'a:4:{s:19:\"wp_inactive_widgets\";a:0:{}s:9:\"sidebar-1\";a:3:{i:0;s:8:\"search-2\";i:1;s:14:\"recent-posts-2\";i:2;s:17:\"recent-comments-2\";}s:9:\"sidebar-2\";a:3:{i:0;s:10:\"archives-2\";i:1;s:12:\"categories-2\";i:2;s:6:\"meta-2\";}s:13:\"array_version\";i:3;}', 'yes'),
(104, 'cron', 'a:7:{i:1612711673;a:1:{s:34:\"wp_privacy_delete_old_export_files\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"hourly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:3600;}}}i:1612718873;a:3:{s:16:\"wp_version_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:17:\"wp_update_plugins\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}s:16:\"wp_update_themes\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:10:\"twicedaily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:43200;}}}i:1612762072;a:1:{s:32:\"recovery_mode_clean_expired_keys\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1612762360;a:2:{s:19:\"wp_scheduled_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}s:25:\"delete_expired_transients\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1612762362;a:1:{s:30:\"wp_scheduled_auto_draft_delete\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:5:\"daily\";s:4:\"args\";a:0:{}s:8:\"interval\";i:86400;}}}i:1612934872;a:1:{s:30:\"wp_site_health_scheduled_check\";a:1:{s:32:\"40cd750bba9870f18aada2478b24840a\";a:3:{s:8:\"schedule\";s:6:\"weekly\";s:4:\"args\";a:0:{}s:8:\"interval\";i:604800;}}}s:7:\"version\";i:2;}', 'yes'),
(105, 'widget_pages', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(106, 'widget_calendar', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(107, 'widget_media_audio', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(108, 'widget_media_image', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(109, 'widget_media_gallery', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(110, 'widget_media_video', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(111, 'widget_tag_cloud', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(112, 'widget_nav_menu', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(113, 'widget_custom_html', 'a:1:{s:12:\"_multiwidget\";i:1;}', 'yes'),
(115, 'theme_mods_twentytwenty', 'a:1:{s:18:\"custom_css_post_id\";i:-1;}', 'yes'),
(116, 'recovery_keys', 'a:0:{}', 'yes'),
(117, '_site_transient_update_core', 'O:8:\"stdClass\":4:{s:7:\"updates\";a:5:{i:0;O:8:\"stdClass\":10:{s:8:\"response\";s:7:\"upgrade\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.6.1.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.6.1.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.6.1-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.6.1-new-bundled.zip\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:5:\"5.6.1\";s:7:\"version\";s:5:\"5.6.1\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.6\";s:15:\"partial_version\";s:0:\"\";}i:1;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.6.1.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.6.1.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.6.1-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.6.1-new-bundled.zip\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:5:\"5.6.1\";s:7:\"version\";s:5:\"5.6.1\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.6\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:2;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:57:\"https://downloads.wordpress.org/release/wordpress-5.6.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:57:\"https://downloads.wordpress.org/release/wordpress-5.6.zip\";s:10:\"no_content\";s:68:\"https://downloads.wordpress.org/release/wordpress-5.6-no-content.zip\";s:11:\"new_bundled\";s:69:\"https://downloads.wordpress.org/release/wordpress-5.6-new-bundled.zip\";s:7:\"partial\";s:0:\"\";s:8:\"rollback\";s:0:\"\";}s:7:\"current\";s:3:\"5.6\";s:7:\"version\";s:3:\"5.6\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.6\";s:15:\"partial_version\";s:0:\"\";s:9:\"new_files\";s:1:\"1\";}i:3;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.5.3.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.5.3.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.5.3-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.5.3-new-bundled.zip\";s:7:\"partial\";s:69:\"https://downloads.wordpress.org/release/wordpress-5.5.3-partial-0.zip\";s:8:\"rollback\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.5.3-rollback-0.zip\";}s:7:\"current\";s:5:\"5.5.3\";s:7:\"version\";s:5:\"5.5.3\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.6\";s:15:\"partial_version\";s:3:\"5.5\";s:9:\"new_files\";s:0:\"\";}i:4;O:8:\"stdClass\":11:{s:8:\"response\";s:10:\"autoupdate\";s:8:\"download\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.5.2.zip\";s:6:\"locale\";s:5:\"en_US\";s:8:\"packages\";O:8:\"stdClass\":5:{s:4:\"full\";s:59:\"https://downloads.wordpress.org/release/wordpress-5.5.2.zip\";s:10:\"no_content\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.5.2-no-content.zip\";s:11:\"new_bundled\";s:71:\"https://downloads.wordpress.org/release/wordpress-5.5.2-new-bundled.zip\";s:7:\"partial\";s:69:\"https://downloads.wordpress.org/release/wordpress-5.5.2-partial-0.zip\";s:8:\"rollback\";s:70:\"https://downloads.wordpress.org/release/wordpress-5.5.2-rollback-0.zip\";}s:7:\"current\";s:5:\"5.5.2\";s:7:\"version\";s:5:\"5.5.2\";s:11:\"php_version\";s:6:\"5.6.20\";s:13:\"mysql_version\";s:3:\"5.0\";s:11:\"new_bundled\";s:3:\"5.6\";s:15:\"partial_version\";s:3:\"5.5\";s:9:\"new_files\";s:0:\"\";}}s:12:\"last_checked\";i:1612708759;s:15:\"version_checked\";s:3:\"5.5\";s:12:\"translations\";a:0:{}}', 'no'),
(130, 'can_compress_scripts', '0', 'no'),
(143, 'finished_updating_comment_type', '1', 'yes'),
(150, '_transient_health-check-site-status-result', '{\"good\":11,\"recommended\":9,\"critical\":0}', 'yes'),
(183, '_site_transient_timeout_theme_roots', '1612710561', 'no'),
(184, '_site_transient_theme_roots', 'a:3:{s:14:\"twentynineteen\";s:7:\"/themes\";s:15:\"twentyseventeen\";s:7:\"/themes\";s:12:\"twentytwenty\";s:7:\"/themes\";}', 'no'),
(185, '_site_transient_update_themes', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1612708764;s:7:\"checked\";a:3:{s:14:\"twentynineteen\";s:3:\"1.7\";s:15:\"twentyseventeen\";s:3:\"2.4\";s:12:\"twentytwenty\";s:3:\"1.5\";}s:8:\"response\";a:3:{s:14:\"twentynineteen\";a:6:{s:5:\"theme\";s:14:\"twentynineteen\";s:11:\"new_version\";s:3:\"1.9\";s:3:\"url\";s:44:\"https://wordpress.org/themes/twentynineteen/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/theme/twentynineteen.1.9.zip\";s:8:\"requires\";s:5:\"4.9.6\";s:12:\"requires_php\";s:5:\"5.2.4\";}s:15:\"twentyseventeen\";a:6:{s:5:\"theme\";s:15:\"twentyseventeen\";s:11:\"new_version\";s:3:\"2.5\";s:3:\"url\";s:45:\"https://wordpress.org/themes/twentyseventeen/\";s:7:\"package\";s:61:\"https://downloads.wordpress.org/theme/twentyseventeen.2.5.zip\";s:8:\"requires\";s:3:\"4.7\";s:12:\"requires_php\";s:5:\"5.2.4\";}s:12:\"twentytwenty\";a:6:{s:5:\"theme\";s:12:\"twentytwenty\";s:11:\"new_version\";s:3:\"1.6\";s:3:\"url\";s:42:\"https://wordpress.org/themes/twentytwenty/\";s:7:\"package\";s:58:\"https://downloads.wordpress.org/theme/twentytwenty.1.6.zip\";s:8:\"requires\";s:3:\"4.7\";s:12:\"requires_php\";s:5:\"5.2.4\";}}s:9:\"no_update\";a:0:{}s:12:\"translations\";a:0:{}}', 'no'),
(186, '_site_transient_update_plugins', 'O:8:\"stdClass\":5:{s:12:\"last_checked\";i:1612708765;s:7:\"checked\";a:2:{s:19:\"akismet/akismet.php\";s:5:\"4.1.6\";s:9:\"hello.php\";s:5:\"1.7.2\";}s:8:\"response\";a:1:{s:19:\"akismet/akismet.php\";O:8:\"stdClass\":12:{s:2:\"id\";s:21:\"w.org/plugins/akismet\";s:4:\"slug\";s:7:\"akismet\";s:6:\"plugin\";s:19:\"akismet/akismet.php\";s:11:\"new_version\";s:5:\"4.1.8\";s:3:\"url\";s:38:\"https://wordpress.org/plugins/akismet/\";s:7:\"package\";s:56:\"https://downloads.wordpress.org/plugin/akismet.4.1.8.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:59:\"https://ps.w.org/akismet/assets/icon-256x256.png?rev=969272\";s:2:\"1x\";s:59:\"https://ps.w.org/akismet/assets/icon-128x128.png?rev=969272\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:61:\"https://ps.w.org/akismet/assets/banner-772x250.jpg?rev=479904\";}s:11:\"banners_rtl\";a:0:{}s:6:\"tested\";s:5:\"5.6.1\";s:12:\"requires_php\";b:0;s:13:\"compatibility\";O:8:\"stdClass\":0:{}}}s:12:\"translations\";a:0:{}s:9:\"no_update\";a:1:{s:9:\"hello.php\";O:8:\"stdClass\":9:{s:2:\"id\";s:25:\"w.org/plugins/hello-dolly\";s:4:\"slug\";s:11:\"hello-dolly\";s:6:\"plugin\";s:9:\"hello.php\";s:11:\"new_version\";s:5:\"1.7.2\";s:3:\"url\";s:42:\"https://wordpress.org/plugins/hello-dolly/\";s:7:\"package\";s:60:\"https://downloads.wordpress.org/plugin/hello-dolly.1.7.2.zip\";s:5:\"icons\";a:2:{s:2:\"2x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-256x256.jpg?rev=2052855\";s:2:\"1x\";s:64:\"https://ps.w.org/hello-dolly/assets/icon-128x128.jpg?rev=2052855\";}s:7:\"banners\";a:1:{s:2:\"1x\";s:66:\"https://ps.w.org/hello-dolly/assets/banner-772x250.jpg?rev=2052855\";}s:11:\"banners_rtl\";a:0:{}}}}', 'no'),
(187, '_site_transient_timeout_php_check_c35af108126e3879ab2f7bb297998072', '1613313568', 'no'),
(188, '_site_transient_php_check_c35af108126e3879ab2f7bb297998072', 'a:5:{s:19:\"recommended_version\";s:3:\"7.4\";s:15:\"minimum_version\";s:6:\"5.6.20\";s:12:\"is_supported\";b:1;s:9:\"is_secure\";b:1;s:13:\"is_acceptable\";b:1;}', 'no');

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_postmeta`
--

CREATE TABLE `scinstass_postmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `scinstass_postmeta`
--

INSERT INTO `scinstass_postmeta` (`meta_id`, `post_id`, `meta_key`, `meta_value`) VALUES
(1, 2, '_wp_page_template', 'default'),
(2, 3, '_wp_page_template', 'default');

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_posts`
--

CREATE TABLE `scinstass_posts` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `post_author` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `guid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT 0,
  `post_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `scinstass_posts`
--

INSERT INTO `scinstass_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(1, 1, '2020-08-18 05:27:51', '2020-08-18 05:27:51', '<!-- wp:paragraph -->\n<p>Welcome to WordPress. This is your first post. Edit or delete it, then start writing!</p>\n<!-- /wp:paragraph -->', 'Hello world!', '', 'publish', 'open', 'open', '', 'hello-world', '', '', '2020-08-18 05:27:51', '2020-08-18 05:27:51', '', 0, 'https://smartcity.ui.ac.id/instrumentassessment/?p=1', 0, 'post', '', 1),
(2, 1, '2020-08-18 05:27:51', '2020-08-18 05:27:51', '<!-- wp:paragraph -->\n<p>This is an example page. It\'s different from a blog post because it will stay in one place and will show up in your site navigation (in most themes). Most people start with an About page that introduces them to potential site visitors. It might say something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>Hi there! I\'m a bike messenger by day, aspiring actor by night, and this is my website. I live in Los Angeles, have a great dog named Jack, and I like pi&#241;a coladas. (And gettin\' caught in the rain.)</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>...or something like this:</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><p>The XYZ Doohickey Company was founded in 1971, and has been providing quality doohickeys to the public ever since. Located in Gotham City, XYZ employs over 2,000 people and does all kinds of awesome things for the Gotham community.</p></blockquote>\n<!-- /wp:quote -->\n\n<!-- wp:paragraph -->\n<p>As a new WordPress user, you should go to <a href=\"https://smartcity.ui.ac.id/instrumentassessment/wp-admin/\">your dashboard</a> to delete this page and create new pages for your content. Have fun!</p>\n<!-- /wp:paragraph -->', 'Sample Page', '', 'publish', 'closed', 'open', '', 'sample-page', '', '', '2020-08-18 05:27:51', '2020-08-18 05:27:51', '', 0, 'https://smartcity.ui.ac.id/instrumentassessment/?page_id=2', 0, 'page', '', 0),
(3, 1, '2020-08-18 05:27:51', '2020-08-18 05:27:51', '<!-- wp:heading --><h2>Who we are</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Our website address is: https://smartcity.ui.ac.id/instrumentassessment.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What personal data we collect and why we collect it</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Comments</h3><!-- /wp:heading --><!-- wp:paragraph --><p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&#8217;s IP address and browser user agent string to help spam detection.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Media</h3><!-- /wp:heading --><!-- wp:paragraph --><p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Contact forms</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Cookies</h3><!-- /wp:heading --><!-- wp:paragraph --><p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &quot;Remember Me&quot;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Embedded content from other websites</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p><!-- /wp:paragraph --><!-- wp:heading {\"level\":3} --><h3>Analytics</h3><!-- /wp:heading --><!-- wp:heading --><h2>Who we share your data with</h2><!-- /wp:heading --><!-- wp:heading --><h2>How long we retain your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p><!-- /wp:paragraph --><!-- wp:paragraph --><p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>What rights you have over your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Where we send your data</h2><!-- /wp:heading --><!-- wp:paragraph --><p>Visitor comments may be checked through an automated spam detection service.</p><!-- /wp:paragraph --><!-- wp:heading --><h2>Your contact information</h2><!-- /wp:heading --><!-- wp:heading --><h2>Additional information</h2><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>How we protect your data</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What data breach procedures we have in place</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What third parties we receive data from</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>What automated decision making and/or profiling we do with user data</h3><!-- /wp:heading --><!-- wp:heading {\"level\":3} --><h3>Industry regulatory disclosure requirements</h3><!-- /wp:heading -->', 'Privacy Policy', '', 'draft', 'closed', 'open', '', 'privacy-policy', '', '', '2020-08-18 05:27:51', '2020-08-18 05:27:51', '', 0, 'https://smartcity.ui.ac.id/instrumentassessment/?page_id=3', 0, 'page', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_termmeta`
--

CREATE TABLE `scinstass_termmeta` (
  `meta_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_terms`
--

CREATE TABLE `scinstass_terms` (
  `term_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `term_group` bigint(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `scinstass_terms`
--

INSERT INTO `scinstass_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES
(1, 'Uncategorized', 'uncategorized', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_term_relationships`
--

CREATE TABLE `scinstass_term_relationships` (
  `object_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `term_order` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `scinstass_term_relationships`
--

INSERT INTO `scinstass_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES
(1, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_term_taxonomy`
--

CREATE TABLE `scinstass_term_taxonomy` (
  `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL,
  `term_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `scinstass_term_taxonomy`
--

INSERT INTO `scinstass_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(1, 1, 'category', '', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `scinstass_usermeta`
--

CREATE TABLE `scinstass_usermeta` (
  `umeta_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `scinstass_usermeta`
--

INSERT INTO `scinstass_usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'nickname', 'smartcity_inst'),
(2, 1, 'first_name', ''),
(3, 1, 'last_name', ''),
(4, 1, 'description', ''),
(5, 1, 'rich_editing', 'true'),
(6, 1, 'syntax_highlighting', 'true'),
(7, 1, 'comment_shortcuts', 'false'),
(8, 1, 'admin_color', 'fresh'),
(9, 1, 'use_ssl', '0'),
(10, 1, 'show_admin_bar_front', 'true'),
(11, 1, 'locale', ''),
(12, 1, 'SCinstass_capabilities', 'a:1:{s:13:\"administrator\";b:1;}'),
(13, 1, 'SCinstass_user_level', '10'),
(14, 1, 'dismissed_wp_pointers', ''),
(15, 1, 'show_welcome_panel', '1'),
(17, 1, 'SCinstass_dashboard_quick_press_last_post_id', '4'),
(18, 1, 'community-events-location', 'a:1:{s:2:\"ip\";s:12:\"152.118.37.0\";}');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_subscriber`
--

CREATE TABLE `status_subscriber` (
  `id` int(11) NOT NULL,
  `subscriber` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `log` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `subscribers`
--

CREATE TABLE `subscribers` (
  `id_subs` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_user` text CHARACTER SET latin1 NOT NULL,
  `kota_user` text CHARACTER SET latin1 NOT NULL,
  `endpoints` text CHARACTER SET latin1 NOT NULL,
  `auth` text CHARACTER SET latin1 NOT NULL,
  `p256dh` text CHARACTER SET latin1 NOT NULL,
  `status_user` tinyint(1) NOT NULL,
  `log` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `subscribers`
--

INSERT INTO `subscribers` (`id_subs`, `id_user`, `name_user`, `kota_user`, `endpoints`, `auth`, `p256dh`, `status_user`, `log`) VALUES
(320, 341, 'Fuadhli Rahman Katam ', 'Bantul', 'https://fcm.googleapis.com/fcm/send/e0tzU2kaE2Y:APA91bEUJUPcvjRRdqIpU22skNC2qJPa1m-1yYgXhiY3t3ppRDhNl-aUr3-UkOqmFkeLLeC13Xl5wp-L2RGEfD7A0776-xLidStZmQlvj-YBO94Jfi_zV2UuTXN1RCn8Sz-Y2uKNLLNG', 'OfvftBvm3wdXqE7mYBHNCw', 'BLOXN-RHB5PQk2jDydE0YkR4qOu0SIL0SLBgw4iWjL4lKccZeJlfXunD1fqeZGeuu_3KxPQZVs2UILfaDy1GkHM', 1, '2021-05-05'),
(325, 341, 'Fuadhli Rahman Katam ', 'Bantul', 'https://fcm.googleapis.com/fcm/send/elekVzUVAAk:APA91bGwvJfCpSP4_ZAwAFfeBKUZqBUmLIY46Bz1Z7I9rCtwLhEoGudJ2_GQnuZrqn7EEgyUKy7xNkOO6bmY0AuA6upLZVZNjI81ZmVuPZpW5sgo5zZ0LBWwfrbVxt49nnQg6xhRa38c', '5oMr7qNTwAVPsh-JJCu2nA', 'BHMrE3cKh2FkKXvrR6cxoQETPjRha8QyWlTCOsvemoJE1xdL-zWzT4Bb63j-GX71D_Qol8uPJvpYnUYvokntpbo', 1, '2021-05-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(80) NOT NULL COMMENT 'nama lengkap',
  `email` varchar(50) NOT NULL COMMENT 'unique',
  `kota` enum('Aceh Barat','Aceh Barat Daya','Aceh Besar','Aceh Jaya','Aceh Selatan','Aceh Singkil','Aceh Tamiang','Aceh Tengah','Aceh Tenggara','Aceh Timur','Aceh Utara','Agam','Alor','Ambon','Asahan','Asmat','Badung','Balangan','Balikpapan','Banda Aceh','Bandar Lampung','Bandung Kabupaten','Bandung Kota','Bandung Barat','Banggai','Banggai Kepulauan','Banggai Laut','Bangka','Bangka Barat','Bangka Selatan','Bangka Tengah','Bangkalan','Bangli','Banjar Kabupaten','Banjar Kota','Banjarbaru','Banjarmasin','Banjarnegara','Bantaeng','Bantul','Banyuasin','Banyumas','Banyuwangi','Barito Kuala','Barito Selatan','Barito Timur','Barito Utara','Barru','Batam','Batang','Batanghari','Batu','Batu Bara','Bau-Bau','Bekasi Kabupaten','Bekasi Kota','Belitung','Belitung Timur','Belu','Bener Meriah','Bengkalis','Bengkayang','Bengkulu','Bengkulu Selatan','Bengkulu Tengah','Bengkulu Utara','Berau','Biak Numfor','Bima Kabupaten','Bima Kota','Binjai','Bintan','Bireuen','Bitung','Blitar Kabupaten','Blitar Kota','Blora','Boalemo','Bogor Kabupaten','Bogor Kota','Bojonegoro','Bolaang Mongondow','Bolaang Mongondow Selatan','Bolaang Mongondow Timur','Bolaang Mongondow Utara','Bombana','Bondowoso','Bone','Bone Bolango','Bontang','Boven Digoel','Boyolali','Brebes','Bukittinggi','Buleleng','Bulukumba','Bulungan','Bungo','Buol','Buru','Buru Selatan','Buton','Buton Selatan','Buton Tengah','Buton Utara','Ciamis','Cianjur','Cilacap','Cilegon','Cimahi','Cirebon Kabupaten','Cirebon Kota','Dairi','Deiyai','Deli Serdang','Demak','Denpasar','Depok','Dharmasraya','Dogiyai','Dompu','Donggala','Dumai','Empat Lawang','Ende','Enrekang','Fakfak','Flores Timur','Garut','Gayo Lues','Gianyar','Gorontalo Kabupaten','Gorontalo Kota','Gorontalo Utara','Gowa','Gresik','Grobogan','Gunung Mas','Gunungkidul','Gunungsitoli','Halmahera Barat','Halmahera Selatan','Halmahera Tengah','Halmahera Timur','Halmahera Utara','Hulu Sungai Selatan','Hulu Sungai Tengah','Hulu Sungai Utara','Humbang Hasundutan','Indragiri Hilir','Indragiri Hulu','Indramayu','Intan Jaya','Jakarta Barat','Jakarta Pusat','Jakarta Selatan','Jakarta Timur','Jakarta Utara','Jambi','Jayapura Kabupaten','Jayapura Kota','Jayawijaya','Jember','Jembrana','Jeneponto','Jepara','Jombang','Kaimana','Kampar','Kapuas','Kapuas Hulu','Karanganyar','Karangasem','Karawang','Karimun','Karo','Katingan','Kaur','Kayong Utara','Kebumen','Kediri Kabupaten','Kediri Kota','Keerom','Kendal','Kendari','Kepahiang','Kepulauan Anambas','Kepulauan Aru','Kepulauan Mentawai','Kepulauan Meranti','Kepulauan Sangihe','Kepulauan Selayar','Kepulauan Seribu','Kepulauan Siau Tagulandang Biaro','Kepulauan Sula','Kepulauan Talaud','Kepulauan Tanimbar','Kepulauan Yapen','Kerinci','Ketapang','Klaten','Klungkung','Kolaka','Kolaka Timur','Kolaka Utara','Konawe','Konawe Kepulauan','Konawe Selatan','Konawe Utara','Kotabaru','Kotamobagu','Kotawaringin Barat','Kotawaringin Timur','Kuantan Singingi','Kubu Raya','Kudus','Kulon Progo','Kuningan','Kupang Kabupaten','Kupang Kota','Kutai Barat','Kutai Kartanegara','Kutai Timur','Labuhanbatu','Labuhanbatu Selatan','Labuhanbatu Utara','Lahat','Lamandau','Lamongan','Lampung Barat','Lampung Selatan','Lampung Tengah','Lampung Timur','Lampung Utara','Landak','Langkat','Langsa','Lanny Jaya','Lebak','Lebong','Lembata','Lhokseumawe','Lima Puluh Kota','Lingga','Lombok Barat','Lombok Tengah','Lombok Timur','Lombok Utara','Lubuklinggau','Lumajang','Luwu','Luwu Timur','Luwu Utara','Madiun Kabupaten','Madiun Kota','Magelang Kabupaten','Magelang Kota','Magetan','Mahakam Ulu','Majalengka','Majene','Makassar','Malaka','Malang Kabupaten','Malang Kota','Malinau','Maluku Barat Daya','Maluku Tengah','Maluku Tenggara','Mamasa','Mamberamo Raya','Mamberamo Tengah','Mamuju','Mamuju Tengah','Manado','Mandailing Natal','Manggarai','Manggarai Barat','Manggarai Timur','Manokwari','Manokwari Selatan','Mappi','Maros','Mataram','Maybrat','Medan','Melawi','Mempawah','Merangin','Merauke','Mesuji','Metro','Mimika','Minahasa','Minahasa Selatan','Minahasa Tenggara','Minahasa Utara','Mojokerto Kabupaten','Mojokerto Kota','Morowali','Morowali Utara','Muara Enim','Muaro Jambi','Mukomuko','Muna','Muna Barat','Murung Raya','Musi Banyuasin','Musi Rawas','Musi Rawas Utara','Nabire','Nagan Raya','Nagekeo','Natuna','Nduga','Ngada','Nganjuk','Ngawi','Nias','Nias Barat','Nias Selatan','Nias Utara','Nunukan','Ogan Ilir','Ogan Komering Ilir','Ogan Komering Ulu','Ogan Komering Ulu Selatan','Ogan Komering Ulu Timur','Pacitan','Padang','Padang Lawas','Padang Lawas Utara','Padang Pariaman','Padangpanjang','Padangsidempuan','Pagar Alam','Pakpak Bharat','Palangka Raya','Palembang','Palopo','Palu','Pamekasan','Pandeglang','Pangandaran','Pangkajene dan Kepulauan','Pangkal Pinang','Paniai','Parepare','Pariaman','Parigi Moutong','Pasaman','Pasaman Barat','Pasangkayu','Paser','Pasuruan Kabupaten','Pasuruan Kota','Pati','Payakumbuh','Pegunungan Arfak','Pegunungan Bintang','Pekalongan Kabupaten','Pekalongan Kota','Pekanbaru','Pelalawan','Pemalang','Pematangsiantar','Penajam Paser Utara','Penukal Abab Lematang Ilir','Pesawaran','Pesisir Barat','Pesisir Selatan','Pidie','Pidie Jaya','Pinrang','Pohuwato','Polewali Mandar','Ponorogo','Pontianak','Poso','Prabumulih','Pringsewu','Probolinggo Kabupaten','Probolinggo Kota','Pulang Pisau','Pulau Morotai','Pulau Taliabu','Puncak','Puncak Jaya','Purbalingga','Purwakarta','Purworejo','Raja Ampat','Rejang Lebong','Rembang','Rokan Hilir','Rokan Hulu','Rote Ndao','Sabang','Sabu Raijua','Salatiga','Samarinda','Sambas','Samosir','Sampang','Sanggau','Sarmi','Sarolangun','Sawahlunto','Sekadau','Seluma','Semarang Kabupaten','Semarang Kota','Seram Bagian Barat','Seram Bagian Timur','Serang Kabupaten','Serang Kota','Serdang Bedagai','Seruyan','Siak','Sibolga','Sidenreng Rappang','Sidoarjo','Sigi','Sijunjung','Sikka','Simalungun','Simeulue','Singkawang','Sinjai','Sintang','Situbondo','Sleman','Solok Kabupaten','Solok Kota','Solok Selatan','Soppeng','Sorong Kabupaten','Sorong Kota','Sorong Selatan','Sragen','Subang','Subulussalam','Sukabumi Kabupaten','Sukabumi Kota','Sukamara','Sukoharjo','Sumba Barat','Sumba Barat Daya','Sumba Tengah','Sumba Timur','Sumbawa','Sumbawa Barat','Sumedang','Sumenep','Sungaipenuh','Supiori','Surabaya','Surakarta','Tabalong','Tabanan','Takalar','Tambrauw','Tana Tidung','Tana Toraja','Tanah Bumbu','Tanah Datar','Tanah Laut','Tangerang Kabupaten','Tangerang Kota','Tangerang Selatan','Tanggamus','Tanjung Jabung Barat','Tanjung Jabung Timur','Tanjung Pinang','Tanjungbalai','Tapanuli Selatan','Tapanuli Tengah','Tapanuli Utara','Tapin','Tarakan','Tasikmalaya Kabupaten','Tasikmalaya Kota','Tebing Tinggi','Tebo','Tegal Kabupaten','Tegal Kota','Teluk Bintuni','Teluk Wondama','Temanggung','Ternate','Tidore Kepulauan','Timor Tengah Selatan','Timor Tengah Utara','Toba Samosir','Tojo Una-Una','Tolikara','Tolitoli','Tomohon','Toraja Utara','Trenggalek','Tual','Tuban','Tulang Bawang','Tulang Bawang Barat','Tulungagung','Wajo','Wakatobi','Waropen','Way Kanan','Wonogiri','Wonosobo','Yahukimo','Yalimo','Yogyakarta') NOT NULL,
  `provinsi` varchar(80) NOT NULL,
  `photo` varchar(50) NOT NULL COMMENT 'URL lokal utk foto (diisi saat user upload pasfoto)',
  `phone` varchar(50) NOT NULL COMMENT 'no telp, diawali kode negara, tanpa tanda plus',
  `address` tinytext NOT NULL COMMENT 'alamat pos',
  `password` varchar(80) NOT NULL,
  `reset_password` varchar(80) NOT NULL,
  `status` enum('Active','Blocked') NOT NULL DEFAULT 'Blocked' COMMENT 'blocked: ga bisa login (e.g. blm aktivasi email)',
  `role` enum('Admin','Reviewer','Kota') DEFAULT 'Kota',
  `created` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='''Admin'',''Calon mahasiswa'',''Mahasiswa'',''Alumni'',''Dosen'',''Pensiunan'',''Pegawai'',''Manajer'',''Sekretariat''';

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `kota`, `provinsi`, `photo`, `phone`, `address`, `password`, `reset_password`, `status`, `role`, `created`, `last_login`) VALUES
(1, 'Admin Demo', 'demo@admin.com', 'Aceh Barat', 'Aceh', '', '0818221829182', 'Jl. Bona Indah', 'e10adc3949ba59abbe56e057f20f883e', '', 'Active', 'Admin', '2017-06-26 14:37:16', '2021-06-26 08:43:00'),
(341, 'Fuadhli Rahman Katam ', '192132@ruki.web.id', 'Bantul', '', '', '', '', '25f9e794323b453885f5181f1b624d0b', '', 'Active', 'Reviewer', '2020-03-24 18:43:13', '2021-06-09 16:08:34'),
(348, 'Fatih', 'indokan1945@gmail.com', 'Bandung Kota', 'Jawa Barat', '', '', '', '77963b7a931377ad4ab5ad6a9cd718aa', '', 'Active', 'Kota', NULL, '2021-02-25 11:04:51'),
(349, 'Lumi Lumi', 'lumi@lumi.co.id', 'Cimahi', 'Jawa Barat', '', '', '', '123456789', '', 'Active', 'Kota', '2020-05-14 17:37:50', '2021-04-27 05:24:01'),
(351, 'Muhamad Fadil', 'gepeng12121@yahoo.com', 'Aceh Barat', '', '', '087881490385', 'Jl. Bona Indah', '12345678', '', 'Active', 'Admin', '2021-05-26 17:00:00', NULL),
(358, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL),
(361, 'Client', 'test@client.com', 'Alor', 'Alor', '', '00099887', 'Alor', 'e10adc3949ba59abbe56e057f20f883e', '', 'Active', 'Reviewer', '2021-06-25 17:00:00', '2021-06-26 08:47:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `activate_account`
--
ALTER TABLE `activate_account`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ci_users`
--
ALTER TABLE `ci_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_jawaban_angka`
--
ALTER TABLE `jenis_jawaban_angka`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_jawaban_enum`
--
ALTER TABLE `jenis_jawaban_enum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reset_account`
--
ALTER TABLE `reset_account`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `scinstass_commentmeta`
--
ALTER TABLE `scinstass_commentmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indeks untuk tabel `scinstass_comments`
--
ALTER TABLE `scinstass_comments`
  ADD PRIMARY KEY (`comment_ID`),
  ADD KEY `comment_post_ID` (`comment_post_ID`),
  ADD KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  ADD KEY `comment_date_gmt` (`comment_date_gmt`),
  ADD KEY `comment_parent` (`comment_parent`),
  ADD KEY `comment_author_email` (`comment_author_email`(10));

--
-- Indeks untuk tabel `scinstass_links`
--
ALTER TABLE `scinstass_links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_visible` (`link_visible`);

--
-- Indeks untuk tabel `scinstass_options`
--
ALTER TABLE `scinstass_options`
  ADD PRIMARY KEY (`option_id`),
  ADD UNIQUE KEY `option_name` (`option_name`),
  ADD KEY `autoload` (`autoload`);

--
-- Indeks untuk tabel `scinstass_postmeta`
--
ALTER TABLE `scinstass_postmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indeks untuk tabel `scinstass_posts`
--
ALTER TABLE `scinstass_posts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `post_name` (`post_name`(191)),
  ADD KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  ADD KEY `post_parent` (`post_parent`),
  ADD KEY `post_author` (`post_author`);

--
-- Indeks untuk tabel `scinstass_termmeta`
--
ALTER TABLE `scinstass_termmeta`
  ADD PRIMARY KEY (`meta_id`),
  ADD KEY `term_id` (`term_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indeks untuk tabel `scinstass_terms`
--
ALTER TABLE `scinstass_terms`
  ADD PRIMARY KEY (`term_id`),
  ADD KEY `slug` (`slug`(191)),
  ADD KEY `name` (`name`(191));

--
-- Indeks untuk tabel `scinstass_term_relationships`
--
ALTER TABLE `scinstass_term_relationships`
  ADD PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  ADD KEY `term_taxonomy_id` (`term_taxonomy_id`);

--
-- Indeks untuk tabel `scinstass_term_taxonomy`
--
ALTER TABLE `scinstass_term_taxonomy`
  ADD PRIMARY KEY (`term_taxonomy_id`),
  ADD UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  ADD KEY `taxonomy` (`taxonomy`);

--
-- Indeks untuk tabel `scinstass_usermeta`
--
ALTER TABLE `scinstass_usermeta`
  ADD PRIMARY KEY (`umeta_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `meta_key` (`meta_key`(191));

--
-- Indeks untuk tabel `status_subscriber`
--
ALTER TABLE `status_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id_subs`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activate_account`
--
ALTER TABLE `activate_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ci_users`
--
ALTER TABLE `ci_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_jawaban_angka`
--
ALTER TABLE `jenis_jawaban_angka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT untuk tabel `jenis_jawaban_enum`
--
ALTER TABLE `jenis_jawaban_enum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT untuk tabel `reset_account`
--
ALTER TABLE `reset_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `scinstass_commentmeta`
--
ALTER TABLE `scinstass_commentmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `scinstass_comments`
--
ALTER TABLE `scinstass_comments`
  MODIFY `comment_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `scinstass_links`
--
ALTER TABLE `scinstass_links`
  MODIFY `link_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `scinstass_options`
--
ALTER TABLE `scinstass_options`
  MODIFY `option_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT untuk tabel `scinstass_postmeta`
--
ALTER TABLE `scinstass_postmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `scinstass_posts`
--
ALTER TABLE `scinstass_posts`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `scinstass_termmeta`
--
ALTER TABLE `scinstass_termmeta`
  MODIFY `meta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `scinstass_terms`
--
ALTER TABLE `scinstass_terms`
  MODIFY `term_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `scinstass_term_taxonomy`
--
ALTER TABLE `scinstass_term_taxonomy`
  MODIFY `term_taxonomy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `scinstass_usermeta`
--
ALTER TABLE `scinstass_usermeta`
  MODIFY `umeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `status_subscriber`
--
ALTER TABLE `status_subscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id_subs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=363;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
