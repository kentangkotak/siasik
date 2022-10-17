<?php include("../../conn.php"); ?>
<?php
$sql=$conn->query("select * from npkls_heder where nonpk='".$_GET["nonpk"]."'");
$rs=$sql->fetch_object();
$nopencairan=$rs->nopencairan;
if($nopencairan == ''){
	$conn->query("update npkls_heder set kunci='',userkunci='".$_SESSION["anggaran_kodeuser"]."',tglkunci='".date('Y-m-d H:i:s')."' where nonpk='".$_GET["nonpk"]."'");
    echo "OK";
}else{
	echo "MAAF NO NPK INI TIDAK BISA DI BUKA KUNCI KARENA SUDAH MELAKUKAN PENCAIRAN....!!!";
}
    
?>
<?php include("../../close.php"); ?>