<?php
session_start();
require_once("require.php");
$db=new Baza();
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
<script src="js/korpa.js"></script>
<style>
.proizvod{
	border:1px solid black;
	margin:5px;
	padding: 5px;
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
		<h2>Proizvodi u korpi</h2>
		<div id="divKorpa"></div>
		<hr>
		<h2>Kupljeni proizvodi</h2>
		<div id="divKupljeni"></div>
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




