<?php
		//$user="root"; $password=""; $host="127.0.0.1"; $database="prestito";
		require 'config.php';
		$connessione = mysql_connect($host,$user,$password);
		$trovato =0;
		mysql_select_db($database,$connessione) or die( "Unable to select database");
	if (!$connessione){
		echo 'Errore';
		die('Connessione fallita: ' . mysql_error());
	}
	
	
	$id_utente=mysql_real_escape_string($_POST['id_utente']);

	//sha1 funzione per criptare la password
	$pw = mysql_real_escape_string(sha1($_POST['password']));

	$query = "SELECT *
				FROM utenti
				WHERE utenti.id_utente like '$id_utente' AND utenti.pw like '$pw'";
	
	$res = mysql_query($query);

	if (!$res) die("Errore nella query $query: " . mysql_error());
	else print("_OK_");
	
	
	$riga= mysql_fetch_array($res);
			mysql_close();

	/* Effettuo il controllo */
	$cod=$riga['nome'];	
	if($cod == NULL) $trovato = 0;
	else $trovato = 1;
	print($trovato);
	print($riga['tipo']);

	
	if(($trovato == 1)&&($riga['tipo']=='Admin')){
		/*Redirect alla pagina riservata*/
		echo '<script language=javascript>document.location.href="home.html"</script>'; 
	
	}else {
		if(($trovato == 1)&&($riga['tipo']=='User')){
		
			$page="user.php?id_utente=".$id_utente;
			
			echo "<script language=javascript>document.location.href='$page'</script>"; 
			//echo '<script language=javascript>document.location.href="index.html"</script>';
		}else{ 
			  /*Username e password errati, redirect alla pagina di login*/
				if($trovato == 0){
				//	echo '<script language=javascript>document.location.href="login.html"</script>';
				echo '<script language=javascript>document.location.href="index.html"</script>';
				}
		}
	}

?>
