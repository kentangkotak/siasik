<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npkls_rinci where nonpdls='".$_GET["nonpdls"]."'");
	$jml=$sql->num_rows;
	if($jml > 0){
		$rs=$sql->fetch_object();
		echo "MAAF NO NPD PANJAR INI TIDAK BISA DIBATAL VERIF KARENA SUDAH DI NPK KAN DENGAN NO ".$rs->nonpk." ....!!!";
	}else{
		$conn->query("update npdls_heder set verif='',userverif='".$_SESSION["anggaran_kodeuser"]."',tglverif='".date('Y-m-d H:i:s')."' where nonpdls='".$_GET["nonpdls"]."'");
		echo "OK";
	}
    
?>
<?php include("../../close.php"); ?>