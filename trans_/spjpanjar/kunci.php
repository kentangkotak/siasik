<?php include("../../conn.php"); ?>
<?php
    $conn->query("update spjpanjar_heder set kunci=1,tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' 
	where nospjpanjar='".$_GET["nospjpanjar"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>