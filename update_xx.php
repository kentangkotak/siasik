<?php include "conn.php";?>
<?php
	$sql=$conn->query("select * from npkls_rinci where kodekegiatanblud=45 ");
	while($rs=$sql->fetch_object()){
			$conn->query("update serahterima_penerimaanrinci set nonpkls='".$rs->nonpk."' where nonpdls='".$rs->nonpdls."' ");
		//echo $rs->nonpk." ".$rs->nonpdls."<br/>";
	}
	echo "OK";
?>
<?php include "close.php";?>