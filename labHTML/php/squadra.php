<?php
use DB\DBAccess;

require_once "connessione.php";

$paginaHTML = file_get_contents(".." . DIRECTORY_SEPARATOR . "squadra_php.html");

$connessione = new DBAccess();

$stringaGiocatori = "";

$giocatori = "";

$connOk = $connessione->openDBConnection();

if( $connOk ) {

    $giocatori = $connessione->getList();
    
    if($giocatori != null) {

        $stringaGiocatori .= '<dl id="giocatori">';
        
        foreach($giocatori as $giocatore) {
            $stringaGiocatori .= "<dt> ". $giocatore['nome'];
            $stringaGiocatori.= ($giocatore['capitano']) ? "<em> Capitano </em>" : "" ." </dt>"
            .           '<dd> <img src="materialePerStudenti/images/giannelli.jpg" alt="" />'
            .               '<dl class="giocatore">'
            .                   '<dt>Data di nascita:</dt> <dd>'.$giocatore['dataNascita'].'</time></dd>'
            .                   '<dt>Luogo:</dt> <dd>'.$giocatore['luogo'].'</dd>'
            .                    '<dt>Squadra:</dt> <dd>'.$giocatore['squadra'].'</dd>'
            .                    '<dt>Ruolo:</dt><dd>'.$giocatore['ruolo'].'</dd>'
            .                    '<dt>Altezza:</dt><dd>'.$giocatore['altezza'].'</dd>'
            .                    '<dt>Maglia:</dt><dd>'.$giocatore['maglia'].'</dd>'
            .                    '<dt>Maglia in nazionale:</dt><dd>'.$giocatore['magliaInNazionale'].'</dd>'
            .                    ($giocatore['ruolo'] != 'Libero') ? '<dt>Punti totali:</dt>' : '<dt>Ricezioni totali:</dt>'. '<dd>'.$giocatore['punti'].'</dd>';
                                if($giocatore['riconoscimenti']) {
                                    $stringaGiocatori .= '<dt class="riconoscimenti">Riconoscimenti:</dt>'
                                    .                       '<dd>'.$giocatore['riconoscimenti'].'</dd>';
                                }
                                if($giocatore['note']) {
                                    $stringaGiocatori .= '<dt>Note:</dt>'
                                    .                       '<dd>'.$giocatore['note'].'</dd>';
                                }

            $stringaGiocatori .= '</dl>'
            .            '</dd>'; 
        }
        $stringaGiocatori .= '<dl />';
    } else {
        
    }

} else {
    $stringaGiocatori = "<p> I sistemi sono momentaneamente fuori servizio, ci scusiamo per il disagio. </p>";
}


echo str_replace("<listaGiocatori />", $stringaGiocatori, $paginaHTML);

?>