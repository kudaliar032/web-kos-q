<?php
    $ksq = mysql_query("SELECT AVG(kenyamanan) AS kenyamanan, AVG(keamanan) AS keamanan, AVG(kebersihan) AS kebersihan FROM reviewKost WHERE idKost = $_GET[id]");
    $ytg = mysql_fetch_array($ksq);
?>

<div class="w3-bar w3-large w3-margin-top"><b>Peta lokasi kost:</b></div>
<div>
    <input id="latlng" type="text" value="<?=$z['lat']?>,<?=$z['long']?>" hidden>
</div>
<div id="map" style="height:300px" class="w3-margin-bottom"></div>

<div class="w3-bar w3-large w3-margin-top"><b>Rating kost:</b></div>
<div class="w3-bar w3-padding w3-margin-bottom">
    <div class="w3-large">
        <div class="w3-row-padding w3-center">
            <div class="w3-col l4 m4 s6">
                Kenyamanan<br/>
                <?php
                    $nyaman = $ytg['kenyamanan'];
                    for($a=0; $a<$nyaman; $a++) {
                        echo "<span class='w3-large fa fa-star checked'></span>";
                    }
                    for($a=0; $a<abs($nyaman-5); $a++) {
                        echo "<span class='w3-large fa fa-star'></span>";
                    }
                ?>
            </div>
            <div class="w3-col l4 m4 s6">
                Keamanan<br/>
                <?php
                    $aman = $ytg['keamanan'];
                    for($a=0; $a<$aman; $a++) {
                        echo "<span class='w3-large fa fa-star checked'></span>";
                    }
                    for($a=0; $a<abs($aman-5); $a++) {
                        echo "<span class='w3-large fa fa-star'></span>";
                    }
                ?>
            </div>
            <div class="w3-col l4 m4 s12">
                Kebersihan<br/>
                <?php
                    $bersih = $ytg['kebersihan'];
                    for($a=0; $a<$bersih; $a++) {
                        echo "<span class='w3-large fa fa-star checked'></span>";
                    }
                    for($a=0; $a<abs($bersih-5); $a++) {
                        echo "<span class='w3-large fa fa-star'></span>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- fasilitas kost -->
<div class="w3-bar w3-large w3-margin-top"><b>Fasilitas kamar kost:</b></div>

<div class="w3-row-padding w3-margin-top w3-center">
    <?php
        $sqlsql = mysql_query("SELECT kamarIcon FROM fasilitasKamar WHERE id=$_GET[id]");
        while($b = mysql_fetch_array($sqlsql)) {
            echo "
                <div class='w3-col l4 m4 s4'>
                    <img src='img/fasilitas/kamar_". $b['kamarIcon'] .".png' style='height:50px' class='w3-hover-grayscale'>
                    <div class='w3-container w3-margin-top w3-margin-bottom'>
                        ". convertKamar($b['kamarIcon']) ."
                    </div>
                </div>
            ";
        }
    ?>
</div>

<div class="w3-bar w3-large w3-margin-top"><b>Fasilitas kamar mandi:</b></div>

<div class="w3-row-padding w3-margin-top w3-center">
    <?php
        $sqlsql = mysql_query("SELECT mandiIcon FROM fasilitasMandi WHERE id=$_GET[id]");
        while($b = mysql_fetch_array($sqlsql)) {
            echo "
                <div class='w3-col l4 m4 s4'>
                    <img src='img/fasilitas/mandi_". $b['mandiIcon'] .".png' style='height:50px' class='w3-hover-grayscale'>
                    <div class='w3-margin-top w3-margin-bottom'>
                        ". convertMandi($b['mandiIcon']) ."
                    </div>
                </div>
            ";
        }
    ?>
</div>

<div class="w3-bar w3-large w3-margin-top"><b>Deskripsi kost:</b></div>
<div class="w3-row w3-margin-top w3-margin-bottom">
    <div class="w3-justify">
        <p>
            <?=$z['intro']?>
        </p>
    </div>                    
    <b>Spesifikasi:</b>
    <table class="w3-table w3-bordered">
        <tr>
            <td>Luas kamar</td>
            <td>: <?=$z['panjangKamar']?> meter x <?=$z['lebarKamar']?> meter</td>
        </tr>
        <tr>
            <td>Tagihan air</td>
            <td>: <?=$z['air']?></td>
        </tr>
        <tr>
            <td>Tagihan listrik</td>
            <td>: <?=$z['listrik']?></td>
        </tr>
        <tr>
            <td>Tagihan internet</td>
            <td>: <?=$z['internet']?></td>
        </tr>
        <tr>
            <td>Jam malam</td>
            <td>: Pukul <?=$z['malam']?> WIB</td>
        </tr>
        <tr>
            <td>Peraturan tambahan</td>
            <td>: <?=$z['peraturan']?></td>
        </tr>
    </table>
</div><br/>