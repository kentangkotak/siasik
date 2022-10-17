<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from perubahanpagu where tahun='".$_SESSION["anggaran_tahun"]."' ");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOPERUBAHAN </th>
				<th>NOTRANS </th>
				<th>KEGIATANBLUD </th>
				<th>ANGGARAN</th>
				<th>PERUBAHAN</th>
				<th>SELISIH</th>
				<th>TAHUN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->noperubahan; ?></td>
				<td><?php echo $rs->notransawal; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td align="right"><?php echo rp($rs->total); ?></td>
				<td align="right"><?php echo rp($rs->perubahan); ?></td>
				<td align="right"><?php echo rp($rs->selisih); ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_perubahan_pagu('<?php echo $rs->noperubahan; ?>','<?php echo $rs->notransawal; ?>')">
					<img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>