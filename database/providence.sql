-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 12:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `providence`
--

-- --------------------------------------------------------

--
-- Table structure for table `burials`
--

CREATE TABLE `burials` (
  `id` int(11) NOT NULL,
  `grave_location` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_of_death` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `burials`
--

INSERT INTO `burials` (`id`, `grave_location`, `name`, `date_of_death`) VALUES
(1, 'COS-SEC1-A1', 'John Doe', '1982-02-01'),
(2, 'EVGM-SEC3-A2', 'John Doe', '2020-11-25'),
(3, 'EVGM-SEC3-A3', 'James Johnson', '1981-02-17'),
(4, 'EVGM-SEC3-A4', 'Emily Brown', '1976-07-06'),
(5, 'EVGM-SEC3-A5', 'Michael Williams', '2020-12-12'),
(6, 'EVGM-SEC3-A6', 'Jessica Taylor', '1998-01-31'),
(7, 'EVGM-SEC3-A7', 'Christopher Lee', '2009-05-12'),
(8, 'EVGM-SEC3-A8', 'Amanda Martin', '1978-12-30'),
(9, 'EVGM-SEC3-A9', 'David Garcia', '2000-06-12'),
(10, 'EVGM-SEC3-A10', 'Sarah Martinez', '1991-09-08'),
(11, 'EVGM-SEC3-A11', 'Robert Rodriguez', '1987-02-04'),
(12, 'EVGM-SEC3-A12', 'Jennifer Hernandez', '1990-05-29'),
(13, 'EVGM-SEC3-A13', 'William Gonzalez', '2020-10-02'),
(14, 'EVGM-SEC3-A14', 'Linda Perez', '2007-03-20'),
(15, 'EVGM-SEC3-A15', 'Richard Sanchez', '2003-10-22'),
(16, 'EVGM-SEC3-A16', 'Karen Wilson', '1975-08-14'),
(17, 'EVGM-SEC3-A17', 'Jeffrey Flores', '2000-03-19'),
(18, 'EVGM-SEC3-A18', 'Patricia King', '2000-09-01'),
(19, 'EVGM-SEC3-A19', 'Daniel Scott', '1980-12-01'),
(20, 'EVGM-SEC3-A20', 'Helen Turner', '1984-05-14'),
(21, 'EVGM-SEC3-B1', 'John Davis', '2009-01-30'),
(22, 'EVGM-SEC3-B2', 'Mary Clark', '2018-09-29'),
(23, 'EVGM-SEC3-B3', 'David Martinez', '1992-12-01'),
(24, 'EVGM-SEC3-B4', 'Patricia Anderson', '1990-02-19'),
(25, 'EVGM-SEC3-B5', 'Robert Walker', '2001-12-04'),
(26, 'EVGM-SEC3-B6', 'Barbara Hill', '2017-06-08'),
(27, 'EVGM-SEC3-B7', 'Michael Adams', '2007-11-08'),
(28, 'EVGM-SEC3-B8', 'Jennifer Baker', '2016-12-13'),
(29, 'EVGM-SEC3-B9', 'William Gonzalez', '1987-08-24'),
(30, 'EVGM-SEC3-B10', 'Cynthia Thompson', '2020-12-05'),
(31, 'EVGM-SEC3-B11', 'Charles Nelson', '2016-05-13'),
(32, 'EVGM-SEC3-B12', 'Ruth Wright', '1997-04-08'),
(33, 'EVGM-SEC3-B13', 'Jason King', '2019-01-06'),
(34, 'EVGM-SEC3-B14', 'Karen Walker', '1977-12-10'),
(35, 'EVGM-SEC3-B15', 'Timothy Perez', '2017-12-31'),
(36, 'EVGM-SEC3-B16', 'Laura Gonzalez', '1979-01-23'),
(37, 'EVGM-SEC3-B17', 'Megan Lee', '1974-11-10'),
(38, 'EVGM-SEC3-B18', 'Steven Carter', '2018-11-19'),
(39, 'EVGM-SEC3-B19', 'Carolyn Harris', '1992-09-24'),
(40, 'EVGM-SEC3-B20', 'Kenneth Young', '1988-10-15'),
(41, 'EVGM-SEC3-C1', 'Jessica Turner', '1995-10-02'),
(42, 'EVGM-SEC3-C2', 'Brandon Wright', '1990-08-09'),
(43, 'EVGM-SEC3-C3', 'Amy Martinez', '1995-10-10'),
(44, 'EVGM-SEC3-C4', 'Justin Nelson', '1985-04-10'),
(45, 'EVGM-SEC3-C5', 'Pamela Thompson', '2020-10-26'),
(46, 'EVGM-SEC3-C6', 'Gregory King', '1971-03-03'),
(47, 'EVGM-SEC3-C7', 'Rebecca Walker', '1978-09-17'),
(48, 'EVGM-SEC3-C8', 'Stephanie Perez', '2010-01-22'),
(49, 'EVGM-SEC3-C9', 'Keith Gonzalez', '1988-10-26'),
(50, 'EVGM-SEC3-C10', 'Victoria Lee', '1995-09-13'),
(51, 'EVGM-SEC3-C11', 'Philip Carter', '1990-04-06'),
(52, 'EVGM-SEC3-C12', 'Christine Harris', '1994-03-19'),
(53, 'EVGM-SEC3-C13', 'Billy Young', '1978-06-30'),
(54, 'EVGM-SEC3-C14', 'Julie Turner', '1991-08-15'),
(55, 'EVGM-SEC3-C15', 'Lawrence Wright', '2000-10-30'),
(56, 'EVGM-SEC3-C16', 'Diana Martinez', '2007-07-07'),
(57, 'EVGM-SEC3-C17', 'Lori Johnson', '2013-04-19'),
(58, 'EVGM-SEC3-C18', 'Walter Brown', '1970-05-25'),
(59, 'EVGM-SEC3-C19', 'Carol Anderson', '1997-06-02'),
(60, 'EVGM-SEC3-C20', 'Sara Williams', '2002-05-06'),
(61, 'EVGM-SEC3-D1', 'Mark Smith', '1997-09-10'),
(62, 'EVGM-SEC3-D2', 'Margaret Johnson', '2011-06-04'),
(63, 'EVGM-SEC3-D3', 'Edward Brown', '1990-06-27'),
(64, 'EVGM-SEC3-D4', 'Jason Williams', '1999-12-09'),
(65, 'EVGM-SEC3-D5', 'Hannah Taylor', '2006-06-12'),
(66, 'EVGM-SEC3-D6', 'George Hernandez', '2010-08-22'),
(67, 'EVGM-SEC3-D7', 'Nancy Lopez', '2012-02-01'),
(68, 'EVGM-SEC3-D8', 'Matthew Hill', '2006-09-23'),
(69, 'EVGM-SEC3-D9', 'Katherine Clark', '1975-08-08'),
(70, 'EVGM-SEC3-D10', 'Timothy Green', '1991-05-17'),
(71, 'EVGM-SEC3-D11', 'Christina Adams', '2008-04-16'),
(72, 'EVGM-SEC3-D12', 'Patrick Martinez', '1993-10-11'),
(73, 'EVGM-SEC3-D13', 'Samantha King', '1974-01-06'),
(74, 'EVGM-SEC3-D14', 'Jeremy Scott', '1970-07-09'),
(75, 'EVGM-SEC3-D15', 'Emma Carter', '2012-04-29'),
(76, 'EVGM-SEC3-D16', 'Tyler Young', '1972-12-19'),
(77, 'EVGM-SEC3-D17', 'Grace Turner', '2013-03-10'),
(78, 'EVGM-SEC3-D18', 'Erica Wright', '2021-09-16'),
(79, 'EVGM-SEC3-D19', 'Benjamin Perez', '1995-06-03'),
(80, 'EVGM-SEC3-D20', 'Holly Johnson', '1993-09-30'),
(81, 'EVGM-SEC3-E1', 'Lucas Brown', '2012-06-25'),
(82, 'EVGM-SEC3-E2', 'Olivia Martinez', '2007-08-10'),
(83, 'EVGM-SEC3-E3', 'Dylan Adams', '1978-10-21'),
(84, 'EVGM-SEC3-E4', 'Natalie King', '2004-10-05'),
(85, 'EVGM-SEC3-E5', 'Jesse Garcia', '2013-11-03'),
(86, 'EVGM-SEC3-E6', 'Valerie Perez', '1981-05-13'),
(87, 'EVGM-SEC3-E7', 'Logan Hill', '1998-11-05'),
(88, 'EVGM-SEC3-E8', 'Rachel Clark', '1976-07-31'),
(89, 'EVGM-SEC3-E9', 'Alan Taylor', '2019-12-02'),
(90, 'EVGM-SEC3-E10', 'Madison Scott', '1992-09-29'),
(91, 'EVGM-SEC3-E11', 'Trevor Turner', '1985-09-30'),
(92, 'EVGM-SEC3-E12', 'Cassandra Wright', '1980-06-29'),
(93, 'EVGM-SEC3-E13', 'Peter Perez', '1975-03-25'),
(94, 'EVGM-SEC3-E14', 'Angela Johnson', '2016-06-08'),
(95, 'EVGM-SEC3-E15', 'Nicholas Anderson', '1979-05-20'),
(96, 'EVGM-SEC3-E16', 'Christine Garcia', '1981-03-01'),
(97, 'EVGM-SEC3-E17', 'Jordan Hernandez', '1997-09-01'),
(98, 'EVGM-SEC3-E18', 'Samantha Lewis', '1971-04-18'),
(99, 'EVGM-SEC3-E19', 'Christopher Martin', '1997-01-07'),
(100, 'EVGM-SEC3-E20', 'Kaitlyn Thompson', '1997-08-27'),
(101, 'EVGM-SEC3-F1', 'Derrick King', '1975-06-11'),
(102, 'EVGM-SEC3-F2', 'Catherine Scott', '2017-10-21'),
(103, 'EVGM-SEC3-F3', 'Alexis Brown', '1985-07-30'),
(104, 'EVGM-SEC3-F4', 'Mason Martinez', '2008-01-14'),
(105, 'EVGM-SEC3-F5', 'Haley Johnson', '2009-11-19'),
(106, 'EVGM-SEC3-F6', 'Isaac Anderson', '2003-07-17'),
(107, 'EVGM-SEC3-F7', 'Jasmine Garcia', '2018-01-17'),
(108, 'EVGM-SEC3-F8', 'Sean Hernandez', '2006-01-18'),
(109, 'EVGM-SEC3-F9', 'Caroline Lewis', '2006-02-08'),
(110, 'EVGM-SEC3-F10', 'Bryan Martin', '1990-08-09'),
(111, 'EVGM-SEC3-F11', 'Kristen Thompson', '2016-06-24'),
(112, 'EVGM-SEC3-F12', 'Victor Turner', '1985-04-01'),
(113, 'EVGM-SEC3-F13', 'Amber Wright', '2010-05-12'),
(114, 'EVGM-SEC3-F14', 'Shawn Perez', '1970-09-22'),
(115, 'EVGM-SEC3-F15', 'Lindsay Johnson', '2007-11-14'),
(116, 'EVGM-SEC3-F16', 'Erik Clark', '2001-11-05'),
(117, 'EVGM-SEC3-F17', 'Vanessa Scott', '2015-08-14'),
(118, 'EVGM-SEC3-F18', 'Keith Brown', '1998-12-28'),
(119, 'EVGM-SEC3-F19', 'Chelsea Martinez', '1978-02-07'),
(120, 'EVGM-SEC3-F20', 'Ryan Johnson', '1975-04-30'),
(121, 'EVGM-SEC3-G1', 'Grace Anderson', '1972-04-26'),
(122, 'EVGM-SEC3-G2', 'Evan Garcia', '2017-05-22'),
(123, 'EVGM-SEC3-G3', 'Claire Hernandez', '1992-11-16'),
(124, 'EVGM-SEC3-G4', 'Lucy Lewis', '1993-12-29'),
(125, 'EVGM-SEC3-G5', 'Oscar Martin', '2021-05-05'),
(126, 'EVGM-SEC3-G6', 'Bethany Thompson', '1999-05-26'),
(127, 'EVGM-SEC3-G7', 'Isaiah Turner', '2014-09-25'),
(128, 'EVGM-SEC3-G8', 'Mia Wright', '2001-11-30'),
(129, 'EVGM-SEC3-G9', 'Jared Perez', '1995-05-17'),
(130, 'EVGM-SEC3-G10', 'Kelly Johnson', '2001-02-14'),
(131, 'EVGM-SEC3-G11', 'Tanner Clark', '1997-09-17'),
(132, 'EVGM-SEC3-G12', 'Brooke Scott', '2015-03-13'),
(133, 'EVGM-SEC3-G13', 'Dominic Brown', '2009-04-12'),
(134, 'EVGM-SEC3-G14', 'Hailey Martinez', '1979-01-14'),
(135, 'EVGM-SEC3-G15', 'Cameron Johnson', '2000-11-25'),
(136, 'EVGM-SEC3-G16', 'Natalie Thompson', '1993-11-03'),
(137, 'EVGM-SEC3-G17', 'Seth Turner', '1996-06-28'),
(138, 'EVGM-SEC3-G18', 'Savannah Wright', '1979-02-27'),
(139, 'EVGM-SEC3-G19', 'Gabriel Perez', '1988-02-03'),
(140, 'EVGM-SEC3-G20', 'Alexis Hernandez', '1981-03-14'),
(141, 'EVGM-SEC3-H1', 'Colton Lewis', '1971-09-24'),
(142, 'EVGM-SEC3-H2', 'Melanie Martin', '1996-10-28'),
(143, 'EVGM-SEC3-H3', 'Miles Thompson', '1995-05-17'),
(144, 'EVGM-SEC3-H4', 'Summer Turner', '2016-05-26'),
(145, 'EVGM-SEC3-H5', 'Austin Wright', '1970-07-16'),
(146, 'EVGM-SEC3-H6', 'Paige Perez', '1988-10-28'),
(147, 'EVGM-SEC3-H7', 'Tristan Johnson', '2010-09-26'),
(148, 'EVGM-SEC3-H8', 'Kelsey Hernandez', '2013-08-22'),
(149, 'EVGM-SEC3-H9', 'Noah Lewis', '2014-03-21'),
(150, 'EVGM-SEC3-H10', 'Kayla Martin', '2008-05-21'),
(151, 'EVGM-SEC3-H11', 'Blake Thompson', '1977-07-03'),
(152, 'EVGM-SEC3-H12', 'Morgan Turner', '1995-11-30'),
(153, 'EVGM-SEC3-H13', 'Connor Wright', '1973-07-01'),
(154, 'EVGM-SEC3-H14', 'Courtney Perez', '2013-04-23'),
(155, 'EVGM-SEC3-H15', 'Dakota Johnson', '2020-09-17'),
(156, 'EVGM-SEC3-H16', 'Allison Hernandez', '1990-01-31'),
(157, 'EVGM-SEC3-H17', 'Brady Lewis', '1970-01-20'),
(158, 'EVGM-SEC3-H18', 'Lily Martin', '2013-07-29'),
(159, 'EVGM-SEC3-H19', 'Ashley Thompson', '1980-08-07'),
(160, 'EVGM-SEC3-H20', 'Ethan Turner', '1995-11-01'),
(161, 'EVGM-SEC3-I1', 'Drew Wright', '2015-08-04'),
(162, 'EVGM-SEC3-I2', 'Hailey Perez', '2016-11-20'),
(163, 'EVGM-SEC3-I3', 'Joshua Johnson', '2015-11-23'),
(164, 'EVGM-SEC3-I4', 'Katie Hernandez', '2007-01-11'),
(165, 'EVGM-SEC3-I5', 'Cole Lewis', '2017-06-18'),
(166, 'EVGM-SEC3-I6', 'Maria Martin', '1992-09-01'),
(167, 'EVGM-SEC3-I7', 'Johnny Thompson', '1992-09-26'),
(168, 'EVGM-SEC3-I8', 'Emma Turner', '2015-09-02'),
(169, 'EVGM-SEC3-I9', 'Chase Wright', '1974-10-22'),
(170, 'EVGM-SEC3-I10', 'Alexis Perez', '2012-05-09'),
(171, 'EVGM-SEC3-I11', 'Ryan Johnson', '2012-01-08'),
(172, 'EVGM-SEC3-I12', 'Sophia Hernandez', '2001-04-05'),
(173, 'EVGM-SEC3-I13', 'Braden Lewis', '2000-03-28'),
(174, 'EVGM-SEC3-I14', 'Molly Martin', '1975-08-20'),
(175, 'EVGM-SEC3-I15', 'Josh Turner', '2011-01-05'),
(176, 'EVGM-SEC3-I16', 'Emma Wright', '2002-10-27'),
(177, 'EVGM-SEC3-I17', 'Caleb Perez', '2011-01-26'),
(178, 'EVGM-SEC3-I18', 'Alyssa Johnson', '1973-04-30'),
(179, 'EVGM-SEC3-I19', 'Kyle Hernandez', '2018-10-06'),
(180, 'EVGM-SEC3-I20', 'Emily Lewis', '1996-09-18'),
(181, 'EVGM-SEC3-J1', 'Aiden Martin', '2009-01-26'),
(182, 'EVGM-SEC3-J2', 'Grace Thompson', '1981-08-26'),
(183, 'EVGM-SEC3-J3', 'Eli Turner', '2014-08-09'),
(184, 'EVGM-SEC3-J4', 'Ava Wright', '2002-09-22'),
(185, 'EVGM-SEC3-J5', 'Bryce Perez', '1999-10-24'),
(186, 'EVGM-SEC3-J6', 'Anna Johnson', '2020-11-17'),
(187, 'EVGM-SEC3-J7', 'Gavin Hernandez', '1979-08-19'),
(188, 'EVGM-SEC3-J8', 'Avery Lewis', '2020-11-06'),
(189, 'EVGM-SEC3-J9', 'Emma Martin', '1988-03-28'),
(190, 'EVGM-SEC3-J10', 'Nolan Thompson', '2012-03-16'),
(191, 'EVGM-SEC3-J11', 'Leah Turner', '1970-12-24'),
(192, 'EVGM-SEC3-J12', 'Max Wright', '2003-08-12'),
(193, 'EVGM-SEC3-J13', 'Madeline Perez', '1979-10-16'),
(194, 'EVGM-SEC3-J14', 'Owen Johnson', '2021-09-01'),
(195, 'EVGM-SEC3-J15', 'Lily Hernandez', '1991-11-10'),
(196, 'EVGM-SEC3-J16', 'Connor Lewis', '1976-01-23'),
(197, 'EVGM-SEC3-J17', 'Addison Martin', '1986-07-03'),
(198, 'EVGM-SEC3-J18', 'Elijah Thompson', '1982-07-25'),
(199, 'EVGM-SEC3-J19', 'Alyssa Turner', '1983-04-20'),
(200, 'EVGM-SEC3-J20', 'Cooper Wright', '1998-10-24'),
(201, 'EVGM-SEC3-K1', 'Maya Perez', '1970-08-10'),
(202, 'EVGM-SEC3-K2', 'Jackson Johnson', '1990-02-24'),
(203, 'EVGM-SEC3-K3', 'Elena Hernandez', '2017-02-24'),
(204, 'EVGM-SEC3-K4', 'Logan Lewis', '1989-12-19'),
(205, 'EVGM-SEC3-K5', 'Sophie Martin', '1980-02-26'),
(206, 'EVGM-SEC3-K6', 'Colton Thompson', '2012-08-28'),
(207, 'EVGM-SEC3-K7', 'Lila Turner', '1997-06-25'),
(208, 'EVGM-SEC3-K8', 'Miles Wright', '1979-06-11'),
(209, 'EVGM-SEC3-K9', 'Audrey Perez', '1986-07-16'),
(210, 'EVGM-SEC3-K10', 'Gavin Johnson', '1972-08-01'),
(211, 'EVGM-SEC3-K11', 'Peyton Hernandez', '1985-02-01'),
(212, 'EVGM-SEC3-K12', 'Lucy Lewis', '1985-11-26'),
(213, 'EVGM-SEC3-K13', 'Wyatt Martin', '2004-04-03'),
(214, 'EVGM-SEC3-K14', 'Brooklyn Thompson', '1990-01-02'),
(215, 'EVGM-SEC3-K15', 'Hudson Turner', '2019-01-15'),
(216, 'EVGM-SEC3-K16', 'Gabriella Wright', '1999-11-05'),
(217, 'EVGM-SEC3-K17', 'Brayden Perez', '1972-02-10'),
(218, 'EVGM-SEC3-K18', 'Anna Johnson', '1994-07-26'),
(219, 'EVGM-SEC3-K19', 'Henry Hernandez', '1982-12-13'),
(220, 'EVGM-SEC3-K20', 'Leah Lewis', '2012-10-26'),
(221, 'EVGM-SEC3-L1', 'Owen Martin', '1989-12-02'),
(222, 'EVGM-SEC3-L2', 'Eva Thompson', '1992-11-29'),
(223, 'EVGM-SEC3-L3', 'Dominic Turner', '1973-01-08'),
(224, 'EVGM-SEC3-L4', 'Elise Wright', '2019-12-06'),
(225, 'EVGM-SEC3-L5', 'Eli Perez', '2003-06-19'),
(226, 'EVGM-SEC3-L6', 'Mackenzie Johnson', '1987-07-16'),
(227, 'EVGM-SEC3-L7', 'Aaron Hernandez', '2009-01-28'),
(228, 'EVGM-SEC3-L8', 'Clara Lewis', '2009-03-19'),
(229, 'EVGM-SEC3-L9', 'Cole Martin', '1997-01-19'),
(230, 'EVGM-SEC3-L10', 'Elaina Thompson', '1987-08-16'),
(231, 'EVGM-SEC3-L11', 'Jaxon Turner', '1976-12-16'),
(232, 'EVGM-SEC3-L12', 'Bella Wright', '2003-09-14'),
(233, 'EVGM-SEC3-L13', 'Carter Perez', '2014-01-27'),
(234, 'EVGM-SEC3-L14', 'Maya Johnson', '1985-09-16'),
(235, 'EVGM-SEC3-L15', 'Aiden Hernandez', '2019-11-17'),
(236, 'EVGM-SEC3-L16', 'Alaina Lewis', '2016-12-02'),
(237, 'EVGM-SEC3-L17', 'Dominick Martin', '2003-03-12'),
(238, 'EVGM-SEC3-L18', 'Gianna Thompson', '1995-03-15'),
(239, 'EVGM-SEC3-L19', 'Ethan Turner', '1996-06-03'),
(240, 'EVGM-SEC3-L20', 'Naomi Wright', '1974-09-26'),
(241, 'EVGM-SEC3-M1', 'Molly Perez', '2017-12-19'),
(242, 'EVGM-SEC3-M2', 'Hunter Johnson', '1988-07-04'),
(243, 'EVGM-SEC3-M3', 'Sawyer Hernandez', '1970-06-01'),
(244, 'EVGM-SEC3-M4', 'Lillian Lewis', '2020-02-11'),
(245, 'EVGM-SEC3-M5', 'Xavier Martin', '2012-03-14'),
(246, 'EVGM-SEC3-M6', 'Layla Thompson', '1978-11-19'),
(247, 'EVGM-SEC3-M7', 'Julian Turner', '1991-05-19'),
(248, 'EVGM-SEC3-M8', 'Audrey Wright', '1998-06-19'),
(249, 'EVGM-SEC3-M9', 'Bentley Perez', '1996-05-30'),
(250, 'EVGM-SEC3-M10', 'Charlotte Johnson', '2016-08-28'),
(251, 'EVGM-SEC3-M11', 'Travis Hernandez', '2020-06-29'),
(252, 'EVGM-SEC3-M12', 'Arianna Lewis', '1978-12-08'),
(253, 'EVGM-SEC3-M13', 'Jaxson Martin', '2018-07-16'),
(254, 'EVGM-SEC3-M14', 'Hazel Thompson', '1978-10-08'),
(255, 'EVGM-SEC3-M15', 'Eliana Turner', '1971-10-12'),
(256, 'EVGM-SEC3-M16', 'Ryder Wright', '2004-05-14'),
(257, 'EVGM-SEC3-M17', 'Camila Perez', '1981-03-04'),
(258, 'EVGM-SEC3-M18', 'Roman Johnson', '1974-07-13'),
(259, 'EVGM-SEC3-M19', 'Kylie Hernandez', '2010-11-30'),
(260, 'EVGM-SEC3-M20', 'Dean Lewis', '2005-08-22'),
(261, 'EVGM-SEC3-N1', 'Zoe Martin', '1973-09-07'),
(262, 'EVGM-SEC3-N2', 'Gabriel Thompson', '1985-01-20'),
(263, 'EVGM-SEC3-N3', 'Aria Turner', '1982-06-09'),
(264, 'EVGM-SEC3-N4', 'Ezekiel Wright', '1987-01-10'),
(265, 'EVGM-SEC3-N5', 'Adeline Perez', '2017-10-27'),
(266, 'EVGM-SEC3-N6', 'Jade Johnson', '2002-09-08'),
(267, 'EVGM-SEC3-N7', 'Zachary Hernandez', '1989-12-21'),
(268, 'EVGM-SEC3-N8', 'Ivy Lewis', '1971-10-19'),
(269, 'EVGM-SEC3-N9', 'Greyson Martin', '1970-11-09'),
(270, 'EVGM-SEC3-N10', 'Luna Thompson', '2020-08-29'),
(271, 'EVGM-SEC3-N11', 'Everett Turner', '2013-08-15'),
(272, 'EVGM-SEC3-N12', 'Adalyn Wright', '1984-05-07'),
(273, 'EVGM-SEC3-N13', 'Axel Perez', '2014-06-09'),
(274, 'EVGM-SEC3-N14', 'Makayla Johnson', '1993-10-20'),
(275, 'EVGM-SEC3-N15', 'Caden Hernandez', '2007-06-23'),
(276, 'EVGM-SEC3-N16', 'Violet Lewis', '1982-06-01'),
(277, 'EVGM-SEC3-N17', 'Kingston Martin', '1971-06-04'),
(278, 'EVGM-SEC3-N18', 'Lucille Thompson', '1991-08-25'),
(279, 'EVGM-SEC3-N19', 'Jasper Turner', '1970-06-02'),
(280, 'EVGM-SEC3-N20', 'Isla Wright', '2010-09-13'),
(281, 'EVGM-SEC3-O1', 'Levi Perez', '2016-11-27'),
(282, 'EVGM-SEC3-O2', 'Nora Johnson', '1978-11-20'),
(283, 'EVGM-SEC3-O3', 'Elias Hernandez', '1977-04-04'),
(284, 'EVGM-SEC3-O4', 'Adriana Lewis', '1979-08-20'),
(285, 'EVGM-SEC3-O5', 'Beckett Martin', '1996-05-24'),
(286, 'EVGM-SEC3-O6', 'Raelynn Thompson', '2021-04-15'),
(287, 'EVGM-SEC3-O7', 'Finn Turner', '1991-12-05'),
(288, 'EVGM-SEC3-O8', 'Aubree Wright', '1977-07-16'),
(289, 'EVGM-SEC3-O9', 'Wesley Perez', '1993-09-14'),
(290, 'EVGM-SEC3-O10', 'Isla Johnson', '2014-02-12'),
(291, 'EVGM-SEC3-O11', 'Emery Hernandez', '2015-11-30'),
(292, 'EVGM-SEC3-O12', 'Daxton Lewis', '2015-06-08'),
(293, 'EVGM-SEC3-O13', 'Maci Martin', '2007-08-26'),
(294, 'EVGM-SEC3-O14', 'Silas Thompson', '1970-03-06'),
(295, 'EVGM-SEC3-O15', 'Harlow Turner', '2013-04-07'),
(296, 'EVGM-SEC3-O16', 'Gemma Wright', '1978-09-06'),
(297, 'EVGM-SEC3-O17', 'King Perez', '1987-03-02'),
(298, 'EVGM-SEC3-O18', 'Atlas Johnson', '1978-01-04'),
(299, 'EVGM-SEC3-O19', 'Elaina Hernandez', '2010-05-02'),
(300, 'EVGM-SEC3-O20', 'Axel Lewis', '1992-04-18'),
(301, 'EVGM-SEC3-P1', 'Genevieve Martin', '2012-04-04'),
(302, 'EVGM-SEC3-P2', 'Kaden Thompson', '2010-11-03'),
(303, 'EVGM-SEC3-P3', 'Ella Turner', '1995-08-27'),
(304, 'EVGM-SEC3-P4', 'Evan Wright', '1975-10-01'),
(305, 'EVGM-SEC3-P5', 'Lyla Perez', '1973-07-22'),
(306, 'EVGM-SEC3-P6', 'Harrison Johnson', '1970-07-16'),
(307, 'EVGM-SEC3-P7', 'Adalynn Hernandez', '2013-10-18'),
(308, 'EVGM-SEC3-P8', 'Axel Lewis', '1980-04-04'),
(309, 'EVGM-SEC3-P9', 'Sadie Martin', '1993-06-16'),
(310, 'EVGM-SEC3-P10', 'Braxton Thompson', '2004-09-24'),
(311, 'EVGM-SEC3-P11', 'Avery Turner', '2021-07-07'),
(312, 'EVGM-SEC3-P12', 'Maverick Wright', '2019-10-24'),
(313, 'EVGM-SEC3-P13', 'Alana Perez', '2012-09-25'),
(314, 'EVGM-SEC3-P14', 'Easton Johnson', '1982-06-17'),
(315, 'EVGM-SEC3-P15', 'Maria Hernandez', '2007-08-26'),
(316, 'EVGM-SEC3-P16', 'Jasmine Lewis', '2017-04-24'),
(317, 'EVGM-SEC3-P17', 'Hayden Martin', '1990-01-20'),
(318, 'EVGM-SEC3-P18', 'Liam Thompson', '1980-02-11'),
(319, 'EVGM-SEC3-P19', 'Zoey Turner', '2012-03-05'),
(320, 'EVGM-SEC3-P20', 'Lincoln Wright', '1995-03-17'),
(321, 'EVGM-SEC3-A1', 'Naruto Uzumaki', '1982-02-17');

-- --------------------------------------------------------

--
-- Table structure for table `interment_forms`
--

CREATE TABLE `interment_forms` (
  `INTERMENTFORM_ID` int(11) NOT NULL,
  `STATUS` varchar(255) NOT NULL,
  `ACCOUNT_ID` int(11) DEFAULT NULL,
  `LASTNAME` varchar(255) NOT NULL,
  `FIRSTNAME` varchar(255) NOT NULL,
  `MIDDLENAME` varchar(255) DEFAULT NULL,
  `DATE_OF_BIRTH` date NOT NULL,
  `DATE_OF_DEATH` date NOT NULL,
  `AGE` int(11) NOT NULL,
  `DATE_OF_INTERMENT` date NOT NULL,
  `DAY_OF_INTERMENT` varchar(20) NOT NULL,
  `DAYOFWEEK` varchar(255) NOT NULL,
  `TIME` varchar(999) NOT NULL,
  `REMAINS_TYPE` varchar(255) NOT NULL,
  `VAULT_TYPE` varchar(255) NOT NULL,
  `FILE1` varchar(255) NOT NULL,
  `FILE2` varchar(255) NOT NULL,
  `FILE3` varchar(255) NOT NULL,
  `FILE4` varchar(255) NOT NULL,
  `FILE5` varchar(255) NOT NULL,
  `FILE6` varchar(255) NOT NULL,
  `LOCATION_ID` varchar(100) NOT NULL,
  `INTERMENT_OPTION` varchar(255) NOT NULL,
  `FUNERAL_SERVICE` varchar(255) NOT NULL,
  `LENGTH` varchar(255) NOT NULL,
  `WIDTH` varchar(255) NOT NULL,
  `HEIGHT` varchar(255) NOT NULL,
  `EPITAPH` text NOT NULL,
  `SPECIAL_INSTRUCTIONS` text NOT NULL,
  `TENTRENTALNUM` int(11) DEFAULT NULL,
  `CHAIRRENTALNUM` int(11) DEFAULT NULL,
  `VIP_INTERMENT_SERVICE` varchar(255) NOT NULL,
  `INTERMENT_PRICE` varchar(255) NOT NULL,
  `CHAIR_PRICE` varchar(255) NOT NULL,
  `TENT_PRICE` varchar(255) NOT NULL,
  `PAYMENT_OPTION` varchar(255) NOT NULL,
  `ACCOUNT_NUMBER` varchar(255) NOT NULL,
  `TOTAL_PRICE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interment_forms`
--

INSERT INTO `interment_forms` (`INTERMENTFORM_ID`, `STATUS`, `ACCOUNT_ID`, `LASTNAME`, `FIRSTNAME`, `MIDDLENAME`, `DATE_OF_BIRTH`, `DATE_OF_DEATH`, `AGE`, `DATE_OF_INTERMENT`, `DAY_OF_INTERMENT`, `DAYOFWEEK`, `TIME`, `REMAINS_TYPE`, `VAULT_TYPE`, `FILE1`, `FILE2`, `FILE3`, `FILE4`, `FILE5`, `FILE6`, `LOCATION_ID`, `INTERMENT_OPTION`, `FUNERAL_SERVICE`, `LENGTH`, `WIDTH`, `HEIGHT`, `EPITAPH`, `SPECIAL_INSTRUCTIONS`, `TENTRENTALNUM`, `CHAIRRENTALNUM`, `VIP_INTERMENT_SERVICE`, `INTERMENT_PRICE`, `CHAIR_PRICE`, `TENT_PRICE`, `PAYMENT_OPTION`, `ACCOUNT_NUMBER`, `TOTAL_PRICE`) VALUES
(45, 'Mark as Done', 13, 'Bautista', 'Betlogan', 'Serrato', '2024-08-01', '2024-08-05', 0, '2024-06-13', 'Tuesday', 'Weekdays', '10:00:00', 'Infant Fresh Body', 'Infant Vault', 'file1_66b0e82e781cd.png', 'file2_66b0e82e781d8.png', 'file3_66b0e82e781d9.jpg', 'file4_66b0e82e781db.png', 'file5_66b0e82e781dc.jpg', '', '5', 'Memorial Stucture .40m height (above)', 'Naaruto', '12', '12', '12', 'ASDWDASD21312333333', '122222222222222222222222222222233333333333', 3, 3, '', '21250', '45', '3000', 'Gcash', '', '24,295.00'),
(46, 'Mark as Done', 13, 'Bautista', 'Betlogan', 'Serrato', '2024-08-08', '2024-08-08', 0, '2024-01-14', 'Wednesday', 'Weekdays', '07:00:00', 'Adult Fresh Body', 'Children Vault', 'file1_66b529a209f65.png', 'file2_66b529a209f76.png', 'file3_66b529a209f79.png', 'file4_66b529a209f7a.png', 'file5_66b529a209f7c.png', '', '43', 'Double Vault (Low Pier Foundation)', 'asd', '1', '12', '12', 'ASDWDASD', 'asdwdasdadasdwasd', 4, 3, '', '27500', '45', '4000', 'Gcash', '', '31,545.00'),
(47, 'Mark as Done', 13, 'Bautista', 'Naruto', 'S', '2024-09-02', '2024-09-02', 0, '2024-01-12', 'Thursday', 'Weekdays', '11:00 AM', 'Adult Fresh Body', 'Adult Vault', 'file1_66d5d65961dd4.png', 'file2_66d5d65961f9e.jpg', 'file3_66d5d65961fa2.png', 'file4_66d5d65961fa3.jpg', 'file5_66d5d65961fa5.jpg', '', '5', 'Double Vault (Low Pier Foundation)', 'St. Peter', '50', '50', '50', 'ASDWDASD', 'asdwdasdadasdwasd', 5, 6, '', '29375', '90', '5000', 'Gcash', '', '35,465.00'),
(49, 'Mark as Done', 13, 'Bautista', 'Gusion', 'S', '2024-09-06', '2024-09-06', 0, '2024-02-12', 'Thursday', 'Weekdays', '1:00 PM', 'Children Fresh Body', 'Children Vault', 'file1_66dad5046a64b.jpg', 'file2_66dad5046a656.jpg', 'file3_66dad5046a658.jpg', 'file4_66dad5046a659.jpg', 'file5_66dad5046a65a.jpg', '', '5', 'Double Vault (Low Pier Foundation)', 'asd', '1', '12', '12', 'ASDWDASD', 'asdwdasdadasdwasd', 3, 4, '', '27500', '60', '3000', 'Gcash', '', '32,560.00'),
(51, 'Mark as Done', 13, 'Bautista', 'Sprikitik', 'S', '2007-01-01', '2024-09-05', 17, '2024-04-11', 'Wednesday', 'Weekdays', '3:00 PM', 'Adult Fresh Body', 'Adult Vault', 'file1_66db2eca97c2b.jpg', 'file2_66db2eca97c31.png', 'file3_66db2eca97c33.png', 'file4_66db2eca97c35.png', 'file5_66db2eca97c36.png', '', '5', 'Double Vault (Low Pier Foundation)', 'asd', '1', '12', '12', 'ASDWDASD21312333333', '122222222222222222222222222222233333333333', 7, 4, '', '29375', '60', '7000', 'Metrobank', '', '39,935.00'),
(52, 'Mark as Done', 13, 'Bautista', 'Railleyz', 'S', '2024-09-08', '2024-09-08', 0, '2024-05-24', 'Tuesday', 'Weekdays', '10:00 AM', 'Children Fresh Body', 'Children Vault', 'file1_66dd118477706.png', 'file2_66dd118477957.png', 'file3_66dd11847795a.png', 'file4_66dd11847795c.png', 'file5_66dd118477960.jpg', '', '5', 'Double Vault (Low Pier Foundation)', 'asd', '1', '12', '12', 'ASDWDASD', 'asdwdasdadasdwasd', 7, 24, '', '27500', '360', '7000', 'Gcash', '', '34,860.00'),
(53, 'Mark as Done', 13, 'Bautista', 'Splek', 'S', '2024-09-08', '2024-09-08', 0, '2024-04-14', 'Saturday', 'Weekends', '11:00 AM', 'Children Fresh Body', 'Children Vault', 'file1_66dd17571d35f.png', 'file2_66dd17571d365.png', 'file3_66dd17571d367.png', 'file4_66dd17571d369.png', 'file5_66dd17571d36a.png', '', '5', 'Double Vault (Low Pier Foundation)', 'asd', '1', '12', '12', 'ASDWDASD', 'asdwdasdadasdwasd', 6, 6, '', '27500', '90', '6000', 'Gcash', '', '34,090.00'),
(54, 'Mark as Done', 13, 'Bautista', 'John', 'S', '2024-09-08', '2024-09-08', 0, '2024-03-13', 'Friday', 'Weekdays', '11:00 AM', 'Adult Fresh Body', 'Adult Vault', 'file1_66dd630e61f9a.png', 'file2_66dd630e61fa4.png', 'file3_66dd630e61fa7.png', 'file4_66dd630e61faa.png', 'file5_66dd630e61fac.png', '', '5', 'Double Vault (Low Pier Foundation)', 'asd', '1', '12', '12', 'ASDWDASD21312333333', 'asdwdasdadasdwasd', 3, 4, '', '29375', '60', '3000', 'Gcash', '', '32,435.00'),
(56, 'payment', 55, 'Bautista', 'Railleyy', 'S', '2024-09-08', '2024-09-15', 0, '2024-07-17', 'Tuesday', 'Weekdays', '10:00 AM', 'Adult Fresh Body', 'Adult Vault', 'file1_66e6916851ed0.png', 'file2_66e6916851ee6.png', 'file3_66e6916851ee9.png', 'file4_66e6916851eec.png', 'file5_66e6916851eee.png', '', '40', 'Lawn Lot', 'asd', '50', '50', '50', 'ASDWDASD', 'asdwdasdadasdwasd', 12, 12, '', '29375', '180', '12000', 'Gcash', '', '41,555.00'),
(57, 'Declined', 13, 'Bautista', 'Railleys', 'S', '2024-09-02', '2024-09-15', 0, '2024-08-17', 'Tuesday', 'Weekdays', '11:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66e69207cc0fe.png', 'file2_66e69207cc107.png', 'file3_66e69207cc109.png', 'file4_66e69207cc10b.png', 'file5_66e69207cc10d.png', '', '5', 'Lawn Lot', 'asd', '1', '12', '12', 'ASDWDASD', 'asdwdasdadasdwasd', 12, 12, '', '33126', '180', '12000', 'Gcash', '', '45,306.00'),
(59, 'Mark as Done', 55, 'Bautista', 'Railley Nickolei Vince', 'S', '2024-09-08', '2024-09-15', 0, '2024-07-17', 'Tuesday', 'Weekdays', '8:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66e6ed8091378.jpg', 'file2_66e6ed8091554.jpg', 'file3_66e6ed809177d.jpg', 'file4_66e6ed80918ba.jpg', 'file5_66e6ed80919e4.jpg', '', '40', 'Lawn Lot', 'St. Peter', '1', '12', '12', 'ASDWDASD', 'asdwdasdadasdwasd', 10, 15, '', '33126', '225', '10000', 'Gcash', '', '43,351.00'),
(62, 'Mark as Done', 55, 'Bautista', 'Railleyes', 'S', '2024-09-15', '2024-09-15', 0, '2024-08-17', 'Tuesday', 'Weekdays', '1:00 PM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66e7042972628.jpg', 'file2_66e704297262f.jpg', 'file3_66e7042972631.jpg', 'file4_66e7042972633.jpg', 'file5_66e7042972635.jpg', '', '40', 'Lawn Lot', 'St. Peter', '1', '12', '12', 'ASDWDASD21312333333', 'asdwdasdadasdwasd', 6, 12, '', '33126', '180', '6000', 'Gcash', '', '39,306.00'),
(64, 'Mark as Done', 50, 'Bautista', 'Kleks', 'S', '2024-09-16', '2024-09-16', 0, '2024-07-18', 'Wednesday', 'Weekdays', '9:00 AM', 'Adult Fresh Body', 'Adult Vault', 'file1_66e845b4b19d1.jpg', 'file2_66e845b4b19d7.jpg', 'file3_66e845b4b19d9.jpg', 'file4_66e845b4b19da.jpg', 'file5_66e845b4b19dc.jpg', '', '35', 'Lawn Lot', 'asd', '1', '12', '12', 'ASDWDASD', 'asdwdasdadasdwasd', 4, 6, '', '29375', '90', '4000', 'Gcash', '', '33,465.00'),
(65, 'Mark as Done', 50, 'Bautista', 'Hilderasd', 'S', '2024-09-16', '2024-09-16', 0, '2024-08-18', 'Wednesday', 'Weekdays', '10:00 AM', 'Adult Fresh Body', 'Adult Vault', 'file1_66e8476ab6e6a.jpg', 'file2_66e8476ab6e70.jpg', 'file3_66e8476ab6e72.jpg', 'file4_66e8476ab6e73.jpg', 'file5_66e8476ab6e74.jpg', '', '35', 'Lawn Lot', 'asd', '1', '12', '12', 'ASDWDASD', 'asdwdasdadasdwasd', 5, 3, '', '29375', '45', '5000', 'Gcash', '', '34,420.00'),
(74, 'Mark as Done', 50, 'Bautista', 'Railleyeee', 'S', '2024-09-22', '2024-09-22', 0, '2024-09-25', 'Wednesday', 'Weekdays', '9:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66f087755aaa5.jpg', 'file2_66f087755aaab.jpg', 'file3_66f087755aaac.jpg', 'file4_66f087755aaae.jpg', 'file5_66f087755aaaf.jpg', '', '35', 'Lawn Lot', 'Naaruto', '50', '50', '12', 'SKIBIDI DAP DAP', '2 pc chicken with fries', 5, 7, '', '33126', '105', '5000', 'Gcash', '', '38,731.00'),
(76, 'payment', 50, 'Bautista', 'Railley', 'S', '2024-09-22', '2024-09-22', 0, '2024-09-26', 'Thursday', 'Weekdays', '9:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66f092c21fbe0.jpg', 'file2_66f092c21fbee.jpg', 'file3_66f092c21fbf1.jpg', 'file4_66f092c21fbf5.jpg', 'file5_66f092c21fbf7.jpg', '', '35', 'Lawn Lot', 'Naaruto', '50', '50', '12', 'SKIBIDI DAP DAP', '2 pc chicken with fries', 3, 3, '', '33126', '45', '3000', 'Gcash', '', '36,171.00'),
(77, 'payment', 50, 'Bautista', 'Railley', 'S', '2024-09-23', '2024-09-23', 0, '2024-09-27', 'Friday', 'Weekdays', '9:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66f093bdcd155.jpg', 'file2_66f093bdcd15b.jpg', 'file3_66f093bdcd15e.jpg', 'file4_66f093bdcd160.jpg', 'file5_66f093bdcd162.jpg', '', '35', 'Lawn Lot', 'Naaruto', '50', '50', '12', 'SKIBIDI DAP DAP', '2 pc chicken with fries', 4, 6, '', '33126', '90', '4000', 'Gcash', '', '37,216.00'),
(78, 'payment', 50, 'Bautista', 'Railley', 'S', '2024-09-23', '2024-09-23', 0, '2024-09-27', 'Friday', 'Weekdays', '10:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66f09428b4adc.jpg', 'file2_66f09428b4ae3.jpg', 'file3_66f09428b4ae5.jpg', 'file4_66f09428b4ae7.jpg', 'file5_66f09428b4ae8.jpg', '', '35', 'Lawn Lot', 'Naaruto', '50', '50', '12', 'SKIBIDI DAP DAP', '2 pc chicken with fries', 4, 4, '', '33126', '60', '4000', 'Gcash', '', '37,186.00'),
(80, 'Mark as Done', 50, 'Oliveros', 'Zenith', 'Johnathan', '2024-09-24', '2024-09-24', 0, '2024-09-28', 'Saturday', 'Weekends', '9:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66f32ac6e3ccb.png', 'file2_66f32ac6e3cd9.png', 'file3_66f32ac6e3cdc.png', 'file4_66f32ac6e3cdd.png', 'file5_66f32ac6e3ce0.pdf', '', '35', 'Lawn Lot', 'St. Peter', '50', '50', '12', 'SKIBIDI DAP DAP', '2 pc chicken with fries', 5, 7, '', '33126', '105', '5000', 'Gcash', '', '38,231.00'),
(81, 'Mark as Done', 50, 'Bautista', 'Railley', 'S', '2024-09-24', '2024-09-24', 0, '2024-09-28', 'Saturday', 'Weekends', '11:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66f32e2aaa7c7.png', 'file2_66f32e2aaa7e0.png', 'file3_66f32e2aaa7e3.png', 'file4_66f32e2aaa7e5.png', 'file5_66f32e2aaa7e7.png', '', '35', 'Lawn Lot', 'St. Peter', '50', '50', '12', 'SKIBIDI DAP DAP', '2 pc chicken with fries', 4, 6, '', '33126', '90', '4000', 'Gcash', '', '37,216.00'),
(82, 'scheduled', 50, 'Turner', 'William', 'Scott', '2024-09-24', '2024-09-24', 0, '2024-09-27', 'Friday', 'Weekdays', '11:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66f331121caab.png', 'file2_66f331121cabd.png', 'file3_66f331121cac1.png', 'file4_66f331121cac5.png', 'file5_66f331121cac9.png', '', '35', 'Lawn Lot', 'St. Peter', '50', '50', '12', 'The honored One', 'Add cross at the Top right of the Lapida', 4, 5, '', '33126', '75', '4000', 'Gcash', '', '38,701.00'),
(83, 'Pending', 55, 'Garcia', 'Mia', 'Isabella', '2024-09-25', '2024-09-25', 0, '2024-09-29', 'Sunday', 'Weekends', '1:00 PM', 'Adult Fresh Body', 'Oversize Vault', 'file1_66f34e3337eef.pdf', 'file2_66f34e3337ef4.png', 'file3_66f34e3337ef6.png', 'file4_66f34e3337ef7.png', 'file5_66f34e3337ef8.png', '', '40', 'Lawn Lot', 'St. Peter', '50', '50', '12', 'SKIBIDI DAP DAP', '2 pc chicken with fries', 4, 4, '', '33126', '60', '4000', 'Gcash', '', '37,186.00'),
(85, 'Mark as Done', 13, 'Kim', 'William', 'Lucas', '2024-09-25', '2024-09-25', 0, '2024-09-29', 'Sunday', 'Weekends', '9:00 AM', 'Bone', 'Bone Vault', 'file1_66f35536aaa31.png', 'file2_66f35536aaa38.png', 'file3_66f35536aaa39.png', 'file4_66f35536aaa3a.png', 'file5_66f35536aaa3c.png', 'file6_66f35536aaa3d.png', '5', 'Double Vault (Low Pier Foundation)', 'St. Peter', '50', '50', '12', 'The honored One', 'Add cross at the Top right of the Lapida', 4, 6, '', '21250', '90', '4000', 'Gcash', '', '25,340.00'),
(86, 'Mark as Done', 13, 'Bautista', 'Railley', 'S', '2024-10-21', '2024-10-21', 0, '2024-11-04', 'Monday', 'Weekdays', '8:00 AM', 'Children Fresh Body', 'Oversize Vault', 'file1_671e34a50c00a.jpg', 'file2_671e34a50daee.jpg', 'file3_671e34a50daf5.jpg', 'file4_671e34a50daf9.jpg', 'file5_671e34a50dafc.jpg', '', '5', 'Double Vault (Low Pier Foundation)', 'St. Peter', '228', '244', '12', 'SKIBIDI DAP DAP', '2 pc chicken with fries', 7, 10, '', '33126', '150', '7000', 'Metrobank', '', '40,776.00'),
(87, 'payment', 13, 'Bautista', 'Railley', 'Serrato', '2024-10-23', '2024-10-31', 0, '2024-11-05', 'Tuesday', 'Weekdays', '9:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_6723de69b424a.png', 'file2_6723de69b45b9.png', 'file3_6723de69b45ba.png', 'file4_6723de69b45bc.png', 'file5_6723de69b45bd.png', '', '5', 'Double Vault (Low Pier Foundation)', 'St. Peter', '40', '250', '151', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 3, 3, '', '33126', '45', '3000', 'Gcash', '06PMPA000NKML00', '36,171.00'),
(88, 'payment', 13, 'Bautista', 'Nickolei', 'Serrato', '2024-11-01', '2024-11-03', 0, '2024-11-07', 'Thursday', 'Weekdays', '11:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_6726c2b20004c.png', 'file2_6726c2b2001de.png', 'file3_6726c2b2001e0.png', 'file4_6726c2b2001e2.png', 'file5_6726c2b2001e4.png', '', '5', '', 'St. Peter', '4', '6', '10', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 10, 10, '', '33126', '150', '10000', 'Gcash', '', '43,276.00'),
(89, 'Mark as Done', 60, 'Rivers', 'Edward ', 'Thomas', '2020-01-03', '2024-11-03', 4, '2024-11-07', 'Thursday', 'Weekdays', '9:00 AM', 'Children Fresh Body', 'Children Vault', 'file1_6727c9cd3fc30.PNG', 'file2_6727c9cd3fe56.PNG', 'file3_6727c9cd3fe5a.PNG', 'file4_6727c9cd3fe5b.PNG', 'file5_6727c9cd3fe5d.PNG', '', '44', 'Lawn Lot', 'St. Peter', '4', '4', '3', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 5, 10, '', '27500', '150', '5000', 'Gcash', '', '32,650.00'),
(90, 'Mark as Done', 61, 'Palemer', 'Edith', 'Thomas', '2020-01-01', '2024-11-03', 4, '2024-11-14', 'Thursday', 'Weekdays', '9:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_6727d6f33baa2.PNG', 'file2_6727d6f33baa8.PNG', 'file3_6727d6f33baaa.PNG', 'file4_6727d6f33baac.PNG', 'file5_6727d6f33baad.PNG', '', '45', 'Lawn Lot', 'St. Peter', '12', '12', '12', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 4, 5, '', '33126', '75', '4000', 'Gcash', '', '37,201.00'),
(91, 'Mark as Done', 62, 'Holden', 'Quinn', 'Thomas', '2014-01-07', '2024-11-03', 10, '2024-11-07', 'Thursday', 'Weekdays', '2:00 PM', 'Children Fresh Body', 'Children Vault', 'file1_6727da19ecbc4.PNG', 'file2_6727da19ecbd2.png', 'file3_6727da19ecbd5.png', 'file4_6727da19ecbd7.png', 'file5_6727da19ecbdb.png', '', '46', 'Lawn Lot', 'St. Peter', '12', '12', '2', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 5, 8, '', '27500', '120', '5000', 'Gcash', '', '32,620.00'),
(92, 'Mark as Done', 63, 'Lane', 'Wells', 'Margaret', '2024-11-02', '2024-11-03', 0, '2024-11-08', 'Friday', 'Weekdays', '9:00 AM', 'Adult Fresh Body', 'Adult Vault', 'file1_6727e0c7c584b.png', 'file2_6727e0c7c5854.png', 'file3_6727e0c7c5856.png', 'file4_6727e0c7c5859.png', 'file5_6727e0c7c585b.png', '', '47', 'Single Vault (above) w/ .80m base (RF)', 'St. Peter', '12', '12', '12', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 5, 8, '', '29375', '120', '5000', 'Gcash', '', '34,495.00'),
(93, 'Mark as Done', 64, 'Jennings', 'Charles', 'Goodwin', '2024-11-03', '2024-11-03', 0, '2024-11-07', 'Thursday', 'Weekdays', '1:00 PM', 'Children Fresh Body', 'Children Vault', 'file1_6727e6d085701.jpg', 'file2_6727e6d085706.png', 'file3_6727e6d085707.png', 'file4_6727e6d085708.png', 'file5_6727e6d085709.png', '', '48', 'Single Vault (above) w/ .80m base (RF)', 'St. Peter', '12', '2', '3', 'Reflection Of Life', 'Reflection Of Life Solace Estates123', 4, 5, '', '27500', '75', '4000', 'Metrobank', '', '31,575.00'),
(94, 'Mark as Done', 65, 'Brooks', 'Samuel', 'Collins', '2018-01-08', '2024-11-01', 6, '2024-11-14', 'Thursday', 'Weekdays', '10:00 AM', 'Children Fresh Body', 'Adult Vault', 'file1_6727e7d4e6e82.png', 'file2_6727e7d4e6e8c.png', 'file3_6727e7d4e6e8f.png', 'file4_6727e7d4e6e92.png', 'file5_6727e7d4e6e93.png', '', '49', 'Single Vault (above) w/ .80m base (RF)', 'St. Peter', '12', '233', '23', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 2, 1, '', '29375', '15', '2000', 'Gcash', '', '31,390.00'),
(96, 'Mark as Done', 66, 'Everly', 'Liana', 'Astra', '2024-11-02', '2024-11-04', 0, '2024-11-08', 'Friday', 'Weekdays', '11:00 AM', 'Adult Fresh Body', 'Adult Vault', 'file1_6729298754ae5.png', 'file2_6729298754af7.png', 'file3_6729298754afa.png', 'file4_6729298754afc.png', 'file5_6729298754afe.png', '', '50', 'Single Vault (above) w/ .80m base (RF)', 'St. Peter', '1213', '322', '123', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 4, 5, '', '29375', '75', '4000', 'Gcash', '', '33,450.00'),
(97, 'Mark as Done', 67, 'Beatrice', 'Alexander', 'Montgomery', '2024-11-04', '2024-11-05', 0, '2024-11-15', 'Friday', 'Weekdays', '9:00 AM', 'Bone', 'Bone Vault', 'file1_672a553db1d15.png', 'file2_672a553db8590.png', 'file3_672a553db8596.png', 'file4_672a553db8599.png', 'file5_672a553db859a.png', 'file6_672a553db859b.jpg', '51', 'Double Vault (Low Pier Foundation)', 'St. Peter', '32', '12', '123', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 4, 5, '', '21250', '75', '4000', 'Gcash', '', '25,325.00'),
(98, 'Mark as Done', 68, 'Ernesto', 'Ramon', 'Francisco', '2024-11-05', '2024-11-05', 0, '2024-11-15', 'Friday', 'Weekdays', '11:00 AM', 'Adult Fresh Body', 'Adult Vault', 'file1_672a5712ba462.png', 'file2_672a5712ba46e.png', 'file3_672a5712ba470.png', 'file4_672a5712ba473.png', 'file5_672a5712ba475.png', '', '52', 'Double Vault (Low Pier Foundation)', 'St. Peter', '321', '23', '332', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 6, 7, '', '29375', '105', '6000', 'Gcash', '', '35,480.00'),
(99, 'Mark as Done', 69, 'Corazon', 'Pedro', 'Manuel', '1999-02-09', '2024-11-05', 25, '2024-11-13', 'Wednesday', 'Weekdays', '1:00 PM', 'Adult Fresh Body', 'Oversize Vault', 'file1_672a5fa099771.png', 'file2_672a5fa099777.png', 'file3_672a5fa099779.png', 'file4_672a5fa09977a.png', 'file5_672a5fa09977c.png', '', '53', 'Lawn Lot', 'St. Peter', '123', '321', '123', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 4, 7, '', '33126', '105', '4000', 'Gcash', '', '37,231.00'),
(100, 'Mark as Done', 70, 'Jace', 'Brielle', 'Marie', '2024-11-05', '2024-11-05', 0, '2024-11-07', 'Thursday', 'Weekdays', '3:00 PM', 'Adult Fresh Body', 'Adult Vault', 'file1_672a60f074620.png', 'file2_672a60f074628.png', 'file3_672a60f074629.jpg', 'file4_672a60f07462b.png', 'file5_672a60f07462d.png', '', '54', 'Lawn Lot', 'St. Peter', '123', '221', '32', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 5, 6, '', '29375', '90', '5000', 'Metrobank', '', '34,965.00'),
(101, 'Mark as Done', 71, 'Kalinaw', 'Jade', 'Halina', '2024-11-05', '2024-11-05', 0, '2024-11-09', 'Saturday', 'Weekends', '9:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_672a61ed618f7.png', 'file2_672a61ed6190d.png', 'file3_672a61ed61910.png', 'file4_672a61ed61913.png', 'file5_672a61ed61915.png', '', '55', 'Lawn Lot', 'St. Peter', '32', '12', '321', 'Reflection Of Life', 'Reflection Of Life Solace Estates', 3, 6, '', '33126', '90', '3000', 'Gcash', '', '36,216.00'),
(102, 'Mark as Done', 64, 'Sulivan', 'John', 'Damian', '2024-11-18', '2024-11-26', 0, '2024-12-02', 'Monday', 'Weekdays', '10:00 AM', 'Adult Fresh Body', 'Oversize Vault', 'file1_6745bd6bea6aa.png', 'file2_6745bd6bea80c.png', 'file3_6745bd6bea80e.png', 'file4_6745bd6bea810.png', 'file5_6745bd6bea811.png', '', '48', 'Single Vault (above) w/ .80m base (RF)', 'Naaruto', '50', '50', '50', 'The honored One', 'Add cross at the Top right of the Lapida', 4, 7, '', '33126', '105', '4000', 'Gcash', '', '37,231.00'),
(103, 'scheduled', 76, 'Walker', 'Ethan', 'Zenith', '2017-01-02', '2024-12-02', 7, '2024-12-14', 'Saturday', 'Weekends', '8:00 AM', 'Adult Fresh Body', 'Adult Vault', 'file1_674f2837f0607.png', 'file2_674f2837f0803.png', 'file3_674f2837f0806.png', 'file4_674f2837f0807.png', 'file5_674f2837f0808.png', '', '66', 'Double Vault (Low Pier Foundation)', 'St. Peter', '50', '6', '8', 'The honored One', 'Add cross at the Top right of the Lapida', 2, 13, '', '29375', '195', '2000', 'Gcash', '', '31,570.00'),
(104, 'scheduled', 76, 'Igrid', 'Liam', 'Bennete', '2020-01-02', '2024-12-03', 4, '2024-12-14', 'Saturday', 'Weekends', '9:00 AM', 'Bone', 'Children Vault', 'file1_674f28ee3dadc.png', 'file2_674f28ee3dae8.png', 'file3_674f28ee3daeb.png', 'file4_674f28ee3daed.png', 'file5_674f28ee3daef.png', 'file6_674f28ee3daf1.png', '68', 'Double Vault (Low Pier Foundation)', 'St. Peter', '5', '50', '50', 'The honored One', 'Add cross at the Top right of the Lapida', 2, 10, '', '27500', '150', '2000', 'Gcash', '', '29,650.00'),
(105, 'Mark as Done', 76, 'Oliveros', 'John Andrei', 'E', '2024-12-13', '2024-12-13', 0, '2024-12-21', 'Saturday', 'Weekends', '1:00 PM', 'Children Fresh Body', 'Adult Vault', 'file1_67611f5f8618c.jpg', 'file2_67611f5f86191.pdf', 'file3_67611f5f86194.jpg', 'file4_67611f5f86195.pdf', 'file5_67611f5f86197.jpg', '', '66', 'Double Vault (Low Pier Foundation)', 'St. Peter', '50', '50', '12', 'SKIBIDI DAP DAP', 'Add cross at the Top right of the Lapida', 10, 10, '', '29375', '150', '10000', 'Gcash', '06PMPA000NKML00', '40,025.00');

-- --------------------------------------------------------

--
-- Table structure for table `interment_price`
--

CREATE TABLE `interment_price` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(250) NOT NULL,
  `PRICE` varchar(250) NOT NULL,
  `WEEKDAYS` varchar(250) NOT NULL,
  `WEEKENDS` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interment_price`
--

INSERT INTO `interment_price` (`ID`, `NAME`, `PRICE`, `WEEKDAYS`, `WEEKENDS`) VALUES
(1, 'Oversize Vault', '33,126.00', '33,126.00', '33,850.00'),
(2, 'Adult Vault', '29,375.00', '29,375.00', '30,000.00'),
(3, 'Children Vault', '27,500.00', '27,500.00', '28,125.00'),
(4, 'Bone Vault', '21,250.00', '21,250.00', '21,875.00'),
(5, 'Riding Adult Vault', '11,875.00', '11,875.00', '11,875.00'),
(6, 'Riding Children Vault', '10,000.00', '10,000.00', '10,000.00'),
(7, 'Riding Bone Vault/URN', '9,062.00', '9,062.00', '9,062.00'),
(8, 'Bone Rider', '1,875.00', '1,875.00', '1,875.00'),
(9, 'Bone Lifting', '6,500.00', '6,500.00', '6,500.00'),
(10, 'Chair', '15.00', '15.00', '15.00'),
(11, 'Tent', '1,000.00', '1,000.00', '1,000.00'),
(12, 'URN', '6,500.00', '6,500.00', '6,500.00'),
(14, 'Infant Vault', '21,250.00', '21,250.00', '21,875.00'),
(15, 'Reschedule Fee', '500.00', '500.00', '500.00'),
(16, 'NOTARIAL_FEE', '250.99', '250.99', '250.99'),
(17, 'TRANSFER_FEE', '3,100.99', '3,100.99', '3,100.99');

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `IO_ID` int(11) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `TYPE_OF_LOT` varchar(100) NOT NULL,
  `SLOT` int(11) NOT NULL,
  `LOT1` varchar(100) NOT NULL,
  `LOT2` varchar(100) NOT NULL,
  `LOT3` varchar(100) NOT NULL,
  `LOT4` varchar(100) NOT NULL,
  `LOT5` varchar(100) NOT NULL,
  `LOT6` varchar(100) NOT NULL,
  `LOT7` varchar(100) NOT NULL,
  `LOT8` varchar(100) NOT NULL,
  `LOT9` varchar(100) NOT NULL,
  `LOT10` varchar(100) NOT NULL,
  `LOT11` varchar(100) NOT NULL,
  `LOT12` varchar(100) NOT NULL,
  `LOT13` varchar(100) NOT NULL,
  `LOT14` varchar(100) NOT NULL,
  `LOT15` varchar(100) NOT NULL,
  `LOT16` varchar(100) NOT NULL,
  `LOT17` varchar(100) NOT NULL,
  `LOT18` varchar(100) NOT NULL,
  `LOT19` varchar(100) NOT NULL,
  `LOT20` varchar(100) NOT NULL,
  `LOT21` varchar(100) NOT NULL,
  `LOT22` varchar(100) NOT NULL,
  `LOT23` varchar(100) NOT NULL,
  `LOT24` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`IO_ID`, `EMAIL`, `TYPE_OF_LOT`, `SLOT`, `LOT1`, `LOT2`, `LOT3`, `LOT4`, `LOT5`, `LOT6`, `LOT7`, `LOT8`, `LOT9`, `LOT10`, `LOT11`, `LOT12`, `LOT13`, `LOT14`, `LOT15`, `LOT16`, `LOT17`, `LOT18`, `LOT19`, `LOT20`, `LOT21`, `LOT22`, `LOT23`, `LOT24`) VALUES
