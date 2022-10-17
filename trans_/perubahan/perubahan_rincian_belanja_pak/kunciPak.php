<?php include("../../../conn.php"); ?>
<?php
$thn = $_GET['thn'];

$sql_cek = $conn->query("select * from pagu_pendapatan_tengah_tahun where tahun = '" . $thn . "'");
$jml_cek = $sql_cek->num_rows;
if ($jml_cek > 0) {
    echo "MAAF DATA SEBELUM PAK SUDAH PERNAH DISIMPAN...!!!";
} else {
    $sqlpendapatan = $conn->query("select * from t_tampung_pendapatan where tahun = '" . $thn . "' and flag='' ");
    while ($rspendapatan = $sqlpendapatan->fetch_object()) {
        $conn->query("insert into pagu_pendapatan_tengah_tahun(notrans,pagu,tahun,koderekeningblud,kode79,uraian79) 
        values('" . $rspendapatan->notrans . "','" . $rspendapatan->pagu . "','" . $rspendapatan->tahun . "','" . $rspendapatan->koderekeningblud . "',
        '" . $rspendapatan->kode79 . "','" . $rspendapatan->uraian79 . "')");
    }

    $sqlpendapatan_x = $conn->query("select notrans,nilai,tahun,koderekeningblud,kode79,uraian79 from anggaran_pendapatan_pak where tahun = '" . $thn . "' ");
    while ($rspendapatan_x = $sqlpendapatan_x->fetch_object()) {
        $conn->query("insert into t_tampung_pendapatan(notrans,pagu,tahun,koderekeningblud,flag,kode79,uraian79) 
            values('" . $rspendapatan_x->notrans . "','" . $rspendapatan_x->nilai . "','" . $rspendapatan_x->tahun . "','" . $rspendapatan_x->koderekeningblud . "',
            '1','" . $rspendapatan_x->kode79 . "','" . $rspendapatan_x->uraian79 . "')");
    }
    $conn->query("delete from t_tampung_pendapatan where tahun = '" . $thn . "' and flag='' ");
    echo "OK|";
}


?>
<?php include("../../../close.php"); ?>