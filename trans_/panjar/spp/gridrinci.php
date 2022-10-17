<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from transsppup_rinci where nosppup='".$_GET['nosppup']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO NPD PANJAR</th>
				<th>TGL NPD </th>
				<th>TRIWULAN</th>
				<th>PPTK</th>
				<th>KEGIATAN BLUD</th>
				<th>TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nonpd; ?></td>
				<td><?php echo $rs->tglnpd; ?></td>
				<td><?php echo $rs->triwulan; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
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