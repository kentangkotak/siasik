<?php include("../../conn.php"); ?>
<?php
	
	$sql=$conn->query("select * from transSpm where year(tglSpm)='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO SPM </th>
				<th>NO SPP</th>
				<th>NILAI</th>
				<th>TANGGAL SPM </th>
				<th>URAIAN PEKERJAAN</th>
				<th>NPWP</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->noSpm; ?></td>
				<td><?php echo $rs->nosppup; ?></td>
				<td><?php echo rp($rs->jumlahspp); ?></td>
				<td><?php echo $rs->tglSpm; ?></td>
				<td><?php echo $rs->uraianPekerjaan; ?></td>
				<td><?php echo $rs->npwp; ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>