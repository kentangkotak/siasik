<?php include "../../conn.php";?>
<?php
	if($_SESSION["anggaran_koderuangan"] == ''){
		$sql=$conn->query("select * from mappingpptkkegiatan where namapptk like '%".$_REQUEST['query']."%' group by kodepptk ");
	}else{
		$sql=$conn->query("select * from mappingpptkkegiatan where namapptk like '%".$_REQUEST['query']."%' and kodebidang='".$_SESSION["anggaran_koderuangan"]."' group by kodepptk ");
	}
		$data=array();
		$data['query']='Usulan';
		if ($sql && $sql->num_rows){
			while($rs = $sql->fetch_object()){
				$data['suggestions'][] = array(
					'value' => htmlentities($rs->namapptk) ,
					'nama' => htmlentities($rs->namapptk),
					'kodekegiatan' => htmlentities($rs->kodekegiatan),
					'kodebidang' => htmlentities($rs->kodebidang),
					'bidang' => htmlentities($rs->bidang),
					'nip' => $rs->kodepptk		
				);
			}
		}
		
		echo json_encode($data);
		//flush();
?>
	
<?php include "../../close.php";?>