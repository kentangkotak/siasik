<?php include "../../conn.php";?>
<?php

	//jk kosong ambil dari counter
	$sql=$conn->query("call nokwitansi(@nomor);");
		$sql=$conn->query("select @nomor as nomor;");
		$jml=$sql->num_rows;
		if($jml>0){ 
			$rs=$sql->fetch_object();
			$counter=$rs->nomor+1;
		}
			$nokwitansi="TR00".$counter;

		$sqlx=$conn->query("select * from rs6 where rs1='".trim($_GET['notrans'])."'");
		$rsx=$sqlx->fetch_object();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Kwitansi</title>
</head>
<body topmargin="0" leftmargin="0" rightmargin="0" style="font-family:Tahoma;font-size:14px;">
<table width="100%">
	<tr valign="top">
		<td>
			<table style="border-bottom:double #999999" width="100%">
				<tr valign="top">
					<td width="50px"><img src="../../images/logors.png" width="50"/></td>
					<td>&nbsp;&nbsp;</td>
					<td><strong><?php echo "RSUD dr. MOHAMAD SALEH";?></strong><br />
						<font style="font-size:12px"><?php echo "Jl. Mayjend Panjaitan No. 65 Probolinggo Jawa Timur";?><br />
						<?php echo "Telp. (0335) 433478,433119,421118 Fax. (0335) 432702";?></font>
					</td>
					<td align="right">&nbsp;<strong>NO. KWITANSI : <?php echo $nokwitansi;?></strong>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td align="right" style="font-size:11px;"><?php echo date("d/m/Y H:i:s");?>&nbsp;</td></tr>
</table>
		<table width="99%" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
			<tr class="headerlist">
				<td>&nbsp;<strong style="font-size:30px;font-weight:bold;">Kwitansi</strong>&nbsp;</td>
			</tr>
		</table><br />
		<table width="99%" cellpadding="0" cellspacing="5" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
			<tr class="headerlist" valign="top">
				<td nowrap="nowrap">&nbsp;Sudah terima dari&nbsp;</td>		
				<td width="8" align="center">&nbsp;:&nbsp;</td>
				<td colspan="2"><?php echo $rsx->rs5;?>&nbsp;</td>
			</tr>
			<tr class="headerlist" valign="top">
				<td>&nbsp;Banyaknya uang&nbsp;</td>		
				<td width="8" align="center">&nbsp;:&nbsp;</td>
				<td height="35px;" colspan="3"><?php echo terbilang($rsx->rs4)." Rupiah";?>&nbsp;</td>
			</tr>
			<tr class="headerlist" valign="top">
				<td nowrap="nowrap">&nbsp;Untuk pembayaran&nbsp;</td>		
				<td width="8" align="center">&nbsp;:&nbsp;</td>
				<td colspan="2"><em><?php echo $rsx->rs3;?></em>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;Untuk&nbsp;</td>
				<td width="8" align="center">&nbsp;:&nbsp;</td>
				<td colspan="2"><em><?php echo $rsx->rs5;?></em>&nbsp;</td>
			</tr>
		</table>
		<br />
		<table width="99%" cellpadding="0" cellspacing="0" border="0" bordercolor="#006699" bordercolordark="#666666" bordercolorlight="#003399">
			<tr class="headerlist" valign="top">
				<td width="450px" colspan="2">&nbsp;</td>
				<td nowrap="nowrap">&nbsp;<em>Probolinggo, <?php echo date("d")." ".bulan(date("m"))." ".date("Y");?></em></td>
			</tr>
			<tr class="headerlist" valign="top">
				<td height="35px" width="200" valign="middle" background="bc1.jpg">&nbsp;<em style="font-size:20px;font-weight:bold;color:#FFFFFF;">Terbilang Rp. <?php echo rpy($rsx->rs4).",-";?></em></td>
				<td width="100">&nbsp;</td>
				<td align="center">&nbsp;Petugas&nbsp;</td>
			</tr>
			<tr height="65px" valign="bottom">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td align="center">&nbsp;( <?php echo $_SESSION['silat_namauser'];?> )&nbsp;</td>
			</tr>
		</table><br />
</body>
</html>
<?php 


?>
<script language="javascript">
if(navigator.appName == "Microsoft Internet Explorer"){
  var PrintCommand = '<object ID="PrintCommandObject" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>';
  document.body.insertAdjacentHTML('beforeEnd', PrintCommand);
  PrintCommandObject.ExecWB(6, 2);
  PrintCommandObject.outerHTML = "";
  window.close();
} else {
  //window.print();
  //window.close();
}
</script>
<?php include "../../close.php";?>