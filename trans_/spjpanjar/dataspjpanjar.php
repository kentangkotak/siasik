<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select spjpanjar_heder.nospjpanjar as nospjpanjar,spjpanjar_heder.tglspjpanjar as tglspjpanjar,spjpanjar_heder.notapanjar as notapanjar,spjpanjar_heder.namapptk as pptk,
						spjpanjar_heder.program as program,spjpanjar_heder.kegiatan as kegiatan,spjpanjar_heder.kegiatanblud as kegiatanblud,spjpanjar_heder.pihakketiga as pihakketiga,
						spjpanjar_heder.keterangan as keterangan,spjpanjar_heder.kunci as kunci,round(sum(spjpanjar_rinci.jumlahbelanjapanjar),2) as total
						from spjpanjar_heder left join spjpanjar_rinci
						on spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar where year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' 
						group by spjpanjar_heder.nospjpanjar");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. SPJ PANJAR</th>
				<th align="center">TGL SPJ PANJAR</th>
				<th align="center">NOTA PANJAR</th>
				<th align="center">PPTK</th>
				<th align="center">PROGRAM</th>
				<th align="center">KEGIATAN</th>
				<th align="center">KEGIATAN BLUD</th>
				<th align="center">PIHAK KETIGA</th>
				<th align="center">KETERANGAN</th>
				<th align="center">TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formspjpanjar('<?php echo $rs->nospjpanjar; ?>');"><?php echo $rs->nospjpanjar; ?></a></td>
				<td><?php echo out_tanggal('-',$rs->tglspjpanjar); ?></td>
				<td><?php echo $rs->notapanjar; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo $rs->pihakketiga; ?></td>
				<td><?php echo $rs->keterangan; ?></td>
				<td><?php echo rpzx($rs->total); ?></td>
				<?php if($rs->kunci == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->nospjpanjar; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
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