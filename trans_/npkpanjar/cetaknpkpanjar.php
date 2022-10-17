<?php include "../../conn.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>NPD</title>
<style type="text/css" media="print">
 @page {
    size: Legal landscape;
    margin: 0.4in
}
</style>
</head>
<center><b> PEMERINTAH KOTA PROBOLINGGO  </br>
			NOTA PERGESERAN KAS </br>
			TAHUN ANGGARAN <?php echo $_SESSION["anggaran_tahun"] ;?></b></center> 
<br/>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
	
	$sql=$conn->query("select * from npkpanjar_heder where nonpk='".$_GET['nonpk']."'");
	$rs=$sql->fetch_object();
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0" bordercolor="#000000" bordercolordark="#666666" bordercolorlight="#003399">
	<tr class="headerlist">
		<td width="100%" align="center" colspan="3">&nbsp;Nomor NPK:&nbsp;<?php echo $_GET['nonpk'];?></td>
	</tr>
</table>
<?php
	$sqlrinci=$conn->query("select * from npkpanjar_rinci where nonpk='".$_GET['nonpk']."'");
	$i=1;
?>	
<table width="100%" cellpadding="0" cellspacing="0" border="1" bordercolor="#000000" bordercolordark="#666666" bordercolorlight="#003399">
	<thead>
		<tr>
			<th>No.</th>
			<th>No. NPD </th>
			<th>Kegiatan BLUD</th>
			<th>Belanja </th>
		</tr>
	</thead>
	<tbody>
		<?php while($rsrinci=$sqlrinci->fetch_object()){ ?>
		<tr>
			<td align="center"><?php echo $i; ?></td>
			<td><?php echo $rsrinci->nonpd; ?></td>
			<td><?php echo $rsrinci->kegiatanblud; ?></td>
			<td align="right"><?php echo rpzx($rsrinci->total); ?></td>
		</tr>
		<?php
			$i++; $subtotal=$subtotal+$rsrinci->total;
			}
		?>
		<tr>
			<td align="right" colspan="4"><?php echo rpzx($subtotal); ?></td>
		</tr>
	</tbody>
</table>
</br>
<table width="100%" border="0">
	<tr>
		<td width="50%">&nbsp;Jumlah NPK &nbsp;</td>
		<td width="50%" align="right">&nbsp;<u><?php echo rpzx($subtotal);?></u>&nbsp;</td>
	</tr>
</table>
<table width="100%" border="0">
	<tr>
		<td width="5%" nowrap="nowrap">&nbsp;Terbilang &nbsp;</td>
		<td width="50%" align="left"><b><?php echo terbilang($subtotal);?></b>&nbsp;</td>
	</tr>
</table>
</br>
<table width="100%" align="right">
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td>&nbsp;Probolinggo, <?php echo date('h')." ".bulan(date('m'))." ".date('Y');?>&nbsp;<br/>
			Pengguna Anggaran</td>
		<td width="100px">&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" height="30px">&nbsp;&nbsp;</td>
	</tr>
	<tr align="center">
		<td width="100px">&nbsp;&nbsp;</td>
		<td>&nbsp;&nbsp;</td>
		<td width="300px">&nbsp;&nbsp;</td>
		<td>&nbsp;<strong>( <?php echo $rs->pptk ;?> )<strong>&nbsp;</td>
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
   //give them 10 seconds to print, then close
}
else
{
   window.print();
   window.close();
}
</script>
<?php include "../../close.php";?>