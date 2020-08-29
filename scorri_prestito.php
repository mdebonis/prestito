<html>
    <head>
        <title>Prestiti - elenco singolo</title>
				<link rel="stylesheet" href="normalize.css">
				<link rel="stylesheet" href="style1.css"
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
        <?php
				// richiamo il file di configurazione
				require 'config.php';
            
            
            if(isset($_REQUEST['seek']))
            {
              $posizione=$_REQUEST['seek'];
            }
            else 
              $posizione=0;
            
            $db =mysql_connect($host,$user,$password)
            or die ("Impossibile connettersi al server $host");
            
            mysql_select_db($database,$db)
            or die ("Impossibile connettersi al database $database");
            
            $query = "SELECT * FROM prestiti";
                                
            $dbResult=mysql_query($query,$db);
            $RigheRilevate=mysql_affected_rows($db);
            mysql_data_seek($dbResult,$posizione);
            $riga=mysql_fetch_row($dbResult);
            
            echo "RIEPILOGO DATI PRESTITO";
            echo "<br><br>";
            
            foreach ($riga as $k => $v)
            {
               $riferimento=mysql_fetch_field($dbResult,$k);
               echo $riferimento->name." : $v<br>";
            }
            mysql_free_result($dbResult); // libera la memoria
            mysql_close($db);
            echo"<br>Seleziona il prestito<br>";
            for ($indice=0;$indice<$RigheRilevate;$indice++)
            {
                echo "<a href=\"{$_SERVER['PHP_SELF']}?seek=$indice\" >".($indice+1)."</a>&nbsp;";
            }
        ?>
    </body>
</html>