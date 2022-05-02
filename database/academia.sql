-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 03-Maio-2022 às 01:31
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `academia`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 NOT NULL,
  `sobrenome` varchar(80) CHARACTER SET utf8 NOT NULL,
  `dataDeNascimento` date NOT NULL,
  `cpf` varchar(14) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `telefone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `modalidade` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `sobrenome`, `dataDeNascimento`, `cpf`, `email`, `telefone`, `modalidade`) VALUES
(4, 'Jonas', 'Kanwald', '2003-03-31', '123.456.789-31', 'jonas@teste.com', '31999887777', 'NataÃ§Ã£o'),
(11, 'Martha', 'Nielsen', '2003-11-13', '123.456.789-31', 'martha@email.com', '21932120000', 'MusculaÃ§Ã£o'),
(17, 'Regina', 'Tiedmann', '1982-12-12', '695.511.860-95', 'regina@mail.com', '32132123112', 'Spinning'),
(18, 'Noah', 'Nielsen', '1980-03-11', '123.456.789-31', 'noah@mail.com', '51982475148', 'Muay Thai'),
(19, 'Maria', 'Silva', '2002-02-22', '080.004.500-97', 'teste@tes.com', '21234324223', 'Spinning'),
(20, 'JosÃ©', 'da Silva', '2001-12-12', '659.175.926-32', 'fulano@teste.com', '21234324223', 'MusculaÃ§Ã£o'),
(21, 'JosÃ©', 'Souza', '1991-02-11', '224.047.680-00', 'teste2@teste.com', '21932120000', 'Muay Thai');

-- --------------------------------------------------------

--
-- Estrutura da tabela `financeiro`
--

CREATE TABLE `financeiro` (
  `id` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `valor` decimal(7,2) NOT NULL,
  `forma` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `financeiro`
--

INSERT INTO `financeiro` (`id`, `tipo`, `usuario`, `valor`, `forma`) VALUES
(1, 'Mensalidade', 'Jonas', '100.00', ''),
(9, 'Pagamento', 'Gerente', '120.00', 'Dinheiro'),
(10, 'Pagamento', 'Gerente', '120.00', 'Dinheiro'),
(11, 'SalÃ¡rio', 'Gerente', '1800.00', 'Dinheiro');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidades`
--

CREATE TABLE `modalidades` (
  `id` int(11) NOT NULL,
  `modalidade` varchar(80) CHARACTER SET utf8 NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `cargaHoraria` int(11) NOT NULL,
  `professor` varchar(80) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `modalidades`
--

INSERT INTO `modalidades` (`id`, `modalidade`, `preco`, `cargaHoraria`, `professor`) VALUES
(1, 'Spinning', '150.00', 2, 'Joana Oliveira'),
(2, 'MusculaÃ§Ã£o', '100.00', 1, 'Fernando Fernandes'),
(3, 'Muay Thai', '150.90', 2, 'Thiago Silveira'),
(4, 'NataÃ§Ã£o', '180.90', 1, 'NathÃ¡lia Reis');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) CHARACTER SET utf8 NOT NULL,
  `sobrenome` varchar(80) CHARACTER SET utf8 NOT NULL,
  `dataDeNascimento` date NOT NULL,
  `cpf` varchar(14) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `telefone` varchar(20) CHARACTER SET utf8 NOT NULL,
  `modalidade` varchar(30) CHARACTER SET utf8 NOT NULL,
  `salario` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`id`, `nome`, `sobrenome`, `dataDeNascimento`, `cpf`, `email`, `telefone`, `modalidade`, `salario`) VALUES
(1, 'Joao', 'Souza', '1991-03-22', '111.111.111-11', 'joao@mail.com', '21983423655', 'Muay Thai', '1600.00'),
(2, 'Maria', 'Silva', '1997-02-11', '111.111.111-12', 'silva@teste.com', '21932120000', 'Musculacao', '1450.40'),
(4, 'Thiago', 'Silveira', '2001-11-11', '123.456.789-31', 'thiago@email.com', '21932120033', 'Muay Thai', '1000.00'),
(5, 'NathÃ¡lia', 'Reis', '2003-11-11', '111.111.111-11', 'nat@mail.com', '21932120000', 'NataÃ§Ã£o', '1500.00'),
(6, 'Fernando', 'Fernandes', '1989-12-11', '213.345.432-67', 'fernando@email.com.br', '21932120077', 'MusculaÃ§Ã£o', '3000.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) CHARACTER SET utf8 NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'teste', 'teste@email.com.br', 'Pass123!');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `financeiro`
--
ALTER TABLE `financeiro`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modalidades`
--
ALTER TABLE `modalidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `financeiro`
--
ALTER TABLE `financeiro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `modalidades`
--
ALTER TABLE `modalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
