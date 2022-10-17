<?php include("../../conn.php"); ?>
<?php
	$organisasiArr=explode("|",$_GET["organisasi"]);
	$bagian = $organisasiArr[0];
	$kodeBagian = $organisasiArr[1].".".$organisasiArr[2].".".$organisasiArr[3];
	$alias = $organisasiArr[4];

	$conn->query("insert into 
		pptk(nip,nama,bagian,kodeBagian,tahun,alias) 
		values(
			'".trim($_GET['nip'])."',
			'".trim($_GET['nama'])."',
			'".$bagian."',
			'".$kodeBagian."','".$_SESSION["anggaran_tahun"]."','".$alias."'
		)");
	echo "OK|";
?>
<?php include("../../close.php"); ?>