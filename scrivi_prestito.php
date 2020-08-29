<html>
    <head>
        <title>Inserimento nel Data Base</title>
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
           
            $db =mysql_connect($host, $user,$password)
            or die ("Impossibile connettersi al server $host");
            
            mysql_select_db($database,$db)
            or die ("Impossibile connettersi al database $database");
            
            $query = "insert into prestiti ".
                     "(descrizione,tipo,cognome,nome,cellulare,data_prestito,data_restituito) ".
                     "VALUES('".
										 addslashes($_REQUEST['descrizione'])."','". 
										 $_REQUEST['tipo']."','".
                     addslashes($_REQUEST['cognome'])."','".
                     addslashes($_REQUEST['nome'])."','".
										 $_REQUEST['cellulare']."',
										 STR_TO_DATE('".$_REQUEST['data_prestito']."','%d/%m/%Y' ),
                     STR_TO_DATE('".$_REQUEST['data_restituito']."','%d/%m/%Y' ))";
										 
										 echo $query;
									
            if (!mysql_query($query,$db))
            {
                print("<br><br><div align='center'>Attenzione, impossibile inserire il prestito correttamente</div>");
            }
            else
            {
                print("<br><br><div align='center'>Il prestito &egrave; stato inserito correttamente</div>");
            }
            
            mysql_close($db);
            
        ?>
    </body>
</html>

