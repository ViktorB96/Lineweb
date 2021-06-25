-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2020 at 08:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g3`
--

-- --------------------------------------------------------

--
-- Table structure for table `galerije`
--

CREATE TABLE `galerije` (
  `id` int(3) UNSIGNED NOT NULL,
  `naziv` varchar(30) NOT NULL,
  `komentar` text DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerije`
--

INSERT INTO `galerije` (`id`, `naziv`, `komentar`, `datum`) VALUES
(1, 'Letovanje Grčka 2018', 'Onako.....', '2020-02-28 18:51:30'),
(2, 'Letovanje Egipat 2019', 'Nikad bolje letovanje!!!!', '2020-02-28 18:52:20'),
(6, 'Ručak danas', '', '2020-05-22 18:47:49'),
(5, 'Najnovija galerija', '', '2020-05-20 18:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `galerijeslike`
--

CREATE TABLE `galerijeslike` (
  `id` int(4) UNSIGNED NOT NULL,
  `idGalerije` int(3) NOT NULL,
  `slika` varchar(50) NOT NULL,
  `komentarSlike` text DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `tag` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `galerijeslike`
--

INSERT INTO `galerijeslike` (`id`, `idGalerije`, `slika`, `komentarSlike`, `datum`, `tag`) VALUES
(1, 1, '1582916752.4255.jpg', '1. slika', '2020-02-28 19:05:52', '1,2,3'),
(2, 1, '1582916783.9622.jpg', 'Ovo je komentar', '2020-02-28 19:06:23', ''),
(3, 1, '1582916847.2366.jpg', '', '2020-02-28 19:07:27', ''),
(21, 6, '1590173315.5402.jpg', 'Franš de Pare', '2020-05-22 18:48:35', '2,1,3'),
(15, 2, '1582918461.9644.jpg', '', '2020-02-28 19:34:21', ''),
(14, 2, '1582918461.9636.jpg', '', '2020-02-28 19:34:21', ''),
(13, 2, '1582918461.9627.jpg', '', '2020-02-28 19:34:21', ''),
(12, 2, '1582918461.9617.jpg', '', '2020-02-28 19:34:21', ''),
(20, 6, '1590173309.0745.jpg', 'Franš de Pare', '2020-05-22 18:48:29', '2,1,3'),
(19, 2, '1590172180.9944.jpg', 'Ovo je test', '2020-05-22 18:29:40', '2,3'),
(22, 6, '1590173327.2868.jpg', 'Franš de Pare', '2020-05-22 18:48:47', '2,1,3');

-- --------------------------------------------------------

--
-- Table structure for table `kategorije`
--

CREATE TABLE `kategorije` (
  `id` int(3) UNSIGNED NOT NULL,
  `naziv` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategorije`
--

INSERT INTO `kategorije` (`id`, `naziv`) VALUES
(1, 'Sport'),
(2, 'Svet'),
(3, 'Hronika'),
(4, 'Zabava'),
(5, 'Kultura');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id` int(6) UNSIGNED NOT NULL,
  `idProizvoda` int(3) NOT NULL,
  `ime` varchar(20) NOT NULL,
  `komentar` text NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp(),
  `volime` int(3) NOT NULL DEFAULT 0,
  `nevolime` int(3) NOT NULL DEFAULT 0,
  `odobren` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id`, `idProizvoda`, `ime`, `komentar`, `vreme`, `volime`, `nevolime`, `odobren`) VALUES
(1, 1, 'bbosko', 'Ovo je moj prvi komentar', '2020-02-14 17:08:54', 0, 0, 1),
(2, 1, 'pperic', 'Ovo je drugi komentar', '2020-02-14 17:10:26', 0, 0, 1),
(3, 13, 'bbosko', 'Moj omiljeni telefon', '2020-02-14 17:10:42', 0, 0, 1),
(4, 14, 'pperic', 'Samsung je bolji!!!', '2020-02-14 17:10:55', 0, 4, 1),
(6, 14, 'bbosko', 'XIAOMI RULEZ!!!!!!!', '2020-02-14 17:39:37', 3, 1, 1),
(7, 14, 'bbosko', 'alert(\'Pozdrav od hakera\')', '2020-02-14 19:14:32', 0, 0, 1),
(8, 14, 'bbosko', 'window.location.assign(\'http://blic.rs\')', '2020-02-14 19:16:25', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `id` int(3) UNSIGNED NOT NULL,
  `email` varchar(30) NOT NULL,
  `idKorisnika` int(3) DEFAULT NULL,
  `pitanje` text NOT NULL,
  `vremePitanja` timestamp NOT NULL DEFAULT current_timestamp(),
  `odgovor` text DEFAULT NULL,
  `vremeOdgovora` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`id`, `email`, `idKorisnika`, `pitanje`, `vremePitanja`, `odgovor`, `vremeOdgovora`) VALUES
(1, 'bbosko@it-akademija.com', NULL, 'Ovo je moje prvo pitanje?', '2020-02-14 18:38:06', 'Pozdrav nepoznati korisniče', '2020-02-14 19:10:12'),
(2, 'bbosko', 1, 'Ovo je pitanje za prijavljenog korisnika?', '2020-02-14 18:38:37', 'dfhghdfhgfgshgf\r\nfghfghfg\r\nhgf\r\nhgf\r\nhfg', '2020-02-14 19:04:02'),
(3, 'ppera', 2, 'Ovo je pitanje kao pera perić', '2020-02-14 18:44:45', 'De si pero kućo stara', '2020-02-14 19:09:27'),
(4, 'bbosko', 1, 'Ovo je drugo pitanje za bbosko?', '2020-02-14 18:48:02', 'Ovo je odgovor za bbosko', '2020-02-14 19:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id` int(2) UNSIGNED NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `lozinka` varchar(256) NOT NULL,
  `komentar` text DEFAULT NULL,
  `status` enum('Administrator','Urednik','Korisnik') NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp(),
  `aktivan` int(1) NOT NULL DEFAULT 1,
  `adresa` varchar(50) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `validan` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `ime`, `prezime`, `email`, `lozinka`, `komentar`, `status`, `vreme`, `aktivan`, `adresa`, `telefon`, `validan`) VALUES
(1, 'Бошко', 'Богојевић', 'bbosko', 'bbosko', NULL, 'Administrator', '2019-12-27 17:16:49', 1, 'dsfsdf', 'sdfsdf', 1),
(2, 'Pera', 'Perić', 'ppera', 'ppera', 'Nije platio članarinu od 2005', 'Korisnik', '2019-12-27 17:18:50', 0, '', '', 1),
(3, 'laza', 'lazić', 'llaza', 'llaza', NULL, 'Korisnik', '2019-12-27 18:23:24', 1, '', '', 1),
(4, 'Mile', 'Dizna', 'asds a', 'ewrewr', '', 'Korisnik', '2020-01-31 18:50:33', 1, 'Adresa', 'Telefon', 1),
(9, 'Joca', 'Karburator', 'jk', 'jk', NULL, 'Korisnik', '2020-05-06 18:34:57', 1, 'asdasd', 'asdadsa', 1),
(10, 'aaaa', 'aaaa', 'aaaa', 'caAA0.', NULL, 'Korisnik', '2020-05-15 18:13:53', 1, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korpa`
--

CREATE TABLE `korpa` (
  `id` int(3) UNSIGNED NOT NULL,
  `idKorisnika` int(3) NOT NULL,
  `idProizvoda` int(3) NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp(),
  `vremeKupovine` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `kupljen` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korpa`
--

INSERT INTO `korpa` (`id`, `idKorisnika`, `idProizvoda`, `vreme`, `vremeKupovine`, `kupljen`) VALUES
(1, 1, 1, '2020-05-22 17:01:50', '2020-05-22 17:48:59', 1),
(3, 1, 12, '2020-05-22 17:02:14', '2020-05-22 17:49:20', 1),
(4, 2, 13, '2020-05-22 17:38:55', NULL, 0),
(5, 2, 8, '2020-05-22 17:39:01', NULL, 0),
(6, 1, 8, '2020-05-22 17:49:41', '2020-05-22 17:52:36', 1),
(7, 1, 3, '2020-05-22 17:49:47', '2020-05-22 17:52:36', 1),
(8, 1, 15, '2020-05-22 18:00:38', '2020-05-22 18:03:32', 1),
(9, 1, 2, '2020-05-22 18:02:14', '2020-05-22 18:03:32', 1),
(10, 1, 2, '2020-05-22 18:02:33', '2020-05-22 18:03:25', 1),
(14, 1, 15, '2020-05-22 18:04:15', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

CREATE TABLE `proizvodi` (
  `id` int(3) UNSIGNED NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `opis` text NOT NULL,
  `kategorija` int(3) NOT NULL,
  `autor` int(3) NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp(),
  `obrisan` int(1) NOT NULL DEFAULT 0,
  `pogledan` int(3) NOT NULL DEFAULT 0,
  `izmena` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `likes` int(11) NOT NULL DEFAULT 0,
  `dislikes` int(11) NOT NULL DEFAULT 0,
  `cena` int(5) NOT NULL DEFAULT 100
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `naslov`, `opis`, `kategorija`, `autor`, `vreme`, `obrisan`, `pogledan`, `izmena`, `likes`, `dislikes`, `cena`) VALUES
(1, 'Izmenjeno iz servisa', 'Izmenjeno iz servisa za opis', 2, 2, '2019-12-25 18:54:03', 0, 5, '2020-05-22 17:01:48', 0, 0, 100),
(2, 'Veliki uspeh filma Ajvar u domaćim bioskopima', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 1, 2, '2019-12-27 18:54:03', 0, 3, '2020-05-22 18:02:43', 0, 0, 100),
(3, 'Ko je ustvari bio pera perić?', 'Lorem boško is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5, 1, '2019-12-27 18:54:03', 0, 1, '2020-05-22 17:49:46', 0, 0, 100),
(4, 'Veliki uspeh filma Ajvar u', 'Contrary to boško belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 2, 2, '2019-12-30 18:54:03', 0, 0, '2020-01-17 19:30:48', 0, 0, 100),
(12, 'Test iz PHP-a', 'Ovo je sadržaj za test iz PHP-a', 5, 1, '2020-01-17 18:48:27', 0, 2, '2020-05-22 17:33:12', 0, 0, 375),
(5, 'ovo je naslov iz upita', 'Ovo je neki lorem ipsum', 1, 1, '2020-01-17 18:18:15', 0, 0, '2020-02-14 19:40:07', 0, 0, 100),
(6, 'Naslov iz upita', 'Sadržaj iz upita', 1, 1, '2020-01-17 18:21:50', 1, 0, '2020-05-22 16:34:26', 0, 0, 100),
(7, 'Ovo je iz UPDATE upita', 'Ovo je sadrzaj iz UPDATE upita', 1, 3, '2020-01-17 18:22:53', 0, 0, '2020-02-14 19:40:11', 0, 0, 100),
(8, 'Naslov iz upita', 'Sadržaj iz upita', 2, 1, '2020-01-17 18:22:53', 0, 2, '2020-05-22 17:49:40', 0, 0, 100),
(9, 'Naslov iz upita', 'Sadržaj iz upita', 3, 1, '2020-01-17 18:22:53', 0, 0, NULL, 0, 0, 100),
(11, 'Naslov iz UPDATE stranice', 'Sadržaj iz UPDATE stranice', 3, 1, '2020-01-17 18:22:53', 0, 1, '2020-05-22 16:59:46', 0, 0, 100),
(13, 'Mobilni telefon NOKIA', 'Kao nov, retko korišćen', 1, 1, '2020-02-07 19:38:51', 0, 7, '2020-05-22 17:38:53', 0, 0, 1000),
(14, 'Još noviji mobilni', 'Sve za pare', 1, 2, '2020-02-07 19:41:15', 0, 38, '2020-05-22 17:33:03', 0, 0, 400),
(15, 'Ovo je novi proizvod iz servisa', 'Ovo je najnoviji proizvod iz servisa', 1, 1, '2020-05-22 16:29:23', 0, 9, '2020-05-22 18:04:08', 0, 0, 500);

-- --------------------------------------------------------

--
-- Table structure for table `provera`
--

CREATE TABLE `provera` (
  `id` int(6) UNSIGNED NOT NULL,
  `idKorisnika` int(3) NOT NULL,
  `idKomentara` int(6) NOT NULL,
  `volime` int(1) DEFAULT NULL,
  `nevolime` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provera`
--

INSERT INTO `provera` (`id`, `idKorisnika`, `idKomentara`, `volime`, `nevolime`) VALUES
(1, 1, 8, 1, NULL),
(2, 1, 8, NULL, 1),
(3, 1, 6, NULL, 1),
(4, 1, 4, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `statistika`
--

CREATE TABLE `statistika` (
  `id` int(5) UNSIGNED NOT NULL,
  `ipAdresa` varchar(50) NOT NULL,
  `stranica` varchar(50) NOT NULL,
  `parametri` varchar(100) NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `statistika`
--

INSERT INTO `statistika` (`id`, `ipAdresa`, `stranica`, `parametri`, `vreme`) VALUES
(1, '::1', '/corephp/g3/p8/pera.php', '', '2019-12-27 19:37:13'),
(2, '::1', '/corephp/g3/p8/vesti.php', '', '2019-12-27 19:37:16'),
(3, '::1', '/corephp/g3/p8/vesti.php', '', '2019-12-27 19:37:17'),
(4, '::1', '/corephp/g3/p8/vesti.php', '', '2019-12-27 19:37:18'),
(5, '::1', '/corephp/g3/p8/vesti.php', 'id=1', '2019-12-27 19:37:20'),
(6, '::1', '/corephp/g3/p8/vesti.php', 'id=1', '2019-12-27 19:37:22'),
(7, '::1', '/corephp/g3/p8/vesti.php', 'id=1', '2019-12-27 19:37:23'),
(8, '::1', '/corephp/g3/p8/vesti.php', '', '2019-12-27 19:37:25'),
(9, '117.152.11.5', '/corephp/g3/p8/vesti.php', 'id=3', '2019-12-27 19:37:27'),
(10, '::1', '/corephp/g3/p8/vesti.php', 'id=3', '2019-12-27 19:37:28'),
(11, '119.152.11.3', '/corephp/g3/p8/vesti.php', 'id=3', '2019-12-27 19:37:29'),
(12, '::1', '/corephp/g3/p8/vesti.php', 'kategorija=Sport', '2019-12-27 19:37:30'),
(13, '::1', '/corephp/g3/p8/vesti.php', 'kategorija=Sport', '2019-12-27 19:37:31'),
(14, '::1', '/corephp/g3/p8/vesti.php', 'kategorija=Sport', '2019-12-27 19:37:32'),
(78, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 19:24:39'),
(16, '::1', '/corephp/g3/p8/vesti.php', 'id=1', '2019-12-27 19:40:01'),
(17, '::1', '/corephp/g3/p8/pera.php', '', '2020-01-10 18:54:05'),
(18, '::1', '/corephp/g3/p8/vesti.php', 'id=1', '2020-01-10 18:54:11'),
(19, '117.152.11.3', '/corephp/g3/p8/vesti.php', 'autor=bbosko', '2020-01-10 18:54:13'),
(20, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 18:54:14'),
(21, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:11:38'),
(22, '117.152.11.3', '/corephp/g3/p8/pera.php', '', '2020-01-10 19:18:25'),
(23, '::1', '/corephp/g3/p8/vesti.php', 'id=1', '2020-01-10 19:18:29'),
(24, '117.152.11.3', '/corephp/g3/p8/vesti.php', 'kategorija=Kultura', '2020-01-10 19:18:31'),
(25, '::1', '/corephp/g3/p8/vesti.php', 'kategorija=Sport', '2020-01-10 19:18:32'),
(26, '::1', '/corephp/g3/p8/vesti.php', 'kategorija=Svet', '2020-01-10 19:18:32'),
(27, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:18:33'),
(28, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:20:17'),
(29, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:20:24'),
(30, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:29:59'),
(31, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:30:11'),
(32, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:30:30'),
(33, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:31:11'),
(34, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:34:44'),
(35, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:39:05'),
(36, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:39:44'),
(37, '::1', '/corephp/g3/p8/vesti.php', 'id=1', '2020-01-10 19:39:50'),
(38, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:39:52'),
(39, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:40:04'),
(40, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:41:22'),
(41, '::1', '/corephp/g3/p8/vesti.php', 'kategorija=Kultura', '2020-01-10 19:41:23'),
(42, '::1', '/corephp/g3/p8/vesti.php', 'kategorija=Sport', '2020-01-10 19:41:24'),
(43, '::1', '/corephp/g3/p8/vesti.php', 'kategorija=Svet', '2020-01-10 19:41:25'),
(44, '::1', '/corephp/g3/p8/vesti.php', 'autor=ppera', '2020-01-10 19:41:27'),
(45, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:41:31'),
(46, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:42:02'),
(47, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:42:06'),
(48, '::1', '/corephp/g3/p8/vesti.php', 'autor=bbosko', '2020-01-10 19:42:09'),
(49, '::1', '/corephp/g3/p8/vesti.php', 'kategorija=Kultura', '2020-01-10 19:42:10'),
(50, '::1', '/corephp/g3/p8/vesti.php', 'id=1', '2020-01-10 19:42:12'),
(51, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:42:14'),
(52, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:42:34'),
(53, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-10 19:43:00'),
(79, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 19:25:00'),
(55, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:26:58'),
(56, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:27:19'),
(57, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:27:54'),
(58, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:28:09'),
(59, '::1', '/aphp/g3/p1/vesti.php?autor=1', 'autor=1', '2020-01-17 18:28:13'),
(60, '::1', '/aphp/g3/p1/vesti.php?autor=1', 'autor=1', '2020-01-17 18:29:39'),
(61, '::1', '/aphp/g3/p1/vesti.php?autor=1', 'autor=1', '2020-01-17 18:29:51'),
(62, '::1', '/aphp/g3/p1/vesti.php?kategorija=5', 'kategorija=5', '2020-01-17 18:29:59'),
(63, '::1', '/aphp/g3/p1/vesti.php?autor=1', 'autor=1', '2020-01-17 18:30:01'),
(64, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:30:06'),
(65, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:30:11'),
(66, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:30:24'),
(67, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:31:06'),
(68, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:31:07'),
(69, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:33:37'),
(70, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:33:48'),
(71, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:35:08'),
(72, '::1', '/corephp/g3/p8/vesti.php', '', '2020-01-17 18:35:37'),
(73, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:35:41'),
(74, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:36:25'),
(75, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:48:22'),
(76, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 18:48:31'),
(77, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 19:15:04'),
(80, '::1', '/aphp/g3/p1/vesti.php', '', '2020-01-17 19:28:21'),
(81, '::1', '', '', '2020-04-29 18:20:21'),
(82, '::1', 'http://localhost/xmlphp/g3/p1/xml.php', '', '2020-04-29 18:23:10'),
(83, '::1', 'http://localhost/xmlphp/g3/p1/xml.php', '', '2020-04-29 18:23:23'),
(84, '::1', 'http://localhost/xmlphp/g3/p1/xml.php', '', '2020-04-29 18:23:34'),
(85, '::1', 'http://localhost/xmlphp/g3/p1/xml.php', '', '2020-04-29 18:25:24'),
(86, '::1', 'http://localhost/xmlphp/g3/p1/xml.php', '', '2020-04-29 18:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `vesti`
--

CREATE TABLE `vesti` (
  `id` int(3) UNSIGNED NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `sadrzaj` text NOT NULL,
  `kategorija` int(3) NOT NULL,
  `autor` int(3) NOT NULL,
  `vreme` timestamp NOT NULL DEFAULT current_timestamp(),
  `obrisan` int(1) NOT NULL DEFAULT 0,
  `pogledan` int(3) NOT NULL DEFAULT 0,
  `izmena` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vesti`
--

INSERT INTO `vesti` (`id`, `naslov`, `sadrzaj`, `kategorija`, `autor`, `vreme`, `obrisan`, `pogledan`, `izmena`) VALUES
(1, 'Ko je ustvari bio pera perić?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5, 1, '2019-12-25 18:54:03', 0, 0, '2020-01-17 19:30:48'),
(2, 'Veliki uspeh filma Ajvar u domaćim bioskopima', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 1, 2, '2019-12-27 18:54:03', 0, 0, NULL),
(3, 'Ko je ustvari bio pera perić?', 'Lorem boško is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5, 1, '2019-12-27 18:54:03', 0, 0, '2020-01-17 19:30:48'),
(4, 'Veliki uspeh filma Ajvar u', 'Contrary to boško belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 2, 2, '2019-12-30 18:54:03', 0, 0, '2020-01-17 19:30:48'),
(12, 'Test iz PHP-a', 'Ovo je sadržaj za test iz PHP-a', 5, 1, '2020-01-17 18:48:27', 0, 0, NULL),
(5, 'ovo je naslov iz upita', 'Ovo je neki lorem ipsum', 1, 1, '2020-01-17 18:18:15', 0, 0, NULL),
(6, 'Naslov iz upita', 'Sadržaj iz upita', 1, 1, '2020-01-17 18:21:50', 0, 0, NULL),
(7, 'Ovo je iz UPDATE upita', 'Ovo je sadrzaj iz UPDATE upita', 1, 3, '2020-01-17 18:22:53', 0, 0, '2020-01-17 19:02:59'),
(8, 'Naslov iz upita', 'Sadržaj iz upita', 2, 1, '2020-01-17 18:22:53', 0, 0, NULL),
(9, 'Naslov iz upita', 'Sadržaj iz upita', 3, 1, '2020-01-17 18:22:53', 0, 0, NULL),
(11, 'Naslov iz UPDATE stranice', 'Sadržaj iz UPDATE stranice', 3, 1, '2020-01-17 18:22:53', 0, 0, '2020-01-17 19:14:32');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwproizvodi`
-- (See below for the actual view)
--
CREATE TABLE `vwproizvodi` (
`id` int(3) unsigned
,`naslov` varchar(100)
,`opis` text
,`kategorija` int(3)
,`autor` int(3)
,`vreme` timestamp
,`obrisan` int(1)
,`pogledan` int(3)
,`likes` int(11)
,`dislikes` int(11)
,`izmena` timestamp
,`cena` int(5)
,`naziv` varchar(50)
,`ime` varchar(30)
,`prezime` varchar(30)
);

-- --------------------------------------------------------

--
-- Structure for view `vwproizvodi`
--
DROP TABLE IF EXISTS `vwproizvodi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwproizvodi`  AS  select `proizvodi`.`id` AS `id`,`proizvodi`.`naslov` AS `naslov`,`proizvodi`.`opis` AS `opis`,`proizvodi`.`kategorija` AS `kategorija`,`proizvodi`.`autor` AS `autor`,`proizvodi`.`vreme` AS `vreme`,`proizvodi`.`obrisan` AS `obrisan`,`proizvodi`.`pogledan` AS `pogledan`,`proizvodi`.`likes` AS `likes`,`proizvodi`.`dislikes` AS `dislikes`,`proizvodi`.`izmena` AS `izmena`,`proizvodi`.`cena` AS `cena`,`kategorije`.`naziv` AS `naziv`,`korisnici`.`ime` AS `ime`,`korisnici`.`prezime` AS `prezime` from ((`proizvodi` join `kategorije` on(`proizvodi`.`kategorija` = `kategorije`.`id`)) join `korisnici` on(`proizvodi`.`autor` = `korisnici`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `galerije`
--
ALTER TABLE `galerije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galerijeslike`
--
ALTER TABLE `galerijeslike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorije`
--
ALTER TABLE `kategorije`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `korpa`
--
ALTER TABLE `korpa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proizvodi`
--
ALTER TABLE `proizvodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provera`
--
ALTER TABLE `provera`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistika`
--
ALTER TABLE `statistika`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vesti`
--
ALTER TABLE `vesti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galerije`
--
ALTER TABLE `galerije`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `galerijeslike`
--
ALTER TABLE `galerijeslike`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kategorije`
--
ALTER TABLE `kategorije`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `korpa`
--
ALTER TABLE `korpa`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `proizvodi`
--
ALTER TABLE `proizvodi`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `provera`
--
ALTER TABLE `provera`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `statistika`
--
ALTER TABLE `statistika`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `vesti`
--
ALTER TABLE `vesti`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
