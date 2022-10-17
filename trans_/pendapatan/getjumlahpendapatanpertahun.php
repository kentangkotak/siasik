<?php include "../../conn.php";?>
<br/> <center>
<?php
$x=0;
$tahun = date('Y');
$sql = $conn->query("select sum(nilai) as jml from anggaran_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."'");

while($rs=$sql->fetch_object()){
$x=$x+1;
?>
		<span style="font-weight:bold;font-size:40px;color:red;"> &nbsp;<?php echo rp($rs->jml);?>&nbsp;</span>
<?php }?></center>
<?php include "../../close.php";?>