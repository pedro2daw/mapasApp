-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2019 a las 13:40:59
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mapas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calles`
--

DROP DATABASE IF EXISTS mapas;

CREATE DATABASE mapas CHARACTER SET utf8;

use mapas;

CREATE TABLE `calles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` varchar(25) NOT NULL,
  `ano_inicio` smallint(6) NOT NULL,
  `ano_fin` smallint(6) NOT NULL,
  `id_mapa` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('8moljaoajonfe92mg15v1033buirtslg', '::1', 1549540332, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534303333323b),
('5gft141qjvs9anni2vg7n7oumjkm2ql3', '::1', 1549540658, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534303635383b),
('u4uqqh91ld5peqfla5qkgca27n641r67', '::1', 1549540979, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534303937393b),
('n9g6h4alcj6bptchp8hcn4it1g47attf', '::1', 1549541380, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534313338303b),
('64d40teugp50f8t0n18huji9msj9j7sr', '::1', 1549541709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534313730393b),
('m2r9gnepva1rkg9cvii5ep00jqh91j90', '::1', 1549542182, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534323138323b),
('o39gjh3mag48ft38o4gnhnhbsg30n6fn', '::1', 1549542534, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534323533343b),
('ph9bttksa3nnkbs8atc7nvtcic99ocfv', '::1', 1549542911, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534323931313b),
('l8tgva5pa6r2vk6l6kufid2naba5f1au', '::1', 1549543259, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534333235393b6c6f67756564496e7c623a313b),
('5jrjdtp02hkouj04leedobsl2goggsct', '::1', 1549544255, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534343235353b6c6f67756564496e7c623a313b),
('7164ue9md301vfb8vr71eda20et6d7nm', '::1', 1549544594, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534343539343b6c6f67756564496e7c623a313b),
('dnpj7potco8f72k3nfrgfpjrkfnnm953', '::1', 1549546186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534363138363b6c6f67756564496e7c623a313b),
('itgfmn346km7d662lbhkr87aae4u41lr', '::1', 1549546199, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393534363138363b6c6f67756564496e7c623a313b),
('rhg9e17crp7gonqe19rg3h8ul36f2t9a', '::1', 1549870821, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837303832313b6c6f67756564496e7c623a313b),
('edulmgoutkpr5jt57nme71mk5pgbgr92', '::1', 1549871182, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837313138323b6c6f67756564496e7c623a313b),
('5ja2c34vk8444rosr2v593t0vu9o443b', '::1', 1549871484, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837313438343b6c6f67756564496e7c623a313b),
('t08clhsfaml9eftcfsdrlbdim4kga5i9', '::1', 1549871897, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837313839373b6c6f67756564496e7c623a313b),
('k48sarmrqjcu4mk2g8itdum7hv122u98', '::1', 1549872732, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837323733323b6c6f67756564496e7c623a313b),
('mueqk3a8opqdts11o2gj7aodoqj6re3u', '::1', 1549873094, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837333039343b6c6f67756564496e7c623a313b),
('n2k5fgdn62jkd7fic2tbip3bbn1r0vn7', '::1', 1549873490, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837333439303b6c6f67756564496e7c623a313b),
('0s040c5atspbhupo16us1rb16uhlnak2', '::1', 1549873816, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837333831363b6c6f67756564496e7c623a313b),
('4iq964i732b7egnou9b443kgmfolanfb', '::1', 1549874169, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837343136393b6c6f67756564496e7c623a313b),
('hib6q5pf0vvll359ho4cma0rqduldvvn', '::1', 1549874900, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837343930303b6c6f67756564496e7c623a313b),
('0g6notrad6oahbsj3jcnp73ktdv145eh', '::1', 1549875228, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837353232383b6c6f67756564496e7c623a313b),
('kfnv0qnhh05rkp3avetttjm5n0mb2fft', '::1', 1549878440, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393837383434303b6c6f67756564496e7c623a313b),
('6pifoljbr8rapff8fbphfqdt3lb241ae', '::1', 1549880125, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838303132353b6c6f67756564496e7c623a313b),
('6l3dkehqjcl3gh97v27m9l75ukk2pmpq', '::1', 1549882230, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838323233303b6c6f67756564496e7c623a313b),
('7cl8d69r9tsb2ikuso4fq4hto5ngqrtb', '::1', 1549882555, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838323535353b6c6f67756564496e7c623a313b),
('11mphhp0ir67247139mbsdecuomfcbil', '::1', 1549882858, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838323835383b6c6f67756564496e7c623a313b),
('khp0tb2lsgs51abh665f7ss33ilhasgh', '::1', 1549883210, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838333231303b6c6f67756564496e7c623a313b),
('0uj5a21i9hlqbc9ibfrlq7gsqftdnqbb', '::1', 1549883512, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838333531323b6c6f67756564496e7c623a313b),
('p3g1ekfb3k4ie4oesac03v8honugep3n', '::1', 1549884227, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838343232373b6c6f67756564496e7c623a313b),
('16h2q832k0301ivc8srk5o92upovompe', '::1', 1549885326, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838353332363b6c6f67756564496e7c623a313b),
('25eklgq363qe991nkumsc64ucm2g7h6o', '::1', 1549885640, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838353634303b6c6f67756564496e7c623a313b),
('khlihfj3t6nm4ns3kt6vedh5nt727s6n', '::1', 1549886130, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838363133303b6c6f67756564496e7c623a313b),
('cf3vtgai9javr5v5sas84ulc8npc42cl', '::1', 1549886710, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838363731303b6c6f67756564496e7c623a313b),
('nj5j8rcov9a8lobgvuok5vm3dich6f4n', '::1', 1549886948, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393838363731303b6c6f67756564496e7c623a313b),
('i003ea51ddinqa5metiegg8kguvrfg01', '::1', 1549957722, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393935373732323b6c6f67756564496e7c623a313b69647c733a313a2232223b),
('3ciuu729jg7gfhmdqarph1hm40aao6fg', '::1', 1549958396, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393935383339363b6c6f67756564496e7c623a313b69647c733a313a2232223b),
('vetstuosg6kjd2uirf68900l411mfqqi', '::1', 1549958963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393935383936333b6c6f67756564496e7c623a313b69647c733a313a2232223b),
('dgslq6uhisrovqhgbr6iieekadtqtp1d', '::1', 1549959451, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393935393435313b6c6f67756564496e7c623a313b69647c733a313a2232223b),
('lfatvjaassjhjfj5k921t72da6rg0jab', '::1', 1549960017, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393936303031373b6c6f67756564496e7c623a313b69647c733a313a2232223b),
('8qfd1ho5vbt1cl8btu9dluppr6q873mf', '::1', 1549960535, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393936303533353b6c6f67756564496e7c623a313b69647c733a313a2232223b),
('7q6kpm9v0r34bpuki60a3nuar9b0biu8', '::1', 1549960535, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393936303533353b6c6f67756564496e7c623a313b69647c733a313a2232223b),
('3i4q7gijh2r0vjvb2durmb0uaasrk77a', '::1', 1549969645, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393936393634353b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('85kmcl0sjo7j872la10du382nl8v1t2t', '::1', 1549970309, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937303330393b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('7fltc07bu07jhavhd30c1k5aqa5tued5', '::1', 1549970878, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937303837383b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('kumgng3kt8abas2trdbrmp1h73h7enld', '::1', 1549971217, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937313231373b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('ntlu2bqloe8at8lo2dkrfhk8ggg9n436', '::1', 1549971691, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937313639313b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('k0cli3pftif4aupb41td3qoi1jahdh0m', '::1', 1549972023, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937323032333b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('4ks50cbcsseg5j8gkbkgv1ibno984f1t', '::1', 1549973330, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937333333303b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('mdio5d2rlam24am83r6bvim5hnj4p1qf', '::1', 1549973755, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937333735353b6c6f67756564496e7c623a313b69647c733a313a2232223b),
('ctv48vbr1jp5751um477d0lr6ed7ihii', '::1', 1549973764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937333736343b),
('0u40bmda4drsc041svd7mcb8thofpgab', '::1', 1549973650, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937333635303b),
('1omtfj9vfkgamvbi8qfk00a7nr95enkk', '::1', 1549974084, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937343038343b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('flk6u554eb4p68uatrlbhir5kb0vnr28', '::1', 1549973787, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937333736343b),
('4jh1pmvbklu60rk057a1ra0d3kefau6r', '::1', 1549975440, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937353434303b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('b9iu2590gldeejr0pk9a5s0a9grn3ark', '::1', 1549976094, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937363039343b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('vfd2lsqi08oofqt5lt1sc1eqq2h8trd1', '::1', 1549976132, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937363039343b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('r7eu1lgq5klbb9ha77ad34oaeo5q9bn2', '::1', 1549976352, 0x5f5f63695f6c6173745f726567656e65726174657c693a313534393937363335323b),
('d5c8t4sk672tr2ka32tt25cjvihhmh5j', '::1', 1550044946, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303034343934363b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('kmc4ulu7uks4e3ovvkjcuo9mfpbst55g', '::1', 1550045407, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303034353430373b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('0gelret9etcugagl0etbmish3l0lhi3f', '::1', 1550045766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303034353736363b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('p0125clk6df1k59iv2amvb7dr95fof5s', '::1', 1550046099, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303034363039393b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('j883usj8rakh8majer4qpg81kd9f3jo9', '::1', 1550049275, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303034393237353b6c6f67756564496e7c623a313b69647c733a313a2231223b),
('pmm3nhlaukea24jthmjsur0s7b3hn3dm', '::1', 1550050207, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035303230373b6c6f67756564496e7c623a313b69647c4e3b),
('ork5dc5q6ca86dc8pe2srfehgdiul4a0', '::1', 1550055183, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035353138333b6c6f67756564496e7c623a313b69647c4e3b),
('gt17jh7jai2j4icnon3qmjb3so3qik8a', '::1', 1550056166, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035363136363b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('323pb50o4jru84gq6a2futnul931oco3', '::1', 1550056468, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035363436383b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('ukqpjelb2j3e0kqgcjmthhk7mt3d4vis', '::1', 1550056797, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035363739373b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('to0qe27mem9hco67gabhqql9edlg5go3', '::1', 1550056473, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035363437333b),
('odumojai7lkn9im8l42vapds7222sie7', '::1', 1550057312, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035373331323b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('gpgdqt2vi17dfv7oegork2clcan4kq45', '::1', 1550057673, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035373637333b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('it1ivq9lm2jd3hfonmal714c5rplf0vo', '::1', 1550058444, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035383434343b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('n3td2m4d274b92tp83cedlqqs9df7bee', '::1', 1550058852, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035383835323b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('8bbac0hlc21l778g3bh3e8m4dqinmtcg', '::1', 1550059341, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035393334313b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('s1t332r5tpq3rr6vp50chh9jmahotd9j', '::1', 1550059867, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303035393836373b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('lkkpspgrcu0uvv3nod0jegdcfo6dh3ic', '::1', 1550061330, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303036313333303b6c6f67756564496e7c623a313b69647c733a313a2237223b),
('qqge7qu519mpa5900e4f8el1cpk7cvuj', '::1', 1550061383, 0x5f5f63695f6c6173745f726567656e65726174657c693a313535303036313333303b6c6f67756564496e7c623a313b69647c733a313a2237223b);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hotspots`
--

