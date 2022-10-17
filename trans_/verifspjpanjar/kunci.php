<?php include("../../conn.php"); ?>
<?php
if($_SESSION["anggaran_level"] <> 'VERIFIKATOR KEUANGAN' && $_SESSION["anggaran_level"] <> 'SUPER'){
	echo "MAAF ANDA TIDAK BERHAK MEMVERIF";
}else{
    $conn->query("update spjpanjar_heder set verif=1,tglverif='".date('Y-m-d H:i:s')."',userverif='".$_SESSION["anggaran_kodeuser"]."' where nospjpanjar='".$_GET["nospjpanjar"]."' ");
    echo "OK";
}
?>
<?php include("../../close.php"); ?>