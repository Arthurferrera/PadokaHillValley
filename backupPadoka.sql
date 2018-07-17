-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 192.168.0.2    Database: dbpc1120181
-- ------------------------------------------------------
-- Server version	5.5.35-0+wheezy1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_ambiente_caracteristica`
--

DROP TABLE IF EXISTS `tbl_ambiente_caracteristica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_ambiente_caracteristica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idContAmbiente` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `texto` text NOT NULL,
  `foto` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idContAmbiente` (`idContAmbiente`),
  CONSTRAINT `tbl_ambiente_caracteristica_ibfk_1` FOREIGN KEY (`idContAmbiente`) REFERENCES `tbl_conteudo_ambiente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_ambiente_caracteristica`
--

LOCK TABLES `tbl_ambiente_caracteristica` WRITE;
/*!40000 ALTER TABLE `tbl_ambiente_caracteristica` DISABLE KEYS */;
INSERT INTO `tbl_ambiente_caracteristica` VALUES (1,4,'Bebidas','Variados tipos de cafÃ©s, chÃ¡s e sucos, para que nossos clientes nÃ£o fique com a garganta seca durante aquela leitura diÃ¡ria.\r\n','arquivos/914424c8fd029f56e44cda12522e303c.png',1),(2,4,'Conforto','Aqui o conforto Ã© garantido, contamos com lindos sofÃ¡s para nossos clientes ficarem bem enquanto lÃªem o livro preferido.\r\n','arquivos/0444a59b9b39eb1db8e41f1d09fd8488.jpg',1),(3,4,'Livros','Caso nÃ£o esteja com livro prÃ³prio, temos uma variedade de opÃ§Ãµes de livros para que nossos clientes desfrute enquanto permanece em nosso espaÃ§o para leitura.\r\n','arquivos/26d6d3436a152b3ad61eade6e312d466.jpg',1),(4,5,'Bebidas','Aqui o nosso cliente tem uma variedade de bebidas quentes e frias para ajudar na concentraÃ§Ã£o das pessoas\r\n','arquivos/84253372b1255a5e17d752e6f5292d49.jpg',1),(5,5,'Wifi','Aqui o conforto Ã© garantido, contamos com lindos sofÃ¡s para nossos clientes ficarem bem enquanto lÃªem o livro preferido.\r\n','arquivos/6362a53cc322aa83055d9f0a98c10f1a.jpg',1),(6,5,'Gamer','Junte sua panela de amigos e venha fazer aquela jogatina, ou tambÃ©m use nosso espaÃ§o para fazer pesquisas, vocÃª cliente que escolhe.\r\n','arquivos/e71364bfe793707d135b31244332da8a.jpg',1),(8,6,'Decoração','Temos uma decoração inspirada no bom e velho Rock and Roll, que lembra o melhores anos do Rock, (70,80, 90).\r\n','arquivos/2e42bc26a86c05abc85eaee59d8481c6.jpg',1),(9,6,'Música','Para os amantes do bom e velho Rock and Roll, temos a maravilhosa JulkBox, para desfrutar de suas msúsicas preferidas.\r\n','arquivos/b02247d37b857daeda43d3dcea349fea.jpg',1),(10,6,'Petiscos','Nosso cliente nesse ambiente tem os melhores “petiscos” para degustar e curtir nossa temática.\r\n','arquivos/5898d1f2768834c5b7cfeb94ddf970da.jpg',1),(11,7,'teste do marcel','teste testeteste testeteste teste','arquivos/f919202d941ae6a015d345298d8a3a48.jpg',1);
/*!40000 ALTER TABLE `tbl_ambiente_caracteristica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,'PÃ£es',1),(2,'PÃ£es Artesanais',1),(3,'Petiscos',1),(4,'Doces',1),(5,'Bebidas Quentes',1),(6,'Bebidas Frias',1),(7,'Lanches',1),(8,'CafÃ© da ManhÃ£',1),(9,'Frios',1);
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_conteudo_ambiente`
--

DROP TABLE IF EXISTS `tbl_conteudo_ambiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_conteudo_ambiente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoAmbiente` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `texto` text NOT NULL,
  `foto` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idTipoAmbiente` (`idTipoAmbiente`),
  CONSTRAINT `tbl_conteudo_ambiente_ibfk_1` FOREIGN KEY (`idTipoAmbiente`) REFERENCES `tbl_tipo_ambiente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_conteudo_ambiente`
--

LOCK TABLES `tbl_conteudo_ambiente` WRITE;
/*!40000 ALTER TABLE `tbl_conteudo_ambiente` DISABLE KEYS */;
INSERT INTO `tbl_conteudo_ambiente` VALUES (4,7,'Ambiente de Leitura','Aqui o nosso cliente pode desfrutar de\r\n                            um ambiente completo e totalmente temÃ¡tico para os amantes de leitura\r\n                            e que apreciam um Ã³timo cafÃ© como parceiro de leitura.','arquivos/913aa470e1ddefaf11f8f2ae88a820b3.jpg',1),(5,8,'Ambiente de Tecnologia','Esse ambiente foi criado para os amantes de tecnologia que adoram se reunir em nossa padaria para fazer pesquisas, jogar e atÃ© mesmo trabalhar, muitas pessoas marcam encontros para desfrutar de nossas instalaÃ§Ãµes.','arquivos/7b0f831453445a13bfbb1cff854243a6.png',1),(6,9,'Ambiente de RetrÃ´','Aqui nossa padaria foi totalmente preparada para os amantes do bom e velho Rock and Roll, esse ambiente Ã© composto por equipamentos, decoraÃ§Ãµes e JulkBox que lembram os melhores anos do Rock and Roll (70, 80 e 90).','arquivos/edfa6a10e514e789da23589648420102.jpg',1),(7,9,'tec do marcel 666','teste testeteste testeteste testeteste testeteste testeteste testeteste testeteste teste','arquivos/483aa0a776c9440e88958b8594d93786.jpg',1);
/*!40000 ALTER TABLE `tbl_conteudo_ambiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado`
--

DROP TABLE IF EXISTS `tbl_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado`
--

LOCK TABLES `tbl_estado` WRITE;
/*!40000 ALTER TABLE `tbl_estado` DISABLE KEYS */;
INSERT INTO `tbl_estado` VALUES (1,'Acre'),(2,'Alagoas'),(3,'Amapá'),(4,'Amazonas'),(5,'Bahia'),(6,'Ceará'),(7,'Distrito Federal'),(8,'Espírito Santo'),(9,'Goiás'),(10,'Maranhão'),(11,'Mato Grosso'),(12,'Mato Grosso do Sul'),(13,'Minas Gerais'),(14,'Pará'),(15,'Paraíba'),(16,'Paraná'),(17,'Pernambuco'),(18,'Piauí'),(19,'Rio de Janeiro'),(20,'Rio Grande do Norte'),(21,'Rio Grande do Sul'),(22,'Rondônia'),(23,'Roraima'),(24,'Santa Catarina'),(25,'São Paulo'),(27,'Sergipe'),(28,'Tocantins');
/*!40000 ALTER TABLE `tbl_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fale_conosco`
--

DROP TABLE IF EXISTS `tbl_fale_conosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fale_conosco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `homePage` varchar(255) DEFAULT NULL,
  `linkFacebook` varchar(255) DEFAULT NULL,
  `sugestao` text,
  `infoProduto` text,
  `sexo` char(1) NOT NULL,
  `profissao` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fale_conosco`
--

LOCK TABLES `tbl_fale_conosco` WRITE;
/*!40000 ALTER TABLE `tbl_fale_conosco` DISABLE KEYS */;
INSERT INTO `tbl_fale_conosco` VALUES (6,'Marcia Santos','(21) 5194-8732','(11) 97411-1268','marcia@gmail.com','http://marcia.wordpresss.com','https://facebook.com/marciaSantos','Deixar de ser uma padaria tão boa, tomo café todos os dias ai','Os melhores','F','Gerente Comercial'),(7,'Arthur Ferreira','(11) 1111-1111','(22) 22222-2222','arthur@hotmail.com','http://exemplo.com','https://facebook.com/arthur','Atendimento melhor','Muito Bons','M','TÃ©cnico em TI'),(8,'afdsrgrs','(11) 1111-1111','(11) 11111-1111','fsgthte@gafgdshdf','http://exemplo.com','https://facebook.com/arthur','jtrjktuk','kikiyliliyll','M','jreyjye'),(9,'TESTE MOBILE','(11) 1111-1111','(11) 11111-1111','afadfd@hotmail.com','http://exemplo.com','https://facebook.com/arthur','hjfjsfhjkhjf','fdkjkugdkgutk[','M','ghdhgdgjsfr'),(10,'Teste hospedagem','(11) 1111-1111','(52) 22222-2222','sdaadfsgs@padoka.com.br','http://exemplo.com','https://facebook.com/arthur','Shshshhsb a aah 8w22uehesbsbd','Bshssquw7w7wuehehdh','F','Tester'),(11,'anderson','','48028922','anderson.eae.arthur@beleza.com','','','Ta bom, sÃ³ arruma esse radio do sexo ae','','M','nada'),(12,'Teste Hospedagem','(11) 1111-1111','(22) 22222-2222','teste@gmail.com','http://www.hospedagem.com.br','http://www.hospedagem.com.br','Teste Teste Teste','Teste Teste TesteTeste Teste TesteTeste Teste Teste','F','Tester');
/*!40000 ALTER TABLE `tbl_fale_conosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_loja`
--

DROP TABLE IF EXISTS `tbl_loja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_loja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(70) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `numero` int(11) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `cidade` varchar(70) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idEstado` (`idEstado`),
  CONSTRAINT `tbl_loja_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `tbl_estado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_loja`
--

LOCK TABLES `tbl_loja` WRITE;
/*!40000 ALTER TABLE `tbl_loja` DISABLE KEYS */;
INSERT INTO `tbl_loja` VALUES (1,'aaaa','11 4567-2345','arthur@padoka.com.br','afgdgsfheh',222,'34252-123','aaaaaa','arquivos/7734c893c641cbc40c63f7a01309661b.png',23,1),(2,'Padoka Hill Valley','(11) 3456-9728','contato@padokaHillvalley.com.br','Av. Luis Carlos Berrini',666,'06653-134','SÃ£o Paulo','arquivos/ccca63ea390bfe30b7b5a7fe1e83b1d1.png',25,1),(7,'Loja do Marcel','(11) 1111-1111','teste@teste.com','rua elton silva',252,'01660-000','Cidade de Teste','arquivos/02d68152302a2a5a6bd2f3f7f67e36ab.jpg',14,1),(8,'Padoka Hill Valley - Espirito Santo','(11) 1111-1111','arthur@padoka.com.br','Av Santo Amaro',2345,'00000-000','VitÃ³ria','arquivos/5c1174002eba1337118265b610c19e73.jpg',8,1);
/*!40000 ALTER TABLE `tbl_loja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nivel_usuario`
--

DROP TABLE IF EXISTS `tbl_nivel_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nivel_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `descricao` text,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivel_usuario`
--

LOCK TABLES `tbl_nivel_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_nivel_usuario` DISABLE KEYS */;
INSERT INTO `tbl_nivel_usuario` VALUES (1,'Administrador','O Administrador Poderá realizar todo o gerenciamento do conteúdo do site.',1),(2,'Cataloguista','Esse nível de autenticação será responsável por administrar\napenas o menu Módulo de Administração Produtos que irá alimentar\na página Home do site.',1),(3,'Operador Básico','O Operador básico poderá apenas gerenciar informações básicas do site.',1);
/*!40000 ALTER TABLE `tbl_nivel_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `preco` float(7,2) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `produtoDoMes` tinyint(1) NOT NULL,
  `qtdCliques` int(11) DEFAULT NULL,
  `idTipoProduto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idTipoProduto` (`idTipoProduto`),
  CONSTRAINT `tbl_produto_ibfk_1` FOREIGN KEY (`idTipoProduto`) REFERENCES `tbl_tipoproduto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (2,'Suco de Tamarindo','Este suco de tamarindo Ã© uma bela opÃ§Ã£o para um dia caloroso. RefrencÃ¢ncia pura.',4.50,'arquivos/6a8e649df1ebd72af0ba4a86f22e5fce.jpg',1,0,75,21),(3,'Bolo de Cenoura','Bolo muito bom.',25.00,'arquivos/806818541084f74d762ff5d728eb8b20.jpg',1,0,13,20),(4,'Bisnaguinha','O pÃ£o bisnaguinha, Ã© uma deliciosa opÃ§Ã£o para as crianÃ§as no cafÃ© da manhÃ£.',8.99,'arquivos/b877b5cb30b4f34996e719d8bb1c63dc.jpg',1,0,26,3),(5,'PÃ£o Tradicional','PÃ£o tradicional de todas as manhÃ£s.',3.99,'arquivos/89c689c56c2aa13bd605348650409aa9.jpg',1,0,98,1),(6,'PÃ£o de Batata Recheado','PÃ£o de batata, recheado de frango com catupiri.',4.00,'arquivos/204439960d73ff230c2e9153c63bfee3.jpg',1,0,236,2),(7,'Baguete de Bauru','Baguete recheada com presunto e queijo.',8.30,'arquivos/2f6d9b4e0c0311cd63c78e4783fda403.jpg',1,0,169,4),(8,'PÃ£o de Queijo Mineiro','PÃ£o de queijo, recheado com queijo direto de minas, uma deliciosa opÃ§Ã£o para acompanhamento.',3.50,'arquivos/c9ca0c28893c5e02e381cd5bc8b57999.jpg',1,0,304,12),(9,'Coxinha Tradicional','Coxinha tradicional de frango com um pouco de catupiri.',3.50,'arquivos/1602c6b899ed1d855b718ad97bd04f93.jpg',1,0,111,13),(10,'Kibe','Kibe tradicional, delicioso.',3.00,'arquivos/51915bc522558dc10a73d62c9f2ce0c9.jpg',1,0,45,15),(11,'Empada de Palmito','Empada muito bem recheada com palmito selecionado.',4.00,'arquivos/e9b14dfdb0b37afdef5b5a6d9d345eed.jpg',1,0,12,16),(12,'Pudim de Leite','Delicioso pudim de leite.',11.99,'arquivos/de6e70641c13802dce54e32aa38634ef.jpg',1,0,14,17),(13,'Carolina de Doce de Leite','Um doce maravilhoso com recheio de doce de leite, e com cobertura de chocolate.',1.70,'arquivos/9a96c2f4fbea61fe4ec5b8fb53dce00e.jpg',1,0,2,18),(14,'CafÃ© Extra Forte','SÃ£o 100ml de cafÃ© que te deixa acordado por 24 horas.',1.50,'arquivos/6412d60daec7145d364495878be19516.jpg',1,1,56,22),(15,'ChÃ¡ Mate','Um delicioso chÃ¡ para um clima mais frio, o melhor da regiÃ£o.',1.50,'arquivos/8bb7cdd5ebac9bd2a295d4a17bbe6e06.jpg',1,0,208,23),(17,'Moda da Casa','Hamburgues especial e autÃªntico feito pelo chefe.',12.00,'arquivos/6c561e593ad80f4071c17c9540136a04.jpg',1,0,2,25),(18,'CafÃ© Brasileiro','CafÃ© da manhÃ£ tradicional brasileiro.',14.00,'arquivos/348aa02b53bad038b0a0e7b82b5af113.jpg',1,0,1,26),(19,'Frios de Calabresa','PÃ£o de frios recheado com calabresa.',2.00,'arquivos/19cd9a216e03cd71bc4d659b34dbf560.jpg',1,0,5,27);
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_promocao`
--

DROP TABLE IF EXISTS `tbl_promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_promocao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `porcentagemDesc` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idProduto` (`idProduto`),
  CONSTRAINT `tbl_promocao_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `tbl_produto` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_promocao`
--

LOCK TABLES `tbl_promocao` WRITE;
/*!40000 ALTER TABLE `tbl_promocao` DISABLE KEYS */;
INSERT INTO `tbl_promocao` VALUES (2,20,2,1),(3,20,3,1),(5,15,4,1),(8,10,14,1);
/*!40000 ALTER TABLE `tbl_promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobre`
--

DROP TABLE IF EXISTS `tbl_sobre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `texto_principal` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `texto_missao` text NOT NULL,
  `texto_visao` text NOT NULL,
  `texto_valor` text NOT NULL,
  `texto_diversidade` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobre`
--

LOCK TABLES `tbl_sobre` WRITE;
/*!40000 ALTER TABLE `tbl_sobre` DISABLE KEYS */;
INSERT INTO `tbl_sobre` VALUES (4,'Sobre','A primeira Padoka Hill Valley, foi inaugurada no ano de 2016. O fundador Sr. Ed Van Halen, veio com a proposta de fazer a diferenÃƒÂ§a nesse segmento.\r\n\r\ndesde sua inauguraÃ§Ã£o, nossa padaria sÃ³ vem crescendo, sendo muito bem falada, e queremos ser a NÂ°1 do mercado. \r\n\r\nUma padaria moderna, ambientes agradÃ¡veis, lanches e bebidas que sÃ£o deliciosos, funcionamento 24 horas e muito mais !!','arquivos/48e8a9a1984356293e76431694b76eb2.png','Atender nossos clientes de maneira agradÃ¡vel sempre, proporcionando a eles qualidade nos produtos oferecidos e satisfaÃ§Ã£o no atendimento.','Ser referencia no mercado de panificaÃ§Ã£o e confeitaria, buscando sempre a excelÃªncia no atendimento, ambientes agradÃ¡veis e inovaÃ§Ãµes diÃ¡rias, tanto no atendimento como na qualidade dos produtos oferecidos para superar as expectativas dos clientes e fornecedores.','Fidelizar clientes. Apoio e relacionamento com nossos colaboradores que representam o orgulho pela nossa empresa. Agradar a todos que aqui residem e os que vem prestigiar nossa cidade com qualidade, agilidade e cortesia.','Nossa Padaria Ã© totalmente diferente as padarias comuns no mercado, pois aqui funcionamos 24 horas, e temos ambientes tematizados para nossos clientes, onde cada andar Ã© destinado a um tipo de ambiente.\r\n\r\nNossa infraestrutura foi criada para receber e agradar todos os amantes de uma boa padaria com algum complemento (mÃºsica, leitura e tecnologia).',1),(5,'sdagasfhet','jhetjetje','arquivos/b835837be86a1dce7604781056ef4192.jpg','tyhjtyjryjry','jtuktuklu','jkryjkryjty','klulky',0),(6,'sobre marcel 666','teste teste','arquivos/fedb349ab5e0dfa632e0faba50709781.jpg','teste testeteste testeteste teste','teste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste teste','teste testeteste testeteste testeteste testeteste testeteste testeteste testeteste teste','teste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste testeteste teste',0);
/*!40000 ALTER TABLE `tbl_sobre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_ambiente`
--

DROP TABLE IF EXISTS `tbl_tipo_ambiente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_ambiente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_ambiente`
--

LOCK TABLES `tbl_tipo_ambiente` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_ambiente` DISABLE KEYS */;
INSERT INTO `tbl_tipo_ambiente` VALUES (7,'Ambiente de Leitura',1),(8,'Ambiente de Tenologia',1),(9,'Ambiente RetrÃ´',1);
/*!40000 ALTER TABLE `tbl_tipo_ambiente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipoproduto`
--

DROP TABLE IF EXISTS `tbl_tipoproduto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipoproduto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_tipoproduto_ibfk_1` (`idCategoria`),
  CONSTRAINT `tbl_tipoproduto_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `tbl_categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipoproduto`
--

LOCK TABLES `tbl_tipoproduto` WRITE;
/*!40000 ALTER TABLE `tbl_tipoproduto` DISABLE KEYS */;
INSERT INTO `tbl_tipoproduto` VALUES (1,'PÃ£o FrancÃªs',1,1),(2,'PÃ£o de Batata',1,1),(3,'PÃ£o de bisnaga ',1,1),(4,'PÃ£o de metro',1,2),(12,'PÃ£o de Queijo',1,3),(13,'Coxinhas',1,3),(14,'Esfihas',1,3),(15,'Kibes',1,3),(16,'Empadas ',1,3),(17,'Pudim',1,4),(18,'Carolina',1,4),(20,'Bolos',1,4),(21,'Sucos',1,6),(22,'CafÃ©s',1,5),(23,'ChÃ¡s',1,5),(25,'HambÃºrgueres',1,7),(26,'Brasileiro',1,8),(27,'PÃ£o de Frios',1,9);
/*!40000 ALTER TABLE `tbl_tipoproduto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `celular` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sexo` char(1) NOT NULL,
  `usuario` varchar(25) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `idNivelUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idNivelUsuario` (`idNivelUsuario`),
  CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`idNivelUsuario`) REFERENCES `tbl_nivel_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (27,'JoÃ¢o Cabral','(15) 0456-0464','(68) 46840-6468','joao@padoka.com.br','M','joao','123',1,2),(30,'Arthur Ferreira','(01) 1477-56982','011 97512-1268','araeta@padoka.com.br','M','arthur','123',1,3),(31,'Administrador','(11) 1111-1111','(11) 11111-1111','admin@padoka.com.br','M','admin','inf127',1,1);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-18 15:33:54
