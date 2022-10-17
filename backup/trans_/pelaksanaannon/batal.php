<?php include("../../conn.php"); ?>
<?php
	$notransx=str_replace("/",".",$_GET['notrans']); 
	$nama_dirx = "../../potos_folder/".$notransx;
	
	$sql=$conn->query("select * from rs33 where rs1='".$_GET['notrans']."'");
	while($rs=$sql->fetch_object()){
		$target = "../../potos_folder/".$notransx."/".$rs->rs4 ."/".$rs->rs8;
		$nama_dir = "../../potos_folder/".$notransx."/".$rs->rs4;
		unlink($target);
		rmdir($nama_dir);
		rmdir($nama_dirx);
	}
	$conn->query("delete from rs32 where rs1='".$_GET['notrans']."'");			
	$conn->query("delete from rs33 where rs1='".$_GET['notrans']."'");
	
	echo "OK|".$_GET['notrans'];


	
	