<?php include("../../conn.php"); ?>
<?php
	$sql=$conn_musrenbang->query("select rs7.rs1 as noverif,rs7.rs2 as nousulan,rs7.rs2 as nousulan,rs7.rs6 as kodejenisusulan,rs2.rs2 as jenisusulan,rs7.rs5 as koderuangan,rs3.rs2 as ruangan,rs7.rs7 as tahun,
rs8.rs2 as kodeusulan,rs1.rs2 as usulan,rs8.rs3 as jumlah,rs8.rs6 as keterangan,rs8.rs7 as cito,rs1.rs5 as satuan
from rs7,rs8,rs1,rs2,rs3
where rs7.rs1=rs8.rs1 and rs7.rs1=rs8.rs1 and rs7.rs6=rs2.rs1 and rs7.rs5=rs3.rs1 and rs8.rs2=rs1.rs1 and rs7.rs8='1' 
and rs7.rs7='2019' and rs7.rs6='7'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE VERIF </th>
				<th>KODE USULAN </th>
				<th>RUANGAN</th>
				<th>JENIS USULAN</th>
				<th>TAHUN</th>
				<th>USULAN</th>
				<th>JUMLAH</th>
				<th>KETERANGAN</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td nowrap="nowrap"><a href="javascript:void(0)"; style="color: #0000FF" onClick="formrencana('<?php echo $rs->noverif; ?>');"><?php echo $rs->noverif; ?></a></td>
				<td><?php echo $rs->nousulan; ?></td>
				<td><?php echo $rs->ruangan; ?></td>
				<td><?php echo $rs->jenisusulan; ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<td><?php echo $rs->usulan; ?></td>
				<td><?php echo $rs->jumlah; ?></td>
				<td><?php echo $rs->keterangan; ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>