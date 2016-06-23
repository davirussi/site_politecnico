-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Nov 11, 2011 as 11:27 
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `davi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `xml_base`
--

CREATE TABLE IF NOT EXISTS `xml_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `xml_base`
--

INSERT INTO `xml_base` (`id`, `nome`) VALUES
(3, 'http://feeds.feedburner.com/gizmodobr'),
(1, 'http://www.clubedohardware.com.br/rss_noticias.xml'),
(4, 'http://www.infowester.com/newsiw.xml');
