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
		<h1>Odgovori</h1>
		<form action="odgovori.php" method="post">
		<select name="idPitanja" id="idPitanja">
		<option value="0">--izaberite pitanje--</option>
		<?php
			$upit="SELECT * FROM kontakt WHERE isnull(odgovor) ORDER BY vremePitanja DESC";
			$rez=$db->query($upit);
			while($red=$db->fetch_object($rez))
				echo "<option value='$red->id'>$red->pitanje</option>";

		?>
		</select><br><br>
		<textarea name="odgovor" id="odgovor" cols="30" rows="10"></textarea><br><br>
		<button>Snimi odgovor</button>
		</form>
		<br><br>
		<?php
		if(isset($_POST['idPitanja']) and isset($_POST['odgovor']))
		{
			$idPitanja=$_POST['idPitanja'];
			$odgovor=$_POST['odgovor'];
			if($idPitanja!="0" and $odgovor!="")
			{
				$upit="UPDATE kontakt SET odgovor='{$odgovor}' WHERE id={$idPitanja}";
				$db->query($upit);
				if($db->error())$poruka="GREŠKA!!!!<br>".$db->error();
				else {
					$poruka="Uspešno odgovoreno";
					$upit="SELECT email FROM kontakt WHERE id={$idPitanja}";
					$rez=$db->query($upit);
					$red=$db->fetch_object($rez);
					$email=$red->email;
					// The message
					$message = "$odgovor";

					// In case any of our lines are larger than 70 characters, we should use wordwrap()
					$message = wordwrap($message, 70, "\r\n");

					// Send
					if(@mail($email, 'Odgovor na Vaše pitanje', $message))
						$poruka=$poruka."<br>Poslat mejl";
					else
						$poruka.="<br>Neuspešno slanje mejla";
				}
			}
			else
				$poruka="Svi podaci su obavezni";
		}
		?>

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




