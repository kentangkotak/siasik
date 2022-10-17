<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE PPTK </th>
				<th>NAMA PPTK </th>
				<th>KEGIATAN BLUD </th>
				<th>KODE RUANGAN/BIDANG</th>
				<th>RUANGAN/BIDANG</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->kodepptk; ?></td>
				<td><?php echo $rs->namapptk; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kodebidang; ?></td>
				<td><?php echo $rs->bidang; ?></td>
				<td><a href="javascript:void(0)" onclick="formmapingpptkkegiatan('<?php echo $rs->id; ?>')"><img src="images/edit.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>