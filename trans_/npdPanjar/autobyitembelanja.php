<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
						penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
						penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
						penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
						penyesesuaianperioritas_rinci.harga as harga,penyesesuaianperioritas_rinci.nilai as total,penyesesuaianperioritas_rinci.nousulan as nousulan,
						penyesesuaianperioritas_rinci.id as idpp
						from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
						where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
						and penyesesuaianperioritas_rinci.koderek50='".$_GET[koderek50]."'
						and penyesesuaianperioritas_rinci.kunci=''
						and penyesesuaianperioritas_heder.kodekegiatan='".$_GET[kodekegiatan]."'
						and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
						and penyesesuaianperioritas_rinci.usulan like '%".$_REQUEST['query']."%' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->usulan),
				'usulan' => htmlentities($rs->usulan),
				'jumlahacc' => htmlentities(rpz($rs->jumlahacc)),
				'satuan' => htmlentities($rs->satuan),
				'harga' => htmlentities(rpz($rs->harga)),
				'nopp' => htmlentities($rs->notrans),
				'nousulan' => htmlentities($rs->nousulan),
				'idpp' => htmlentities($rs->idpp),
				'total' => htmlentities(rpz($rs->total))	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>