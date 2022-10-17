<?php include("../../conn.php"); ?>
<?php include("../../loging.php"); ?>
<?php
$sql=$conn->query("select * from serahterima_heder where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."' and kunci=1");
$jml=$sql->num_rows;

if($jml > 0){
	echo "MAAF TRANSAKSI INI SUDAH TERKUNCI...!!!";
}else{
	if($_GET['kodeblud'] == 20){
		$sqlcek=$conn->query("select * from serahterima_penerimaanrinci where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."' ");
		$jmlcek=$sqlcek->num_rows;
		if($jmlcek > 0){
			echo "JIKA ANDA INGIN MENGHAPUS DATA INI HAPUS DULU RINCIAN DATA PENERIMAAN GUDANG..!!!";
		}else{
			loging([
			"table"=>"serahterima50",
			"col"=>"id",
			"val"=>$_GET['id']
			]);
			
			$conn->query("delete from serahterima50 where id='".$_GET['id']."'");
			echo "OK|".$_GET['noserahterimapekerjaan'];
		}
	}else{
		loging([
		"table"=>"serahterima50",
		"col"=>"id",
		"val"=>$_GET['id']
		]);
		
		$conn->query("delete from serahterima50 where id='".$_GET['id']."'");
		echo "OK|".$_GET['noserahterimapekerjaan'];
	}
	
}
	
	
?>
<?php include("../../close.php"); ?>