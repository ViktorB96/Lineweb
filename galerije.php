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

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&display=swap&subset=latin-ext" rel="stylesheet">
	<link href="style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/token-input.css" type="text/css" />
	<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
	<script src="js/jquery-3.4.1.js"></script>
	<script src="js/galerije.js"></script>
	<style>
		.slika {
			height: 200px;
			border: 1px solid black;
			padding: 2px;
			margin: 5px;
			display: inline-block;
		}
	</style>
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
			<h1>Galerije</h1>
			<input type="text" id="nazivGalerije" placeholder="Unesite naziv"><br><br>
			<input type="text" id="komentarGalerije" placeholder="Unesite komentar"><br><br>
			<button id="btnSnimiGaleriju">Snimite galeriju</button><br><br>
			<div id="odgovor"></div>
			<hr>

			<br><br>
			<form id="forma" action="" method="" enctype="multipart/form-data">
				<select name="idGalerije" id="idGalerije" onchange="popuniSlike()"></select>
				<button id="obrisiGaleriju" type="button">Obriši galeriju</button><br><br>
				<input type="file" id="slika" name="slika"><br><br>
				<input type="text" id="komentarSlike" name="komentarSlike" placeholder="Unesite komentar"><br><br>
				<input type="text" id="tagovi" name="tagovi"><br><br>
				<button type="button" id="btnSnimiSliku">Snimi sliku</button>
			</form>
			<hr>
			<div id="divPrikazSlika"></div>
		</div>



		<?php
		//Priključivanje futera
		include("_footer.php");
		?>

	</div><!-- end #wrapper -->

</body>

</html>