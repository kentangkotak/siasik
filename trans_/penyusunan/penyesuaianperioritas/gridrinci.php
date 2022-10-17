<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from penyesesuaianperioritas_rinci where notrans='".$_GET['notrans']."'");
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
				<th>TOTAL</th>
				<th>USULAN DIACC</th>
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
				<td><?php echo $rs->jumlahacc; ?></td>
				<td><a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->notrans; ?>','<?php echo $rs->nousulan; ?>','<?php echo $rs->usulan; ?>')" data-toggle="tooltip" data-placement="left" title="Hapus Data Ini">
						<img src="images/hapus.png" width="20" height="20">
					</a>
					<a href="javascript:void(0)" onclick="edit_108('<?php echo $rs->id; ?>','<?php echo $rs->notrans; ?>','<?php echo $rs->usulan; ?>','<?php echo $rs->volume; ?>',
						'<?php echo rpz($rs->harga); ?>','<?php echo rpz($rs->nilai); ?>','<?php echo $rs->koderek108; ?>','<?php echo $rs->uraian108; ?>','<?php echo $rs->koderek50; ?>','<?php echo $rs->uraian50; ?>',
						'<?php echo $rs->jumlahacc; ?>','<?php echo $rs->satuan; ?>','<?php echo $rs->nousulan; ?>')" data-toggle="tooltip" data-placement="left" title="Edit Kode Rekening 108 Atau 50">
						<img src="images/edit.png" width="20" height="20">
					</a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>