-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/11/2023 às 21:33
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `buster-buguer`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_administrador`
--

CREATE TABLE `tbl_administrador` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome_completo` varchar(100) NOT NULL,
  `nome_de_usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tbl_administrador`
--

INSERT INTO `tbl_administrador` (`id`, `nome_completo`, `nome_de_usuario`, `senha`) VALUES
(9, 'Jaqueline Nunes dos Santos', 'jaque', '202cb962ac59075b964b07152d234b70'),
(17, 'aline ferreira ', 'ali', '202cb962ac59075b964b07152d234b70'),
(18, 'aline ferreira', 'aline', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `nome_imagem` varchar(255) NOT NULL,
  `destacado` varchar(10) NOT NULL,
  `ativo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id`, `titulo`, `nome_imagem`, `destacado`, `ativo`) VALUES
(7, 'Hambúrgueres', 'Food_Category_510.png', 'Sim', 'Sim'),
(8, 'Bebidas', 'Food_Category_13.jpeg', 'No', 'Sim'),
(9, 'Sobremesas', 'Food_Category_402.png', 'No', 'Sim'),
(11, 'Combos', 'Food_categoria_571.jpeg', 'Sim', 'Sim'),
(13, 'Acompanhamentos', 'Food_Category_783.png', 'No', 'Sim'),
(14, 'Vegetariano e Vegano', 'Food_categoria_842.jpg', 'Sim', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_comida`
--

CREATE TABLE `tbl_comida` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descrição` text NOT NULL,
  `preço` decimal(10,2) NOT NULL,
  `nome_imagem` varchar(255) NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `destacado` varchar(10) NOT NULL,
  `ativo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tbl_comida`
--

INSERT INTO `tbl_comida` (`id`, `titulo`, `descrição`, `preço`, `nome_imagem`, `id_categoria`, `destacado`, `ativo`) VALUES
(31, 'Hambúrguer Clássico', 'Nosso clássico hambúrguer de carne com queijo, alface, tomate e molho especial', 18.00, 'Nome-Comida-7990.jpeg', 7, 'Não', 'Sim'),
(32, 'Cheeseburger', 'Um hambúrguer suculento com queijo derretido, cebola caramelizada', 20.00, 'Nome-Comida-2411.webp', 7, 'Não', 'Sim'),
(33, 'Hambúrguer de Frango Grelhado', 'Peito de frango grelhado servido com alface, tomate e maionese', 17.00, 'Nome-Comida-9419.jpg', 7, 'Não', 'Sim'),
(34, 'Hambúrguer de Peixe Crocante', 'Filete de peixe empanado servido com alface, queijo e molho tártaro', 21.00, 'Nome-Comida-2288.jpg', 7, 'Sim', 'Sim'),
(35, 'Hambúrguer Duplo com Bacon', 'Dois hambúrgueres, bacon crocante, queijo cheddar e molho barbecue', 23.00, 'Nome-Comida-5632.png', 7, 'Sim', 'Sim'),
(36, 'Hambúrguer de Cordeiro Gourmet', 'Hambúrguer de carne de cordeiro com hortelã e iogurte no pão de brioche', 26.00, 'Nome-Comida-8888.jpg', 7, 'Sim', 'Sim'),
(37, 'Hambúrguer de Feijão Preto Picante', 'Hambúrguer à base de feijão preto, pimenta jalapeño e molho de chipotle', 20.00, 'Nome-Comida-7180.jpg', 7, 'Não', 'Sim'),
(38, 'Hambúrguer de Frango com Abacaxi', 'Hambúrguer de frango grelhado com abacaxi, molho teriyaki e alface', 21.00, 'Nome-Comida-5805.jpg', 7, 'Não', 'Sim'),
(39, 'Hambúrguer de Cogumelos', 'Hambúrguer com cogumelos salteados, queijo suíço e molho trufado', 23.00, 'Nome-Comida-8572.webp', 7, 'Não', 'Sim'),
(40, 'Hambúrguer de Picanha', 'Nosso hambúrguer premium feito com carne de picanha suculenta, alface crocante, queijo gouda derretido e molho especial', 28.00, 'Nome-Comida-8100.jpeg', 7, 'Sim', 'Sim'),
(41, 'Coca-Cola em lata de 350ml', 'Refrigerante de cola em lata', 4.00, 'Food-Name-6200.jpeg', 8, '', ''),
(42, 'Pepsi em lata de 330ml', 'Refrigerante Pepsi em lata', 3.00, 'Food-Name-5368.jpeg', 8, 'Não', 'Sim'),
(43, 'Fanta em lata de 355ml', 'Refrigerante de laranja em lata', 4.00, 'Nome-Comida-1260.jpeg', 8, 'Não', 'Sim'),
(44, 'Guaraná Antártica em lata de 350ml', 'Refrigerante de guaraná em lata', 3.00, 'Nome-Comida-4270.png', 8, 'Sim', 'Sim'),
(45, 'Coca-Cola em garrafa de 2 litros', 'Refrigerante de cola em garrafa de 2 litros', 9.00, 'Nome-Comida-8522.jpeg', 8, 'Sim', 'Sim'),
(46, 'Sprite em garrafa de 1,5 litros', 'Refrigerante de limão em garrafa de 1,5 litros', 7.00, 'Nome-Comida-9581.jpg', 8, 'Não', 'Sim'),
(48, 'Guaraná Antártica em garrafa de 2 litros', 'Refrigerante de guaraná em garrafa de 2 litros', 8.00, 'Food-Name-8557.jpeg', 8, 'Sim', 'Sim'),
(49, 'Água mineral em garrafa de 500ml', 'Água mineral em garrafa de 500ml', 2.00, 'Food-Name-5532.jpeg', 8, 'Sim', 'Sim'),
(50, 'Água com gás em garrafa de 1 litro', 'Água com gás em garrafa de 1 litro', 3.00, 'Nome-Comida-1017.jpeg', 8, 'Não', 'Sim'),
(51, 'Sundae de Chocolate', 'Sorvete de chocolate com calda de chocolate quente', 7.00, 'Food-Name-2009.jpeg', 9, 'Não', 'Sim'),
(52, 'Cheesecake de Morango', 'Cheesecake com calda de morango e pedaços de frutas', 8.00, 'Nome-Comida-8317.jpeg', 9, 'Sim', 'Sim'),
(53, 'Brownie de Chocolate', 'Brownie quente com sorvete de baunilha', 6.00, 'Nome-Comida-4815.jpeg', 9, 'Não', 'Sim'),
(54, 'Tiramisu', 'Sobremesa italiana de café e queijo mascarpone', 9.00, 'Nome-Comida-7035.jpeg', 9, 'Não', 'Sim'),
(55, 'Pudim de Caramelo', 'Pudim de leite com calda de caramelo', 5.00, 'Nome-Comida-4074.jpeg', 9, 'Não', 'Sim'),
(56, 'Morangos com Chantilly', 'Morangos frescos com chantilly', 4.00, 'Nome-Comida-6781.jpg', 9, 'Não', 'Sim'),
(57, 'Mousse de Maracujá', 'Mousse de maracujá leve e refrescante', 7.00, 'Nome-Comida-8892.jpeg', 9, 'Sim', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `comida` varchar(150) NOT NULL,
  `preço` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `data_pedido` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `nome_cliente` varchar(150) NOT NULL,
  `contato_cliente` varchar(20) NOT NULL,
  `email_cliente` varchar(150) NOT NULL,
  `endereco_cliente` varchar(255) NOT NULL,
  `id_administrador` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `tbl_pedido`
--

INSERT INTO `tbl_pedido` (`id`, `comida`, `preço`, `quantidade`, `total`, `data_pedido`, `status`, `nome_cliente`, `contato_cliente`, `email_cliente`, `endereco_cliente`, `id_administrador`) VALUES
(1, 'Sadeko Momo', 6.00, 3, 18.00, '2020-11-30 03:49:48', 'Cancelado', 'Bradley Farrell', '+1 (576) 504-4657', 'zuhafiq@mailinator.com', 'Duis aliqua Qui lor', NULL),
(2, 'Best Burger', 4.00, 4, 16.00, '2020-11-30 03:52:43', 'Entregue', 'Kelly Dillard', '+1 (908) 914-3106', 'fexekihor@mailinator.com', 'Incidunt ipsum ad d', NULL),
(3, 'Pizza Mista', 10.00, 2, 20.00, '2020-11-30 04:07:17', 'Entregue', 'Jana Bush', '+1 (562) 101-2028', 'tydujy@mailinator.com', 'Minima iure ducimus', NULL),
(4, 'Pratos de Dumplings', 5.00, 500000, 2500000.00, '2023-10-31 02:19:42', 'Entregue', 'Aline Pereira', '45988058196', 'aline@perreira.com', 'Rua do Nada', NULL),
(5, 'Best Burger', 4.00, 1, 4.00, '2023-10-31 02:24:00', 'Cancelado', 'Alessandra Uhl', '45988058196', 'alessandra.uhl@gmail.com', 'Rua Txikaos', NULL),
(6, 'Pratos de Dumplings', 5.00, 2, 10.00, '2023-10-31 03:13:31', 'Cancelado', 'Gabriel Padilha', '45998140943', 'gabriel.padilha@gmail.com', 'Rua Vitória', NULL),
(7, 'Pratos de Dumplings', 5.00, 4025, 20125.00, '2023-11-01 01:03:24', 'Entregue', 'Paulo Henrique', '45988058196', 'paulohenrique@gmail.com', 'Rua Teste', NULL),
(8, 'Pizza Mista', 10.00, 1, 10.00, '2023-11-01 01:11:20', 'Entregue', 'Paulo', '44449', 'paulo@gmail.com', 'Sdsakdbasd', NULL),
(9, 'Best Burger', 4.00, 2000, 8000.00, '2023-11-01 08:00:07', 'Cancelado', 'Testessss', '55444848', 'teste@gmail.comdsa', 'Dsadsa', NULL),
(10, 'Água mineral em garrafa de 500ml', 2.00, 3, 6.00, '2023-11-09 08:08:50', 'Pedido', 'fulana', '4598805896', 'fulana@gmail.ccom', 'rua da fulana', NULL),
(11, 'Hambúrguer Duplo com Bacon', 23.00, 1, 23.00, '2023-11-09 08:09:22', 'Pedido', 'fulana', '', 'fulana@gmail.com', 'dsd', NULL),
(12, 'Hambúrguer Duplo com Bacon', 23.00, 1, 23.00, '2023-11-09 08:57:09', 'Entregue', 'teste', '', 'teste2@gmail.com', 'dsd', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbl_administrador`
--
ALTER TABLE `tbl_administrador`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbl_comida`
--
ALTER TABLE `tbl_comida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices de tabela `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_administrador` (`id_administrador`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_administrador`
--
ALTER TABLE `tbl_administrador`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tbl_comida`
--
ALTER TABLE `tbl_comida`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbl_comida`
--
ALTER TABLE `tbl_comida`
  ADD CONSTRAINT `tbl_comida_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id`);

--
-- Restrições para tabelas `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD CONSTRAINT `id_administrador` FOREIGN KEY (`id_administrador`) REFERENCES `tbl_administrador` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
