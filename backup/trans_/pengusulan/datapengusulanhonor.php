<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from usulanHonor_h where year(tglTransaksi)='".$_SESSION["anggaran_tahun"]."' ");
	$i=1;
?>
<br />
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>KEGIATAN BLUD </th>
				<th>NAMA RUANGAN </th>
				<th>TANGGAL </th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formpengusulanhonor('<?php echo $rs->notrans; ?>');"><?php echo $rs->notrans; ?></a></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->ruangan; ?></td>
				<td><?php echo $rs->tglTransaksi; ?></td>
				<td><input type="button" value="Hapus" onclick="hapusHeader('<?php echo $rs->notrans; ?>');"></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>