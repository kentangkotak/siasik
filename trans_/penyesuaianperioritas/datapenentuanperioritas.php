<?php include("../../conn.php"); ?>
<?php
if($_SESSION['anggaran_level'] == 'SUPER'){
	$sql=$conn->query("select * from penyesesuaianperioritas_heder where year(tgltrans)='".$_SESSION["anggaran_tahun"]."'  ");
}else{
	$sql=$conn->query("select * from penyesesuaianperioritas_heder where year(tgltrans)='".$_SESSION["anggaran_tahun"]."'  and namabidang='".$_SESSION["anggaran_ruangan"]."'");
}
	$i=1;
?>
<br />
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>NAMA BIDANG </th>
				<th>NAMA PPTK </th>
				<th>KEGIATAN </th>
				<th>TANGGAL </th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formpenentuanperioritas('<?php echo $rs->notrans; ?>');"><?php echo $rs->notrans; ?></a></td>
				<td><?php echo $rs->namabidang; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->tgltrans; ?></td>
				<?php if($rs->kunci == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->notrans; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
						<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->notrans; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
				<?php }else{ ?>
					<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
						<td>
							<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->notrans; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
						</td>
					<?php }else{ ?>
						<td>
							<img src="images/keyxx.png" width="20" height="20">
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
<?php include("../../close.php"); ?>