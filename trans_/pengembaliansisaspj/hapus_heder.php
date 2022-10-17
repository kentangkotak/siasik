<?php include_once("../../conn.php"); ?>
<?php include_once("../../loging.php"); ?>
<?php
$sqlcek=$conn->query("select sppgu_heder.*,sppgu_rinci.* from sppgu_heder,sppgu_rinci where sppgu_rinci.nospj='".$_GET['nospjpanjar']."' group by sppgu_heder.nosppgu");
$jmlcek=$sqlcek->num_rows;
if($jmlcek > 0){
	echo "MAAF TRANSAKSI INI SUDAH SPP GU KAN, JADI ANDA TIDAK BISA MENGHAPUS....!!!";
}else{

		loging([
			"table"=>"pengembaliansisapanjar_heder",
			"col"=>"nopengembaliansisapanjar",
			"val"=>$_GET['nopengembaliansisapanjar']
		]);
		
		$conn->query("update pengembaliansisapanjar_heder set flag='',tglflag='".date('Y-m-d H:i:s')."',userflag='".$_SESSION["anggaran_kodeuser"]."' 
				where nospjpanjar='".trim($_GET['nospjpanjar'])."' ");			
		$conn->query("delete from pengembaliansisapanjar_heder where nopengembaliansisapanjar='".$_GET['nopengembaliansisapanjar']."'");
		echo "OK";
}
	
?>
<?php include_once("../../close.php"); ?>