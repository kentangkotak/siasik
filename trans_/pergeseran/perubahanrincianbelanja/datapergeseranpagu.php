<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from perubahanrincianbelanja where year(tglperubahan)='".$_SESSION["anggaran_tahun"]."'");
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
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formpenentuanperioritasx('<?php echo $rs->noperubahan; ?>','<?php echo $rs->notrans; ?>');"><?php echo $rs->noperubahan; ?></a></td>
				<td><?php echo $rs->notrans; ?></td>
				<td><?php echo $rs->tglperubahan; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->uraian50; ?></td>
				<td><?php echo $rs->usulan; ?></td>
				<td><?php echo rp($rs->nilai); ?></td>
				<td><?php echo rp($rs->totalbaru); ?></td>
				<td><?php echo rp($rs->selisih); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_perubahan_rincianbelanja('<?php echo $rs->id; ?>','<?php echo $rs->idpp; ?>')">
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