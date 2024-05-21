<?php
//Avvio la sessione
session_start();

//Cancello tutte le variabili di sessione
$_SESSION = array();

//Distruggo la sessione
session_destroy();
?>