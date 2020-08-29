<html>
    <head>
        <title>Aggiungi prestito</title>
				<link rel="stylesheet" href="normalize.css">
				<link rel="stylesheet" href="style1.css">
				
				
    </head>
    <body>
			
			<script language="javascript">
			var oggi = new Date();

			var G = oggi.getDate();
			var M = (oggi.getMonth() + 1);

			if (G < 10)
			{
				var gg = "0" + oggi.getDate();
			}
			else
			{
				var gg = oggi.getDate();
			}

			if (M < 10)
			{
				var mm = "0" + (oggi.getMonth() + 1);
			}
			else
			{
				var mm = (oggi.getMonth() + 1);
			}

			var aa = oggi.getFullYear();

			var data = gg + "/" + mm + "/" + aa;
			
			</script>
			
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
        <form name="acquisizione" method="post" action="scrivi_prestito.php">
            <table cellspacing="5"> 
							 	<tr><td>Descrizione (*)</td><td><input type="text" name="descrizione" size="50" maxlength="50" required></td></tr>
							 	<tr><td>Tipo (*)</td><td><select name="tipo">
              													<option value="Libro">Libro</option>
              													<option value="CD" selected="selected">CD</option>
																				<option value="DVD">DVD</option>
              													<option value="Vinile">Vinile</option>
																				<option value="Altro">Altro</option>
            													</select></td></tr>
                <tr><td>Cognome (*)</td><td><input type="text" name="cognome" size="30" maxlength="30" required></td></tr>
                <tr><td>Nome (*) </td><td><input type="text" name="nome" size="30" maxlength="30" required></td></tr>
                <tr><td>Cellulare</td><td><input type="text" name="cellulare" size="10" maxlength="10" placeholder="3401234567"></td></tr>
                <tr><td>Data Prestisto (*)</td><td><input type="text" name="data_prestito" placeholder="gg/mm/aaaa" required onclick="this.value=data"></td></tr>
								<!--	onclick="this.value = (new Date()).getDate() + '/' + ((new Date()).getMonth() + 1) + '/' + (new Date()).getFullYear();"> -->
								<tr><td>Data Restituzione</td><td><input type="text" name="data_restituito" placeholder="gg/mm/aaaa"> </td></tr>
								<tr><td>&nbsp</td><td>&nbsp</td></tr>
								<tr><td colspan=\"2\"><input type="submit" value="Inserisci"></td></tr>
            </table> 
						<br>
						<br>
						
        </form>
       
    </body>
</html>
