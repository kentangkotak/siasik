<?php include "../../conn.php";?>
<?php
	//$conn_musrenbang = new mysqli("localhost","admin","alam02018sa","musrenbang");
	$sql=$conn->query("select usulanHonor_h.notrans as notrans,usulanHonor_r.keterangan as rincian,round(usulanHonor_r.volume) as volume,usulanHonor_r.harga as harga,usulanHonor_r.nilai as nilai
						from usulanHonor_r,usulanHonor_h
						where usulanHonor_h.notrans=usulanHonor_r.notrans and usulanHonor_h.kodeKegiatan='".$_GET['kodekegiatan']."' and usulanHonor_r.flag=''
						and usulanHonor_r.keterangan like '%".$_REQUEST['query']."%'  ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->rincian) .' || '.$rs->volume .' || '.rp($rs->harga) .' || '.rp($rs->nilai),
				'usulan' => htmlentities($rs->rincian),
				'volume' => $rs->volume,
				'harga' => $rs->harga,
				'nousulan' => $rs->notrans,
				'nilai' => $rs->nilai			
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>