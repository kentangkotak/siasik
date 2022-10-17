<?php include("../conn.php"); ?>
<?php
$sql=$conn->query("select * from penyesesuaianperioritas_rinci");
while($rs=$sql->fetch_object()){
	//echo $rs->uraian50;
	//$conn->query("update t_tampung set uraian50='".$rs->uraian50."' where koderek50='".$rs->koderek50."'");
	//$conn->query("update npdpanjar_rinci set koderek108='".$rs->koderek108."' where idpp='".$rs->id."'");
	
	$conn->query("update spjpanjar_rinci set koderek108='".$rs->koderek108."' where iditembelanjanpd='".$rs->id."'");
}
?>
<?php include("../close.php"); ?>