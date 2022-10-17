<?php include("../../conn.php"); ?>
<?php
$pph21= str_replace(',','',$_GET['pph21']);
$pph22= str_replace(',','',$_GET['pph22']);
$pph23= str_replace(',','',$_GET['pph23']);
$pph25= str_replace(',','',$_GET['pph25']);
$pasal4= str_replace(',','',$_GET['pasal4']);
$ppnpusat= str_replace(',','',$_GET['ppnpusat']);
$utangpajakdaerah= str_replace(',','',$_GET['utangpajakdaerah']);
		
		$conn->query("delete from npdls_pajak where nonpdls='".$_GET['nonpd']."' ");
		$conn->query("insert into npdls_pajak(nonpdls,koderekening,pph21,pph22,pph23,pph25,pasal4,ppnpusat,pajakdaerah,userentry,tglentry) 
				values('".$_GET['nonpd']."','".$_GET['koderekening']."','".trim($pph21)."','".trim($pph22)."','".trim($pph23)."','".trim($pph25)."',
				'".trim($pasal4)."','".trim($ppnpusat)."','".trim($utangpajakdaerah)."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
				
		echo "OK|".$_GET['nonpd'];
	
				
	

?>
<?php include("../../close.php"); ?>