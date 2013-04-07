<?php include('hello.php'); ?>
<!DOCTYPE html>
<html>
<head>
	 
	  
	 <title>Affichage en ligne avec Base de Donnees</title>
</head>
<body>
<h1></h1>
<h1>Affichage de la base de données</h1>
<?php
$NbrCol = 1;
$query = "SELECT * FROM device, attribute GROUP BY IPAddress";
$result = mysql_query($query);
$NbreData = mysql_num_rows($result);
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
			<th>Interface connectée</th>
			<th>mem.disp</th>
			<th>1st SendTime</th>
			<th>état</th>
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
<?php			
			echo $val['hostname'].': ';
			?></td><td><?php 
			echo '<i>'.$val['MACAddress'].'</i>';
	
?>			</td>
			<td><?php
			echo '<i>'.$val['IPAddress'].'</i>';
		
?>			</td>
			<td><?php
			echo '<i>'.$val['typeDev'].'</i> :: '
			.$val['nom'].'</i>';
		
?>			</td>
			<td><?php
			echo '<i>'.$val['MemDispo'].'</i>/'
			.$val['Capacite'].'</i>';
		
?>			</td><td><?php
			echo '<i>'.$val['time'].'</i>';
	
?>			</td><td><?php
			echo '<i><b>C</b> or </i>';
			echo '<i>D</i>';
?></td>
<?php		if ($j%$NbrCol == 0) {
			$fintr = 1;
?>		</tr>

<?php		}
		$j++;
	} 
	if ($fintr!=1) {
?>		</tr>
<?php	} ?>
	</tbody>
	</table>
	<input type="button" value="Actualiser" OnClick="window.location.href='index.php'">
	<a href="http://www.google.com" onclick="window.open('http://www.google.com', 'exemple', 'height=600, width=800, top=90, left=350, toolbar=no, menubar=no, location=yes, resizable=yes, scrollbars=yes, status=no'); return false;">+infos</a>
<?php
} else { ?>
	pas de données à afficher
<?php
}
?>

<?php ?>

</body>
<header align= "center"> Copyright © Mazeau Fabiola & Mourouvin Mickaël 						IUT Saint-Pierre  </header>
</html>