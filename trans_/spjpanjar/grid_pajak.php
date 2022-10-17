<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from spjpanjar_pajak where nospjpanjar='".$_GET['nospjpanjar']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example2">
		<thead>
			<tr>
				<th>No.</th>
				<th>PPH 21</th>
				<th>PPH 22</th>
				<th>PPH 23</th>
				<th>PPH 25</th>
				<th>PASAL 4</th>
				<th>PPN PUSAT</th>
				<th>PAJAK DAERAH</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo rpzx($rs->pph21); ?></td>
				<td><?php echo rpzx($rs->pph22); ?></td>
				<td><?php echo rpzx($rs->pph23); ?></td>
				<td><?php echo rpzx($rs->pph25); ?></td>
				<td><?php echo rpzx($rs->pasal4); ?></td>
				<td><?php echo rpzx($rs->ppnpusat); ?></td>
				<td><?php echo rpzx($rs->pajakdaerah); ?></td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>