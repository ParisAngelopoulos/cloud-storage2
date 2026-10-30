-- Database voor Cloud Storage
-- Importeer dit bestand in een database met de naam `file_sharing`.
-- Alle testaccounts hebben het wachtwoord "welkom123", de admin heeft "admin123".

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;

DROP TABLE IF EXISTS `shared_files`, `files`, `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@voorbeeld.nl', '$2y$10$vG0ZdRCbBKa5nVToUotrhOxBOHQe2u3lYKDPjQ379RsArGEwl9D2a', 'admin'),
(2, 'paris', 'paris@voorbeeld.nl', '$2y$10$IMPAPY9Fi.iifo0SPHWkm.YJrpSPw7R1sv/kUZg9Y/rA45Y2jv/mS', 'user'),
(3, 'sanne', 'sanne@voorbeeld.nl', '$2y$10$IMPAPY9Fi.iifo0SPHWkm.YJrpSPw7R1sv/kUZg9Y/rA45Y2jv/mS', 'user'),
(4, 'daan', 'daan@voorbeeld.nl', '$2y$10$IMPAPY9Fi.iifo0SPHWkm.YJrpSPw7R1sv/kUZg9Y/rA45Y2jv/mS', 'user');

CREATE TABLE `files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_by` int NOT NULL,
  `upload_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uploaded_by` (`uploaded_by`),
  CONSTRAINT `files_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `files` (`id`, `file_name`, `file_path`, `uploaded_by`, `upload_date`) VALUES
(1, 'cv-paris-angelopoulos.pdf', 'uploads/cv-paris-angelopoulos.pdf', 2, '2025-03-03 10:15:00'),
(2, 'vakantiefoto-kreta.png', 'uploads/vakantiefoto-kreta.png', 2, '2025-03-05 19:40:00'),
(3, 'rooster-week-12.pdf', 'uploads/rooster-week-12.pdf', 3, '2025-03-10 08:05:00'),
(4, 'notulen-projectgroep.pdf', 'uploads/notulen-projectgroep.pdf', 3, '2025-03-11 16:30:00'),
(5, 'logo-ontwerp.png', 'uploads/logo-ontwerp.png', 4, '2025-03-12 13:20:00');

CREATE TABLE `shared_files` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `shared_with` int NOT NULL,
  `shared_with_email` varchar(255) DEFAULT NULL,
  `shared_by` int NOT NULL,
  `shared_by_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `shared_with` (`shared_with`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `shared_files` (`id`, `file_name`, `shared_with`, `shared_with_email`, `shared_by`, `shared_by_name`) VALUES
(1, 'rooster-week-12.pdf', 2, 'paris@voorbeeld.nl', 3, 'sanne'),
(2, 'notulen-projectgroep.pdf', 2, 'paris@voorbeeld.nl', 3, 'sanne'),
(3, 'logo-ontwerp.png', 2, 'paris@voorbeeld.nl', 4, 'daan'),
(4, 'vakantiefoto-kreta.png', 4, 'daan@voorbeeld.nl', 2, 'paris'),
(5, 'notulen-projectgroep.pdf', 4, 'daan@voorbeeld.nl', 3, 'sanne');
