<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select npkls_rinci.*,npdls_rinci.rincianbelanja as rincianbelanja from npkls_rinci,npdls_rinci 
						where npkls_rinci.nonpdls=npdls_rinci.nonpdls and  npkls_rinci.nonpk='".$_GET['nonpk']."' group by npdls_rinci.nonpdls");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO NPD</th>
				<th>TANGGAL</th>
				<th>KEGIATAN</th>
				<th>KEGIATAN BLUD</th>
				<th>RINCIAN BELANJA</th>
				<th>TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nonpdls; ?></td>
				<td><?php echo out_tanggal('-',$rs->tglnpd); ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo $rs->rincianbelanja; ?></td>
				<td align="right"><?php echo rp($rs->total); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nonpk; ?>','<?php echo $rs->nonpdls; ?>','<?php echo $rs->kegiatan; ?>',
					'<?php echo $rs->kodekegiatanblud; ?>','<?php echo $rs->total; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}
			?>
			<tr>
				<td colspan="6" align="right">TOTAL</td>
				<td align="right"><?php echo rp($subtotal); ?></td>
			</tr>
		</tbody>
	</table>
<?php include("../../close.php"); ?>