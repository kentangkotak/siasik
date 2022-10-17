<?php include "conn.php";?>
<?php
$sql=$conn->query("select * from penetapan_pagu where tahun='".$_GET['thn']."'");
while($rs=$sql->fetch_object()){
	$sqlcek=$conn->query("select * from t_tampung_pagu where tahun='".$_GET['thn']."' and kodekegiatanblud='".$rs->kodekegiatan."' ");
	$jml=$sqlcek->num_rows;
	if($jml > 0){
		$conn->query("update t_tampung_pagu set pagu='".$rs->total."' where kodekegiatanblud='".$rs->kodekegiatan."'");
	}else{
		$conn->query("insert into t_tampung_pagu(kodekegiatanblud,pagu,tahun) values('".$rs->kodekegiatan."','".$rs->total."','".$_GET['thn']."'); ");
	}
}
echo "PROSES SELESAI...!!!";
?>
<?php include "close.php";?>