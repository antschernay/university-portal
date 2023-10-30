-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Úpraveno: 5. 11. 2020, 10:40
-- Verze serveru: 10.1.9-MariaDB
-- Verze PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `vydap_projekt`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `mistnosti`
--

CREATE TABLE `mistnosti` (
  `zkratka_mistnosti` varchar(5) COLLATE utf8_czech_ci NOT NULL,
  `popis` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `kapacita` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `pedagogove`
--

CREATE TABLE `pedagogove` (
  `kod_pedagoga` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `jmeno` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `tituly_pred_jmenem` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `tituly_za_jmenem` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(20) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


-- --------------------------------------------------------

--
-- Struktura tabulky `pedagogove_predmety`
--

CREATE TABLE `pedagogove_predmety` (
  `kod_pedagoga` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `zkratka_predmetu` varchar(5) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `predmety`
--

CREATE TABLE `predmety` (
  `zkratka_predmetu` varchar(5) COLLATE utf8_czech_ci NOT NULL,
  `nazev` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `pocet_kreditu` smallint(6) NOT NULL,
  `pocet_hodin_prednasek` smallint(6) NOT NULL,
  `pocet_hodin_cviceni` smallint(6) NOT NULL,
  `ukonceni` varchar(2) COLLATE utf8_czech_ci NOT NULL,
  `anotace` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `studenti`
--

CREATE TABLE `studenti` (
  `kod_studenta` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `jmeno` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `prijmeni` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(20) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `studenti_predmety`
--

CREATE TABLE `studenti_predmety` (
  `kod_studenta` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `zkratka_predmetu` varchar(5) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `vypsane_terminy`
--

CREATE TABLE `vypsane_terminy` (
  `id_terminu` int(11) NOT NULL,
  `zkratka_mistnosti` varchar(5) COLLATE utf8_czech_ci NOT NULL,
  `kod_pedagoga` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `zkratka_predmetu` varchar(5) COLLATE utf8_czech_ci NOT NULL,
  `datum_cas` datetime NOT NULL,
  `max_pocet_prihlasenych` smallint(6) NOT NULL,
  `poznamka` varchar(200) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


-- --------------------------------------------------------

--
-- Struktura tabulky `vysledky`
--

CREATE TABLE `vysledky` (
  `id_vysledku` smallint(6) NOT NULL,
  `popis` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `typ` varchar(2) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `zapsane_terminy`
--

CREATE TABLE `zapsane_terminy` (
  `id_terminu` int(11) NOT NULL,
  `kod_studenta` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `id_vysledku` smallint(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `mistnosti`
--
ALTER TABLE `mistnosti`
  ADD PRIMARY KEY (`zkratka_mistnosti`);

--
-- Klíče pro tabulku `pedagogove`
--
ALTER TABLE `pedagogove`
  ADD PRIMARY KEY (`kod_pedagoga`);

--
-- Klíče pro tabulku `pedagogove_predmety`
--
ALTER TABLE `pedagogove_predmety`
  ADD PRIMARY KEY (`kod_pedagoga`,`zkratka_predmetu`),
  ADD KEY `zkratka_predmetu` (`zkratka_predmetu`);

--
-- Klíče pro tabulku `predmety`
--
ALTER TABLE `predmety`
  ADD PRIMARY KEY (`zkratka_predmetu`);

--
-- Klíče pro tabulku `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`kod_studenta`);

--
-- Klíče pro tabulku `studenti_predmety`
--
ALTER TABLE `studenti_predmety`
  ADD PRIMARY KEY (`kod_studenta`,`zkratka_predmetu`),
  ADD KEY `zkratka_predmetu` (`zkratka_predmetu`);

--
-- Klíče pro tabulku `vypsane_terminy`
--
ALTER TABLE `vypsane_terminy`
  ADD PRIMARY KEY (`id_terminu`),
  ADD KEY `id_terminu` (`id_terminu`,`zkratka_mistnosti`,`kod_pedagoga`,`zkratka_predmetu`,`datum_cas`,`max_pocet_prihlasenych`,`poznamka`),
  ADD KEY `zkratka_mistnosti` (`zkratka_mistnosti`),
  ADD KEY `zkratka_predmetu` (`zkratka_predmetu`),
  ADD KEY `kod_pedagoga` (`kod_pedagoga`);

--
-- Klíče pro tabulku `vysledky`
--
ALTER TABLE `vysledky`
  ADD PRIMARY KEY (`id_vysledku`);

--
-- Klíče pro tabulku `zapsane_terminy`
--
ALTER TABLE `zapsane_terminy`
  ADD PRIMARY KEY (`id_terminu`,`kod_studenta`),
  ADD KEY `kod_studenta` (`kod_studenta`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `vypsane_terminy`
--
ALTER TABLE `vypsane_terminy`
  MODIFY `id_terminu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `pedagogove_predmety`
--
ALTER TABLE `pedagogove_predmety`
  ADD CONSTRAINT `pedagogove_predmety_ibfk_1` FOREIGN KEY (`kod_pedagoga`) REFERENCES `pedagogove` (`kod_pedagoga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedagogove_predmety_ibfk_2` FOREIGN KEY (`zkratka_predmetu`) REFERENCES `predmety` (`zkratka_predmetu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `studenti_predmety`
--
ALTER TABLE `studenti_predmety`
  ADD CONSTRAINT `studenti_predmety_ibfk_1` FOREIGN KEY (`zkratka_predmetu`) REFERENCES `predmety` (`zkratka_predmetu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `studenti_predmety_ibfk_2` FOREIGN KEY (`kod_studenta`) REFERENCES `studenti` (`kod_studenta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `vypsane_terminy`
--
ALTER TABLE `vypsane_terminy`
  ADD CONSTRAINT `vypsane_terminy_ibfk_1` FOREIGN KEY (`zkratka_predmetu`) REFERENCES `predmety` (`zkratka_predmetu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vypsane_terminy_ibfk_2` FOREIGN KEY (`kod_pedagoga`) REFERENCES `pedagogove` (`kod_pedagoga`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vypsane_terminy_ibfk_3` FOREIGN KEY (`zkratka_mistnosti`) REFERENCES `mistnosti` (`zkratka_mistnosti`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Omezení pro tabulku `zapsane_terminy`
--
ALTER TABLE `zapsane_terminy`
  ADD CONSTRAINT `zapsane_terminy_ibfk_1` FOREIGN KEY (`kod_studenta`) REFERENCES `studenti` (`kod_studenta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zapsane_terminy_ibfk_2` FOREIGN KEY (`id_terminu`) REFERENCES `vypsane_terminy` (`id_terminu`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
