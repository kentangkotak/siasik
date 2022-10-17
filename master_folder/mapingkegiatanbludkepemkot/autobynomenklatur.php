<?php include "../../conn.php";?>
<?php
	//if (!isset($_REQUEST['term'])) exit;
	$sql=$conn->query("select level1,level2,level3,level4,level5,rekapkode,uraian from( 
       select urusan as level1,bidang_urusan as level2,program as level3,kegiatan as level4,subkegiatan as level5,concat_ws('.',urusan,bidang_urusan,program,kegiatan,subkegiatan) as rekapkode,
       nomenklatur as uraian from permendagri_50_c) as pemendagri50 where uraian like '%".$_REQUEST['query']."%' and level5 <>00
	 ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => $rs->uraian .' || '.$rs->rekapkode ,
				'rekapkode' => $rs->rekapkode,
				'level1' => $rs->level1,
				'level2' => $rs->level2,
				'level3' => $rs->level3,
				'level4' => $rs->level4,
				'level5' => $rs->level5,
				'uraian' => $rs->uraian
			);
		}
	}

	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>