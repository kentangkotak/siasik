<?php include("../../../conn.php"); ?>
<?php
$nominal = str_replace(',', '', $_GET['nilairupiah']);
// $sqlx=$conn->query("select * from anggaran_pendapatan where uraian_rekening='".trim($_GET['uraian'])."' and tahun='".$_SESSION["anggaran_tahun"]."'");
// $jmlx=$sqlx->num_rows;
// if($jmlx > 0){
// echo "MAAF PENDAPATAN YANG ANDA INPUT SUDAH PERNAH DI INPUT...!!!";
// }else{
if ($_GET['notrans'] == '') {
	$sql = $conn->query("call anggaranpendapatan(@nomor);");
	$sql = $conn->query("select @nomor as nomor;");
	$jml = $sql->num_rows;
	if ($jml > 0) {
		$rs = $sql->fetch_object();
		$counter = $rs->nomor + 1;
	}
	$kode = gennotran($counter, "AP-PAK");

	$conn->query("insert into anggaran_pendapatan_pak(notrans,bidang,koderekeningblud,uraian_rekening,nilai,tahun,tgl_entry,user_entry,map79,kode79,uraian79) values(
			'" . $kode . "','" . trim($_GET['bidang']) . "','" . trim($_GET['koderekeningblud']) . "','" . trim($_GET['uraian']) . "','" . $nominal . "',
			'" . $_SESSION["anggaran_tahun"] . "','" . date('Y-m-d H:i:s') . "','" . $_SESSION['anggaran_username'] . "','" . trim($_GET['map79']) . "',
			'" . trim($_GET['kode79']) . "','" . trim($_GET['uraian79']) . "')");

	// $conn->query("insert into t_tampung_pendapatan(notrans,pagu,tahun,koderekeningblud) values(
	// '".$kode."','".$nominal."',
	// '".$_SESSION["anggaran_tahun"]."','".trim($_GET['koderekeningblud'])."')");
	echo "OK|" . $kode;
} else {
	$kode = $_GET['notrans'];
	$conn->query("update anggaran_pendapatan_pak set nilai='" . $nominal . "' where notrans='" . $kode . "'");

	echo "OK|" . $kode;
}
//}

?>
<?php include("../../../close.php"); ?>