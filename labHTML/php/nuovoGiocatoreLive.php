<?php

require_once "connessione.php";

$paginaHTML = file_get_contents("nuovoGiocatore.html");

$stagPermessi = '<em><strong><ul><li><span>';

$nome = "";
$capitano = "";
$dataNascita = "";


function pulisciInput($value) {
    $value = trim($value);
    $value = strip_tags($value);
    $value = htmlentities($value);
    return $value;
}

function pulisciNote($value) {
    global $tagPermessi;

    $value = trim($value);
    $value = strip_tags($value, $tagPermessi);
    return $value;
}

if(isset($_POST['submit'])){
    $nome = pulisciInput($_POST['nome']);
    if(strlen($nome) == 0) {
        $messaggioPerForm .= '<li> Nome e cognome non inseriti </li>';
    } else {
        if(preg_match("/\d/", $nome)) {
            $messaggioPerForm .= '<li> Nome e cognome non possono contenere numeri </li>';
        }
    }

    $capitano = pulisciInput($_POST['capitano']);

    $dataNascita = pulisciInput($_POST['dataNascita']);
    if(strlen($dataNascita) == 0) {
        $messaggioPerForm .= '<li> Data di nascita non inserita </li>';
    } else {
        if(preg_match("/\d{4}\-\d{2}\-\d{2}/", $nome)) {
            $messaggioPerForm .= '<li> Data di nascita non nel formato corretto </li>';
        }
    }

} else {
    $paginaHTML = str_replace('<messaggiForm />', $messaggioPerForm, $paginaHTML);
    $paginaHTML = str_replace('<valoreNome />', $nome, $paginaHTML);
    $paginaHTML = str_replace('<valData />', $dataNascita, $paginaHTML);
    $paginaHTML = str_replace('<valLuogo />', $luogo, $paginaHTML);
    echo $paginaHTML;
}

?>