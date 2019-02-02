<?php
    $ghfkj = mysql_fetch_array(mysql_query("SELECT * FROM statistikWeb"));
    $fgjdkl = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS jmlKost FROM dataKost"));
    $dgdfg = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS jmlUser FROM userBiasa"));
    $fgdfb = mysql_fetch_array(mysql_query("SELECT COUNT(*) AS jmlReview FROM reviewKost"));
?>
<!-- Header -->
<header class="w3-container">
    <b><h2><i class="fa fa-dashboard"></i><b>&nbsp;&nbsp;DASBOARD UTAMA</b></h2></b>
</header>

<?php
    include "tambahFoto.php";
?>

<div class="w3-container">
    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-quarter">
            <div class="w3-container w3-red w3-padding-16">
            <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?=$ghfkj['visitor']?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Pengunjung</h4>
            </div>
        </div>
        <div class="w3-quarter">
            <div class="w3-container w3-blue w3-padding-16">
            <div class="w3-left"><i class="fa fa-home w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?=$fgjdkl['jmlKost']?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Kost</h4>
            </div>
        </div>
        <div class="w3-quarter">
            <div class="w3-container w3-teal w3-padding-16">
            <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?=$dgdfg['jmlUser']?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Jumlah user</h4>
            </div>
        </div>
        <div class="w3-quarter">
            <div class="w3-container w3-orange w3-text-white w3-padding-16">
            <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
            <div class="w3-right">
                <h3><?=$fgdfb['jmlReview']?></h3>
            </div>
            <div class="w3-clear"></div>
            <h4>Jumlah review</h4>
            </div>
        </div>
    </div>
</div>


<div class="w3-container">
    <div class="w3-row">
        <h5><b>Review Terbaru</b></h5>
        <table class="w3-table w3-striped w3-white">
            <?php
                $ghg = mysql_query("SELECT * FROM reviewKost rk INNER JOIN userBiasa ub ON rk.idUser = ub.id INNER JOIN dataKost dk ON rk.idKost = dk.id ORDER BY rk.idKomentar DESC LIMIT 0,5");
                while($dfssd = mysql_fetch_array($ghg)) {
            ?>
            <tr class="w3-hover-blue" onclick="location.href='../tampil.php?id=<?=$dfssd['id']?>'">
                <td style="width: 10px;"><i class="fa fa-commenting w3-large" aria-hidden="true"></i></td>
                <td><b><?=$dfssd['depan']?>&nbsp;<?=$dfssd['belakang']?></b></td>
                <td><?=$dfssd['review']?></td>
                <td class="w3-right"><i><?=$dfssd['nama']?></i></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>

<hr/>

<div class="w3-container">
    <div class="w3-row">
        <h5><b>Kost terbaru</b></h5>
        <table class="w3-table w3-striped w3-white">
            <?php
                $ghg = mysql_query("SELECT * FROM dataKost ORDER BY id DESC LIMIT 0,5");
                while($dfssd = mysql_fetch_array($ghg)) {
            ?>
            <tr onclick="location.href='../tampil.php?id=<?=$dfssd['id']?>'" class="w3-hover-red">
                <td style="width: 10px;"><i class="fa fa-home w3-large"></i></td>
                <td><?=$dfssd['nama']?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>

<hr/>

<div class="w3-container">
    <div class="w3-row">
        <h5><b>User belum terverifikasi</b></h5>
        <table class="w3-table w3-striped w3-white">
            <?php
                $ghg = mysql_query("SELECT * FROM userBiasa WHERE status = 0 ORDER BY id DESC LIMIT 0,5");
                while($dfssd = mysql_fetch_array($ghg)) {
            ?>
            <tr class="w3-hover-yellow" >
                <td style="width: 10px; vertical-align: middle;"><i class="fa fa-user w3-large"></i></td>
                <td style="vertical-align: middle;"><?=$dfssd['userBiasa']?></td>
                <td style="vertical-align: middle;"><i><?=$dfssd['namaKost']?></i></td>
                <td class="w3-right">
                    <?php
                        if($dfssd['status'] == 0) { 
                    ?>
                            <button onclick="location.href='adminVer.php?id=<?=$dfssd['id']?>'" class="w3-button w3-green">VERIFIKASI</button>
                    <?
                        }
                    ?>
                    <button onclick="location.href='adminHapus.php?id=<?=$dfssd['id']?>'" class="w3-button w3-red">TOLAK</button>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>