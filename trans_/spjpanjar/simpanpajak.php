<?php include("../../conn.php"); ?>
<?php
$pph21= str_replace(',','',$_GET['pph21']);
$pph22= str_replace(',','',$_GET['pph22']);
$pph23= str_replace(',','',$_GET['pph23']);
$pph25= str_replace(',','',$_GET['pph25']);
$pasal4= str_replace(',','',$_GET['pasal4']);
$ppnpusat= str_replace(',','',$_GET['ppnpusat']);
$utangpajakdaerah= str_replace(',','',$_GET['utangpajakdaerah']);
		$sql=$conn->query("select * from spjpanjar_pajak where nospjpanjar='".$_GET['nospjpanjar']."'");
		$jml=$sql->num_rows;		
			if($jml > 0){
				$conn->query("update spjpanjar_pajak set pph21='".$pph21."',pph22='".$pph21."',pph23='".$pph23."',pph25='".$pph25."',
				pasal4='".$pasal4."',ppnpusat='".$pnpusat."',pajakdaerah='".$utangpajakdaerah."',
				userentry='".$_SESSION["anggaran_kodeuser"]."',tglentry='".date('Y-m-d H:i:s')."' where nospjpanjar='".$_GET['nospjpanjar']."' 
				and koderekening='".$_GET['koderekening']."' ");
				
				echo "OK|".$_GET['nospjpanjar'];
			}else{
				$conn->query("insert into spjpanjar_pajak(nospjpanjar,koderekening,pph21,pph22,pph23,pph25,pasal4,ppnpusat,pajakdaerah,userentry,tglentry) 
				values('".$_GET['nospjpanjar']."','".$_GET['koderekening']."','".$pph21."','".$pph22."','".trim($pph23)."','".trim($pph25)."',
				'".trim($pasal4)."','".trim($ppnpusat)."','".trim($utangpajakdaerah)."',
				'".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
				
				echo "OK|".$_GET['nospjpanjar'];
			}
	

?>
<?php include("../../close.php"); ?>