-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/05/2024 às 14:57
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sysmac`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(220) NOT NULL,
  `usuario` varchar(220) NOT NULL,
  `senha_usuario` varchar(220) NOT NULL,
  `tipo` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha_usuario`, `tipo`) VALUES
(1, 'Inaldo Monteiro', 'inaldomonteiroti@gmail.com', '$2y$10$8xoakbT6Us76HnvBg3cjU.qypq0tpXc4voiOwa.w1ATyP1CJ969aW', 'administrador'),
(2, 'Dores', 'dores@gmail.com', '$2y$10$x/obRivyk0U7beLt3mDFMuQiXk3UPLHQR37sPnm//7bwY7hFZAyHS', 'administrador'),
(4, 'Dulce', 'dulce@gmail.com', '$2y$10$dI7GGY3.lpXRRftr1vhIQOVGlPTEbc.ReM5ad7VG.LtBlyQPw6HVG', 'vendedor'),
(5, 'Patricia', 'patricia@gmail.com', '$2y$10$JcXVjrRLI3kovqKkihB.wOxV7Tc1bcK0yf9dHNniTx0AGS2P9rkKm', 'vendedor'),
(6, 'Gabriel', 'gabriel@gmail.com', '$2y$10$abPFpuJh/Zk1/UdzHRG.NOKRqSxNQZxAOyWk2/1c23XKdCEkgkaOe', 'vendedor'),
(7, 'Yasmin', 'yasmin@gmail.com', '$2y$10$nNt0IDwKBw/FjG9bQiRJkuwlXcXo00Abq74NDF9/M3YcI2uI401Zi', 'vendedor'),
(12, 'Erika', 'erika@gmail.com', '$2y$10$HyXxR.xyWuCQSLjpwARF6.e0W1BpK3HsLHmiKa1xrmE3nSO4I767.', 'vendedor'),
(14, 'Dulce', 'dulce@gmail.com', '$2y$10$E4dndwOfXyqvJcsZT344nus5ZvTIXeePUjPcZS9yix6nNXMKc9yvm', 'vendedor'),
(17, 'GPM Soluções', 'gpm@gmail.com', '$2y$10$YqBwbvPeDBkW6UhbIwjKDuQsSWqWycVMl2grYJock3LRLuWziNF2S', 'administrador'),
(19, 'Hulk', 'hulk@gmail.com', '$2y$10$bx627/mEk193a81F0oj7PORp5GnPu5hmS/Ez1ozmins.cCA5o6Ok2', 'vendedor');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
