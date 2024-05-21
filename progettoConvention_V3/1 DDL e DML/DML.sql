SET FOREIGN_KEY_CHECKS=0;

/*
5L Bracco Mattia
Progetto Convetion
*/

-- Seleziono il DB
USE ConventionV3;

\! echo '\nInserisco i dati nelle tabelle...'

-- TABELLA "AZIENDA"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaAzienda.csv'
INTO TABLE Azienda FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (RagioneSociale, IndirizzoAzienda, TelefonoAzienda);

-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Azienda"'
SELECT * FROM Azienda;

-- TABELLA "RELATORE"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaRelatore.csv'
INTO TABLE Relatore FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (CognomeRel, NomeRel, MailRel, RagioneSocialeFK);

-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Relatore"'
SELECT * FROM Relatore;

-- TABELLA "SPEECH"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaSpeech.csv'
INTO TABLE Speech FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (Titolo, Argomento);

-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Speech"'
SELECT * FROM Speech;

-- TABELLA "PIANO"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaPiano.csv'
INTO TABLE Piano FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (Numero);

-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Piano"'
SELECT * FROM Piano;

-- TABELLA "SALA"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaSala.csv'
INTO TABLE Sala FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (NomeSala, NpostiSala, Numero);

-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Sala"'
SELECT * FROM Sala;

-- TABELLA "PROGRAMMA"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaProgramma.csv'
INTO TABLE Programma FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (FasciaOraria, IDSpeech, NomeSala);


-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Programma"'
SELECT * FROM Programma;

-- TABELLA "UTENTI"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaUtenti.csv'
INTO TABLE Utenti FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (MailUtente, PswUtente);

-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Utenti"'
SELECT * FROM Utenti;

-- TABELLA "PARTECIPANTE"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaPartecipante.csv'
INTO TABLE Partecipante FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (CognomePart, NomePart, MailPart, TipologiaPart, IDUtente);

-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Partecipante"'
SELECT * FROM Partecipante;

-- TABELLA "RELAZIONA"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaRelaziona.csv'
INTO TABLE Relaziona FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (IDRel, IDProgramma);

-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Relaziona"'
SELECT * FROM Relaziona;

-- TABELLA "SCEGLIE"
LOAD DATA INFILE '/tmp/CSV/Convention/TabellaSceglie.csv'
INTO TABLE Sceglie FIELDS TERMINATED BY ';' LINES TERMINATED BY '\n' 
IGNORE 1 LINES (IDProgramma, IDPart);

-- Stampo i dati inseriti
\! echo '\nDati inseriti nella tabella "Sceglie"'
SELECT * FROM Sceglie;
