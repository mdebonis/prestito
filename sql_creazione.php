<?php
/*$host="localhost";
$user="root";
$password="";
$database="prestito";*/
require 'config.php';
mysql_connect($host,$user,$password);
@mysql_select_db($database) or die( "Impossibile accedere al data base!");

//tabella dei prestiti
$query_prestiti="CREATE TABLE if not exists prestiti (id_prestito int(10) NOT NULL auto_increment, descrizione varchar(50) NOT NULL, tipo char(10), cognome varchar(30) NOT NULL, nome varchar(30) NOT NULL, cellulare varchar(30), data_prestito date NOT NULL, data_restituito date, PRIMARY KEY (id_prestito))";
$res=mysql_query($query_prestiti);

if ($res==1) { echo "ok prestiti \n";} else {echo "ko prestiti";}

//tabella utenti
$query_contatti="CREATE TABLE if not exists utenti (id_utente int(5) NOT NULL auto_increment, cognome varchar(30) NOT NULL, nome varchar(30) NOT NULL, tipo enum('Admin','User') NOT NULL, pw varchar(64) NOT NULL, telefono char(10), data_nascita date, luogo_nascita varchar(20), PRIMARY KEY (id_utente))";

$res=mysql_query($query_contatti);	
if ($res==1) { echo "ok contatti";} else {echo "ko contatti";}

mysql_close();
echo "Fine creazione tabelle";

?>