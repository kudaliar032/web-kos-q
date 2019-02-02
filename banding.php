<?php
    $title = "PERBANDINGAN";
    $aktifBanding = "w3-theme";
    include "atas.php";
    include "config.php";

    if(isset($_GET['data1']) && isset($_GET['data2'])) {
        $anu1 = mysql_query("SELECT * FROM dataKost WHERE nama = '$_GET[data1]'");
        $xx1 = mysql_fetch_array($anu1);

        $anu2 = mysql_query("SELECT * FROM dataKost WHERE nama = '$_GET[data2]'");
        $xx2 = mysql_fetch_array($anu2);

        $data1 = $xx1['id'];
        $data2 = $xx2['id'];

        if($data1 == $data2) {
            echo "  <script>
                        alert('Kost yang dimasukan sama!');
                        window.location = window.location.pathname;
                    </script>";
        }

        $sql1 = "SELECT * FROM dataKost dk INNER JOIN kapasitasKost kk ON dk.id = kk.id_kost 
                            INNER JOIN fotoKost fk ON dk.id = fk.id 
                            INNER JOIN kontakKost ko ON dk.id = ko.id 
                            INNER JOIN ratingKost rk ON dk.id = rk.id
                            INNER JOIN spesifikasiKost sk ON dk.id = sk.id
                            WHERE dk.id=$data1";
        $sql2 = "SELECT * FROM dataKost dk INNER JOIN kapasitasKost kk ON dk.id = kk.id_kost 
                            INNER JOIN fotoKost fk ON dk.id = fk.id 
                            INNER JOIN kontakKost ko ON dk.id = ko.id 
                            INNER JOIN ratingKost rk ON dk.id = rk.id
                            INNER JOIN spesifikasiKost sk ON dk.id = sk.id
                            WHERE dk.id=$data2";
        
        $jalan1 = mysql_query($sql1);
        $jalan2 = mysql_query($sql2);

        $j = mysql_fetch_array($jalan1);
        $k = mysql_fetch_array($jalan2);

        $nama1 = $j['nama'];                $nama2 = $k['nama'];
        $kebersihan1 = $j['kebersihan'];    $kebersihan2 = $k['kebersihan'];
        $keamanan1 = $j['keamanan'];        $keamanan2 = $k['keamanan'];
        $kenyamanan1 = $j['kenyamanan'];    $kenyamanan2 = $k['kenyamanan'];
        $air1 = $j['air'];                  $air2 = $k['air'];
        $listrik1 = $j['listrik'];          $listrik2 = $k['listrik'];
        $internet1 = $j['internet'];        $internet2 = $k['internet'];
        $panjang1 = $j['panjangKamar'];     $panjang2 = $k['panjangKamar'];
        $lebar1 = $j['lebarKamar'];         $lebar2 = $k['lebarKamar'];
        $harga1 = $j['harga'];              $harga2 = $k['harga'];

        $nilai_kost1 = 0;
        $nilai_kost2 = 0;
        
        // nilai kebersihan
        if($kebersihan1 > $kebersihan2) {
            $nilai_kost1 += 10;
        } elseif ($kebersihan1 < $kebersihan2) {
            $nilai_kost2 += 10;
        }

        //nilai keamanan
        if($keamanan1 > $keamanan2) {
            $nilai_kost1 += 8;
        } elseif ($keamanan1 < $keamanan2) {
            $nilai_kost2 += 8;
        }

        // nilai kenyamanan
        if($kenyamanan1 > $kenyamanan2) {
            $nilai_kost1 += 10;
        } elseif ($kenyamanan1 < $kenyamanan2) {
            $nilai_kost2 += 10;
        }

        // nilai pembayaran air
        if($air1 == "Termasuk biaya kost") {
            $nilai_kost1 += 6;
        }
        if($air2 == "Termasuk biaya kost") {
            $nilai_kost2 += 6;
        }

        // nilai pembayaran listrik
        if($listrik1 == "Termasuk biaya kost") {
            $nilai_kost1 += 5;
        }
        if($listrik2 == "Termasuk biaya kost") {
            $nilai_kost2 += 5;
        }
       
        // nilai pembayaran internet
        if($internet1 == "Termasuk biaya kost") {
            $nilai_kost1 += 7;
        }
        if($internet2 == "Termasuk biaya kost") {
            $nilai_kost2 += 7;
        }

        // nilai luas kost
        $luas1 = $panjang1 * $lebar1;
        $luas2 = $panjang2 * $lebar2;
        if($luas1 > $luas2) {
            $nilai_kost1++;
        } elseif($luas1 < $luas2) {
            $nilai_kost2++;
        }

        // nilai jumlah fasilitas kamar
        $sqlFasilitas1 = mysql_query("SELECT COUNT(id) AS jumlah FROM fasilitasKamar WHERE id = $data1");
        $jumlahKamar1 = mysql_fetch_array($sqlFasilitas1);
        $nilai_kost1 += $jumlahKamar1['jumlah'];

        $sqlFasilitas2 = mysql_query("SELECT COUNT(id) AS jumlah FROM fasilitasKamar WHERE id = $data2");
        $jumlahKamar2 = mysql_fetch_array($sqlFasilitas2);
        $nilai_kost2 += $jumlahKamar2['jumlah'];

        // nilai jumlah fasilitas kamar mandi
        $sqlFasilitas1 = mysql_query("SELECT COUNT(id) AS jumlah FROM fasilitasMandi WHERE id = $data1");
        $jumlahKamar1 = mysql_fetch_array($sqlFasilitas1);
        $nilai_kost1 += $jumlahKamar1['jumlah'];

        $sqlFasilitas2 = mysql_query("SELECT COUNT(id) AS jumlah FROM fasilitasMandi WHERE id = $data2");
        $jumlahKamar2 = mysql_fetch_array($sqlFasilitas2);
        $nilai_kost2 += $jumlahKamar2['jumlah'];
        
        // nilai harga bulanan
        if($harga1 < $harga2) {
            $nilai_kost1 += 8;
        } elseif($harga1 > $harga2) {
            $nilai_kost2 += 8;
        }
    }
