<?php include("../../conn.php"); ?>
<?php
	$nominal= str_replace('.','',$_GET['nilairupiah']);
	if($_GET['notrans']==''){
		$sql=$conn->query("call anggaranpendapatan(@nomor);");
		$sql=$conn->query("select @nomor as nomor;");
		$jml=$sql->num_rows;
		if($jml>0){ 
			$rs=$sql->fetch_object();
			$counter=$rs->nomor+1;
		}		
		$kode=gennotran($counter,"AP");
		
		$conn->query("insert into anggaran_pendapatan(notrans,bidang,koderekeningblud,uraian_rekening,nilai,tahun,tgl_entry,user_entry,map79) values(
		'".$kode."','".trim($_GET['bidang'])."','".trim($_GET['koderekeningblud'])."','".trim($_GET['uraian'])."','".$nominal."',
		'".$_SESSION["anggaran_tahun"]."','".date('Y-m-d H:i:s')."','".$_SESSION['anggaran_username']."','".trim($_GET['map79'])."')");
		echo "OK|".$kode;
	}

?>
<?php include("../../close.php"); ?>