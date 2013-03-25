<?php include('hello.php'); ?>
<!DOCTYPE html>
<html>
<head></head>
<?php

// La requete (exemple) : toutes les "CHOSE" commençant par un "b", classées par ordre alphabétique.
$query = "SELECT time FROM attribute ORDER BY idAtt DESC LIMIT 1";
$result = mysql_query($query);

?>

<?php
	while ($val2 = mysql_fetch_array($result)) 
	{
		if ($j%$NbrCol == 1) {
			$NbrLigne++;
			$fintr = 0;
?>		<tr>
<?php		}
?>

	
<?php
			echo '<i>'.$val2['time'].'</i>';
			// -------------------------
?>			
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


<?php mysql_close(); // deconnexion de la base ?>

</body>
</html>