?>

<div class="w3-bar w3-xlarge w3-margin-bottom">
    &nbsp;
</div>

<div class="w3-row" style="height: 100%; margin-bottom: 0px">
<div class="w3-row-padding w3-center">
    <form class="w3-container w3-center" method="GET">
        <div class="w3-third w3-left">
            <div class="w3-row w3-section">
                <input type="text" class="kostkost w3-input" name="data1" required placeholder="Masukan kost pertama disini"/>
            </div>
        </div>
        <div class="w3-third w3-center">
            <div class="w3-row w3-section">
                <input class="w3-button w3-theme-dark w3-hover-theme" type="submit" value="BANDINGKAN"/>
            </div>
        </div>
        <div class="w3-third w3-right">
            <div class="w3-row w3-section">
                <input type="text" class="kostkost w3-input" name="data2" required placeholder="Masukan kost kedua disini"/>
            </div>
        </div>
    </form>
</div>

<!-- script untuk auto complete formu -->
<script type="text/javascript" src="js/typeahead.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var cars = [
            <?php
                mysql_select_db("kost");
                    $sql = "SELECT * FROM dataKost";
                    $hasil = mysql_query($sql);
                    while($x = mysql_fetch_object($hasil)){
                        ?>
                        '<?=$x->nama;?>',
                    <?
                    }
                    ?>
        ];

        var cars = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: cars
        });

        $('.kostkost').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'cars',
            source: cars
        });
    });  
</script>
<!-- autokomlit selesai -->


