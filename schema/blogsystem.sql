-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 19 mars 2019 à 06:25
-- Version du serveur :  5.7.19
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blogsystem`
--

-- --------------------------------------------------------

--
-- Structure de la table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `image` text NOT NULL,
  `start_at` int(11) NOT NULL,
  `end_at` int(11) NOT NULL,
  `page` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ads`
--

INSERT INTO `ads` (`id`, `name`, `link`, `image`, `start_at`, `end_at`, `page`, `status`, `created`) VALUES
(1, 'Home Banner', 'https://google.com', '4af6845fec1431b10bb508c12d35db86aeaf0fbf_c9636fd007ea04984848c37642e94aabfffefadf.png', 1555113600, 1618272000, '/', 'enabled', 1552431490),
(2, 'Another Ad', 'https://google.com', '8dbe1c418bb35ceebc4c3fe0b0005bf7ba26cf5b_4de6c278d4cbbe6bbcd4506bf5cd68e5a16bb271.jpg', 1552176000, 1554854400, '/', 'enabled', 1552853078);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `status`) VALUES
(5, NULL, 'Sports', 'enabled'),
(6, NULL, 'Politics', 'enabled'),
(7, NULL, 'Fashion', 'enabled');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created`, `status`) VALUES
(1, 1, 9, 'Good Test Post!', 1552861458, 'enabled'),
(2, 1, 9, 'New comment from John', 1552861904, 'enabled');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(96) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `reply` text NOT NULL,
  `replied_by` int(11) NOT NULL,
  `replied_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `details` text,
  `image` varchar(255) DEFAULT NULL,
  `tags` text,
  `related_posts` text,
  `views` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `user_id`, `title`, `details`, `image`, `tags`, `related_posts`, `views`, `created`, `status`) VALUES
(3, 5, 1, 'One more Post', '&lt;p&gt;&lt;br /&gt;\r\nThis is a one more post&lt;/p&gt;\r\n', '19d36009e9bdddec90e1f50ec172726f0c3e6a60_20585b3d4465537834d773045f46a76304c4e58a.jpg', 'new,post,more', '', NULL, 1552426861, 'enabled'),
(4, 6, 1, 'Another Post 1', '&lt;p&gt;This is one of best post&lt;/p&gt;\r\n', 'cab536d0f6a62d0b08d98a8f2ecc1eb3fa217708_7068862ba8f0d45e168b0dbfd41b22aefe6b9c66.jpg', 'new,post', '3', NULL, 1552855655, 'enabled'),
(5, 6, 1, 'Another Post 2', '&lt;p&gt;This is one of best post&lt;/p&gt;\r\n', 'cab536d0f6a62d0b08d98a8f2ecc1eb3fa217708_7068862ba8f0d45e168b0dbfd41b22aefe6b9c66.jpg', 'new,post', '3', NULL, 1552855655, 'enabled'),
(6, 6, 1, 'Another Post 3', '&lt;p&gt;This is one of best post&lt;/p&gt;\r\n', 'cab536d0f6a62d0b08d98a8f2ecc1eb3fa217708_7068862ba8f0d45e168b0dbfd41b22aefe6b9c66.jpg', 'new,post', '3', NULL, 1552855655, 'enabled'),
(7, 5, 1, 'Another Post 4', '&lt;p&gt;This is one of best post&lt;/p&gt;\r\n', 'cab536d0f6a62d0b08d98a8f2ecc1eb3fa217708_7068862ba8f0d45e168b0dbfd41b22aefe6b9c66.jpg', 'new,post', '3', NULL, 1552855655, 'enabled'),
(8, 5, 1, 'Another Post 5', '&lt;p&gt;This is one of best post&lt;/p&gt;\r\n', 'cab536d0f6a62d0b08d98a8f2ecc1eb3fa217708_7068862ba8f0d45e168b0dbfd41b22aefe6b9c66.jpg', 'new,post', '3', NULL, 1552855655, 'enabled'),
(9, 6, 1, 'Another Post 6', '&lt;p&gt;This is one of best post&lt;/p&gt;\r\n', 'cab536d0f6a62d0b08d98a8f2ecc1eb3fa217708_7068862ba8f0d45e168b0dbfd41b22aefe6b9c66.jpg', 'new,post', '3', NULL, 1552855655, 'enabled');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(9, 'site_name', 'My Blog'),
(10, 'site_email', 'admin@blog.loc'),
(11, 'site_status', 'enabled'),
(12, 'site_close_msg', '&lt;h1&gt;&lt;strong&gt;SITE IN MAINTENANCE NOW&lt;/strong&gt;&lt;/h1&gt;\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `users_group_id` int(11) DEFAULT NULL,
  `first_name` varchar(40) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `email` varchar(96) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `birthday` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `code` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `users_group_id`, `first_name`, `last_name`, `email`, `password`, `image`, `gender`, `birthday`, `created`, `status`, `ip`, `code`) VALUES
