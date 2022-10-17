<?php include "conn.php";?>
<?php
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$sql=$conn->query("select * from serahterima_penerimaanrinci where nopencairan<>'' group by nopenerimaan");
	while($rs=$sql->fetch_object()){
			$conn_simrs->query("update rs81 set rs19=1,rs23='".$rs->nopencairan."' where rs1='".$rs->nopenerimaan."'");
		//echo $rs->nopenerimaan."<br/>";
	}
	echo "OK";
?>
<?php include "close.php";?>