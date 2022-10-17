<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npdpanjar_rinci where nonpdpanjar='".$_GET['nonpd']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE REKENING BELANJA </th>
				<th>RINCIAN BELANJA </th>
				<th>ITEM BELANJA</th>
				<th>TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->rincianbelanja50; ?></td>
				<td><?php echo $rs->itembelanja; ?></td>
				<td align="right"><?php echo rp($rs->totalpermintaanpanjar); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nonpdpanjar; ?>','<?php echo $rs->nopp; ?>','<?php echo $rs->nousulan; ?>',
					'<?php echo $rs->koderek50; ?>','<?php echo $rs->itembelanja; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->totalpermintaanpanjar;}
			?>
			<tr>
				<td colspan="4" align="right">SUBTOTAL</td>
				<td align="right"><?php echo rpzx($subtotal); ?></td>
			</tr>
		</tbody>
	</table>
<?php include("../../close.php"); ?>