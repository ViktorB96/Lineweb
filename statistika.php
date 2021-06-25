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
		<h1>Statistika</h1>
		<form action="#" method='post' enctype="multipart/form-data" name="forma">
		<select name="log" id="log">
			<option value="0">--izaberite log--</option>
			<option value="logovanja.txt">Logovanja</option>
			<option value="korisnici.txt">Korisnici</option>
			<option value="proizvodi.txt">Proizvodi</option>
		</select><br><br>
		<button name="dugme">Pogledaj LOG</button>
		</form>
		<br><br>
		<div style="border:1px solid black; padding:5px">
		<?php
		if(isset($_POST['log']))
		{
			$imeFajla="logovi/".$_POST['log'];
			if(file_exists($imeFajla))
			{
				$tekst=file_get_contents($imeFajla);
				$tekst=nl2br($tekst);
				echo $tekst;
			}
			else
				echo "datoteka ne postoji!!!";
		}
		?>
		</div>
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




