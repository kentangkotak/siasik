<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from anggaran_pendapatan_pak where tahun='".$_SESSION["anggaran_tahun"]."'");
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
				<?php if($rs->kunci==''){ ?>
				<td>
					<a href="javascript:void(0)" onclick="formpendapatan('<?php echo $rs->notrans; ?>')"><img src="images/edit.png" width="20" height="20"></a>
					<a href="javascript:void(0)" onclick="hapus('<?php echo $rs->notrans; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
					<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->notrans; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>	
				</td>
				<?php }else{;?>
				<td>
					<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->notrans; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
				</td>
				<?php };?>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>