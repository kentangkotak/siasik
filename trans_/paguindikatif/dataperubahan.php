<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from perubahan where tahun='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOPERUBAHAN </th>
				<th>NOTRANS </th>
				<th>KODE REKENING BLUD </th>
				<th>URAIAN REKENING</th>
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
				<td><?php echo $rs->koderekeningblud; ?></td>
				<td><?php echo $rs->uraian_rekening; ?></td>
				<td><?php echo rp($rs->nilai); ?></td>
				<td><?php echo rp($rs->nilaiperubahan); ?></td>
				<td><?php echo rp($rs->selisih); ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_perubahan('<?php echo $rs->notransawal; ?>')">
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