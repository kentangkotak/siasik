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
			TAHUN ANGGARAN <?php echo $_SESSION["anggaran_tahun"] ;?>
			NOMOR <?php echo $_GET['nonpd'];?></b></center> 
<br/>
<?php
	$conn_simpeg = new mysqli("localhost","admin","alam02018sa","kepegx");
	$sqlsimepg=$conn_simpeg->query("select pegawai.nip as nip,pegawai.nama as nama from t_jabatan_tmb,pegawai 
where  pegawai.aktif='AKTIF' and t_jabatan_tmb.nip=pegawai.nip and (pegawai.jabatan='J00001' or t_jabatan_tmb.jabatan='JT00041');");
	$rssimpeg=$sqlsimepg->fetch_object();
	
	$sql=$conn->query("select * from npdpanjar_heder where nonpdpanjar='".$_GET['nonpd']."'");
	$rs=$sql->fetch_object();
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" bordercolor="#000000" bordercolordark="#666666" bordercolorlight="#003399">
	<tr>
		<td>&nbsp;Program&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->program;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Kegiatan&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->kegiatan;?>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;Kegiatan BLUD&nbsp;</td>
		<td>&nbsp;:&nbsp;</td>
		<td>&nbsp;<?php echo $rs->kegiatanblud;?>&nbsp;</td>
	</tr>
</table>
<br/>	
			<?php
					$sqlrinci=$conn->query("select * from npdpanjar_rinci where nonpdpanjar='".$_GET['nonpd']."'");
				
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
						<td><?php echo $rsrinci->rincianbelanja50; ?></td>
						<td><?php echo $rsrinci->itembelanja; ?></td>
						<td align="right"><?php echo rpzx($rsrinci->totalpermintaanpanjar); ?></td>
					</tr>
					<?php
						$i++; $subtotal=$subtotal+$rsrinci->totalpermintaanpanjar;
						}
					?>
					<tr>
						<td colspan="4" align="right">SUBTOTAL</td>
						<td align="right"><?php echo rpzx($subtotal); ?></td>
					</tr>
				</tbody>
			</table>
</br>
<table width="100%" border="0">
	<tr>
		<td width="25%">&nbsp;Jumlah NPD Yang Diterima&nbsp;</td>
		<td width="1%">&nbsp;:&nbsp;</td>
		<td width="50%">&nbsp;<?php echo rpzx($subtotal);?>&nbsp;</td>
	</tr>
</table>
<table width="100%" border="0">
	<tr>
		<td width="25%" nowrap="nowrap">&nbsp;Terbilang &nbsp;</td>
		<td width="1%" nowrap="nowrap">&nbsp;: &nbsp;</td>
		<td width="50%"><?php echo terbilang($subtotal);?>&nbsp;Rupiah</td>
	</tr>
</table>
<table width="100%" border="0">
	<tr>
		<td width="25%" nowrap="nowrap">&nbsp;Nama Rekening &nbsp;</td>
		<td width="1%" nowrap="nowrap">&nbsp;:&nbsp;</td>
		<td width="50%" align="left">&nbsp;Bendahara Pengeluaran RSUD&nbsp;</td>
	</tr>
</table>
<table width="100%" border="0">
	<tr>
		<td width="25%" nowrap="nowrap">&nbsp;Nomor Rekening Bank &nbsp;</td>
		<td width="1%" nowrap="nowrap">&nbsp;:&nbsp;</td>
		<td width="50%">&nbsp;0121111136&nbsp;</td>
	</tr>
</table>
</br>
<table width="100%" align="right" border="0">
	<tr align="center">
		<td width="45%">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="40%">&nbsp;Probolinggo, <?php echo date('d')." ".bulan(date('m'))." ".date('Y');?>&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="45%">&nbsp;Mengetahui,&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="40%">&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="45%">&nbsp;Pengguna/Kuasa Pengguna Anggaran &nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="40%">&nbsp;Pejabat Teknis</td>
	</tr>
	<tr align="center">
		<td width="45%">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="40%">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="45%">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="40%">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="45%" nowrap>&nbsp;<strong><u>( <?php echo $rssimpeg->nama ;?> )</u><strong>&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="40%">&nbsp;<strong><u>( <?php echo $rs->pptk ;?> )</u><strong>&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="45%" nowrap>&nbsp;<strong>NIP : <?php echo $rssimpeg->nip ;?><strong>&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="40%">&nbsp;<strong>NIP : <?php echo $rs->kodepptk ;?><strong>&nbsp;</td>
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