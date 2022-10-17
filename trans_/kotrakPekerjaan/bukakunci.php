<?php include("../../conn.php"); ?>
<?php
$sqlcek=$conn->query("select * from serahterima_heder where nokontrak='".$_GET["nokontrak"]."'");
$jmlcek=$sqlcek->num_rows;
if($jmlcek > 0){
	echo "MAAF TRANSAKSI INI SUDAH DISERAH TERIMAHKAN...., JADI ANDA TIDAK BISA MEMBUKA KUNCI....!!!";
}else{
    $conn->query("update kontrakPengerjaan_header set kunci='' where nokontrak='".$_GET["nokontrak"]."'");
    echo "OK";
}
?>
<?php include("../../close.php"); ?>