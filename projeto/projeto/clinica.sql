-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04-Jul-2023 às 17:53
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id_arq` int(11) NOT NULL,
  `nome_arq` varchar(30) NOT NULL,
  `url_arq` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `arquivos`
--

INSERT INTO `arquivos` (`id_arq`, `nome_arq`, `url_arq`) VALUES
(5, 'teste', 'arquivos/08d145036b6468b91e7767784cb209b0.pdf');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id_cad` int(11) NOT NULL,
  `nome_cad` varchar(30) NOT NULL,
  `user_cad` varchar(50) NOT NULL,
  `senha_cad` varchar(40) NOT NULL,
  `adm_cad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id_cad`, `nome_cad`, `user_cad`, `senha_cad`, `adm_cad`) VALUES
(9, 'ruan', 'ruansidre', 'e10adc3949ba59abbe56e057f20f883e', 1),
(10, 'thor', 'thor', 'e10adc3949ba59abbe56e057f20f883e', 2),
(11, 'ruan', 'ruan', 'e10adc3949ba59abbe56e057f20f883e', 1),
(12, 'bernardo', 'bernardo', 'e10adc3949ba59abbe56e057f20f883e', 2),
(13, 'igor', 'igor', 'e10adc3949ba59abbe56e057f20f883e', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `formulario`
--

CREATE TABLE `formulario` (
  `id_form` int(11) NOT NULL,
  `nome_form` varchar(30) NOT NULL,
  `contato_form` int(9) NOT NULL,
  `resp_form` int(9) NOT NULL,
  `genero_form` varchar(10) NOT NULL,
  `data_form` varchar(11) NOT NULL,
  `endereco_form` varchar(100) NOT NULL,
  `med_form` varchar(11) NOT NULL,
  `doenca_form` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `formulario`
--

INSERT INTO `formulario` (`id_form`, `nome_form`, `contato_form`, `resp_form`, `genero_form`, `data_form`, `endereco_form`, `med_form`, `doenca_form`) VALUES
(1, 'ruan', 999999999, 999999999, 'masculino', '10/10/1999', 'rua araci fernandes', '0', 'nao'),
(3, 'ruan', 999999999, 999999999, 'masculino', '10/10/1999', 'rua araci fernandes', 'nao', 'nao'),
(4, 'ruan', 999999999, 999999999, 'masculino', '10/10/1999', 'rua araci fernandes', 'nao', 'nao'),
(8, 'ruan', 999999999, 999999999, 'masculino', '2023-06-14', 'rua araci fernandes', 'nao', 'nao'),
(11, 'bernardo', 999999999, 999999999, 'masculino', '10/10/1999', 'rua araci fernandes', 'nao', 'nao'),
(12, 'igor', 999999999, 999999999, 'masculino', '10/10/1999', 'rua araci fernandes', 'sim', 'sim');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id_arq`);

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id_cad`);

--
-- Índices para tabela `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`id_form`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id_arq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id_cad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `formulario`
--
ALTER TABLE `formulario`
  MODIFY `id_form` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
