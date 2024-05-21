/*
5L Bracco Mattia
Progetto Convetion
*/

-- Elimino il DB
DROP DATABASE IF EXISTS ConventionV3;
-- Creo il DB
CREATE DATABASE IF NOT EXISTS ConventionV3;
-- Seleziono il DB
USE ConventionV3;

\! echo '\nCreo le tabelle...'

/*
CREO LE TABELLE...
PER LE ENTITÀ

SCHEMA LOGICO:
Azienda         --> ( |RagioneSociale|,  IndirizzoAzienda,   TelefonoAzienda );
Relatore        --> ( |IDRel|,           CognomeRel,         NomeRel,            MailRel,     /RagioneSociale/ );
Speech          --> ( |IDSpeech|,        Titolo,             Argomento );
Piano           --> ( |Numero| );
Sala            --> ( |NomeSala|,        NpostiSala,         /Numero/ );
Programma       --> ( |IDProgramma|,     FasciaOraria,       /IDSpeech/,         /NomeSala/ );
Partecipante    --> ( |IDPart|,          CognomePart,        NomePart,           MailPart,      TipologiaPart );
*/

-- Tabella "Azienda"
CREATE TABLE IF NOT EXISTS Azienda (
    RagioneSociale VARCHAR(25) NOT NULL,
    IndirizzoAzienda VARCHAR(50),
    TelefonoAzienda CHAR(11),

    -- Chiave primaria
    PRIMARY KEY (RagioneSociale)
);

CREATE TABLE IF NOT EXISTS Relatore (
    IDRel INT NOT NULL AUTO_INCREMENT,
    CognomeRel VARCHAR(25) NOT NULL,
    NomeRel VARCHAR(25) NOT NULL,
    MailRel VARCHAR(51) NOT NULL,
    -- Attributo per chiave esterna
    RagioneSocialeFK VARCHAR(25),

    -- Chiave primaria
    PRIMARY KEY (IDRel),
    -- Chiave esterna
    FOREIGN KEY (RagioneSocialeFK) REFERENCES Azienda (RagioneSociale)
);

-- Tabella "Speech"
CREATE TABLE IF NOT EXISTS Speech (
    IDSpeech INT AUTO_INCREMENT,
    Titolo VARCHAR(20) NOT NULL,
    Argomento TEXT,

    -- Chiave primaria
    PRIMARY KEY (IDSpeech)
);

-- Tabella "Piano"
CREATE TABLE IF NOT EXISTS Piano (
    Numero INT NOT NULL,

    -- Chiave primaria
    PRIMARY KEY (Numero)
);

-- Tabella "Sala" (da creare dopo: Piano)
CREATE TABLE IF NOT EXISTS Sala (
    NomeSala VARCHAR(25) NOT NULL, 
    NpostiSala INT NOT NULL,
    -- Attributi per chiavi esterne
    Numero INT,

    -- Chiave primaria
    PRIMARY KEY(NomeSala),
    -- Chiavi esterne
    FOREIGN KEY (Numero) REFERENCES Piano (Numero)
);

-- Tabella "Programma" (da creare dopo: Speech, Sala)
CREATE TABLE IF NOT EXISTS Programma (
    IDProgramma INT NOT NULL AUTO_INCREMENT,
    FasciaOraria DATETIME NOT NULL,
    -- Attributi per chiavi esterne
    IDSpeech INT,
    NomeSala VARCHAR(25),

    -- Chiave primaria
    PRIMARY KEY (IDProgramma),
    -- Chiavi esterne
    FOREIGN KEY (IDSpeech) REFERENCES Speech (IDSpeech),
    FOREIGN KEY (NomeSala) REFERENCES Sala (NomeSala)
);

-- Tabella "Utenti"
CREATE TABLE IF NOT EXISTS Utenti (
	IDUtente INT AUTO_INCREMENT,
	MailUtente VARCHAR(51) NOT NULL,
	PswUtente VARCHAR(64) NOT NULL,
	
	-- Chiave primaria
	PRIMARY KEY (IDUtente)
);

-- Tabella "Partecipante"
CREATE TABLE IF NOT EXISTS Partecipante (
	IDPart INT AUTO_INCREMENT, 
	CognomePart VARCHAR(25), 
	NomePart VARCHAR(25),  
	MailPart VARCHAR(51),  
	TipologiaPart VARCHAR(15),
	-- Attributi per chiavi esterne
	IDUtente INT,
	
	-- Chiave primaria 
	PRIMARY KEY(IDPart),
	-- Chiavi esterne
	FOREIGN KEY (IDUtente) REFERENCES Utenti (IDUtente)
	
); 

/*
CREO LE TABELLE...
PER LE RELAZIONI N:M (Relazione N:M --> 3° tabella)

SCHEMA LOGICO:
Relaziona   --> ( | /IDRel/,        /IDProgramma/   | );
Sceglie     --> ( | /IDProgramma/,  /IDPart/        | );
*/

-- Tabella "Relaziona"
CREATE TABLE IF NOT EXISTS Relaziona (
    -- Attributi per chiavi esterne
    IDRel INT,
    IDProgramma INT,

    -- Chiave primaria
    PRIMARY KEY (IDRel, IDProgramma),
    -- Chiavi esterne
    FOREIGN KEY (IDRel) REFERENCES Relatore (IDRel),
    FOREIGN KEY (IDProgramma) REFERENCES Programma (IDProgramma)
);

-- Tabella "Sceglie"
CREATE TABLE IF NOT EXISTS Sceglie (
    -- Attributi per chiavi esterne
    IDProgramma INT,
    IDPart INT,

    -- Chiave primaria
    PRIMARY KEY (IDProgramma, IDPart),
    -- Chiavi esterne
    FOREIGN KEY (IDProgramma) REFERENCES Programma (IDProgramma),
    FOREIGN KEY (IDPart) REFERENCES Partecipante (IDPart)
);

\! echo '\nTabelle create'
SHOW TABLES;

\! echo '\nTabella "Azienda"'
DESCRIBE Azienda;

\! echo '\nTabella "Relatore"'
DESCRIBE Relatore;

\! echo '\nTabella "Speech"'
DESCRIBE Speech;

\! echo '\nTabella "Piano"'
DESCRIBE Piano;

\! echo '\nTabella "Sala"'
DESCRIBE Sala;

\! echo '\nTabella "Programma"'
DESCRIBE Programma;

\! echo '\nTabella "Partecipante"'
DESCRIBE Partecipante;

\! echo '\nTabella "Relaziona"'
DESCRIBE Relaziona;

\! echo '\nTabella "Sceglie"'
DESCRIBE Sceglie;
