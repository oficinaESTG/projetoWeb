-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03-Nov-2020 às 19:47
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
-- Estrutura da tabela `carro`
--

DROP TABLE IF EXISTS `carro`;
CREATE TABLE IF NOT EXISTS `carro` (
  `idCarro` int(11) NOT NULL,
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
  `idMarcacoes` int(11) NOT NULL,
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
-- Estrutura da tabela `peca`
--

DROP TABLE IF EXISTS `peca`;
CREATE TABLE IF NOT EXISTS `peca` (
  `idPeca` int(11) NOT NULL,
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
-- Estrutura da tabela `venda`
--

DROP TABLE IF EXISTS `venda`;
CREATE TABLE IF NOT EXISTS `venda` (
  `idVenda` int(11) NOT NULL,
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
