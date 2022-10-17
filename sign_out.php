<?php
	session_start();
	session_destroy();
		//$_SESSION["musrenbang_username"]="";
//		$_SESSION["musrenbang_level"]="";
//		$_SESSION["musrenbang_nama"]="";
//		$_SESSION["musrenbang_kode"]="";
//		$_SESSION["musrenbang_alamat"]="";
//		$_SESSION["musrenbang_telepon"]="";
//		$_SESSION["musrenbang_status"]="";
//		$_SESSION["musrenbang_bagian"]="";
//		$_SESSION["musrenbang_gantipass"]="";
	header("location:login.php");
?>