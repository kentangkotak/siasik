<?php include("../../../conn.php"); ?>
<?php
$thn = $_GET['thn'];

$sql_cek = $conn->query("select * from t_tampung_copy where tgl = '" . $thn . "'");
$jml_cek = $sql_cek->num_rows;
if ($jml_cek > 0) {
    echo "MAAF DATA SEBELUM PAK SUDAH PERNAH DISIMPAN...!!!";
} else {
    $sql_paguRincian = $conn->query("select * from t_tampung where tgl = '" . $thn . "' and flag = ''");
    while ($rspaguRincian = $sql_paguRincian->fetch_object()) {
        $conn->query("insert into t_tampung_copy(notrans,idpp,usulan,pagu,koderek108,koderek50,kodekegiatanblud,tgl,volume,harga,satuan,uraian50,uraian108) 
            values('" . $rspaguRincian->notrans . "','" . $rspaguRincian->idpp . "','" . $rspaguRincian->usulan . "',
            '" . $rspaguRincian->pagu . "','" . $rspaguRincian->koderek108 . "','" . $rspaguRincian->koderek50 . "',
            '" . $rspaguRincian->kodekegiatanblud . "','" . $rspaguRincian->tgl . "','" . $rspaguRincian->volume . "',
            '" . $rspaguRincian->harga . "','" . $rspaguRincian->satuan . "','" . $rspaguRincian->uraian50 . "','" . $rspaguRincian->uraian108 . "'
            )");
    }
    $sql_paguRincian_x = $conn->query("select usulanhonor_h_pak.notrans notrans,usulanhonor_r_pak.idpp idpp,usulanhonor_r_pak.keterangan as usulan,usulanhonor_r_pak.nilai pagu,
    usulanhonor_r_pak.koderek108 koderek108,usulanhonor_r_pak.koderek50 koderek50,usulanhonor_h_pak.kodeKegiatan kodekegiatanblud,year(tglTransaksi) as tgl,
    usulanhonor_r_pak.volume volume,usulanhonor_r_pak.harga harga,usulanhonor_r_pak.satuan satuan,usulanhonor_r_pak.uraian50 uraian50,usulanhonor_r_pak.uraian108 uraian108
    from usulanhonor_h_pak,usulanhonor_r_pak
    where usulanhonor_h_pak.notrans = usulanhonor_r_pak.notrans and year(tglTransaksi) = '" . $thn . "' ");
    while ($rspaguRincian_x = $sql_paguRincian_x->fetch_object()) {
        $conn->query("insert into t_tampung(notrans,idpp,usulan,pagu,koderek108,koderek50,kodekegiatanblud,tgl,volume,harga,satuan,uraian50,uraian108,flag) 
            values('" . $rspaguRincian_x->notrans . "','" . $rspaguRincian_x->idpp . "','" . $rspaguRincian_x->usulan . "','" . $rspaguRincian_x->pagu . "',
            '" . $rspaguRincian_x->koderek108 . "','" . $rspaguRincian_x->koderek50 . "','" . $rspaguRincian_x->kodekegiatanblud . "','" . $rspaguRincian_x->tgl . "',
            '" . $rspaguRincian_x->volume . "','" . $rspaguRincian_x->harga . "','" . $rspaguRincian_x->satuan . "',
            '" . $rspaguRincian_x->uraian50 . "','" . $rspaguRincian_x->uraian108 . "','1')");
    }
    $conn->query("delete from t_tampung where tahun = '" . $thn . "' and flag='' ");
    echo "OK|";
}

?>
<?php include("../../../close.php"); ?>