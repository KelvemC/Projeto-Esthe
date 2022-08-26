-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.33 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para agencia_esthe
CREATE DATABASE IF NOT EXISTS `agencia_esthe` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `agencia_esthe`;

-- Copiando estrutura para tabela agencia_esthe.agendamento
CREATE TABLE IF NOT EXISTS `agendamento` (
  `idagendamento` int(11) NOT NULL AUTO_INCREMENT,
  `horario` datetime NOT NULL,
  `servico` varchar(45) NOT NULL,
  `finalizacaoservico` datetime DEFAULT NULL,
  `cancelamento` enum('0','1') DEFAULT NULL,
  `observacao` varchar(220) DEFAULT NULL,
  `usuario_id` int(11) NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  PRIMARY KEY (`idagendamento`,`usuario_id`,`estabelecimento_id`),
  KEY `fk_agendamento_usuario1` (`usuario_id`),
  KEY `fk_agendamento_estabelecimento1` (`estabelecimento_id`),
  CONSTRAINT `fk_agendamento_estabelecimento1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_agendamento_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela agencia_esthe.estabelecimento
CREATE TABLE IF NOT EXISTS `estabelecimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `servico` varchar(45) NOT NULL,
  `rua` varchar(45) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `cep` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(300) NOT NULL,
  `recuperar_senha` varchar(220) DEFAULT NULL,
  `ativo` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela agencia_esthe.profissionais
CREATE TABLE IF NOT EXISTS `profissionais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(300) NOT NULL,
  `recuperar_senha` varchar(220) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `servico` varchar(45) NOT NULL,
  `ativo` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela agencia_esthe.servico
CREATE TABLE IF NOT EXISTS `servico` (
  `id` int(11) NOT NULL,
  `servicodescricao` varchar(45) NOT NULL,
  `ativo` enum('0','1') NOT NULL,
  `estabelecimento_id` int(11) NOT NULL,
  `profissionais_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`estabelecimento_id`,`profissionais_id`),
  KEY `estabelecimento_id` (`estabelecimento_id`),
  KEY `fk_SERVICO_profissionais1` (`profissionais_id`),
  CONSTRAINT `fk_SERVICO_profissionais1` FOREIGN KEY (`profissionais_id`) REFERENCES `profissionais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`estabelecimento_id`) REFERENCES `estabelecimento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela agencia_esthe.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `recuperar_senha` varchar(220) DEFAULT NULL,
  `telefone` varchar(45) NOT NULL,
  `endereco` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `ativo` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
