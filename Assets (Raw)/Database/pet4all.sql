-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 06-Dez-2018 às 10:13
-- Versão do servidor: 5.7.21
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet4all`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `breed`
--

DROP TABLE IF EXISTS `breed`;
CREATE TABLE IF NOT EXISTS `breed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lifespan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-breed-id_parent` (`id_parent`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `breed`
--

INSERT INTO `breed` (`id`, `id_parent`, `name`, `description`, `origin`, `lifespan`) VALUES
(1, NULL, 'Cão', '', '', ''),
(2, 1, 'Airedale Terrier', '', 'Reino Unido, Inglaterra', '10 a 12 anos'),
(3, 1, 'Akita', '', 'Japão', '10 a 15 anos'),
(4, 1, 'Alaskan Malamute', '', 'Alasca, Estados Unidos', '10 a 12 anos'),
(5, 1, 'American Pit Bull Terrier', '', 'Estados Unidos, Reino Unido', ' 8 a 15 anos'),
(6, 1, 'American staffordshire terrier', '', 'Estados Unidos', '10 a 15 anos'),
(7, 1, 'Bobtail (Old english sheepdog)', '', 'Inglaterra', '10 a 12 anos'),
(8, 1, 'Baixote (Dachshund)', '', 'Alemanha', '12 a 16 anos'),
(9, 1, 'Barbado da Terceira', '', 'Portugal', ''),
(10, 1, 'Basset Hound', '', 'França, Grã-Bretanha', '10 a 12 anos'),
(11, 1, 'Beagle', '', 'Inglaterra, Reino Unido, Grã-Bretanha', '12 a 15 anos'),
(12, 1, 'Border Collie', '', 'Inglaterra, Reino Unido, Escócia, País de Gales, Irlanda', '10 a 17 anos'),
(13, 1, 'Boston Terrier', '', 'Estados Unidos', '13 a 15 anos'),
(14, 1, ' Bouledogue Francês', '', 'França, Inglaterra', '10 a 12 anos'),
(15, 1, 'Boxer', '', 'Alemanha, Munique', '10 a 12 anos'),
(17, 1, 'Weimaraner', '', 'Alemanha', '10 a 12 anos'),
(18, 1, 'Bull Terrier', '', 'Inglaterra', '10 a 14 anos'),
(19, 1, 'Bulldog Inglês', '', 'Reino Unido, Inglaterra', '8 a 10 anos'),
(20, 1, 'Bullmastiff', '', 'Reino Unido', '8 a 10 anos'),
(21, 1, 'Cane corso', '', 'Itália', '10 a 12 anos'),
(22, 1, 'Boiadeiro de Berna (Bernese)', '', 'Suiça', '6 a 8 anos'),
(23, 1, 'Dálmata', '', 'Croácia', '10 a 13 anos'),
(24, 1, 'Cão da Serra da Estrela', '', 'Portugal', '10 a 12 anos'),
(25, 1, 'Cão da Serra de Aires', '', 'Portugal', ''),
(26, 1, 'Cão de Água Português', '', 'Portugal', '12 a 15 anos'),
(27, 1, 'Cão de Castro Laboreiro', '', 'Portugal', ''),
(28, 1, ' Cão de Fila de São Miguel', '', 'Portugal', ''),
(29, 1, 'Cão de Gado Transmontano', '', 'Portugal', ''),
(30, 1, 'Pastor Alemão', '', 'Portugal', '9 a 13 anos'),
(31, 1, 'Pastor Belga Groenendael', '', 'Bélgica', '13 a 14 anos'),
(32, 1, 'Laekenois', '', 'Bélgica', '12 a 14 anos'),
(33, 1, 'Pastor-belga Malinois', '', 'Bélgica', '12 a 14 anos'),
(34, 1, 'Pastor Belga Tervueren', '', 'Bélgica', '10 a 14 anos'),
(35, 1, 'Pastor-branco-suíço', '', 'Suiça', '12 anos'),
(36, 1, 'São Bernardo', '', 'Suiça, Itália', '8 a 10 anos'),
(37, 1, 'Cavalier king charles spaniel', '', 'Reino Unido', '9 a 14 anos'),
(38, 1, 'Chihuahua', '', 'México', '12 a 20 anos'),
(39, 1, 'Cão de crista chinês', '', 'República Popular da China, México, África', '13 a 15 anos'),
(40, 1, 'Chow Chow', '', 'República Popular da China', '9 a 15 anos'),
(41, 1, 'Cocker Spaniel Inglês', '', 'Inglaterra', '12 a 15 anos'),
(42, 1, 'Dobermann', '', 'Alemanha', '10 a 13 anos'),
(43, 1, 'Dogue Alemão', '', 'Alemanha', '8 a 10 anos'),
(44, 1, 'Dogue Argentino', '', 'Alemanha', '10 a 12 anos'),
(45, 1, 'Dogue Canário', '', 'Canárias', '9 a 11 anos'),
(46, 1, ' Dogue de Bordéus', '', 'Canárias', '5 a 8 anos'),
(47, 1, ' English Springer Spaniel', '', 'Inglaterra', '12 a 14 anos'),
(48, 1, 'Spaniel bretão', '', 'França, Bretanha', '14 a 15 anos'),
(49, 1, 'Flat-coated retriever', '', 'Reino Unido', '8 a 14 anos'),
(50, 1, 'Wire Fox Terrier (Fox Terrier de pelo cerdoso)', '', 'Inglaterra', '13 a 14 anos'),
(51, 1, 'Smooth Fox Terrier (Fox Terrier de pelo liso)', '', 'Inglaterra', '12 a 15 anos'),
(52, 1, 'Galgo Inglês', '', 'Inglaterra, Ilhas Britânicas', '10 a 12 anos'),
(53, 1, 'Galgo Italiano', '', 'Itália', '12 a 15 anos'),
(54, 1, 'Galgo Russo (Borzoi)', '', 'Rússia', '7 a 10 anos'),
(55, 1, 'Golden Retriever', '', 'Inglaterra, Reino Unido, Escócia', '10 a 12 anos'),
(56, 1, 'Grande basset griffon da Vendeia', '', 'França', '12 a 14 anos'),
(57, 1, 'Jack russell terrier', '', 'Inglaterra', '13 a 16 anos'),
(58, 1, 'Leão da Rodésia (Rhodesian ridgeback)', '', 'Zimbabwe', ''),
(59, 1, 'Mastim Napolitano', '', 'Itália', '8 a 10 anos'),
(60, 1, 'Parson Russel Terrier', '', 'Inglaterra', '13 a 15 anos'),
(61, 1, 'Perdigueiro Português', '', 'Portugal', '12 a 14 anos'),
(62, 1, 'Pinscher Miniatura', '', 'Alemanha', '15 anos'),
(63, 1, 'Podengo Português', '', 'Portugal', '12 a 14 anos'),
(64, 1, 'Pointer', '', 'Inglaterra', '12 a 14 anos'),
(65, 1, 'Pug', '', 'Inglaterra', '12 a 15 anos'),
(66, 1, ' Rafeiro do Alentejo (Mastim Português)', '', 'Portugal', '12 a 14 anos'),
(67, 1, 'Labrador retriever', '', 'Canadá', '10 a 14 anos'),
(68, 1, 'Rottweiler', '', 'Alemanha', '8 a 10 anos'),
(69, 1, 'Schnauzer Gigante', '', 'Alemanha', '12 a 15 anos'),
(70, 1, 'Schnauzer Miniatura', '', 'Alemanha', '12 a 15 anos'),
(71, 1, 'Setter Gordon', '', 'Escócia', '10 a 12 anos'),
(72, 1, 'Setter Inglês', '', 'Inglaterra, País de Gales', '10 a 12 anos'),
(73, 1, 'Setter Irlândes', '', 'Irlanda', '12 a 15 anos'),
(74, 1, 'Shar-pei', '', 'República Popular da China', '9 a 11 anos'),
(75, 1, 'Shih-tzu', '', ' República Popular da China, Tibete', '10 a 16 anos'),
(76, 1, 'Husky siberiano', '', 'Sibéria', '12 a 15 anos'),
(77, 1, 'Staffordshire Bull Terrier', '', 'Inglaterra', '12 a 14 anos'),
(78, 1, ' Terrier Escocês', '', 'Escócia', '12 a 15 anos'),
(79, 1, 'Welsh terrier', '', 'País de Gales, Reino Unido', '12 a 15 anos'),
(80, 1, 'West highland white terrier', '', 'Escócia', '12 a 16 anos'),
(81, 1, 'Whippet', '', 'Reino Unido', '12 a 15 anos'),
(82, 1, 'Yorkshire Terrier', '', 'Inglaterra', '13 a 16 anos'),
(83, 1, 'Pequinês', '', 'República Popular da China', '12 a 15 anos'),
(84, NULL, 'Gato', '', '', ''),
(85, 84, 'Abissínio', '', 'Egito', ''),
(87, 84, 'Gato de Pêlo Curto Americano (American Shorthair)', '', 'América do Norte', ''),
(88, 84, 'Angorá', '', 'Turquia', '12 – 18 anos'),
(89, 84, 'Azul russo', '', 'Rússia', '10 a 15 anos'),
(90, 84, 'Bengal', '', 'Estados Unidos da América', '12 a 16 anos'),
(91, 84, 'Gato de pelo curto brasileiro (Brazilian Shorthair)', '', 'Brasil', ''),
(92, 84, 'British Short Hair', '', 'Reino Unido', '12 a 20 anos'),
(93, 84, 'Burmês', '', 'Birmânia (atual Myanmar)', '12 a 18 anos'),
(94, 84, 'Chartreux', '', 'França', '11 a 15 anos'),
(95, 84, 'Cornish Rex', '', 'Grã-Bretanha', '11 a 15 anos'),
(96, 84, 'Devon Rex', '', 'Grã-Bretanha', '9 a 15 anos'),
(97, 84, 'Mau Egípcio', '', 'Egipto e Itália', '12 a 17 anos'),
(98, 84, ' European Shorthair', '', 'Itália', '12 anos'),
(99, 84, 'Gato Exótico', '', 'Estados Unidos da América', '10 a 15 anos'),
(100, 84, 'Himalaia', '', 'Reino Unido, Estados Unidos da América', '10 a 15 anos'),
(101, 84, 'Norueguês da Floresta', '', 'Noruega', '12 a 16 anos'),
(102, 84, 'Maine Coon', '', 'Noruega', '15 anos'),
(104, 84, 'Munchkin', '', 'Estados Unidos da América', '12 a 14 anos'),
(105, 84, 'Oriental Shorthair', '', 'Tailândia e Reino Unido', '12 a 15 anos'),
(106, 84, 'Persa', '', 'Pérsia (Irão), Reino Unido', '12 a 17 anos'),
(107, 84, 'Ragdoll', '', 'Estados Unidos da América', '12 a 17 anos'),
(108, 84, 'Sagrado da Birmânia', '', 'Birmânia (Myanmar)', '12 a 16 anos'),
(109, 84, 'Savannah', '', 'Estados Unidos da América', '17 a 20 anos'),
(110, 84, 'Scottish Fold', '', 'Reino Unido (Escócia)', '12 a 15 anos'),
(111, 84, 'Siamês', '', 'Sião (Tailândia)', '10 a 15 anos'),
(112, 84, 'Sphynx', '', 'Canadá', '10 a 15 anos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `breed_coat`
--

DROP TABLE IF EXISTS `breed_coat`;
CREATE TABLE IF NOT EXISTS `breed_coat` (
  `id_coat` int(11) NOT NULL,
  `id_breed` int(11) NOT NULL,
  KEY `idx-breed_coat-id_coat` (`id_coat`),
  KEY `idx-breed_coat-id_breed` (`id_breed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `breed_coat`
