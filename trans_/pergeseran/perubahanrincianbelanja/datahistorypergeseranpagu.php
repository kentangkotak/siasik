<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from perubahanrincianbelanja where year(tglperubahan)='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOPERUBAHAN </th>
				<th>NOTRANS </th>
				<th>TGL PERUBAHAN </th>
				<th>KODE REKENING 50 </th>
				<th>URAIAN REKENING</th>
				<th>USULAN</th>
				<th>ANGGARAN</th>
				<th>PERUBAHAN</th>
				<th>SELISIH</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->noperubahan; ?></td>
				<td><?php echo $rs->notrans; ?></td>
				<td><?php echo $rs->tglperubahan; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->uraian50; ?></td>
				<td><?php echo $rs->usulan; ?></td>
				<td><?php echo rp($rs->nilai); ?></td>
				<td><?php echo rp($rs->totalbaru); ?></td>
				<td><?php echo rp($rs->selisih); ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>