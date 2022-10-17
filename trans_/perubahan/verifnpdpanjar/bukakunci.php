<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npkpanjar_rinci where nonpd='".$_GET["nonpdpanjar"]."'");
	$jml=$sql->num_rows;
	if($jml > 0){
		echo "MAAF NO NPD PANJAR INI TIDAK BISA DIBATAL VERIF....!!!";
	}else{
		$conn->query("update npdpanjar_heder set verif='',userverif='".$_SESSION["anggaran_kodeuser"]."',tglverif='".date('Y-m-d H:i:s')."' where nonpdpanjar='".$_GET["nonpdpanjar"]."'");
		echo "OK";
	}
    
?>
<?php include("../../close.php"); ?>