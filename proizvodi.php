<?php
session_start();
require_once("require.php");
$db = new Baza();
$db->connect();
$tip = "";
if (!login()) $tip = "none";
?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="js/proizvodi.js"></script>
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

			<?php
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				$id = intval($id);
				if (is_int($id)) {
					$upit = "SELECT * FROM vwproizvodi WHERE obrisan=0 AND id={$id}";
					$rez = $db->query($upit);
					if ($db->num_rows($rez) != 0) {
						$red = $db->fetch_object($rez);
						echo "<br><br><div class='vest'>";
						echo "<div style='display: inline-block; vertical-align: top'><img src='" . ((file_exists("slike/$red->id.jpg")) ? "slike/$red->id.jpg" : "slike/noimage.jpg") . "' width='100px' alt='Nema slike'></div>";
						echo "<div style='display: inline-block'>";
						echo "<div><a href='index.php?kategorija=$red->kategorija'>$red->naziv</a></div>";
						echo "<p><a href='proizvodi.php?id=$id'><b>$red->naslov</b></a></p>";
						echo "<div>$red->opis</div><br>";
						echo "<div>Likes: $red->likes, Dislikes: $red->dislikes</div>";
						if (file_exists("avatari/$red->autor.jpg"))
							$avatar = "avatari/$red->autor.jpg";
						else
							$avatar = "avatari/nouser.jpg";
						echo "<div><img width='20px' src='$avatar' alt='No avatar'> <b>$red->ime $red->prezime</b> | <i>$red->vreme</i></div>";
						if (!login()) echo "<br>Morate biti ulogovani da biste kupili proizvod";
						else echo "<br><button onclick='ubaciUKorpu($id)'>Ubaci u korpu....</button>";
						//echo "<div><img width='20px' src='".(file_exists("avatari/$red->autor.jpg")?"avatari/$red->autor.jpg":"avatari/nouser.jpg")."' alt='No avatar'> <b>$red->ime $red->prezime</b> | <i>$red->vreme</i></div>";
						echo "</div>";
						echo "</div>";
						//Povećavanje kolone pogledan
						$upit = "UPDATE proizvodi SET pogledan=pogledan+1 WHERE id={$id}";
						$db->query($upit);
					} else echo "Ne postoji takav proizvod";
				} else echo "id nije broj";
			} else
				echo "Niste izabrali proizvod";
			?>
			<br>
			<form action="proizvodi.php?id=<?= $red->id ?>" method="post" style='display:<?= $tip ?>'>
				<input type="text" name="ime" placeholder="Unesite ime" /><br><br>
				<textarea name="komentar" id="komentar" cols="30" rows="10" placeholder="Unesite komentar"></textarea><br><br>
				<button>Snimite komentar</button>
			</form><br>
			<?php
			//Snimanje komentara
			if (isset($_POST['ime']) and isset($_POST['komentar'])) {
				$ime = $_POST['ime'];
				$komentar = $_POST['komentar'];
				//$idProizvoda=$_GET['id'];
				if ($ime != "" and $komentar != "") {
					$upit = "INSERT INTO komentari (idProizvoda, ime, komentar) VALUES ({$id}, '{$ime}', '{$komentar}')";
					$db->query($upit);
					if ($db->error()) echo "Greška!!!!<br>" . $db->error();
					else echo "Uspešno snimljen komentar. Postaće vidljiv kad ga Administrator odobri";
				} else echo "Svi podaci su obavezni!!!!";
			}
			?>
			<?php
			//Lajkovanje/Dislajkovanje
			if (isset($_GET['idKomentara']) and isset($_GET['funkcija'])) {
				$idKomentara = $_GET['idKomentara'];
				$funkcija = $_GET['funkcija'];
				if ($funkcija == "volime") $upit = "UPDATE komentari SET volime=volime+1 WHERE id={$idKomentara}";
				else $upit = "UPDATE komentari SET nevolime=nevolime+1 WHERE id={$idKomentara}";
				$db->query($upit);
				if ($funkcija == "volime") $upit = "INSERT INTO provera (idKorisnika, idKomentara, volime) VALUES ({$_SESSION['id']}, {$idKomentara}, 1)";
				else $upit = "INSERT INTO provera (idKorisnika, idKomentara, nevolime) VALUES ({$_SESSION['id']}, {$idKomentara}, 1)";
				$db->query($upit);
			}
			?>
			<h3>Uneti komentari</h3>
			<?php
			//Prikaz komentara
			$upit = "SELECT * FROM komentari WHERE idProizvoda=$id and odobren=1 ORDER BY vreme DESC";
			$rez = $db->query($upit);
			if ($db->num_rows($rez) != 0) {
				while ($red = $db->fetch_object($rez)) {
					echo "<div>";
					echo "<i>$red->vreme</i><br>";
					echo "<b>$red->ime</b><br>";
					echo "$red->komentar<br>";
					if (login()) {
						$upit = "SELECT * FROM provera WHERE idKorisnika={$_SESSION['id']} AND idKomentara={$red->id} and volime=1";
						$pomrez = $db->query($upit);
						if ($db->num_rows($pomrez) == 0)
							echo "Likes: <a href='proizvodi.php?id=$id&idKomentara=$red->id&funkcija=volime'>$red->volime</a> ";
						else
							echo "Likes: $red->volime ";
					} else echo "Likes: $red->volime ";
					if (login()) {
						$upit = "SELECT * FROM provera WHERE idKorisnika={$_SESSION['id']} AND idKomentara={$red->id} and nevolime=1";
						$pomrez = $db->query($upit);
						if ($db->num_rows($pomrez) == 0)
							echo "Dislikes: <a href='proizvodi.php?id=$id&idKomentara=$red->id&funkcija=nevolime'>$red->nevolime</a>";
						else
							echo "Dislikes: $red->nevolime";
					} else echo "Dislikes: $red->nevolime";


					echo "</div><br>";
				}
			} else
				echo "nema nijedan komentar <br>Budite prvi.....";
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