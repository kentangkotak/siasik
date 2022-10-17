<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from pengembalianpanjar_heder where year(tglpengembalianpanjar)='".$_SESSION["anggaran_tahun"]."' ");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. PENGEMBALIAN PANJAR</th>
				<th align="center">TGL PENGEMBALIAN PANJAR</th>
				<th align="center">NO. SPJ PANJAR</th>
				<th align="center">PPTK</th>
				<th align="center">PROGRAM</th>
				<th align="center">KEGIATAN</th>
				<th align="center">KEGIATAN BLUD</th>
				<th align="center">PIHAK KETIGA</th>
				<th align="center">KETERANGAN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formpengembalianpanjar('<?php echo $rs->nopengembalianpanjar; ?>');"><?php echo $rs->nopengembalianpanjar; ?></a></td>
				<td><?php echo out_tanggal('-',$rs->tglpengembalianpanjar); ?></td>
				<td><?php echo $rs->notapanjar; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo $rs->pihakketiga; ?></td>
				<td><?php echo $rs->keterangan; ?></td>
				<?php if($rs->kunci == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->nopengembalianpanjar; ?>','<?php echo $rs->nokontrak; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
						<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->nopengembalianpanjar; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
				<?php }else{ ?>
					<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
						<td>
							<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->nopengembalianpanjar; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
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