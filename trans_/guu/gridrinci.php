<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from sppgu_rinci where nosppgu='".$_GET['nosppgu']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO. SPJ</th>
				<th>TANGGAL SPJ</th>
				<th>KEGIATAN</th>
				<th>KEGIATAN BLUD</th>
				<th>NILAI</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nospj; ?></td>
				<td><?php echo $rs->tglspj; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td align="right"><?php echo rp($rs->nilai); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nosppgu; ?>','<?php echo $rs->nospj; ?>')">
					<img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>