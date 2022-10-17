<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npdpanjar_heder where nonpdpanjar='".$_GET["nonpdpanjar"]."' and verif=1");
	$jml=$sql->num_rows;
	if($jml > 0){
		echo "MAAF TRANSAKSI INI SUDAH DI TERVERIF....!!!";
	}else{
		$conn->query("update npdpanjar_heder set kunci='' where nonpdpanjar='".$_GET["nonpdpanjar"]."'");
		echo "OK";
	}
    
?>
<?php include("../../close.php"); ?>