<html>
    <head>
    <title>Modifica prestito</title>
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
		 	</table>
    <?php
		if(defined('E_DEPRECATED')) {
		    error_reporting(E_ALL & ~E_DEPRECATED);
		}
		error_reporting(E_ERROR | E_PARSE);
		// richiamo il file di configurazione
		require 'config.php';
            
        $confirm = ( isset($_REQUEST['confirm'] ) ) ? $_REQUEST['confirm'] : '';            
        $id=( isset($_REQUEST['id'] ) ) ? $_REQUEST['id'] : '';
        /*Partendo dalla destra dell'uguale, Se espr1 è vera restituisce espr2 altrimenti restituisce espr3. */
                     
        $db =mysql_connect($host,$user,$password)
        or die ("Impossibile connettersi al server $host");
            
        mysql_select_db($database,$db)
        or die ("Impossibile connettersi al database $database");
				
        //echo "$id"; 
        if(!$confirm)
          {
						$query="SELECT descrizione,tipo,cognome,nome,cellulare,data_prestito,data_restituito FROM prestiti WHERE id_prestito=$id";
            $result = mysql_query($query);
						//echo "$query";
            if (!$result)
             {
                echo 'Lettura dati dalla tabella prestiti impossibile'. mysql_error();
                exit;
             }
            
           // Rileva il valore dei campi del record e ne carica i nomi nel vettore $campo
            $campo = mysql_fetch_row($result);
            
						$date_it_prestito = date_create($campo[5]); // creo l'oggeto data
						if ($campo[6]=='0000-00-00')
						{
							$date_it_restituito='';
						}else{
						$date_it_restituito=date_create($campo[6]);
						}
						$descrizione=stripslashes($campo[0]);
						$descr_encoded = htmlentities($descrizione,ENT_QUOTES);
						$descr_decoded = html_entity_decode($descr_encoded,ENT_NOQUOTES);
						
						$cognome=stripslashes($campo[2]);
						$cogn_encoded = htmlentities($cognome,ENT_QUOTES);
						$cogn_decoded = html_entity_decode($cogn_encoded,ENT_NOQUOTES);
						
						$nome=stripslashes($campo[3]);
						$nome_encoded = htmlentities($nome,ENT_QUOTES);
						$nome_decoded = html_entity_decode($nome_encoded,ENT_NOQUOTES);
						
			echo "<form method='post'>
			       <table>
                    <tr><td>Descrizione</td><td><input type='text' name='descrizione' value='".$descr_decoded."'</td></tr> ";
                    //<tr><td>Tipo</td><td><input type='text' name='tipo' value='$campo[1]'</td></tr>
																			
															$valori = array('Libro' => 'Libro', 'CD' => 'CD', 'DVD' => 'DVD', 'Vinile' => 'Vinile', 'Altro'=>'Altro'); 
															// nota che nella chiave ho usato un valore ripulito diciamo da inserire nell'attributo value, potresti anche usare un numero 

															$selezionato = $campo[1];

															echo "<tr><td>Tipo</td><td><select name='tipo'>"; 
															foreach($valori as $k => $v){ 
															$sel = $k == $selezionato? ' selected="selected"' : ''; 

															echo "<option value='".$k."' ".$sel.">".$v."</option>"; 

															} 
															echo "</select></td></tr>";
															
                    echo "<tr><td>Cognome</td><td><input type='text' name='cognome' value='".$cogn_decoded."'</td></tr>
                    <tr><td>Nome</td><td><input type='text' name='nome' value='".$nome_decoded."'</td></tr>
                    <tr><td>Cellulare</td><td><input type='text' name='cellulare' value='$campo[4]'</td></tr>
                    <tr><td>Data Prestito</td><td><input type='text' name='data_prestito' value='".date_format($date_it_prestito, 'd/m/Y')."'</td></tr>
                    <tr><td>Data Restituito</td><td><input type='text' name='data_restituito' value='".date_format($date_it_restituito, 'd/m/Y')."'</td></tr>
                    <tr><td colspan='2'><input type='submit' value='Conferma modifiche'></td></tr>
                    <input type='hidden' name='confirm' value='1'/>
                   </table>
                 </form>";

                mysql_close($db);
                
              }
   
        else
        if(isset($_POST['confirm']))
           {
            $descr_slash=addslashes($descrizione=$_REQUEST['descrizione']);
						$tipo=$_REQUEST['tipo'];
            $cogn_slash=addslashes($cognome=$_REQUEST['cognome']);
            $nome_slash=addslashes($nome=$_REQUEST['nome']);
            $cellulare=$_REQUEST['cellulare'];
						$data_prestito=$_REQUEST['data_prestito'];
						$data_restituito=$_REQUEST['data_restituito'];
           
           /*   Nella costruzione di una stringa per la query lo \ assume il significato dell'apice singolo  */
            $query="update prestiti set descrizione='$descr_slash',"
								."tipo='$tipo',"
                ."cognome='$cogn_slash',"
								."nome='$nome_slash',"
                ."cellulare='$cellulare',"
			 					."data_prestito= STR_TO_DATE('".$_REQUEST['data_prestito']."','%d/%m/%Y' ),"
			          ."data_restituito= STR_TO_DATE('".$_REQUEST['data_restituito']."','%d/%m/%Y' )"
								//."data_prestito='$data_prestito',"
								//."data_restituito='$data_restituito'"
                ." WHERE id_prestito='$id'";
								//echo $query;
						
					 $_REQUEST['cellulare']."',
					 STR_TO_DATE('".$_REQUEST['data_prestito']."','%d/%m/%Y' ),
            STR_TO_DATE('".$_REQUEST['data_restituito']."','%d/%m/%Y' ))";
					 //echo $query;
           
            /* La costruzione di una stringa SQL vuole tra apici singoli i valori testuali mentre quelli numerici ne sono privi */
            /*$query="update prestiti set descrizione='$descrizione',tipo='$tipo',cognome='$cognome', nome='$nome',cellulare='$cellulare',ruolo='$data_prestito',
                    email='$data_restituito' where id=$id;";*/
            $modifica=mysql_query($query);
            if (!$modifica)
             {
                echo 'Aggiornamento record impossibile'. mysql_error();
                exit;
             }
            else
             {
                 echo"<h3>Il record &egrave; stato aggiornato!</h3>
                     <h3><a href='mostratutto.php'>Torna alla lista</a></h3>";
             }
               mysql_close($db);
       }
        ?>
    </body>
</html>
