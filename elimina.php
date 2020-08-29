<html>
    <head>
        <title>Cancella presito</title>
				<link rel="stylesheet" href="normalize.css">
				<link rel="stylesheet" href="style1.css"
    </head>
    <body>
      <h1 align="center">Gestione prestiti </h1>
      <hr width="100%" size="10"  color="green" align="left"/>
			<br>
			<br>
		 	<TABLE   width="100%" cellspacing="5" >
				<tr >
					  <td bgcolor="white" width="20%"> <a href="aggiungi_prestito.php">Aggiungi un nuovo prestito</a></td>
		 	      <td bgcolor="white" width="20%"> <a href="mostratutto.php"> Elenco Prestiti</a></td>
		 	      <td bgcolor="white" width="20%"> <a href="scorri_prestito.php"> Scorri Singoli Prestiti </a></td>
						<td bgcolor="white" width="20%"> <a href="home.html"> Home</a></td>
						<td bgcolor="white" width="20%"> <a href="index.html"> Login</a></td>
		 	 </tr>
		 	</table>
        <?php
				// richiamo il file di configurazione
				require 'config.php';
            
            
            $confirm = ( isset($_REQUEST['confirm'] ) ) ? $_REQUEST['confirm'] : '';
            $id=$_REQUEST['id'];
            
            if($confirm)
            {
               $db =mysql_connect($host,$user,$password)
               or die ("Impossibile connettersi al server $host");
               mysql_select_db($database,$db)
               or die ("Impossibile connettersi al database $database");
               $query = "DELETE FROM prestiti WHERE id_prestito=$id";                                
               $dbResult=mysql_query($query,$db);
               $RigheRilevate=mysql_affected_rows($db);
               if ($RigheRilevate==0)
               {
                 echo"<h3>Non esistono record riferiti al criterio selezionato</h3>";
               }
               else
               {
                 echo"<h3>Il record &egrave; stato eliminato</h3>";
                 echo"<h3><a href=\"mostratutto.php\">Torna alla lista</a></h3>"; 
               }
             mysql_close($db);
            }
            else
            {
                echo"<h3>Eliminare il record?</h3>";
                echo "<h3><a href=\"{$_SERVER['PHP_SELF']}?id=$id&confirm=1\">Conferma</a></h3>";
                echo"<h3><a href=\"mostratutto.php\">Annulla</a></h3>"; 
            }
        ?>
    </body>
</html>