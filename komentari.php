<?php
session_start();
require_once("require.php");
if(!login())
{
	echo "Morate biti prijavljeni da biste videli ovu stranicu.<br>";
	echo "<a href='prijava.php?link=".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."'>Prijavite se</a>";
	exit();
}

if($_SESSION['status']!="Administrator")
{
	echo "Morate biti prijavljeni kao administrator da biste videli ovu stranicu.<br>";
	echo "<a href='index.php'>Početna</a>";
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
		<h1>Komentari</h1>
		<?php
		//Dozvola ili brisanje komentara
		if(isset($_GET['id']) AND isset($_GET['funkcija']))
		{
			$id=$_GET['id'];
			$funkcija=$_GET['funkcija'];
			if($funkcija=="dozvoli") $upit="UPDATE komentari SET odobren=1 WHERE id={$id}";
			else $upit="DELETE FROM komentari WHERE id={$id}";
			$db->query($upit);
			if($db->error())echo "GREŠKA!!!!<br>".$db->error();
			else echo "Uspešna izmena<br>";
		}
		?>
		<?php
		//Prikaz svih neodobrenih komentara
		$upit="SELECT * FROM komentari WHERE odobren=0 order by vreme DESC";
		$rez=$db->query($upit);
		if($db->num_rows($rez)!=0)
		{
			while($red=$db->fetch_object($rez))
			{
				echo "<div>";
				echo "$red->vreme<br>";
				echo "$red->ime<br>";
				echo "$red->komentar<br>";
				echo "<a href='komentari.php?id=$red->id&funkcija=dozvoli'>Dozvoli</a> | ";
				echo "<a href='komentari.php?id=$red->id&funkcija=obrisi'>Obriši</a>";
				echo "</div><br><br>";
			}
		}
		else
			echo "Nemate nijedan neodobren komentar";
		?>
		
		</div>
		
		<?php
		//Priključivanje desnog dela
		//include("_sidebar.php");
		?>
		
		
	<?php
	//Priključivanje futera
	include("_footer.php");
	?>
	
	</div><!-- end #wrapper -->
	
</body>
</html>




