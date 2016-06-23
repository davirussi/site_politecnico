-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Nov 08, 2011 as 09:27 
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
-- Estrutura da tabela `ru`
--

CREATE TABLE IF NOT EXISTS `ru` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(15) NOT NULL,
  `conteudo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=332 ;

--
-- Extraindo dados da tabela `ru`
--

INSERT INTO `ru` (`id`, `data`, `conteudo`) VALUES
(236, '10/31/11', 'Strogonoff'),
(237, '11/01/11', 'Frango ao Curry'),
(238, 'FERIADO', ''),
(239, '11/03/11', 'Empanado de Frango ao Molho'),
(240, '11/04/11', 'Bife com Molho Branco'),
(241, '11/05/11', 'Carne Assada'),
(242, '10/31/11', ''),
(243, '11/01/11', ''),
(244, 'FERIADO', ''),
(245, '11/03/11', ''),
(246, '11/04/11', ''),
(247, '11/05/11', ''),
(248, '10/31/11', 'Cenoura Repolho Branco com Passas de Uva'),
(249, '11/01/11', 'Repolho Roxo Alface'),
(250, 'FERIADO', ' '),
(251, '11/03/11', 'Brócoli Cenoura'),
(252, '11/04/11', 'Pepino Tomate'),
(253, '11/05/11', 'Salada Caprichada '),
(254, '10/31/11', 'Batata Palha'),
(255, '11/01/11', 'Purê de Batatas'),
(256, 'FERIADO', ''),
(257, '11/03/11', 'Polenta Recheada'),
(258, '11/04/11', 'Pão Doce'),
(259, '11/05/11', 'Couve Refogada com Farinha de Mandioca'),
(260, '10/31/11', 'Arroz Branco Arroz Integral'),
(261, '11/01/11', 'Arroz Branco Arroz Integral'),
(262, 'FERIADO', ' '),
(263, '11/03/11', 'Arroz Branco Arroz Integral'),
(264, '11/04/11', 'Arroz Colorido Arroz Integral'),
(265, '11/05/11', 'Arroz Branco '),
(266, '10/31/11', 'Feijão preto'),
(267, '11/01/11', 'Feijão de Cor'),
(268, 'FERIADO', ''),
(269, '11/03/11', 'Feijão Preto'),
(270, '11/04/11', 'Lentilha'),
(271, '11/05/11', 'Feijão Preto'),
(272, '10/31/11', 'Suco de Limão'),
(273, '11/01/11', 'Suco de Laranja'),
(274, 'FERIADO', ''),
(275, '11/03/11', 'Suco de Uva'),
(276, '11/04/11', 'Suco de Tangerina'),
(277, '11/05/11', 'Suco de Laranja'),
(278, '10/31/11', 'Mariola'),
(279, '11/01/11', 'Torrone'),
(280, 'FERIADO', ''),
(281, '11/03/11', 'Mandolate'),
(282, '11/04/11', 'Paçoquinha'),
(283, '11/05/11', 'Abacaxi'),
(284, '11/07/11', 'Carne de Panela'),
(285, '11/08/11', 'Peixe Frito/Ensopado'),
(286, '11/09/11', 'Quiabada'),
(287, '11/10/11', 'Frango Xadrez'),
(288, '11/11/11', 'Bife Acebolado'),
(289, '11/12/11', 'Cubos Suíno'),
(290, '11/07/11', ''),
(291, '11/08/11', ''),
(292, '11/09/11', ''),
(293, '11/10/11', ''),
(294, '11/11/11', ''),
(295, '11/12/11', ''),
(296, '11/07/11', 'Cenoura Abobrinha'),
(297, '11/08/11', 'Repolho Roxo Tomate'),
(298, '11/09/11', 'Tomate Couve-manteiga'),
(299, '11/10/11', 'Alface Beterraba'),
(300, '11/11/11', 'Chuchu Cenoura'),
(301, '11/12/11', 'Couve-chinesa Tomate'),
(302, '11/07/11', 'Pão Doce'),
(303, '11/08/11', 'Batata Souté'),
(304, '11/09/11', 'Farofa'),
(305, '11/10/11', 'Batata Palha'),
(306, '11/11/11', 'Polenta Recheada'),
(307, '11/12/11', 'Jardineira de Legumes'),
(308, '11/07/11', 'Arroz com Curry Arroz Integral'),
(309, '11/08/11', 'Arroz Branco Arroz Integral'),
(310, '11/09/11', 'Arroz Branco Arroz Integral'),
(311, '11/10/11', 'Arroz Branco Arroz Integral'),
(312, '11/11/11', 'Arroz Branco Arroz Integral'),
(313, '11/12/11', 'Arroz Branco '),
(314, '11/07/11', 'Feijão de Cor'),
(315, '11/08/11', 'Feijão Preto'),
(316, '11/09/11', 'Feijoada'),
(317, '11/10/11', 'Feijão Preto'),
(318, '11/11/11', 'Lentilha'),
(319, '11/12/11', 'Feijão Preto'),
(320, '11/07/11', 'Suco de Laranja'),
(321, '11/08/11', 'Suco de Abacaxi'),
(322, '11/09/11', 'Suco de Limão'),
(323, '11/10/11', 'Suco de Uva'),
(324, '11/11/11', 'Suco de Tangerina'),
(325, '11/12/11', 'Suco de Laranja'),
(326, '11/07/11', 'Pudim'),
(327, '11/08/11', 'Laranja'),
(328, '11/09/11', 'Angu'),
(329, '11/10/11', 'Paçoquinha'),
(330, '11/11/11', 'Mariola'),
(331, '11/12/11', 'Mandolate');
