<?php

//Connection à la base de données	
$connection = mysql_connect('localhost','', '') or die('Erreur de connexion '.mysql_error());

$db=mysql_select_db('ic4',$connection) or die('Erreur de selection '.mysql_error());

mysql_query("SET NAMES 'utf8'");
	
$result="SELECT * FROM device";

//Table device
if (isset($_POST['idDev']) && (isset($_POST['typeDev']))&& (isset($_POST['nom']))) {
	$idDev= $_POST['idDev'];
	$typeDev = $_POST['typeDev'];
	$nom= $_POST['nom'];
	
	//Insertion des données dans la base	
	$query="INSERT INTO device VALUES ('$idDev', '$typeDev', '$nom')";

	//Affichage de la requête	
	echo "requete =$query </br>";
	$requete = mysql_query($query, $connection) or die( mysql_error() ) ;
 
	//Affichage des résultats
	if($requete)
		{echo("Insertion réussie") ;}
	else
		{echo("Echec") ;}
}

//Table attribute
$result="SELECT * FROM attribute";

if (isset($_POST['idAtt'])&& (isset($_POST['idDev'])) && (isset($_POST['IPAddress'])) && (isset($_POST['MACAddress'])) && (isset($_POST['Capacite'])) && (isset($_POST['MemDispo'])) && (isset($_POST['time']))) {
	$idAtt= $_POST['idAtt'];
	$idDev=$_POST['idDev'];
	$IPAddress = $_POST['IPAddress'];
	$MACAddress= $_POST['MACAddress'];
	$Capacite=$_POST['Capacite'];
	$MemDispo= $_POST['MemDispo'];
	$time= $_POST['time'];

	
	//Insertion des données dans la base	
	$query="INSERT INTO attribute VALUES ('$idAtt', '$idDev','$IPAddress', '$MACAddress', '$Capacite', '$MemDispo', '$time')";

	//Affichage de la requête	
	echo "<br>requete =$query </br>";
	$requete = mysql_query($query, $connection) or die( mysql_error() ) ;
 
	//Affichage des résultats
	if($requete)
		{echo("Insertion réussie") ;}
	else
		{echo("Echec") ;}
}

?>