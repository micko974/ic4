<?php include('hello.php'); ?>
<!DOCTYPE html>
<html>
<head></head>
<?php

$query = "SELECT time FROM attribute ORDER BY idAtt DESC LIMIT 1";
$result = mysql_query($query);

?>

<?php
	if ($val2 = mysql_fetch_array($result)) 
	{
		if ($j%$NbrCol == 1) {
			$NbrLigne++;
			$fintr = 0;
?>		<tr>
<?php		}
?>

	
<?php
			echo '<i>'.$val2['time'].'</i>';
?>			
<?php		if ($j%$NbrCol == 0) {
			$fintr = 1;
?>		</tr>

<?php		}
		$j++;
	if ($fintr!=1) {
?>		</tr>
<?php	} ?>
	</tbody>
	</table>
<?php
	}
	else {echo "Pas de connexion";
	}
?>

<?php mysql_close(); ?>

</body>
</html>