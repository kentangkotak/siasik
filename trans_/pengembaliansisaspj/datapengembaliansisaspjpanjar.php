<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select pengembaliansisapanjar_heder.nopengembaliansisapanjar as nopengembaliansisapanjar,pengembaliansisapanjar_heder.tglpengembaliansisapanjar as tglpengembaliansisapanjar,
						pengembaliansisapanjar_heder.nospjpanjar as nospjpanjar,pengembaliansisapanjar_heder.pptk as pptk,pengembaliansisapanjar_heder.program as program,
						pengembaliansisapanjar_heder.kegiatan as kegiatan,pengembaliansisapanjar_heder.kegiatanblud as kegiatanblud,pengembaliansisapanjar_heder.kunci as kunci,
						sum(pengembaliansisapanjar_rinci.sisapanjar) as sisapanjar
						from pengembaliansisapanjar_heder LEFT join pengembaliansisapanjar_rinci on
						pengembaliansisapanjar_heder.nopengembaliansisapanjar=pengembaliansisapanjar_rinci.nopengembaliansisapanjar
						where year(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)='".$_SESSION["anggaran_tahun"]."' group by pengembaliansisapanjar_heder.nopengembaliansisapanjar");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. PENGEMBALIAN SISA PANJAR</th>
				<th align="center">TGL PENGEMBALIAN SISA PANJAR</th>
				<th align="center">NO. SPJ PANJAR</th>
				<th align="center">PPTK</th>
				<th align="center">PROGRAM</th>
				<th align="center">KEGIATAN</th>
				<th align="center">KEGIATAN BLUD</th>
				<th align="center">SISA PANJAR</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formpengembaliansisaspjpanjar('<?php echo $rs->nopengembaliansisapanjar; ?>');"><?php echo $rs->nopengembaliansisapanjar; ?></a></td>
				<td><?php echo out_tanggal('-',$rs->tglpengembaliansisapanjar); ?></td>
				<td><?php echo $rs->nospjpanjar; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo rpzx($rs->sisapanjar); ?></td>
				<?php if($rs->kunci == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->nopengembaliansisapanjar; ?>','<?php echo $rs->nospjpanjar; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
						<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->nospjpanjar; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
				<?php }else{ ?>
					<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
						<td>
							<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->nospjpanjar; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
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