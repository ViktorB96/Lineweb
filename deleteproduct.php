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
if(isset($_POST['idProizvoda']))
{
	$id=$_POST['idProizvoda'];
	if($id!="0")
	{
		$upit="UPDATE  proizvodi SET obrisan=1 WHERE id=$id";
		$db->query($upit);
		if($db->error()) $poruka="GREŠKA <br>".$db->error();
		else 
		{
			$poruka="Obrisano proizvoda: ".$db->affected_rows();
			Log::upisiLog("logovi/proizvodi.txt", "Obrisan proizvod id=$id od strane {$_SESSION['ime']}");
		}
	}
	else
		$poruka="Niste izabrali proizvod za brisanje";
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
		<h1>Brisanje proizvoda</h1>
		<form action="#" method='post'  name="forma">
		<select name="idProizvoda" id="idProizvoda">
			<option value="0">--izaberite proizvod--</option>
			<?php
			$upit="SELECT * FROM proizvodi WHERE obrisan=0";
			$rez=$db->query($upit);
			while($red=$db->fetch_object($rez))
				echo "<option value='$red->id'>$red->naslov ($red->id)</option>";
			?>
		</select><br><br>
		<button name="dugme">Obriši proizvod</button>
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




