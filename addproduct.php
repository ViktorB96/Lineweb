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
if(isset($_POST['dugme']))
{
	$naslov=$_POST['naslov'];
	$opis=$_POST['opis'];
	$idKategorije=$_POST['idKategorije'];
	if($naslov!="" and $opis!="" and $idKategorije!="0")
	{
		$upit="INSERT INTO proizvodi (naslov, opis, kategorija, autor) VALUES ('{$naslov}', '{$opis}', {$idKategorije}, {$_SESSION['id']})";
		$db->query($upit);
		if($db->error())
		{
			$poruka="GREŠKA!!!<br>".$db->error();
			Log::upisiLog("logovi/proizvodi.txt", $db->error());
		}
		else
		{
			$poruka="Uspešno dodat proizvod";
			Log::upisiLog("logovi/proizvodi.txt", "Uspešno dodat proizvod '$naslov' od strane {$_SESSION['ime']}");
			if($_FILES['slika']['name']!="")
			{
				$imeSlike=$db->insert_id().".jpg";
				move_uploaded_file($_FILES['slika']['tmp_name'], "slike/".$imeSlike);
			}
		}
	}
	else
		$poruka="Niste uneli sve podatke";
}
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
		<h1>Dodavanje proizvoda</h1>
		<form action="#" method='post' enctype="multipart/form-data" name="forma">
		<input type="text" name="naslov" placeholder="naslov"/><br><br>
		<textarea name="opis" id="opis" cols="30" rows="10" placeholder="Unesite opis"></textarea><br><br>
		<select name="idKategorije" id="idKategorije">
			<option value="0">--izaberite kategoriju--</option>
			<?php
			$upit="SELECT * FROM kategorije";
			$rez=$db->query($upit);
			while($red=$db->fetch_object($rez))
				echo "<option value='$red->id'>$red->naziv</option>";
			?>
		</select><br><br>
		<input type="file" name="slika"/><br><br>
		<button name="dugme">Snimi proizvod</button>
		</form>
		<br><br>
		<div><?=$poruka?></div>
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




