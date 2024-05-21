<?php
    //Avvio la sessione
    session_start();

    //Se l'utente non ha effettuato l'accesso --> lo reindirizzo alla pagina di login (index.php)
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        //Reindirizzo alla pagina di login
        header("Location: ../index.php");
        //Interrompo l'esecuzione dello script
        exit();
    }

    //Controllo se era già loggato (non mostro l'alert) o se si è loggato adesso
    //Controllo se era già loggato (non mostro l'alert) o se si è loggato adesso
    if (!isset($_SESSION['logged_flag']) || $_SESSION['logged_flag'] !== true) {
        //Mostra l'alert di login effettuato
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo '    Swal.fire({';
        echo '        icon: "success",';
        echo '        title: "Accesso effettuato!",';
        echo '        text: "Hai effettuato l\'accesso come amministratore.",';
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
        <title>Convention - Admin</title>

    </head>

    <body>

    <!-- Inizio dello script -->
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
    <!-- Fine dello script -->

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

                            <!-- Gestisci -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#sectionEventi" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gestisci</a>
                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                    <li><a class="dropdown-item" href="#sectionGestisciAziende">Aziende</a></li>
                                    <li><a class="dropdown-item" href="#sectionGestisciRelatori">Relatori</a></li>
                                    <li><a class="dropdown-item" href="#sectionGestisciProgrammi">Programmi</a></li>
                                    <li><a class="dropdown-item" href="#sectionGestisciSpeech">Speech</a></li>
                                    <li><a class="dropdown-item" href="#sectionGestisciPiani">Piani</a></li>
                                    <li><a class="dropdown-item" href="#sectionGestisciSale">Sale</a></li>
                                </ul>
                            </li>

                            <!-- Tabelle -->
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#sectionTabelle">Tabelle</a>
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
                                <a href="#sectionTabelle" class="link smoothscroll me-3">Tabelle</a>
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

            <!-- Inizio sezione "Gestisci Aziende" -->
            <section class="about-section section-padding" id="sectionGestisciAziende">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Gestione aziende</h2>
                        </div>

                        <!-- INIZIO AZIENDE DA DB -->
                        <?php
                            //Includo il file database.php
                            include '../php/database.php';
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $queryAziende =
                                "SELECT *
                                FROM Azienda";

                            //Eseguo la query (ricavo tutti gli eventi)
                            $aziende = Database :: eseguiQuery($queryAziende) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Ciclo for -->
                            for ($i=0; $i < count($aziende); $i++) {
                                //Stampo dinamicamente la card con i dati ricavati
                                echo '<a name="' . $aziende[$i]['RagioneSociale'] . 'CARDAziende"></a>';
                                echo '<div class="row custom-block custom-block-bg mb-3">';
                                echo '    <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">';
                                echo '        <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">';
                                echo '            <h6 class="custom-block-date mb-lg-1 mb-0 me-3 me-lg-0 me-md-0">&#128222;</h6>';
                                echo '            <a href="tel: ' . $aziende[$i]['TelefonoAzienda'] . '" class="contact-link">' . $aziende[$i]['TelefonoAzienda'] . '</a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                echo '        <div class="custom-block-image-wrap">';
                                echo '            <a href="https://www.google.com/maps/search/?api=1&query=' . $aziende[$i]['IndirizzoAzienda'] . ' "target="_blank">';
                                echo '                <img src="../images/sfondoCardAziende.jpg" class="custom-block-image img-fluid" alt="">';
                                echo '                <i class="custom-block-icon bi-geo-alt-fill"></i>';
                                echo '            </a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                echo '        <div class="custom-block-info mt-2">';
                                echo '            <a href="#' . $aziende[$i]['RagioneSociale'] . 'TABAziende" class="events-title mb-3">' . $aziende[$i]['RagioneSociale'] . '</a>';
                                echo '            <p class="mb-0">' . $aziende[$i]['IndirizzoAzienda'] . '</p>';
                                echo '        </div>';
                                echo '            <div class="d-flex flex-wrap border-top mt-4 pt-3">';
                                echo '                <div class="d-flex align-items-center ms-lg-auto">';
                                $urlEliminaAzienda = './eliminaAzienda.php?RagioneSociale=' . $aziende[$i]['RagioneSociale'];
                                echo '                    <a href="' . $urlEliminaAzienda . '" class="btn custom-btn">Elimina</a>';
                                echo '                </div>';
                                echo '            </div>';
                                echo '    </div>';
                                echo '</div>';
                            }
                        ?>
                        <!-- FINE AZIENDE DA DB -->

                        <!-- Inizio del form -->
                        <div class="col-lg-5 col-12 mx-auto">
                            <form action="./registraAzienda.php" method="post" class="custom-form membership-form shadow-lg" role="form">
                                <!-- Titolo form -->
                                <h4 class="text-white mb-4 text-center">Registra una nuova azienda</h4>

                                <!-- Ragione sociale -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="RagioneSociale" id="RagioneSociale" class="form-control" placeholder="Inserisci la ragione sociale" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Ragione sociale</label>
                                </div>

                                <!-- Indirizzo -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="Indirizzo" id="Indirizzo" class="form-control" placeholder="Inserisci l'indirizzo" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Indirizzo dell'azienda</label>
                                </div>

                                <!-- Telefono -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="Telefono" id="Telefono" pattern="[0-9]{10}" class="form-control" placeholder="Inserisci la tua email" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Telefono (Inserire senza spazi)</label>
                                </div>

                                <!-- Button per inviare i dati del form -->
                                <button type="submit" class="form-control">Registra Azienda</button>
                            </form>
                        </div>
                        <!-- Fine del form -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Gestisci Aziende" -->

            <!-- Inizio sezione "Gestisci Relatori" -->
            <section class="about-section section-padding" id="sectionGestisciRelatori">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Gestione relatori</h2>
                        </div>

                        <!-- INIZIO RELATORI DA DB -->
                        <?php
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $queryRelatori =
                                "SELECT *
                                FROM Relatore";

                            //Eseguo la query (ricavo tutti i relatori)
                            $relatori = Database :: eseguiQuery($queryRelatori) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Ciclo for -->
                            for ($i=0; $i < count($relatori); $i++) {
                                //Stampo dinamicamente la card con i dati ricavati
                                echo '<a name="' . $relatori[$i]['MailRel'] . 'CARDRelatori"></a>';
                                echo '<div class="row custom-block custom-block-bg mb-3">';
                                echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                echo '        <div class="custom-block-image-wrap">';
                                echo '            <a href="malito:' . $relatori[$i]['MailRel'] . ' "target="_blank">';
                                echo '                <img src="../images/sfondoCardRelatori.jpg" class="custom-block-image img-fluid" alt="">';
                                echo '                <i class="custom-block-icon bi-send-fill"></i>';
                                echo '            </a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                echo '        <div class="custom-block-info mt-2">';
                                echo '            <a href="#' . $relatori[$i]['MailRel'] . 'TABRelatori" class="events-title mb-3">' . $relatori[$i]['CognomeRel'] . ' ' . $relatori[$i]['NomeRel'] . '</a>';
                                echo '            <p class="mb-0">' . $relatori[$i]['MailRel'] . '<br>' . $relatori[$i]['RagioneSocialeFK'] . '</p>';
                                echo '        </div>';
                                echo '            <div class="d-flex flex-wrap border-top mt-4 pt-3">';
                                echo '                <div class="d-flex align-items-center ms-lg-auto">';
                                $urlEliminaRelatore = './eliminaRelatore.php?IDRel=' . $relatori[$i]['IDRel'];
                                echo '                    <a href="' . $urlEliminaRelatore . '" class="btn custom-btn">Elimina</a>';
                                echo '                </div>';
                                echo '            </div>';
                                echo '    </div>';
                                echo '</div>';
                            }
                        ?>
                        <!-- FINE RELATORI DA DB -->

                        <!-- Inizio del form -->
                        <div class="col-lg-5 col-12 mx-auto">
                            <form action="./associaRelatore.php" method="post" class="custom-form membership-form shadow-lg" role="form">
                                <!-- Titolo form -->
                                <h4 class="text-white mb-4 text-center">Associa un nuovo relatore</h4>

                                <!-- Mail participante -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="MailPartecipante" id="MailPartecipante" class="form-control"  pattern="[^ @]*@[^ @]*" placeholder="Inserisci la mail del partecipante" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Mail partecipante</label>
                                </div>

                                <!-- Ragione Sociale -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="RagioneSociale" id="RagioneSociale" class="form-control" placeholder="Inserisci la ragione sociale" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Ragione Sociale Azienda Corrispondente</label>
                                </div>

                                <!-- Button per inviare i dati del form -->
                                <button type="submit" class="form-control">Associa relatore</button>
                            </form>
                        </div>
                        <!-- Fine del form -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Gestisci Relatori" -->

            <!-- Inizio sezione "Gestisci Programmi" -->
            <section class="about-section section-padding" id="sectionGestisciProgrammi">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Gestione programmi</h2>
                        </div>

                        <!-- INIZIO PROGRAMMI DA DB -->
                        <?php
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $queryProgrammi =
                                "SELECT *
                                FROM Programma";

                            //Eseguo la query (ricavo tutti i programmi)
                            $programmi = Database :: eseguiQuery($queryProgrammi) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Ciclo for -->
                            for ($i=0; $i < count($programmi); $i++) {
                                //Stampo dinamicamente la card con i dati ricavati
                                echo '<a name="' . $programmi[$i]['IDProgramma'] . 'CARDProgrammi"></a>';
                                echo '<div class="row custom-block custom-block-bg mb-3">';
                                echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                echo '        <div class="custom-block-image-wrap">';
                                echo '            <a href="#">';
                                echo '                <img src="../images/sfondoCardProgrammi.jpg" class="custom-block-image img-fluid" alt="">';
                                echo '                <i class="custom-block-icon bi-tv-fill"></i>';
                                echo '            </a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                echo '        <div class="custom-block-info mt-2">';
                                echo '            <a href="#' . $programmi[$i]['IDProgramma'] . 'TABProgrammi" class="events-title mb-3">' . $programmi[$i]['FasciaOraria'] . '</a>';
                                echo '            <p class="mb-0">ID Speech associato: ' . $programmi[$i]['IDSpeech'] . '<br>' . $programmi[$i]['NomeSala'] . '</p>';
                                echo '        </div>';
                                echo '            <div class="d-flex flex-wrap border-top mt-4 pt-3">';
                                echo '                <div class="d-flex align-items-center ms-lg-auto">';
                                $urlEliminaProgramma = './eliminaProgramma.php?IDProgramma=' . $programmi[$i]['IDProgramma'];
                                echo '                    <a href="' . $urlEliminaProgramma . '" class="btn custom-btn">Elimina</a>';
                                echo '                </div>';
                                echo '            </div>';
                                echo '    </div>';
                                echo '</div>';
                            }
                        ?>
                        <!-- FINE PROGRAMMI DA DB -->

                        <!-- Inizio del form -->
                        <div class="col-lg-5 col-12 mx-auto">
                            <form action="./registraProgramma.php" method="post" class="custom-form membership-form shadow-lg" role="form">
                                <!-- Titolo form -->
                                <h4 class="text-white mb-4 text-center">Crea un nuovo programma</h4>

                                <!-- Data Programma -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="DataProgramma" id="DataProgramma" class="form-control"  pattern="\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}" placeholder="Inserisci la data e la fascia oraria" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Data e Fascia oraria</label>
                                </div>

                                <!-- ID Speech -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="number" name="IDSpeech" id="IDSpeech" class="form-control" placeholder="Inserisci l'ID dello Speech" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">ID dello Speech</label>
                                </div>

                                <!-- ID Relatore -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="number" name="IDRelatore" id="IDRelatore" class="form-control" placeholder="Inserisci l'ID del Relatore" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">ID del Relatore</label>
                                </div>

                                <!-- Nome Sala -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="NomeSala" id="NomeSala" class="form-control" placeholder="Inserisci il nome della sala" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Nome Sala</label>
                                </div>

                                <!-- Button per inviare i dati del form -->
                                <button type="submit" class="form-control">Crea programma</button>
                            </form>
                        </div>
                        <!-- Fine del form -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Gestisci Programmi" -->

            <!-- Inizio sezione "Gestisci Speech" -->
            <section class="about-section section-padding" id="sectionGestisciSpeech">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Gestione speech</h2>
                        </div>

                        <!-- INIZIO SPEECH DA DB -->
                        <?php
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $querySpeech =
                                "SELECT *
                                FROM Speech";

                            //Eseguo la query (ricavo tutti i programmi)
                            $speech = Database :: eseguiQuery($querySpeech) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Ciclo for -->
                            for ($i=0; $i < count($speech); $i++) {
                                //Stampo dinamicamente la card con i dati ricavati
                                echo '<a name="' . $speech[$i]['IDSpeech'] . 'CARDSpeech"></a>';
                                echo '<div class="row custom-block custom-block-bg mb-3">';
                                echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                echo '        <div class="custom-block-image-wrap">';
                                echo '            <a href="#">';
                                echo '                <img src="../images/sfondoCardSpeech.jpg" class="custom-block-image img-fluid" alt="">';
                                echo '                <i class="custom-block-icon bi-megaphone-fill"></i>';
                                echo '            </a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                echo '        <div class="custom-block-info mt-2">';
                                echo '            <a href="#' . $speech[$i]['IDSpeech'] . 'TABSpeech" class="events-title mb-3">' . $speech[$i]['Titolo'] . '</a>';
                                echo '            <p class="mb-0">' . $speech[$i]['Argomento'] . '</p>';
                                echo '        </div>';
                                echo '            <div class="d-flex flex-wrap border-top mt-4 pt-3">';
                                echo '                <div class="d-flex align-items-center ms-lg-auto">';
                                $urlEliminaSpeech = './eliminaSpeech.php?IDSpeech=' . $speech[$i]['IDSpeech'];
                                echo '                    <a href="' . $urlEliminaSpeech . '" class="btn custom-btn">Elimina</a>';
                                echo '                </div>';
                                echo '            </div>';
                                echo '    </div>';
                                echo '</div>';
                            }
                        ?>
                        <!-- FINE SPEECH DA DB -->

                        <!-- Inizio del form -->
                        <div class="col-lg-5 col-12 mx-auto">
                            <form action="./registraSpeech.php" method="post" class="custom-form membership-form shadow-lg" role="form">
                                <!-- Titolo form -->
                                <h4 class="text-white mb-4 text-center">Crea un nuovo speech</h4>

                                <!-- Titolo -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="Titolo" id="Titolo" class="form-control"  placeholder="Inserisci il titolo" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Titolo</label>
                                </div>

                                <!-- Argomento -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <textarea name="Argomento" id="Argomento" class="form-control"></textarea>
                                    <!-- Label -->
                                    <label for="floatingInput">Argomento</label>
                                </div>

                                <!-- Button per inviare i dati del form -->
                                <button type="submit" class="form-control">Crea speech</button>
                            </form>
                        </div>
                        <!-- Fine del form -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Gestisci Speech" -->

            <!-- Inizio sezione "Gestisci Piani" -->
            <section class="about-section section-padding" id="sectionGestisciPiani">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Gestione piani</h2>
                        </div>

                        <!-- INIZIO PIANI DA DB -->
                        <?php
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $queryPiani =
                                "SELECT *
                                FROM Piano";

                            //Eseguo la query (ricavo tutti i programmi)
                            $piani = Database :: eseguiQuery($queryPiani) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Ciclo for -->
                            for ($i=0; $i < count($piani); $i++) {
                                //Stampo dinamicamente la card con i dati ricavati
                                echo '<a name="' . $piani[$i]['Numero'] . 'CARDPiani"></a>';
                                echo '<div class="row custom-block custom-block-bg mb-3">';
                                echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                echo '        <div class="custom-block-image-wrap">';
                                echo '            <a href="#">';
                                echo '                <img src="../images/sfondoCardPiani.jpg" class="custom-block-image img-fluid" alt="">';
                                echo '                <i class="custom-block-icon bi-hammer"></i>';
                                echo '            </a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">';
                                echo '        <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">';
                                echo '            <h6 class="custom-block-date mb-lg-1 mb-0 me-3 me-lg-0 me-md-0">&#127970;</h6>';
                                echo '            <a href="#' . $piani[$i]['Numero'] . 'TABPiani" class="contact-link">' . $piani[$i]['Numero'] . '</a>';
                                echo '        </div>';
                                echo '            <div class="d-flex flex-wrap border-top mt-4 pt-3">';
                                echo '                <div class="d-flex align-items-center ms-lg-auto">';
                                $urlEliminaPiano = './eliminaPiano.php?Numero=' . $piani[$i]['Numero'];
                                echo '                    <a href="' . $urlEliminaPiano . '" class="btn custom-btn">Elimina</a>';
                                echo '                </div>';
                                echo '            </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                echo '    </div>';
                                echo '</div>';
                            }
                        ?>
                        <!-- FINE PIANI DA DB -->

                        <!-- Inizio del form -->
                        <div class="col-lg-5 col-12 mx-auto">
                            <form action="./registraPiano.php" method="post" class="custom-form membership-form shadow-lg" role="form">
                                <!-- Titolo form -->
                                <h4 class="text-white mb-4 text-center">Crea un nuovo piano</h4>

                                <!-- Numero -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="number" name="Numero" id="Numero" class="form-control"  placeholder="Inserisci il numero" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Numero</label>
                                </div>

                                <!-- Button per inviare i dati del form -->
                                <button type="submit" class="form-control">Crea Piano</button>
                            </form>
                        </div>
                        <!-- Fine del form -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Gestisci Piani" -->

            <!-- Inizio sezione "Gestisci Sale" -->
            <section class="about-section section-padding" id="sectionGestisciSale">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Gestione sale</h2>
                        </div>

                        <!-- INIZIO SALE DA DB -->
                        <?php
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $querySale =
                                "SELECT *
                                FROM Sala";

                            //Eseguo la query (ricavo tutti i programmi)
                            $sale = Database :: eseguiQuery($querySale) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Ciclo for -->
                            for ($i=0; $i < count($sale); $i++) {
                                //Stampo dinamicamente la card con i dati ricavati
                                echo '<a name="' . $sale[$i]['NomeSala'] . 'CARDSale"></a>';
                                echo '<div class="row custom-block custom-block-bg mb-3">';
                                echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                echo '        <div class="custom-block-image-wrap">';
                                echo '            <a href="#">';
                                echo '                <img src="../images/sfondoCardSale.jpg" class="custom-block-image img-fluid" alt="">';
                                echo '                <i class="custom-block-icon bi-megaphone-fill"></i>';
                                echo '            </a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                echo '        <div class="custom-block-info mt-2">';
                                echo '            <a href="#' . $sale[$i]['NomeSala'] . 'TABSale" class="events-title mb-3">' . $sale[$i]['NomeSala'] . '</a>';
                                echo '            <p class="mb-0">Posti totali: ' . $sale[$i]['NpostiSala'] . '</p>';
                                echo '        </div>';
                                echo '            <div class="d-flex flex-wrap border-top mt-4 pt-3">';
                                echo '                <div class="d-flex align-items-center ms-lg-auto">';
                                $urlEliminaSala = './eliminaSala.php?NomeSala=' . $sale[$i]['NomeSala'];
                                echo '                    <a href="' . $urlEliminaSala . '" class="btn custom-btn">Elimina</a>';
                                echo '                </div>';
                                echo '            </div>';
                                echo '    </div>';
                                echo '</div>';
                            }

                        ?>
                        <!-- FINE SALE DA DB -->

                        <!-- Inizio del form -->
                        <div class="col-lg-5 col-12 mx-auto">
                            <form action="./registraSala.php" method="post" class="custom-form membership-form shadow-lg" role="form">
                                <!-- Titolo form -->
                                <h4 class="text-white mb-4 text-center">Crea un nuova sala</h4>

                                <!-- Nome -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="Nome" id="Nome" class="form-control"  placeholder="Inserisci il nome" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Nome</label>
                                </div>

                                <!-- Posti -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="number" name="Posti" id="Posti" class="form-control"  placeholder="Inserisci il numero di posti" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Posti totali</label>
                                </div>

                                <!-- Numero -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="number" name="Piano" id="Piano" class="form-control"  placeholder="Inserisci il piano" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Piano</label>
                                </div>

                                <!-- Button per inviare i dati del form -->
                                <button type="submit" class="form-control">Crea Sala</button>
                            </form>
                        </div>
                        <!-- Fine del form -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Gestisci Sale" -->

            <!-- Inizio sezione "Gestisci Tabelle" -->
            <section class="about-section section-padding" id="sectionTabelle">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Tabelle</h2>
                        </div>

                        <!-- INIZIO TABELLA AZIENDE -->
                        <div class="col-lg-12 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Aziende</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">Ragione Sociale</th>
                                            <th scope="row" class="text-start">Indirizzo</th>
                                            <th scope="row" class="text-start">Telefono</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO AZIENDE DA DB -->
                                        <?php
                                            //Ciclo for -->
                                            for ($i=0; $i < count($aziende); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<a name="' . $aziende[$i]['RagioneSociale'] . 'TABAziende"></a>';
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start"><a href="#' . $aziende[$i]['RagioneSociale'] . 'CARDAziende">' . $aziende[$i]['RagioneSociale'] . '</a></th>';
                                                echo '<th scope="row" class="text-start">' . $aziende[$i]['IndirizzoAzienda'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $aziende[$i]['TelefonoAzienda'] . '</th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE AZIENDE DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA AZIENDE -->

                        <!-- INIZIO TABELLA RELATORI -->
                        <div class="col-lg-12 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Relatori</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">ID</th>
                                            <th scope="row" class="text-start">Cognome</th>
                                            <th scope="row" class="text-start">Nome</th>
                                            <th scope="row" class="text-start">Mail</th>
                                            <th scope="row" class="text-start">Azienda</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO RELATORI DA DB -->
                                        <?php
                                            //Ciclo for -->
                                            for ($i=0; $i < count($relatori); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<a name="' . $relatori[$i]['MailRel'] . 'TABRelatori"></a>';
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start"><a href="#' . $relatori[$i]['MailRel'] . 'CARDRelatori">' . $relatori[$i]['IDRel'] . '</a></th>';
                                                echo '<th scope="row" class="text-start">' . $relatori[$i]['CognomeRel'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $relatori[$i]['NomeRel'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $relatori[$i]['MailRel'] . '</th>';
                                                echo '<th scope="row" class="text-start" style="box-shadow: 2px 2px 2px 4px rgba(47, 65, 111, 0.5);">' . $relatori[$i]['RagioneSocialeFK'] . '</th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE RELATORI DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA RELATORI -->

                        <!-- INIZIO TABELLA PIANI -->
                        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Piani</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">Piano</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO PIANI DA DB -->
                                        <?php
                                            //Ciclo for -->
                                            for ($i=0; $i < count($piani); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<a name="' . $piani[$i]['Numero'] . 'TABPiani"></a>';
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start"><a href="#' . $piani[$i]['Numero'] . 'CARDPiani">' . $piani[$i]['Numero'] . '</a></th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE PIANI DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA PIANI -->

                        <!-- INIZIO TABELLA SALE -->
                        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Sale</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">Nome</th>
                                            <th scope="row" class="text-start">Capienza</th>
                                            <th scope="row" class="text-start">Piano</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO SALE DA DB -->
                                        <?php
                                            //Ciclo for -->
                                            for ($i=0; $i < count($sale); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<a name="' . $sale[$i]['NomeSala'] . 'TABSale"></a>';
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start"><a href="#' . $sale[$i]['NomeSala'] . 'CARDSale">' . $sale[$i]['NomeSala'] . '</a></th>';
                                                echo '<th scope="row" class="text-start">' . $sale[$i]['NpostiSala'] . '</th>';
                                                echo '<th scope="row" class="text-start"  style="box-shadow: 2px 2px 2px 4px rgba(47, 65, 111, 0.5);">' . $sale[$i]['Numero'] . '</th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE SALE DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA SALE -->

                        <!-- INIZIO TABELLA PROGRAMMI -->
                        <div class="col-lg-12 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Programmi</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">ID</th>
                                            <th scope="row" class="text-start">Fascia Oraria</th>
                                            <th scope="row" class="text-start">ID Speech</th>
                                            <th scope="row" class="text-start">Nome Sala</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO PROGRAMMI DA DB -->
                                        <?php
                                            //Ciclo for -->
                                            for ($i=0; $i < count($programmi); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<a name="' . $programmi[$i]['IDProgramma'] . 'TABProgrammi"></a>';
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start"><a href="#' . $programmi[$i]['IDProgramma'] . 'CARDProgrammi">' . $programmi[$i]['IDProgramma'] . '</a></th>';
                                                echo '<th scope="row" class="text-start">' . $programmi[$i]['FasciaOraria'] . '</th>';
                                                echo '<th scope="row" class="text-start"  style="box-shadow: 2px 2px 2px 4px rgba(47, 65, 111, 0.5);">' . $programmi[$i]['IDSpeech'] . '</th>';
                                                echo '<th scope="row" class="text-start"  style="box-shadow: 3px 2px 2px 4px rgba(47, 65, 111, 0.5);">' . $programmi[$i]['NomeSala'] . '</th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE PROGRAMMI DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA PROGRAMMI -->

                        <!-- INIZIO TABELLA SPEECH -->
                        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Speech</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">ID</th>
                                            <th scope="row" class="text-start">Titolo</th>
                                            <th scope="row" class="text-start">Argomento</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO SPEECH DA DB -->
                                        <?php
                                            //Ciclo for -->
                                            for ($i=0; $i < count($speech); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<a name="' . $speech[$i]['IDSpeech'] . 'TABSpeech"></a>';
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start"><a href="#' . $speech[$i]['IDSpeech'] . 'CARDSpeech">' . $speech[$i]['IDSpeech'] . '</a></th>';
                                                echo '<th scope="row" class="text-start">' . $speech[$i]['Titolo'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $speech[$i]['Argomento'] . '</th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE SPEECH DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA SPEECH -->

                        <!-- INIZIO TABELLA UTENTI -->
                        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Utenti</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start">ID</th>
                                            <th scope="row" class="text-start">Mail</th>
                                            <th scope="row" class="text-start">Azione</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO UTENTI DA DB -->
                                        <?php
                                            //Connessione al DB
                                            Database :: connessione();

                                            //Creo la query da eseguire
                                            $queryUtenti =
                                                "SELECT *
                                                FROM Utenti";

                                            //Eseguo la query (ricavo tutti gli utenti)
                                            $utenti = Database :: eseguiQuery($queryUtenti) -> fetch_all(MYSQLI_ASSOC);
                                            
                                            //Ciclo for -->
                                            for ($i=0; $i < count($utenti); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start">' . $utenti[$i]['IDUtente'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $utenti[$i]['MailUtente'] . '</th>';
                                                $urlEliminaUtente = './eliminaUtente.php?ID=' . $utenti[$i]['IDUtente'];
                                                echo '<th> <a href="' . $urlEliminaUtente . '" class="btn btn-warning">Bandisci</a> </th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE UTENTI DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA UTENTI -->

                        <!-- INIZIO TABELLA PARTECIPANTI -->
                        <div class="col-lg-12 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Partecipanti</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">ID</th>
                                            <th scope="row" class="text-start">Cognome</th>
                                            <th scope="row" class="text-start">Nome</th>
                                            <th scope="row" class="text-start">Mail</th>
                                            <th scope="row" class="text-start">Tipologia</th>
                                            <th scope="row" class="text-start">ID Utente</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO PARTECIPANTI DA DB -->
                                        <?php
                                            //Connessione al DB
                                            Database :: connessione();

                                            //Creo la query da eseguire
                                            $queryPartecipanti =
                                            "SELECT *
                                            FROM Partecipante";

                                            //Eseguo la query (ricavo tutti gli utenti)
                                            $partecipanti = Database :: eseguiQuery($queryPartecipanti) -> fetch_all(MYSQLI_ASSOC);
                                            
                                            //Ciclo for -->
                                            for ($i=0; $i < count($partecipanti); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start">' . $partecipanti[$i]['IDPart'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $partecipanti[$i]['CognomePart'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $partecipanti[$i]['NomePart'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $partecipanti[$i]['MailPart'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $partecipanti[$i]['TipologiaPart'] . '</th>';
                                                echo '<th scope="row" class="text-start" style="box-shadow: 2px 2px 2px 4px rgba(47, 65, 111, 0.5);">' . $partecipanti[$i]['IDUtente'] . '</th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE PARTECIPANTI DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA PARTECIPANTI -->

                        <!-- INIZIO TABELLA RELAZIONA -->
                        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Relaziona</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">ID Relatore</th>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">ID Programma</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO RELAZIONA DA DB -->
                                        <?php
                                            //Connessione al DB
                                            Database :: connessione();

                                            //Creo la query da eseguire
                                            $queryRelaziona =
                                            "SELECT *
                                            FROM Relaziona";

                                            //Eseguo la query (ricavo tutti gli utenti)
                                            $relaziona = Database :: eseguiQuery($queryRelaziona) -> fetch_all(MYSQLI_ASSOC);
                                            
                                            //Ciclo for -->
                                            for ($i=0; $i < count($relaziona); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start">' . $relaziona[$i]['IDRel'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $relaziona[$i]['IDProgramma'] . '</th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE RELAZIONA DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA RELAZIONA -->

                        <!-- INIZIO TABELLA SCEGLIE -->
                        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Sceglie</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">ID Partecipante</th>
                                            <th scope="row" class="text-start" style="font-weight: bold; text-decoration: underline;">ID Programma</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO SCEGLIE DA DB -->
                                        <?php
                                            //Connessione al DB
                                            Database :: connessione();

                                            //Creo la query da eseguire
                                            $querySceglie =
                                            "SELECT *
                                            FROM Sceglie
                                            ORDER BY IDPart";

                                            //Eseguo la query (ricavo tutti gli utenti)
                                            $sceglie = Database :: eseguiQuery($querySceglie) -> fetch_all(MYSQLI_ASSOC);
                                            
                                            //Ciclo for -->
                                            for ($i=0; $i < count($sceglie); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start">' . $sceglie[$i]['IDPart'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $sceglie[$i]['IDProgramma'] . '</th>';
                                                echo '</tr>';
                                            }
                                        
                                        ?>
                                        <!-- FINE SCEGLIE DA DB -->
                                        
                                    </tbody>
                                    <!-- Fine del body -->

                                </table>
                                <!-- Fine della tabella -->
                            </div>
                        </div>
                        <!-- FINE TABELLA SCEGLIE -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Gestisci Tabelle" -->

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