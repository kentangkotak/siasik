<?php include("../conn.php"); ?>
<?php
$sql=$conn->query("select * from penyesesuaianperioritas_rinci");
while($rs=$sql->fetch_object()){
	//echo $rs->uraian50;
	//$conn->query("update t_tampung set uraian50='".$rs->uraian50."' where koderek50='".$rs->koderek50."'");
	$conn->query("update t_tampung set uraian108='".$rs->uraian108."' where koderek108='".$rs->koderek108."'");	
}
?>
<?php include("../close.php"); ?>