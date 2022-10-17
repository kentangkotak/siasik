<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select id,nonotapanjar,koderek50,rincianbelanja50,sum(total) as total from notapanjar_rinci where nonotapanjar='".$_GET['nonotapanjar']."' group by koderek50");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE</th>
				<th>RINCIAN BELANJA</th>
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
				<td align="right"><?php echo rpzx($rs->total); ?></td>
				<td><a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nonotapanjar; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>