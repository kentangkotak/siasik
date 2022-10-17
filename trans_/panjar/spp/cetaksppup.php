<?php include "../../../conn.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

</head>
<?php
	$sql=$conn->query("select *,year(tglTrans) as tahun from transsppup where nosppup='".trim($_GET['x'])."'");
	$rs=$sql->fetch_object();
	$sekarang= date('Y-m-d');
?>
<body topmargin="0" leftmargin="0" rightmargin="0">
<table width="99%" >
	<tr valign="top">
		<td>
			<table style="border-bottom:double #999999" width="99%">
				<tr valign="top">
					<td align="center"><strong> PEMERINTAH KOTA PROBOLINGGO</strong><br />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table width="99%">
	<tr valign="top">
		<td>
			<table width="99%">
				<tr valign="top">
					<td align="center"><strong>SURAT PERMINTAAN PEMBAYARAAN</strong><br /></font>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table style="border-bottom:double #999999" width="99%">
	<tr valign="top">
		<td align="center"><strong> NO SPP : <?php echo $_GET['x'];?></strong><br />
		</td>
	</tr>
</table>
<br/>
<table style="border-bottom:double #999999" width="99%" border="0">
	<tr valign="top">
		<td><strong> Unit Kerja</strong></td>
		<td><strong>:</strong></td>
		<td><strong>RSUD dr. MOHAMAD SALEH</strong></td>
	</tr>
	<tr valign="top">
		<td><strong> ALAMAT</strong></td>
		<td><strong>:</strong></td>
		<td><strong>Jl. Mayjend Panjaitan No. 65 Probolinggo</strong></td>
	</tr>
</table>
<table style="border-bottom:double #999999" width="99%">
	<tr valign="top">
		<td><strong> SPP : Uang Persediaan</strong><br />
		</td>
	</tr>
</table>
<br/>
<table style="border-bottom:double #999999" width="99%" border="0">
	<tr valign="top">
		<td align="center"><strong> RINCIAN RENCANA PENGGUNAAN</strong></td>
	</tr>
	<tr valign="top">
		<td align="center"><strong> TAHUN ANGGARAN <?php echo $rs->tahun;?></strong></td>
	</tr>
</table>
<?php
	$sqlx=$conn->query("select *,year(tglTrans) as tahun from transsppup where nosppup='".trim($_GET['x'])."'");
	$i=1;
?>
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#000000" bordercolordark="#666666" bordercolorlight="#003399">
	<tr class="headerlist">
		<td width="4%">&nbsp;No.&nbsp;</td>
		<td width="29%">&nbsp;REKENING&nbsp;</td>
		<td width="29%">&nbsp;URAIAN&nbsp;</td>
		<td width="29%">&nbsp;JUMLAH&nbsp;</td>
	</tr>
	<?php while($rsx=$sqlx->fetch_object()){ ?>
	<tr class="bodylist" valign="top">
		<td><?php echo $i; ?></td>
		<td><?php echo $rsx->kodeRek; ?></td>
		<td><?php echo $rsx->uraian; ?></td>
		<td align="right"><?php echo rp($rsx->jumlahspp); ?></td>
	</tr>
	<?php $i++; $subtotal=$subtotal+$rsx->jumlahspp; } ?>
	<tr class="bodylist" valign="top";>
		<td colspan="3" align="right"><b>TOTAL</b></td>
		<td align="right"><?php echo rp($subtotal); ?></td>
	</tr>
	
</table>
<br/>
<br/>
<table width="99%" align="center" border="0">
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;Mengetauhi&nbsp;<br/>
			Kepala Sub Bagian Verifikasi dan Mobilisasi Dana</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td>&nbsp;Probolinggo, <?php echo tanggal_indo($sekarang);?>&nbsp;<br/>
			Bendahara Pengeluaran </td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" height="30px">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;<strong><u>BAGUS RAHMAT SOLIKIN, S.E.&nbsp;</u><strong></td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td align="center">&nbsp;<strong><u> <?php echo $rs->bendaharaKeluar ;?> </u><strong>&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td width="100px">&nbsp;&nbsp;</td>
		<td align="center">&nbsp;<strong>198703262011011006&nbsp;<strong></td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td align="center">&nbsp;<strong> <?php echo $rs->kdBendaharaKeluar ;?><strong>&nbsp;</td>
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
<?php include "../../../close.php";?>