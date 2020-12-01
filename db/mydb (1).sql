-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03-Nov-2020 às 21:17
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mydb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carro`
--

DROP TABLE IF EXISTS `carro`;
CREATE TABLE IF NOT EXISTS `carro` (
  `idCarro` int(11) NOT NULL AUTO_INCREMENT,
  `modeloCarro` varchar(45) NOT NULL,
  `marcaCarro` varchar(45) NOT NULL,
  `ano` int(4) NOT NULL,
  `matricula` varchar(45) DEFAULT NULL,
  `tipoCarro` enum('Reparacao','Venda') NOT NULL,
  `fk_idPessoa` int(255) NOT NULL,
  PRIMARY KEY (`idCarro`),
  KEY `fk_idPessoa` (`fk_idPessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcacao`
--

DROP TABLE IF EXISTS `marcacao`;
CREATE TABLE IF NOT EXISTS `marcacao` (
  `idMarcacoes` int(11) NOT NULL AUTO_INCREMENT,
  `tipoMarcacao` enum('Reparacao','Venda') NOT NULL,
  `dataMarcacao` date NOT NULL,
  `descricaoMarcacao` varchar(255) NOT NULL,
  `estadoMarcacao` enum('Aceite','Rejeitada','Concluida','Espera') NOT NULL,
  `fk_idPessoa` int(255) NOT NULL,
  PRIMARY KEY (`idMarcacoes`),
  KEY `fk_idPessoa_marcacao` (`fk_idPessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcacao_haspecas`
--

DROP TABLE IF EXISTS `marcacao_haspecas`;
CREATE TABLE IF NOT EXISTS `marcacao_haspecas` (
  `idMarcacao_hasPecas` int(255) NOT NULL AUTO_INCREMENT,
  `fk_idPeca` int(255) NOT NULL,
  `fk_idMarcacao` int(255) NOT NULL,
  `quantidadeParaMarcacao` int(255) NOT NULL,
  PRIMARY KEY (`idMarcacao_hasPecas`),
  KEY `fk_IdMarcacao` (`fk_idMarcacao`),
  KEY `fk_idPeca` (`fk_idPeca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1604436693),
('m130524_201442_init', 1604436697),
('m190124_110200_add_verification_token_column_to_user_table', 1604436698),
('m140506_102106_rbac_init', 1604436777),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1604436777),
('m180523_151638_rbac_updates_indexes_without_prefix', 1604436778),
('m200409_110543_rbac_update_mssql_trigger', 1604436778);

-- --------------------------------------------------------

--
-- Estrutura da tabela `peca`
--

DROP TABLE IF EXISTS `peca`;
CREATE TABLE IF NOT EXISTS `peca` (
  `idPeca` int(11) NOT NULL AUTO_INCREMENT,
  `nomePeca` varchar(45) NOT NULL,
  `quantidadePeca` varchar(45) NOT NULL,
  `precoPeca` varchar(45) NOT NULL,
  PRIMARY KEY (`idPeca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

DROP TABLE IF EXISTS `pessoa`;
CREATE TABLE IF NOT EXISTS `pessoa` (
  `idPessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `dataNascimento` date NOT NULL,
  `morada` varchar(255) NOT NULL,
  `nif` int(9) NOT NULL,
  `tipoPessoa` enum('Mecanico','Secretaria','Cliente','Gestor') NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`idPessoa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

DROP TABLE IF EXISTS `venda`;
CREATE TABLE IF NOT EXISTS `venda` (
  `idVenda` int(11) NOT NULL AUTO_INCREMENT,
  `quantiaVenda` int(20) NOT NULL,
  `dataVenda` date NOT NULL,
  `descricaoVenda` varchar(255) DEFAULT NULL,
  `fk_idCarro` int(255) NOT NULL,
  PRIMARY KEY (`idVenda`),
  KEY `fk_idCarro` (`fk_idCarro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `carro`
--
ALTER TABLE `carro`
  ADD CONSTRAINT `fk_idPessoa` FOREIGN KEY (`fk_idPessoa`) REFERENCES `pessoa` (`idPessoa`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `marcacao`
--
ALTER TABLE `marcacao`
  ADD CONSTRAINT `fk_idPessoa_marcacao` FOREIGN KEY (`fk_idPessoa`) REFERENCES `pessoa` (`idPessoa`);

--
-- Limitadores para a tabela `marcacao_haspecas`
--
ALTER TABLE `marcacao_haspecas`
  ADD CONSTRAINT `fk_IdMarcacao` FOREIGN KEY (`fk_idMarcacao`) REFERENCES `marcacao` (`idMarcacoes`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_idPeca` FOREIGN KEY (`fk_idPeca`) REFERENCES `peca` (`idPeca`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_idCarro` FOREIGN KEY (`fk_idCarro`) REFERENCES `carro` (`idCarro`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;