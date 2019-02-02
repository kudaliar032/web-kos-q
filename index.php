<?php
	include "config.php";
	$home = "w3-theme";
	$title = "KOS-Q";
	include "atas.php";
	mysql_query("UPDATE statistikWeb SET visitor = visitor + 1 WHERE id = 0");
?>

<div class="w3-bar w3-xlarge w3-margin-bottom">
    &nbsp;
</div>

<div class="w3-display-container">
	<div id="header" style="height:400px;width:100%"></div>
    <div class="w3-display-middle">
		<h1 class="w3-jumbo w3-text-white w3-wide w3-black w3-opacity w3-padding"><b>Mau cari kost?</b></h1>
		<form class="w3-center">
			<input class="w3-input w3-margin-bottom" id="address" type="text" placeholder="Masukan nama tempat disini...">
  			<input type="button" id="submit" class="w3-bar-item w3-button w3-theme-d3 w3-hover-theme" value="CARI KOST DISEKITAR LOKASI"/>
		</form>
	</div>
</div>

<!-- isi dari web -->
<div class="w3-container">
	<div class="w3-row">
		<div class="w3-col l1 w3-hide-medium w3-hide-small">
			&nbsp;
		</div>
		<div class="w3-col l10 m12 s12 w3-text-theme">
			<div class="w3-center w3-margin-bottom">
				<h1 class="w3-margin-top">PILIH KOST YANG KAMU SUKA!</h1>
				<label>Klik di salah satu kost pada peta</label>
			</div>
			<div id="map" class="w3-margin-top w3-margin-bottom" style="height:500px"></div>
			<div class="w3-center w3-margin-bottom">
				<h1 class="w3-margin-top">REKOMENDASI KOST BUAT KAMU!</h1>
				<label>Pilihlah kost-kostnya buatmu yang terbaik</label>
			</div>
			
			<div class="w3-row-padding w3-margin-top w3-center">
			<?php
				$sqlsql = "SELECT * FROM dataKost dk
						   INNER JOIN kapasitasKost kk ON dk.id = kk.id_kost
						   INNER JOIN fotoKost fk ON dk.id = fk.id WHERE kk.kapasitas > 0 ORDER BY rand()";
				$queryquery = mysql_query($sqlsql);
				while($k = mysql_fetch_array($queryquery)) { ?>
					<div class="w3-col l3 m4 s6">
						<div class="limitTampil w3-margin-top w3-border">
							<div class="w3-display-container">
								<div class="w3-display-bottomleft w3-theme-dark w3-padding-small">
									<?php echo "".($k['harga']/1000)."K"; ?>
								</div>
								<div style="width:100%;height:200px;overflow:hidden" class="w3-white w3-border-bottom">
									<center><img src="<?=$k['fotoKT']?>" height="200px" alt="<?=$k['nama']?>"/></center>
								</div>
							</div>

							<div class="w3-row">
								<div class="w3-medium w3-margin-top">
									<b><?=$k['nama']?></b>
								</div>
								<div class="w3-small">
									Tersedia <?=$k['kapasitas']?> Kamar
								</div>
							</div>

							<?php
							    $ksq = mysql_query("SELECT AVG(kenyamanan) AS kenyamanan, AVG(keamanan) AS keamanan, AVG(kebersihan) AS kebersihan, COUNT(*) AS jumlahReview FROM reviewKost WHERE idKost = $k[id]");
							    $ytg = mysql_fetch_array($ksq);

							    $kenyamanan = $ytg['kenyamanan'];
							    $keamanan = $ytg['keamanan'];
							    $kebersihan = $ytg['kebersihan'];
							    $rata2 = round(($kenyamanan + $keamanan + $kebersihan) / 3);
							?>

							<div class="w3-bar w3-text-black w3-padding-small">
				                <?php
				                    for($a=0; $a<$rata2; $a++) {
				                        echo "<span class='w3-large fa fa-star checked'></span>";
				                    }
				                    for($a=0; $a<abs($rata2-5); $a++) {
				                        echo "<span class='w3-large fa fa-star'></span>";
				                    }
				                ?> (<?=$ytg['jumlahReview']?>)
							</div>

							<div onclick="location.href='tampil.php?id=<?=$k['id']?>'" class="w3-padding w3-margin w3-row w3-theme-d3 w3-hover-theme" style="cursor: pointer">
								Selengkapnya
							</div>
						</div>
					</div>				
			<?
				}
			?>
			</div>

			<div class="w3-row-padding w3-center w3-margin-top">
				<div id="tampilkanLain" class="w3-button w3-hover-theme w3-theme-d5">
					<b>TAMPILKAN LAINNYA</b>
				</div>
			</div>
		</div>
	</div>