(5, '', 'court4', 5, 'COS-SEC1-H84', 'COS-SEC1-G82', 'COS-SEC1-H83', 'COS-SEC1-G81', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(35, 'lincon@gmail.com', 'lawnlot', 20, 'EVGM-SEC3-J10', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(39, 'seigesulivan06@gmail.com', 'court4', 0, 'COS-SEC1-H82', 'COS-SEC1-G80', 'COS-SEC1-H81', 'COS-SEC1-G79', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(40, 'johnandrei.delavega0101@gmail.com', 'lawnlot', 2, 'EVGM-SEC3-R1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(43, 'johnandrei.delavega0101@gmail.com', 'estate12', 0, 'SOL-SEC1-A1', 'SOL-SEC1-B4', 'SOL-SEC1-A2', 'SOL-SEC1-B5', 'SOL-SEC1-A3', 'SOL-SEC1-B6', 'SOL-SEC1-A4', 'SOL-SEC1-B7', 'SOL-SEC1-A5', 'SOL-SEC1-B8', 'SOL-SEC1-A6', 'SOL-SEC1-B9', '', '', '', '', '', '', '', '', '', '', '', ''),
(44, 'railley@gmail.com', 'lawnlot', 2, 'EVGM-SEC8-E1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(45, 'sasuke@gmail.com', 'lawnlot', 2, 'EVGM-SEC20-A5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(46, 'sakura@gmail.com', 'lawnlot', 2, 'EVGM-SEC19-A5', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(47, 'anthony@gmail.com', 'estate12', 2, 'PE-SEC3-A2', 'PE-SEC3-A3', 'PE-SEC3-A4', 'PE-SEC3-A5', 'PE-SEC3-A6', 'PE-SEC3-A7', 'PE-SEC3-B10', 'PE-SEC3-B9', 'PE-SEC3-B8', 'PE-SEC3-B7', 'PE-SEC3-B6', 'PE-SEC3-B5', '', '', '', '', '', '', '', '', '', '', '', ''),
(48, 'draco@gmail.com', 'estate12', 4, 'PE-SEC3-D22', 'PE-SEC3-D23', 'PE-SEC3-D24', 'PE-SEC3-D25', 'PE-SEC3-D26', 'PE-SEC3-D27', 'PE-SEC3-C24', 'PE-SEC3-C25', 'PE-SEC3-C26', 'PE-SEC3-C27', 'PE-SEC3-C28', 'PE-SEC3-C29', '', '', '', '', '', '', '', '', '', '', '', ''),
(49, 'henry@gmail.com', 'estate12', 2, 'PE-SEC4-B27', 'PE-SEC4-B28', 'PE-SEC4-B29', 'PE-SEC4-B30', 'PE-SEC4-B31', 'PE-SEC4-B32', 'PE-SEC4-A28', 'PE-SEC4-A29', 'PE-SEC4-A3', 'PE-SEC4-A30', 'PE-SEC4-A31', 'PE-SEC4-A33', '', '', '', '', '', '', '', '', '', '', '', ''),
(50, 'lincon@gmail.com', 'estate12', 6, 'SOL-SEC2-A17', 'SOL-SEC2-A16', 'SOL-SEC2-A15', 'SOL-SEC2-A14', 'SOL-SEC2-B17', 'SOL-SEC2-B18', 'SOL-SEC2-B19', 'SOL-SEC2-B20', 'SOL-SEC2-A18', 'SOL-SEC2-B21', 'SOL-SEC2-A19', 'SOL-SEC2-B22', '', '', '', '', '', '', '', '', '', '', '', ''),
(51, 'alexander@gmail.com', 'court4', 1, 'COS-SEC3-E16', 'COS-SEC3-E15', 'COS-SEC3-D15', 'COS-SEC3-D14', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(52, 'charlotte@gmail.com', 'court4', 2, 'COS-SEC4-G15', 'COS-SEC4-H15', 'COS-SEC4-H16', 'COS-SEC4-G14', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(53, 'lourdes@gmail.com', 'lawnlot', 4, 'TOL-SEC10-F30', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(54, 'gabriel@gmail.com', 'lawnlot', 2, 'TOL-SEC9-S13', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(55, '', 'lawnlot', 4, 'TOL-SEC1-F3', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(56, 'railley@gmail.com', 'court4', 0, 'COS-SEC4-F110', 'COS-SEC4-F109', 'COS-SEC4-E110', 'COS-SEC4-E109', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(63, '', 'court4', 0, 'COS-SEC4-H111', 'COS-SEC4-G110', 'COS-SEC4-H110', 'COS-SEC4-G109', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(65, '', 'court4', 0, 'COS-SEC1-H80', 'COS-SEC1-G78', 'COS-SEC1-H79', 'COS-SEC1-G77', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(66, '', 'court4', 2, 'COS-SEC1-H76', 'COS-SEC1-G74', 'COS-SEC1-H75', 'COS-SEC1-G73', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(67, '', 'court4', 0, 'COS-SEC1-H72', 'COS-SEC1-G70', 'COS-SEC1-H71', 'COS-SEC1-G69', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(68, '', 'court8', 0, 'COS-SEC1-H67', 'COS-SEC1-G66', 'COS-SEC1-H66', 'COS-SEC1-G65', 'COS-SEC1-H65', 'COS-SEC1-G64', 'COS-SEC1-H64', 'COS-SEC1-G63', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment_interment`
--

CREATE TABLE `payment_interment` (
  `PAYMENT_ID` int(11) NOT NULL,
  `STATUS` varchar(255) NOT NULL,
  `INTERMENT_ID` int(11) NOT NULL,
  `ACCOUNT_ID` int(11) DEFAULT NULL,
  `FRONTDESK_ID` int(11) NOT NULL,
  `PAYMENT_OPTION` varchar(255) NOT NULL,
  `TOTAL_PRICE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_interment`
--

INSERT INTO `payment_interment` (`PAYMENT_ID`, `STATUS`, `INTERMENT_ID`, `ACCOUNT_ID`, `FRONTDESK_ID`, `PAYMENT_OPTION`, `TOTAL_PRICE`) VALUES
(11, 'submitted', 44, 21, 17, 'Gcash', '27500'),
(12, 'submitted', 45, 13, 17, 'Gcash', '21250'),
(13, 'submitted', 46, 13, 17, 'Gcash', '27500'),
(14, 'submitted', 47, 13, 17, 'Gcash', '29375'),
(15, 'submitted', 49, 13, 17, 'Gcash', '27500'),
(17, 'submitted', 51, 13, 17, 'Metrobank', '29375'),
(18, 'submitted', 52, 13, 17, 'Gcash', '27500'),
(19, 'submitted', 53, 13, 17, 'Gcash', '27500'),
(20, 'submitted', 54, 13, 17, 'Gcash', '29375'),
(21, 'submitted', 55, 39, 17, 'Gcash', '29375'),
(22, 'submitted', 56, 55, 17, 'Gcash', '29375'),
(23, 'submitted', 59, 55, 17, 'Gcash', '33126'),
(25, 'submitted', 62, 55, 17, 'Gcash', '33126'),
(26, 'submitted', 63, 50, 17, 'Gcash', '29375'),
(28, 'submitted', 64, 50, 17, 'Gcash', '29375'),
(29, 'submitted', 65, 50, 17, 'Gcash', '29375'),
(30, 'submitted', 66, 27, 17, 'Gcash', '29375'),
(33, 'submitted', 71, 27, 27, 'Gcash', '29375'),
(34, 'submitted', 73, 27, 27, 'Gcash', '33126'),
(35, 'submitted', 74, 50, 50, 'Gcash', '33126'),
(41, 'submitted', 80, 50, 17, 'Gcash', '33126'),
(43, 'submitted', 82, 50, 17, 'Gcash', '33126'),
(44, 'submitted', 85, 13, 17, 'Gcash', '21250'),
(45, 'submitted', 86, 13, 17, 'Metrobank', '33126'),
(46, 'pending', 88, 13, 17, 'Gcash', '33126'),
(47, 'submitted', 89, 60, 17, 'Gcash', '27500'),
(48, 'submitted', 90, 61, 17, 'Gcash', '33126'),
(49, 'submitted', 91, 62, 17, 'Gcash', '27500'),
(50, 'submitted', 92, 63, 17, 'Gcash', '29375'),
(51, 'submitted', 93, 64, 17, 'Metrobank', '27500'),
(52, 'submitted', 94, 65, 17, 'Gcash', '29375'),
(53, 'submitted', 95, 66, 17, 'Gcash', '33126'),
(54, 'submitted', 96, 66, 17, 'Gcash', '29375'),
(55, 'submitted', 97, 67, 17, 'Gcash', '21250'),
(56, 'submitted', 98, 68, 17, 'Gcash', '29375'),
(57, 'submitted', 99, 69, 17, 'Gcash', '33126'),
(58, 'submitted', 100, 70, 17, 'Metrobank', '29375'),
(59, 'submitted', 101, 71, 17, 'Gcash', '33126'),
(60, 'submitted', 102, 64, 17, 'Gcash', '33126'),
(61, 'submitted', 104, 76, 17, 'Gcash', '27500'),
(62, 'submitted', 103, 76, 17, 'Gcash', '29375'),
(63, 'pending', 87, 13, 17, 'Gcash', '33126'),
(64, 'submitted', 105, 76, 17, 'Gcash', '29375');

-- --------------------------------------------------------

--
-- Table structure for table `payment_tor`
--

CREATE TABLE `payment_tor` (
  `ID` int(11) NOT NULL,
  `STATUS` varchar(100) NOT NULL,
  `TOR_ID` int(11) NOT NULL,
  `ACCOUNT_ID` int(100) NOT NULL,
  `FRONTDESK_ID` int(100) NOT NULL,
  `PAYMENT_OPTION` varchar(100) NOT NULL,
  `TOTAL_PRICE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_tor`
--

INSERT INTO `payment_tor` (`ID`, `STATUS`, `TOR_ID`, `ACCOUNT_ID`, `FRONTDESK_ID`, `PAYMENT_OPTION`, `TOTAL_PRICE`) VALUES
(4, 'submitted', 9, 27, 17, 'Gcash', '3,351.98'),
(5, 'submitted', 10, 27, 17, 'Gcash', '3,351.98'),
(6, 'pending', 12, 27, 17, 'Gcash', '3,351.98'),
(7, 'submitted', 13, 27, 17, 'Gcash', '3,351.98'),
(8, 'submitted', 14, 50, 17, 'Gcash', '3,351.98'),
(9, 'submitted', 15, 13, 17, 'Gcash', '3,351.98'),
(10, 'reschedule payment', 17, 66, 17, 'Gcash', '3,351.98'),
(11, 'submitted', 18, 71, 17, 'Gcash', '3,351.98'),
(12, 'submitted', 354, 76, 17, 'Gcash', '3,351.98');

-- --------------------------------------------------------

--
-- Table structure for table `proof_of_payments`
--

CREATE TABLE `proof_of_payments` (
  `PROOF_ID` int(11) NOT NULL,
  `STATUS` varchar(255) NOT NULL,
  `PAYMENT_NUMBER` int(11) DEFAULT NULL,
  `INTERMENT_ORDER` int(11) DEFAULT NULL,
  `PREPARED_BY` varchar(255) DEFAULT NULL,
  `REFERENCE_NUMBER` varchar(255) DEFAULT NULL,
  `FILE_PATH` varchar(255) DEFAULT NULL,
  `RESCHEDULE_FILE` varchar(999) NOT NULL,
  `RESCHEDULE_REFERENCE` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proof_of_payments`
--

INSERT INTO `proof_of_payments` (`PROOF_ID`, `STATUS`, `PAYMENT_NUMBER`, `INTERMENT_ORDER`, `PREPARED_BY`, `REFERENCE_NUMBER`, `FILE_PATH`, `RESCHEDULE_FILE`, `RESCHEDULE_REFERENCE`) VALUES
(9, 'completed', 8, 41, 'Railley Serrato Bautista', '58588585858', 'proofofpayment/9/9.jpg', '', ''),
(10, 'completed', 11, 44, 'Railley Serrato Bautista', '12355555', 'proofofpayment/10/10.png', '', ''),
(11, 'completed', 11, 44, 'Railley Serrato Bautista', '500062', 'proofofpayment/11/11.jpg', '', ''),
(12, 'completed', 12, 45, 'Railley Serrato Bautista', '500062', 'proofofpayment/12/12.jpg', '', ''),
(13, 'completed', 13, 46, 'Railley Serrato. Bautista', '500062', 'proofofpayment/13/13.png', '', ''),
(14, 'completed', 15, 49, 'Railley Serrato. Bautista', '500062', 'proofofpayment/14/14.jpg', 'proofofpayment/14/reference_14.png', '56565656565656'),
(15, 'completed', 14, 47, 'Railley Serrato. Bautista', '500062', 'proofofpayment/15/15.jpg', 'proofofpayment/15/reference_15.jpg', '2323231344'),
(17, 'completed', 17, 51, 'Railley Serrato. Bautista', '500062', 'proofofpayment/17/17.jpg', 'proofofpayment/17/reference_17.png', '500062'),
(20, 'completed', 19, 53, 'Railley Serrato. Bautista', '500062', 'proofofpayment/20/20.png', 'proofofpayment/20/reference_20.jpg', '500062'),
(21, 'completed', 18, 52, 'Railley Serrato. Bautista', '56565656565656', 'proofofpayment/21/21.jpg', 'proofofpayment/21/reference_21.jpg', 'awawawawaw'),
(22, 'completed', 20, 54, 'Railley Serrato. Bautista', '500062', 'proofofpayment/22/22.jpg', '', ''),
(23, 'completed', 21, 55, 'Railley Serrato. Bautista', '1233333', 'proofofpayment/23/23.jpg', '', ''),
(24, 'completed', 23, 59, 'Railley Serrato. Bautista', '500062', 'proofofpayment/24/24.png', '', ''),
(28, 'completed', 25, 62, 'Railley Serrato. Bautista', '500062', 'proofofpayment/28/28.jpg', '', ''),
(29, 'completed', 25, 62, 'Railley Serrato. Bautista', '500062', 'proofofpayment/29/29.jpg', '', ''),
(30, 'completed', 25, 62, 'Railley Serrato. Bautista', '123123123', 'proofofpayment/30/30.jpg', '', ''),
(31, 'completed', 25, 62, 'Railley Serrato. Bautista', '500062', 'proofofpayment/31/31.jpg', '', ''),
(32, 'completed', 26, 63, 'Railley Serrato. Bautista', '500062', 'proofofpayment/32/32.jpg', '', ''),
(33, 'completed', 28, 64, 'Railley Serrato. Bautista', '500062', 'proofofpayment/33/33.jpg', '', ''),
(34, 'completed', 29, 65, 'Railley Serrato. Bautista', 'asdasdwa', 'proofofpayment/34/34.jpg', '', ''),
(35, 'completed', 30, 66, 'Railley Serrato. Bautista', '500062', 'proofofpayment/35/35.jpg', 'proofofpayment/35/reference_35.jpg', 'asdasdas'),
(38, 'completed', 33, 71, 'Princess Sophia Myshl Bautista Olayvar', '898989899', 'proofofpayment/38/38.jpg', '', ''),
(39, 'completed', 33, 71, 'Princess Sophia Myshl Bautista Olayvar', '12312312', 'proofofpayment/39/39.jpg', '', ''),
(40, 'completed', 33, 71, 'Princess Sophia Myshl Bautista Olayvar', '787878788', 'proofofpayment/40/40.jpg', '', ''),
(41, 'completed', 35, 74, 'Railley S Bautista', 'asdasdasd', 'proofofpayment/41/41.jpg', 'proofofpayment/41/reference_41.jpg', 'asdasdasd'),
(43, 'completed', 41, 80, 'Railley Serrato. Bautista', '569925', 'proofofpayment/43/43.png', '', ''),
(44, 'completed', 42, 81, 'Railley Serrato. Bautista', '555213', 'proofofpayment/44/44.png', '', ''),
(45, 'completed', 43, 82, 'Railley Serrato. Bautista', '56565656565656', 'proofofpayment/45/45.png', 'proofofpayment/45/reference_45.png', '56565656565656'),
(46, 'completed', 44, 85, 'Railley Serrato. Bautista', '56565656565656', 'proofofpayment/46/46.png', '', ''),
(47, 'completed', 45, 86, 'Railley Serrato. Bautista', '93165', 'proofofpayment/47/47.jpg', 'proofofpayment/47/reference_47.png', '4545454554'),
(48, 'completed', 47, 89, 'Railley Serrato. Bautista', '195959', 'proofofpayment/48/48.PNG', '', ''),
(49, 'completed', 48, 90, 'Railley Serrato. Bautista', '93165', 'proofofpayment/49/49.jpg', '', ''),
(50, 'completed', 49, 91, 'Railley Serrato. Bautista', '93165', 'proofofpayment/50/50.PNG', '', ''),
(51, 'completed', 50, 92, 'Railley Serrato. Bautista', '12', 'proofofpayment/51/51.PNG', '', ''),
(52, 'completed', 51, 93, 'Railley Serrato. Bautista', '332123', 'proofofpayment/52/52.png', '', ''),
(53, 'completed', 52, 94, 'Railley Serrato. Bautista', '122', 'proofofpayment/53/53.jpg', '', ''),
(54, 'completed', 53, 95, 'Railley Serrato. Bautista', '93165', 'proofofpayment/54/54.PNG', '', ''),
(55, 'completed', 53, 95, 'Railley Serrato. Bautista', '93165', 'proofofpayment/55/55.png', '', ''),
(56, 'completed', 54, 96, 'Railley Serrato. Bautista', '93165', 'proofofpayment/56/56.PNG', '', ''),
(57, 'completed', 54, 96, 'Railley Serrato. Bautista', '1231233', 'proofofpayment/57/57.png', '', ''),
(58, 'completed', 55, 97, 'Railley Serrato. Bautista', '93165', 'proofofpayment/58/58.png', '', ''),
(59, 'completed', 56, 98, 'Railley Serrato. Bautista', '93165', 'proofofpayment/59/59.png', '', ''),
(60, 'completed', 57, 99, 'Railley Serrato. Bautista', '12333', 'proofofpayment/60/60.jpg', '', ''),
(61, 'completed', 58, 100, 'Railley Serrato. Bautista', '93165', 'proofofpayment/61/61.png', 'proofofpayment/61/reference_61.png', '4545454554'),
(62, 'completed', 59, 101, 'Railley Serrato. Bautista', '93165', 'proofofpayment/62/62.png', '', ''),
(63, 'completed', 60, 102, 'Railley Serrato. Bautista', '123', 'proofofpayment/63/63.png', '', ''),
(64, 'completed', 61, 104, 'Railley Serrato. Bautista', '33232', 'proofofpayment/64/64.png', '', ''),
(65, 'completed', 62, 103, 'Railley Serrato. Bautista', '3232', 'proofofpayment/65/65.png', '', ''),
(66, 'completed', 64, 105, 'Railley Serrato. Bautista', '56565656565656', 'proofofpayment/66/66.jpg', 'proofofpayment/66/reference_66.jpg', '56565656565656');

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `REQUEST_ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `FIRSTNAME` varchar(100) NOT NULL,
  `MIDDLENAME` varchar(100) NOT NULL,
  `LASTNAME` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(1000) NOT NULL,
  `CONTACT` varchar(100) NOT NULL,
  `CERTIFICATE` varchar(100) NOT NULL,
  `ADDRESS` varchar(10100) NOT NULL,
  `TYPE_OF_REQUEST` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `ACCOUNT_ID` int(11) NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `LASTNAME` varchar(100) NOT NULL,
  `FIRSTNAME` varchar(100) NOT NULL,
  `MIDDLENAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  `CONTACT` varchar(50) NOT NULL,
  `ADDRESS` longtext NOT NULL,
  `POSITION` varchar(60) NOT NULL,
  `PROFILE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`ACCOUNT_ID`, `NAME`, `EMAIL`, `LASTNAME`, `FIRSTNAME`, `MIDDLENAME`, `PASSWORD`, `CONTACT`, `ADDRESS`, `POSITION`, `PROFILE`) VALUES
(2, 'administrator', 'admin@gmail.com', 'Bautista', 'Railley', 'Serrato', 'admin', '09479531831', '', 'Administrator', ''),
(13, 'Zenith B. Bautista', 'zenith@gmail.com', 'Bautista', 'Zenith', 'B', 'Railley123@', '09284948360', 'Serrato Comp. San Jose ext. Brgy. San Isidro, Antipolo City ', 'Previous Lot Owner', '13.jpg'),
(17, 'Railley Serrato. Bautista', 'zenith123@gmail.com', 'Bautista', 'Railley', 'Serrato', 'Railley123@', '09284948360', 'San Jose', 'Front Desk', '17.jpg'),
(26, 'Railley S Bautista', 'naruto@gmail.com', 'Bautista', 'Railley', 'S', 'Railley123@', '09284948360', 'San Jose', 'Visitor', ''),
(27, 'Princess Sophia Myshl Bautista Olayvar', 'nickoleibautista123@gmail.com', 'Olayvar', 'Princess Sophia Myshl', 'Bautista', 'Railley123@', '09284948360', 'San Jose', 'Previous Lot Owner', ''),
(50, 'Skrit S. Bautista', 'dmccntprovidence@gmail.com', 'Bautista', 'Skrit', 'S', 'Railley123@', '09284948360', 'San Jose', 'Previous Lot Owner', ''),
(54, 'Seige s sdddddd', 'seigesulivan06@gmail.com', 'sdddddd', 'Seige', 's', 'Railley123@', '09199325792', 'San Jose', 'Lot Owner', ''),
(55, 'John Andrei S Dela Vega', 'johnandrei.delavega0101@gmail.com', 'Dela Vega', 'John Andrei', 'S', 'Railley123@', '09284948360', 'San Jose', 'Lot Owner', ''),
(58, 'Demo Account Capstone', 'railleynickoleivincebautista@gmail.com', 'Capstone', 'Demo', 'Account', 'Railley123@', '09284948360', 'San Jose', 'Lot Owner', ''),
(59, 'Railley S Bautista', 'blenks@gmail.com', 'Bautista', 'Railley', 'S', 'Railley123@', '09284948360', 'San Jose', 'Visitor', ''),
(60, 'Railley Serrato Bautista', 'railley@gmail.com', 'Bautista', 'Railley', 'Serrato', 'Railley123@', '09284948360', 'Antipolo City', 'Lot Owner', ''),
(61, 'Ellis Clarke Casey', 'sasuke@gmail.com', 'Casey', 'Ellis', 'Clarke', 'Railley123@', '09479531831', 'Antipolo City', 'Lot Owner', ''),
(62, 'Ellis Bishop Florence', 'sakura@gmail.com', 'Florence', 'Ellis', 'Bishop', 'Railley123@', '09284948360', 'Antipolo City', 'Lot Owner', ''),
(63, 'Porter Curry Bailey', 'anthony@gmail.com', 'Bailey', 'Porter', 'Curry', 'Railley123@', '09284948360', 'Antipolo City', 'Lot Owner', ''),
(64, 'Benjamin Foster Draco', 'draco@gmail.com', 'Draco', 'Benjamin', 'Foster', 'Railley123@', '09284948360', 'Antipolo City', 'Lot Owner', ''),
(65, 'Henry Langston. Langston', 'henry@gmail.com', 'Langston', 'Henry', 'Langston', 'Railley123@', '09284948360', 'Antipolo City', 'Lot Owner', ''),
(67, 'Alexander Beatrice Montgomery', 'alexander@gmail.com', 'Montgomery', 'Alexander', 'Beatrice', 'Railley123@', '09479531831', 'Antipolo City', 'Lot Owner', ''),
(68, 'Charlotte Whitmore Harrington', 'charlotte@gmail.com', 'Harrington', 'Charlotte', 'Whitmore', 'Railley123@', '09479531831', 'Antipolo City', 'Lot Owner', ''),
(69, 'Lourdes Amado Victoria', 'lourdes@gmail.com', 'Victoria', 'Lourdes', 'Amado', 'Railley123@', '09479531831', 'Antipolo City', 'Lot Owner', ''),
(70, 'Gabriel James Elyon', 'gabriel@gmail.com', 'Elyon', 'Gabriel', 'James', 'Railley123@', '09479531831', 'Antipolo City', 'Lot Owner', ''),
(71, 'Mika Inigo Zara', 'zara@gmail.com', 'Zara', 'Mika', 'Inigo', 'Railley123@', '09479531831', 'Antipolo City', 'Previous Lot Owner', ''),
(72, 'Luningning Kalinaw Kai', 'kalinaw@gmail.com', 'Kai', 'Luningning', 'Kalinaw', 'Railley123@', '09479531831', 'Antipolo City', 'Visitor', ''),
(76, 'Zenith E Oliveros', 'nickoleibautista@gmail.com', 'Oliveros', 'Zenith', 'E', 'Railley123@', '09284948360', 'San Jose', 'Previous Lot Owner', ''),
(77, 'John Andrei Garcia Sanchez', 'nickolei123@gmail.com', 'Sanchez', 'John Andrei', 'Garcia', 'Railley123@', '09479531831', 'San Jose', 'Lot Owner', ''),
(83, 'Zenith E Oliveros', 'lincon@gmail.com', 'Oliveros', 'Zenith', 'E', 'Railley123@', '09479531831', 'San Jose', 'Lot Owner', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `ID` int(11) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `POSITION` varchar(40) NOT NULL,
  `ACTION` varchar(100) NOT NULL,
  `DATETIME` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`ID`, `EMAIL`, `POSITION`, `ACTION`, `DATETIME`) VALUES
(1, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-06'),
(2, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-07'),
(3, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-07'),
(4, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-07'),
(5, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-07'),
(6, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-07'),
(7, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-07'),
(8, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-08'),
(9, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-08'),
(10, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-08'),
(11, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-08'),
(12, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-08'),
(13, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-08'),
(14, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-08'),
(15, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-08'),
(16, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(17, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(18, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(19, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(20, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(21, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(22, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(23, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(24, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(25, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(26, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(27, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(28, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(29, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(30, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(31, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(32, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(33, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(34, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(35, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(36, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(37, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(38, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(39, 'kosnics@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(40, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(41, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(42, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(43, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(44, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(45, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(46, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(47, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(48, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(49, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(50, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(51, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(52, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-09'),
(53, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-09'),
(54, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-11'),
(55, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-11'),
(56, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-12'),
(57, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-12'),
(58, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-12'),
(59, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-12'),
(60, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-12'),
(61, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-12'),
(62, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-04-12'),
(63, 'railley@gmail.com', 'Customer', 'Logged in', '2024-04-12'),
(64, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-18'),
(65, 'railley@gmail.com', 'Customer', 'Logged in', '2024-05-18'),
(66, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-18'),
(67, 'railley@gmail.com', 'Customer', 'Logged in', '2024-05-18'),
(68, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-19'),
(69, 'nickoleibautista@gmail.com', '', 'Logged in', '2024-05-19'),
(70, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-05-19'),
(71, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-19'),
(72, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-19'),
(73, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-19'),
(74, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-19'),
(75, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-20'),
(76, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-20'),
(77, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-20'),
(78, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-20'),
(79, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-21'),
(80, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-21'),
(81, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-21'),
(82, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-21'),
(83, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-21'),
(84, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-22'),
(85, 'nickoleibautista@gmal.com', 'Visitor', 'Logged in', '2024-05-22'),
(86, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-22'),
(87, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-22'),
(88, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-22'),
(89, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-22'),
(90, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-22'),
(91, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-22'),
(92, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-22'),
(93, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-22'),
(94, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-23'),
(95, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-23'),
(96, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-23'),
(97, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-23'),
(98, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-23'),
(99, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-23'),
(100, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-24'),
(101, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-24'),
(102, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-24'),
(103, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-24'),
(104, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-24'),
(105, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-24'),
(106, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-29'),
(107, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-29'),
(108, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-29'),
(109, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-29'),
(110, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-30'),
(111, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-30'),
(112, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-31'),
(113, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-31'),
(114, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-31'),
(115, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-31'),
(116, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-05-31'),
(117, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-05-31'),
(118, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-05-31'),
(119, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-06-01'),
(120, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-06-01'),
(121, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-06-01'),
(122, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-06-01'),
(123, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-06-01'),
(124, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-06-02'),
(125, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-06-02'),
(126, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-06-02'),
(127, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-06-02'),
(128, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-06-02'),
(129, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-06-02'),
(130, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-06-02'),
(131, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-06-02'),
(132, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-06-02'),
(133, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-06-02'),
(134, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-06-02'),
(135, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-06-02'),
(136, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-06-03'),
(137, 'nickoleibautista3232@gmal.com', 'Lot Owner', 'Logged in', '2024-06-03'),
(138, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-06-03'),
(139, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-06-03'),
(140, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-07-24'),
(141, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-07-24'),
(142, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-07-24'),
(143, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-07-30'),
(144, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-07-30'),
(145, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-07-31'),
(146, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-07-31'),
(147, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-07-31'),
(148, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-07-31'),
(149, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-07-31'),
(150, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-01'),
(151, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-01'),
(152, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-01'),
(153, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-01'),
(154, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-01'),
(155, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-02'),
(156, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-02'),
(157, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-04'),
(158, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-05'),
(159, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-05'),
(160, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-05'),
(161, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-05'),
(162, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-05'),
(163, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-05'),
(164, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-05'),
(165, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-05'),
(166, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-07'),
(167, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-07'),
(168, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-08'),
(169, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-08'),
(170, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-08'),
(171, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-09'),
(172, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-09'),
(173, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-09'),
(174, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-09'),
(175, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-10'),
(176, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-10'),
(177, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-10'),
(178, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-10'),
(179, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-11'),
(180, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-12'),
(181, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-13'),
(182, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-13'),
(183, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-13'),
(184, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-20'),
(185, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-21'),
(186, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-21'),
(187, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-23'),
(188, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-27'),
(189, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-28'),
(190, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-28'),
(191, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-29'),
(192, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-29'),
(193, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-29'),
(194, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-29'),
(195, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-29'),
(196, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-08-29'),
(197, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-29'),
(198, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-29'),
(199, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-29'),
(200, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-29'),
(201, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-08-29'),
(202, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-08-31'),
(203, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-01'),
(204, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-01'),
(205, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-01'),
(206, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-02'),
(207, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-02'),
(208, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-02'),
(209, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-02'),
(210, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-03'),
(211, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-05'),
(212, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-06'),
(213, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-06'),
(214, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-06'),
(215, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-08'),
(216, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-08'),
(217, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-08'),
(218, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-08'),
(219, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-08'),
(220, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-08'),
(221, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-08'),
(222, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-08'),
(223, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-08'),
(224, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-09'),
(225, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-10'),
(226, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-10'),
(227, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-10'),
(228, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-10'),
(229, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-11'),
(230, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-12'),
(231, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-12'),
(232, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-13'),
(233, 'tiktokgenzen@gmail.com', 'Lot Owner', 'Logged in', '2024-09-13'),
(234, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-13'),
(235, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-13'),
(236, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-13'),
(237, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-14'),
(238, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-15'),
(239, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-15'),
(240, 'johnandrei.delavega0101@gmail.com', 'Lot Owner', 'Logged in', '2024-09-15'),
(241, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-15'),
(242, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-15'),
(243, 'railleynickoleivincebautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-15'),
(244, 'johnandrei.delavega0101@gmail.com', 'Lot Owner', 'Logged in', '2024-09-15'),
(245, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-16'),
(246, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-16'),
(247, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-16'),
(248, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-16'),
(249, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-16'),
(250, 'dmccntprovidence@gmail.com', 'Lot Owner', 'Logged in', '2024-09-16'),
(251, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-16'),
(252, 'naruto@gmail.com', 'Visitor', 'Logged in', '2024-09-17'),
(253, 'dmccntprovidence@gmail.com', 'Lot Owner', 'Logged in', '2024-09-17'),
(254, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-17'),
(255, 'dmccntprovidence@gmail.com', 'Lot Owner', 'Logged in', '2024-09-17'),
(256, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-17'),
(257, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-17'),
(258, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-17'),
(259, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-17'),
(260, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-17'),
(261, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-18'),
(262, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-18'),
(263, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-18'),
(264, 'naruto@gmail.com', 'Visitor', 'Logged in', '2024-09-19'),
(265, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-19'),
(266, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-20'),
(267, 'johnandrei.delavega0101@gmail.com', 'Lot Owner', 'Logged in', '2024-09-20'),
(268, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-20'),
(269, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-20'),
(270, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-21'),
(271, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-21'),
(272, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-21'),
(273, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-21'),
(274, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-21'),
(275, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-22'),
(276, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-22'),
(277, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-22'),
(278, 'nickoleibautista@gmail.com', '', 'Logged in', '2024-09-22'),
(279, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-09-22'),
(280, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-09-22'),
(281, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-09-22'),
(282, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-09-22'),
(283, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-22'),
(284, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-22'),
(285, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-22'),
(286, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-22'),
(287, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-22'),
(288, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-23'),
(289, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-23'),
(290, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-09-23'),
(291, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-09-23'),
(292, 'dmccntprovidence@gmail.com', 'Lot Owner', 'Logged in', '2024-09-23'),
(293, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-23'),
(294, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-23'),
(295, 'dmccntprovidence@gmail.com', 'Lot Owner', 'Logged in', '2024-09-23'),
(296, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-23'),
(297, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-24'),
(298, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-24'),
(299, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-24'),
(300, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-24'),
(301, 'dmccntprovidence@gmail.com', 'Lot Owner', 'Logged in', '2024-09-24'),
(302, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-09-24'),
(303, 'dmccntprovidence@gmail.com', 'Lot Owner', 'Logged in', '2024-09-24'),
(304, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-09-25'),
(305, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-25'),
(306, 'dmccntprovidence@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-09-25'),
(307, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-09-25'),
(308, 'johnandrei.delavega0101@gmail.com', 'Lot Owner', 'Logged in', '2024-09-25'),
(309, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-09-25'),
(310, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-10-16'),
(311, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-10-17'),
(312, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-10-17'),
(313, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-23'),
(314, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-24'),
(315, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-24'),
(316, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-24'),
(317, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-25'),
(318, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-25'),
(319, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-26'),
(320, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-26'),
(321, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-26'),
(322, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-26'),
(323, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-27'),
(324, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-27'),
(325, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-10-27'),
(326, 'railleynickoleivincebautista@gmail.com', 'Lot Owner', 'Logged in', '2024-10-27'),
(327, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-10-27'),
(328, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-10-27'),
(329, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-27'),
(330, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-27'),
(331, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-10-27'),
(332, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-27'),
(333, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-27'),
(334, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-28'),
(335, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-29'),
(336, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-31'),
(337, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-31'),
(338, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-10-31'),
(339, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-11-01'),
(340, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-11-02'),
(341, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-11-02'),
(342, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-11-02'),
(343, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-02'),
(344, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-11-03'),
(345, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-03'),
(346, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-03'),
(347, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-11-03'),
(348, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-03'),
(349, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-11-03'),
(350, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-11-03'),
(351, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-11-04'),
(352, 'railley@gmail.com', 'Lot Owner', 'Logged in', '2024-11-04'),
(353, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-04'),
(354, 'sasuke@gmail.com', 'Lot Owner', 'Logged in', '2024-11-04'),
(355, 'sakura@gmail.com', 'Lot Owner', 'Logged in', '2024-11-04'),
(356, 'anthony@gmail.com', 'Lot Owner', 'Logged in', '2024-11-04'),
(357, 'draco@gmail.com', 'Lot Owner', 'Logged in', '2024-11-04'),
(358, 'henry@gmail.com', 'Lot Owner', 'Logged in', '2024-11-04'),
(359, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-05'),
(360, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-05'),
(361, 'zenith@gmail.com', 'Lot Owner', 'Logged in', '2024-11-05'),
(362, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-11-05'),
(363, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-11-05'),
(364, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-11-05'),
(365, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-11-05'),
(366, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-11-05'),
(367, 'blenks@gmail.com', 'Visitor', 'Logged in', '2024-11-05'),
(368, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-11-05'),
(369, 'blenks@gmail.com', 'Visitor', 'Logged in', '2024-11-05'),
(370, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-05'),
(371, 'zenith@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-11-05'),
(372, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-11-05'),
(373, 'zenith@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-11-05'),
(374, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-11-05'),
(375, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-05'),
(376, 'railleynickoleivincebautista@gmail.com', 'Lot Owner', 'Logged in', '2024-11-06'),
(377, 'alexander@gmail.com', 'Lot Owner', 'Logged in', '2024-11-06'),
(378, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-06'),
(379, 'zara@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-11-06'),
(380, 'kalinaw@gmail.com', 'Visitor', 'Logged in', '2024-11-06'),
(381, 'railleynickoleivincebautista@gmail.com', 'Lot Owner', 'Logged in', '2024-11-06'),
(382, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-11-06'),
(383, 'zenith@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-11-26'),
(384, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-11-26'),
(385, 'railley@gmail.com', 'Lot Owner', 'Logged in', '2024-11-26'),
(386, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-11-26'),
(387, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-12-02'),
(388, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-12-02'),
(389, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-12-03'),
(390, 'railley@gmail.com', 'Lot Owner', 'Logged in', '2024-12-03'),
(391, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-12-03'),
(392, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-12-03'),
(393, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-03'),
(394, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-12-03'),
(395, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-12-04'),
(396, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-12-04'),
(397, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-04'),
(398, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-12-05'),
(399, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-12-05'),
(400, 'lincon@gmail.com', 'Lot Owner', 'Logged in', '2024-12-05'),
(401, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-07'),
(402, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-12-07'),
(403, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-12-07'),
(404, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-07'),
(405, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-09'),
(406, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-12-10'),
(407, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-10'),
(408, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-11'),
(409, 'zenith123@gmail.com', 'Front Desk', 'Logged in', '2024-12-11'),
(410, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-12'),
(411, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-12'),
(412, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-12'),
(413, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-12'),
(414, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-12'),
(415, 'nickoleibautista@gmail.com', 'Lot Owner', 'Logged in', '2024-12-17'),
(416, 'admin@gmail.com', 'Administrator', 'Logged in', '2024-12-17'),
(417, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-12-17'),
(418, 'nickoleibautista@gmail.com', 'Previous Lot Owner', 'Logged in', '2024-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaction`
--

CREATE TABLE `tbl_transaction` (
  `TRANSACTION_ID` int(11) NOT NULL,
  `ORDER_ID` varchar(1000) NOT NULL,
  `ORDER_TYPE` varchar(1000) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `CUSTOMER_NAME` varchar(1000) NOT NULL,
  `PREPARED_BY` varchar(1000) NOT NULL,
  `PAYMENT_PRICE` varchar(1000) NOT NULL,
  `INVOICE_FILE` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaction`
--

INSERT INTO `tbl_transaction` (`TRANSACTION_ID`, `ORDER_ID`, `ORDER_TYPE`, `CUSTOMER_ID`, `CUSTOMER_NAME`, `PREPARED_BY`, `PAYMENT_PRICE`, `INVOICE_FILE`) VALUES
(9, '41', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato Bautista', '23,295.00', 'transactions/41.pdf'),
(10, '44', 'Interment', 21, 'Railley Serrato Bautista', 'Railley Serrato Bautista', '31,530.00', 'transactions/44.pdf'),
(11, '45', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato Bautista', '24,295.00', 'transactions/45.pdf'),
(12, '46', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '31,545.00', 'transactions/46.pdf'),
(13, '49', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '32,560.00', 'transactions/49.pdf'),
(14, '47', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '35,465.00', 'transactions/47.pdf'),
(15, '50', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '38,965.00', 'transactions/50.pdf'),
(31, '51', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '39,935.00', 'transactions/51.pdf'),
(32, '50', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '38,965.00', 'transactions/50.pdf'),
(33, '53', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '34,090.00', 'transactions/53.pdf'),
(34, '52', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '34,860.00', 'transactions/52.pdf'),
(35, '54', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '32,435.00', 'transactions/54.pdf'),
(36, '55', 'Interment', 39, 'Demo Account S Uzumaki', 'Railley Serrato. Bautista', '35,570.00', 'transactions/55.pdf'),
(37, '59', 'Interment', 55, 'John Andrei S Dela Vega', 'Railley Serrato. Bautista', '43,351.00', 'transactions/59.pdf'),
(38, '62', 'Interment', 55, 'John Andrei S Dela Vega', 'Railley Serrato. Bautista', '39,306.00', 'transactions/62.pdf'),
(40, '64', 'Interment', 50, 'Railley S Bautista', 'Railley Serrato. Bautista', '33,465.00', 'transactions/64.pdf'),
(41, '64', 'Interment', 50, 'Railley S Bautista', 'Railley Serrato. Bautista', '33,465.00', 'transactions/64.pdf'),
(42, '64', 'Interment', 50, 'Railley S Bautista', 'Railley Serrato. Bautista', '33,465.00', 'transactions/64.pdf'),
(43, '65', 'Interment', 50, 'Railley S Bautista', 'Railley Serrato. Bautista', '34,420.00', 'transactions/65.pdf'),
(44, '66', 'Interment', 27, 'Princess Sophia Myshl Bautista Olayvar', 'Railley Serrato. Bautista', '36,510.00', 'transactions/66.pdf'),
(70, '4', 'Transfer of Right', 27, 'Princess Sophia Myshl Bautista Olayvar', 'Railley Serrato. Bautista', '3,351.98', 'torrequest/4/4.pdf'),
(72, '9', 'Transfer of Right', 27, 'Princess Sophia Myshl Bautista Olayvar', 'Railley Serrato. Bautista', '3,851.98', 'torrequest/9reschedule.pdf'),
(73, '10', 'Transfer of Right', 27, 'Princess Sophia Myshl Bautista Olayvar', 'Railley Serrato. Bautista', '3,004.00', 'torrequest/10reschedule.pdf'),
(74, '13', 'Transfer of Right', 27, 'Princess Sophia Myshl Bautista Olayvar', 'Railley Serrato. Bautista', '3,351.98', 'torrequest/13/13.pdf'),
(75, '71', 'Interment', 27, 'Princess Sophia Myshl Bautista Olayvar', 'Princess Sophia Myshl Bautista Olayvar', '33,495.00', 'transactions/71.pdf'),
(76, '74', 'Interment', 50, 'Railley S Bautista', 'Railley S Bautista', '38,731.00', 'transactions/74.pdf'),
(77, '75', 'Interment', 50, 'Railley S Bautista', 'Railley S Bautista', '32,480.00', 'transactions/75.pdf'),
(78, '80', 'Interment', 50, 'Skrit S. Bautista', 'Railley Serrato. Bautista', '38,231.00', 'transactions/80.pdf'),
(79, '81', 'Interment', 50, 'Skrit S. Bautista', 'Railley Serrato. Bautista', '37,216.00', 'transactions/81.pdf'),
(80, '81', 'Interment', 50, 'Skrit S. Bautista', 'Railley Serrato. Bautista', '37,216.00', 'transactions/81.pdf'),
(81, '81', 'Interment', 50, 'Skrit S. Bautista', 'Railley Serrato. Bautista', '37,216.00', 'transactions/81.pdf'),
(82, '82', 'Interment', 50, 'Skrit S. Bautista', 'Railley Serrato. Bautista', '38,701.00', 'transactions/82.pdf'),
(83, '14', 'Transfer of Right', 50, 'Skrit S Bautista', 'Railley Serrato. Bautista', '3,851.98', 'torrequest/14reschedule.pdf'),
(84, '85', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '25,340.00', 'transactions/85.pdf'),
(85, '86', 'Interment', 13, 'Zenith B. Bautista', 'Railley Serrato. Bautista', '40,776.00', 'transactions/86.pdf'),
(86, '15', 'Transfer of Right', 13, 'Zenith B Bautista', 'Railley Serrato. Bautista', '3,851.98', 'torrequest/15reschedule.pdf'),
(87, '89', 'Interment', 60, 'Railley Serrato Bautista', 'Railley Serrato. Bautista', '32,650.00', 'transactions/89.pdf'),
(88, '90', 'Interment', 61, 'Ellis Clarke Casey', 'Railley Serrato. Bautista', '37,201.00', 'transactions/90.pdf'),
(89, '91', 'Interment', 62, 'Ellis Bishop Florence', 'Railley Serrato. Bautista', '32,620.00', 'transactions/91.pdf'),
(90, '92', 'Interment', 63, 'Porter Curry Bailey', 'Railley Serrato. Bautista', '34,495.00', 'transactions/92.pdf'),
(91, '93', 'Interment', 64, 'Benjamin Foster Draco', 'Railley Serrato. Bautista', '31,575.00', 'transactions/93.pdf'),
(92, '94', 'Interment', 65, 'Henry Langston Langston', 'Railley Serrato. Bautista', '31,390.00', 'transactions/94.pdf'),
(93, '95', 'Interment', 66, 'Drake Dark Greese', 'Railley Serrato. Bautista', '37,186.00', 'transactions/95.pdf'),
(94, '95', 'Interment', 66, 'Drake Dark Greese', 'Railley Serrato. Bautista', '37,186.00', 'transactions/95.pdf'),
(95, '96', 'Interment', 66, 'Drake Dark Greese', 'Railley Serrato. Bautista', '33,450.00', 'transactions/96.pdf'),
(96, '17', 'Transfer of Right', 66, 'Drake Dark Greese', 'Railley Serrato. Bautista', '3,351.98', 'torrequest/17/17.pdf'),
(97, '97', 'Interment', 67, 'Alexander Beatrice Montgomery', 'Railley Serrato. Bautista', '25,325.00', 'transactions/97.pdf'),
(98, '98', 'Interment', 68, 'Charlotte Whitmore Harrington', 'Railley Serrato. Bautista', '35,480.00', 'transactions/98.pdf'),
(99, '99', 'Interment', 69, 'Lourdes Amado Victoria', 'Railley Serrato. Bautista', '37,231.00', 'transactions/99.pdf'),
(100, '100', 'Interment', 70, 'Gabriel James Elyon', 'Railley Serrato. Bautista', '34,965.00', 'transactions/100.pdf'),
(101, '101', 'Interment', 71, 'Mika Inigo Zara', 'Railley Serrato. Bautista', '36,216.00', 'transactions/101.pdf'),
(102, '18', 'Transfer of Right', 71, 'Mika Inigo Zara', 'Railley Serrato. Bautista', '3,351.98', 'torrequest/18/18.pdf'),
(103, '102', 'Interment', 64, 'Benjamin Foster Draco', 'Railley Serrato. Bautista', '37,231.00', 'transactions/102.pdf'),
(104, '104', 'Interment', 76, 'Zenith E Oliveros', 'Railley Serrato. Bautista', '29,650.00', 'transactions/104.pdf'),
(105, '103', 'Interment', 76, 'Zenith E Oliveros', 'Railley Serrato. Bautista', '31,570.00', 'transactions/103.pdf'),
(106, '105', 'Interment', 76, 'Zenith E Oliveros', 'Railley Serrato. Bautista', '40,025.00', 'transactions/105.pdf'),
(107, '354', 'Transfer of Right', 76, 'Zenith E Oliveros', 'Railley Serrato. Bautista', '3,351.98', 'torrequest/354/354.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tor_proof_of_payments`
--

CREATE TABLE `tor_proof_of_payments` (
  `PROOF_ID` int(11) NOT NULL,
  `STATUS` varchar(255) NOT NULL,
  `PAYMENT_NUMBER` int(11) NOT NULL,
  `TOR_ID` int(11) NOT NULL,
  `PREPARED_BY` varchar(250) NOT NULL,
  `REFERENCE_NUMBER` varchar(100) NOT NULL,
  `FILE_PATH` varchar(255) NOT NULL,
  `RESCHEDULE_FILE` varchar(255) NOT NULL,
  `RESCHEDULE_REFERENCE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tor_proof_of_payments`
--

INSERT INTO `tor_proof_of_payments` (`PROOF_ID`, `STATUS`, `PAYMENT_NUMBER`, `TOR_ID`, `PREPARED_BY`, `REFERENCE_NUMBER`, `FILE_PATH`, `RESCHEDULE_FILE`, `RESCHEDULE_REFERENCE`) VALUES
(6, 'completed', 4, 9, 'Railley Serrato. Bautista', '072133', 'TORproofofpayment/6/6.jpg', 'proofofpayment/6/reference_6.jpg', '456456456546'),
(7, 'completed', 5, 10, 'Railley Serrato. Bautista', '123', 'TORproofofpayment/7/7.jpg', 'proofofpayment/7/reference_7.jpg', '123123123123123'),
(8, 'declined', 6, 12, 'Railley Serrato. Bautista', 'wswswswsws', 'TORproofofpayment/8/8.jpg', '', ''),
(15, 'completed', 8, 14, 'Railley Serrato. Bautista', 'asdasdasd', 'TORproofofpayment/15/15.png', 'proofofpayment/15/reference_15.png', '1233333'),
(16, 'completed', 9, 15, 'Railley Serrato. Bautista', '93165', 'TORproofofpayment/16/16.PNG', 'proofofpayment/16/reference_16.PNG', '4545454554'),
(17, 'reschedule payment', 10, 17, 'Railley Serrato. Bautista', '93165', 'TORproofofpayment/17/17.PNG', '', ''),
(18, 'reschedule payment', 10, 17, 'Railley Serrato. Bautista', '93165', 'TORproofofpayment/18/18.png', '', ''),
(19, 'completed', 11, 18, 'Railley Serrato. Bautista', '2123', 'TORproofofpayment/19/19.png', '', ''),
(20, 'completed', 12, 354, 'Railley Serrato. Bautista', '56565656565656', 'TORproofofpayment/20/20.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_of_rights`
--

CREATE TABLE `transfer_of_rights` (
  `ID` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `STATUS` varchar(100) NOT NULL,
  `TRANSFEROR_NAME` varchar(1000) NOT NULL,
  `TRANSFEROR_STATUS` varchar(100) NOT NULL,
  `TRANSFEROR_SPOUSE` varchar(1000) NOT NULL,
  `TRANSFEROR_ADDRESS` varchar(1000) NOT NULL,
  `TRANSFEREE_NAME` varchar(1000) NOT NULL,
  `TRANSFEREE_STATUS` varchar(100) NOT NULL,
  `TRANSFEREE_SPOUSE` varchar(1000) NOT NULL,
  `TRANSFEREE_ADDRESS` varchar(1000) NOT NULL,
  `LOCATION_ID` int(11) NOT NULL,
  `LOT_DESCRIPTION` varchar(1000) NOT NULL,
  `TYPE_OF_LOT` varchar(100) NOT NULL,
  `CONTRACT_PRICE` varchar(1000) NOT NULL,
  `DATE_OF_TRANSFER` varchar(100) NOT NULL,
  `DAY_OF_TRANSFER` varchar(100) NOT NULL,
  `TIME_OF_TRANSFER` varchar(1000) NOT NULL,
  `PAYMENT_OPTION` varchar(40) NOT NULL,
  `TRANSFEROR_FILE1` varchar(1000) NOT NULL,
  `TRANSFEROR_FILE2` varchar(1000) NOT NULL,
  `TRANSFEREE_FILE1` varchar(1000) NOT NULL,
  `TRANSFEREE_FILE2` varchar(1000) NOT NULL,
  `TOR_PDF` varchar(100) NOT NULL,
  `TOTAL_PRICE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_of_rights`
--

INSERT INTO `transfer_of_rights` (`ID`, `CUSTOMER_ID`, `STATUS`, `TRANSFEROR_NAME`, `TRANSFEROR_STATUS`, `TRANSFEROR_SPOUSE`, `TRANSFEROR_ADDRESS`, `TRANSFEREE_NAME`, `TRANSFEREE_STATUS`, `TRANSFEREE_SPOUSE`, `TRANSFEREE_ADDRESS`, `LOCATION_ID`, `LOT_DESCRIPTION`, `TYPE_OF_LOT`, `CONTRACT_PRICE`, `DATE_OF_TRANSFER`, `DAY_OF_TRANSFER`, `TIME_OF_TRANSFER`, `PAYMENT_OPTION`, `TRANSFEROR_FILE1`, `TRANSFEROR_FILE2`, `TRANSFEREE_FILE1`, `TRANSFEREE_FILE2`, `TOR_PDF`, `TOTAL_PRICE`) VALUES
(9, 27, 'reschedule payment', 'Princess Sophia Myshl Bautista Olayvar', 'Married', 'Railley S Bautista', 'San Jose', 'Railley S Bautista', 'Married', 'Railley S Bautista', 'San Jose', 12, 'SOL Section - 1 -  A - 1 to SOL-Section1-B9', 'Estate (12 Lots)', 'Ph 15,151 (FIFTEEN THOUSAND ONE HUNDRED FIFTY-ONE PESOS ONLY)', '2024-09-25', 'Wednesday', '8:00 AM', 'Gcash', '', '', '', '', 'torrequest/9/9.pdf', '351.98'),
(10, 27, 'Mark as Done', 'Princess Sophia Myshl Bautista Olayvar', 'Married', 'Railley S Bautista', 'San Jose', 'Railley S Bautista', 'Married', 'Railley S Bautista', 'San Jose', 12, 'SOL Section - 1 -  A - 1 to SOL-Section1-B9', 'Estate (12 Lots)', 'Ph 75,000 (SEVENTY-FIVE THOUSAND PESOS ONLY)', '2024-09-28', 'Saturday', '10:00 AM', 'Gcash', '', '', '', '', 'torrequest/10/10.pdf', '3,004.00'),
(12, 27, 'payment', 'Princess Sophia Myshl Bautista Olayvar', 'Married', 'Railley S Bautista', 'San Jose', 'Railley S Bautista', 'Married', 'Railley S Bautista', 'San Jose', 12, 'SOL Section - 1 -  A - 1 to SOL-Section1-B9', 'Estate (12 Lots)', 'Ph 11,000 (ELEVEN THOUSAND PESOS ONLY)', '2024-09-24', 'Tuesday', '8:00 AM', 'Gcash', '', '', '', '', 'torrequest/12/12.pdf', '3,351.98'),
(13, 27, 'reschedule payment', 'Princess Sophia Myshl Bautista Olayvar  ', 'Married', 'Railley S Bautista  ', 'Railley S Bautista', 'Railley S Bautista  ', 'Married', 'Railley S Bautista  ', 'San Jose', 12, 'SOL Section - 1 -  A - 1 to SOL-Section1-B9', 'Estate (12 Lots)', 'Ph 150,000 (ONE HUNDRED FIFTY THOUSAND PESOS ONLY)', '2024-09-25', 'Wednesday', '10:00 AM', 'Gcash', '', '', '', '', 'torrequest/13/13.pdf', '3,351.98'),
(14, 50, 'Mark as Done', 'Skrit S Bautista', 'Married', 'Ella Marie Thompson', 'San Jose', 'Liam Alexander Rodriguez', 'Married', 'Noah Michael Patel', 'San Jose Antipolo City', 35, 'Evergreen Memories -  Section - 3 -  J - 10', 'Lawn Lot', 'Ph 200,000 (TWO HUNDRED  THOUSAND PESOS ONLY)', '2024-09-28', 'Saturday', '1:00 PM', 'Gcash', '', '', '', '', 'torrequest/14/14.pdf', '3,851.98'),
(15, 13, 'Mark as Done', 'Zenith B Bautista', 'Married', 'Farniesse Gladise Bautista', 'Serrato Comp. San Jose ext. Brgy. San Isidro, Antipolo City ', 'Casca Friar Serpico', 'Married', 'Fugisaki Hayate Grices', 'Antipolo City', 5, 'Court of Serenity -  Section - 1 -  H - 84 to COS-Section1-G81', 'Court (4 Lots)', 'Ph 115,202 (ONE HUNDRED FIFTEEN THOUSAND TWO HUNDRED TWO PESOS ONLY)', '2024-11-14', 'Thursday', '8:00 AM', 'Gcash', '', '', '', '', 'torrequest/15/15.pdf', '3,851.98'),
(16, 13, 'Declined', 'Zenith B Bautista', 'Married', 'Grace Gladise Bautista', 'Serrato Comp. San Jose ext. Brgy. San Isidro, Antipolo City ', 'Farniese Friar Serpico', 'Married', 'Ragser Greese Grand', 'Antipolo City', 5, 'Court of Serenity -  Section - 1 -  H - 84 to COS-Section1-G81', 'Court (4 Lots)', 'Ph 150,000 (ONE HUNDRED FIFTY THOUSAND PESOS ONLY)', '2024-11-07', 'Thursday', '10:00 AM', 'Gcash', '', '', '', '', 'torrequest/16/16.pdf', '3,351.98'),
(17, 66, 'Mark as Done', 'Drake Dark Greese  ', 'Single', '    ', '  ', 'Farniese Friar Serpico  ', 'Single', '    ', 'Antipolo City', 50, 'Solace Estates -  Section - 2 -  A - 17 to SOL-Section2-B22', 'Estate (12 Lots)', 'Ph 150,000 (ONE HUNDRED FIFTY THOUSAND PESOS ONLY)', '2024-11-09', 'Saturday', '8:00 AM', 'Gcash', '', '', '', '', 'torrequest/17/17.pdf', '3,351.98'),
(18, 71, 'Mark as Done', 'Mika Inigo Zara', 'Married', 'Farniesse Gladise Bautista', 'Antipolo City', 'Farniese Friar Serpico', 'Married', 'Fugisaki Greese Grices', 'Antipolo City', 55, 'Tapestry of Life -  Section - 1 -  F - 3', 'Lawn Lot', 'Ph 150,000 (ONE HUNDRED FIFTY THOUSAND PESOS ONLY)', '2024-11-08', 'Friday', '10:00 AM', 'Gcash', '', '', '', '', 'torrequest/18/18.pdf', '3,351.98'),
(354, 76, 'Mark as Done', 'Zenith E Oliveros', 'Single', '  ', 'San Jose', 'Zenith E Oliveros', 'Married', 'Zenith E Oliveros', 'San Jose', 63, 'Court of Serenity -  Section - 4 -  H - 111 to COS-Section4-G109', 'Court (8 Lots)', 'Ph 150,000 (ONE HUNDRED FIFTY THOUSAND PESOS ONLY)', '2024-12-21', 'Saturday', '10:00 AM', 'Gcash', 'transferor_file1.pdf', 'transferor_file2.pdf', 'transferee_file1.pdf', 'transferee_file2.pdf', 'torrequest/354/354.pdf', '3,351.98');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `burials`
--
ALTER TABLE `burials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interment_forms`
--
ALTER TABLE `interment_forms`
  ADD PRIMARY KEY (`INTERMENTFORM_ID`);

--
-- Indexes for table `interment_price`
--
ALTER TABLE `interment_price`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`IO_ID`);

--
-- Indexes for table `payment_interment`
--
ALTER TABLE `payment_interment`
  ADD PRIMARY KEY (`PAYMENT_ID`);

--
-- Indexes for table `payment_tor`
--
ALTER TABLE `payment_tor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `proof_of_payments`
--
ALTER TABLE `proof_of_payments`
  ADD PRIMARY KEY (`PROOF_ID`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`REQUEST_ID`);

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`ACCOUNT_ID`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  ADD PRIMARY KEY (`TRANSACTION_ID`);

--
-- Indexes for table `tor_proof_of_payments`
--
ALTER TABLE `tor_proof_of_payments`
  ADD PRIMARY KEY (`PROOF_ID`);

--
-- Indexes for table `transfer_of_rights`
--
ALTER TABLE `transfer_of_rights`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `burials`
--
ALTER TABLE `burials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- AUTO_INCREMENT for table `interment_forms`
--
ALTER TABLE `interment_forms`
  MODIFY `INTERMENTFORM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `interment_price`
--
ALTER TABLE `interment_price`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `IO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `payment_interment`
--
ALTER TABLE `payment_interment`
  MODIFY `PAYMENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `payment_tor`
--
ALTER TABLE `payment_tor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `proof_of_payments`
--
ALTER TABLE `proof_of_payments`
  MODIFY `PROOF_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `REQUEST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT for table `tbl_transaction`
--
ALTER TABLE `tbl_transaction`
  MODIFY `TRANSACTION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tor_proof_of_payments`
--
ALTER TABLE `tor_proof_of_payments`
  MODIFY `PROOF_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `transfer_of_rights`
--
ALTER TABLE `transfer_of_rights`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
