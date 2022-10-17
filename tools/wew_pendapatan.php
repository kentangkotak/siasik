<?php include "conn.php";?>
<?php
$sql=$conn->query("select * from anggaran_pendapatan where tahun='".$_GET['thn']."'");
while($rs=$sql->fetch_object()){
	$sqlcek=$conn->query("select * from t_tampung_pendapatan where notrans='".$rs->notrans."'");
	$jml=$sqlcek->num_rows;
	if($jml > 0){
		$conn->query("update t_tampung_pendapatan set saldo='".$rs->nilai."' where notrans='".$rs->notrans."'");
		echo "OK";
	}else{
		$conn->query("insert into t_tampung_pendapatan(notrans,saldo,tahun) values('".$rs->notrans."','".$rs->nilai."','".$_GET['thn']."'); ");
		echo "OK";
	}
}

?>
<?php include "close.php";?>