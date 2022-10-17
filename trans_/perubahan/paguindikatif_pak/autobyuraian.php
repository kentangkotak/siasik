<?php include "../../../conn.php"; ?>
<?php

$sql = $conn->query("SELECT * FROM masterPendapatanx WHERE uraian like '%" . $_REQUEST['query'] . "%'	and mappingrs<>''");
$data = array();
$data['query'] = 'Usulan';
if ($sql && $sql->num_rows) {
	while ($rs = $sql->fetch_object()) {
		$data['suggestions'][] = array(
			'value' => htmlentities($rs->uraian)  . ' || ' . $rs->kode,
			'koderekening' => $rs->kode,
			'mappingrs' => htmlentities($rs->mappingrs),
			'uraian' => htmlentities($rs->uraian),
			'kode79' => htmlentities($rs->kode79),
			'uraian79' => htmlentities($rs->uraian79),
		);
	}
}

echo json_encode($data);
//flush();
?>
	
<?php include "../../../close.php"; ?>