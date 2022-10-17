<?php include("../../conn.php"); ?>
<?php

if($_SESSION["anggaran_level"]=='SUPER'){
	$sql=$conn->query("select * from kontrakPengerjaan_header where year(tgltrans)='".$_SESSION["anggaran_tahun"]."' order by nokontrak desc");
}else{
	$sql=$conn->query("select kontrakPengerjaan_header.*,pptk.kodeBagian as koderuangan 
						from kontrakPengerjaan_header,pptk 
						where kontrakPengerjaan_header.kodepptk=pptk.nip and 
						pptk.kodeBagian='".$_SESSION["anggaran_koderuangan"]."' and year(kontrakPengerjaan_header.tgltrans)='".$_SESSION["anggaran_tahun"]."'
						group by kontrakPengerjaan_header.nokontrak order by nokontrak desc");	
}
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO TRANSAKSI </th>
				<th>PERUSAHAAN </th>
				<th>TGL MULAI KONTRAK</th>
				<th>TGL BERAKHIR KONTRAK</th>
				<th>PPTK</th>
				<th>PROGRAM</th>
				<th>KEGIATAN</th>
				<!--<th>URAIAN PEKERJAAN</th>
				<th>NILAI KEGIATAN</th>-->
				<th>NILAI KONTRAK</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formkontrakpekerjaan('<?php echo $rs->nokontrak; ?>');"><?php echo $rs->nokontrak; ?></a></td>
				<td><?php echo $rs->namaperusahaan; ?></td>
				<td><?php echo $rs->tglmulaikontrak; ?></td>
				<td><?php echo $rs->tglakhirkontrak; ?></td>
				<td><?php echo $rs->namapptk; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<!--<td><?php echo $rs->uraianpekerjaan; ?></td>
				<td><?php echo rp($rs->nilaikegiatan); ?></td>-->
				<td><?php echo rp($rs->nilaikontrak); ?></td>
					<?php if($rs->kunci==''){ ?>
						<td>
							<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->nokontrak; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
							<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->nokontrak; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>	
						</td>
					<?php }else{;?>
						<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
							<td>
								<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->nokontrak; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>
							</td>
						<?php }else{;?>
							<td>
								<img src="images/keyxx.png" width="20" height="20">
							</td>
						<?php };?>
					<?php };?>
				
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>