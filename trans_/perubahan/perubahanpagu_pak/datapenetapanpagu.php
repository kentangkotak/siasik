<?php include("../../../conn.php"); ?>
<?php
if($_SESSION['anggaran_level'] == 'SUPER'){
	$sql=$conn->query("select * from penetapan_pagu_pak where tahun='".$_SESSION["anggaran_tahun"]."' ");
}else{
	$sql=$conn->query("select * from penetapan_pagu_pak where tahun='".$_SESSION["anggaran_tahun"]."' and namaorganisasi='".$_SESSION["anggaran_ruangan"]."'");
}
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>KEGIATANBLUD </th>
				<th>NILAI</th>
				<th>TAHUN</th>
				<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
				<th></th>
				<?php };?>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->notrans; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td align="right"><?php echo rpzx($rs->total); ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
					<?php if($rs->kunci == ''){ ?>
						<td>
							<a href="javascript:void(0)" onclick="formpenetapanpagu('<?php echo $rs->notrans; ?>','1')"><img src="images/edit.png" width="20" height="20"></a>
							<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->notrans; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
						</td>
					<?php }else{ ?>
						<td>
							<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->notrans; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
						</td>
					<?php } ?>
				<?php } ?>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>