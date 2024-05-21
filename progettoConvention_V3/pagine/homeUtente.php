<?php
    //Avvio la sessione
    session_start();

    //Includo il file del database
    include '../php/database.php';

    //Se l'utente non ha effettuato l'accesso o il cookie è scaduto --> reindirizzo alla pagina di login (index.php)
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        //Reindirizzo alla pagina di login ("index.php")
        header("Location: ../index.php");
        //Interrompo l'esecuzione dello script
        exit();
    }

    //Controllo se era già loggato (non mostro l'alert) o se si è loggato adesso
    if (!isset($_SESSION['logged_flag']) || $_SESSION['logged_flag'] !== true) {
        //Mostra l'alert di login effettuato
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo '    Swal.fire({';
        echo '        icon: "success",';
        echo '        title: "Accesso effettuato!",';
        echo '        text: "Hai effettuato l\'accesso come utente.",';
        echo '        confirmButtonColor: "#3085d6",';
        echo '        confirmButtonText: "OK"';
        echo '    });';
        echo '});';
        echo '</script>';
        //Imposta la variabile di sessione per evitare di mostrare l'alert di nuovo
        $_SESSION['logged_flag'] = true;
    } else {
        //Non eseguo nulla
    }


    //Recupero le informazioni dell'utente dalla sessione
    $mailUtente = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!-- QUI INIZIA IL CODICE HTML -->
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS FILES -->                
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/bootstrap-icons.css" rel="stylesheet">
        <link href="../css/templatemo-tiya-golf-club.css" rel="stylesheet">

        <!-- Titolo scheda -->
        <title>Convention - Utente</title>

    </head>

    <body>

    <!-- INIZIO DELLO SCRIPT JS -->
    <script>

        //AVVIO IL TIMER AL CARICAMENTO DELLA PAGINA
        document.addEventListener("DOMContentLoaded", function() {
            //Avvio il timer di logout automatico
            logoutAutomatico(); 
        });

                
        /*
        Non ho bisogno di avere una funzione per aggiornare il timer in quanto ogni operazione
        che effettuo (iscrizione / annulla iscrizione) fa sì che la mia pagina venga ricaricata.
        Pertanto verrà automaticamente richiamata la funzione al "DOMContentLoaded" per settare il timer (logoutAutomatico)
        */
       
        //FUNZIONE LOGOUT AUTOMATICO
        function logoutAutomatico() {
            //Imposto un timer di 1 minuto (1minuto --> 120 secondi --> 120.000 millisecondi)
            setTimeout(function() {
                //Scaduto il timer effettuo il logout (causa inattività)
                logout();
            }, 120000);
        }

        //FUNZIONE LOGOUT
        function logout() {
            //File PHP che gestisce il logout
            fetch('../php/logout.php')
            .then(response => {
                //Se la risposta è ok --> Messaggio di avvenuto logout (sweet alert)
                if (response.ok) {
                    Swal.fire ({
                        icon: 'info',
                        title: 'Logout effettuato!',
                        text: 'Sei stato disconnesso.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        //Rimando alla pagina di login (index.php)
                        window.location.href = '../index.php';
                    });
                }
                //Altrimenti --> Messaggio di errore (sweet alert)
                else {
                    Swal.fire ({
                        icon: 'error',
                        title: 'Errore durante il logout',
                        text: 'Si è verificato un problema durante il logout.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                }
            })
            //Catturo l'errore
            .catch(error => {
                console.error('Si è verificato un errore:', error);
            });
        }
    </script>
    <!-- FINE DELLO SCRIPT JS -->    

        <main>
            <!-- Inizio della navbar -->
            <nav class="navbar navbar-expand-lg">                
                <div class="container">
                    
                    <!-- Logo e Titolo -->
                    <a class="navbar-brand d-flex align-items-center" href="#">
                        <img src="../images/logo.png" class="img-fluid">
                        <span class="navbar-brand-text">
                            Convention
                        </span>
                    </a>
    
                    <!-- Button per il toggle dela navbar -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <!-- Inizio della navbar (collpase) -->
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-lg-auto">
                            <!-- Home -->
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#sectionHeader">Home</a>
                            </li>
    
                            <!-- Gestisci eventi -->
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#sectionGestisciEventi">Gestisci eventi</a>
                            </li>

                            <!-- Calendario -->
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#sectionCalendario">Calendario</a>
                            </li>

                        </ul>

                    </div>
                    <!-- Fine della navbar (collpase) -->

                </div>
            </nav>
            <!-- Fine della navbar -->
            
            <!-- Inizio sezione "Header" -->
            <section class="hero-section d-flex justify-content-center align-items-center" id="sectionHeader">
                <div class="section-overlay"></div>

                <!-- (stile onda) -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#3D405B" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,0L1405.7,0C1371.4,0,1303,0,1234,0C1165.7,0,1097,0,1029,0C960,0,891,0,823,0C754.3,0,686,0,617,0C548.6,0,480,0,411,0C342.9,0,274,0,206,0C137.1,0,69,0,34,0L0,0Z"></path></svg>

                <!-- Inizio container -->
                <div class="container">                    
                    <div class="row">

                        <!-- Inizio del titolo -->
                        <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                            <h2 class="text-white">Benvenuto in Convention</h2>

                            <!-- Sottotitolo (che ruota) -->
                            <h1 class="cd-headline rotate-1 text-white mb-4 pb-2">
                                <span>Qui trovi</span>
                                <span class="cd-words-wrapper">
                                    <b class="is-visible">Speech</b>
                                    <b>Programmi</b>
                                    <b>E molto altro</b>
                                </span>
                            </h1>

                            <!-- Button di collegamento -->
                            <div class="custom-btn-group">
                                <button class="btn custom-btn smoothscroll me-3" onclick="logout()">Logout</button>
                                <a href="#sectionGestisciEventi" class="link smoothscroll me-3">Gestisci eventi</a>
                                <a href="#sectionCalendario" class="link smoothscroll me-3">Calendario</a>
                            </div>
                        </div>
                        <!-- Fine del titolo -->

                    </div>
                </div>
                <!-- Fine container -->

                <!-- (stile onda) -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
            </section>
            <!-- Fine sezione "Header" -->

            <!-- Inizio sezione "Info Utente" -->
            <section class="about-section section-padding" id="sectionInfoUtente">
                <div class="container">
                    <div class="row">

                        <!-- INIZIO INFO UTENTE DA DB -->
                        <?php
                            //Connessione al database
                            Database :: connessione();

                            //Creo la query
                            $query = "SELECT * FROM Partecipante WHERE MailPart = '$mailUtente';";
                            //Eseguo la query
                            $result = Database :: eseguiQuery($query) -> fetch_all(MYSQLI_ASSOC);
                            $nomeUtente = $result[0]['NomePart'];
                            $cognomeUtente = $result[0]['CognomePart'];
                            $tipologiaUtente = $result[0]['TipologiaPart'];
                            $idUtente = $result[0]['IDPart'];
                        ?>
                        <!-- FINE INFO UTENTEDA DB -->

                        <!-- Inziio informazioni Utente -->
                        <div class="col-12">
                            <div class="contact-info mt-5">
                                <div class="contact-info-item">
                                    <div class="contact-info-body">
                                        <!-- Mail -->
                                        <strong><?php echo $mailUtente; ?></strong>
                                        <!-- Cognome e Nome -->
                                        <p class="mt-2 mb-1 text-white"><?php echo $cognomeUtente . ' ' . $nomeUtente; ?></p>
                                        <!-- Tipologia -->
                                        <p class="mt-2 mb-1 text-white"><?php echo 'Tipologia partecipante: ' . $tipologiaUtente; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fine informazioni utente -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Info Utente" -->

            <!-- Inizio sezione "Gestisci Eventi" -->
            <section class="about-section section-padding" id="sectionGestisciEventi">
                <div class="container">
                    <div class="row">

                        <!-- INIZIO EVENTI DI CUI SONO RELATORE (Questo solo nel caso sia relatore) -->
                        <?php
                            if ($tipologiaUtente == "Relatore") {
                                echo '<h2 class="mb-lg-5 mb-4 text-center">Complimenti! Sei anche un relatore</h2>';
                            }

                            $queryRelaziona =
                                "SELECT Programma.IDProgramma, Programma.FasciaOraria, Programma.IDSpeech, Programma.NomeSala
                                FROM Programma
                                JOIN Relaziona ON Programma.IDProgramma = Relaziona.IDProgramma
                                JOIN Relatore ON Relaziona.IDRel = Relatore.IDRel
                                WHERE Relatore.MailRel = '$mailUtente'";

                            //Eseguo la query (eventi disponibili)
                            $datiRelaziona = Database :: eseguiQuery($queryRelaziona) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Ciclo for -->
                            for ($i=0; $i < count($datiRelaziona); $i++) {
                                //Stampo dinamicamente la card con i dati ricavati
                                echo '<div class="row custom-block custom-block-bg mb-3">';
                                echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                echo '        <div class="custom-block-image-wrap">';
                                echo '          <img src="../images/sfondoCard.png" class="custom-block-image img-fluid" alt="">';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                echo '        <div class="custom-block-info mt-2">';
                                echo '            <a href="#" class="events-title mb-3">ID programma: ' . $datiRelaziona[$i]['IDProgramma'] . '</a>';
                                echo '            <br> <p class="mb-0">Fascia oraria: ' . $datiRelaziona[$i]['FasciaOraria'] . '</p>';        
                                echo '            <div class="border-top mt-4 pt-3">';
                                echo '              <p class="mb-0"><strong>Sala:</strong> ' . $datiRelaziona[$i]['NomeSala'] .'</p>';
                                echo '              <p class="mb-0"><strong>ID Speech:</strong> ' . $datiRelaziona[$i]['IDSpeech'] . '</p>';
                                echo '            </div>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';
                            }

                        ?>
                        <!-- FINE VENETI DI CUI SONO RELATORE (Questo solo nel caso sia relatore) -->

                        <!-- Titolo (Eventi a cui partecipo) -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Gestione eventi a cui ti sei registrato</h2>
                        </div>

                        <!-- INIZIO EVENTI DA DB (a cui partecipo) -->
                        <?php
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $querySpeechPartecipo =
                            "SELECT 
                                Programma.*,
                                Speech.Titolo AS TitoloSpeech,
                                Speech.Argomento AS ArgomentoSpeech,
                                DAY(Programma.FasciaOraria) AS giorno,
                                CONCAT(LEFT(MONTHNAME(Programma.FasciaOraria), 3)) AS mese,
                                YEAR(Programma.FasciaOraria) AS anno,
                                HOUR(Programma.FasciaOraria) AS ora,
                                LPAD(MINUTE(Programma.FasciaOraria), 2, '0') AS minuti,
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

                            //Eseguo la query (eventi a cui partecipo)
                            $datiProgramma = Database :: eseguiQuery($querySpeechPartecipo) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Controllo se gli eventi a cui partecipo sono 0 --> stampo un messaggio
                            if ( count($datiProgramma) == 0) {
                                echo '<h4 class="text-center mb-5">Al momento non partecipi a nessun evento</h4>';
                            }
                            //Altriementi --> Stampo gli eventi (a cui partecipo)
                            else {
                                //Ciclo for -->
                                for ($i=0; $i < count($datiProgramma); $i++) {
                                    //Stampo dinamicamente la card con i dati ricavati
                                    echo '<a name="' . $datiProgramma[$i]['TitoloSpeech'] . 'CARDSpeech"></a>';
                                    echo '<div class="row custom-block custom-block-bg mb-3">';
                                    echo '    <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">';
                                    echo '        <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">';
                                    echo '            <h6 class="custom-block-date mb-lg-1 mb-0 me-3 me-lg-0 me-md-0">' . $datiProgramma[$i]['giorno'] . '</h6>';
                                    echo '            <strong class="text-white">' . $datiProgramma[$i]['mese'] . " " . $datiProgramma[$i]['anno'] . '</strong>';
                                    echo '        </div>';
                                    echo '            <div class="border-top mt-4 pt-3">';
                                    echo '              <p class="mb-0">&#128337; ' . $datiProgramma[$i]['ora'] . ':' . $datiProgramma[$i]['minuti'] .'</p>';
                                    echo '              <p class="mb-0">&#128715;&#65039; ' . $datiProgramma[$i]['NomeSala'] . '</p>';
                                    echo '            </div>';
                                    echo '    </div>';
                                    echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                    echo '        <div class="custom-block-image-wrap">';
                                    echo '          <img src="../images/sfondoCard.png" class="custom-block-image img-fluid" alt="">';
                                    echo '        </div>';
                                    echo '    </div>';
                                    echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                    echo '        <div class="custom-block-info mt-2">';
                                    echo '            <a href="#' . $datiProgramma[$i]['TitoloSpeech'] . 'TABCalendario" class="events-title mb-3">Speech: ' . $datiProgramma[$i]['TitoloSpeech'] . '</a>';
                                    echo '            <br> <p class="mb-0">' . $datiProgramma[$i]['ArgomentoSpeech'] . '</p>';        
                                    echo '            <div class="border-top mt-4 pt-3">';
                                    echo '              <p class="mb-0"><strong>Relatore:</strong> ' . $datiProgramma[$i]['CognomeRelatore'] . ' ' . $datiProgramma[$i]['NomeRelatore'] . '</p>';
                                    echo '              <p class="mb-0"><strong>Informazioni di contatto:</strong> ' . $datiProgramma[$i]['MailRelatore'] . '</p>';
                                    echo '              <p class="mb-0"><strong>Azienda di provenienza:</strong> ' . $datiProgramma[$i]['AziendaRelatore'] . '</p>';
                                    echo '            </div>';
                                    echo '            <div class="d-flex flex-wrap border-top mt-4 pt-3">';
                                    echo '                <div class="d-flex align-items-center ms-lg-auto">';
                                    $urlAnnullaIscrizione = './annullaIscrizione.php?IDPart=' . $idUtente . '&IDProgramma=' . $datiProgramma[$i]['IDProgramma'];
                                    echo '                    <a href="' . $urlAnnullaIscrizione . '" class="btn custom-btn">Annulla iscrizione</a>';
                                    echo '                </div>';
                                    echo '            </div>';
                                    echo '        </div>';
                                    echo '    </div>';
                                    echo '</div>';
                                }
                            }
                        ?>
                        <!-- FINE EVENTI DA DB (a cui partecipo) -->

                        <!-- Titolo (Eventi disponibili)-->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Eventi disponibili</h2>
                        </div>

                        <!-- INIZIO EVENTI DA DB (a cui NON partecipo) -->
                        <?php
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $querySpeechNonPartecipo = 
                                "SELECT 
                                    Programma.*,
                                    Speech.Titolo AS TitoloSpeech,
                                    Speech.Argomento AS ArgomentoSpeech,
                                    DAY(Programma.FasciaOraria) AS giorno,
                                    CONCAT(LEFT(MONTHNAME(Programma.FasciaOraria), 3)) AS mese,
                                    YEAR(Programma.FasciaOraria) AS anno,
                                    HOUR(Programma.FasciaOraria) AS ora,
                                    LPAD(MINUTE(Programma.FasciaOraria), 2, '0') AS minuti,
                                    CASE WHEN SceglieFiltered.Partecipa = 1 THEN 1 ELSE 0 END AS Partecipa,
                                    Relatore.CognomeRel AS CognomeRelatore,
                                    Relatore.NomeRel AS NomeRelatore,
                                    Relatore.MailRel AS MailRelatore,
                                    Relatore.RagioneSocialeFK AS AziendaRelatore
                                FROM Programma
                                INNER JOIN Speech ON Programma.IDSpeech = Speech.IDSpeech
                                LEFT JOIN (
                                    SELECT IDProgramma, MAX(CASE WHEN IDPart = '$idUtente' THEN 1 ELSE 0 END) AS Partecipa
                                    FROM Sceglie
                                    GROUP BY IDProgramma
                                ) AS SceglieFiltered ON Programma.IDProgramma = SceglieFiltered.IDProgramma
                                LEFT JOIN Relaziona ON Programma.IDProgramma = Relaziona.IDProgramma
                                LEFT JOIN Relatore ON Relaziona.IDRel = Relatore.IDRel
                                WHERE SceglieFiltered.Partecipa = 0 OR SceglieFiltered.Partecipa IS NULL;";

                            //Eseguo la query (eventi disponibili)
                            $datiProgrammaDisponibili = Database :: eseguiQuery($querySpeechNonPartecipo) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Controllo se gli eventi a cui posso partecipare sono 0 --> stampo un messaggio
                            if ( count($datiProgrammaDisponibili) == 0) {
                                echo '<h4 class="text-center mb-5">Al momento non ci sono altri eventi</h4>';
                            }
                            //Altrimenti --> Stampo gli eventi (a cui posso partecipare)
                            else {
                                //Ciclo for -->
                                for ($i=0; $i < count($datiProgrammaDisponibili); $i++) {
                                    //Stampo dinamicamente la card con i dati ricavati
                                    echo '<div class="row custom-block custom-block-bg mb-3">';
                                    echo '    <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">';
                                    echo '        <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">';
                                    echo '            <h6 class="custom-block-date mb-lg-1 mb-0 me-3 me-lg-0 me-md-0">' . $datiProgrammaDisponibili[$i]['giorno'] . '</h6>';
                                    echo '            <strong class="text-white">' . $datiProgrammaDisponibili[$i]['mese'] . " " . $datiProgrammaDisponibili[$i]['anno'] . '</strong>';
                                    echo '        </div>';
                                    echo '            <div class="border-top mt-4 pt-3">';
                                    echo '              <p class="mb-0">&#128337; ' . $datiProgrammaDisponibili[$i]['ora'] . ':' . $datiProgrammaDisponibili[$i]['minuti'] .'</p>';
                                    echo '              <p class="mb-0">&#128715;&#65039; ' . $datiProgrammaDisponibili[$i]['NomeSala'] . '</p>';
                                    echo '            </div>';
                                    echo '    </div>';
                                    echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                    echo '        <div class="custom-block-image-wrap">';
                                    echo '          <img src="../images/sfondoCard.png" class="custom-block-image img-fluid" alt="">';
                                    echo '        </div>';
                                    echo '    </div>';
                                    echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                    echo '        <div class="custom-block-info mt-2">';
                                    echo '            <a href="#" class="events-title mb-3">Speech: ' . $datiProgrammaDisponibili[$i]['TitoloSpeech'] . '</a>';
                                    echo '            <br> <p class="mb-0">' . $datiProgrammaDisponibili[$i]['ArgomentoSpeech'] . '</p>';        
                                    echo '            <div class="border-top mt-4 pt-3">';
                                    echo '              <p class="mb-0"><strong>Relatore:</strong> ' . $datiProgrammaDisponibili[$i]['CognomeRelatore'] . ' ' . $datiProgrammaDisponibili[$i]['NomeRelatore'] . '</p>';
                                    echo '              <p class="mb-0"><strong>Informazioni di contatto:</strong> ' . $datiProgrammaDisponibili[$i]['MailRelatore'] . '</p>';
                                    echo '              <p class="mb-0"><strong>Azienda di provenienza:</strong> ' . $datiProgrammaDisponibili[$i]['AziendaRelatore'] . '</p>';
                                    echo '            </div>';
                                    echo '            <div class="d-flex flex-wrap border-top mt-4 pt-3">';
                                    echo '                <div class="d-flex align-items-center ms-lg-auto">';
                                    $urlEffettuaIscrizione = './effettuaIscrizione.php?IDPart=' . $idUtente . '&IDProgramma=' . $datiProgrammaDisponibili[$i]['IDProgramma'];
                                    echo '                    <a href="' . $urlEffettuaIscrizione . '" class="btn custom-btn">Effettua iscrizione</a>';
                                    echo '                </div>';
                                    echo '            </div>';
                                    echo '        </div>';
                                    echo '    </div>';
                                    echo '</div>';
                                }
                            }
                        ?>
                        <!-- FINE EVENTI DA DB (a cui NON partecipo) -->
  

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Gestisci Eventi" -->

            <!-- Inizio sezione "Calendario" -->
            <section class="about-section section-padding" id="sectionCalendario">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Calendario con i miei impegni</h2>
                        </div>

                        <!-- INIZIO DATI CALENDARIO -->
                        <?php

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

                            //Inizio della tabella
                            echo '<div class="table-responsive">';
                            echo '  <table id="mioCalendario" class="table text-center">';

                            //INIZIO HEADER TABELLA
                            //Header della tabella --> (fascia oraria)
                            echo '      <thead>';
                            echo '          <tr>';
                            echo '              <th scope="col" style="border: 1px solid #ddd;">Fascia Oraria</th>'; // Colonna per l'ora

                            //Hedaer della tabella --> (giorni con impegni)
                            foreach ($calendario as $giorno => $orari) {
                                $dataIntestazione = $giorno . ' ' . $mese . ' ' . $anno;
                                echo '          <th scope="col" style="border: 1px solid #ddd;">' . $dataIntestazione . '</th>'; // Colonne per i giorni con speech
                            }
                            
                            echo '          </tr>';
                            echo '      </thead>';
                            //FINE HEADER TABELLA

                            //INIZIO BODY TABELLA
                            echo '      <tbody>';

                            //Ciclo for --> Costruisco le righe del calendario per le ore 
                            for ($ora = 0; $ora < 24; $ora++) {
                                echo '      <tr>';
                                echo '          <th style="border: 1px solid #ddd;">' . $ora . ':00</th>'; // Colonna per l'ora

                                //Ciclo per i giorni con speech a cui partecipo -->
                                foreach ($calendario as $giorno => $orari) {
                                    echo '      <td style="border: 1px solid #ddd;">';

                                    //Inserisco il titolo dello speech nella cella
                                    if (isset($orari[$ora])) {
                                        foreach ($orari[$ora] as $titoloSpeech) {
                                            echo '<a name="' . $titoloSpeech . 'TABCalendario"></a>';
                                            echo '<a href="#' . $titoloSpeech . 'CARDSpeech">' . $titoloSpeech . ' (' . $salaSpeech .')</a>';
                                        }
                                    }

                                    echo '      </td>';
                                }

                                echo '      </tr>';
                            }

                            echo '      </tbody>';
                            //FINE BODY TABELLA

                            echo '  </table>';
                            echo '</div>';
                            $urlGeneraPDF = './generaPDF.php?ID=' . $idUtente;
                            echo '<a href="' . $urlGeneraPDF . '" class="btn btn-primary">Scarica PDF</a>';
                            //Fine della tabella
                        
                        ?>
                        <!-- FINE DATI CALENDARIO -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Calendario" -->

        </main>

        <!-- Inizio del footer -->
        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <!-- Titolo e Logo -->
                    <div class="col-lg-6 col-12 me-auto mb-5 mb-lg-0 mt-3">
                        <a class="navbar-brand d-flex align-items-center" href="#">
                            <img src="../images/logo.png" class="navbar-brand-image img-fluid" alt="">
                            <span class="navbar-brand-text">
                                Convention
                            </span>
                        </a>
                    </div>

                    <!-- Social e Crediti -->
                    <div class="col-lg-2 col-12 ms-auto">
                        <!-- Inizio collegamenti social -->
                        <ul class="social-icon mt-lg-5 mt-3 mb-4">

                            <!-- Icona Instagram -->
                            <li class="social-icon-item">
                                <a href="https://www.instagram.com/matti_bracco/" target="_blank" class="social-icon-link bi-instagram"></a>
                            </li>

                            <!-- Icona Github -->
                            <li class="social-icon-item">
                                <a href="https://github.com/MattiaBracco05" target="_blank" class="social-icon-link bi-github"></a>
                            </li>
                        </ul>
                        <!-- Fine collegamenti social -->

                        <!-- Testo crediti -->
                        <p class="copyright-text">Realizzato da: Bracco Mattia</p>
                        
                    </div>

                </div>
            </div>

            <!-- (stile onda) -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#81B29A" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
        </footer>
        <!-- Fine del footer -->


        <!-- JAVASCRIPT FILES -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/jquery.sticky.js"></script>
        <script src="../js/click-scroll.js"></script>
        <script src="../js/animated-headline.js"></script>
        <script src="../js/modernizr.js"></script>
        <script src="../js/custom.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>
</html>
