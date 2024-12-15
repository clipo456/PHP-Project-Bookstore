-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: livraria
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) DEFAULT NULL,
  `destaque` char(1) DEFAULT NULL,
  `nome` varchar(80) DEFAULT NULL,
  `publicacao` datetime DEFAULT NULL,
  `autor` varchar(60) DEFAULT NULL,
  `numero_pg` int DEFAULT NULL,
  `dimensoes` varchar(45) DEFAULT NULL,
  `capa` varchar(45) DEFAULT NULL,
  `editora` varchar(45) DEFAULT NULL,
  `idioma` varchar(30) DEFAULT NULL,
  `preco` float(9,2) DEFAULT NULL,
  `desconto` tinyint DEFAULT NULL,
  `desconto_boleto` tinyint DEFAULT NULL,
  `max_parcelas` tinyint DEFAULT NULL,
  `estoque` int DEFAULT NULL,
  `min_estoque` int DEFAULT NULL,
  `data_reg` date DEFAULT NULL,
  `id_genero` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (5,'00001','S','Quincas Borba - Edição especial','2019-02-01 00:00:00','Macha de Assis',224,'20.8 X 13.8 X 1.6 cm','Capa comum','Via Leitura','Português',21.98,35,50,12,450,110,'2022-06-16',28),(6,'00002','S','O Ladrão de Raios (Série Percy Jackson e os Olimpianos) - Edição padrão','2014-08-11 00:00:00','Rick Riordan',400,'21 X 13.4 X 2.2 cm','Capa comum','400','Português',41.20,65,67,12,327,62,'2022-06-16',23),(7,'00003','S','As Crônicas de Nárnia','2009-01-08 00:00:00','C. S. Lewis',752,'22.8 X 15 X 4.4 cm','Capa comum brochura','WMF Martins Fontes','Português',24.90,15,20,12,89,12,'2022-06-16',23),(8,'00004','S','Naruto Gold Vol. 31','2018-02-21 00:00:00','Masashi Kishimoto',192,'20 X 13.4 X 1.4 cm','Capa comum','Panini','Português',23.40,10,15,12,75,11,'2022-06-16',24),(9,'00005','S','One Piece Yellow – Grandes Elementos','2017-08-15 00:00:00','Eiichiro Oda',200,'20 X 13.6 X 1.4 cm','Capa comum','Panini','Português',120.00,55,65,12,149,23,'2022-06-16',24),(10,'00006','S','H.P. Lovecraft - Medo Clássico - Vol. 1 - Myskatonic Edition: O mestre dos mestr','2017-12-14 00:00:00','H.P. Lovecraft',384,'23.4 X 15.8 X 3.2 cm','Capa dura – Edição especial','Darkside','Português',39.90,50,65,12,68,13,'2022-06-16',20),(12,'00010','S','Jogos vorazes (Trilogia Jogos Vorazes Livro 1)','2022-03-16 00:00:00','Suzanne Collins',400,'14 X 3 X 21 cm','Capa comum','Rocco Jovens Leitores','Português',46.20,35,50,12,37,7,'2022-06-20',24),(13,'00009','S','O Poder da Ação para Crianças','2020-09-15 00:00:00','Mauricio de Souza',96,'22.8 x 15.6 x 0.8 cm','Capa comum','Gente','Português',17.90,10,25,12,60,12,'2022-06-20',29),(14,'00008','S','Moby Dick','2022-07-08 00:00:00','Herman Melville',752,'20 X 4.37 X 26 cm','Capa comum','Antofágica','Português',89.99,45,70,12,89,11,'2022-06-20',21),(15,'00007','S','Viagem ao centro da Terra(Clássicos da literatura mundial)','2022-07-07 00:00:00','Julio Verne',237,'22.8 X15.6 X 0.8 cm','Capa comum','Principis','Português',9.95,12,20,12,32,6,'2022-06-20',21),(16,'00011','S','Cinquenta Tons De Cinza: (Série Cinquenta tons de cinza vol. 1)','2012-07-18 00:00:00','E.L. James',480,'22.8 X 15.6 X 2.6 cm','Capa comum','Intrínseca','Português',32.47,25,30,12,69,13,'2022-06-20',28),(17,'00012','S','O nome do vento (A Crônica do Matador do Rei – Livro 1)','2019-07-21 00:00:00','Patrick Rothfuss',656,'22.8 X 16 X 2.8 cm','Capa comum','Arqueiro','Português',59.84,45,65,12,45,13,'2022-06-20',23),(18,'00013','S','Terra sonâmbula','2016-01-29 00:00:00','Mia Couto',208,'20.8 X 13.6 X1.4 cm','Capa comum','Companhia das Letras','Português',38.99,35,50,12,89,8,'2022-06-20',28),(20,'00014','S','O menino do pijama listrado','2007-10-11 00:00:00','John Boyne',192,'20.8 X 13.8 X 1.2 cm','Capa comum','Seguinte','Português',31.40,15,30,12,27,4,'2022-06-20',28),(21,'00015','S','A Menina Que Roubava Livros','2013-06-10 00:00:00','Markus Zusak',480,'22.86 X 15.49 X 2.54 cm','Capa comum','Intrínseca','Português',26.95,5,15,12,60,5,'2022-06-20',21),(22,'00016','S','A Lenda dos Guardiões - A Arvore Dourada - Volume 12','2013-01-01 00:00:00','Kathryn Lasky',168,'22.4 X 15.6 X 1.2 cm','Capa comum','Fundamento','Português',44.19,72,80,12,76,19,'2022-06-20',23),(23,'00018','S','O Código Da Vinci (Robert Langdon - Livro 2) Edição econômica','2021-04-15 00:00:00','Dan Brown',560,'19.8 X 12.8 X 3 cm','Capa comum','Arqueiro','Português',20.90,21,29,12,39,4,'2022-06-20',21),(24,'00017','S','The English Spy: 15 Edição econômica','2016-03-29 00:00:00','Daniel Silva',544,'10.64 X 3.12 X 19.05 cm','Capa comum','Harper','Inglês',53.66,35,65,12,56,12,'2022-06-20',24);
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-21  0:00:59
