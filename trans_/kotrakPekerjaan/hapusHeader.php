<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
//$sql=$conn->query("select * from kontrakPengerjaan_rinci where nokontrak='".$_GET["nokontrak"]."'");
//$jml=$sql->num_rows;

//if($jml > 0){
//	echo "MAAF TRANSAKSI INI TIDAK BISA DIHAPUS KARENA MASIH ADA TRANSAKSI DI DALAM NYA....!!!";
//}else{
	loging([
		"table"=>"kontrakPengerjaan_header",
		"col"=>"nokontrak",
		"val"=>$_GET['nokontrak']
	]);
   
    $conn->query("delete from kontrakPengerjaan_header where nokontrak='".$_GET["nokontrak"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>