<?php include("conn.php"); ?>
<?php
	$sql=$conn->query(" select * from login where username='".$_GET["tusername"]."' and status='AKTIF'");
	$rs=$sql->fetch_object();
	if($rs->pass==md5($_GET["tpass"])){
		$_SESSION["anggaran_kodeuser"]=$rs->kode;
		$_SESSION["anggaran_username"]=$rs->username;
		$_SESSION["anggaran_level"]=$rs->level;
		$_SESSION["anggaran_nama"]=$rs->nama;
		$_SESSION["anggaran_alamat"]=$rs->alamat;
		$_SESSION["anggaran_telepon"]=$rs->telepon;
		$_SESSION["anggaran_resetuserpass"]=$rs->gantipass;
		$_SESSION["anggaran_koderuangan"]=$rs->kodeRuangan;
		$_SESSION["anggaran_ruangan"]=$rs->ruangan;
		$_SESSION["anggaran_menu"]=$rs->menu;
		$_SESSION['anggaran_timeout'] = time();
		$_SESSION["anggaran_tahun"]= $_GET["thn"];
		$_SESSION["anggaran_submenu"]= $rs->submenu;
		$_SESSION["anggaran_aksi"]= $rs->aksi;
		$_SESSION["anggaran_pptk"]= $rs->pptk;
		echo "OK";
	}else{
		echo "Username atau Password yang anda masukkan salah atau user yang anda masukan sudah TIDAK AKTIF....!!!!";
	}

?>
<?php include("close.php"); ?>