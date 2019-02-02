<?php
    include "config.php";
    include "fungsiFasilitas.php";
    $sqlTampil = "SELECT * FROM dataKost dk INNER JOIN kapasitasKost kk ON dk.id = kk.id_kost 
                                            INNER JOIN fotoKost fk ON dk.id = fk.id 
                                            INNER JOIN kontakKost ko ON dk.id = ko.id 
                                            INNER JOIN spesifikasiKost sk ON dk.id = sk.id
                                            WHERE dk.id='$_GET[id]'";
    $data = mysql_query($sqlTampil);
    $z = mysql_fetch_array($data);

    $title = strtoupper($z['nama']);
    include "atas.php";
?>
<div class="w3-bar w3-xlarge w3-margin-bottom">
    &nbsp;
</div>

<div class="w3-hide-small">
    <div id="header360" style="height:400px;width:100%"></div>
</div>
<div class="w3-bar w3-xxlarge w3-padding w3-border">
    <b><?=strtoupper($z['nama'])?></b>
</div>

<?php
    $moh = mysql_query("SELECT COUNT(*) AS jumlahReview FROM reviewKost WHERE idKost = $_GET[id]");
    $jkl = mysql_fetch_array($moh);
?>

<div class="w3-row">
    <div class="w3-col l8 m12 s12">
        <div class="w3-container">

            <div class="w3-hide-large w3-margin-bottom w3-margin-top">
                <?php
                    if($z['kapasitas'] > 0) {
                ?>
                        <div class="w3-bar w3-theme w3-margin-bottom w3-padding">
                            <div class="w3-xlarge w3-center">Tersedia <?=$z['kapasitas']?> Kamar</div>
                        </div> 
                <?php
                    } else {
                ?>
                        <div class="w3-bar w3-flat-pomegranate w3-margin-bottom w3-padding">
                            <div class="w3-xlarge w3-center">Kapasitas penuh</div>
                        </div>         
                <?php
                    }
                ?>
                <div class="w3-padding-small w3-medium w3-border">
                    <div class="w3-center"><b>
                        <div class="w3-padding">
                            Rp. <?=number_format($z['harga'],0,",",".")?>,-/bulan
                        </div>
                        <div class="w3-padding">
                            Rp. <?=number_format((($z['harga']*12)-((2/100)*($z['harga']*12))),0,",",".")?>,-/tahun
                        </div>
                    </b></div>
                </div>
            </div>  
            
            <div class="w3-panel w3-medium w3-border-bottom w3-border-theme">
                <button class="w3-bar-item w3-button tablink w3-theme" onclick="openCity(event,'awal')">Detail kost</button>
                <button class="w3-bar-item w3-button tablink" onclick="openCity(event,'fasilitas')">Review (<?=$jkl['jumlahReview']?>)</button>
            </div>
            <div id="awal" class="tab">
                <?php include "tampilUtama.php"; ?>
            </div>
            <div id="fasilitas" class="tab" style="display:none">
                <?php include "review/tampilReview.php"; ?>
            </div>
        </div>
    </div>

    <!-- konten sebelah kanan -->
    <div class="w3-col l4 m12 s12">
        <div class="w3-container w3-margin-top w3-margin-bottom">
            <div class="w3-hide-small w3-hide-medium w3-margin-bottom">
                <?php
                    if($z['kapasitas'] > 0) {
                ?>
                        <div class="w3-bar w3-theme w3-margin-bottom w3-padding">
                            <div class="w3-xlarge w3-center">Tersedia <?=$z['kapasitas']?> Kamar</div>
                        </div> 
                <?php
                    } else {
                ?>
                        <div class="w3-bar w3-flat-pomegranate w3-margin-bottom w3-padding">
                            <div class="w3-xlarge w3-center">Kapasitas penuh</div>
                        </div>         
                <?php
                    }
                ?>
                <div class="w3-padding-small w3-large w3-border">
                    <div class="w3-center"><b>
                        <div class="w3-padding">
                            Rp. <?=number_format($z['harga'],0,",",".")?>,-/bulan
                        </div>
                        <div class="w3-padding">
                            Rp. <?=number_format((($z['harga']*12)-((2/100)*($z['harga']*12))),0,",",".")?>,-/tahun
                        </div>
                    </b></div>
                </div>
            </div> 
  
            <div class="w3-display-container w3-light-grey
                <?php
                    $ytr = mysql_query("SELECT COUNT(*) AS jumlah FROM fotoFoto WHERE id = $_GET[id]");
                    $hyc = mysql_fetch_array($ytr);
                    if($hyc['jumlah'] == 0) {
                        echo "w3-col l12 m12 s12";
                    } else {
                        echo "w3-col l12 m8 s8";
                    }
                ?>
            ">
                <div style="width:100%;height:300px;overflow:hidden;">
                    <center>
                        <img src="<?=$z['fotoKT']?>" class="w3-margin-bottom" height="300px" alt="photo profile kost"/>
                    </center>
                </div>
                <div class="w3-display-bottomright">
                    <button type="button" class="w3-button w3-theme-dark w3-hover-theme w3-xlarge"  onClick="alert('No telpon: <?=$z['phone']?>')">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                    </button>
                    <button type="button" class="w3-button w3-theme-dark w3-hover-theme w3-xlarge" onClick="location.href='mailto:<?=$z['email']?>'">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="w3-padding w3-hide-small w3-hide-medium">&nbsp;</div>

            <?php
                $sqlpp = mysql_query("SELECT * FROM fotoFoto WHERE id = $_GET[id]");
                $xyz = 0;
                while ($iii = mysql_fetch_array($sqlpp)) { $xyz++; $fgh = "id" . $xyz;
                    if($iii['jenis'] == "360") { ?>
                        <div onclick="document.getElementById('<?=$fgh?>').style.display='block'" class="w3-col l6 m4 s4 w3-hover-opacity w3-display-container">
                            <div style="width:100%;height:150px;overflow:hidden;">
                                <div id="panorama<?=$xyz?>" style="width: 100%; height: 150px;"></div>
                                <script type="text/javascript">
                                    // Create viewer
                                    viewer = pannellum.viewer('panorama<?=$xyz?>', ﻿{
                                        "panorama": "<?=$iii['namaFoto']?>",
                                        "autoLoad": true,
                                        "showControls": false,
                                        "mouseZoom": false
                                    });
                                </script>
                            </div>
                            <div class="w3-display-middle w3-xxlarge w3-padding-small w3-circle w3-opacity">360&deg;</div>
                        </div>
                        
                        <div id="<?=$fgh?>" class="w3-modal w3-black">
                            <span onclick="document.getElementById('<?=$fgh?>').style.display='none'" class="w3-xxlarge w3-button w3-display-topright">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </span>
                            <div class="w3-modal-content w3-round-medium w3-black">
                                <div class="w3-container w3-padding-16">
                                    <iframe width="100%" height="500px" style="border-style:none;" src="htm/pannellum.htm?panorama=http://localhost/kost/<?=$iii['namaFoto']?>&amp;autoLoad=true"></iframe>
                                    <div class="w3-center w3-margin-top w3-large">FOTO <?=strtoupper($z['nama'])?> <?=$xyz?></div>
                                </div>
                            </div>
                        </div>
            <?
                    } else { ?>
                        <div onclick="document.getElementById('<?=$fgh?>').style.display='block'" class="w3-col l6 m4 s4">
                            <div style="width:100%;height:150px;overflow:hidden;">
                                <img style="width: 100%; height: 150px;" class="w3-hover-opacity" src="<?=$iii['namaFoto']?>"/>
                            </div>
                        </div>
                        
                        <div id="<?=$fgh?>" class="w3-modal w3-black">
                            <span onclick="document.getElementById('<?=$fgh?>').style.display='none'" class="w3-xxlarge w3-button w3-display-topright">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </span>
                            <div class="w3-modal-content w3-round-medium w3-black">
                                <div class="w3-container w3-center">
                                    <img height="500px" src="<?=$iii['namaFoto']?>">
                                    <div class="w3-center w3-margin-top w3-large">FOTO KOST <?=$xyz?></div>
                                </div>
                            </div>
                        </div>
            <?
                    }
                }
            ?>
        </div>
    </div>
</div>

<?php
    if(!isset($_GET['page']) || $_GET['page'] == null) {
        //include "tampilUtama.php";
    } elseif($_GET['page'] == 'review') {
        include "tampilReview.php";
    }
?>

<input type="text" name="foto360" id="foto360" value="" hidden/>
<script type="text/javascript">
    var lokasi = document.getElementById('foto360').value;
    // Create viewer
    viewer = pannellum.viewer('header360', ﻿{
        "panorama": "<?=$z['fotoKM']?>",
        "autoLoad": true,
        "showControls": false,
        "mouseZoom": false,
        "autoRotate": 2
    });

    function openCity(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("tab");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none"; 
        }
        
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-theme", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " w3-theme";
    }
</script>

<?php
    include "tampil_map.php";
    include "bawah.php";
?>