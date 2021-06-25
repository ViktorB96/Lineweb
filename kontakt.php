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
		<h1>Kontakt forma</h1>
		<form action="kontakt.php" method="post">
		<?php
			if(!login()) echo "<input type='text' name='email' placeholder='Unesite email'><br><br>";
		?>
		<textarea name="pitanje" id="pitanje" cols="30" rows="10" placeholder="Unesite pitanje"></textarea><br><br>
		<button>Pošaljite poruku</button>
		</form><br>
		
		<?php
		//Snimanje pitanja
		if(isset($_POST['pitanje']))
		{
			$pitanje=$_POST['pitanje'];
			if(login())
				$email=$_SESSION['email'];
			else
				$email=$_POST['email'];
			if($pitanje!="" and $email!="")
			{
				if(login())$upit="INSERT INTO kontakt (email, idKorisnika, pitanje) VALUES ('{$email}', {$_SESSION['id']}, '{$pitanje}')";
				else $upit="INSERT INTO kontakt (email, pitanje) VALUES ('{$email}', '{$pitanje}')";
				$db->query($upit);
				if($db->error())echo "GREŠKA!!!!<br>".$db->error();
				else echo "Uspešno snimljeno pitanje";
			}
			else echo "Svi podaci su obavezni!!!";
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




