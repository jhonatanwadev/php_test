-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jun-2021 às 06:04
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `busca_endereco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `check_cep`
--

CREATE TABLE `check_cep` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `cep` varchar(11) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) NOT NULL,
  `localidade` varchar(255) NOT NULL,
  `uf` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `check_cep`
--

INSERT INTO `check_cep` (`id`, `status`, `created_at`, `updated_at`, `cep`, `logradouro`, `complemento`, `bairro`, `localidade`, `uf`) VALUES
(1, 1, '2021-06-04 22:27:16', '2021-06-04 22:27:16', '05755150', 'Rua Lagoa Branca', NULL, 'Jardim Umarizal', 'São Paulo', 'SP'),
(2, 1, '2021-06-07 00:50:26', '2021-06-07 00:50:26', '03625140', 'Rua Porto das Flores', NULL, 'Vila Costa Melo', 'São Paulo', 'SP'),
(3, 1, '2021-06-07 00:52:29', '2021-06-07 00:52:29', '05663010', 'Rua Herbert Spencer', NULL, 'Paraisópolis', 'São Paulo', 'SP'),
(4, 1, '2021-06-07 00:57:48', '2021-06-07 00:57:48', '02307100', 'Via de Pedestre Jasmin Azul', NULL, 'Tucuruvi', 'São Paulo', 'SP'),
(5, 1, '2021-06-07 00:59:28', '2021-06-07 00:59:28', '05439100', 'Rua Américo dos Santos', NULL, 'Jardim das Bandeiras', 'São Paulo', 'SP'),
(6, 1, '2021-06-07 01:01:51', '2021-06-07 01:01:51', '08430865', 'Travessa Deva', NULL, 'Jardim Moreno', 'São Paulo', 'SP');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `check_cep`
--
ALTER TABLE `check_cep`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `check_cep`
--
ALTER TABLE `check_cep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