(1, 1, 'Kouassi', 'Yao', 'jeanyao@blog.loc', '$2y$10$N3kKk7dYl0ZaVnRWKi/NeuqWUbIaUDB8WGjUzQNKUmXD2uIOP32TK', 'cfd3aaf55c3d2310e5b1fd8f0bfe5ac75c09e630_19bebb02de329bc0a46fa8c83e6e3cb0097163f3.jpg', 'male', 0, 1552087758, '', '127.0.0.1', '2ba79d35363eada3f5d520fca9ae0bfb82e355d6'),
(3, 2, 'Michel', 'Yao', 'michelle@ymail.com', '$2y$10$07GiqBzOHREPIUtIo0cMwOK4.xGNvsAdx1UdDcEbvPZvz7IRZK58e', '998872e61d5a13ba7bf2e8ba0280942aa1844560_8734edae0af69a2c0ae202d25560b22149e55f4c.jpg', 'female', 1473984000, 1552855399, 'enabled', '127.0.0.1', '90e1b27dcd624661c5b4a547f307f58a6daf2ca3');

-- --------------------------------------------------------

--
-- Structure de la table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users_groups`
--

INSERT INTO `users_groups` (`id`, `name`) VALUES
(1, 'Super Administrators'),
(2, 'Users');

-- --------------------------------------------------------

--
-- Structure de la table `users_group_permissions`
--

CREATE TABLE `users_group_permissions` (
  `id` int(11) NOT NULL,
  `users_group_id` int(11) NOT NULL,
  `page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users_group_permissions`
--

INSERT INTO `users_group_permissions` (`id`, `users_group_id`, `page`) VALUES
(53, 2, '/admin/login'),
(54, 2, '/admin/login/submit'),
(238, 1, '/admin/login'),
(239, 1, '/admin/login/submit'),
(240, 1, '/admin'),
(241, 1, '/admin/dashboard'),
(242, 1, '/admin/submit'),
(243, 1, '/admin/users'),
(244, 1, '/admin/users/add'),
(245, 1, '/admin/users/submit'),
(246, 1, '/admin/users/edit/:id'),
(247, 1, '/admin/users/save/:id'),
(248, 1, '/admin/users/delete/:id'),
(249, 1, '/admin/profile/update'),
(250, 1, '/admin/users-groups'),
(251, 1, '/admin/users-groups/add'),
(252, 1, '/admin/users-groups/submit'),
(253, 1, '/admin/users-groups/edit/:id'),
(254, 1, '/admin/users-groups/save/:id'),
(255, 1, '/admin/users-groups/delete/:id'),
(256, 1, '/admin/categories'),
(257, 1, '/admin/categories/add'),
(258, 1, '/admin/categories/submit'),
(259, 1, '/admin/categories/edit/:id'),
(260, 1, '/admin/categories/save/:id'),
(261, 1, '/admin/categories/delete/:id'),
(262, 1, '/admin/posts'),
(263, 1, '/admin/posts/add'),
(264, 1, '/admin/posts/submit'),
(265, 1, '/admin/posts/edit/:id'),
(266, 1, '/admin/posts/save/:id'),
(267, 1, '/admin/posts/delete/:id'),
(268, 1, '/admin/posts/:id/comments'),
(269, 1, '/admin/comments/edit/:id'),
(270, 1, '/admin/comments/save/:id'),
(271, 1, '/admin/comments/delete/:id'),
(272, 1, '/admin/settings'),
(273, 1, '/admin/settings/save'),
(274, 1, '/admin/contacts'),
(275, 1, '/admin/contacts/reply/:id'),
(276, 1, '/admin/contacts/send/:id'),
(277, 1, '/admin/ads'),
(278, 1, '/admin/ads/add'),
(279, 1, '/admin/ads/submit'),
(280, 1, '/admin/ads/edit/:id'),
(281, 1, '/admin/ads/save/:id'),
(282, 1, '/admin/ads/delete/:id'),
(283, 1, '/admin/logout');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_group_permissions`
--
ALTER TABLE `users_group_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users_group_permissions`
--
ALTER TABLE `users_group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
