-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pon 17. kvě 2021, 13:26
-- Verze serveru: 10.4.6-MariaDB
-- Verze PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `kurzy`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `kurz`
--

CREATE TABLE `kurz` (
  `idKurz` int(11) NOT NULL,
  `nazev` varchar(45) DEFAULT NULL,
  `pocet_mist` int(11) DEFAULT NULL,
  `popis` text DEFAULT NULL,
  `cena` tinytext DEFAULT NULL,
  `misto` tinytext DEFAULT NULL,
  `uzavreni` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE `uzivatel` (
  `idUzivatel` int(11) NOT NULL,
  `heslo` tinytext DEFAULT NULL,
  `jmeno` varchar(45) DEFAULT NULL,
  `prijmeni` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `funkce` tinytext DEFAULT NULL,
  `kurz_idKurz` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `kurz`
--
ALTER TABLE `kurz`
  ADD PRIMARY KEY (`idKurz`);

--
-- Klíče pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  ADD PRIMARY KEY (`idUzivatel`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `kurz`
--
ALTER TABLE `kurz`
  MODIFY `idKurz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
  MODIFY `idUzivatel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
