<?php include("../../conn.php"); ?>
<?php
	
	$sql=$conn->query("select * from transSpm");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO SPM </th>
				<th>TANGGAL SPM </th>
				<th>NPWP</th>
				<th>URAIAN PEKERJAAN</th>
				<th>NO SPP</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->noSpm; ?></td>
				<td><?php echo $rs->tglSpm; ?></td>
				<td><?php echo $rs->npwp; ?></td>
				<td><?php echo $rs->uraianPekerjaan; ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>