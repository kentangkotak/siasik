<?php include "../../conn.php";?>
<?php
$sql=$conn->query("select * from bebaspajak_heder where nopenerimaan='".$_GET['nopenerimaan']."'");
$jml=$sql->num_rows;
if($jml > 0){
	$sqlx=$conn->query("select * from bebaspajak_heder where nopenerimaan='".$_GET['nopenerimaan']."'");
	$rsx=$sqlx->fetch_object();
	echo "OK|".$rsx->nopenerimaan."|".$rsx->nofaktur."|".$rsx->kodesuplier."|".$rsx->suplier."|".$rsx->tgl_faktur."|".$rsx->tgl_tempo."|".
			   $rsx->diskon."|".rpz($rsx->totalbelumppn)."|".$rsx->ppn."|".rpz($rsx->total);
}else{
	echo "NOT OK|";
}
?>
<?php include "../../close.php";?>