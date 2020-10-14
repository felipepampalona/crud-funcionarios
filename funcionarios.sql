-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Out-2020 às 21:48
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `funcionarios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `cargo` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `foto` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `nome`, `email`, `data_nascimento`, `cpf`, `rg`, `cargo`, `status`, `foto`, `created`) VALUES
(26, 'Luiz felipe de oliveira braga', 'felipepampalona@gmail.com', '1997-09-17', '043.886.471-95', '3.365.312', 'Programador PHP', 1, 'geraimg.jpg', '2020-10-14 18:50:52'),
(27, 'Marcos de oliveira braga', 'Marcospampalona@gmail.com', '1997-09-17', '043.886.521-99', '1532115', 'Programador', 1, 'geraimg.jpg', '2020-10-14 21:11:25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone_funcionarios`
--

CREATE TABLE `telefone_funcionarios` (
  `id` int(11) NOT NULL,
  `funcionario_id` int(11) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `telefone_funcionarios`
--

INSERT INTO `telefone_funcionarios` (`id`, `funcionario_id`, `telefone`) VALUES
(4, 26, '(61)9 8623-9197'),
(10, 27, '(61)9 8623-9197'),
(11, 27, '(61)9 5526-4644');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `telefone_funcionarios`
--
ALTER TABLE `telefone_funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_telefone_funcionarios_funcionario_idx` (`funcionario_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `telefone_funcionarios`
--
ALTER TABLE `telefone_funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `telefone_funcionarios`
--
ALTER TABLE `telefone_funcionarios`
  ADD CONSTRAINT `fk_telefone_funcionarios_funcionario` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
