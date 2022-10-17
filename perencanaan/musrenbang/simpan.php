<?php include("../../conn.php"); ?>
<?php
$tanggal=in_tanggal("/",trim($_GET['tglperencanaan']));

$sql_cek=$conn->query("select * from rs31 where rs1='".$_GET['noverif']."' and rs2='".trim($_GET['nousulan'])."' and rs3='".trim($_GET['koderuangan'])."' and rs4='".trim($_GET['tahun'])."' and rs5='".trim($_GET['kodeusulan'])."' ");
$cari=$sql_cek->num_rows;
if($cari>0){
	echo "Usulan Pelatihan ini Sudah Direncanakan...!!!";
}else{
	$conn->query("insert into rs31(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12) values('".$_GET['noverif']."','".trim($_GET['nousulan'])."',
	'".trim($_GET['koderuangan'])."','".trim($_GET['tahun'])."','".trim($_GET['kodeusulan'])."','".trim($_GET['jumlah'])."','".trim($_GET['keterangan'])."',
	'".trim($_GET['cito'])."','".$tanggal."','".trim($_GET['keteranganx'])."','".$_SESSION["silat_kodeuser"]."','".date('Y-m-d H:i:s')."')");
	echo "OK|";
}		
	
?>
<?php include("../../close.php"); ?>