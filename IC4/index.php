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
					<p class="right-side">Version: v<?php echo "0.0.4 final" ?></p>
				</div>
                <div class="menu">
                <ul>
                    <li><a href="">Moniteurs</a></li>
                    <li><a href="contact.php">Contacts</a></li>
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
							h = dte.getHours();
							m = dte.getMinutes();
							s = dte.getSeconds();

							if(h<10)
							{ h = '0'+h; }
							if(m<10)
							{ m = '0'+m; }
							if(s<10)
							{ s = '0'+s; }

							date = ''+h+':'+m+':'+s+'';
							document.temps.time.value = date;
							}
							window.setInterval("heure()",1000);
						</script>
							<form name="temps"><input type="text" name="time" size=10></li>
                </div>
            </div>
		
		<div class="rightb-block">
		<img src="images/iut.jpg" />
		<img src="images/logo_IUT.jpg" />
		</div>
		<div>
	</body>
</html>