<?php
    if(isset($_GET['data1']) && isset($_GET['data2'])) {
?>
<div class="w3-container w3-margin-top w3-margin-bottom" style="padding-top:30px;padding-bottom:30px;">
    <div class="w3-col m2">&nbsp;</div>
    <div class="w3-col m8">
        <div class="w3-bar w3-center">
            <b class="w3-xxlarge">KAMI MEREKOMENDASIKAN MENYEWA KOST DARI
            <?php
                if($nilai_kost1 > $nilai_kost2) {
                    echo "<a href='tampil.php?id=". $data1 ."'>".strtoupper($nama1)."</a>";
                } elseif($nilai_kost1 < $nilai_kost2) {
                    echo "<a href='tampil.php?id=". $data2 ."'>".strtoupper($nama2)."</a>";
                } else {
                    echo "<a href='tampil.php?id=". $data1 ."'>".strtoupper($nama1)."</a>/<a href='tampil.php?id=". $data2 ."'>".strtoupper($nama2)."</a> PILIHLAH YANG TERDEKAT";
                }
            ?>
            !</b>
        </div>
    </div>
    <div class="w3-col m2">&nbsp;</div>
</div>

<div class="w3-container w3-margin-top">
    <div class="w3-col m2 w3-right-align">
        &nbsp;
    </div>
    <div class="w3-col m8">
        <!-- nama kost -->
        <div class="w3-row-padding">
            <div class="w3-half">
                <div onclick="location.href='tampil.php?id=<?=$data1?>'" class="w3-bar w3-theme-d3 w3-hover-theme">
                    <div class="w3-center w3-xlarge w3-margin">
                        <b><?=strtoupper($nama1)?></b>
                    </div>
                </div>
            </div>

            <div class="w3-half">
                <div onclick="location.href='tampil.php?id=<?=$data2?>'" class="w3-bar w3-theme-d3 w3-hover-theme">
                    <div class="w3-center w3-xlarge w3-margin">
                        <b><?=strtoupper($nama2)?></b>
                    </div>
                </div>
            </div>
        </div>

        <?php
            $ksq = mysql_fetch_array(mysql_query("SELECT AVG(kenyamanan) AS kenyamanan, AVG(keamanan) AS keamanan, AVG(kebersihan) AS kebersihan FROM reviewKost WHERE idKost = $data1"));
            $ytg = mysql_fetch_array(mysql_query("SELECT AVG(kenyamanan) AS kenyamanan, AVG(keamanan) AS keamanan, AVG(kebersihan) AS kebersihan FROM reviewKost WHERE idKost = $data2"));
        ?>

        <!-- rating kebersihan -->
        <div class="w3-row-padding">
            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large  w3-margin-top w3-tooltip">
                        <span class="w3-text"><b>KEBERSIHAN&nbsp;</b></span>
                        <?php
                            $bersih = $ksq['kebersihan'];
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

            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large  w3-margin-top w3-tooltip">
                        <span class="w3-text"><b>KEBERSIHAN&nbsp;</b></span>
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
        <!-- rating keamanan -->
        <div class="w3-row-padding">
            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large  w3-margin-top w3-tooltip">
                        <span class="w3-text"><b>KEAMANAN&nbsp;</b></span>
                        <?php
                            $aman = $ksq['keamanan'];
                            for($a=0; $a<$aman; $a++) {
                                echo "<span class='w3-large fa fa-star checked'></span>";
                            }
                            for($a=0; $a<abs($aman-5); $a++) {
                                echo "<span class='w3-large fa fa-star'></span>";
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top w3-tooltip">
                        <span class="w3-text"><b>KEAMANAN&nbsp;</b></span>
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
                </div>
            </div>
        </div>

        <!-- rating kenyamanan -->
        <div class="w3-row-padding">
            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top w3-tooltip">
                        <span class="w3-text"><b>KENYAMANAN&nbsp;</b></span>
                        <?php
                            $nyaman = $ksq['kenyamanan'];
                            for($a=0; $a<$nyaman; $a++) {
                                echo "<span class='w3-large fa fa-star checked'></span>";
                            }
                            for($a=0; $a<abs($nyaman-5); $a++) {
                                echo "<span class='w3-large fa fa-star'></span>";
                            }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large  w3-margin-top w3-tooltip">
                        <span class="w3-text"><b>KENYAMANAN&nbsp;</b></span>
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
                </div>
            </div>
        </div>

        <!-- kondisi air -->
        <div class="w3-row-padding">
            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        AIR 
                        <?php
                            echo strtoupper($air1);
                        ?>
                    </div>
                </div>
            </div>

            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        AIR 
                        <?php
                            echo strtoupper($air2);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- kondisi listrik -->
        <div class="w3-row-padding">
            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        LISTRIK 
                        <?php
                            echo strtoupper($listrik1);
                        ?>
                    </div>
                </div>
            </div>

            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        LISTRIK 
                        <?php
                            echo strtoupper($listrik2);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- kondisi internet -->
        <div class="w3-row-padding">
            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        INTERNET 
                        <?php
                            echo strtoupper($internet1);
                        ?>
                    </div>
                </div>
            </div>

            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        INTERNET 
                        <?php
                            echo strtoupper($internet2);
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- luas kostkostan -->
        <div class="w3-row-padding">
            <div class="w3-half">   
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        <?=$panjang1?> meter x <?=$lebar1?> meter
                    </div>
                </div>
            </div>

            <div class="w3-half">
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        <?=$panjang2?> meter x <?=$lebar2 ?> meter
                    </div>
                </div>
            </div>
        </div>

        <!-- fasilitas kamar tidur -->
        <div class="w3-row-padding">
            <div class="w3-half">   
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top w3-padding">
                        <?php
                            $ex1 = mysql_query("SELECT * FROM fasilitasKamar WHERE id = $data1");
                            while($j = mysql_fetch_array($ex1)) { 
                            $cc = $j['kamarIcon'];        
                        ?>
                                <img src="img/fasilitas/kamar_<?=$cc?>.png" style="height:50px"/>
                        <?php    
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="w3-half">
                <div class="w3-bar w3-white w3-center ">
                    <div class="w3-large w3-margin-top w3-padding">
                        <?php
                            $ex2 = mysql_query("SELECT * FROM fasilitasKamar WHERE id = $data2");
                            while($j = mysql_fetch_array($ex2)) { 
                            $cc = $j['kamarIcon'];        
                        ?>
                                <img src="img/fasilitas/kamar_<?=$cc?>.png" style="height:50px"/>
                        <?php    
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- fasilitas kamar tidur -->
        <div class="w3-row-padding">
            <div class="w3-half">   
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top w3-padding">
                        <?php
                            $ex1 = mysql_query("SELECT * FROM fasilitasMandi WHERE id = $data1");
                            while($j = mysql_fetch_array($ex1)) { 
                            $cc = $j['mandiIcon'];        
                        ?>
                                <img src="img/fasilitas/mandi_<?=$cc?>.png" style="height:50px"/>
                        <?php    
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="w3-half">   
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top w3-padding">
                        <?php
                            $ex2 = mysql_query("SELECT * FROM fasilitasMandi WHERE id = $data2");
                            while($j = mysql_fetch_array($ex2)) { 
                            $cc = $j['mandiIcon'];        
                        ?>
                                <img src="img/fasilitas/mandi_<?=$cc?>.png" style="height:50px"/>
                        <?php    
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>    

        <!-- harganya -->
        <div class="w3-row-padding w3-margin-top w3-margin-bottom">
            <div class="w3-half">   
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        <b class="w3-xlarge">
                            Rp. <?=number_format($harga1,0,",",".")?>,-/bulan
                        </b>
                    </div>
                </div>
            </div>
            <div class="w3-half">   
                <div class="w3-bar w3-white w3-center">
                    <div class="w3-large w3-margin-top">
                        <b class="w3-xlarge">
                            Rp. <?=number_format($harga2,0,",",".")?>,-/bulan
                        </b>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <div class="w3-col m2 w3-left-align">
        &nbsp;
    </div>
</div>
<?php
    }
?>

<?php
    if(!isset($_GET['data1']) && !isset($_GET['data2'])) {
?>
<div class="w3-container w3-center">
    <div class="w3-card w3-bar w3-padding-large w3-margin-top">
        <b class="w3-large">MASUKAN NAMA KOST UNTUK DIBANDINGKAN!!!</b>
    </div>
</div>
<?php
    }
?>

</div>

<?php
    include "bawah.php";
?>

</body>
</html>