<?php include("../../conn.php"); ?>
<?php
$sqlcek=$conn->query("select * from perubahanrincianbelanja where idpp='".trim($_GET['id'])."' and kunciperubahan1='1'");
$jml=$sqlcek->num_rows;
if($jml == 0){
	echo "MAAF USULAN INI TIDAK PERNAH MELAKUKAN PERUBAHAN...!!!";
}else{
    $conn->query("update penyesesuaianperioritas_rinci set kunciperubahan1=1 where id='".$_GET["id"]."'");
	//$conn->query("update perubahanrincianbelanja set statusperubahan=1 where idpp='".$_GET["id"]."'");
    echo "OK";
}
?>
<?php include("../../close.php"); ?>