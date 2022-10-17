<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from notapanjar_heder where year(tglnotapanjar)='".$_SESSION["anggaran_tahun"]."' ");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. NOTA PANJAR</th>
				<th align="center">TGL NOTA PANJAR</th>
				<th align="center">NO NPD</th>
				<th align="center">TRIWULAN</th>
				<th align="center">PPTK</th>
				<th align="center">PROGRAM</th>
				<th align="center">KEGIATAN</th>
				<th align="center">KEGIATAN BLUD</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formnotapanjar('<?php echo $rs->nonotapanjar; ?>');"><?php echo $rs->nonotapanjar; ?></a></td>
				<td><?php echo out_tanggal('-',$rs->tglnotapanjar); ?></td>
				<td><?php echo $rs->nonpd; ?></td>
				<td><?php echo $rs->triwulan; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<?php if($rs->kunci == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->nonotapanjar; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
						<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->nonotapanjar; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
				<?php }else{ ?>
					<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
						<td>
							<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->nonotapanjar; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
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