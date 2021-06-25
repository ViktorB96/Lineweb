<?php
session_start();
require_once("require.php");
if(!login())
{
	echo "Morate biti prijavljeni da biste videli ovu stranicu.<br>";
	echo "<a href='prijava.php?link=".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."'>Prijavite se</a>";
	exit();
}

$db=new Baza();
$db->connect();
$poruka="";


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&display=swap&subset=latin-ext" rel="stylesheet">
<link href="style.css" rel="stylesheet">
</head>
<body>
	
	<div id="wrapper">
		<?php
		//Priključivanje hedera
		include("_header.php");
		?>
		
		<?php
		//Priključivanje menija
		include("_menu.php");
		?>
		<div id='main'>
		<h1>Pitanja</h1>
		<?php
		$upit="SELECT * FROM kontakt WHERE idKorisnika={$_SESSION['id']} ORDER BY vremePitanja DESC";
		$rez=$db->query($upit);
		if($db->num_rows($rez)!=0)
		{
			while($red=$db->fetch_object($rez))
			{
				echo "<div>";
				echo "<i>$red->vremePitanja</i><br>";
				echo "<p>$red->pitanje</p>";
				if($red->odgovor==null)echo "<i>Nema odgovora</i>";
				else 
					echo "<i>$red->vremeOdgovora</i> $red->odgovor<br>";
				echo "</div><br>";
			}
		}
		else
			$poruka="Niste postavili ni jedno pitanje";
		?>
		<br><br>
		<div><?=$poruka?></div>
		</div>
		
		<?php
		//Priključivanje desnog dela
		include("_sidebar.php");
		?>
		
		
	<?php
	//Priključivanje futera
	include("_footer.php");
	?>
	
	</div><!-- end #wrapper -->
	
</body>
</html>




