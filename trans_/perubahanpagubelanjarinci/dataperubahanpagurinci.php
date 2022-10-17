<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select *,sum(nilai) as total from perubahanpagubelanjarinci 
								where year(tglperubahan)='".$_SESSION["anggaran_tahun"]."' group by noperubahan");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NOPERUBAHAN</th>
				<th align="center">TGL PERUBAHAN</th>
				<th align="center">TOTAL PERUBAHAN</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->noperubahan; ?></td>
				<td><?php echo $rs->tglperubahan; ?></td>
				<td align="right"><?php echo rpz($rs->total); ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>