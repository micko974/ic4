<!DOCTYPE html>

<html>
<head>
<title>Contact</title>
</head>

<body background="fond2.jpg">

<h2>Pour nous contacter, il suffit de remplir ces champs:</h2>
<br>
<br>
<?php

ini_set("SMTP","mx.zeop.re");

$dest = 'f.mazeau@rt-iut.re';
$copie = 'oui';
$form_action = '';
 
$message_envoye = "Votre message à bien été envoyé!";
$message_non_envoye = "Echec, veuillez réessayer.";

$message_formulaire_invalide = "Erreur, tous les champs doivent être remplis";
 
function Rec($text)
{
	$text = htmlspecialchars(trim($text), ENT_QUOTES);
	if (1 === get_magic_quotes_gpc())
	{
		$text = stripslashes($text);
	}
 
	$text = nl2br($text);
	return $text;
};

function IsEmail($email)
{
	$value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
	return (($value === 0) || ($value === false)) ? false : true;
}

$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

$email = (IsEmail($email)) ? $email : '';
$err_formulaire = false; 
 
if (isset($_POST['envoi']))
{
	if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
	{
		$headers  = 'From:'.$nom.' <'.$email.'>' . "\r\n";

		if ($copie == 'oui')
		{
			$cible = $dest.','.$email;
		}
		else
		{
			$cible = $dest;
		};
 

		$message = str_replace("&#039;","'",$message);
		$message = str_replace("&#8217;","'",$message);
		$message = str_replace("&quot;",'"',$message);
		$message = str_replace('&lt;br&gt;','',$message);
		$message = str_replace('&lt;br /&gt;','',$message);
		$message = str_replace("&lt;","&lt;",$message);
		$message = str_replace("&gt;","&gt;",$message);
		$message = str_replace("&amp;","&",$message);
 
		if (mail($cible, $objet, $message, $headers))
		{
			echo '<p>'.$message_envoye.'</p>';
		}
		else
		{
			echo '<p>'.$message_non_envoye.'</p>';
		};
	}
	else
	{

		echo '<p>'.$message_formulaire_invalide.'</p>';
		$err_formulaire = true;
	};
}; 
 
if (($err_formulaire) || (!isset($_POST['envoi'])))
{

	echo ' <center>
	<form id="contact" method="post" action="'.$form_action.'">
	Vous:
	<fieldset>
		<p><label for="nom">Nom :</label><input type="text" id="nom" name="nom" value="'.stripslashes($nom).'" tabindex="1" /></p>
		<p><label for="email">Email :</label><input type="text" id="email" name="email" value="'.stripslashes($email).'" tabindex="2" /></p>
	</fieldset>
	<br>
	Votre message :
	<fieldset>
		<p><label for="objet">Objet :</label><input type="text" id="objet" name="objet" value="'.stripslashes($objet).'" tabindex="3" /></p>
		<p><label for="message">Message :</label><textarea id="message" name="message" tabindex="4" cols="30" rows="8">'.stripslashes($message).'</textarea></p>
	</fieldset>
 
	<div style="text-align:center;"><input type="submit" name="envoi" value="Envoyer" /></div>
	<br>
	<a href="index.php" title="retour accueil">ACCUEIL</a>
	</form></center>';
};
?>
</body>
</html>