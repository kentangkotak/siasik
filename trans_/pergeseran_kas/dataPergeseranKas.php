<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select pergeseranTheder.notrans as notrans,pergeseranTheder.tgltrans as tgltrans,pergeseranTheder.jenis as jenis,sum(pergeseranTrinci.jumlah) as jumlah,
						pergeseranTheder.kunci as kunci
						FROM pergeseranTheder left join pergeseranTrinci
						on pergeseranTheder.notrans=pergeseranTrinci.notrans where year(pergeseranTheder.tgltrans)='".$_SESSION["anggaran_tahun"]."' group by pergeseranTheder.notrans");
						
	
	$i=1;
?>
<br />
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>TANGGAL TRANSAKSI </th>
				<th>JENIS </th>
				<th>JUMLAH PERGESERAN </th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ 
					if($rs->jenis == 'Bank Ke Kas'){
						$jenis=1;
					}else{
						$jenis=2;
					}
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formPergeseranKas('<?php echo $rs->notrans; ?>','<?php echo $jenis; ?>');"><?php echo $rs->notrans; ?></a></td>
				<td><?php echo $rs->tgltrans; ?></td>
				<td><?php echo $rs->jenis; ?></td>
				<td><?php echo rpy($rs->jumlah); ?></td>
				<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
					<?php if($rs->kunci == ''){ ?>
						<td>
							 <a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->notrans; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
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
<?php include("../../close.php"); ?>