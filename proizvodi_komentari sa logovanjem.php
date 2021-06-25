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
		if(isset($_GET['id']))
		{
			$id=$_GET['id'];
			$id=intval($id);
			if(is_int($id))
			{
				$upit="SELECT * FROM vwproizvodi WHERE obrisan=0 AND id={$id}";
				$rez=$db->query($upit);
				if($db->num_rows($rez)!=0)
				{
					$red=$db->fetch_object($rez);
					echo "<br><br><div class='vest'>";
					echo "<div style='display: inline-block; vertical-align: top'><img src='".((file_exists("slike/$red->id.jpg"))?"slike/$red->id.jpg":"slike/noimage.jpg")."' width='100px' alt='Nema slike'></div>";
					echo "<div style='display: inline-block'>";
					echo "<div><a href='index.php?kategorija=$red->kategorija'>$red->naziv</a></div>";
					echo "<p><a href='proizvodi.php?id=$red->id'><b>$red->naslov</b></a></p>";
					echo "<div>$red->opis</div><br>";
					echo "<div>Likes: $red->likes, Dislikes: $red->dislikes</div>";
					if(file_exists("avatari/$red->autor.jpg"))
						$avatar="avatari/$red->autor.jpg";
					else
						$avatar="avatari/nouser.jpg";
						echo "<div><img width='20px' src='$avatar' alt='No avatar'> <b>$red->ime $red->prezime</b> | <i>$red->vreme</i></div>";
					//echo "<div><img width='20px' src='".(file_exists("avatari/$red->autor.jpg")?"avatari/$red->autor.jpg":"avatari/nouser.jpg")."' alt='No avatar'> <b>$red->ime $red->prezime</b> | <i>$red->vreme</i></div>";
					echo "</div>";
					echo "</div>";
				}
				else echo "Ne postoji takav proizvod";
			}
			else echo "id nije broj";
		}
		else
			echo "Niste izabrali proizvod";
		?>
		<br>
		<?php
		//Prikaz forme za komentare ako je korisnik prijavljen odnosno nema forme ako nije prijavljen
		if(login())$tip="";
		else $tip="none";
		?>
		<form action="proizvodi.php?id=<?=$red->id?>" method="post" style='display:<?=$tip?>'>
		<input type="text" name="ime" placeholder="Unesite ime"/><br><br>
		<textarea name="komentar" id="komentar" cols="30" rows="10" placeholder="Unesite komentar"></textarea><br><br>
		<button>Snimite komentar</button>		
		</form><br>
		<?php
		if(isset($_POST['ime']) and isset($_POST['komentar']))
		{
			$ime=$_POST['ime'];
			$komentar=$_POST['komentar'];
			//$idProizvoda=$_GET['id'];
			if($ime!="" and $komentar!="")
			{
				$upit="INSERT INTO komentari (idProizvoda, ime, komentar) VALUES ({$id}, '{$ime}', '{$komentar}')";
				$db->query($upit);
				if($db->error())echo "Greška!!!!<br>".$db->error();
				else echo "Uspešno snimljen komentar";
			}
			else echo "Svi podaci su obavezni!!!!";
		}
		?>
		<h3>Uneti komentari</h3>
		<?php
		$upit="SELECT * FROM komentari WHERE idProizvoda=$id  ORDER BY vreme DESC LIMIT 0,3 ";
		$rez=$db->query($upit);
		if($db->num_rows($rez)!=0)
		{
			while($red=$db->fetch_object($rez))
			{
				echo "<div>";
				echo "<i>$red->vreme</i><br>";
				echo "<b>$red->ime</b><br>";
				echo "$red->komentar<br>";
				echo "Likes: $red->volime ";
				echo "Dislikes: $red->nevolime";
				echo "</div><br>";
			}
			
		}
		else
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




