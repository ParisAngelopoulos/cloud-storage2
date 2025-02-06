-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 06, 2025 at 08:50 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `file_sharing`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_by` int NOT NULL,
  `upload_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `file_path`, `uploaded_by`, `upload_date`) VALUES
(1, 'Screenshot 2023-09-15 113951.png', 'uploads/Screenshot 2023-09-15 113951.png', 1, '2024-11-03 19:24:04'),
(2, 'Screenshot 2023-09-29 085821.png', 'uploads/Screenshot 2023-09-29 085821.png', 4, '2024-11-03 19:33:35'),
(3, 'RobloxScreenShot20240516_104003718.png', 'uploads/RobloxScreenShot20240516_104003718.png', 1, '2024-11-04 11:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `shared_files`
--

CREATE TABLE `shared_files` (
  `id` int NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `shared_with` int NOT NULL,
  `shared_with_email` varchar(255) DEFAULT NULL,
  `shared_by` int NOT NULL,
  `shared_by_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `shared_files`
--

INSERT INTO `shared_files` (`id`, `file_name`, `shared_with`, `shared_with_email`, `shared_by`, `shared_by_name`) VALUES
(1, 'Screenshot 2023-09-15 113951.png', 4, 'henryangelopoulos@gmail.com', 1, 'paris'),
(2, 'Screenshot 2023-09-15 113951.png', 1, 'parisangelopoulos@gmail.com', 1, 'paris'),
(3, 'At.mp3', 3, 'zlabbet2@amazonaws.com', 3, 'Labbet'),
(4, 'In.xls', 4, 'whalt3@uol.com.br', 4, 'Halt'),
(5, 'Aliquam.avi', 5, 'lmacmakin4@opera.com', 5, 'MacMakin'),
(6, 'Nulla.ppt', 6, 'ksiely5@foxnews.com', 6, 'Siely'),
(7, 'Suscipit.mp3', 7, 'nottosen6@digg.com', 7, 'Ottosen'),
(8, 'Pharetra.xls', 8, 'jwaggett7@altervista.org', 8, 'Waggett'),
(9, 'PedeVenenatis.avi', 9, 'jallchin8@engadget.com', 9, 'Allchin'),
(10, 'Porttitor.ppt', 10, 'mcrossby9@ifeng.com', 10, 'Crossby'),
(11, 'OrciLuctusEt.avi', 11, 'lcarltona@examiner.com', 11, 'Carlton'),
(12, 'RisusPraesentLectus.avi', 12, 'omenichillob@imgur.com', 12, 'Menichillo'),
(13, 'Leo.mp3', 13, 'scantosc@bloomberg.com', 13, 'Cantos'),
(14, 'InTempor.tiff', 14, 'sglavisd@upenn.edu', 14, 'Glavis'),
(15, 'AmetJusto.mpeg', 15, 'gholtome@blogs.com', 15, 'Holtom'),
(16, 'NislVenenatisLacinia.xls', 16, 'nbellardf@ft.com', 16, 'Bellard'),
(17, 'Justo.tiff', 17, 'fpaneg@home.pl', 17, 'Pane'),
(18, 'EgetEros.mp3', 18, 'lkeesh@tuttocitta.it', 18, 'Kees'),
(19, 'Id.mp3', 19, 'enelleni@cocolog-nifty.com', 19, 'Nellen'),
(20, 'EnimBlanditMi.png', 20, 'uadkinsj@ezinearticles.com', 20, 'Adkins'),
(21, 'InSapien.mp3', 21, 'ldemangeotk@naver.com', 21, 'Demangeot'),
(22, 'PenatibusEtMagnis.avi', 22, 'llicencel@theguardian.com', 22, 'Licence'),
(23, 'Nulla.tiff', 23, 'wmobleym@t.co', 23, 'Mobley'),
(24, 'Turpis.ppt', 24, 'ftellenbrokern@bing.com', 24, 'Tellenbroker'),
(25, 'Sollicitudin.txt', 25, 'ghallto@ucla.edu', 25, 'Hallt'),
(26, 'DiamNamTristique.ppt', 26, 'aotimonyp@a8.net', 26, 'O\' Timony'),
(27, 'VestibulumSit.txt', 27, 'skynforthq@tinyurl.com', 27, 'Kynforth'),
(28, 'SemperEstQuam.xls', 28, 'tcripler@pinterest.com', 28, 'Criple'),
(29, 'PulvinarNulla.pdf', 29, 'aormistones@vinaora.com', 29, 'Ormistone'),
(30, 'Consectetuer.xls', 30, 'nbabbst@geocities.jp', 30, 'Babbs'),
(31, 'LuctusRutrumNulla.ppt', 31, 'obeevisu@360.cn', 31, 'Beevis'),
(32, 'UllamcorperPurus.png', 32, 'cchallicombev@ocn.ne.jp', 32, 'Challicombe'),
(33, 'EgetCongueEget.mp3', 33, 'bedinburghw@uol.com.br', 33, 'Edinburgh'),
(34, 'Enim.xls', 34, 'mdoylyx@icio.us', 34, 'D\'Oyly'),
(35, 'AtNunc.ppt', 35, 'anorthiny@pcworld.com', 35, 'Northin'),
(36, 'PraesentLectus.pdf', 36, 'wbeckenhamz@ucoz.ru', 36, 'Beckenham'),
(37, 'NequeLibero.mpeg', 37, 'gpeller10@friendfeed.com', 37, 'Peller'),
(38, 'Sit.mp3', 38, 'pnursey11@creativecommons.org', 38, 'Nursey'),
(39, 'ProinAtTurpis.xls', 39, 'parchell12@1und1.de', 39, 'Archell'),
(40, 'ProinEuMi.mp3', 40, 'ddionisetto13@barnesandnoble.com', 40, 'Dionisetto'),
(41, 'Duis.ppt', 41, 'rkynton14@imageshack.us', 41, 'Kynton'),
(42, 'AmetEleifend.doc', 42, 'rverdie15@ameblo.jp', 42, 'Verdie'),
(43, 'Lorem.jpeg', 43, 'cruppel16@ebay.co.uk', 43, 'Ruppel'),
(44, 'SuspendissePotenti.jpeg', 44, 'zwhybrow17@techcrunch.com', 44, 'Whybrow'),
(45, 'NullaNisl.mp3', 45, 'pnewhouse18@blog.com', 45, 'Newhouse'),
(46, 'NibhFusceLacus.avi', 46, 'mhudd19@twitpic.com', 46, 'Hudd'),
(47, 'NibhFusceLacus.ppt', 47, 'sbiddwell1a@smh.com.au', 47, 'Biddwell'),
(48, 'Sit.pdf', 48, 'eladbury1b@ox.ac.uk', 48, 'Ladbury'),
(49, 'DuiProinLeo.xls', 49, 'wroony1c@cbc.ca', 49, 'Roony'),
(50, 'Potenti.png', 50, 'vcurtois1d@bloomberg.com', 50, 'Curtois'),
(51, 'OrnareConsequatLectus.mp3', 51, 'rchadwell1e@ihg.com', 51, 'Chadwell'),
(52, 'Screenshot 2023-09-15 113951.png', 1, 'parisangelopoulos@gmail.com', 1, 'paris'),
(53, 'Screenshot 2023-09-15 113951.png', 4, 'henryangelopoulos@gmail.com', 1, 'paris');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'paris', 'parisangelopoulos@gmail.com', '$2y$10$ADPYPlK1iVf.J4eHACrybuChwXqxbxd2VD2Z4pi9//oKElnuO9Lvu', 'user'),
(2, 'Adrienne', 'abrumbie1@boston.com', '$2a$04$Ufdu3DKsvu2iPJuJBZoAwe3aiga/nlT1IsdiKy3qhJiqsRhzOzERe', 'user'),
(3, 'Felipe', 'fdecastri2@nifty.com', '$2a$04$2bLUHKOYLByf6N2OCY527.J.DHVz015v9JFIW.BRc6iVWLvZbVI8e', 'user'),
(4, 'peter', 'henryangelopoulos@gmail.com', '$2y$10$EDX1QbRmIZR9c.NoWuLCduevzEs9ZVc8m/YQTV.Ujydjr/oiQhT7y', 'user'),
(5, 'Obidiah', 'obenck4@sphinn.com', '$2a$04$ha2BnB5v3FpjI/dY66TPn.IYtQFlU9DT/m9/twp1Er6.UgT6HYume', 'user'),
(6, 'Devi', 'dpithie5@tumblr.com', '$2a$04$Op.4qdy.o4J1fqxaO7shSuQASiwURoDZgvhPcQ.96JYACjoZXcWSW', 'user'),
(7, 'Kessiah', 'kcrepel6@admin.ch', '$2a$04$8nPEZf2R56nYIwy/dqdJO.5Bm9XKSNalnrmhgipE8Bo9vtLN/uR1S', 'user'),
(8, 'Sebastien', 'skubala7@yolasite.com', '$2a$04$7GQ0JJJQcgCLXJu2OBBpM.aWU8cCDOGl1W1RY.fTWapz6lHCWDToe', 'user'),
(9, 'Rees', 'rcollinwood8@hibu.com', '$2a$04$BlBlBm2sq5q0F0NtkGG.HO0hDgIa9SBsiZ9TCJalbmZZ6OpDuaoNO', 'user'),
(10, 'Jayme', 'jmcgillivrie9@surveymonkey.com', '$2a$04$IV/Ye1hMsLrGwh3Yfvnoze.laPPkGdPToeH7O8rtXjml/cDKVNCGe', 'user'),
(11, 'Michale', 'mwellsteada@163.com', '$2a$04$LeKuA6sfEXEpK1/JI5x7IenP5vPzjZWXbmsSIk/Uo1yIeVQqLjuiu', 'user'),
(12, 'Pancho', 'pgodspeedeb@bandcamp.com', '$2a$04$9VLgStgGLKh9GUwG0fHiJummK5Gdua2ZvDFU0lVWgh54RQCT3ZEzS', 'user'),
(13, 'Stephenie', 'sravillasc@google.it', '$2a$04$BT5NWHtjdKrUnxfc2nNYhuctVRs2uoT/7S2Uem7x6NvyDtIuTLyHe', 'user'),
(14, 'Borg', 'bcardingd@netvibes.com', '$2a$04$vXEu8WzZC5JZdJKMMW7lt.giRoQ6LX3CdQ5J4xCJU4m6l96u.gvNW', 'user'),
(15, 'Ernesto', 'echesone@about.com', '$2a$04$muPLRfDP.cdArhj5vgx2ROPgJ4DMEEwEYEs58qG1.mlDCItPt2rwe', 'user'),
(16, 'Sheena', 'sprandyf@shareasale.com', '$2a$04$TqEwC24cnuG9nepoEukfae6xC3WIuqBvAbKQ3eCslAiUSfEbbdL5C', 'user'),
(17, 'Prince', 'pdufrayg@msu.edu', '$2a$04$Wtl1SclmwLfrtCWzf.wD9.zUaTV0RNYQzH/UV/TNgD5DNKPmFK90W', 'user'),
(18, 'Lissi', 'lridgewellh@devhub.com', '$2a$04$i3xhziYxSigQPh0dgLk9YOPm3UPfmICSk2ALtA6wSgBqYTxy4FXnS', 'user'),
(19, 'Pedro', 'pharbroni@geocities.com', '$2a$04$TFK8MGdpDGTKgYk4qj/x8OlSMjracT6BscyNBT1GjlNarhALxeNxW', 'user'),
(20, 'Charlot', 'ctemperleyj@twitpic.com', '$2a$04$2n5bzPs2tr8OV/Ao9AqFd.cWLHcphMKaYoZ/FFYDIgdPi4AAOwDuO', 'user'),
(21, 'Fayre', 'fbrimmank@disqus.com', '$2a$04$QBgQFcrJZKDF10CO3VziS.xLQSGoTbcgcpeTKeEZzpfl2PDTg9Fjq', 'user'),
(22, 'Ofilia', 'obecksonl@nasa.gov', '$2a$04$lhUDz6Y/XJxn/g.tlslq8.4Ro5jSgtBnGbsCQ8BEpMJ8z.vSeqtuC', 'user'),
(23, 'Hersh', 'hbanbrookm@geocities.com', '$2a$04$0Tyirn9O3aqzdmSsFGddGOzyPqeV2Q/hdXBd.k/ziEa1yOozR/o1q', 'user'),
(24, 'Gayleen', 'gleattn@apache.org', '$2a$04$eBRHIJs4RM6BwaIG4fQ5OOkAxqF7Jkz.EHByEaWVAlhvW5r6PXM.a', 'user'),
(25, 'Minnie', 'mwalworcheo@ocn.ne.jp', '$2a$04$co62WQa39wNHrNgvdgBdf.zjxfMRdj6snEGluUSOu9dyJXofss5hG', 'user'),
(26, 'Gunilla', 'gflatmanp@google.fr', '$2a$04$e1RrwQo6O.4a7tCK3ckrD.MJZenlQrxZ20KQTjgJoN9QOm5iApiii', 'user'),
(27, 'Klara', 'kthurlbornq@hc360.com', '$2a$04$rnllVRwrPi/NcXC9kWQPXOrw4gyjbnVTiXy3vNoqGBZW7d.vLua5C', 'user'),
(28, 'Nicky', 'ncullityr@home.pl', '$2a$04$eDhy2LDLBxxDZS2sK/W1u.n8IZ6sTK6d3mKwIPbZ3nV7qTlt94B/6', 'user'),
(29, 'Hetty', 'hhampsteads@simplemachines.org', '$2a$04$trgn1JZn6K8Zgyn1F9e3aOYMHMskpGBZ4rDm0mU7Lm8Wgper1UNQK', 'user'),
(30, 'Bevvy', 'bverseyt@sitemeter.com', '$2a$04$9el7xGfitqpzMWQsq0UGX.KTsTsSR54ckEZem7lyxn1DXAtGqK3Ze', 'user'),
(31, 'Ilene', 'iwoolvinu@cdbaby.com', '$2a$04$2EAo.JxlO0gCxmehKVcvyOjdEpYyY7bVHY8jTy/tuYJcKOvbXJ/iO', 'user'),
(32, 'Packston', 'pclaceyv@skyrock.com', '$2a$04$ubt9hfT8dgQERuaYxbYTz.oKwTpPUles9kJo8ffvI/vK29mWMS/Gu', 'user'),
(33, 'Northrop', 'nmocklerw@omniture.com', '$2a$04$rTvmd0.3vRNygHqIO9ER0eao1vs2WpROtzarypXLdRBeh5g.gYHXW', 'user'),
(34, 'Anatollo', 'acysonx@cnet.com', '$2a$04$iqMO4ACPCrnkNtOOEKaczuA02MpUNZpMrlAjzx/ra0RPZDJL8zJvC', 'user'),
(35, 'Eugenia', 'egotecliffey@reuters.com', '$2a$04$s8bxqLXJW8fBemzHKwe3wemk4MGvilkm1gCJehBGuQEFjCjFIRoMW', 'user'),
(36, 'Ethan', 'eburmanz@t.co', '$2a$04$EH8ReoDP6A7AmxkWy22ZHuoqXAMjroNxEXQtx81jRxsG8lFwxI/F.', 'user'),
(37, 'Emmy', 'egaye10@google.cn', '$2a$04$pSl543l5ehKsM4ScFAewwOsyJLVw2OcByR7DifxohxfQZoFODSbA.', 'user'),
(38, 'Gloria', 'gcasley11@ft.com', '$2a$04$SLUTuai.2GI7vURjS.SWrOrFQ.u5RUk7AM45zkWFzan3lm7NSjHSq', 'user'),
(39, 'Carlotta', 'cwightman12@nydailynews.com', '$2a$04$VOAHf8CUBMXEFf2VIW4YV.QC4gnwBlj2vrAYLmt/HSrBdWiAY3wyu', 'user'),
(40, 'Chloe', 'cianson13@hud.gov', '$2a$04$A3lfUIm/trzSmnfR7FgJ9.Dv6SmfAxViRUTfj/Mb/TE//qhgAfIkq', 'user'),
(41, 'Maridel', 'mallden14@geocities.jp', '$2a$04$GQ2CC7OdHZpMtcic8Qp06O8X.9cZyiVD.sHcS7SkqkoIR7R1x/uK6', 'user'),
(42, 'Krissy', 'keayres15@dmoz.org', '$2a$04$x3dmiNhc9BvvmSA4Geei7uCTT7zAnpNPcSBS60rdft/GrgjARoFFO', 'user'),
(43, 'Myrtice', 'mdunbleton16@miitbeian.gov.cn', '$2a$04$3FEP7IqTbXw1/yGpBbhXI.uJ3J6P32mLUPLtv656gSKA6tObEZT06', 'user'),
(44, 'Mellicent', 'mcuphus17@businesswire.com', '$2a$04$RAjI5.1jJIH3JKP8i8h2S.85S/48lAQ315GhV5T5VkPk.ivEi.zU6', 'user'),
(45, 'Ricki', 'rlarkcum18@nature.com', '$2a$04$0u3nog1BJB9mBNCC3xUMY.CPMH8JScVmfTqOjUi1OXlGr/P32/jm.', 'user'),
(46, 'Cami', 'cjeste19@csmonitor.com', '$2a$04$MpnzEy1OgPyG.xPHgbSdQu7m6AwEMRQvuxebFOql.2ZNSlNweJZMO', 'user'),
(47, 'Herbert', 'hworcs1a@fda.gov', '$2a$04$6Joh.a2RxRDsEj5ywMHypOFT0LT35nkQ61mXO9uDY3oOSGnwfV2Zu', 'user'),
(48, 'Jeramie', 'jpranger1b@utexas.edu', '$2a$04$MQJUuJVOOy51KbJrDY1EPuaY0dC/Y7lw1do9hK.bu87TAEFboxs.6', 'user'),
(49, 'Celene', 'ckestle1c@jiathis.com', '$2a$04$ptDGIUB6nZ7PHkThoW1ji.NPN9Yy7flS2C3bCr2szsT90U0gPj7vW', 'user'),
(50, 'Marshal', 'mmartinon1d@mlb.com', '$2a$04$K76fSmv8uS4ca9vjPwjXceyqkbnrPMXR3WYwI7k0Ebel6tnuEmdNa', 'user'),
(51, 'Drake', 'dsampson1e@4shared.com', '$2a$04$2BHMm8f27k2Wqg39HZMaPelOiA/A1HcEX5LudHeGckMvqmK20WM/q', 'user'),
(636, 'Dukey', 'dtongehn@lycos.com', '$2a$04$vmt.dWbbm5897T5y1bx5OOhH2HEUlHpqSlaBQ3rhSSEiy2WK./MeS', 'user'),
(637, 'Kirby', 'kjeenesho@bloglines.com', '$2a$04$0qz6DcqzPLV7hX90hNhwOejXzEDe.8ffUmndJoZhpWFICo2ovfGlS', 'user'),
(638, 'Raimundo', 'rnyleshp@marketwatch.com', '$2a$04$z6cTKipmbIbB2TaQzEyy.uaHigNQhjmBezrx.XjfGEGS1ZIednw9u', 'user'),
(639, 'Karna', 'ksimukovhq@buzzfeed.com', '$2a$04$zAE/23FQ9jGSqmubmZf5e.pCg4nd/Ts7MtMIwGEksVUNdjPeVQt2O', 'user'),
(640, 'Alla', 'aeyehr@about.me', '$2a$04$uXYL0pv8saU1aCaSY/6tDOdN/DVaBdvduL8D2XJZmGaxAJ61fssdW', 'user'),
(641, 'Bob', 'bnodeshs@technorati.com', '$2a$04$NchEAffHOPS2UNXtO4mLl.ycK5PEXc07EX5nRRAts3vxM5O8TTphm', 'user'),
(642, 'Jordan', 'jtamblingsonht@behance.net', '$2a$04$z/2576ieLxl7v0cDl.CJGef6PaXwhcAelwCzB.RdzNvru/4EsygTm', 'user'),
(643, 'Puff', 'pbirleyhu@slate.com', '$2a$04$Di/hn0cLwtJPIkPRJNP6POekayuWsKtbwjVQ9rkdSDFyU60b5HaF6', 'user'),
(644, 'Suzie', 'sravelushv@netlog.com', '$2a$04$rH9Dnsu2MNqulgcACWyFOecLHXDEGe0/BSAJDdn5Ph/8Irp1uzYhG', 'user'),
(645, 'Bruno', 'bbrafertonhw@examiner.com', '$2a$04$3QYH0vIeZ3Xys28oKNI9je9XHa/oPGpumkELnPPMgFEv9XJT0s3ki', 'user'),
(646, 'Sapphire', 'slabatiehx@yolasite.com', '$2a$04$pZNXi48oS0zs6Z3wH7OTQuvw4jhnWCS73nQfnwPSb2.4s/9/Nsfbi', 'user'),
(647, 'Iorgo', 'ipaladinihy@microsoft.com', '$2a$04$cEbX3SFKsDjX3rSuDUyuHeg77O1HkY4t2hmvLqAUu9iZWYOxYHUra', 'user'),
(648, 'Cassie', 'cperronihz@mapquest.com', '$2a$04$1RQc8dtKesdA8YTkZ4ea8OxOwU31l5g.FiOp/PDWDO0ufyRMwDrka', 'user'),
(649, 'Ronny', 'rsemainei0@blogspot.com', '$2a$04$mfOr4angbHI.ooKk4WETue.ftWQNKCo47U4CTGuPS.JltfHhY3LyW', 'user'),
(650, 'Gwenneth', 'gmatissei1@ca.gov', '$2a$04$jdiJvIBLCJNbInQmRawH5OGu08P5BMEjmLJKQYCrebierQjhQ4q/W', 'user'),
(651, 'Elijah', 'etuplini2@baidu.com', '$2a$04$6zXcMDbPrlmUg0V1NlSIPu6ZaXadNu1aB8T3WmLSTKkkQhP9oAnqe', 'user'),
(652, 'Roma', 'rloxdalei3@last.fm', '$2a$04$q1/XJCrZqV.oaP5Nw./VU..s/tnH5N.D2zQlCxiX9teC2YTL/Q0dG', 'user'),
(653, 'Maggie', 'mchichgari4@weibo.com', '$2a$04$XL7T5ntR6DQVQH/X.Ud2Z.EOuH0QRcrdpGymSZJTCFLgm5.8UajZ.', 'user'),
(654, 'Benedicta', 'bwenmani5@si.edu', '$2a$04$Awyn14dkZgvuOUp9amb1IOauK.m3rjyeIIZiqtFceRRc49hppPoh2', 'user'),
(655, 'Thibaud', 'tugolinii6@fema.gov', '$2a$04$/dV3t0BA5/z28aRnytNHr.f59l/6xXWXA0eLK69Y5ntBFukZEPUA6', 'user'),
(656, 'Melita', 'mfausseti7@freewebs.com', '$2a$04$myUP3UqoKVAYmPlmF.DBh.jyb.3thfFcPq6ca9tcsV0vJnMrp4SXW', 'user'),
(657, 'Lynn', 'lbrixeyi8@soup.io', '$2a$04$HnNWWUFe18R11luQlFlncOa3ExeNetuwcgniEEF2RRzjRFur87q1u', 'user'),
(658, 'Dev', 'dkitchingmani9@cafepress.com', '$2a$04$Mexpgo7FKhlvEd8USSs9j.Yng2DtE62eMXZOxaslobVEh8zg30X5C', 'user'),
(659, 'Abagael', 'aiacovelliia@about.me', '$2a$04$iV54hPcBiKUvwXK7mi5qt.kbcccXT/vcRLVnkl07xdT3Pq3h6ybq2', 'user'),
(660, 'Jervis', 'jdelmageib@issuu.com', '$2a$04$.gyXMMynf4fX3.KdoveJ7unmc0fRrMqezY1lrzXACD72jXVd2qdvi', 'user'),
(661, 'Lonnie', 'lsprasonic@de.vu', '$2a$04$4agec66415SbR4yKZ8tmLuoFS1aV9nUTz/bxKqRSueLRIJqQcqPyC', 'user'),
(662, 'Martin', 'mfusterid@digg.com', '$2a$04$fa0pvrArJkty3Rc57ICXJOpm14D481Sy2.vplKBIF0ngNEqjbe.1y', 'user'),
(663, 'Raine', 'rliversedgeie@ocn.ne.jp', '$2a$04$f.fWgfKpJIR6RmeTAdgttOslJHVfpXvV5LVcvQSGWQhYct3vUNpdW', 'user'),
(664, 'Aldis', 'awykeyif@cisco.com', '$2a$04$6.bxgm6l4pwBWlxUw.a7Q.ttd1KnXzUl.rYKghYDYccUb5wnMOsci', 'user'),
(665, 'Bartholomeo', 'bhunteig@t.co', '$2a$04$mI7fElfvzjghfsr98u29qOCHf3ZSS3ijhUz.6f1c.7MymG9fD0HWq', 'user'),
(666, 'Reidar', 'rdumbltonih@istockphoto.com', '$2a$04$lulLIjDiGKVCOO4qZ091GedQgvOV4qbz.YDqa0BYbGHDdqEea29N2', 'user'),
(667, 'Serene', 'ssemmenceii@tumblr.com', '$2a$04$qDxTtDMkoQRt/ko2CCIV2.Jg5bNol4ILC6OUfKxfO8/qgkRbQR4a6', 'user'),
(668, 'Raff', 'rgruteij@is.gd', '$2a$04$uoakI2gVOwM6f2JDm8v/Tuvw9jCyBhtWEAOMCTdFaN0D5o6OvE5MC', 'user'),
(669, 'Obed', 'obakerik@wikia.com', '$2a$04$2McwHHmeZRMP/Tj1fb9LeuSwowFO0AAq6dorCzEIokYyMcVmaWRFO', 'user'),
(670, 'Caresa', 'cbromleyil@printfriendly.com', '$2a$04$R/mMApag3BRKQGKLzFCBbuKLr3bnbIPuwpfEY0J0maKtcpLFEmtx6', 'user'),
(671, 'Rad', 'rcurtinim@independent.co.uk', '$2a$04$6HM01KkLOMN3wqhZdqgyE.OYxvDRZveDWz7fTzDankcYIH1oCif.6', 'user'),
(672, 'Bat', 'bmargiottain@utexas.edu', '$2a$04$YJLooIfQZnVHJTFq29zroe8xQx0NO04j7lh26uNJ.FtRMAySmsd.y', 'user'),
(673, 'Bink', 'bhollowio@businesswire.com', '$2a$04$TC4nn3Saw59DjA109i5qt.qMBzytxSlmsi2Wn.bWM18OqlhK.2lfm', 'user'),
(674, 'Chrotoem', 'cockendenip@dailymotion.com', '$2a$04$oEhZK/76NLLx1CLAx05v9uPsyUqVzFPtJTOeJlPexMwMZaOlBilhO', 'user'),
(675, 'Glynis', 'gsolomoniq@home.pl', '$2a$04$donr9t/iJ8R.v8dtIsaBLeGAM3z03/XJd.Z8xPJHxtPQTbzOudXiW', 'user'),
(676, 'Lauri', 'lruppertir@mapquest.com', '$2a$04$dE9pv2hdNvnEw0EvZmrpEOehMKh2UtZP.rkiym51sFgIUbwlnDagW', 'user'),
(677, 'Sybila', 'sjaouenis@google.ru', '$2a$04$hPq7cFR/L9XCS5sYo76rb.tlPiDO1kyK/VkXJi/qicJis0dIUr1K2', 'user'),
(678, 'Angelia', 'ayanceyit@redcross.org', '$2a$04$iEg/7vYuO3nMvCwTs8IB6.tc4yQFN.uBXY9jyhzJjClUOrA7FMj7a', 'user'),
(679, 'Erhard', 'edinniesiu@dedecms.com', '$2a$04$NpB91eueo1i/NHw22R5eUOsSVlZ6sXEaHfbOjz0hBbFHlxhgxf.eS', 'user'),
(680, 'Marlo', 'mshurmoreiv@issuu.com', '$2a$04$arCCneotA.VM8nIVkYHVYeN.Yml0L6Hsmrj6Z7GRBnjLnzc3HLl9S', 'user'),
(681, 'Kimball', 'kdabliniw@abc.net.au', '$2a$04$vMuoYTH1Lfxj/IkjtLd1..sV/J7KYR9Td8NFUKy85d5xMmXT4l0Q6', 'user'),
(682, 'Jessee', 'jjolleyix@engadget.com', '$2a$04$comWoEQnVcBM4X3.6PmtQ.YxO93tRM8CagLVRkpr7tUJLOTjsnO.W', 'user'),
(683, 'Marlie', 'mdallyniy@oakley.com', '$2a$04$I8xV0NvbsdXds4MV61lnU.N8P5dJBW.hNrWPxQKgC8RB75xtZAYQG', 'user'),
(684, 'Patrica', 'pyaxleyiz@oracle.com', '$2a$04$OpbW9kIaE5G9C7xl8isAhezaE7eSdVM0TnnHUbSh7WbjKr32RM/OO', 'user'),
(685, 'Geraldine', 'ggrininj0@geocities.com', '$2a$04$rNqHYJKlGrDgN5S9iD4GZuNWjnO6lb4q2i8738lv2mhcXHDnq.Q8a', 'user'),
(686, 'Dyna', 'droddj1@bravesites.com', '$2a$04$fAcY/cDCAdVqN7Hsq0U.bucY5VH2UTQp4okzZJBNrQRLglT3mbovC', 'user'),
(687, 'Domini', 'dedsellj2@facebook.com', '$2a$04$jxC4GunzHtUqtT4DFbHrN.vNPDBNOapi50NFVkMRVHN8gQTANOKy6', 'user'),
(688, 'Fleming', 'fpattersj3@fc2.com', '$2a$04$Emny1wHv2V2GBeN1k.4EiugWkNsMxdksFXom/MlLZn/59puygKMRi', 'user'),
(689, 'Vikki', 'vdellenbrokerj4@dot.gov', '$2a$04$uGRKpPMkFpdwO00EhWyScOwrDRKBaKI.6WFc5l1Ym4aa5pto6O4ha', 'user'),
(690, 'Roxana', 'rpeetersj5@stumbleupon.com', '$2a$04$2T9dZpQ4FPFacoOFetj44uXXTQ64hDuIKfZnVi3YFl1GCc9R8qWB2', 'user'),
(691, 'Land', 'lfullicksj6@hexun.com', '$2a$04$gncp4rszgcVUIR2.a0OiDupFxg9dZkvBDPGL3UGHfH.da5zm6GFTa', 'user'),
(692, 'Flossie', 'fambroginij7@google.cn', '$2a$04$kL1hpwhVYlQ.Sq5IiI/X.uMLWX0Kg5H247vAWP76CWKWgU.6JLbci', 'user'),
(693, 'Creighton', 'cdraynj8@netscape.com', '$2a$04$MKaeNxpW7a0a1hEreJmvl.bspP70vGXD4wQLz2/wat9y7eOnjFIS.', 'user'),
(694, 'Ferrell', 'fmughalj9@amazon.com', '$2a$04$XGYPHwaUVWZY6zNb5dX.LeVQWk.CjpdTaUDKqmPOd64tmU6FjelMS', 'user'),
(695, 'Godfrey', 'gchestersja@rambler.ru', '$2a$04$5V476OaeKg6qXDKqIORxFONQi1iAqQTDnAcXe7rTc3PbkivS2nK0C', 'user'),
(696, 'Owen', 'ohectorjb@mit.edu', '$2a$04$mQoCc4iz9YG3/58sHldzWudm2X6N.dpSgUXjTtJ7JzhYvED86BpCu', 'user'),
(697, 'Stesha', 'sjulianjc@vinaora.com', '$2a$04$0BNLouFiyLnEnjZBLXCtGujZjbHehcggk6r/qW5HIHpDIdxpB6AXG', 'user'),
(698, 'Lila', 'lbalesjd@goo.gl', '$2a$04$s9TV1W6dCzyrwSG4c3uJB.6mQ2ysPoZgJu.xcS84i7qfkh7H2UNK.', 'user'),
(699, 'Bertina', 'bnorthoverje@xing.com', '$2a$04$dVse7moDotum4g/dEAu6t.xQ93PhabMJwlZgLM/CkF2wPzGJMnKZe', 'user'),
(700, 'Eydie', 'ecordonjf@salon.com', '$2a$04$sTxYZS2jRj0in8yCWUjulu2a3EXox0ZamCgsAaCQaHFcN0l0M2hi6', 'user'),
(701, 'Nada', 'nthomassonjg@oaic.gov.au', '$2a$04$BDLEXTscAXvjE6.VNTW8uOWVSxpBn.YHJTN5/dH8cMbi6kpXM5q4K', 'user'),
(702, 'Cullan', 'cisakovitchjh@slashdot.org', '$2a$04$VaTrzIsgLc7Tapyv5mNfM.mnHPFfHewMd7pKeiYw.HZ01.fasiJTG', 'user'),
(703, 'Gerard', 'gwallachji@senate.gov', '$2a$04$yOPWceT/06LWBDasGYCuu.HYP4t6ouVlb1TyEfipFfm/vuJTDIvnm', 'user'),
(704, 'Jewelle', 'jedworthyjj@imageshack.us', '$2a$04$ZcXcASdYcVBp8gQRVmfwUuF3gAKaKyeWKehouOAh3QkK5w8BmsLKy', 'user'),
(705, 'Madalena', 'mpanyerjk@goo.ne.jp', '$2a$04$tFYXVlj9umbig/7BKoKzwuL9Ff9BmYjWN0rHR8MbjN49.mqQ8ywIy', 'user'),
(706, 'Ewan', 'emeadleyjl@jigsy.com', '$2a$04$Je/lrAiOQW1cM8q12kZs5.9u2Z48TjtbeNsuHJ1WTB3GY92pQRqwS', 'user'),
(707, 'Gwendolyn', 'ggroverjm@baidu.com', '$2a$04$zPRR/7biX.1gbQmhly1tlu3l9egeHTQh8Iv1u.qJRnXap4pykFcaq', 'user'),
(708, 'Fara', 'fwandtkejn@google.pl', '$2a$04$dcumGIsJWJJfR6Wt1pIbGOtAr6kHgh6fWXVh7XcVB.tBf1o2muHqS', 'user'),
(709, 'Dalenna', 'derasmusjo@studiopress.com', '$2a$04$p/KIJNmXA6W45NTw832/l.lA6/zCKTNG.jQriDg2uizk33.qzcUFK', 'user'),
(711, 'Sherwynd', 'saldinsjq@miitbeian.gov.cn', '$2a$04$UM4GJGRRB/ZuHZGe2dQys.VFLURFfSitQtZeldOGGZZo072429J6e', 'user'),
(712, 'parisa', '123125@gmail.com', '$2y$10$aX5EHszY6odZ7y6lKokyLuX3CvlZoJSFGLoTbJbk1cXNo4rtCp0tC', 'user'),
(713, 'admin', 'newadmin@example.com', '$2y$10$5V2PYWBmxEHU0Rl1Njify.gdheLPef9s7BmttCBRlEUw8Z4mPXWmm', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `shared_files`
--
ALTER TABLE `shared_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shared_with` (`shared_with`),
  ADD KEY `shared_by` (`shared_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shared_files`
--
ALTER TABLE `shared_files`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=714;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shared_files`
--
ALTER TABLE `shared_files`
  ADD CONSTRAINT `shared_files_ibfk_1` FOREIGN KEY (`shared_with`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `shared_files_ibfk_2` FOREIGN KEY (`shared_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
