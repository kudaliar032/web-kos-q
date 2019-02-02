<!-- Header -->
<header class="w3-container">
    <h2><b><i class="fa fa-wrench"></i>&nbsp;&nbsp;MANAJEMEN KOST</b></h2>
</header>
<?php
    $batas=9; //jumlah data yang ditampilkan
    //$jumlahrecord=25;

    $jumlahrecord = mysql_query("SELECT COUNT(*) as jumlah FROM dataKost"); //menghitung jumlah record
    $jumlahrecord = mysql_fetch_array($jumlahrecord);
    $jumlahhalaman = ceil($jumlahrecord['jumlah']/$batas); //mendapatkan jumlah halaman

    //mendapatkan halaman aktif menggunakan getallheaders()
    if(!isset($_GET['hal'])){
        $hal=1;
    }else{
        $hal=$_GET['hal'];
    }

    $awal = ($hal - 1) * $batas; 
    //mendapatkan nilai awal paging, misalnya awalnya 0 dimulai dari index ke 0 (row pertama)

    //data yang tampil
    $sqlAmbil = mysql_query("   SELECT * FROM dataKost dk
                                INNER JOIN fotoKost fk ON dk.id = fk.id LIMIT $awal, 9");
?>

<div class="w3-container">
    <ul class="w3-ul">
        <?php while ($xyz = mysql_fetch_array($sqlAmbil)) { $id = $xyz['id']; ?>
        <li class="w3-bar w3-border-bottom">
            <span onclick="window.open('remove.php?id=<?=$xyz['id']?>', '_SELF')" class="w3-bar-item w3-button w3-red w3-xlarge w3-right">
                <i class="fa fa-ban" aria-hidden="true"></i>
            </span>
            <span onclick="window.open('?page=edit&id=<?=$xyz['id']?>', '_SELF')" class="w3-margin-right w3-bar-item w3-button w3-green w3-xlarge w3-right">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </span>            
            <span onclick="window.open('?page=foto&id=<?=$id?>', '_SELF')" class="w3-margin-right w3-bar-item w3-button w3-blue w3-xlarge w3-right">
                <i class="fa fa-image" aria-hidden="true"></i>
            </span>
            <img src="../<?=$xyz['fotoKT']?>" class="w3-bar-item w3-circle w3-hide-small" style="width:85px;">
            <div class="w3-bar-item">
                <span class="w3-large"><?=$xyz['nama']?></span><br>
                <span>Rp. <?=number_format($xyz['harga'], 0, '.', '.')?>,-/bulan</span>
            </div>
        </li>
        <?php } ?>
    </ul>
    <!-- membuat tombol next dkk -->
    <div class="w3-container w3-margin-top">
        <div class="w3-bar">
            <div class="w3-right">
                <?php
                    //membuat link halaman
                    //tombol prev
                    $prev=$hal-1;
                    if($prev+1==1){
                        echo "<div class='w3-bar-item w3-button w3-light-grey w3-hover-light-grey'>&laquo;</div>";
                        echo "<div class='w3-bar-item w3-button w3-light-grey w3-hover-light-grey'>&lsaquo;</div>";
                    }else{
                        echo "<a href='?page=daftar&hal=1' class='w3-bar-item w3-button'>&laquo;</a> ";
                        echo "<a href='?page=daftar&hal=$prev' class='w3-bar-item w3-button'>&lsaquo;</a> ";
                    }

                    //membuat halaman dengan numeric
                    for($i=1;$i<=$jumlahhalaman;$i++){
                        if($i==$hal)
                            echo "<div class='w3-bar-item w3-button w3-teal'>$i</div>"; //pada saat dihalaman itu, misalnya dihalaman 4 ya brarti 4 tidak aktif
                        else
                            echo "<a href='?page=daftar&hal=$i' class='w3-bar-item w3-button'>$i</a> "; //tidak aktif (tidak pada halaman itu sendiri)
                    }

                    //tombol next
                    $next=$hal+1;
                    if($next-1==$jumlahhalaman){
                        echo "<div class='w3-bar-item w3-button w3-light-grey w3-hover-light-grey'>&rsaquo;</div>";
                        echo "<div class='w3-bar-item w3-button w3-light-grey w3-hover-light-grey'>&raquo;</div>";
                    }else{
                        echo "<a href='?page=daftar&hal=$next' class='w3-bar-item w3-button'>&rsaquo;</a> ";
                        echo "<a href='?page=daftar&hal=$jumlahhalaman' class='w3-bar-item w3-button'>&raquo;</a>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>