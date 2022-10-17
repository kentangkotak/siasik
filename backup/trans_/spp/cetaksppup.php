<?php include "../../conn.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EVALUASI</title>
<style type="text/css" media="print">
 @page {
    size: Legal landscape;
    margin: 0.4in
}
</style>
</head>

<body topmargin="0" leftmargin="0" rightmargin="0">
<table width="99%">
	<tr valign="top">
		<td>
			<table style="border-bottom:double #999999" width="99%">
				<tr valign="top">
					<td align="center"><strong> PEMERINTAH KOTA PROBOLINGGO</strong><br />
						<strong>SURAT PERMINTAAN PEMBAYARAAN</strong><br /></font>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
</table>
<?php
	$sqlx=$conn->query("select * from transsppup where nosppup='".trim($_GET['x'])."'");
?>
<table style="border-bottom:double #999999" width="99%">
	<tr valign="top">
		<td align="center"><strong> NO SPP:</strong><br />
		</td>
	</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#000000" bordercolordark="#666666" bordercolorlight="#003399">
	<tr class="headerlist">
		<td width="4%">&nbsp;No.&nbsp;</td>
		<td width="20%">&nbsp;NO SPP UP&nbsp;</td>
		<td width="46%">&nbsp;TANGGAL TRANSAKSI&nbsp;</td>
		<td width="29%">&nbsp;BENDAHARA PENGELUARAN&nbsp;</td>
		<td width="29%">&nbsp;JUMLAH SPP&nbsp;</td>
		<td width="29%">&nbsp;BANK&nbsp;</td>
		<td width="29%">&nbsp;NO REK&nbsp;</td>
	</tr>
	<?php
	$x=0;
	$sql=$conn->query("select * from transsppup where nosppup='".trim($_GET['x'])."'");
	while($rs=$sql->fetch_object()){
	$x=$x+1;
	?>
	<tr class="bodylist" valign="top">
		<td><?php echo $i; ?></td>
		<td><?php echo $rs->nosppup; ?></td>
		<td><?php echo $rs->tglTrans; ?></td>
		<td><?php echo $rs->bendaharaKeluar; ?></td>
		<td><?php echo rp($rs->jumlahspp); ?></td>
		<td><?php echo $rs->bank; ?></td>
		<td><?php echo $rs->kodeRek; ?></td>
	</tr>
	<?php }?>
</table>
<br/>
<br/>
<?php
	$sql_foter=$conn->query("select rs14.rs1 as kode,rs14.rs8 as ruangan,rs12.rs2 as kepala from rs12,rs14 where rs14.rs8=rs12.rs1 and rs14.rs1='".trim($_GET['kodeevaluasi'])."'");
	$rs_foter=$sql_foter->fetch_object();
	$kepala=$rs_foter->kepala;
	$ruangan=$rs_foter->ruangan;

	$sekarang= date('Y-m-d');
	
		
?>

<table width="100%" align="center">
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td>&nbsp;Probolinggo, <?php echo tanggal_indo($sekarang);?>&nbsp;<br/>
			Kepala Ruang <?php echo "$ruangan";?></td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" height="30px">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td>&nbsp;<strong>( <?php echo "$kepala";?> )<strong>&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
</table>
</body>
</html>
<script language="javascript">
//if(navigator.appName == "Microsoft Internet Explorer"){
//  var PrintCommand = '<object ID="PrintCommandObject" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>';
//  document.body.insertAdjacentHTML('beforeEnd', PrintCommand);
//  PrintCommandObject.ExecWB(6, 2);
//  PrintCommandObject.outerHTML = "";
//  window.close();
//} else {
  window.print();
  window.close();
//}
</script>
<?php include "../../close.php";?>