-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 21-Jun-2018 às 19:03
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teste14`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `affiliate_history`
--

CREATE TABLE `affiliate_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'paid',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('unread','read','replied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `inp_errors`
--

CREATE TABLE `inp_errors` (
  `id` int(11) NOT NULL,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(50) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=default, 0 = not default',
  `point_per_day` decimal(20,8) DEFAULT NULL,
  `version` varchar(30) DEFAULT NULL,
  `earning_rate` decimal(20,8) DEFAULT NULL,
  `image` varchar(100) NOT NULL DEFAULT '1.png',
  `price` float(20,8) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '90',
  `profit` varchar(191) NOT NULL DEFAULT '0',
  `speed` varchar(191) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `plans`
--

INSERT INTO `plans` (`id`, `plan_name`, `is_default`, `point_per_day`, `version`, `earning_rate`, `image`, `price`, `duration`, `profit`, `speed`) VALUES
(1, 'Free Plan', 1, '0.02000000', 'V 1.0', '0.00001389', '1.png', 0.00000000, 0, '2', '1'),
(2, 'Plan V1.1', 0, '15.00000000', 'V 1.1', '0.01041667', '2.png', 300.00000000, 90, '5', '10'),
(3, 'Plan V1.2', 0, '53.00000000', 'V 1.2', '0.03680556', '3.png', 1000.00000000, 90, '5.25', '100');

-- --------------------------------------------------------

--
-- Estrutura para tabela `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `sitename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DogeMiner Demo',
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'keywords, here',
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Site description here',
  `pagination` int(5) NOT NULL DEFAULT '10',
  `min_withdraw` float(20,8) NOT NULL DEFAULT '0.00000000',
  `min_aff_withdraw` float(20,8) NOT NULL DEFAULT '0.00000000',
  `max_withdraw` float(20,8) NOT NULL DEFAULT '100.00000000',
  `aff_comission` int(11) NOT NULL DEFAULT '2',
  `currency_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Dogecoin',
  `currency_symbol` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Đ',
  `currency_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DOGE',
  `currency_decimals` int(1) NOT NULL DEFAULT '8',
  `coin_pv` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coin_pb` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coin_mid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coin_sec` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coin_cur1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DOGE',
  `coin_cur2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DOGE',
  `coin_hash` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '3ncrypt3dh4ash@',
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'e10adc3949ba59abbe56e057f20f883e',
  `smtp_host` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_pass` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_port` int(5) NOT NULL,
  `smtp_secure` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vk` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_min` int(5) NOT NULL DEFAULT '20',
  `wallet_max` int(5) NOT NULL DEFAULT '50',
  `blockchain` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Estrutura da tabela `transactions_history`
--

CREATE TABLE `transactions_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `paid_amount` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending' COMMENT 'pending,paid',
  `hash` varchar(191) DEFAULT NULL,
  `txid` varchar(191) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `urlchains`
--

CREATE TABLE `urlchains` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `urlchains`
--

INSERT INTO `urlchains` (`id`, `name`, `url`) VALUES
(1, 'DogeChain(DOGE)', 'https://dogechain.info/tx/'),
(2, 'Blockchain(BTC)', 'https://www.blockchain.com/btc/tx/'),
(3, 'Etherchain(ETH)', 'https://www.etherchain.org/tx/'),
(4, 'Litecoin Explorer(LTC)', 'http://explorer.litecoin.net/tx/'),
(5, 'Chainso(ZEC)', 'https://chain.so/tx/ZEC/'),
(6, 'Chainso(DASH)', 'https://chain.so/tx/DASH/');

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `unique_id` int(6) NOT NULL,
  `username` varchar(191) DEFAULT NULL,
  `balance` DECIMAL(20,8)  NOT NULL DEFAULT '0.00000000',
  `cashouts` DECIMAL(20,8)  NOT NULL DEFAULT '0.00000000',
  `plan_id` int(11) DEFAULT NULL,
  `reference_user_id` int(11) NOT NULL,
  `affiliate_earns` float(20,8) NOT NULL DEFAULT '0.00000000',
  `affiliate_paid` float(20,8) NOT NULL DEFAULT '0.00000000',
  `ip_addr` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_deposits`
--

CREATE TABLE `user_deposits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` float(20,8) NOT NULL,
  `status` enum('PENDING','PROCESSING','SUCCESS') NOT NULL DEFAULT 'PENDING',
  `tx` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_paid` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_plan_history`
--

CREATE TABLE `user_plan_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'inactive' COMMENT 'active,inactive',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expire_date` timestamp NULL DEFAULT NULL,
  `last_sum` VARCHAR(191) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_withdrawal`
--

CREATE TABLE `user_withdrawal` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'payment' COMMENT 'payment,affiliate',
  `amount` float(20,8) NOT NULL,
  `status` enum('PENDING','PROCESSING','SUCCESS') NOT NULL DEFAULT 'PENDING',
  `tx` varchar(191) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_paid` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliate_history`
--
ALTER TABLE `affiliate_history`
  ADD PRIMARY KEY (`id`);
  
--
-- Índices de tabela `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);
  
--
-- Índices de tabela `inp_errors`
--
ALTER TABLE `inp_errors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);
  
--
-- Índices de tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions_history`
--
ALTER TABLE `transactions_history`
  ADD PRIMARY KEY (`id`);

  --
-- Índices de tabela `urlchains`
--
ALTER TABLE `urlchains`
  ADD PRIMARY KEY (`id`);
  
--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_deposits`
--
ALTER TABLE `user_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_plan_history`
--
ALTER TABLE `user_plan_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_withdrawal`
--
ALTER TABLE `user_withdrawal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliate_history`
--
ALTER TABLE `affiliate_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `inp_errors`
--
ALTER TABLE `inp_errors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- AUTO_INCREMENT for table `transactions_history`
--
ALTER TABLE `transactions_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `urlchains`
--
ALTER TABLE `urlchains`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

--
-- AUTO_INCREMENT for table `users`
--

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_deposits`
--
ALTER TABLE `user_deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_plan_history`
--
ALTER TABLE `user_plan_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_withdrawal`
--
ALTER TABLE `user_withdrawal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
