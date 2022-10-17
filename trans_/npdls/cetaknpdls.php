<?php include "../../conn.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NPD</title>
<style type="text/css" media="print">
 @page {
    size: Legal potrait;
    margin: 0.4in
}
</style>
</head>
<center><b> PEMERINTAH KOTA PROBOLINGGO  </br>
			NOTA PERMINTAAN DANA (NPD) </br>
			TAHUN ANGGARAN <?php echo $_SESSION["anggaran_tahun"] ;?> </br>
			NOMOR <?php echo $_GET['nonpdls'];?>
			</b></center> 
<br/>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
	
	$sql=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpdls']."'");
	$rs=$sql->fetch_object();
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" bordercolor="#000000" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td>&nbsp;Program&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->program;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Kegiatan BLUD&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->kegiatanblud;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Pihak Ketiga &nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->penerima;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Nama Bank&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->bank;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;No. Rekening&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->rekening;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;NPWP&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->npwp;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Triwulan&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->triwulan;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Untuk Keperluan&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->keterangan;?>&nbsp;</td>
	</tr>
	<tr>
		<td colspan="3">
			<?php
					$sqlrinci=$conn->query("select * from npdls_rinci where nonpdls='".$_GET['nonpdls']."'");
				
					$i=1;
			?>
			<center><b> RINCIAN RENCANA PENGGUNAAN DANA</b></center> 
			<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#000000" bordercolordark="#666666" bordercolorlight="#003399">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kode </th>
						<th>Uraian Belanja</th>
						<th>Item Belanja </th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php while($rsrinci=$sqlrinci->fetch_object()){ ?>
					<tr>
						<td align="center"><?php echo $i; ?></td>
						<td><?php echo $rsrinci->koderek50; ?></td>
						<td><?php echo $rsrinci->rincianbelanja; ?></td>
						<td><?php echo $rsrinci->itembelanja; ?></td>
						<td align="right"><?php echo rpzx($rsrinci->nominalpembayaran); ?></td>
					</tr>
					<?php
						$i++; $subtotal=$subtotal+$rsrinci->nominalpembayaran;
						}
					?>
					<tr>
						<td colspan="4" align="right">SUBTOTAL</td>
						<td align="right"><?php echo rpzx($subtotal); ?></td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</table>
</br>
<table width="100%" border="0">
	<tr>
		<td width="19%">&nbsp;Jumlah NPD &nbsp;</td>
		<td width="1%">&nbsp;:&nbsp;</td>
		<td width="80%" align="left">&nbsp;<?php echo rpzx($subtotal);?>&nbsp;</td>
	</tr>
	<tr>
		<td width="19%">&nbsp;Terbilang&nbsp;</td>
		<td width="1%">&nbsp;:&nbsp;</td>
		<td width="80%" align="left">&nbsp;<?php echo terbilang($subtotal);?>&nbsp;Rupiah</td>
	</tr>
</table>

</br>
<?php
	$conn_simpeg = new mysqli("localhost","admin","alam02018sa","kepegx");
	$sqlsimepg=$conn_simpeg->query("select * from pegawai where jabatan='J00035' and aktif='AKTIF'");
	$rssimpeg=$sqlsimepg->fetch_object();
?>
<table width="100%" align="right" border="0">
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td nowrap>&nbsp;Probolinggo, <?php echo date('d')." ".bulan(date('m'))." ".date('Y');?>&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="300px">&nbsp;Mengetahui,&nbsp;</td>
		<td>&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="300px">&nbsp;Pejabat Teknis &nbsp;</td>
		<td>&nbsp;Bendahara Pengeluaran</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" height="30px">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;<strong><u>( <?php echo $rs->pptk ;?> )</u><strong>&nbsp;</td>
		<td>&nbsp;<strong><u>( <?php echo $rssimpeg->nama ;?> )</u><strong>&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td>&nbsp;<strong>NIP <?php echo $rs->kodepptk ;?><strong>&nbsp;</td>
		<td>&nbsp;<strong>NIP <?php echo $rssimpeg->nip ;?> <strong>&nbsp;</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
</table>
</body>
</html>
<script language="javascript">

var is_chrome = function () { return Boolean(window.chrome); }
if(is_chrome) 
{
   window.print();
   setTimeout(function(){window.close();}, 10000); 
   // give them 10 seconds to print, then close
}
else
{
   window.print();
   window.close();
}

</script>
<?php include "../../close.php";?>
