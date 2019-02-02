<?php
    $sqlsqlku = "SELECT * FROM dataKost dk  INNER JOIN kapasitasKost kk ON dk.id = kk.id_kost 
                                            INNER JOIN fotoKost fk ON dk.id = fk.id 
                                            INNER JOIN kontakKost ko ON dk.id = ko.id 
                                            INNER JOIN spesifikasiKost sk ON dk.id = sk.id
                                            WHERE dk.id='$_GET[id]'";
    $sqlsqlmu = mysql_query($sqlsqlku);
    $fuk = mysql_fetch_array($sqlsqlmu);
?>
<header class="w3-container">
    <h2><b><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;MANAJEMEN INFO KOST&nbsp;/&nbsp;<?=strtoupper($fuk['nama'])?></b></h2>
</header>

<div class="w3-container w3-margin-bottom">
    <h4>Pilih lokasi kost:</h4>
    <div id="map" class="w3-border"></div>
</div>
<div class="w3-container w3-margin-bottom">
	<form class="w3-cointainer" method="POST">
        <!-- lokasi dari kost -->
        <input value="<?=$fuk['lat']?>" type="text" name="lat" id="latitude" placeholder="Latitiude" required>
        <input value="<?=$fuk['long']?>" type="text" name="long" id="longitude" placeholder="Longitude" required>

        <!-- form wajib diisi-->
        <div class="w3-row w3-section">
            <label class="w3-text-dark-grey"><b>Nama kost:</b></label>
            <input value="<?=$fuk['nama']?>" class="w3-input w3-border" type="text" name="nama" required/>
        </div>
        <div class="w3-row w3-section">
            <label class="w3-text-dark-grey"><b>Harga perbulan:</b></label>
            <input value="<?=$fuk['harga']?>" class="w3-input w3-border" type="text" name="harga"/>
        </div>
        <div class="w3-row w3-section">
            <label class="w3-text-dark-grey"><b>Kapasitas kost:</b></label>
            <input value="<?=$fuk['kapasitas']?>" class="w3-input w3-border" type="text" name="kapasitas"/>
        </div>            
        <div class="w3-row w3-section">
            <label class="w3-text-dark-grey"><b>No ponsel:</b></label>
            <input value="<?=$fuk['phone']?>" class="w3-input w3-border" type="text" name="phone"/>
        </div>
        <div class="w3-row w3-section">
            <label class="w3-text-dark-grey"><b>Alamat email:</b></label>
            <input value="<?=$fuk['email']?>" class="w3-input w3-border" type="text" name="email"/>
        </div>

        <hr/>

        <!-- from fasilitas -->
        <label class="w3-text-dark-grey"><b>Fasilitas kost:</b></label>
        <div class="w3-row">
	        <?php
	        	$iop = mysql_query("SELECT * FROM fasilitasKamar WHERE id = $_GET[id]");
	    	    $meja = "";			$kasur = "";
	    		$kursi = "";		$lemari = "";
	    		$rias = "";			$wifi = "";
	        	while ($koi = mysql_fetch_array($iop)) {
	        		if($koi['kamarIcon'] == "meja") {
	        			$meja = "checked";
	        		} elseif($koi['kamarIcon'] == "kursi") {
	        			$kursi = "checked";        		
	        		} elseif($koi['kamarIcon'] == "rias") {
	        			$rias = "checked";        		
	        		} elseif($koi['kamarIcon'] == "kasur") {
	        			$kasur = "checked";        		
	        		} elseif($koi['kamarIcon'] == "lemari") {
	        			$lemari = "checked";        		
	        		} elseif($koi['kamarIcon'] == "wifi") {
	        			$wifi = "checked";
	        		}
	        	}
	        ?>
	        <div class="w3-half">
	            <p>
	                <input type="checkbox" name="kamar[]" value="meja" class="w3-check" <?=$meja?>/>
	                <label>Meja belajar</label>
	            </p>
	            <p>
	                <input type="checkbox" name="kamar[]" value="kursi" class="w3-check" <?=$kursi?>/>
	                <label>Kursi</label>
	            </p>
	            <p>
	                <input type="checkbox" name="kamar[]" value="rias" class="w3-check" <?=$rias?>/>
	                <label>Meja rias</label>
	            </p>
	            <p>
	                <input type="checkbox" name="kamar[]" value="kasur" class="w3-check" <?=$kasur?>/>
	                <label>Kasur</label>
	            </p>
	            <p>
	                <input type="checkbox" name="kamar[]" value="lemari" class="w3-check" <?=$lemari?>/>
	                <label>Lemari pakaian</label>
	            </p>
	            <p>
	                <input type="checkbox" name="kamar[]" value="wifi" class="w3-check" <?=$wifi?>/>
	                <label>WI-FI</label>
	            </p>

	        </div>
		    <?php
	        	$iop = mysql_query("SELECT * FROM fasilitasMandi WHERE id = $_GET[id]");
	    	    $dalam = "";		$duduk = "";
	    		$shower = "";		$hangat = "";
	        	while ($koi = mysql_fetch_array($iop)) {
	        		if($koi['mandiIcon'] == "dalam") {
	        			$dalam = "checked";
	        		} elseif($koi['mandiIcon'] == "shower") {
	        			$shower = "checked";        		
	        		} elseif($koi['mandiIcon'] == "duduk") {
	        			$duduk = "checked";        		
	        		} elseif($koi['mandiIcon'] == "hangat") {
	        			$hangat = "checked";        		
	        		}
	        	}
	        ?>
	        <div class="w3-half">
	            <p>
	                <input type="checkbox" name="mandi[]" value="dalam" class="w3-check" <?=$dalam?>/>
	                <label>Kamar mandi dalam</label>
	            </p>
	            <p>
	                <input type="checkbox" <?=$shower?> name="mandi[]" value="shower" class="w3-check"/>
	                <label>Shower</label>
	            </p>
	            <p>
	                <input type="checkbox" <?=$duduk?> name="mandi[]" value="duduk" class="w3-check"/>
	                <label>Toilet duduk</label>
	            </p>
	            <p>
	                <input type="checkbox" <?=$hangat?> name="mandi[]" value="hangat" class="w3-check"/>
	                <label>Air hangat</label>
	            </p><br/><br/><br/><br/>
	        </div>
    	</div>

        <hr/>

        <div class="w3-row w3-section">
            <label class="w3-text-dark-grey"><b>Deskripsi kost:</b></label>
            <textarea rows="10" class="w3-input w3-border" name="intro"/><?=$fuk['intro']?></textarea>
        </div>
        <div class="w3-row w3-section">
            <label class="w3-text-dark-grey"><b>Panjang kamar:</b></label>
            <input class="w3-input w3-border" value="<?=$fuk['panjangKamar']?>" type="number" name="panjang"/>
        </div>
        <div class="w3-row w3-section">
            <label class="w3-text-dark-grey"><b>Lebar kamar:</b></label>
            <input class="w3-input w3-border" value="<?=$fuk['lebarKamar']?>" type="number" name="lebar"/>
        </div>
        <div class="w3-third">
            <label class="w3-text-dark-grey"><b>Pembayaran air:</b></label>
            <div class="w3-row w3-section">
                <input <?php if($fuk['air'] == "Bayar masing-masing") echo "checked"; ?> type="radio" name="air" value="Bayar masing-masing" class="w3-radio"/>
                <label>Bayar sendiri</label>
            </div>
            <div class="w3-row w3-section">
                <input <?php if($fuk['air'] == "Termasuk biaya kost") echo "checked"; ?> type="radio" name="air" value="Termasuk biaya kost" class="w3-radio"/>
                <label>Termasuk biaya kost</label>
            </div>
        </div>

        <!-- tagihan -->
        <div class="w3-third">
            <label class="w3-text-dark-grey"><b>Pembayaran listrik:</b></label>
            <div class="w3-row w3-section">
                <input <?php if($fuk['listrik'] == "Bayar masing-masing") echo "checked"; ?> type="radio" name="listrik" value="Bayar masing-masing" class="w3-radio"/>
                <label>Bayar sendiri</label>
            </div>
            <div class="w3-row w3-section">
                <input <?php if($fuk['listrik'] == "Termasuk biaya kost") echo "checked"; ?> type="radio" name="listrik" value="Termasuk biaya kost" class="w3-radio"/>
                <label>Termasuk biaya kost</label>
            </div>
        </div>
        <div class="w3-third">
            <label class="w3-text-dark-grey"><b>Pembayaran internet:</b></label>
            <div class="w3-row w3-section">
                <input <?php if($fuk['internet'] == "Bayar masing-masing") echo "checked"; ?> type="radio" name="internet" value="Bayar masing-masing" class="w3-radio"/>
                <label>Bayar sendiri</label>
            </div>
            <div class="w3-row w3-section">
                <input <?php if($fuk['internet'] == "Termasuk biaya kost") echo "checked"; ?> type="radio" name="internet" value="Termasuk biaya kost" class="w3-radio"/>
                <label>Termasuk biaya kost</label>
            </div>
        </div>

        <!-- jam malam -->
        <label class="w3-text-dark-grey"><b>Jam malam:</b></label>
        <div class="w3-row">
            <div class="w3-col m2">
                <div class="w3-row w3-section">
                    <input <?php if($fuk['malam'] == "20:00") echo "checked"; ?> type="radio" name="malam" value="20:00" class="w3-radio"/>
                    <label>20:00 WIB</label>
                </div>
            </div>
            <div class="w3-col m2">
                <div class="w3-row w3-section">
                    <input <?php if($fuk['malam'] == "21:00") echo "checked"; ?> type="radio" name="malam" value="21:00" class="w3-radio"/>
                    <label>21:00 WIB</label>
                </div>
            </div>
            <div class="w3-col m2">
                <div class="w3-row w3-section">
                    <input <?php if($fuk['malam'] == "22:00") echo "checked"; ?> type="radio" name="malam" value="22:00" class="w3-radio"/>
                    <label>22:00 WIB</label>
                </div>
            </div>
            <div class="w3-col m2">
                <div class="w3-row w3-section">
                    <input <?php if($fuk['malam'] == "23:00") echo "checked"; ?> type="radio" name="malam" value="23:00" class="w3-radio"/>
                    <label>23:00 WIB</label>
                </div>
            </div>
            <div class="w3-col m2">
                <div class="w3-row w3-section">
                    <input <?php if($fuk['malam'] == "00:00") echo "checked"; ?> type="radio" name="malam" value="00:00" class="w3-radio"/>
                    <label>00:00 WIB</label>
                </div>
            </div>
            <div class="w3-col m2">
                <div class="w3-row w3-section">
                    <input <?php if($fuk['malam'] == "01:00") echo "checked"; ?> type="radio" name="malam" value="01:00" class="w3-radio"/>
                    <label>01:00 WIB</label>
                </div>
            </div>
        </div>
        <div class="w3-row w3-section">
            <label class="w3-text-dark-grey"><b>Peraturan tambahan:</b></label>
            <textarea rows="10" class="w3-input w3-border" name="peraturan"/><?=$fuk['peraturan']?></textarea>
        </div>

        <div class="w3-right">
            <input onclick="window.open('admin.php?page=daftar', '_SELF')" class="w3-button w3-red w3-margin-top" type="button	" value="Kembali"/>
            <input class="w3-button w3-green w3-margin-top" type="submit" name="updateData" value="Update"/>
        </div>        
    </form>
</div>
<script>
    // membuka formulir tambahan
    function formSembunyi(id) {
        var x = document.getElementById(id);
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else { 
            x.className = x.className.replace(" w3-show", "");
        }
    }

    function initMap() {
    	var lati = document.getElementById('latitude').value;
    	var longi = document.getElementById('longitude').value;

        var dragMe = new google.maps.InfoWindow;
        var posisi = new google.maps.LatLng(lati, longi);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: posisi
        });

        var marker = new google.maps.Marker({
            position: posisi,
            draggable: true,
            icon: '../img/tanda2.png'
        });

        var isiNya = "<h1>Drag Me!</h1>";

        marker.setMap(map);
        dragMe.setPosition(posisi);
        dragMe.setContent(isiNya);
        dragMe.open(map, marker);

        marker.addListener('drag', function() {
            dragMe.close(map, marker);
        });



        // ketika markernya didrag, koordinatnya langsung di selipin di textfield
        google.maps.event.addListener(marker, 'dragend', function(event){
            document.getElementById('latitude').value = this.getPosition().lat();
            document.getElementById('longitude').value = this.getPosition().lng();
        });
    }


</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBPXMBmMqLeLI4U1jgF2V9T7bz3duMSx9M&callback=initMap">
</script>