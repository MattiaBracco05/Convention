-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 21, 2024 alle 15:21
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS ConventionV3;
USE ConventionV3;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ConventionV3`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Azienda`
--

CREATE TABLE `Azienda` (
  `RagioneSociale` varchar(25) NOT NULL,
  `IndirizzoAzienda` varchar(50) DEFAULT NULL,
  `TelefonoAzienda` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Azienda`
--

INSERT INTO `Azienda` (`RagioneSociale`, `IndirizzoAzienda`, `TelefonoAzienda`) VALUES
('Amazon Inc.', 'Seattle, Washington, Stati Uniti', '8901234567'),
('Apple Inc.', 'Cupertino, California, Stati Uniti', '4567890123'),
('Facebook Inc.', 'Menlo Park, California, Stati Uniti', '2345678901'),
('Google LLC', 'Mountain View, California, Stati Uniti', '6678901234'),
('Intel Corporation', 'Santa Clara, California, Stati Uniti', '9012345678'),
('Microsoft Corporation', 'Redmond, Washington, Stati Uniti', '1234567890'),
('Red Hat Inc.', 'Raleigh, Caroline del Nord, Stati Uniti', '3456789012'),
('Samsung Electronics Co.', 'Suwon, Corea del Sud', '5383738382'),
('Tesla Inc.', 'Austin, Texas, Stati Uniti', '0123456789'),
('Xiaomi Corporation', 'Haidian, Pechino, Cina', '7890123456');

-- --------------------------------------------------------

--
-- Struttura della tabella `Partecipante`
--

CREATE TABLE `Partecipante` (
  `IDPart` int(11) NOT NULL,
  `CognomePart` varchar(25) DEFAULT NULL,
  `NomePart` varchar(25) DEFAULT NULL,
  `MailPart` varchar(51) DEFAULT NULL,
  `TipologiaPart` varchar(15) DEFAULT NULL,
  `IDUtente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Partecipante`
--

INSERT INTO `Partecipante` (`IDPart`, `CognomePart`, `NomePart`, `MailPart`, `TipologiaPart`, `IDUtente`) VALUES
(1, 'Elon', 'Musk', 'elon.musk@gmail.com', 'Relatore', 2),
(2, 'Gates', 'Bill', 'bill.gates@gmail.com', 'Relatore', 3),
(3, 'Zuckerberg', 'Mark', 'mark.zuckerberg@gmail.com', 'Relatore', 4),
(4, 'Jicks', 'Matt', 'matt.hicks@gmail.com', 'Relatore', 5),
(5, 'Wayne', 'Ronald', 'ronald.wayne@gmail.com', 'Relatore', 6),
(6, 'Page', 'Larry', 'larry.page@gmail.com', 'Relatore', 7),
(7, 'Lee', 'Byung', 'byung.lee@gmail.com', 'Relatore', 8),
(8, 'Jun', 'Lei', 'lei.jun@gmail.com', 'Relatore', 9),
(9, 'Bezos', 'Jeff', 'jeff.bezos@gmail.com', 'Relatore', 10),
(10, 'Moore', 'Gordon', 'gordon.moore@gmail.com', 'Relatore', 11),
(11, 'user1', 'user1', 'user1@gmail.com', 'Base', 12),
(12, 'user2', 'user2', 'user2@gmail.com', 'Base', 13),
(13, 'user3', 'user3', 'user3@gmail.com', 'Base', 14),
(14, 'user4', 'user4', 'user4@gmail.com', 'Base', 15),
(15, 'user5', 'user5', 'user5@gmail.com', 'Base', 16),
(16, 'prova', 'prova', 'prova.prova@gmail.com', 'Base', 17),
(17, 'prova2', 'prova2', 'prova2.prova2@gmail.com', 'Base', 18),
(18, 'prova3', 'prova3', 'prova3.prova3@gmail.com', 'Base', 19);

-- --------------------------------------------------------

--
-- Struttura della tabella `Piano`
--

CREATE TABLE `Piano` (
  `Numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Piano`
--

INSERT INTO `Piano` (`Numero`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- --------------------------------------------------------

--
-- Struttura della tabella `Programma`
--

CREATE TABLE `Programma` (
  `IDProgramma` int(11) NOT NULL,
  `FasciaOraria` datetime NOT NULL,
  `IDSpeech` int(11) DEFAULT NULL,
  `NomeSala` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Programma`
--

INSERT INTO `Programma` (`IDProgramma`, `FasciaOraria`, `IDSpeech`, `NomeSala`) VALUES
(1, '2024-01-01 10:00:00', 1, 'Sala Alan Turing'),
(2, '2024-01-01 12:00:00', 2, 'Sala Steve Jobs'),
(3, '2024-01-01 14:00:00', 3, 'Sala Stephen Hawking'),
(4, '2024-01-02 10:00:00', 4, 'Sala Charles Babbage'),
(5, '2024-01-02 12:00:00', 5, 'Sala Camillo Olivetti'),
(6, '2024-01-02 14:00:00', 6, 'Sala Thomas J. Watson'),
(7, '2024-01-02 16:00:00', 7, 'Sala Bob Miner'),
(8, '2024-01-03 10:00:00', 8, 'Sala John von Neumann'),
(9, '2024-01-03 12:00:00', 9, 'Sala Hedy Lamarr'),
(10, '2024-01-13 14:00:00', 10, 'Sala Ericsson');

-- --------------------------------------------------------

--
-- Struttura della tabella `Relatore`
--

CREATE TABLE `Relatore` (
  `IDRel` int(11) NOT NULL,
  `CognomeRel` varchar(25) NOT NULL,
  `NomeRel` varchar(25) NOT NULL,
  `MailRel` varchar(51) NOT NULL,
  `RagioneSocialeFK` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Relatore`
--

INSERT INTO `Relatore` (`IDRel`, `CognomeRel`, `NomeRel`, `MailRel`, `RagioneSocialeFK`) VALUES
(1, 'Musk', 'Elon', 'elon.musk@gmail.com', 'Tesla Inc.'),
(2, 'Gates', 'Bill', 'bill.gates@gmail.com', 'Microsoft Corporation'),
(3, 'Zuckerberg', 'Mark', 'mark.zuckerberg@gmail.com', 'Facebook Inc.'),
(4, 'Hicks', 'Matt', 'matt.hicks@gmail.com', 'Red Hat Inc.'),
(5, 'Wayne', 'Ronald', 'ronald.wayne@gmail.com', 'Apple Inc.'),
(6, 'Page', 'Larry', 'larry.page@gmail.com', 'Google LLC'),
(7, 'Lee', 'Byung-Chul', 'byung.lee@gmail.com', 'Samsung Electronics Co.'),
(8, 'Lei', 'Jun', 'lei.jun@gmail.com', 'Xiaomi Corporation'),
(9, 'Bezos', 'Jeff', 'jeff.bezos@gmail.com', 'Amazon Inc.'),
(10, 'Moore', 'Gordon', 'gordon.moore@gmail.com', 'Intel Corporation');

-- --------------------------------------------------------

--
-- Struttura della tabella `Relaziona`
--

CREATE TABLE `Relaziona` (
  `IDRel` int(11) NOT NULL,
  `IDProgramma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Relaziona`
--

INSERT INTO `Relaziona` (`IDRel`, `IDProgramma`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `Sala`
--

CREATE TABLE `Sala` (
  `NomeSala` varchar(25) NOT NULL,
  `NpostiSala` int(11) NOT NULL,
  `Numero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Sala`
--

INSERT INTO `Sala` (`NomeSala`, `NpostiSala`, `Numero`) VALUES
('Sala Alan Turing', 10, 1),
('Sala Bob Miner', 70, 3),
('Sala Camillo Olivetti', 50, 2),
('Sala Charles Babbage', 40, 2),
('Sala Ericsson', 100, 4),
('Sala Hedy Lamarr', 90, 4),
('Sala John von Neumann', 80, 3),
('Sala Stephen Hawking', 30, 1),
('Sala Steve Jobs', 20, 1),
('Sala Thomas J. Watson', 60, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `Sceglie`
--

CREATE TABLE `Sceglie` (
  `IDProgramma` int(11) NOT NULL,
  `IDPart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Sceglie`
--

INSERT INTO `Sceglie` (`IDProgramma`, `IDPart`) VALUES
(1, 11),
(1, 17),
(2, 11),
(2, 12),
(3, 11),
(3, 13),
(4, 11),
(4, 14),
(5, 15),
(6, 16),
(8, 18),
(9, 11),
(10, 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `Speech`
--

CREATE TABLE `Speech` (
  `IDSpeech` int(11) NOT NULL,
  `Titolo` varchar(20) NOT NULL,
  `Argomento` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Speech`
--

INSERT INTO `Speech` (`IDSpeech`, `Titolo`, `Argomento`) VALUES
(1, 'Space X', 'Viaggi nello spazio'),
(2, 'Surface PRO 10', 'Perchè acquistare un Surface PRO 10'),
(3, 'Meta', 'Verso il MetaVerso'),
(4, 'Open', 'Perchè utilizzare prodotti Open Source'),
(5, 'Iphone 15 PRO', 'Lancio del nuovo smartphone Iphone'),
(6, 'Google Platforms', 'Tutti i servizi che offre Google'),
(7, 'Samsung S24', 'Lancio del nuovo smartphone Samsung'),
(8, 'Xiaomi', 'La storia dell\'azienda'),
(9, 'Prime', 'Come Amazon gestisce il suo servizio di consegne'),
(10, 'Intel i9 Extreme', 'La CPU più prestazionale');

-- --------------------------------------------------------

--
-- Struttura della tabella `Utenti`
--

CREATE TABLE `Utenti` (
  `IDUtente` int(11) NOT NULL,
  `MailUtente` varchar(51) NOT NULL,
  `PswUtente` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `Utenti`
--

INSERT INTO `Utenti` (`IDUtente`, `MailUtente`, `PswUtente`) VALUES
(1, 'admin@admin', 'ac9689e2272427085e35b9d3e3e8bed88cb3434828b43b86fc0596cad4c6e270'),
(2, 'elon.musk@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(3, 'bill.gates@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(4, 'mark.zuckerberg@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(5, 'matt.hicks@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(6, 'ronald.wayne@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(7, 'larry.page@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(8, 'byung.lee@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(9, 'lei.jun@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(10, 'jeff.bezos@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(11, 'gordon.moore@gmail.com', 'f6d27fe2c27e0af7d35889b5e450556ab871336adc8573b140d3b81ed840f0c0'),
(12, 'user1@gmail.com', '831c237928e6212bedaa4451a514ace3174562f6761f6a157a2fe5082b36e2fb'),
(13, 'user2@gmail.com', '831c237928e6212bedaa4451a514ace3174562f6761f6a157a2fe5082b36e2fb'),
(14, 'user3@gmail.com', '831c237928e6212bedaa4451a514ace3174562f6761f6a157a2fe5082b36e2fb'),
(15, 'user4@gmail.com', '831c237928e6212bedaa4451a514ace3174562f6761f6a157a2fe5082b36e2fb'),
(16, 'user5@gmail.com', '831c237928e6212bedaa4451a514ace3174562f6761f6a157a2fe5082b36e2fb'),
(17, 'prova.prova@gmail.com', '220be2608460b9ac29e2c7109d0233c1b9b7302b2e627fe64c08f3378f8dce3b'),
(18, 'prova2.prova2@gmail.com', '220be2608460b9ac29e2c7109d0233c1b9b7302b2e627fe64c08f3378f8dce3b'),
(19, 'prova3.prova3@gmail.com', '220be2608460b9ac29e2c7109d0233c1b9b7302b2e627fe64c08f3378f8dce3b');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `Azienda`
--
ALTER TABLE `Azienda`
  ADD PRIMARY KEY (`RagioneSociale`);

--
-- Indici per le tabelle `Partecipante`
--
ALTER TABLE `Partecipante`
  ADD PRIMARY KEY (`IDPart`),
  ADD KEY `IDUtente` (`IDUtente`);

--
-- Indici per le tabelle `Piano`
--
ALTER TABLE `Piano`
  ADD PRIMARY KEY (`Numero`);

--
-- Indici per le tabelle `Programma`
--
ALTER TABLE `Programma`
  ADD PRIMARY KEY (`IDProgramma`),
  ADD KEY `IDSpeech` (`IDSpeech`),
  ADD KEY `NomeSala` (`NomeSala`);

--
-- Indici per le tabelle `Relatore`
--
ALTER TABLE `Relatore`
  ADD PRIMARY KEY (`IDRel`),
  ADD KEY `RagioneSocialeFK` (`RagioneSocialeFK`);

--
-- Indici per le tabelle `Relaziona`
--
ALTER TABLE `Relaziona`
  ADD PRIMARY KEY (`IDRel`,`IDProgramma`),
  ADD KEY `IDProgramma` (`IDProgramma`);

--
-- Indici per le tabelle `Sala`
--
ALTER TABLE `Sala`
  ADD PRIMARY KEY (`NomeSala`),
  ADD KEY `Numero` (`Numero`);

--
-- Indici per le tabelle `Sceglie`
--
ALTER TABLE `Sceglie`
  ADD PRIMARY KEY (`IDProgramma`,`IDPart`),
  ADD KEY `IDPart` (`IDPart`);

--
-- Indici per le tabelle `Speech`
--
ALTER TABLE `Speech`
  ADD PRIMARY KEY (`IDSpeech`);

--
-- Indici per le tabelle `Utenti`
--
ALTER TABLE `Utenti`
  ADD PRIMARY KEY (`IDUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `Partecipante`
--
ALTER TABLE `Partecipante`
  MODIFY `IDPart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT per la tabella `Programma`
--
ALTER TABLE `Programma`
  MODIFY `IDProgramma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `Relatore`
--
ALTER TABLE `Relatore`
  MODIFY `IDRel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `Speech`
--
ALTER TABLE `Speech`
  MODIFY `IDSpeech` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `Utenti`
--
ALTER TABLE `Utenti`
  MODIFY `IDUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Partecipante`
--
ALTER TABLE `Partecipante`
  ADD CONSTRAINT `Partecipante_ibfk_1` FOREIGN KEY (`IDUtente`) REFERENCES `Utenti` (`IDUtente`);

--
-- Limiti per la tabella `Programma`
--
ALTER TABLE `Programma`
  ADD CONSTRAINT `Programma_ibfk_1` FOREIGN KEY (`IDSpeech`) REFERENCES `Speech` (`IDSpeech`),
  ADD CONSTRAINT `Programma_ibfk_2` FOREIGN KEY (`NomeSala`) REFERENCES `Sala` (`NomeSala`);

--
-- Limiti per la tabella `Relatore`
--
ALTER TABLE `Relatore`
  ADD CONSTRAINT `Relatore_ibfk_1` FOREIGN KEY (`RagioneSocialeFK`) REFERENCES `Azienda` (`RagioneSociale`);

--
-- Limiti per la tabella `Relaziona`
--
ALTER TABLE `Relaziona`
  ADD CONSTRAINT `Relaziona_ibfk_1` FOREIGN KEY (`IDRel`) REFERENCES `Relatore` (`IDRel`),
  ADD CONSTRAINT `Relaziona_ibfk_2` FOREIGN KEY (`IDProgramma`) REFERENCES `Programma` (`IDProgramma`);

--
-- Limiti per la tabella `Sala`
--
ALTER TABLE `Sala`
  ADD CONSTRAINT `Sala_ibfk_1` FOREIGN KEY (`Numero`) REFERENCES `Piano` (`Numero`);

--
-- Limiti per la tabella `Sceglie`
--
ALTER TABLE `Sceglie`
  ADD CONSTRAINT `Sceglie_ibfk_1` FOREIGN KEY (`IDProgramma`) REFERENCES `Programma` (`IDProgramma`),
  ADD CONSTRAINT `Sceglie_ibfk_2` FOREIGN KEY (`IDPart`) REFERENCES `Partecipante` (`IDPart`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
