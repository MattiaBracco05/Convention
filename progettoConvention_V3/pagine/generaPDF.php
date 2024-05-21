<?php
    //Controllo se il parametro "IDRel" è stato passato tramite l'URL, se sì -->
    if (isset($_GET['ID'])) {
        
        //Ricavo il valore del parametro
        $idUtente = $_GET['ID'];

        //Includo il file "database.php"
        include '../php/database.php';

        //Includo la libreria TCPDF
        require_once('../php/tcpdf/tcpdf.php');

        //Creo una nuova istanza di TCPDF
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        //Imposto le informazioni del documento
        $pdf -> SetCreator(PDF_CREATOR);
        $pdf -> SetAuthor('Mattia Bracco');
        $pdf -> SetTitle('Calendario con impegni Convention');
        $pdf -> SetSubject('Calendario degli impegni');
        $pdf -> SetKeywords('Calendario, Impegni, PDF');
        
        //Header
        $pdf -> SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Convention', 'By Mattia Bracco', array(0,64,255), array(0,64,128));

        //Imposto le dimensioni della pagina e i margini
        $pdf -> SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf -> SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //Aggiungo una pagina
        $pdf -> AddPage();

        //Genero la tabella dal calendario
        $html = '<h1>Calendario con i miei impegni</h1>';
        $html .= '<table border="1" cellspacing="0" cellpadding="5">';

        //Creo la query da eseguire
        $queryDatiCalendario =
            "SELECT 
                Programma.*,
                Speech.Titolo AS TitoloSpeech,
                Speech.Argomento AS ArgomentoSpeech,
                DAY(Programma.FasciaOraria) AS giorno,
                CONCAT(LEFT(MONTHNAME(Programma.FasciaOraria), 3)) AS mese,
                RIGHT(YEAR(Programma.FasciaOraria), 2) AS anno,
                HOUR(Programma.FasciaOraria) AS ora,
                CASE WHEN IDPart IS NOT NULL THEN 1 ELSE 0 END AS Partecipa,
                Relatore.CognomeRel AS CognomeRelatore,
                Relatore.NomeRel AS NomeRelatore,
                Relatore.MailRel AS MailRelatore,
                Relatore.RagioneSocialeFK AS AziendaRelatore
            FROM Programma
            INNER JOIN Speech ON Programma.IDSpeech = Speech.IDSpeech
            LEFT JOIN Sceglie ON Programma.IDProgramma = Sceglie.IDProgramma
            LEFT JOIN Relaziona ON Programma.IDProgramma = Relaziona.IDProgramma
            LEFT JOIN Relatore ON Relaziona.IDRel = Relatore.IDRel
            WHERE IDPart = '$idUtente';";

        //Connessione al database
        Database :: connessione();

        //Eseguo la query (ricavo i dati del calendario)
        $datiCalendario = Database :: eseguiQuery($queryDatiCalendario);

        //Array dove salvo i dati del calendario
        $calendario = [];

        //Popolo l'array "calendario" con i dati ottenuti dalla query (ciclo while)
        while ($row = mysqli_fetch_assoc($datiCalendario)) {
            //Ricavo i dati
            $ora = $row['ora'];
            $giorno = $row['giorno'];
            $mese = $row['mese'];
            $anno = $row['anno'];
            $titoloSpeech = $row['TitoloSpeech'];
            $salaSpeech = $row['NomeSala'];

            // CALENDARIO[day] --> []
            if (!isset($calendario[$giorno])) {
                $calendario[$giorno] = [];
            }

            // CALENDARIO[day][hour] --> []
            if (!isset($calendario[$giorno][$ora])) {
                $calendario[$giorno][$ora] = [];
            }

            // CALENDARIO[day][hour][] --> [titolo dello Speech]
            $calendario[$giorno][$ora][] = $titoloSpeech;
        }

        //Aggiungo l'header della tabella
        $html .= '<tr>';
        $html .= '<th>Fascia Oraria</th>';
        foreach ($calendario as $giorno => $orari) {
            $dataIntestazione = $giorno . ' ' . $mese . ' ' . $anno;
            $html .= '<th>' . $dataIntestazione . '</th>';
        }
        $html .= '</tr>';

        //Aggiungo il body della tabella
        for ($ora = 0; $ora < 24; $ora++) {
            $html .= '<tr>';
            $html .= '<td>' . $ora . ':00</td>';
            foreach ($calendario as $giorno => $orari) {
                $html .= '<td>';
                if (isset($orari[$ora])) {
                    foreach ($orari[$ora] as $titoloSpeech) {
                        $html .= $titoloSpeech . ' (' . $salaSpeech . ')';
                    }
                }
                $html .= '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';

        //Scrivo il contenuto HTML nella pagina PDF
        $pdf -> writeHTML($html, true, false, true, false, '');

        //Output del documento PDF (download)
        $pdf -> Output('calendario.pdf', 'D');

        //Interrompo l'esecuzione dello script dopo aver inviato il PDF
        exit;
    }
    //Altrimenti --> Messaggio di errore
    else {
        echo "<p>Errore! Parametri non trovati</p>";
    }
?>