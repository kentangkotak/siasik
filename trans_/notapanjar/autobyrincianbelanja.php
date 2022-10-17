<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_rinci.koderek50 as koderek50,npdpanjar_rinci.rincianbelanja50 as rincianbelanja50,
						round(sum(npdpanjar_rinci.total),2) as total
						from npdpanjar_rinci,npdpanjar_heder
						where npdpanjar_rinci.nonpdpanjar=npdpanjar_heder.nonpdpanjar and npdpanjar_heder.nonpdpanjar='".$_GET['nonpd']."'
						and year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_rinci.rincianbelanja50 like '%".$_REQUEST['query']."%'  
						group by npdpanjar_rinci.koderek50");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->rincianbelanja50),
				'rincianbelanja50' => htmlentities($rs->rincianbelanja50),
				'total' => rpz($rs->total),
				'koderek50' => htmlentities($rs->koderek50)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>