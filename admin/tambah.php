<!-- Header -->
<header class="w3-container">
    <h2><b><i class="fa fa-plus"></i>&nbsp;&nbsp;TAMBAH KOST-KOSTAN</b></h2>
</header>

<div class="w3-row-padding w3-margin-bottom">

    <div class="w3-container w3-margin-bottom">
        <h4>Pilih lokasi kost:</h4>
        <div id="map" class="w3-border"></div>
    </div>

    <div class="w3-container">
        <form class="w3-cointainer" method="POST" enctype="multipart/form-data">
            <!-- lokasi dari kost -->
            <input type="text" name="lat" id="latitude" placeholder="Latitiude" required>
            <input type="text" name="long" id="longitude" placeholder="Longitude" required>

            <!-- form wajib diisi-->
            <div class="w3-row w3-section">
                <label class="w3-text-dark-grey"><b>Nama kost:</b></label>
                <input class="w3-input w3-border" type="text" name="nama" required/>
            </div>
            <div class="w3-row w3-section">
                <label class="w3-text-dark-grey"><b>Harga perbulan:</b></label>
                <input class="w3-input w3-border" type="text" name="harga" required/>
            </div>
            <div class="w3-row w3-section">
                <label class="w3-text-dark-grey"><b>Kapasitas kost:</b></label>
                <input class="w3-input w3-border" type="text" name="kapasitas" required/>
            </div>            
            <div class="w3-row w3-section">
                <label class="w3-text-dark-grey"><b>No ponsel:</b></label>
                <input class="w3-input w3-border" type="text" name="phone" required/>
            </div>
            <div class="w3-row w3-section">
                <label class="w3-text-dark-grey"><b>Alamat email:</b></label>
                <input class="w3-input w3-border" type="text" name="email" required/>
            </div>
            <div class="w3-row w3-section">
                <label class="w3-text-dark-grey"><b>Foto profile:</b></label>
                <input accept="image/jpeg" class="w3-input w3-border" type="file" name="fotoProfile" required/>
            </div>
            <div class="w3-row w3-section">
                <label class="w3-text-dark-grey"><b>Foto kamar (360):</b></label>
                <input accept="image/jpeg" class="w3-input w3-border" type="file" name="fotoHeader" required/>
            </div>

            <hr/>

            <!-- from fasilitas -->
            <div class="w3-bar w3-margin-top" onclick="formSembunyi('fasilitas')">
                <label class="w3-text-dark-grey"><b>
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                    Fasilitas kost</b>
                </label>
            </div>
            <div id="fasilitas" class="w3-container w3-hide">
                <div class="w3-half">
                    <p>
                        <input type="checkbox" name="kamar[]" value="meja" class="w3-check"/>
                        <label>Meja belajar</label>
                    </p>
                    <p>
                        <input type="checkbox" name="kamar[]" value="kursi" class="w3-check"/>
                        <label>Kursi</label>
                    </p>
                    <p>
                        <input type="checkbox" name="kamar[]" value="rias" class="w3-check"/>
                        <label>Meja rias</label>
                    </p>
                    <p>
                        <input type="checkbox" name="kamar[]" value="kasur" class="w3-check"/>
                        <label>Kasur</label>
                    </p>
                    <p>
                        <input type="checkbox" name="kamar[]" value="lemari" class="w3-check"/>
                        <label>Lemari pakaian</label>
                    </p>
                    <p>
                        <input type="checkbox" name="kamar[]" value="wifi" class="w3-check"/>
                        <label>WI-FI</label>
                    </p>

                </div>
                <div class="w3-half">
                    <p>
                        <input type="checkbox" name="mandi[]" value="dalam" class="w3-check"/>
                        <label>Kamar mandi dalam</label>
                    </p>
                    <p>
                        <input type="checkbox" name="mandi[]" value="shower" class="w3-check"/>
                        <label>Shower</label>
                    </p>
                    <p>
                        <input type="checkbox" name="mandi[]" value="duduk" class="w3-check"/>
                        <label>Toilet duduk</label>
                    </p>
                    <p>
                        <input type="checkbox" name="mandi[]" value="hangat" class="w3-check"/>
                        <label>Air hangat</label>
                    </p><br/><br/><br/><br/>
                </div>
            </div>

            <!-- spesifikasi kost -->
            <div class="w3-bar w3-margin-top" onclick="formSembunyi('spesifikasi')">
                <label class="w3-text-dark-grey"><b>
                    <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                    Spesifikasi kost</b>
                </label>
            </div>
            <div id="spesifikasi" class="w3-container w3-hide">
                <div class="w3-row w3-section">
                    <label class="w3-text-dark-grey">Deskripsi kost:</label>
                    <textarea rows="10" class="w3-input w3-border" name="intro"/></textarea>
                </div>
                <div class="w3-row w3-section">
                        <label>Panjang kamar:</label>
                        <input class="w3-input w3-border" type="number" name="panjang"/>
                </div>
                <div class="w3-row w3-section">
                        <label>Lebar kamar:</label>
                        <input class="w3-input w3-border" type="number" name="lebar"/>
                </div>
                <div class="w3-third">
                    <label>Pembayaran air:</label>
                    <div class="w3-row w3-section">
                        <input type="radio" name="air" value="Bayar masing-masing" class="w3-radio"/>
                        <label>Bayar sendiri</label>
                    </div>
                    <div class="w3-row w3-section">
                        <input type="radio" name="air" value="Termasuk biaya kost" class="w3-radio"/>
                        <label>Termasuk biaya kost</label>
                    </div>
                </div>

                <!-- tagihan -->
                <div class="w3-third">
                    <label>Pembayaran listrik:</label>
                    <div class="w3-row w3-section">
                        <input type="radio" name="listrik" value="Bayar masing-masing" class="w3-radio"/>
                        <label>Bayar sendiri</label>
                    </div>
                    <div class="w3-row w3-section">
                        <input type="radio" name="listrik" value="Termasuk biaya kost" class="w3-radio"/>
                        <label>Termasuk biaya kost</label>
                    </div>
                </div>
                <div class="w3-third">
                    <label>Pembayaran internet:</label>
                    <div class="w3-row w3-section">
                        <input type="radio" name="internet" value="Bayar masing-masing" class="w3-radio"/>
                        <label>Bayar sendiri</label>
                    </div>
                    <div class="w3-row w3-section">
                        <input type="radio" name="internet" value="Termasuk biaya kost" class="w3-radio"/>
                        <label>Termasuk biaya kost</label>
                    </div>
                </div>

                <!-- jam malam -->
                <label>Jam malam:</label>
                <div class="w3-row">
                    <div class="w3-col m2">
                        <div class="w3-row w3-section">
                            <input type="radio" name="malam" value="20:00" class="w3-radio"/>
                            <label>20:00 WIB</label>
                        </div>
                    </div>
                    <div class="w3-col m2">
                        <div class="w3-row w3-section">
                            <input type="radio" name="malam" value="21:00" class="w3-radio"/>
                            <label>21:00 WIB</label>
                        </div>
                    </div>
                    <div class="w3-col m2">
                        <div class="w3-row w3-section">
                            <input type="radio" name="malam" value="22:00" class="w3-radio"/>
                            <label>22:00 WIB</label>
                        </div>
                    </div>
                    <div class="w3-col m2">
                        <div class="w3-row w3-section">
                            <input type="radio" name="malam" value="23:00" class="w3-radio"/>
                            <label>23:00 WIB</label>
                        </div>
                    </div>
                    <div class="w3-col m2">
                        <div class="w3-row w3-section">
                            <input type="radio" name="malam" value="00:00" class="w3-radio"/>
                            <label>00:00 WIB</label>
                        </div>
                    </div>
                    <div class="w3-col m2">
                        <div class="w3-row w3-section">
                            <input type="radio" name="malam" value="01:00" class="w3-radio"/>
                            <label>01:00 WIB</label>
                        </div>
                    </div>
                </div>
                <div class="w3-row w3-section">
                    <label class="w3-text-dark-grey">Peraturan tambahan:</label>
                    <textarea rows="10" class="w3-input w3-border" name="peraturan"/></textarea>
                </div>
            </div>

            <div class="w3-right">
                <input class="w3-button w3-red w3-margin-top" type="reset" value="Kosongkan"/>
                <input class="w3-button w3-green w3-margin-top" type="submit" name="simpan" value="Kirim"/>
            </div>        
        </form>
        <?php
            include "save.php";
        ?>
    </div>
</div><br/>

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
        var dragMe = new google.maps.InfoWindow;

        var posisi = new google.maps.LatLng(-7.962465, 112.618066);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
            center: posisi
        });

        var marker = new google.maps.Marker({
            position: posisi,
            title: 'dragMe',
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