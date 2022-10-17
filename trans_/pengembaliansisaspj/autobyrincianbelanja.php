<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select spjpanjar_heder.nospjpanjar as nospjpanjar,spjpanjar_rinci.koderek50 as koderek50,spjpanjar_rinci.rincianbelanja50
							from spjpanjar_heder,spjpanjar_rinci
							where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.kodekegiatanblud='".$_GET['kodekegiatanblud']."' 
							and spjpanjar_rinci.flag='' and  
							spjpanjar_rinci.rincianbelanja50 like '%".$_REQUEST['query']."%' and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->rincianbelanja50),
				'rincianbelanja50' => htmlentities($rs->rincianbelanja50),
				'koderek50' => htmlentities($rs->koderek50)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>