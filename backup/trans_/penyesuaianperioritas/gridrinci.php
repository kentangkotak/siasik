<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from penyesesuaianperioritas_rinci where notrans='".$_GET['notrans']."'");
	$i=1;
?>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>USULAN </th>
				<th>VOLUME </th>
				<th>HARGA</th>
				<th>NILAI</th>
				<th>USULAN DIACC</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->usulan; ?></td>
				<td><?php echo $rs->volume; ?></td>
				<td><?php echo rp($rs->harga); ?></td>
				<td><?php echo rp($rs->nilai); ?></td>
				<td><?php echo $rs->jumlahacc; ?></td>
				<td><a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->notrans; ?>','<?php echo $rs->notransmusrenbang; ?>','<?php echo $rs->kodeusulan; ?>','<?php echo $rs->koderuanganusulan; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>