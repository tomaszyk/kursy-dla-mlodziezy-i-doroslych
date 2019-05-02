-- phpMyAdmin SQL Dump
-- version home.pl
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 02 Maj 2019, 12:40
-- Wersja serwera: 5.7.24-27-log
-- Wersja PHP: 5.6.34

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `30189788_dorosli`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ceny`
--

CREATE TABLE IF NOT EXISTS `ceny` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cena` int(11) NOT NULL,
  `rata1` int(11) NOT NULL,
  `rata2` int(11) NOT NULL,
  `rezerwacja` int(11) NOT NULL,
  `cenaCal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Zrzut danych tabeli `ceny`
--

INSERT INTO `ceny` (`id`, `cena`, `rata1`, `rata2`, `rezerwacja`, `cenaCal`) VALUES
(1, 500, 270, 270, 90, 630),
(2, 500, 270, 270, 90, 630),
(3, 550, 220, 220, 90, 530);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `daty`
--

CREATE TABLE IF NOT EXISTS `daty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PierD` int(11) NOT NULL,
  `PierM` int(11) NOT NULL,
  `PierR` int(11) NOT NULL,
  `DrugiD` int(11) NOT NULL,
  `DrugiM` int(11) NOT NULL,
  `DrugiR` int(11) NOT NULL,
  `TrzeciD` int(11) NOT NULL,
  `TrzeciM` int(11) NOT NULL,
  `TrzeciR` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `daty`
--

INSERT INTO `daty` (`id`, `PierD`, `PierM`, `PierR`, `DrugiD`, `DrugiM`, `DrugiR`, `TrzeciD`, `TrzeciM`, `TrzeciR`) VALUES
(1, 15, 6, 2019, 26, 7, 2019, 27, 10, 2019);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `terminy`
--

CREATE TABLE IF NOT EXISTS `terminy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poczatek` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `godzina` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `koniec` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lokalizacja` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dzien` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `trener` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `terminy`
--

INSERT INTO `terminy` (`id`, `poczatek`, `godzina`, `koniec`, `lokalizacja`, `dzien`, `trener`) VALUES
(1, '20.08.2018', '19.10', '12.10.2018', 'ul.Ratajczaka 26/3, Poznań, biuro Inspiracje', 'wtorek', 'Tomasz Mlastek'),
(2, '21.08.2018', '19.10', '13.10.2018', 'ul.Ratajczaka 26/3, Poznań, biuro Inspiracje', 'środa', 'Tomasz Mlastek');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wiadomosc`
--

CREATE TABLE IF NOT EXISTS `wiadomosc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Imie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Wiadomosc` longtext COLLATE utf8_unicode_ci NOT NULL,
  `Zgoda` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zapis`
--

CREATE TABLE IF NOT EXISTS `zapis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `z24_id_sprzedawcy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `z24_crc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `z24_return_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `z24_language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `k24_nazwa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `k24_miasto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `k24_kod` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `k24_ulica` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `k24_numer_dom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `k24_numer_lok` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `k24_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dataUrodzenia` date NOT NULL,
  `uwagi` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nazwa_kursanta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dataUrodzeniaKursanta` date NOT NULL,
  `regulamin` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=147 ;

--
-- Zrzut danych tabeli `zapis`
--

INSERT INTO `zapis` (`id`, `z24_id_sprzedawcy`, `z24_crc`, `z24_return_url`, `z24_language`, `k24_nazwa`, `k24_miasto`, `k24_kod`, `k24_ulica`, `k24_numer_dom`, `k24_numer_lok`, `k24_email`, `telefon`, `dataUrodzenia`, `uwagi`, `nazwa_kursanta`, `dataUrodzeniaKursanta`, `regulamin`) VALUES
(146, 'xxxxx', '5ebc7348', 'http://szybkieczytanie-poznan.pl/app.php/dziekuje', 'pl', 'Tomasz Mlastek', 'Poznań', '61-249', 'Falista', '4', NULL, 'tomaszmlastek@gmail.com', '664036435', '1981-02-17', NULL, 'Tomasz Mlastek', '1981-02-17', 'b:1;');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
