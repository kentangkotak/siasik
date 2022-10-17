<?php include("../../../conn.php"); ?>
<?php include("../../../loging.php"); ?>
<?php
$sql=$conn->query("select * from usulanHonor_r_pak where notrans='".$_GET["notrans"]."'");
$jml=$sql->num_rows;

if($jml > 0){
	echo "MAAF TRANSAKSI INI TIDAK BISA DIHAPUS KARENA MASIH ADA TRANSAKSI DIDALAMNYA....!!!";
}else{
	loging([
		"table"=>"usulanHonor_h_pak",
		"col"=>"notrans",
		"val"=>$_GET['notrans']
	]);
    
    $conn->query("delete from usulanHonor_h_pak where notrans='".$_GET["notrans"]."'");
	echo "OK";
}
    
?>
<?php include("../../../close.php"); ?>