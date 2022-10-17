<?php include "../../conn.php";?>
<?php
	$jumlah= str_replace(',','',$_GET['jumlah']);
	
    $sql=$conn->query("select npdpanjar_rinci.id as id,npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_rinci.itembelanja as itembelanja,npdpanjar_rinci.volumepermintaanpanjar,
						npdpanjar_rinci.satuan as satuan,npdpanjar_rinci.hargapermintaanpanjar as hargapermintaanpanjar,
						npdpanjar_rinci.nopp as nopp,npdpanjar_rinci.nousulan as nousulan,npdpanjar_rinci.totalpermintaanpanjar as total,npdpanjar_rinci.itembelanja as usulan
						from npdpanjar_heder,npdpanjar_rinci
						where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and npdpanjar_rinci.rincianbelanja50 like '%".$_REQUEST['query']."%' 
						and year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_heder.kodekegiatanblud='".$_GET['kodekegiatanblud']."' 
						");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->itembelanja)." ~> ".rpzx(htmlentities($rs->total))." ~> ".htmlentities($rs->usulan),
				'itembelanja' => htmlentities($rs->itembelanja),
				'volume' => htmlentities(rpz($rs->volumepermintaanpanjar)),
				'satuan' => htmlentities($rs->satuan),
				'harga' => htmlentities(rpz($rs->hargapermintaanpanjar)),
				'nopp' => htmlentities($rs->nopp),
				'nousulan' => htmlentities($rs->nousulan),
				'id' => htmlentities($rs->id),
				'nonpdpanjar' => htmlentities($rs->nonpdpanjar),
				'total' => htmlentities(rpz($rs->total))	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>