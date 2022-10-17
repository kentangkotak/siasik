<?php include("../../conn.php"); ?>
<?php
if($_SESSION["anggaran_level"]=='SUPER'){
	$sql=$conn->query("select * from serahterima_heder where year(tgltrans)='".$_SESSION["anggaran_tahun"]."' ");
}else{
	$sql=$conn->query("select serahterima_heder.*,pptk.kodeBagian from serahterima_heder,pptk 
						where serahterima_heder.kodepptk=pptk.nip and year(serahterima_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and
						pptk.kodeBagian='".$_SESSION["anggaran_koderuangan"]."' group by serahterima_heder.noserahterimapekerjaan");
}
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. SERAH TERIMAH</th>
				<th align="center">NO. KONTRAK</th>
				<th align="center">TGL TRANSAKSI</th>
				<th align="center">NAMA PERUSAHAAN</th>
				<th align="center">PPTK</th>
				<th align="center">PROGRAM</th>
				<th align="center">KEGIATAN</th>
				<th align="center">KEGIATAN BLUD</th>
				<th align="center">NILAI KONTRAK</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formserahterima('<?php echo $rs->noserahterimapekerjaan; ?>','<?php echo $rs->kodekegiatanblud; ?>');"><?php echo $rs->noserahterimapekerjaan; ?></a></td>
				<td><?php echo $rs->nokontrak; ?></td>
				<td><?php echo out_tanggal('-',$rs->tgltrans); ?></td>
				<td><?php echo $rs->namaperusahaan; ?></td>
				<td><?php echo $rs->namapptk; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo rpzx($rs->totalpermintaanls); ?></td>
				<?php if($rs->kunci == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->noserahterimapekerjaan; ?>','<?php echo $rs->nokontrak; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
						<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->noserahterimapekerjaan; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
				<?php }else{ ?>
					<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
						<td>
							<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->noserahterimapekerjaan; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
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