<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npdls_rinci where nonpdls='".$_GET['nonpdls']."'");
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
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->rincianbelanja; ?></td>
				<td><?php echo $rs->itembelanja; ?></td>
				<td align="right"><?php echo rp($rs->nominalpembayaran); ?></td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>