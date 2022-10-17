<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npdls_pajak where nonpdls='".$_GET['nonpdls']."'");
	$rs=$sql->fetch_object();
	$pph21=$rs->pph21;
	$pph22=$rs->pph22;
	$pph23=$rs->pph23;
	$pph25=$rs->pph25;
	$pph14=$rs->pasal4;
	$ppnpusat=$rs->ppnpusat;
	$pajakdaerah=$rs->pajakdaerah;
	$koderekening=$rs->koderekening;
	echo "OK|".rpz($pph21)."|".rpz($pph22)."|".rpz($pph23)."|".rpz($pph25)."|".rpz($pph14)."|".rpz($ppnpusat)."|".rpz($pajakdaerah)."|".rpz($koderekening);
?>
<?php include("../../close.php"); ?>