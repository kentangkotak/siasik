<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from usulanHonor_r_pak where notrans='".$_GET['notrans']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>KETERANGAN</th>
				<th>KODE REKENING 50</th>
				<th>URAIAN REKEKENING 50</th>
				<th>VOLUME</th>
				<th>HARGA</th>
				<th>NILAI</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->keterangan; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->uraian50; ?></td>
				<td><?php echo round($rs->volume).' '.$rs->satuan; ?></td>
				<td><?php echo rpzx($rs->harga); ?></td>
				<td><?php echo rpzx($rs->nilai); ?></td>
				<td><a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->notrans; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>