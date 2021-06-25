<div id="sidebar">
			<div class="block">
				<h2>Vreme</h2>
				<div>
				<?php
					$ip="109.121.27.219";
					//$ip=$_SERVER['REMOTE_ADDR'];
					
					$json=file_get_contents("http://ip-api.com/json/".$ip);
					$grad=JSON_decode($json);
					//print_r($grad);
					//exit();
					$upit=$grad->city.",".$grad->country;
					$json=file_get_contents("ovid-193.p.rapidapi.com".$upit."&apikey=19a9cfab6amsh872c86e2f9a5d8bp104ff6jsn856adfc3cacf");
					$lokacija=JSON_decode($json);
					print_r($lokacija);
					echo "<h4>".$lokacija[0]->LocalizedName.", ".$lokacija[0]->Country->LocalizedName."</h4>";
					$json=file_get_contents("http://apidev.accuweather.com/currentconditions/v1/".$lokacija[0]->Key.".json?language=en&apikey=hoArfRosT1215");
					$vreme=JSON_decode($json);
					//print_r($vreme);
					echo "<i>".date("d:m:Y H:i", $vreme[0]->EpochTime)."</i><br>";
					echo "<b>".$vreme[0]->WeatherText."</b><br>";
					echo "<h3>".$vreme[0]->Temperature->Metric->Value." ".$vreme[0]->Temperature->Metric->Unit."</h3>";
					//echo $vreme[0]->WeatherIcon;
					if(strlen($vreme[0]->WeatherIcon)==1)$vreme[0]->WeatherIcon="0".$vreme[0]->WeatherIcon;
					echo "<img src='http://apidev.accuweather.com/developers/Media/Default/WeatherIcons/".$vreme[0]->WeatherIcon."-s.png' height='70px'>"
				?>
				</div>
				<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque vel perferendis maiores nisi eos vitae laboriosam omnis deleniti odio expedita inventore aspernatur, aperiam quos, id excepturi quaerat eveniet voluptatibus eum, ipsa quibusdam minus earum facilis? Laborum, eligendi, nesciunt. Fugit, soluta!</p>-->
			</div><!-- end .block -->
			
			<div class="block">
				<h2>Zagađenje</h2>
				<script  type="text/javascript"  charset="utf-8">  
					(function(w,d,t,f){  w[f]=w[f]||function(c,k,n){s=w[f],k=s['k']=(s['k']||(k?('&k='+k):''));s['c']=  
					c=(c  instanceof  Array)?c:[c];s['n']=n=n||0;L=d.createElement(t),e=d.getElementsByTagName(t)[0];  
					L.async=1;L.src='//feed.aqicn.org/feed/'+(c[n].city)+'/'+(c[n].lang||'')+'/feed.v1.js?n='+n+k;  
					e.parentNode.insertBefore(L,e);  };  })(  window,document,'script','_aqiFeed'  );    
				</script>
				<div>
				<span  id="city-aqi-container"></span>  
  
				<script  type="text/javascript"  charset="utf-8">  
					_aqiFeed({  display:"%details", container:"city-aqi-container",  city:"belgrade"  });  
				</script>
				</div>
				<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque vel perferendis maiores nisi eos vitae laboriosam omnis deleniti odio expedita inventore aspernatur, aperiam quos, id excepturi quaerat eveniet voluptatibus eum, ipsa quibusdam minus earum facilis? Laborum, eligendi, nesciunt. Fugit, soluta!</p>-->
			</div><!-- end .block -->
			
			<div class="block">
				<h2>Treci</h2>
				<img src="images/location.png" alt="">
				<p><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, nesciunt. &raquo;</a></p>
			</div><!-- end .block -->
		
		</div><!-- end #sidebar -->