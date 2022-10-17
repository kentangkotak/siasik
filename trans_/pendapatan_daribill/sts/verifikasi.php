<?php include("../../../conn.php"); ?>
<?php
$sqlcek=$conn->query("select * from t_terima_ppk where idtrans='".$_GET['notrans']."'");
$jml=$sqlcek->num_rows;
if($jml > 0){
	echo 'MAAF NO TRANSAKSI INI SUDAH PERNAH DI VERIF...!!!!';
}else{
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$sql=$conn_simrs->query("select * from keu_trans_bk where idTrans='".$_GET['notrans']."'");
	$rs=$sql->fetch_object();
	$idtrans=$rs->idTrans;
	$notadinas=$rs->notaDinas;
	$notransfer=$rs->noTransfer;
	$tgltrans=$rs->tglTrans;
	$nilai=$rs->nilai;
	$norekpengirim=$rs->noRekPengirim;
	$norekpenerima=$rs->noRekPenerima;
	$ket=$rs->ket;
	$tglinput=$rs->tglInput;
	$userinput=$rs->userInput;
	$tglverif= date('Y-m-d H:i:s');
	
	$conn_simrs->query("update keu_trans_bk set tglVerifPpk='".$tglverif."',flagverif=1 where idTrans='".$_GET['notrans']."'");
	$conn->query("insert into t_terima_ppk(idtrans,notadinas,notransfer,tgltrans,nilai,norekpengirim,norekpenerima,ket,tglinput,userinput,tglverif,userverif) 
	values('".$idtrans."','".$notadinas."','".$notransfer."','".$tgltrans."','".$nilai."','".$norekpengirim."','".$norekpenerima."',
	'".$ket."','".$tglinput."','".$userinput."','".$tglverif."','".$_SESSION["anggaran_kodeuser"]."')");
    echo "OK|";
}
?>
<?php include("../../../close.php"); ?>