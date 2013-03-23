<?php include('hello.php'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	 <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	 <title>Affichage en ligne avec Base de Donnees</title>
</head>
<body>

<?php
// $NbrCol : le nombre de colonnes
// $NbrLigne : calcul automatique a la FIN
// --------------------------------
// (exemple)
$NbrCol = 5;
// La requete (exemple) : toutes les "CHOSE" commençant par un "b", classées par ordre alphabétique.
$query = "SELECT * FROM device";
$result = mysql_query($query);
// --------------------------------
// nombre de cellules a remplir
$NbreData = mysql_num_rows($result);
// --------------------------------
// affichage
$NbrLigne = 0;
if ($NbreData != 0) {
	$j = 1;
?>
	<table border="1">
	<tbody>
<?php
	while ($val = mysql_fetch_array($result)) 
	{
		if ($j%$NbrCol == 1) {
			$NbrLigne++;
			$fintr = 0;
?>		<tr>
<?php		}
?>
			<td>
<?php			// -------------------------
			// DONNEES A AFFICHER dans la cellule
			echo $val['idDev'].': ';
			//echo '<br/>';
			echo '<i>'.$val['typeDev'].'</i>';
			// -------------------------
?>			</td>
<?php		if ($j%$NbrCol == 0) {
			$fintr = 1;
?>		</tr>
<?php		}
		$j++;
	} // fin while
	// fermeture derniere balise /tr
	if ($fintr!=1) {
?>		</tr>
<?php	} ?>
	</tbody>
	</table>
<?php
} else { ?>
	pas de données à afficher
<?php
}
?>

<?php mysql_close(); // deconnexion de la base ?>

</body>
</html>