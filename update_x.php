<?php include "conn.php";?>
<?php
	$sql=$conn->query("select * from npkls_rinci where nopencairan='00004/I/CAIR-LS/2022' ");
	while($rs=$sql->fetch_object()){
		$sqlx=$conn->query("select * from npdls_heder where nonpdls='".$rs->nonpdls."' ");
		while($rsx=$sqlx->fetch_object()){
			$conn->query("update serahterima_penerimaanrinci set flag='1',nonpdls='".$rs->nonpdls."' where nokontrak='".$rsx->nokontrak."' ");
			//echo $rsx->nokontrak;
		}		
	}
	echo "OK";
?>
<?php include "close.php";?>