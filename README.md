# Convention

5L Bracco Mattia
A.S. 2023/2024
Progetto Convention

## LINK AL PROGETTO (troppo grande da caricare su digipad)
https://github.com/MattiaBracco05/Convention.git

## CREAZIONE DEL DATABASE

### Metodo 1 - Creazione tramite file
* Creare il database e le relative tabelle avviando il file "DDL.sql"
* Caricare i dati avviando il file "DML.sql"
* N.B. Per importare il database tramite file CSV copiare la cartella "CSV" dentro alla directory "tmp"
* Il percorso finale dei file deve essere --> "tmp/CSV/Convention/file.csv"

### Metodo 2 - Importazione da PHP MyAdmin
Importare il database dalla pagina di PHP MyAdmin andando a selezionare il file "ConventionV3.sql"

## FUNZIONALITA' "NASCOSTE"
* Cliccando sul simbolo della posizione (immagine della card di un'azienda) si aprirà la posizione su Google Maps
* Cliccando sul numero di telefono nel caso si stia usano un dispositivo mobile si aprirà il gestore delle telefonate
* Cliccando sul titolo di un evento a cui partecipo verrà spostato al relativo evento nel calendario
  * Viceversa se si clicca sul calendario l'utente verrà spostato alla card dell'evento
* Cliccando sul titolo di una card nella pagina per l'admin verrò spostato alla relativa voce nella tabella
  * Viceversa se si clicca sulla chiave primaria di una tabella si verrà spostati alla relativa card

## HOSTING
Terminato il progetto ho deciso di porvare ad hostarlo gratuitamente: http://www.convention.infinityfreeapp.com

### ATTENZIONE:
	- Sulla versione online non è possibile scaricare il PDF del calendario (l'hosting free non mi permette di farlo :( )
	- Il firewaal della rete scolastica potrebbe bloccare il passaggio delle pagine (da index.php a pagine/home.php)
	(se una volta inserite le credenziali il sito continua a caricare senza restituire errori utilizzare un'altra connessione)
