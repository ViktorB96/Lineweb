<?php
session_start();
require_once("require.php");
$db = new Baza();
$db->connect();
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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
			<form action="index.php" method="post">
				<input type="text" name="pretraga" placeholder="Unesite termin pretrage" />
				<button>Pretraži</button>
			</form>
			<?php


			$upit = "SELECT * FROM vwproizvodi WHERE obrisan=0 ORDER BY id DESC";
			if (isset($_GET['kategorija'])) $upit = "SELECT * FROM vwproizvodi WHERE obrisan=0 and kategorija={$_GET['kategorija']} ORDER BY id DESC";
			if (isset($_POST['pretraga'])) $upit = "SELECT * FROM vwproizvodi WHERE obrisan=0 and naslov LIKE '%{$_POST['pretraga']}%' OR opis LIKE '%{$_POST['pretraga']}%'";
			$rez = $db->query($upit);
			echo "Broj proizvoda: " . $db->num_rows($rez) . "<br><br>";
			while ($red = $db->fetch_object($rez)) {
				//print_r($red);
				echo "<div class='vest'>";
				echo "<div style='display: inline-block; vertical-align: top'><img src='" . ((file_exists("slike/$red->id.jpg")) ? "slike/$red->id.jpg" : "slike/noimage.jpg") . "' width='100px' alt='Nema slike'></div>";
				echo "<div style='display: inline-block'>";
				echo "<div><a href='index.php?kategorija=$red->kategorija'>$red->naziv</a></div>";
				echo "<p><a href='proizvodi.php?id=$red->id'><b>$red->naslov</b></a></p>";
				echo "<div>Likes: $red->likes, Dislikes: $red->dislikes</div>";
				if (file_exists("avatari/$red->autor.jpg"))
					$avatar = "avatari/$red->autor.jpg";
				else
					$avatar = "avatari/nouser.jpg";
				echo "<div><img width='20px' src='$avatar' alt='No avatar'> <b>$red->ime $red->prezime</b> | <i>$red->vreme</i></div>";
				//echo "<div><img width='20px' src='".(file_exists("avatari/$red->autor.jpg")?"avatari/$red->autor.jpg":"avatari/nouser.jpg")."' alt='No avatar'> <b>$red->ime $red->prezime</b> | <i>$red->vreme</i></div>";
				echo "<div>Pogledan: $red->pogledan</div>";
				$upit = "SELECT count(id) as broj FROM komentari WHERE idProizvoda={$red->id} AND odobren=1";
				$pomrez = $db->query($upit);
				$pomred = $db->fetch_object($pomrez);
				echo "<div>Komentara: $pomred->broj</div>";
				echo "</div>";
				echo "</div>";
			}

			?>
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