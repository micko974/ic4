<?php include('hello.php'); ?>
<!DOCTYPE html>
<html>
<head>
	 
	  
	 <title>Affichage en ligne avec Base de Donnees</title>
</head>
<body>
<h1></h1>
<h1>Affichage de la base de donn�es</h1>
<?php
// $NbrCol : le nombre de colonnes
// $NbrLigne : calcul automatique a la FIN
// --------------------------------
// (exemple)
$NbrCol = 1;
// La requete (exemple) : toutes les "CHOSE" commen�ant par un "b", class�es par ordre alphab�tique.
$query = "SELECT * FROM device, attribute GROUP BY IPAddress";
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

		

	<table border="1" style="float:right">
	<h3>Table d'information</h3>
	<thead>
		<tr>
			<th>HostName</th>
			<th>Adresse MAC</th>
			<th>Adresse IP</th>
			<th>Interface connect�e</th>
			<th>mem.disp</th>
			<th>1st SendTime</th>
			<th>�tat</th>
		</tr>
		</thead>
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
			echo $val['hostname'].': ';
			?></td><td><?php //echo '<br/>';
			echo '<i>'.$val['MACAddress'].'</i>';
			// -------------------------
?>			</td>
			<td><?php
			echo '<i>'.$val['IPAddress'].'</i>';
			// -------------------------
?>			</td>
			<td><?php
			echo '<i>'.$val['typeDev'].'</i> :: '
			.$val['nom'].'</i>';
			// -------------------------
?>			</td>
			<td><?php
			echo '<i>'.$val['MemDispo'].'</i>/'
			.$val['Capacite'].'</i>';
			// -------------------------
?>			</td><td><?php
			echo '<i>'.$val['time'].'</i>';
			// ------------------------
?>			</td><td><?php
			include('last_online.php');
			$time = time();
			if ($time != $val['time']){
			echo '<i><b>C</b></i>';
			}else{
			echo '<i>D</i>';
			}
?></td>
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
	<input type="button" value="R�actualiser" onclick="index.php" :> 
<?php
} else { ?>
	pas de donn�es � afficher
<?php
}
?>

<?php// mysql_close(); // deconnexion de la base ?>

</body>
<header align= "center"> Copyright � Mazeau Fabiola & Mourouvin Micka�l</header>
</html>