CREATE TABLE `hotspots` (
  `id` int(10) UNSIGNED NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `punto_x` int(10) UNSIGNED NOT NULL,
  `punto_y` int(10) UNSIGNED NOT NULL,
  `id_mapa` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas`
--

CREATE TABLE `mapas` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `fecha` smallint(6) NOT NULL,
  `imagen` varchar(250) NOT NULL,
  `nivel` smallint(6) NOT NULL,
  `ancho` int(11) NOT NULL,
  `altura` int(11) NOT NULL,
  `fecha_de_subida` datetime NOT NULL,
  `id_paquete` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mapas`
--

INSERT INTO `mapas` (`id`, `titulo`, `descripcion`, `ciudad`, `fecha`, `imagen`, `nivel`, `ancho`, `altura`, `fecha_de_subida`, `id_paquete`) VALUES
(1, 'Ortofoto Almería del Siglo XXI', 'Ortofoto de Almería del Siglo XXI', 'Almeria', 2017, '/assets/img/mapas/1_almeria.png', 2, 1000, 1000, '0000-00-00 00:00:00', 2),
(2, 'Mapa Almería del Siglo XIX', 'Mapa de Almería del Siglo XIX Perez de Rozas', 'Almeria', 1864, '/assets/img/mapas/2_almeria.png', 1, 1000, 1000, '0000-00-00 00:00:00', 2),
(3, 'Satelite Almería del Siglo XXI', 'Satelite de Almería del Siglo XXI', 'Almeria', 2017, '/assets/img/mapas/3_almeria.png', 2, 1000, 1000, '0000-00-00 00:00:00', 2),
(5, 'Satelite Almería del Siglo XXI', 'Satelite de Almería del Siglo XXI', 'Almeria', 2017, '/assets/img/mapas/5_almeria.png', 2, 1000, 1000, '0000-00-00 00:00:00', 3),
(6, 'Mapa Almería del Siglo XIX', 'Mapa de Almería del Siglo XIX Perez de Rozas', 'Almeria', 1864, '/assets/img/mapas/6_almeria.png', 1, 1000, 1000, '0000-00-00 00:00:00', 3),
(7, 'Mapa Almería del Siglo XIX', 'Mapa de Almería del Siglo XIX Perez de Rozas', 'Almeria', 1864, '/assets/img/mapas/7_almeria.png', 1, 1000, 1000, '0000-00-00 00:00:00', 4),
(8, 'Ortofoto Almería del Siglo XXI', 'Ortofoto de Almería del Siglo XXI', 'Almeria', 2017, '/assets/img/mapas/8_almeria.png', 2, 1000, 1000, '0000-00-00 00:00:00', 4),
(9, 'Satelite Almería del Siglo XXI', 'Satelite de Almería del Siglo XXI', 'Almeria', 2017, '/assets/img/mapas/9_almeria.png', 2, 1000, 1000, '0000-00-00 00:00:00', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mapas_calles`
--

CREATE TABLE `mapas_calles` (
  `id_map` int(10) UNSIGNED DEFAULT NULL,
  `id_lamina` int(10) UNSIGNED DEFAULT NULL,
  `id_calle` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquetes`
--

CREATE TABLE `paquetes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `fecha_subida` datetime NOT NULL,
  `descripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paquetes`
--

INSERT INTO `paquetes` (`id`, `nombre`, `fecha_subida`, `descripcion`) VALUES
(1, 'Seleccione un paquete', '1000-01-01 00:00:00', 'default'),
(2, 'Almería Centro', '2019-02-07 12:37:50', 'Descripción'),
(3, 'Almería Torrecardenas', '2019-02-07 12:37:50', 'Descripción'),
(4, 'La Molineta', '2019-02-07 12:37:50', 'Descripción');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE `puntos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `punto_x` int(10) UNSIGNED NOT NULL,
  `punto_y` int(10) UNSIGNED NOT NULL,
  `id_calle` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `nivel` smallint(5) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `passwd`, `nivel`) VALUES
(7, 'test', '$2y$10$01USiIeKB4XgV.XdpoBteupm6GvzjrUy./k2VgjrMdu8.MKI7fItm', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `calles`
--
ALTER TABLE `calles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indices de la tabla `hotspots`
--
ALTER TABLE `hotspots`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mapas`
--
ALTER TABLE `mapas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mapas_calles`
--
ALTER TABLE `mapas_calles`
  ADD UNIQUE KEY `id_map` (`id_map`),
  ADD UNIQUE KEY `id_lamina` (`id_lamina`),
  ADD UNIQUE KEY `id_calle` (`id_calle`);

--
-- Indices de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `calles`
--
ALTER TABLE `calles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hotspots`
--
ALTER TABLE `hotspots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mapas`
--
ALTER TABLE `mapas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `paquetes`
--
ALTER TABLE `paquetes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;