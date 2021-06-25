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
<link href="css/lightbox.css" rel="stylesheet" />
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
		<?php
		$upit="SELECT * FROM galerije ORDER BY datum DESC";
		$rez=$db->query($upit);
		echo "<ul>";
		while($red=$db->fetch_object($rez))
			echo "<li><a href='slike.php?idGalerije=$red->id'>$red->naziv ($red->komentar)</a></li>";
		echo "</ul>";
		?>
		<hr>
		<div>
		<?php
		if(isset($_GET['idGalerije']))
		{
			$idGalerije=$_GET['idGalerije'];
			if(filter_var($idGalerije, FILTER_VALIDATE_INT))
			{
				$upit="SELECT * FROM galerijeslike WHERE idGalerije=".$idGalerije;
				$rez=$db->query($upit);
				if($db->num_rows($rez)>0)
				{
					while($red=$db->fetch_object($rez))
					{
						echo "<div class='galerija'>";
						//echo "<img class='slika' src='galerije/$red->slika' alt='Slika'><br>";
						echo "<a href='galerije/$red->slika' data-lightbox='roadtrip'><img class='slika' src='galerije/$red->slika' alt='Slika'></a><br>";
						echo $red->komentarSlike."<br>";
						if($red->tag!="")
						{
							$sql="SELECT ime, prezime FROM korisnici WHERE id IN ($red->tag)";
							$pomrez=$db->query($sql);
							echo "<div>";
							while($pomred=$db->fetch_object($pomrez))
								echo $pomred->ime." ".$pomred->prezime.", ";
							echo "</div>";

						}
						else $red->tag="&nbsp;";
						echo "</div>";
					}
						
				}
				else echo "Galerija nema ni jednu sliku";
			}
			else echo "Ovo nije broj!!!!";
		}
		?>
		</div>
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
	<script src="js/lightbox-plus-jquery.js"></script>
</body>
</html>





