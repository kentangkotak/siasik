<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from anggaran_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>BIDANG </th>
				<th>KODE REKENING BLUD </th>
				<th>URAIAN REKENING</th>
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
				<td><?php echo $rs->bidang; ?></td>
				<td><?php echo $rs->koderekeningblud; ?></td>
				<td><?php echo $rs->uraian_rekening; ?></td>
				<td><?php echo rp($rs->nilai); ?></td>
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