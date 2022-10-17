<?php include "../conn.php";?>
<?php
$sql=$conn->query("select * from npkls_rinci ");
while($rs=$sql->fetch_object()){
	$conn->query("update npdls_heder set nopencairan='".$rs->nopencairan."',nonpk='".$rs->nonpk."' where nonpdls='".$rs->nonpdls."' ");
}
echo "PROSES SELESAI...!!!";
?>
<?php include "../close.php";?>