--

INSERT INTO `breed_coat` (`id_coat`, `id_breed`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 7),
(1, 8),
(2, 8),
(2, 9),
(1, 10),
(1, 11),
(1, 12),
(2, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 17),
(2, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(2, 22),
(1, 23),
(1, 24),
(2, 24),
(2, 25),
(2, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(2, 30),
(2, 31),
(2, 32),
(1, 33),
(2, 34),
(2, 35),
(1, 36),
(2, 36),
(2, 37),
(1, 38),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(1, 51),
(1, 52),
(1, 53),
(2, 54),
(2, 55),
(2, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(2, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(1, 74),
(2, 75),
(1, 76),
(1, 77),
(2, 78),
(2, 79),
(2, 80),
(1, 81),
(2, 82),
(2, 83),
(1, 85),
(1, 87),
(2, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(2, 100),
(1, 101),
(2, 101),
(2, 102),
(1, 104),
(2, 104),
(1, 105),
(1, 106),
(2, 106),
(1, 107),
(2, 107),
(1, 108),
(2, 108),
(1, 109),
(1, 110),
(1, 111),
(3, 112);

-- --------------------------------------------------------

--
-- Estrutura da tabela `breed_energy`
--

DROP TABLE IF EXISTS `breed_energy`;
CREATE TABLE IF NOT EXISTS `breed_energy` (
  `id_energy` int(11) NOT NULL,
  `id_breed` int(11) NOT NULL,
  KEY `idx-breed_energy-id_energy` (`id_energy`),
  KEY `idx-breed_energy-id_breed` (`id_breed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `breed_energy`
--

INSERT INTO `breed_energy` (`id_energy`, `id_breed`) VALUES
(3, 2),
(1, 3),
(2, 4),
(3, 5),
(2, 6),
(2, 7),
(3, 8),
(3, 9),
(1, 10),
(3, 11),
(3, 12),
(2, 13),
(1, 14),
(3, 15),
(3, 17),
(2, 18),
(1, 19),
(1, 20),
(2, 21),
(1, 22),
(3, 23),
(2, 24),
(3, 25),
(3, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(3, 33),
(2, 34),
(2, 35),
(1, 36),
(2, 37),
(3, 38),
(2, 39),
(1, 40),
(2, 41),
(2, 42),
(1, 43),
(2, 44),
(2, 45),
(2, 46),
(3, 47),
(3, 48),
(3, 49),
(3, 50),
(3, 51),
(1, 52),
(3, 53),
(2, 54),
(2, 55),
(3, 56),
(3, 57),
(1, 58),
(1, 59),
(3, 60),
(3, 61),
(3, 62),
(3, 63),
(3, 64),
(1, 65),
(1, 66),
(3, 67),
(2, 68),
(2, 69),
(3, 70),
(3, 71),
(3, 72),
(3, 73),
(1, 74),
(2, 75),
(2, 76),
(2, 77),
(2, 78),
(2, 79),
(3, 80),
(2, 81),
(3, 82),
(1, 83),
(2, 89),
(3, 90),
(2, 92),
(2, 93),
(2, 94),
(2, 95),
(2, 96),
(2, 97),
(2, 98),
(2, 99),
(2, 100),
(2, 101),
(2, 104),
(2, 105),
(1, 106),
(2, 107),
(2, 108),
(3, 109),
(2, 110),
(2, 111),
(2, 112);

-- --------------------------------------------------------

--
-- Estrutura da tabela `breed_size`
--

DROP TABLE IF EXISTS `breed_size`;
CREATE TABLE IF NOT EXISTS `breed_size` (
  `id_size` int(11) NOT NULL,
  `id_breed` int(11) NOT NULL,
  KEY `idx-breed_size-id_size` (`id_size`),
  KEY `idx-breed_size-id_breed` (`id_breed`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `breed_size`
--

INSERT INTO `breed_size` (`id_size`, `id_breed`) VALUES
(3, 5),
(3, 6),
(1, 8),
(2, 8),
(3, 9),
(2, 10),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(2, 14),
(3, 15),
(3, 17),
(3, 18),
(3, 19),
(3, 23),
(3, 25),
(3, 26),
(3, 28),
(2, 37),
(1, 38),
(1, 39),
(2, 39),
(3, 40),
(3, 41),
(3, 47),
(3, 48),
(3, 50),
(3, 51),
(2, 53),
(3, 55),
(3, 56),
(2, 57),
(2, 60),
(3, 60),
(3, 61),
(2, 62),
(2, 63),
(3, 63),
(2, 65),
(3, 67),
(2, 70),
(3, 74),
(1, 75),
(2, 75),
(3, 76),
(3, 77),
(2, 78),
(3, 79),
(2, 80),
(3, 81),
(1, 82),
(1, 83),
(2, 85),
(2, 87),
(2, 88),
(3, 89),
(3, 90),
(3, 91),
(3, 92),
(3, 93),
(3, 94),
(3, 95),
(3, 96),
(3, 97),
(3, 98),
(3, 99),
(3, 100),
(2, 104),
(3, 105),
(3, 106),
(3, 110),
(3, 111),
(3, 112);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `breed`
--
ALTER TABLE `breed`
  ADD CONSTRAINT `fk-breed-id_parent` FOREIGN KEY (`id_parent`) REFERENCES `breed` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `breed_coat`
--
ALTER TABLE `breed_coat`
  ADD CONSTRAINT `fk-breed_coat-id_breed` FOREIGN KEY (`id_breed`) REFERENCES `breed` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-breed_coat-id_coat` FOREIGN KEY (`id_coat`) REFERENCES `energy` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `breed_energy`
--
ALTER TABLE `breed_energy`
  ADD CONSTRAINT `fk-breed_energy-id_breed` FOREIGN KEY (`id_breed`) REFERENCES `breed` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-breed_energy-id_energy` FOREIGN KEY (`id_energy`) REFERENCES `energy` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `breed_size`
--
ALTER TABLE `breed_size`
  ADD CONSTRAINT `fk-breed_size-id_breed` FOREIGN KEY (`id_breed`) REFERENCES `breed` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-breed_size-id_size` FOREIGN KEY (`id_size`) REFERENCES `size` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
