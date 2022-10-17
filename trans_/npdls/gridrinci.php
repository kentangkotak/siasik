<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select npdls_rinci.*,npdls_heder.nokontrak as nokontrak,npdls_heder.kodekegiatanblud as kodekegiatanblud
						from npdls_heder,npdls_rinci where npdls_rinci.nonpdls=npdls_heder.nonpdls and npdls_rinci.nonpdls='".$_GET['nonpd']."' ");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE REKENING BELANJA </th>
				<th>RINCIAN BELANJA </th>
				<th>ITEM BELANJA</th>
				<th>TOTAL TAGIHAN</th>
				<th>NOMINAL PEMBAYARAN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->rincianbelanja; ?></td>
				<td><?php echo $rs->itembelanja; ?></td>
				<td align="right"><?php echo rpzx($rs->totalls); ?></td>
				<td align="right"><?php echo rpzx($rs->nominalpembayaran); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nonpdls; ?>','<?php echo $rs->idserahterima_rinci; ?>',
					'<?php echo $rs->kodekegiatanblud; ?>','<?php echo $rs->koderek108; ?>','<?php echo $rs->nokontrak; ?>')">
					<img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->nominalpembayaran; $subtotalx=$subtotalx+$rs->totalls;}
			?>
			<tr>
				<td colspan="4" align="right">SUBTOTAL</td>
				<td align="right"><?php echo rpzx($subtotalx); ?></td>
				<td align="right"><?php echo rpzx($subtotal); ?></td>
				<td><?php echo rpzx($subtotalx-$subtotal); ?></td>
			</tr>
		</tbody>
</table>
<?php include("../../close.php"); ?>