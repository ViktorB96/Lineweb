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
if(isset($_POST['idKorisnika']))
{
	$id=$_POST['idKorisnika'];
	if($id!="0")
	{
		$upit="DELETE FROM korisnici WHERE id=$id";
		$db->query($upit);
		if($db->error()) $poruka="GREŠKA <br>".$db->error();
		else 
		{
			$poruka="Obrisano korisnika: ".$db->affected_rows();
			Log::upisiLog("logovi/korisnici.txt", "Obrisan korisnik id=$id od strane {$_SESSION['ime']}");
		}
	}
	else
		$poruka="Niste izabrali korisnika za brisanje";
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
		<h1>Brisanje korisnika</h1>
		<form action="#" method='post' enctype="multipart/form-data" name="forma">
		<select name="idKorisnika" id="idKorisnika">
			<option value="0">--izaberite korisnika--</option>
			<?php
			$upit="SELECT * FROM korisnici";
			$rez=$db->query($upit);
			while($red=$db->fetch_object($rez))
				echo "<option value='$red->id'>$red->ime $red->prezime ($red->id)</option>";
			?>
		</select><br><br>
		<button name="dugme">Obriši korisnika</button>
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




