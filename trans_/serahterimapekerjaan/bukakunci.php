<?php include("../../conn.php"); ?>
<?php
$sqlcek=$conn->query("select * from npdls_heder where noserahterima='".$_GET["noserahterimapekerjaan"]."'");
$jml=$sqlcek->num_rows;
if($jml > 0){
	echo "MAAF NO SERAH TERIMAH INI SUDAH DI NPD KAN...!!!";
}else{
    $conn->query("update serahterima_heder set kunci='' where noserahterimapekerjaan='".$_GET["noserahterimapekerjaan"]."'");
    echo "OK";
}
?>
<?php include("../../close.php"); ?>