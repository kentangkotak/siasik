<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npkpanjar_rinci where nonpk='".$_GET['nonpk']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO NPD</th>
				<th>TANGGAL</th>
				<th>KEGIATAN</th>
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
				<td><?php echo out_tanggal('-',$rs->tglnpd); ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td align="right"><?php echo rp($rs->total); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nonpk; ?>','<?php echo $rs->nonpd; ?>','<?php echo $rs->kegiatan; ?>',
					'<?php echo $rs->kodekegiatanblud; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>