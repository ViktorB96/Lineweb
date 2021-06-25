<?php
session_start();
require_once("require.php");
if (!login()) {
	echo "Morate biti prijavljeni da biste videli ovu stranicu.<br>";
	echo "<a href='prijava.php?link=" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'] . "'>Prijavite se</a>";
	exit();
}

if ($_SESSION['status'] != "Administrator") {
	echo "Morate biti prijavljeni kao administrator da biste videli ovu stranicu.<br>";
	echo "<a href='index.php'>Početna</a>";
	exit();
}
$db = new Baza();
$db->connect();
$poruka = "";
if (isset($_POST['dugme'])) {
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	$email = $_POST['email'];
	$lozinka = $_POST['lozinka'];
	$komentar = $_POST['komentar'];
	$adresa = $_POST['adresa'];
	$telefon = $_POST['telefon'];
	$status = $_POST['status'];
	if ($ime != "" and $prezime != "" and $email != "" and $lozinka != "" and $adresa != "" and $telefon != "" and $status != "0") {
		$upit = "INSERT INTO korisnici (ime, prezime, email, lozinka, adresa, telefon, status, komentar) VALUES ('{$ime}', '{$prezime}', '{$email}', '{$lozinka}', '{$adresa}', '{$telefon}', '{$status}', '{$komentar}')";
		$db->query($upit);
		if ($db->error()) $poruka = $db->error();
		else {
			$poruka = "Uspešno snimljen korisnik";
			Log::upisiLog("logovi/korisnici.txt", "Uspešno dodat korisnik $ime $prezime od strane {$_SESSION['ime']}");
			if ($_FILES['avatar']['name'] != "") {
				$ime = "avatari/" . $db->insert_id() . ".jpg";
				move_uploaded_file($_FILES['avatar']['tmp_name'], $ime);
			}
		}
	} else $poruka = "Niste uneli sve podatke";
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
			<h1>Dodavanje korisnika</h1>
			<form action="#" method='post' enctype="multipart/form-data" name="forma">
				<input type="text" name="ime" placeholder="Unesite ime"><br><br>
				<input type="text" name="prezime" placeholder="Unesite prezime"><br><br>
				<input type="text" name="email" placeholder="Unesite email"><br><br>
				<input type="text" name="lozinka" placeholder="Unesite lozinka"><br><br>
				<input type="text" name="adresa" placeholder="Unesite adresa"><br><br>
				<input type="text" name="telefon" placeholder="Unesite telefon"><br><br>
				<select name="status" id="status">
					<option value="0">--izaberite status--</option>
					<option value="Administrator">Administrator</option>
					<option value="Korisnik">Korisnik</option>
				</select><br><br>
				<textarea name="komentar" id="komentar" cols="30" rows="10"></textarea><br><br>
				<input type="file" name="avatar" /><br><br>
				<button name="dugme">Snimi korisnika</button>
			</form>
			<br><br>
			<div><?= $poruka ?></div>
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