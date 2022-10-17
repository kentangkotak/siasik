<?php include("../../conn.php"); ?>
<?php
	
	$notransx=str_replace("/",".",$_GET['notrans']);        
				
	$nama_dir = "../../potos_folder/".$notransx."/".$_GET['nip'];
	$target = "../../potos_folder/".$notransx."/".$_GET['nip']."/".$_GET['filenya'];
	
	if(file_exists($target)){
		unlink($target);
		if( is_dir($nama_dir) ) {
			rmdir($nama_dir);
			$conn->query("delete from rs33 where rs1='".$_GET['notrans']."' and rs4='".$_GET['nip']."'");
			echo "OK|".$_GET['notrans'];
		} else {
			echo "MAAF FILE YANG AKAN ANDA HAPUS TIDAK DITEMUKAN.....!!!!"; 
		}
	}else{
		echo "MAAF FILE YANG AKAN ANDA HAPUS TIDAK DITEMUKAN.....!!!!"; 
	}
	
	
	
	


	
	