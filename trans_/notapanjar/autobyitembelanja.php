<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select npdpanjar_rinci.nopp as notrans,
						npdpanjar_rinci.itembelanja as usulan,npdpanjar_rinci.volume as jumlahacc,npdpanjar_rinci.satuan as satuan,
						npdpanjar_rinci.harga as harga,npdpanjar_rinci.total as total,npdpanjar_rinci.nousulan as nousulan
						from npdpanjar_rinci,npdpanjar_heder
						where npdpanjar_rinci.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and npdpanjar_rinci.koderek50='".$_GET[koderek50]."'
						and npdpanjar_heder.kodekegiatanblud='".$_GET[kodekegiatan]."'
						and year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' 
						and npdpanjar_rinci.itembelanja like '%".$_REQUEST['query']."%'");
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
				'total' => htmlentities(rpz($rs->total))	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>