<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select nopenerimaan,kodeobat,namaobat,jumlah,satuan,uraian,total,round(nominalpajak) as nominalpajakx,if(nominalpajak > 0,round(total+(total*(nominalpajak/100)),2),
						round(total,2)) as hargasetelahpajak from(
								select nopenerimaan,kodeobat,namaobat,if(jumlahsatuanbesar > 0, sum(jumlahsatuanbesar),sum(jumlahsatuankecil))as jumlah,
								satuan as satuan,uraian,
								if(jumlahsatuanbesar > 0, sum(jumlahsatuanbesar*jumlahppn),sum(jumlahsatuankecil*jumlahppn))as total,
								nominalpajak as nominalpajak
								from serahterima_penerimaanrinci 
								where nopenerimaan='".$_GET['nopenerimaan']."' group by kodeobat) 
						as wew");
	$i=1;
?>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO PENERIMAAN </th>
				<th>NAMA OBAT</th>
				<th>JUMLAH </th>
				<th>SATUAN </th>
				<th>JENIS </th>
				<th>TOTAL</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><?php echo $rs->nopenerimaan; ?></td>
				<td align="right"><?php echo $rs->namaobat; ?></td>
				<td align="right"><?php echo $rs->jumlah?></td>
				<td align="right"><?php echo $rs->satuan; ?></td>
				<td align="right"><?php echo $rs->uraian; ?></td>
				<td align="right">&nbsp;<?php echo rp($rs->hargasetelahpajak);?>&nbsp;</td>
			</tr>
			<?php $i++;$total=$total+$rs->hargasetelahpajak;} 
			?>
			<tr>
				<td colspan="6" align="right">SUBTOTAL</td>
				<td><?php echo rpzx($total); ?></td>
			</tr>
		</tbody>
	</table>
<?php include("../../close.php"); ?>