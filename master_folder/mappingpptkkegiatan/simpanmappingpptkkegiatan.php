<?php include("../../conn.php"); ?>
<?php
	if($_GET['x'] == ''){			
		$conn->query("insert into mappingpptkkegiatan(kodepptk,namapptk,kodekegiatan,kegiatan,kodebidang,bidang,tahun,alias) values('".trim($_GET['kodepptk'])."','".trim($_GET['namapptk'])."',
		'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".trim($_GET['kodebidang'])."','".trim($_GET['bidang'])."','".$_SESSION["anggaran_tahun"]."','".trim($_GET['alias'])."')");
		echo "OK|";
	}else{
		$sql=$conn->query("select * from mappingpptkkegiatan where id='".$_GET['x']."'");
		$rs=$sql->fetch_object();
		if($_GET['kodebidang'] != $rs->kodebidang){
			echo "MAAF BIDANG/RUANGAN UNTUK PPTK INI TIDAK SAMA DENGAN PPTK SEBELUMNYA...!!!";
		}else{
			$conn->query("update mappingpptkkegiatan set kodepptk='".$_GET['kodepptk']."',namapptk='".$_GET['namapptk']."',kodekegiatan='".$_GET['kodekegiatan']."',
						kegiatan='".trim($_GET['kegiatan'])."',kodebidang='".trim($_GET['kodebidang'])."',bidang='".trim($_GET['bidang'])."',tahun='".$_SESSION["anggaran_tahun"]."',
						alias='".trim($_GET['alias'])."' where id='".$_GET['x']."'");
			echo "OK|1";
		}
	}

?>
<?php include("../../close.php"); ?>