<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select spjpanjar_rinci.id as id,spjpanjar_heder.kodekegiatanblud as kodekegiatanblud,spjpanjar_rinci.koderek50 as koderek50,
						spjpanjar_rinci.rincianbelanja50 as rincianbelanja50,spjpanjar_heder.nospjpanjar as nospjpanjar,
						spjpanjar_rinci.itembelanja as itembelanja,spjpanjar_rinci.jumlahbelanjapanjar as jumlahbelanjapanjar,
						spjpanjar_rinci.iditembelanjanpd as iditembelanjanpd
						from spjpanjar_heder,spjpanjar_rinci
						where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and  spjpanjar_heder.nospjpanjar='".$_GET['nospjpanjar']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE REKENING BELANJA </th>
				<th>RINCIAN BELANJA </th>
				<th>ITEM BELANJA</th>
				<th>TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->rincianbelanja50; ?></td>
				<td><?php echo $rs->itembelanja; ?></td>
				<td align="right"><?php echo rp($rs->jumlahbelanjapanjar); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nospjpanjar; ?>','<?php echo $rs->iditembelanjanpd; ?>',
					'<?php echo $rs->kodekegiatanblud; ?>','<?php echo $rs->jumlahbelanjapanjar; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>