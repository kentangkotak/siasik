<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select usulanHonor_h.notrans as notrans,usulanHonor_h.kodeRuangan as koderuangantujuan,usulanHonor_h.tglTransaksi as tgltransaksi,usulanHonor_r.kodeKegiatan as kodekegiatan,
							usulanHonor_r.kegiatan as kegiatan,usulanHonor_r.keterangan as keterangan,round(usulanHonor_r.volume) as volume,round(usulanHonor_r.harga) as harga,round(usulanHonor_r.nilai) as nilai
							from usulanHonor_h,usulanHonor_r
							where usulanHonor_h.notrans=usulanHonor_r.notrans and usulanHonor_r.kegiatan like '%".$_REQUEST['query']."%' and usulanHonor_h.kodeRuangan='R054' 
							and usulanHonor_r.flag=''");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->kegiatan) .' || '.$rs->volume .' || '.rp($rs->harga) .' '.rp($rs->nilai),
				'kegiatan' => htmlentities($rs->kegiatan),
				'volume' => htmlentities($rs->volume),
				'keterangan' => htmlentities($rs->keterangan),
				'koderuangan' => htmlentities($rs->koderuangantujuan),
				'ruangpengusul' => 'Keuangan',
				'nosusulan' => $rs->notrans,
				'harga' => $rs->harga,
				'kodekegiatan' => $rs->kodekegiatan	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>