-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Mar-2021 às 01:43
-- Versão do servidor: 10.4.16-MariaDB
-- versão do PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fs5`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `account`
--

CREATE TABLE `account` (
  `accountid` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `accountnumber` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `account`
--

INSERT INTO `account` (`accountid`, `name`, `balance`, `accountnumber`, `description`) VALUES
(11, 'PICPAY', '430.00', '', 'ESCREVA ALGO AQUI'),
(12, 'CAIXA ECONOMICA FEDERAL', '950.00', NULL, 'ESCREVA ALGO AQUI'),
(13, 'BANCO DO BRASIL', '1250.00', NULL, 'ESCREVA ALGO AQUI'),
(14, 'ITAU', '2500.00', NULL, 'ESCREVA ALGO AQUI'),
(15, 'PAGSEGURO', '3725.00', NULL, 'ESCREVA ALGO AQUI'),
(16, 'PAYPAL', '1450.00', NULL, 'ESCREVA ALGO AQUI'),
(17, 'BOLETO', '0.00', NULL, 'ESCREVA ALGO AQUI'),
(18, 'MERCADO PAGO', '952.00', NULL, 'ESCREVA ALGO AQUI'),
(19, 'OUTRA CONTA', '2500.00', '', 'ESCREVA ALGO AQUI');

-- --------------------------------------------------------

--
-- Estrutura da tabela `budget`
--

CREATE TABLE `budget` (
  `budgetid` int(5) NOT NULL,
  `userid` int(5) NOT NULL,
  `categoryid` int(5) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `budget`
--

INSERT INTO `budget` (`budgetid`, `userid`, `categoryid`, `amount`, `fromdate`, `todate`, `description`) VALUES
(1, 1, 41, '5000.00', '2021-03-30', NULL, NULL),
(2, 1, 43, '2000.00', '2021-03-30', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `category`
--

CREATE TABLE `category` (
  `categoryid` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `type` int(11) NOT NULL,
  `color` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `category`
--

INSERT INTO `category` (`categoryid`, `name`, `description`, `type`, `color`) VALUES
(4, 'Loja - Pedidos', 'Pedidos realizados no site \nLojadeSkins.com.br', 1, '#48D1CC'),
(5, 'Loja - Encomendas', 'Encomendas realizadas no chat da loja, pagina do facebook ou whatsapp', 1, '#DA9351'),
(6, 'Loja - OUTROS', 'Upgrades realizados no chat da loja, pagina do facebook ou whatsapp', 1, '#4794FF'),
(7, 'Loja - Compras de Estoque', 'Compra de itens de CSGO ou de DOTA2', 2, '#FF4A4A'),
(8, 'Loja - Pagamento Funcionarios', 'Retirada mensal realizada para toda a equipe.', 2, '#FCFF47'),
(9, 'Loja de Skins - Custos da loja', 'Servidor, Design, Outros', 2, '#CCA8FF');

-- --------------------------------------------------------

--
-- Estrutura da tabela `goals`
--

CREATE TABLE `goals` (
  `goalsid` int(5) NOT NULL,
  `userid` int(5) NOT NULL,
  `accountid` int(5) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `deposit` decimal(10,2) NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `goals`
--

INSERT INTO `goals` (`goalsid`, `userid`, `accountid`, `name`, `balance`, `amount`, `deposit`, `deadline`) VALUES
(1, 1, NULL, 'COMPRAR X EQUIPAMENTO', '450.00', '3500.00', '4500.00', '2021-03-31');

-- --------------------------------------------------------

--
-- Estrutura da tabela `role`
--

CREATE TABLE `role` (
  `roleid` int(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `role`
--

INSERT INTO `role` (`roleid`, `name`) VALUES
(2, 'Transações'),
(3, 'Entradas'),
(4, 'Saídas'),
(5, 'Contas'),
(6, 'Orçamento'),
(7, 'Definir metas'),
(8, 'Calendário'),
(9, 'Categoria de Entradas'),
(10, 'Categoria de Saídas'),
(11, 'Relatórios de entradas'),
(12, 'Categoria de Saídas'),
(13, 'Relatório de entradas VS saídas'),
(14, 'Relatório mensal de entradas'),
(15, 'Relatório mensal de saídas'),
(16, 'Relatórios de transações de conta'),
(17, 'Função do usuário'),
(18, 'Configuração de Aplicação'),
(19, 'Upcoming Income'),
(20, 'Upcoming Expense');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roleaccess`
--

