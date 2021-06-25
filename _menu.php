<div id="nav">
			<ul>
				<li><a href="index.php">Početna strana</a></li>
				<li><a href="#">Kategorije</a>
					<ul>
                        <?php
                        
                        $upit="SELECT * FROM kategorije";
                        $rez=$db->query($upit);
                        while($red=$db->fetch_object($rez))
                            echo "<li><a href='index.php?kategorija=$red->id'>$red->naziv</a></li>";
                        ?>
						<!--<li><a href="#">Proizvod A</a></li>
						<li><a href="#">Proizvod B</a></li>
						<li><a href="#">Proizvod C</a></li>-->
					</ul>
				</li>
				<li><a href="#">o nama</a>
					<ul>
						<li><a href="#">Misija</a></li>
						<li><a href="#">Vizija</a></li>
					</ul>
				</li>
				<li><a href="slike.php">Galerije</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
                <?php
                if (login())
                {
                    //echo "<li><a href='prijava.php?odjava' title='Odjava'>{$_SESSION['ime']} ({$_SESSION['status']})</a></li>";
                    echo "<li><a href='#'>{$_SESSION['ime']} ({$_SESSION['status']})</a>
					<ul>";
					if($_SESSION['status']=="Administrator")
					{
						echo "<li><a href='#'>ADMIN</a></li>";
						echo "<li><a href='adduser.php'>Dodaj korisnika</a></li>";
						echo "<li><a href='deleteuser.php'>Obriši korisnika</a></li>";
						echo "<li><a href='komentari.php'>Komentari</a></li>";
						echo "<li><a href='odgovori.php'>Odgovori</a></li>";
						echo "<li><a href='galerije.php'>Galerije</a></li>";
						echo "<li><a href='statistika.php'>Statistika</a></li>";
					}
						
					echo "<li><a href='#'>KORISNIK</a></li>
						<li><a href='addproduct.php'>Dodaj proizvod</a></li>
						<li><a href='deleteproduct.php'>Obriši proizvod</a></li>
						<li><a href='pitanja.php'>Pitanja</a></li>
						<script src='js/broj.js'></script>
						<li><a href='korpa.php'>Korpa (<span id='broj'></span>)</a></li>
						<li><a href='prijava.php?odjava'>Odjava</a></li>
						
					</ul>
				</li>";
                }
                else
                    echo "<li><a href='prijava.php'>Prijava</a></li>";
                ?>
                
			</ul>
		</div><!-- end #nav -->