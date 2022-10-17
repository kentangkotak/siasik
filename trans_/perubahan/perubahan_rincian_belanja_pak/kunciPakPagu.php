<?php include("../../../conn.php"); ?>
<?php
$thn = $_GET['thn'];

$sql_cek = $conn->query("select * from t_tampung_pagu_copy where tahun = '" . $thn . "'");
$jml_cek = $sql_cek->num_rows;
if ($jml_cek > 0) {
    echo "MAAF DATA SEBELUM PAK SUDAH PERNAH DISIMPAN...!!!";
} else {
    $sql_pagu = $conn->query("select * from t_tampung_pagu where tahun = '" . $thn . "' and flag = '' ");
    while ($rspagu = $sql_pagu->fetch_object()) {
        $conn->query("insert into t_tampung_pagu_copy(kodekegiatanblud,pagu,tahun) 
        values('" . $rspagu->kodekegiatanblud . "','" . $rspagu->pagu . "','" . $rspagu->tahun . "')");
    }

    $sql_pagu_x = $conn->query("select kodekegiatan,total,tahun from penetapan_pagu_pak where tahun = '" . $thn . "' ");
    while ($rspagu_x = $sql_pagu_x->fetch_object()) {
        $conn->query("insert into t_tampung_pagu(kodekegiatanblud,pagu,tahun,flag) 
            values('" . $rspagu_x->kodekegiatan . "','" . $rspagu_x->total . "','" . $rspagu_x->tahun . "',
            '1')");
    }
    $conn->query("delete from t_tampung_pagu where tahun = '" . $thn . "' and flag='' ");

    echo "OK|";
}

?>
<?php include("../../../close.php"); ?>