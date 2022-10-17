<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select spjpanjar_heder.nospjpanjar as nospjpanjar,spjpanjar_rinci.koderek50 as koderek50,spjpanjar_rinci.rincianbelanja50,
						spjpanjar_rinci.itembelanja as itembelanja,spjpanjar_rinci.nopp as nopp,spjpanjar_rinci.nousulan as nousulan,
						spjpanjar_rinci.volume as volume,spjpanjar_rinci.satuan as satuan,spjpanjar_rinci.harga as harga,
						spjpanjar_rinci.jumlahanggaran as jumlahanggaran,spjpanjar_rinci.jumlahpenerimaanpanjar as jumlahpenerimaanpanjar,
						spjpanjar_rinci.jumlahbelanjapanjar as jumlahbelanjapanjar,spjpanjar_rinci.sisapanjar as sisapanjar,spjpanjar_rinci.id as id
						from spjpanjar_heder,spjpanjar_rinci
						where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.kodekegiatanblud='".$_GET['kodekegiatanblud']."' 
						AND spjpanjar_rinci.koderek50='".$_GET['koderek50']."' and spjpanjar_rinci.flag='' and 
						spjpanjar_rinci.itembelanja like '%".$_REQUEST['query']."%'  and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."'");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->itembelanja),
				'itembelanja' => htmlentities($rs->itembelanja),
				'volume' => htmlentities(rpz($rs->volume)),
				'satuan' => htmlentities($rs->satuan),
				'harga' => htmlentities(rpz($rs->harga)),
				'nopp' => htmlentities($rs->nopp),
				'nousulan' => htmlentities($rs->nousulan),
				'id' => htmlentities($rs->id),
				'jumlahanggaran' => htmlentities(rpz($rs->jumlahanggaran)),
				'jumlahpenerimaanpanjar' => htmlentities(rpz($rs->jumlahpenerimaanpanjar)),
				'jumlahbelanjapanjar' => htmlentities(rpz($rs->jumlahbelanjapanjar)),
				'sisapanjar' => htmlentities(rpz($rs->sisapanjar))
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>