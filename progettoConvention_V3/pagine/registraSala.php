<!-- Questo file è nella cartella pagine nonostante non fornisca interazioni con l'admin -->
<!-- In quanto contiene codice HTML per visualizzare in background il sito e gli sweet alert durante l'operazione -->

<!-- INIZIO CODICE PHP -->
<?php
    //Includo il file database.php
    include '../php/database.php';

    //Controllo se provengo dal form -->
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //Ricavo il parametro inserito dall'utente
        $nome = $_POST['Nome'];
        $nome = ucwords(strtolower($nome));
        
        $posti = $_POST['Posti'];
        $piano = $_POST['Piano'];

        //Connessione al DB
        Database :: connessione();

        /*
        CONTROLLO SE LA SALA ESISTE GIÀ
        */

        //Creo la query da eseguire
        $queryVerificaSala =
            "SELECT NomeSala
            FROM Sala
            WHERE NomeSala = '$nome'";
        
        //Eseguo la query (controllo se la sala esiste)
        $risultatoSala = Database :: eseguiQuery($queryVerificaSala);

        //Se la sala esiste --> Messaggio di errore / Rimando a "homeAdmin.php" (sweet alert)
        if ($risultatoSala && $risultatoSala -> num_rows != 0) {
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    Swal.fire({';
            echo '        icon: "error",';
            echo '        title: "Errore di creazione!",';
            echo '        text: "La sala indicata esiste già.",';
            echo '        confirmButtonColor: "#3085d6",';
            echo '        confirmButtonText: "OK"';
            echo '    }).then(function() {';
            echo '        window.location.href = "./homeAdmin.php";';
            echo '    });';
            echo '});';
            echo '</script>';
        }


        /*
        CONTROLLO SE IL PIANO ESISTE
        */

        //Creo la query da eseguire
        $queryVerificaPiano =
            "SELECT Numero
            FROM Piano
            WHERE Numero = '$piano'";
        
        //Eseguo la query (controllo se il piano esiste)
        $risultatoPiano = Database :: eseguiQuery($queryVerificaPiano);

        //Se il piano non esiste --> Messaggio di errore / Rimando a "homeAdmin.php" (sweet alert)
        if ($risultatoPiano && $risultatoPiano -> num_rows == 0) {
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    Swal.fire({';
            echo '        icon: "error",';
            echo '        title: "Errore di creazione!",';
            echo '        text: "Il piano indicato non esiste.",';
            echo '        confirmButtonColor: "#3085d6",';
            echo '        confirmButtonText: "OK"';
            echo '    }).then(function() {';
            echo '        window.location.href = "./homeAdmin.php";';
            echo '    });';
            echo '});';
            echo '</script>';
        }

        /*
        SE SONO ARRIVATO A STO PUNTO --> CREO LA SALA
        */

        //Creo la query da eseguire
        $queryInserisciSala =
            "INSERT INTO Sala (NomeSala, NpostiSala, Numero)
            VALUES ('$nome', '$posti', '$piano')";

        //Connessione al DB
        Database :: connessione();

        //Eseguo la query (inserisco l'azienda) --> (sweet alert)
        if (Database :: eseguiQuery($queryInserisciSala)) {
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    Swal.fire({';
            echo '        icon: "success",';
            echo '        title: "Costruione effettuata!",';
            echo '        text: "Hai completato la costruzione della sala.",';
            echo '        confirmButtonColor: "#3085d6",';
            echo '        confirmButtonText: "OK"';
            echo '    }).then(function() {';
            echo '        window.location.href = "./homeAdmin.php";';
            echo '    });';
            echo '});';
            echo '</script>';
        }

        //Altrimenti --> Messaggio di errore (inserimento dell'azienda)
        else {
            echo '<script>';
            echo '    document.addEventListener("DOMContentLoaded", function() {';
            echo '        Swal.fire({';
            echo '            icon: "error",';
            echo '            title: "Errore nell\'inserimento!",';
            echo '            text: "Si è verificato un errore. Ripovare",';
            echo '            confirmButtonColor: "#3085d6",';
            echo '            confirmButtonText: "OK"';
            echo '        }).then(function() {';
            echo '            window.location.href = "./homeAdmin.php";';
            echo '        });';
            echo '    });';
            echo '</script>';
        }

    }

    //Altrimenti --> Messaggio di errore (non provengo dal form)
    else {
        //Rimando a "index.php"
        echo "Non provieni dal form!";
        header("Location: ../index.php");
        exit();
    }
?>
<!-- FINE CODICE PHP -->

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
        <title>Registra Sala</title>

    </head>
    
    <body>
        <main>

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
                        </div>
                        <!-- Fine del titolo -->

                    </div>
                </div>
                <!-- Fine container -->

                <!-- (stile onda) -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,224L34.3,192C68.6,160,137,96,206,90.7C274.3,85,343,139,411,144C480,149,549,107,617,122.7C685.7,139,754,213,823,240C891.4,267,960,245,1029,224C1097.1,203,1166,181,1234,160C1302.9,139,1371,117,1406,106.7L1440,96L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path></svg>
            </section>
            <!-- Fine sezione "Header" -->        
        </main>

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