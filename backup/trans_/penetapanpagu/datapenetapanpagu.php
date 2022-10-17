<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from penetapan_pagu where tahun='".$_SESSION["anggaran_tahun"]."' ");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>KEGIATANBLUD </th>
				<th>NILAI</th>
				<th>TAHUN</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->notrans; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo rp($rs->total); ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<td><input type="button" value="Hapus" onclick="hapus('<?php echo $rs->notrans; ?>');"></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>