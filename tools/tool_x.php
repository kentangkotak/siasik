<?php include("conn.php"); ?>
<?php
/*---------------update npd---------------
$sql=$conn->query(" select npkls_rinci.nonpdls as nonpdls,npdls_heder.nokontrak as nokontrak 
					from npkls_rinci,npdls_heder 
					where npkls_rinci.nopencairan='00006/II/CAIR-LS/2022' and npkls_rinci.nonpdls=npdls_heder.nonpdls and npdls_heder.nokontrak<>''; ");
while($rs=$sql->fetch_object()){
	//$sqlx=$conn->query("select * from npdls_heder where nonpdls='".$rs->nonpdls."'");
	//while($rsx=$sqlx->fetch_object()){
		//echo $rs->nokontrak."<br/>";
		$conn->query("update serahterima_penerimaanrinci set flag=1,nonpdls='".$rs->nonpdls."' where nokontrak='".$rs->nokontrak."' ");
	//}

/*---------------update npkls---------------*/
$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
$sql=$conn_simrs->query(" select * from rs181 where rs11='00006/II/CAIR-LS/2022';");
while($rs=$sql->fetch_object()){
	//$sqlx=$conn->query("select * from npdls_heder where nonpdls='".$rs->nonpdls."'");
	//while($rsx=$sqlx->fetch_object()){
		//echo $rs->rs4." ".$i++."<br/>";
		$conn_simrs->query("update rs81 set rs19='1' where rs1='".$rs->rs4."' ");
	//}
}

?>
<?php include("close.php"); ?>