</div>


<br/><br/>

<script>
	$(window).scroll(function(){
		$(".limitTampil").slice(0, 4).show();
		if ($(window).scrollTop() == $(document).height() - $(window).height()){
			e.preventDefault();
			$(".limitTampil:hidden").slice(0, 4).slideDown();
		}
	 }); 


	$(function () {
		$(".limitTampil").slice(0, 4).show();
		$("#tampilkanLain").on('click', function (e) {
			e.preventDefault();
			$(".limitTampil:hidden").slice(0, 4).slideDown();
		});
	});
</script>

<!-- import maps -->
<script>
	var locations = [
		<?php
		mysql_select_db("kost");
			$sql = "SELECT * FROM dataKost dk INNER JOIN kapasitasKost kk ON dk.id = kk.id_kost";
			$hasil = mysql_query($sql);
			while($x = mysql_fetch_object($hasil)){
				?>
				['<?=$x->id;?>', parseFloat(<?=$x->lat;?>), parseFloat(<?=$x->long;?>), '<?=$x->nama?>', '<?=$x->kapasitas?>'],
			<?
			}
			?>
	];

	function initMap() {
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 15,
			center: {lat: -7.962681, lng: 112.618052}
		});

		var infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          	navigator.geolocation.getCurrentPosition(function(position) {
	            var pos = {
		              lat: position.coords.latitude,
		              lng: position.coords.longitude
	            };

            	map.setCenter(pos);
           		map.setZoom(15);

          }, function() {
            	handleLocationError(true, infoWindow, map.getCenter());
          });

        } else {
          	// Browser doesn't support Geolocation
          	handleLocationError(false, infoWindow, map.getCenter());
        }

		// menset maker pada peta
		setMarkers(map, locations);

        // membuat autocompele di kotak pencarian
        var input = document.getElementById('address');
        var searchBox = new google.maps.places.SearchBox(input);

		// fungsi mengembalikan nilai yang mungkin ke kotak pencarian
		map.addListener('bounds_changed', function() {
          	searchBox.setBounds(map.getBounds());
        });

		// membuat geo coder
		var geocoder = new google.maps.Geocoder();
		document.getElementById('submit').addEventListener('click', function() {
			geocodeAddress(geocoder, map);
		});
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
						'Error: The Geolocation service failed.' :
						'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }

	function setMarkers(map,locations) {
		var marker, i
		for (i = 0; i < locations.length; i++) {  
			var id = locations[i][0];
			var lat = locations[i][1];
			var long = locations[i][2];
			var nama =  locations[i][3];
			var kapasitas = locations[i][4];

			if(kapasitas > 0) {
				kapasitas = "isi";
			} else {
				kapasitas = "kosong";
			}

			var content = "<a href='tampil.php?id=" + id +"'>" + nama +  "</a>";
			var infowindow = new google.maps.InfoWindow();
			
			latlngset = new google.maps.LatLng(lat, long);
			var marker = new google.maps.Marker({  
				map: map,
				title: nama,
				position: latlngset,
				icon: "img/tanda"+kapasitas+".png"
			});

			google.maps.event.addListener(marker,'click', (function(marker,content,infowindow){ 
				return function() {
			   		infowindow.setContent(content);
			   		infowindow.open(map,marker);
				};
			})(marker,content,infowindow)); 
		}
	}

	// pencarian geocoder
	function geocodeAddress(geocoder, resultsMap) {
		var address = document.getElementById('address').value;
		geocoder.geocode({'address': address}, function(results, status) {
			if (status === 'OK') {
				resultsMap.setCenter(results[0].geometry.location);
				document.getElementById('lokasi').value = results[0].geometry.location;
			} else {
				alert('Geocode was not successful for the following reason: ' + status);
			}
		});
	}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB25rSBeWMd1f5i5VLN_7rBN54gcUHB0Xk&libraries=places&callback=initMap"
async defer></script>

<?php
	$nomorHeader = range(1, 6);
	shuffle($nomorHeader);
?>

<script type="text/javascript">
    // 360 viewer
    viewer = pannellum.viewer('header',{
        "panorama": "img/home/home<?=$nomorHeader[0]?>.jpg",
        "autoLoad": true,
        "showControls": false,
        "mouseZoom": false,
        "autoRotate": 2
        });
</script>

<?php
	include "bawah.php";
?>
