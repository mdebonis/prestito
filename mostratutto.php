<html>
    <head>
        <title>Prestiti - elenco completo</title>
				<link rel="stylesheet" href="normalize.css">
				<link rel="stylesheet" href="style2.css">
    </head>
    <body>
			
      <h1 align="center">Gestione prestiti </h1>
     <hr width="100%" size="10"  color="green" align="left"/>
	 	<TABLE   width="100%" cellspacing="5" >
			<tr >
			  <td bgcolor="white" width="20%"> <a href="aggiungi_prestito.php">Aggiungi un nuovo prestito</a></td>
 	      <td bgcolor="white" width="20%"> <a href="mostratutto.php"> Elenco Prestiti</a></td>
 	      <td bgcolor="white" width="20%"> <a href="scorri_prestito.php"> Scorri Singoli Prestiti </a></td>
				<td bgcolor="white" width="20%"> <a href="home.html"> Home</a></td>
				<td bgcolor="white" width="20%"> <a href="index.html"> Login</a></td>
	 	 </tr>
	 	</table>
		<br>
		<br>
        <?php
				// richiamo il file di configurazione
				require 'config.php';
                             
            $db =mysql_connect($host,$user,$password)
            or die ("Impossibile connettersi al server $host");
            
            mysql_select_db($database,$db)
            or die ("Impossibile connettersi al database $database");
            
            $query = "SELECT * FROM prestiti";
                                
            $dbResult=mysql_query($query,$db);
            $RigheRilevate=mysql_affected_rows($db);
            echo "<table border='1' width='100%' cellspacing='5'>\n";
            for ($indice=0;$indice<$RigheRilevate;$indice++)
            {
                $riga=mysql_fetch_row($dbResult);
                if ($indice==0)
                {
                    /* Costruzione riga di intestazione*/
                   foreach ($riga as $k => $v)
                    {
                        $riferimento=mysql_fetch_field($dbResult,$k);
                        echo "<td><b>".$riferimento->name."</td></b>";
                    }
                    echo "</tr>\n";
                }
                /*Riempimento della tabella*/
                foreach ($riga as $k => $v)
                    {
											//se non sto visualizzando le date
											if ($k<6)
											{
												echo "<td>$v&nbsp;";
                        /* Questa selezione visualizza alla tabella le opzioni di cancellazione e modifica*/
                        if ($k==0)
                        {
                          print'  <div class="piccolo">';
													echo "  <br><a href='elimina.php?id=$v'>Cancella</a>
                                  <br><a href='modifica.php?id=$v'>Modifica</a>
                                  </div>";
                                  $id=$v;
                        }
											}else{
												//sto visualizzando le date
												//se è nulla la data non la viualizzare
											  if ($v=='0000-00-00'){
											  	echo "<td>&nbsp;";
											  }else{
												//altrimenti formattala e visualizzala
												$date = date_create($v); // creo l'oggeto data
												echo "<td>".date_format($date, 'd/m/Y')."&nbsp;"; // stampa gg/mm/aaaa
												}

											}
                        echo"</td>";
                    }
                        echo "</tr>\n";                        
            }
                    echo "</table>\n";
            mysql_free_result($dbResult); // libera la memoria
            mysql_close($db);
      ?>
    </body>
</html>