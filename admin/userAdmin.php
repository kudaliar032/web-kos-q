<!-- Header -->
<header class="w3-container">
    <b><h2><i class="fa fa-users"></i><b>&nbsp;&nbsp;MANAJEMEN USER ADMIN</b></h2></b>
</header>

<div class="w3-container w3-margin-bottom">
	<div class="w3-row">
		<button onclick="document.getElementById('formUser').style.display='block'" class="w3-button w3-green">
			<b>TAMBAH USER</b>
		</button>
		

		<div class="w3-modal" id="formUser">
			<div class="w3-modal-content w3-padding-large">
				<div class="w3-bar">
					<div class="w3-jumbo w3-center"><b>TAMBAH ADMIN USER!!!</b></div>
				</div>
      			<div class="w3-container w3-margin-bottom">
			      	<form method="POST">
			      		<div class="w3-row w3-section">
							<input class="w3-input" type="text" placeholder="Username" name="username"/>
						</div>
						<div class="w3-row w3-section">
							<input class="w3-input" type="password" placeholder="Password" name="password"/>
						</div>
						<div class="w3-row-padding">
							<div class="w3-col s6">
								<input onclick="document.getElementById('formUser').style.display='none'" class="w3-input w3-button w3-red" value="BATAL" />
							</div>
							<div class="w3-col s6">
								<input class="w3-input w3-button w3-green" type="submit" name="buatUser"/>
							</div>
						</div>
					</form>	
      			</div>
			</div>
		</div>

		<?php
			if(isset($_POST['buatUser'])) {
				$oop = mysql_query("INSERT INTO userAdmin VALUES('', '$_POST[username]', '$_POST[password]')");

				if(mysql_error() != null) {
					echo "<script>alert('Terjadi kesalahan saat menambahkan data, kemungkinan username sama dengan username lainnya...');</script>";
				}
				unset($_POST);
			}
			echo "<script>reload()</script>";
		?>


	</div>
</div>



<div class="w3-container">
	<ul class="w3-ul">
		<table class="w3-table w3-striped w3-bordered w3-hoverable">
		    <tr>
		      <th>Username</th>
		      <th class="w3-right">Menu</th>
		    </tr>
		<?php
			$bnf = mysql_query("SELECT * FROM userAdmin");
			while($tyu = mysql_fetch_array($bnf)) { ?>

			<tr>
				<td class="w3-large">
					<b><?=$tyu['username']?></b>
				</td>
				<td>
					<span onclick="location.href='hapusUser.php?id=<?=$tyu['idAdmin']?>'" class="w3-hover-light-grey w3-margin-right w3-bar-item w3-button w3-red w3-large w3-right">
	                	<i class="fa fa-ban" aria-hidden="true"></i>
	            	</span>
	            	<span onclick="document.getElementById('ubahPassword<?=$tyu['username']?>').style.display='block'" class="w3-hover-light-grey w3-margin-right w3-bar-item w3-button w3-blue w3-large w3-right">
	                	<i class="fa fa-key" aria-hidden="true"></i>
	            	</span>
	            	<div class="w3-modal" id="ubahPassword<?=$tyu['username']?>">
						<div class="w3-modal-content w3-padding-large">
							<div class="w3-bar">
								<div class="w3-xlarge w3-center"><b>UBAH PASSWORD</b></div>
							</div>
								<div class="w3-container w3-margin-bottom">
						      	<form method="POST">
									<div class="w3-row w3-section">
										<input name="username" type="text" value="<?=$tyu['username']?>" hidden/>
										<input class="w3-input" type="password" placeholder="Password lama" name="oldpass"/>
									</div>				
									<div class="w3-row w3-section">
										<input class="w3-input" type="password" placeholder="Password baru" name="newpass1"/>
									</div>				
									<div class="w3-row w3-section">
										<input class="w3-input" type="password" placeholder="Konfirmasi password baru" name="newpass2"/>
									</div>
									<div class="w3-row-padding">
										<div class="w3-col s6">
											<input onclick="document.getElementById('ubahPassword<?=$tyu['username']?>').style.display='none'" class="w3-input w3-button w3-red" value="BATAL" />
										</div>
										<div class="w3-col s6">
											<input class="w3-input w3-button w3-green" type="submit" name="gantiPassword" value="UBAH PASSWORD" />
										</div>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</td>
			</tr>
	    <?php
	    	}
	    	include "updatePassAdmin.php";
	    	include "hapusUser.php";
	    ?>
	    </table>
    </ul>
</div>