CREATE TABLE `roleaccess` (
  `roleaccessid` int(5) NOT NULL,
  `roleid` int(5) NOT NULL,
  `userid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `roleaccess`
--

INSERT INTO `roleaccess` (`roleaccessid`, `roleid`, `userid`) VALUES
(18, 2, 1),
(19, 3, 1),
(20, 4, 1),
(21, 5, 1),
(22, 6, 1),
(23, 7, 1),
(24, 8, 1),
(25, 9, 1),
(26, 10, 1),
(27, 11, 1),
(28, 12, 1),
(29, 13, 1),
(30, 14, 1),
(31, 15, 1),
(32, 16, 1),
(33, 17, 1),
(34, 18, 1),
(35, 19, 1),
(36, 20, 1),
(39, 3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE `settings` (
  `settingsid` int(11) NOT NULL,
  `company` varchar(255) NOT NULL,
  `city` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `logo` text NOT NULL,
  `currency` varchar(5) NOT NULL,
  `languages` varchar(10) NOT NULL,
  `dateformat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`settingsid`, `company`, `city`, `address`, `website`, `phone`, `logo`, `currency`, `languages`, `dateformat`) VALUES
(1, 'Minha Empresa aqui', 'CIDADE', 'ENDEREÇO', 'Meu Site Aqui', 'TELEFONE', 'test.png', 'R$', 'en', 'd/m/Y');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategoryid` int(11) NOT NULL,
  `categoryid` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `subcategory`
--

INSERT INTO `subcategory` (`subcategoryid`, `categoryid`, `name`, `type`, `description`) VALUES
(34, 4, 'PRODUTO X', 1, 'Skins de Dota 2'),
(35, 4, 'PRODUTO Y', 1, 'Skins de Counter-Strike: Global Offensive'),
(36, 5, 'Encomenda - LOJA FISICA', 1, 'Encomenda feita pelo WhatsApp'),
(37, 5, 'Encomenda - LOJA VIRTUAL', 1, 'Encomenda feita pelo Facebook/Chat da loja'),
(38, 6, 'OUTRO X', 1, 'Upgrade feito pelo Facebook/Chat da loja'),
(39, 6, 'OUTRO Y', 1, 'Upgrade feito pelo WhatsApp'),
(40, 7, 'PRODUTO X', 2, 'Skins de Counter-Strike: Global Offensive'),
(41, 7, 'PRODUTO Y', 2, 'Skins de Dota 2'),
(42, 8, 'RETIRADA FUNCIONARIO', 2, 'RETIRADA FUNCIONARIO'),
(43, 8, 'PRO LABORE', 2, 'RETIRADA SOCIOS'),
(47, 9, 'CUSTOS DA LOJA', 2, 'CUSTOS X,Y,Z'),
(48, 9, 'OUTROS CUSTOS', 2, 'Outros custos da loja.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `transaction`
--

CREATE TABLE `transaction` (
  `transactionid` int(5) NOT NULL,
  `userid` int(5) NOT NULL,
  `categoryid` int(5) NOT NULL,
  `accountid` int(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `transactiondate` date NOT NULL,
  `type` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `file` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `transaction`
--

INSERT INTO `transaction` (`transactionid`, `userid`, `categoryid`, `accountid`, `name`, `amount`, `reference`, `transactiondate`, `type`, `description`, `file`) VALUES
(1, 1, 34, 12, 'CARLOS', '49.50', '\"escreva alguma coisa\"', '2021-02-01', 1, 'outra caixa para anotações sobre a entrada.', ''),
(2, 1, 40, 13, 'BRUNO', '129.90', '\"escreva alguma coisa\"', '2021-02-01', 2, 'outra caixa para anotações sobre a entrada.', ''),
(3, 1, 35, 14, 'MARCOS', '349.50', '\"escreva alguma coisa\"', '2021-02-03', 1, 'outra caixa para anotações sobre a entrada.', ''),
(4, 1, 42, 14, 'LUCHO', '89.90', '\"escreva alguma coisa\"', '2021-01-01', 2, 'outra caixa para anotações sobre a entrada.', NULL),
(5, 1, 40, 12, 'MARIO CART', '32.90', '\"escreva alguma coisa\"', '2021-01-01', 2, 'outra caixa para anotações sobre a entrada.', NULL),
(6, 1, 47, 16, 'JUNKU', '85.90', '\"escreva alguma coisa\"', '2021-01-01', 2, 'outra caixa para anotações sobre a entrada.', ''),
(7, 1, 48, 17, 'MARCEL', '79.90', '\"escreva alguma coisa\"', '2021-01-01', 2, 'outra caixa para anotações sobre a entrada.', ''),
(8, 1, 43, 18, 'CAMPES', '47.90', '\"escreva alguma coisa\"', '2021-01-01', 2, 'outra caixa para anotações sobre a entrada.', ''),
(9, 1, 36, 13, 'PACENHO', '119.50', '\"escreva alguma coisa\"', '2021-01-03', 1, 'outra caixa para anotações sobre a entrada.', ''),
(10, 1, 37, 15, 'MARINO', '129.50', '\"escreva alguma coisa\"', '2021-01-03', 1, 'outra caixa para anotações sobre a entrada.', ''),
(11, 1, 38, 19, 'LUCAS', '144.50', '\"escreva alguma coisa\"', '2021-01-03', 1, 'outra caixa para anotações sobre a entrada.', ''),
(12, 1, 39, 18, 'JOU', '109.50', '\"escreva alguma coisa\"', '2021-01-03', 1, 'outra caixa para anotações sobre a entrada.', ''),
(13, 1, 35, 17, 'Mariana', '525.50', 'pedido na loja', '2021-01-04', 1, 'compra do produto y', NULL),
(14, 1, 42, 14, 'Beto', '1750.00', 'salario', '2021-01-05', 2, 'Salário funcionário', NULL),
(15, 1, 40, 17, 'estoque', '192.00', 'compra de produto para estoque', '2021-01-05', 2, 'produto A', NULL),
(16, 1, 35, 18, 'SERGIOS', '765.00', 'Alguma coisa', '2021-03-15', 1, '', NULL),
(18, 1, 36, 16, 'JOAOS II', '678.00', '\"escreva alguma coisa\"', '2021-03-15', 1, NULL, NULL),
(19, 1, 47, 11, 'Rodrigo', '145.00', 'Internet', '2021-03-14', 2, NULL, NULL),
(20, 1, 48, 13, 'Omar', '100.00', 'Água', '2021-03-16', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`userid`, `email`, `name`, `password`, `role`, `phone`, `status`, `remember_token`, `updated_at`, `created_at`) VALUES
(1, 'contato@contato.com', 'ConnectSkins', '$2y$10$W6T4gKJMEcDX3QmB0PSwlOMxF6/qBEZwuERxOQE52MBGS1MPMZpxe', 'Administrator', 'TELEFONE', 'Active', 'FKMfPJ934w9v6b3YBQPw8Jh2eduff3LLTRM7bMst9lZHA7z0VaJv2fCRbvPq', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'usuarioteste@teste.com', 'usuarioTeste', '$2y$10$LDbcou1NgLZ.MpO.xYdWxe9DOCy.W5IBjFuCOyESMuRFfjzEyJZXK', 'Staff', '11900600300', 'Active', 'roaoWS3w4n3otAj7dcFBThaM4qcRnWJ6ApfU7ppvKVtjDhVOLu3kKWltuTM5', '2019-06-14 03:00:38', '2019-06-14 03:00:38');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`accountid`);

--
-- Índices para tabela `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`budgetid`);

--
-- Índices para tabela `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryid`);

--
-- Índices para tabela `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`goalsid`);

--
-- Índices para tabela `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleid`);

--
-- Índices para tabela `roleaccess`
--
ALTER TABLE `roleaccess`
  ADD PRIMARY KEY (`roleaccessid`),
  ADD KEY `deleteroleaccess` (`userid`);

--
-- Índices para tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settingsid`);

--
-- Índices para tabela `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategoryid`),
  ADD KEY `deletesubquery` (`categoryid`);

--
-- Índices para tabela `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionid`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `account`
--
ALTER TABLE `account`
  MODIFY `accountid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `budget`
--
ALTER TABLE `budget`
  MODIFY `budgetid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `category`
--
ALTER TABLE `category`
  MODIFY `categoryid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `goals`
--
ALTER TABLE `goals`
  MODIFY `goalsid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `roleaccess`
--
ALTER TABLE `roleaccess`
  MODIFY `roleaccessid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `settingsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de tabela `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `roleaccess`
--
ALTER TABLE `roleaccess`
  ADD CONSTRAINT `deleteroleaccess` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `deletesubquery` FOREIGN KEY (`categoryid`) REFERENCES `category` (`categoryid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
