<?php include("../../../conn.php"); ?>
<?php
$sqlcek=$conn->query("select * from perubahan where notransawal='".$_GET["notrans"]."' ");
$jmlcek=$sqlcek->num_rows;
if($jmlcek == 0){
	echo "MAAF TIDAK ADA DATA PERUBAHAN YANG BISA DIKUNCI...!!!";
}else{
    $conn->query("update anggaran_pendapatan set kunciperubahan=1 where notrans='".$_GET["notrans"]."'");
    echo "OK";
}
?>
<?php include("../../../close.php"); ?>