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
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="style.css" rel="stylesheet">

	<script src="js/jquery-3.4.1.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/prijava.js"></script>
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
		<h1>Prijava</h1>
		<div class="form-group">
			<input class="form-control" type="text" id="korime" name="korime" placeholder="Unesite korisničko ime" />
		</div>
		<div class="form-group">
			<input class="form-control" type="text" id="lozinka" name="lozinka" placeholder="Unesite lozinka" />
		</div>
		<div class="checkbox">
			<label><input type="checkbox" id="zapamti" name="zapamti"> Zapamti me</label>
		</div>
		<button class="btn btn-primary" id="btnPrijava" type="button">Prijavi me</button>
		<br><br>
		<div id="poruka"></div><br>
		<button class="btn btn-default" id="btnPrikaziRegistraciju" type="button">Niste registrovani? Registrujte se</button>
		<button class="btn btn-default" id="btnPrikaziLozinku" type="button">Zaboravili ste lozinku?</button>
		<br><br>
		<div id="divRegistracija" style="display:none">
			<input type="text" id="rime" placeholder="Unesite ime"><br>
			<input type="text" id="rprezime" placeholder="Unesite prezime"><br>
			<input type="text" id="remail" placeholder="Unesite email"><br>
			<button class="btn btn-default" id="btnSnimiRegistraciju" type="button">Snimite podatke</button>
		</div>
		<br>
		<div id="divLozinka" style="display:none">
			<input type="text" id="lemail" placeholder="Unesite email"><br>
			<button class="btn btn-default" id="btnPosaljiLozinku" type="button">Pošalji lozinku</button>
		</div>
		<br>
		<?php
		//Priključivanje futera
		include("_footer.php");
		?>

	</div><!-- end #wrapper -->

</body>

</html>