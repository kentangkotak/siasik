<?php include("../../../conn.php"); ?>
<?php
$sqlcekx=$conn->query("select * from perubahanpagu_pak where notransawal='".trim($_GET['notrans'])."' ");
$jmlcekx=$sqlcekx->num_rows;
if($jmlcekx > 0){
    $conn->query("update penetapan_pagu set kunciperubahan_pak=1 where notrans='".$_GET["notrans"]."'");
    echo "OK";
}else{
	echo "MAAF TIDAK ADA PERUBAHAN YANG BISA DIKUNCI....!!!";
}
?>
<?php include("../../../close.php"); ?>