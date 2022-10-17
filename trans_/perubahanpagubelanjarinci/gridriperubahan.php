<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from perubahanpagubelanjarinci where noperubahan='".$_GET['noperubahan']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>USULAN </th>
				<th>VOLUME </th>
				<th>HARGA</th>
				<th>NILAI</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->usulan; ?></td>
				<td><?php echo $rs->volume.' '.$rs->satuan; ?></td>
				<td><?php echo rp($rs->harga); ?></td>
				<td><?php echo rp($rs->nilai); ?></td>
				<td><a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->notrans; ?>','<?php echo $rs->nousulan; ?>','<?php echo $rs->usulan; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>