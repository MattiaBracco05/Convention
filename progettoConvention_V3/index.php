<?php
//Avvio la sessione
session_start();

//Funzione per autenticare gli utenti (e anche l'admin)
function autenticaUtente($email, $password) {
    //Includo il file database.php
    include './php/database.php';
    //Connessione al database
    Database :: connessione();

    //Creo la query da eseguire
    $query =
        "SELECT *
        FROM Utenti
        WHERE MailUtente = '$email' AND PswUtente = '$password'";
    
    //Eseguo la query (Controllo le credenziali dell'utente)
    $risultato = Database :: eseguiQuery($query);

    //Verifico se è stata trovata una riga corrispondente --> utente autenticato (return true)
    if ($risultato && $risultato -> num_rows > 0) {
        return true;
    }
    //Altrimenti --> utente non trovato o credenziali errate (return false)
    else {
        return false;
    }
}

//Altrimenti --> bisogna efettuare il login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Ricavo i valori inseriti dall'utente
    $username = $_POST['member-login-mail'];
    $password = $_POST['member-login-password'];

    //Cirfro la psw con sha256
    $passwordCifrata = hash('sha256', $password);

    //Controllo l'username, se corrisponde a quello per l'admin -->
    if ($username === 'admin@admin') {
        
        //Controllo per autenticare l'admin (con le credenziali memorizzate nel DB)
        if (autenticaUtente($username, $passwordCifrata)) {
            //Salvo nella sessione l'username
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;

            //Vado alla pagina "homeAdmin.php"
            header("Location: pagine/homeAdmin.php");
            exit();
        }
    }

    //Altrimenti --> provo ad autenticare come utente
    else {

        //Controllo le credenziali, se corrispondono a quelle di un utente -->
        if (autenticaUtente($username, $passwordCifrata)) {
            //Salvo nella sessione l'username
            $_SESSION['logged_in'] = true;        
            $_SESSION['username'] = $username;

            //Vado alla pagina "homeUtente.php"
            header("Location: pagine/homeUtente.php");
            exit();
        }

        //Altrimenti --> messaggio di errore (Sweet Alert)
        else {
            //Credenziali errate, mostra un popup di errore utilizzando SweetAlert2
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    Swal.fire({';
            echo '        icon: "error",';
            echo '        title: "Credenziali non valide",';
            echo '        text: "Le credenziali inserite non sono corrette. Riprova.",';
            echo '        confirmButtonColor: "#3085d6",';
            echo '        confirmButtonText: "OK"';
            echo '    });';
            echo '});';
            echo '</script>';
            
            //Vado alla pagina "index.php"
            header("Location: ./index.php");
            exit();
        }
    }
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
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/templatemo-tiya-golf-club.css" rel="stylesheet">

        <!-- Titolo scheda -->
        <title>5L Bracco - Convetion</title>

    </head>
    
    <body>

        <main>
            <!-- Inizio della navbar -->
            <nav class="navbar navbar-expand-lg">                
                <div class="container">
                    
                    <!-- Logo e Titolo -->
                    <a class="navbar-brand d-flex align-items-center" href="index.php">
                        <img src="images/logo.png" class="img-fluid">
                        <span class="navbar-brand-text">
                            Convention
                        </span>
                    </a>

                    <!-- Button login (per navbar chiusa) -->
                    <div class="d-lg-none ms-auto me-3">
                        <a class="btn custom-btn custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Login</a>
                    </div>
    
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
    
                            <!-- About -->
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#sectionAbout">About</a>
                            </li>

                            <!-- Registrati -->
                            <li class="nav-item">
                                <a class="nav-link click-scroll" href="#sectionRegistrati">Registrati</a>
                            </li>

                            <!-- Eventi -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#sectionEventi" id="navbarLightDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Eventi</a>

                                <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                    <li><a class="dropdown-item" href="#sectionEventi">Eventi</a></li>
                                    <li><a class="dropdown-item" href="#sectionAziende">Aziende</a></li>
                                    <li><a class="dropdown-item" href="#sectionSale">Sale</a></li>
                                    <li><a class="dropdown-item" href="#sectionSale">Relatori</a></li>
                                </ul>
                            </li>

                        </ul>

                        <!-- Button login (per navbar grande) -->
                        <div class="d-none d-lg-block ms-lg-3">
                            <a class="btn custom-btn custom-border-btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Login</a>
                        </div>

                    </div>
                    <!-- Fine della navbar (collpase) -->

                </div>
            </nav>
            <!-- Fine della navbar -->

            <!-- Inizio finestra login -->
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">                
                
                <!-- Inizio titolo e button per chiudere la finestra -->
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Convention Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <!-- Fine titolo e button per chiudere la finestra -->
                
                <!-- Inizio input dei dati -->
                <div class="offcanvas-body d-flex flex-column">
                    <!-- Inizio del form -->
                    <form class="custom-form member-login-form" action="index.php" method="post" role="form">
                        <div class="member-login-form-body">
                            
                            <!-- Mail -->
                            <div class="mb-4">
                                <!-- Label -->
                                <label class="form-label mb-2" for="member-login-mail">Mail</label>
                                <!-- Input text -->
                                <input type="text" name="member-login-mail" id="member-login-mail" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Inserisci la tua mail" required>
                            </div>

                            <!-- Passowrd -->
                            <div class="mb-4">
                                <!-- Label -->
                                <label class="form-label mb-2" for="member-login-password">Password</label>
                                <!-- Login -->
                                <input type="password" name="member-login-password" id="member-login-password" pattern="[0-9a-zA-Z]{8,16}" class="form-control" placeholder="Inserisci la tua password" required="">
                            </div>

                            <!-- Button login -->
                            <div class="col-lg-5 col-md-7 col-8 mx-auto">
                                <button type="submit" class="form-control">Login</button>
                            </div>
                        </div>
                    </form>
                    <!-- Fine del form -->
                </div>
                <!-- Fine input dei dati -->

                <!-- (stile onda) -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#3D405B" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
            </div>
            <!-- Fine finestra login -->
            
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
                                <a href="#sectionRegistrati" class="btn custom-btn smoothscroll me-3">Registrati</a>
                                <a href="#sectionAbout" class="link smoothscroll me-3">About</a>
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

            <!-- Inizio sezione "About" -->
            <section class="about-section section-padding" id="sectionAbout">
                <div class="container">
                    <div class="row">

                        <!-- Realizzato da... -->
                        <div class="col-lg-12 col-12 text-center">
                            <h2 class="mb-lg-5 mb-4">Realizzato da</h2>
                        </div>

                        <!-- Nasctia del progetto (descrizione) -->
                        <div class="col-lg-5 col-12 me-auto mb-4 mb-lg-0">
                            <!-- Titolo -->
                            <h3 class="mb-3">Nascita del progetto</h3>
                            <!-- Descrizione -->
                            <p>Progetto nato in vista dell'esame di maturità dell'anno scolastico 2023/2024. Questo unisce le conoscenze di PHP e SQL allo scopo di creare un sito (collegato ad un database) per la gestione dei meeting.</p>
                        </div>

                        <!-- Inizio persona -->
                        <div class="col-lg-3 span-3 col-md-6 col-12 mb-4 mb-lg-0 mb-md-0">
                            <div class="member-block">
                                <div class="member-block-image-wrap">

                                    <!-- Immagine -->
                                    <img src="images/fotoProfilo.jpg" class="member-block-image img-fluid" alt="">

                                    <!-- Inizio collegamenti social -->
                                    <ul class="social-icon">
                                        <!-- Collegamento a Instagram -->
                                        <li class="social-icon-item">
                                            <a href="https://www.instagram.com/matti_bracco/" target="_blank" class="social-icon-link bi-instagram"></a>
                                        </li>

                                        <!-- Collegamento a Github -->
                                        <li class="social-icon-item">
                                            <a href="https://github.com/MattiaBracco05" target="_blank" class="social-icon-link bi-github"></a>
                                        </li>
                                    </ul>
                                    <!-- Fine collegamenti social -->
                                </div>

                                <!-- Nome e ruolo -->
                                <div class="member-block-info d-flex align-items-center">
                                    <h4>Mattia Bracco</h4>
                                    <p class="ms-auto">Studente</p>
                                </div>

                            </div>
                        </div>
                        <!-- Fine persona -->

                    </div>
                </div>
            <!-- Fine sezione "About" -->

            <!-- Inizio sezione "Registrati" -->
            <section class="membership-section section-padding" id="sectionRegistrati">
                <div class="container">
                    <div class="row">

                        <!-- Inizio frase -->
                        <div class="col-lg-12 col-12 text-center mx-auto mb-lg-5 mb-4">
                            <h2>Sei un nuovo partecipante? Registrati!</h2>
                        </div>
                        <!-- Fine frase -->

                        <!-- Inizio del form -->
                        <div class="col-lg-5 col-12 mx-auto">
                            <form action="./pagine/registrati.php" method="post" class="custom-form membership-form shadow-lg" role="form">
                                <!-- Titolo form -->
                                <h4 class="text-white mb-4">Registrati</h4>

                                <!-- Cognome -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="Cognome" id="Cognome" class="form-control" placeholder="Inserisci il tuo cognome" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Cognome</label>
                                </div>

                                <!-- Nome -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="text" name="Nome" id="Nome" class="form-control" placeholder="Inserisci il tuo Nome" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Nome</label>
                                </div>

                                <!-- Mail -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="email" name="Email" id="Email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Inserisci la tua email" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Email</label>
                                </div>

                                <!-- Password -->
                                <div class="form-floating">
                                    <!-- Input -->
                                    <input type="password" name="Password" id="Password" pattern="[0-9a-zA-Z]{8,16}" class="form-control" placeholder="Scegli una password" required="">
                                    <!-- Label -->
                                    <label for="floatingInput">Password</label>
                                </div>

                                <!-- Button per inviare i dati del form -->
                                <button type="submit" class="form-control">Registrati</button>
                            </form>
                        </div>
                        <!-- Fine del form -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Registrati" -->

            <!-- Inizio sezione "Eventi" -->
            <section class="events-section section-bg section-padding" id="sectionEventi">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12">
                            <h2 class="mb-lg-3">Eventi in programma</h2>
                        </div>

                        <!-- INIZIO EVENTI DA DB -->
                        <?php
                            //Includo il file database.php
                            include './php/database.php';
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $programmaSpeechQuery =
                            "SELECT 
                                Programma.*,
                                Speech.Titolo,
                                Speech.Argomento,
                                DAY(Programma.FasciaOraria) AS giorno,
                                CONCAT(LEFT(MONTHNAME(Programma.FasciaOraria), 3)) AS mese,
                                YEAR(Programma.FasciaOraria) AS anno,
                                HOUR(Programma.FasciaOraria) AS ora
                            FROM Programma
                            INNER JOIN Speech ON Programma.IDSpeech = Speech.IDSpeech;";

                            //Eseguo la query (ricavo tutti gli eventi)
                            $datiProgramma = Database :: eseguiQuery($programmaSpeechQuery) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Ciclo for -->
                            for ($i=0; $i < count($datiProgramma); $i++) {
                                //Stampo dinamicamente la card con i dati ricavati
                                echo '<div class="row custom-block custom-block-bg mb-3">';
                                echo '    <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">';
                                echo '        <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">';
                                echo '            <h6 class="custom-block-date mb-lg-1 mb-0 me-3 me-lg-0 me-md-0">' . $datiProgramma[$i]['giorno'] . '</h6>';
                                echo '            <strong class="text-white">' . $datiProgramma[$i]['mese'] . " " . $datiProgramma[$i]['anno'] . '</strong>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                echo '        <div class="custom-block-image-wrap">';
                                echo '            <a href="#sectionRegistrati">';
                                echo '                <img src="images/sfondoCard.png" class="custom-block-image img-fluid" alt="">';
                                echo '                <i class="custom-block-icon bi-dash-circle"></i>';
                                echo '            </a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                echo '        <div class="custom-block-info mt-2">';
                                echo '            <a href="#sectionRegistrati" class="events-title mb-3">Speech: ' . $datiProgramma[$i]['Titolo'] . '</a>';
                                echo '            <p class="mb-0">' . $datiProgramma[$i]['Argomento'] . '</p>';
                                echo '            <div class="d-flex flex-wrap border-top mt-4 pt-3">';
                                echo '                <div class="d-flex align-items-center ms-lg-auto">';
                                echo '                    <a href="#sectionRegistrati" class="btn custom-btn">Partecipa</a>';
                                echo '                </div>';
                                echo '            </div>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';
                            }
                        ?>
                        <!-- FINE EVENTI DA DB -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Eventi" -->

            <!-- Inizio sezione "Aziende" -->
            <section class="events-section section-bg section-padding" id="sectionAziende">
                <div class="container">
                    <div class="row">

                        <!-- Titolo -->
                        <div class="col-lg-12 col-12">
                            <h2 class="mb-lg-3">Aziende partecipanti</h2>
                        </div>

                        <!-- INIZIO AZIENDE DA DB -->
                        <?php
                            //Connessione al DB
                            Database :: connessione();

                            //Creo la query da eseguire
                            $aziendeRegistrateQuery =
                            "SELECT *
                            FROM Azienda";

                            //Eseguo la query (ricavo tutte le aziende)
                            $datiAziende = Database :: eseguiQuery($aziendeRegistrateQuery) -> fetch_all(MYSQLI_ASSOC);
                            
                            //Ciclo for -->
                            for ($i=0; $i < count($datiAziende); $i++) {
                                //Stampo dinamicamente la card con i dati ricavati
                                echo '<div class="row custom-block custom-block-bg mb-3">';
                                echo '    <div class="col-lg-2 col-md-4 col-12 order-2 order-md-0 order-lg-0">';
                                echo '        <div class="custom-block-date-wrap d-flex d-lg-block d-md-block align-items-center mt-3 mt-lg-0 mt-md-0">';
                                echo '            <h6 class="custom-block-date mb-lg-1 mb-0 me-3 me-lg-0 me-md-0">&#128222;</h6>';
                                echo '            <a href="tel: ' . $datiAziende[$i]['TelefonoAzienda'] . '" class="contact-link">' . $datiAziende[$i]['TelefonoAzienda'] . '</a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-4 col-md-8 col-12 order-1 order-lg-0">';
                                echo '        <div class="custom-block-image-wrap">';
                                echo '            <a href="https://www.google.com/maps/search/?api=1&query=' . $datiAziende[$i]['IndirizzoAzienda'] . ' "target="_blank">';
                                echo '                <img src="images/sfondoCardAziende.jpg" class="custom-block-image img-fluid" alt="">';
                                echo '                <i class="custom-block-icon bi-geo-alt-fill""></i>';
                                echo '            </a>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '    <div class="col-lg-6 col-12 order-3 order-lg-0">';
                                echo '        <div class="custom-block-info mt-2">';
                                echo '            <a href="#" class="events-title mb-3">' . $datiAziende[$i]['RagioneSociale'] . '</a>';
                                echo '            <p class="mb-0">' . $datiAziende[$i]['IndirizzoAzienda'] . '</p>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';
                            }
                        
                        ?>
                        <!-- FINE AZIENDE DA DB -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Aziende" -->

            <!-- Inizio sezione "Sale e Relatori" -->
            <section class="events-section section-bg section-padding" id="sectionSale">
                <div class="container">
                    <div class="row">

                        <!-- Inizio sale -->
                        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">Le nostre sale</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th style="width: 33%;" scope="row" class="text-start">Nome Sala</th>
                                            <th style="width: 33%;" scope="row" class="text-start">Capienza</th>
                                            <th style="width: 33%;" scope="row" class="text-start">Piano</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO SALE DA DB -->
                                        <?php
                                            //Connessione al DB
                                            Database :: connessione();

                                            //Creo la query da eseguire
                                            $saleQuery =
                                            "SELECT Sala.NomeSala, Sala.NpostiSala, Sala.Numero
                                            FROM Sala;";

                                            //Eseguo la query (ricavo tutte le sale)
                                            $datiSale = Database :: eseguiQuery($saleQuery) -> fetch_all(MYSQLI_ASSOC);
                                            
                                            //Ciclo for -->
                                            for ($i=0; $i < count($datiSale); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';

                                                //Stampo dinamicamente la righe con i dati ricavati
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start">' . $datiSale[$i]['NomeSala'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $datiSale[$i]['NpostiSala'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $datiSale[$i]['Numero'] . '</th>';
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
                        <!-- Fine sale -->

                        
                        <!-- Inizio relatori -->
                        <div class="col-lg-6 col-12 mb-3 mb-lg-0">
                            <!-- Titolo tabella -->
                            <h2 class="mb-lg-3 text-center">I relatori</h2>

                            <div class="table-responsive">
                                
                                <!-- Inizio della tabella -->
                                <table class="table text-center">
                                    
                                    <!-- Inizio dell'hedaer -->
                                    <thead>
                                        <tr>
                                            <th style="width: 33%;" scope="row" class="text-start">Cognome</th>
                                            <th style="width: 33%;" scope="row" class="text-start">Nome</th>
                                            <th style="width: 33%;" scope="row" class="text-start">Azienda</th>
                                        </tr>
                                    </thead>
                                    <!-- Fine dell'header -->

                                    <!-- Inizio del body -->
                                    <tbody>
                                        <!-- INIZIO RELATORI DA DB -->
                                        <?php
                                            //Connessione al DB
                                            Database :: connessione();

                                            //Creo la query da eseguire
                                            $saleQuery =
                                            "SELECT Relatore.CognomeRel, Relatore.NomeRel, Relatore.RagioneSocialeFK
                                            FROM Relatore;";

                                            //Eseguo la query (ricavo tutti i relatori)
                                            $datiSale = Database :: eseguiQuery($saleQuery) -> fetch_all(MYSQLI_ASSOC);
                                            
                                            //Ciclo for -->
                                            for ($i = 0; $i < count($datiSale); $i++) {
                                                //Determino il colore di sfondo della riga in base all'indice ($i --> pari/dispari)
                                                $coloreSfondo = ($i % 2 == 0) ? '#FFFFFF' : '#F4F1DE';
                                            
                                                //Stamparo dinamicamente la riga con i dati ricavati
                                                echo '<tr style="background-color: ' . $coloreSfondo . ';">';
                                                echo '<th scope="row" class="text-start">' . $datiSale[$i]['CognomeRel'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $datiSale[$i]['NomeRel'] . '</th>';
                                                echo '<th scope="row" class="text-start">' . $datiSale[$i]['RagioneSocialeFK'] . '</th>';
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
                        <!-- Fine relatori -->

                    </div>
                </div>
            </section>
            <!-- Fine sezione "Sale e Realtori" -->

        </main>

        <!-- Inizio del footer -->
        <footer class="site-footer">
            <div class="container">
                <div class="row">

                    <!-- Titolo e Logo -->
                    <div class="col-lg-6 col-12 me-auto mb-5 mb-lg-0 mt-3">
                        <a class="navbar-brand d-flex align-items-center" href="index.php">
                            <img src="images/logo.png" class="navbar-brand-image img-fluid" alt="">
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

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#81B29A" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
        </footer>
        <!-- Fine del footer -->


        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/animated-headline.js"></script>
        <script src="js/modernizr.js"></script>
        <script src="js/custom.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
    </body>
</html>