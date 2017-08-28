-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 26/08/2017 às 02:59
-- Versão do servidor: 5.7.19-0ubuntu0.17.04.1
-- Versão do PHP: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `astrosports`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `advertisings`
--

CREATE TABLE `advertisings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `advertisings`
--

INSERT INTO `advertisings` (`id`, `name`, `url`, `img`, `created_at`, `updated_at`) VALUES
(1, 'M4 Brinks', NULL, 'c9fb04155e8fb36d91deb8afa2e2ed41.png', '2017-08-24 14:25:00', NULL),
(2, 'Rota.7', NULL, '5770e3b5773f35b6e6a02fa7c1d119e0.jpg', '2017-08-24 14:27:00', NULL),
(3, 'FM Interativa', 'http://www.fminterativams.com.br/', '1a5feb2f2007f3c4460d2f33507f7ef5.jpg', '2017-08-24 14:28:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `albums`
--

CREATE TABLE `albums` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `albums`
--

INSERT INTO `albums` (`id`, `name`) VALUES
(1, 'Fotos variadas'),
(2, 'Álbum dia 29/08/2016');

-- --------------------------------------------------------

--
-- Estrutura para tabela `authors`
--

CREATE TABLE `authors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'MDS'),
(2, 'Fonte/Autor: Deliane Oliveira - MTE/MS 412'),
(3, 'Fonte/Autor: Lúcio Borges - MTE/MS 171/04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `commission`
--

CREATE TABLE `commission` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `commission`
--

INSERT INTO `commission` (`id`, `name`, `avatar`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Marcelo Silva', 'dae52742d749ec68cdd4b5b932d1ca83aa75e227.jpg', 4, '2014-03-03 23:55:18', NULL),
(2, 'Prof. Ronaldo', 'ee4f72f98d1b817f4b348712f2366371a7be4e93.jpg', 3, '2014-03-17 15:21:29', NULL),
(3, 'Mylena Rocha da Silva', NULL, 1, '2015-05-06 17:45:56', NULL),
(4, 'Prof.Roger', NULL, 2, '2015-05-06 17:46:43', NULL),
(5, 'Prof.Samuel', NULL, 2, '2016-08-29 15:19:14', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `commission_roles`
--

CREATE TABLE `commission_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `commission_roles`
--

INSERT INTO `commission_roles` (`id`, `name`) VALUES
(1, 'Administrativo'),
(2, 'Aux. Técnico'),
(3, 'Diretor'),
(4, 'Presidente e Coord. Técnico');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_06_19_004311_create_schedules_categories_table', 1),
(2, '2017_06_19_004700_create_schedules_poles_table', 1),
(3, '2017_06_19_004905_create_schedules_table', 1),
(4, '2017_07_02_175550_create_albums_table', 1),
(5, '2017_07_02_175616_create_photos_table', 1),
(6, '2017_07_27_113222_create_commission_roles_table', 2),
(7, '2017_07_27_113232_create_commission_table', 2),
(8, '2017_07_28_105229_create_players_positions_table', 2),
(9, '2017_07_28_105235_create_players_table', 2),
(10, '2017_08_13_145847_create_authors_table', 3),
(11, '2017_08_13_150001_create_news_table', 3),
(12, '2017_08_24_101618_create_advertisings_table', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `author` int(10) UNSIGNED NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `news`
--

INSERT INTO `news` (`id`, `author`, `cover`, `title`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, '4f0c70bdf357b622a25a6df23517a4cf.JPG', 'Escola de Futebol recebe a visita da TV Morena', '&lt;p&gt;&lt;img src=&quot;/uploads/noticias/4f0c70bdf357b622a25a6df23517a4cf.JPG&quot; alt=&quot;&quot; width=&quot;292&quot; height=&quot;254&quot; /&gt;&lt;img style=&quot;float: right;&quot; src=&quot;/uploads/noticias/1dd40d3be03187bf9a46c6281376b2f9.JPG&quot; alt=&quot;&quot; width=&quot;294&quot; height=&quot;254&quot; /&gt;&lt;/p&gt;\n&lt;p style=&quot;text-align: left;&quot;&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p style=&quot;text-align: left;&quot;&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p style=&quot;text-align: left;&quot;&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p style=&quot;text-align: left;&quot;&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p style=&quot;text-align: justify;&quot;&gt;Foi com grande alegria que atletas, pais e comiss&amp;atilde;o t&amp;eacute;cnica receberam a visita da TV Morena durante os treinamentos de prepara&amp;ccedil;&amp;atilde;o para a estr&amp;eacute;ia no Campeonato Estadual Sub-14 da FFMS. A visita da TV Morena n&amp;atilde;o foi importante s&amp;oacute; para a equipe da Escola de Futebol, mais tambem para toda comunidade local que se sentiu orgulhosa e valorizada.&lt;/p&gt;\n&lt;p style=&quot;text-align: justify;&quot;&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p style=&quot;text-align: justify;&quot;&gt;&amp;nbsp;&lt;/p&gt;', '2014-09-05 21:24:21', NULL),
(2, 1, '39ebd8ff17a7a9694ee0bbd921a2d41a.jpg', 'Escola de Futebol Astro Sports faz parceria com clube profissional', '&lt;p style=&quot;text-align: right;&quot;&gt;&lt;img style=&quot;float: left;&quot; src=&quot;/uploads/noticias/39ebd8ff17a7a9694ee0bbd921a2d41a.jpg&quot; alt=&quot;&quot; width=&quot;332&quot; height=&quot;274&quot; /&gt;&lt;img src=&quot;/uploads/noticias/69755eb896d09ea346834daf7b2cc1b3.jpg&quot; alt=&quot;&quot; width=&quot;320&quot; height=&quot;274&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;Diretoria, Comiss&amp;atilde;o t&amp;eacute;cnica e atletas da Escola de Futebol Astro Sports receberam em seu CT Membros da Diretoria de um clube profissional da nossa capital e na oportunidade firmaram parceria para disputar o Campeonato Estadual sub-14. A princ&amp;iacute;pio a parceria seria apenas para o estadual sub-14, mais pode se estender a outras categorias.&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2014-09-05 21:23:57', NULL),
(3, 1, 'b7f6971c4ea55602628a3c581589966c.jpg', ' Início das atividades em 2014', '&lt;p&gt;&amp;nbsp;&lt;img style=&quot;display: block; margin-left: auto; margin-right: auto;&quot; src=&quot;/uploads/noticias/b7f6971c4ea55602628a3c581589966c.jpg&quot; alt=&quot;&quot; width=&quot;479&quot; height=&quot;401&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p&gt;A Escola de Futebol Astro Sports voltou com suas atividades este ano no dia 15.02 - s&amp;aacute;bado no per&amp;iacute;odo matutino. Segundo informa&amp;ccedil;&amp;otilde;es da coordena&amp;ccedil;&amp;atilde;o t&amp;eacute;cnica, neste primeiro momento os treinamentos ser&amp;atilde;o somente aos s&amp;aacute;bados &amp;agrave; partir das 08hs.&lt;/p&gt;', '2014-09-05 21:25:05', NULL),
(5, 2, 'b952894c2380fccc2b1d10be26f78f143080d252.jpg', 'Funesp realiza capacitação com professores do Projeto Geração de Campeões', '&lt;p&gt;&lt;img style=&quot;display: block; margin-left: auto; margin-right: auto;&quot; src=&quot;/uploads/fotos/b952894c2380fccc2b1d10be26f78f143080d252.jpg&quot; alt=&quot;&quot; width=&quot;617&quot; height=&quot;389&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\n&lt;p style=&quot;text-align: justify;&quot;&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp;Os professores das escolas de futebol do Projeto Gera&amp;ccedil;&amp;atilde;o de Campe&amp;otilde;es, realizado pela Associa&amp;ccedil;&amp;atilde;o dos profissionais de Educa&amp;ccedil;&amp;atilde;o F&amp;iacute;sica em parceria com a Prefeitura Municipal de Campo Grande, receberam na tarde de quarta-feira 13.08.14, capacita&amp;ccedil;&amp;atilde;o para melhorar a forma&amp;ccedil;&amp;atilde;o da inicia&amp;ccedil;&amp;atilde;o esportiva na sede da Fnda&amp;ccedil;&amp;atilde;o Municipal de Esporte. A forma&amp;ccedil;&amp;atilde;o foi apresentada pelo Doutor em Gest&amp;atilde;o de Clubes de Futebol, Marvio Pereira Leoncini. Entre os temas abordados os de maior destaque e discuss&amp;atilde;o foram &quot;Como trabalhar o futebol em cada faixa et&amp;aacute;ria e qual a diferen&amp;ccedil;a do professor e treinador.&lt;/p&gt;\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2014-09-05 21:25:46', NULL),
(7, 3, '8301fcaf316d1ce4d5f08e4e6be56eb0.jpg', '1ª COPA CAMPO GRANDE DE FUTEBOL SUB-15', '&lt;p&gt;&lt;img style=&quot;display: block; margin-left: auto; margin-right: auto;&quot; src=&quot;/uploads/noticias/8301fcaf316d1ce4d5f08e4e6be56eb0.jpg&quot; alt=&quot;&quot; width=&quot;456&quot; height=&quot;322&quot; /&gt;&lt;/p&gt;\n&lt;p style=&quot;text-align: justify;&quot;&gt;A FUNESP (Funda&amp;ccedil;&amp;atilde;o Municipal de Esporte), abriu na &amp;uacute;ltima segunda-feira, 1&amp;ordm; de setembro, as inscri&amp;ccedil;&amp;otilde;es para a 1&amp;ordf; COPA CAMPO GRANDE DE FUTEBOL SUB - 15, que seguem at&amp;eacute; o pr&amp;oacute;ximo dia 19. O in&amp;iacute;cio da competi&amp;ccedil;&amp;atilde;o esta previsto para o dia 27 de setembro.&lt;/p&gt;', '2014-09-05 21:25:58', NULL),
(9, 1, 'c88930f482e4ed8dd4f2a26a351d71f0a6bb0190.937aaa815e91cee7b74ca05a9ffc79f1.jpg', 'Atletas da Escola de Futebol Astro Sports Indicados para Jogarem no Náutico F. C.', '&lt;p&gt;&lt;img src=&quot;/uploads/fotos/c88930f482e4ed8dd4f2a26a351d71f0a6bb0190.937aaa815e91cee7b74ca05a9ffc79f1.jpg&quot; alt=&quot;&quot; width=&quot;946&quot; height=&quot;460&quot; /&gt;&lt;/p&gt;\n&lt;p&gt;Atletas da Escola de Futebol Astro Sports dos Polos Coophatrabalho e Jd. Petr&amp;oacute;polis foram selecionados para disputarem competi&amp;ccedil;&amp;otilde;es sub 15 e sub 17 pelo N&amp;aacute;utico Futebol Clube.&amp;nbsp;&lt;/p&gt;', '2014-11-03 16:24:05', NULL),
(11, 1, 'https://scontent-sea1-1.xx.fbcdn.net/hphotos-xfl1/v/l/t1.0-0/s160x160/12795425_813291728777264_8181703304873998205_n.jpg?oh=ca2f49170b59dfdf552e113f820473ae&amp;amp;oe=57B854E2', 'Novo Espaço de Treinamento', '&lt;p&gt;&lt;img src=&quot;https://scontent-sea1-1.xx.fbcdn.net/hphotos-xfl1/v/l/t1.0-0/s160x160/12795425_813291728777264_8181703304873998205_n.jpg?oh=ca2f49170b59dfdf552e113f820473ae&amp;amp;oe=57B854E2&quot; alt=&quot;&quot; width=&quot;160&quot; height=&quot;107&quot; /&gt; A Escola de Futebol Astro Sports fez parceria com a Arena Bola de Meia e estara com espa&amp;ccedil;o dispon&amp;iacute;vel para treinamentos a partir de mar&amp;ccedil;o.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;', '2016-04-06 00:45:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `photos`
--

CREATE TABLE `photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `album` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `photos`
--

INSERT INTO `photos` (`id`, `name`, `description`, `album`, `created_at`, `updated_at`) VALUES
(1, 'b238531be24dcfa4bb42d3b6f1c5c111c455ec38.jpg', NULL, 1, NULL, NULL),
(2, 'cae00a163c5ab4922c8e0c75f6533c35bdc85374.jpg', NULL, 1, NULL, NULL),
(3, '75bd6aaaeafdbcb19c28759906f4cba9d64ab2d6.jpg', NULL, 1, NULL, NULL),
(4, '6d3cc1f39a825d4fd0e6762101624c34563f2f0a.jpg', NULL, 1, NULL, NULL),
(5, '766b956f2205e4db2f98f2d705f41667fe655878.jpg', NULL, 1, NULL, NULL),
(6, '0b6d7be08537cd3c13dae89b6418d341ed475087.jpg', NULL, 1, NULL, NULL),
(7, '539ab114417dcfcb369976a2bbe6b28cd3a102ca.jpg', NULL, 1, NULL, NULL),
(10, '8eaea04b5745ed5af3c7aefdbf88b21c57e5360e.jpg', NULL, 1, NULL, NULL),
(11, '999f7fa903a94d33240d046bd881097adc58b4cb.jpg', NULL, 1, NULL, NULL),
(12, 'f8d3fe9129e32bcc1c126068adc37dadd9774fb3.jpg', NULL, 1, NULL, NULL),
(14, '903d90082dd397b0eda15d2c0a86684f3cb831b4.jpg', NULL, 1, NULL, NULL),
(15, '8e0f9ddf6fbdd3caf4bf2731b1c1b98aa74a3804.jpg', NULL, 1, NULL, NULL),
(16, 'c22fe8720e37bab96dc367891ff3feb232f80730.jpg', NULL, 1, NULL, NULL),
(17, 'd03126905ec45df1c7dcd01d82e5fb23ecbc06cb.jpg', NULL, 1, NULL, NULL),
(18, '3589ff8087c42180c16a6891513e1a187bffce86.jpg', NULL, 1, NULL, NULL),
(20, '5d1e641acb5b8a1bf66439966d55c8c64307e04d.jpg', NULL, 1, NULL, NULL),
(21, '5664b8b529103acc55c03125edd64b76850ebb38.jpg', NULL, 1, NULL, NULL),
(22, 'e1c0a5044c8b37ea53d397ace01c8ee07eaaed12.jpg', NULL, 1, NULL, NULL),
(23, '904712e1b4c2b9a665ecb47a7baaff0532255d25.jpg', NULL, 1, NULL, NULL),
(24, '9916160fd7b9d677fb41c28dee4b388923340cbd.jpg', NULL, 1, NULL, NULL),
(25, 'c0e66e2824936b5fb9705dadc535ff44b5063323.jpg', NULL, 1, NULL, NULL),
(26, '1773110f93b3fcdac00db1b0f5187f6b0ec000fb.jpg', NULL, 1, NULL, NULL),
(37, 'e390da23605cae962fe55251fe23f4e2fd368e27.jpg', NULL, 1, NULL, NULL),
(38, 'a9ba5a02ebbb7f476d06320a9705c56c1066ea45.jpg', NULL, 1, NULL, NULL),
(39, 'd5c1dffe258c5bfcb309cfa79fa70d3d811cd293.jpg', NULL, 1, NULL, NULL),
(40, '9bdc03359dd5d9bb58195d4b97c05bf20a639b3f.jpg', NULL, 1, NULL, NULL),
(41, '167d384d6e12043c37ec33361213af6113da6f2b.jpg', NULL, 1, NULL, NULL),
(42, 'c4c5184bd437d31c0988bfeb55159d7308119fe9.jpg', NULL, 1, NULL, NULL),
(43, '037bebae8c65aac6836c8c940f658c0b312444f0.jpg', NULL, 1, NULL, NULL),
(44, 'd484ff0eb8140095280de8c989c14d20bfd6c2e9.jpg', NULL, 1, NULL, NULL),
(45, '91f34444d8a2665e7f1be02649aa8383d9bde4a3.jpg', NULL, 1, NULL, NULL),
(46, '2cb9fc031cc20f8ab13d10d4113b7eb1893a1541.jpg', NULL, 1, NULL, NULL),
(47, '472778d8cb8b1a98ddfbbc1eb6e5c2629e4e0c89.jpg', NULL, 1, NULL, NULL),
(48, '43ae451493c733f95b0c3662ed9d34ab7ed66f81.jpg', NULL, 1, NULL, NULL),
(49, '16cdaa21e115169487ab26f1d23b9369b8a3adc5.jpg', NULL, 1, NULL, NULL),
(50, '45c02e09172aa459812bd2c122ecccfdf2e74bcb.jpg', NULL, 1, NULL, NULL),
(51, '93094fadac5042c7ad3404fc29267e1ce4c6f918.jpg', NULL, 1, NULL, NULL),
(52, '9e784bcb56461938ad3a1f96b729ea851ba2e8e9.jpg', NULL, 1, NULL, NULL),
(53, 'cd9b1e52a64c8ce8afab4536d7755799ef7a775d.jpg', NULL, 1, NULL, NULL),
(54, '3a6b7992d50668baf2d44f8d39a07990f1186de3.jpg', NULL, 1, NULL, NULL),
(55, '1bbd65d2aa8dfd8bb10448059f9d6602960b2110.jpg', NULL, 1, NULL, NULL),
(56, 'f2fe2b3df48ebe26535e9292412d5f638fe3af92.jpg', NULL, 1, NULL, NULL),
(57, 'aa79e4f251c4e8379329e036a9d852e134c967d4.jpg', NULL, 1, NULL, NULL),
(58, 'e1288f533c2745142f90887e3d9508dd6e5a90d0.jpg', NULL, 1, NULL, NULL),
(59, '514feec97621e09c9800c0642eaf01ef894a8c99.jpg', NULL, 1, NULL, NULL),
(60, '80c2386b2e608da28c792549d8aca221b1f7d7df.jpg', NULL, 1, NULL, NULL),
(61, '52367d9e3f3fc419b664f212b3409a9caa9fdd2f.jpg', NULL, 1, NULL, NULL),
(63, '0ecbe8e0e788784ac5fd126742acd1e3c293ed4d.jpg', NULL, 1, NULL, NULL),
(64, 'aa93558237c7dd1f72082db3a8c78dbb5a8ed677.jpg', NULL, 1, NULL, NULL),
(65, 'ff2c4c787f43ae2c034f09ad665d473a9ab4d998.jpg', NULL, 1, NULL, NULL),
(66, '361afc70bab59c537f6addf87d3ded5578ad5081.jpg', NULL, 1, NULL, NULL),
(67, 'd67f986ae0bc55314b93b52267b81297ba35f001.jpg', NULL, 1, NULL, NULL),
(68, '9370006daacfa41557d2dcebd96926e840ab76a6.jpg', NULL, 1, NULL, NULL),
(69, '2a5a4f1d42d1ad9f719f842c94ce14ee63319c0a.jpg', NULL, 1, NULL, NULL),
(70, '80a7f6767690148b4d6569cafa8c969d4629aadb.jpg', NULL, 1, NULL, NULL),
(71, 'ed944e88deffcc1c6c055f230b1b50e8f5d2a633.jpg', NULL, 1, NULL, NULL),
(72, 'c3cc75a5700c2920c4c67a3faca53d15a0063946.jpg', NULL, 1, NULL, NULL),
(84, '7723d23c783f3e08e553567891f22f51c141fb58.jpg', NULL, 1, NULL, NULL),
(85, '59528b1a25f4868a14bbeb7765f11426b5178ae2.jpg', NULL, 1, NULL, NULL),
(86, 'c88930f482e4ed8dd4f2a26a351d71f0a6bb0190.jpg', NULL, 1, NULL, NULL),
(87, '147c8b1a927c40b641c31afa7a8c0570e99dd5c8.jpg', NULL, 1, NULL, NULL),
(88, '657a85f9784fd540268735ee443def4a8bb62b3e.jpg', NULL, 1, NULL, NULL),
(89, '549b05cd20bf829c607d432e6fbf7b3941b27e00.jpg', NULL, 1, NULL, NULL),
(90, '5a1435e06a8f5e75725a9f413e12d4c0f3770587.jpg', NULL, 1, NULL, NULL),
(91, 'c54af0c540acbbe0cedf9b236f104d539b58700c.jpg', 'Álbum dia 29/08/2016', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `players`
--

CREATE TABLE `players` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `players_positions`
--

CREATE TABLE `players_positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `hour` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pole` int(10) UNSIGNED NOT NULL,
  `category` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `schedules`
--

INSERT INTO `schedules` (`id`, `hour`, `day`, `pole`, `category`, `created_at`, `updated_at`) VALUES
(1, '18:00', 'thu', 4, 12, NULL, NULL),
(2, '18:00', 'tue', 4, 12, NULL, NULL),
(3, '17:30', 'thu', 4, 11, NULL, NULL),
(4, '17:30', 'tue', 4, 11, NULL, NULL),
(5, '17:00', 'mon', 4, 9, NULL, NULL),
(6, '17:30', 'thu', 1, 11, NULL, NULL),
(7, '17:40', 'mon', 4, 10, NULL, NULL),
(8, '17:00', 'wed', 4, 9, NULL, NULL),
(9, '17:30', 'thu', 1, 11, NULL, NULL),
(10, '17:40', 'wed', 4, 10, NULL, NULL),
(11, '17:40', 'mon', 4, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `schedules_categories`
--

CREATE TABLE `schedules_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `schedules_categories`
--

INSERT INTO `schedules_categories` (`id`, `name`) VALUES
(1, '06 a 10 anos'),
(2, '06 a 08 anos'),
(3, '11 a 14 anos'),
(4, '09 a 10 anos'),
(5, '11 a 12 anos'),
(6, '13 a 14 anos'),
(7, '15 a 17 anos'),
(8, '06 a 14 ANOS'),
(9, '13 a 15 anos'),
(10, '10 a 12 anos'),
(11, '05 a 06 anos'),
(12, '07 a 09 anos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `schedules_poles`
--

CREATE TABLE `schedules_poles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Fazendo dump de dados para tabela `schedules_poles`
--

INSERT INTO `schedules_poles` (`id`, `name`) VALUES
(1, 'Polo Zé Pereira'),
(2, 'Polo Jd.Petrópolis'),
(3, 'Polo Coophatrabalho'),
(4, 'POLO SÍRIO LIBANÊS I');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `advertisings`
--
ALTER TABLE `advertisings`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `commission`
--
ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commission_role_foreign` (`role`);

--
-- Índices de tabela `commission_roles`
--
ALTER TABLE `commission_roles`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_album_foreign` (`album`);

--
-- Índices de tabela `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `players_position_foreign` (`position`);

--
-- Índices de tabela `players_positions`
--
ALTER TABLE `players_positions`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_pole_foreign` (`pole`),
  ADD KEY `schedules_category_foreign` (`category`);

--
-- Índices de tabela `schedules_categories`
--
ALTER TABLE `schedules_categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `schedules_poles`
--
ALTER TABLE `schedules_poles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `advertisings`
--
ALTER TABLE `advertisings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `commission`
--
ALTER TABLE `commission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de tabela `commission_roles`
--
ALTER TABLE `commission_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT de tabela `players`
--
ALTER TABLE `players`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `players_positions`
--
ALTER TABLE `players_positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `schedules_categories`
--
ALTER TABLE `schedules_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de tabela `schedules_poles`
--
ALTER TABLE `schedules_poles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `commission`
--
ALTER TABLE `commission`
  ADD CONSTRAINT `commission_role_foreign` FOREIGN KEY (`role`) REFERENCES `commission_roles` (`id`);

--
-- Restrições para tabelas `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_album_foreign` FOREIGN KEY (`album`) REFERENCES `albums` (`id`);

--
-- Restrições para tabelas `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_position_foreign` FOREIGN KEY (`position`) REFERENCES `players_positions` (`id`);

--
-- Restrições para tabelas `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_category_foreign` FOREIGN KEY (`category`) REFERENCES `schedules_categories` (`id`),
  ADD CONSTRAINT `schedules_pole_foreign` FOREIGN KEY (`pole`) REFERENCES `schedules_poles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
