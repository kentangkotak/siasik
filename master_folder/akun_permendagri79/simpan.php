<?php include("../../conn.php"); ?>
<?php
	if($_GET['kode_induk']==''){
		$kode=explode('.',$_GET['kode']);
	}
	else{
		$kode=explode('.',$_GET['kode_induk'].".".$_GET['kode']);
	}
	$uraian=$_GET['uraian'];
	$kode_count=count($kode);
	if($kode_count==1){
		$sql=$conn->query("select id from akun_permendagri79 where kode1='".$kode[0]."'");
		if($sql->num_rows>0){
			echo"Maaf, akun yang dimasukkan telah tersedia";
		}
		else{
			$conn->query("insert into akun_permendagri79(uraian,kode1)
			values('".$uraian."','".$kode[0]."')");
			echo"OK|";
		}
	}
	elseif($kode_count==2){
		$sql=$conn->query("select id from akun_permendagri79 where 
		kode1='".$kode[0]."' and kode1='".$kode[1]."'");
		if($sql->num_rows>0){
			echo"Maaf, akun yang dimasukkan telah tersedia";
		}
		else{
			$conn->query("insert into akun_permendagri79(uraian,kode1,kode2)
			values('".$uraian."','".$kode[0]."','".$kode[1]."')");
			echo"OK|";
		}		
	}
	elseif($kode_count==3){
		$sql=$conn->query("select id from akun_permendagri79 where 
		kode1='".$kode[0]."' and kode2='".$kode[1]."' and kode3='".$kode[2]."'");
		if($sql->num_rows>0){
			echo"Maaf, akun yang dimasukkan telah tersedia";
		}
		else{
			$conn->query("insert into akun_permendagri79(uraian,kode1,kode2)
			values('".$uraian."','".$kode[0]."','".$kode[1]."')");
			echo"OK|";
		}		
	}
	else{
		echo"error tidak diketahui";
	}
?>
<?php include("../../close.php"); ?>