<?php
    include('hello.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="content-language" content="fr">
		<META HTTP-EQUIV="Refresh" CONTENT="1000000000000;URL=index.php"/>
		<title>MonitoringWatch :: The Service monitor</title>
		<link rel="stylesheet" type="text/css" href="screen.css">
	</head>
	<body>
		<div id="content">
			<div id="left-column">				
				<div id="subheader">
					<img src="images/logo.jpg" />
					<p><?php ; ?></p>
					<p class="right-side">Version: v<?php echo "0.0.2 Bêta" ?></p>
				</div>
                <div class="menu">
                <ul>
                    <li><a href="">Moniteurs</a></li>
                    <li><a href="">Contacts</a></li>
                </ul>
                </div>
                <?php  include('tableau.php');?>
			</div>
            <div class="right-block">
                <div>
                    <p class="side-title">Total Moniteurs:</p>
                    <p><?php echo $NbreData?></p>
					
                    <p class="side-title">Last Online:</p>
                    <p><?php  include('last_online.php')?></li>
					<p class="side-title">Current Hour:</p>
					<p><script language="javascript">
							function heure()
							{
							dte = new Date();
							/*recupère chaque partie de l'heure*/
							h = dte.getHours();
							m = dte.getMinutes();
							s = dte.getSeconds();

							// Les conditions ne servent que pour l'affichage.
							  // Si le nombre de heure/minute/seconde est inférieur à 10, alors on rajoute un 0 devant..
							if(h<10)
							{ h = '0'+h; }
							if(m<10)
							{ m = '0'+m; }
							if(s<10)
							{ s = '0'+s; }

							date = ''+h+':'+m+':'+s+''; //format
							document.temps.time.value = date; //?
							}
							window.setInterval("heure()",1000); /*lance la fonction heure() tous les 1000 ms*/
						</script>
							<form name="temps"><input type="text" name="time" size=10></li>
                </div>
            </div>
		</div>
	</body>
</html>
