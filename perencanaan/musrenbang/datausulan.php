<?php include("../../conn.php"); ?>
<?php
	$sql=$conn_musrenbang->query("select rs5.rs1 as kode,rs3.rs2 as ruangan,rs2.rs2 as jenisusulan,rs4.rs3 as tahun,rs1.rs2 as usulan,rs5.rs3 as jumlah,rs5.rs8 as keterangan 
from rs1,rs2,rs3,rs4,rs5
where rs4.rs1=rs5.rs1 AND rs4.rs2=rs3.rs1 and rs4.rs5=rs2.rs1 and rs5.rs2=rs1.rs1 and rs4.rs3>'2018' AND rs4.rs5='7' order by rs4.rs1 desc");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
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
				<td nowrap="nowrap"><?php echo $rs->kode; ?></td>
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