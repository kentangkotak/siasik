<?php include("../../../conn.php"); ?>
<?php
	
	$sql=$conn->query("select * from transsppup where year(tglTrans)='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO SPP UP </th>
				<th>TANGGAL TRANSAKSI </th>
				<th>BENDAHARA PENGELUARAN</th>
				<th>JUMLAH SPP</th>
				<th>BANK</th>
				<th>NO REK</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nosppup; ?></td>
				<td><?php echo $rs->tglTrans; ?></td>
				<td><?php echo $rs->bendaharaKeluar; ?></td>
				<td><?php echo rp($rs->jumlahspp); ?></td>
				<td><?php echo $rs->bank; ?></td>
				<td><?php echo $rs->kodeRek; ?></td>
				<td>
				<?php if($rs->kunci == ''){ ;?>
					<a href="javascript:void(0)" onclick="cetaksppup('<?php echo $rs->nosppup; ?>','<?php echo $i ?>')"class="btn btn-primary btn-xs"><i class="fa fa-print" ></i> Print</a>
					<a href="javascript:void(0)" onclick="key('<?php echo $rs->nosppup; ?>','<?php echo $i ?>')"class="btn btn-primary btn-xs"><i class="fa fa-send" ></i> Kirim </a>
				<?php }else{ ?>
					<a href="javascript:void(0)" onclick="cetaksppup('<?php echo $rs->nosppup; ?>','<?php echo $i ?>')"class="btn btn-primary btn-xs"><i class="fa fa-print" ></i> Print</a>
				<?php } ?>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>