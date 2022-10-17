<?php include "../../conn.php";?>
<?php
	//if (!isset($_REQUEST['term'])) exit;
	$sql=$conn_musrenbang->query("select rs7.rs1 as noverif,rs7.rs2 as nousulan,rs7.rs2 as nousulan,rs7.rs6 as kodejenisusulan,rs2.rs2 as jenisusulan,
					rs7.rs5 as koderuangan,rs3.rs2 as ruangan,rs7.rs7 as tahun,
					rs8.rs2 as kodeusulan,rs1.rs2 as usulan,rs8.rs3 as jumlah,rs8.rs6 as keterangan,rs8.rs7 as cito,rs1.rs5 as satuan
					from rs7,rs8,rs1,rs2,rs3
					where rs7.rs1=rs8.rs1 and rs7.rs1=rs8.rs1 and rs7.rs6=rs2.rs1 and rs7.rs5=rs3.rs1 and rs8.rs2=rs1.rs1 and rs7.rs8='1' 
					and rs1.rs2 like '%".$_GET['query']."%'
					and rs7.rs6='7'");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => $rs->usulan .' || '.$rs->noverif .' || '.$rs->nousulan,
				'data' => $rs->usulan,
				'noverif' => $rs->noverif,
				'nousulan' => $rs->nousulan,
				'kodeusulan' => $rs->kodeusulan
			);
		}
	}

	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>