<?php include "../../conn.php";?>
<br/> <center>
<?php
$x=0;
$sql = $conn->query("select sum(npdpanjar_rinci.total) as subtotal from npdpanjar_heder,npdpanjar_rinci 
					where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and npdpanjar_heder.nonpdpanjar='".$_SESSION["nonpdpanjar"]."' group by npdpanjar_heder.nonpdpanjar");

while($rs=$sql->fetch_object()){
$x=$x+1;
?>
		<span style="font-weight:bold;font-size:40px;color:red;"> &nbsp;<?php echo rp($rs->subtotal);?>&nbsp;</span>
<?php }?></center>
<?php include "../../close.php";?>