<?php include "../../conn.php";?>
<?php
	$data=explode( '|', $_GET['kodepptk'] );
	$kodepptk=$data[0];
	$namapptk=$data[1];
	
	$sql=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodepptk as kodepptk,penyesesuaianperioritas_heder.pptk as pptk,
						penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50
						from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
						where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and penyesesuaianperioritas_rinci.uraian50 like '%".$_REQUEST['query']."%'
						and penyesesuaianperioritas_heder.kodepptk='".$kodepptk."' and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
						group by penyesesuaianperioritas_rinci.koderek50  ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->uraian50) ,
				'uraian50' => htmlentities($rs->uraian50),
				'koderek50' => htmlentities($rs->koderek50)
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>