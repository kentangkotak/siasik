<?php include("../../conn.php"); ?>
<?php
$conn_musrenbang = new mysqli("localhost","admin","alam02018sa","musrenbang");

	$sql=$conn_musrenbang->query("select rs5.id as id,rs5.rs2 as kode,rs1.rs2 as usulan,rs5.rs3 as jumlah,rs5.rs8 as keterangan,rs5.rs9 as cito,rs1.rs5 as satuan
						from rs4,rs5,rs1 
						where rs4.rs1=rs5.rs1 and rs5.rs2=rs1.rs1 order by rs5.rs9 desc");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">USULAN</th>
				<th align="center">JUMLAH</th>
				<th align="center">SATUAN</th>
				<th align="center">KETERANGAN</th>
				<th align="center">PRIORITAS</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->usulan; ?></td>
				<td align="right"><?php echo $rs->jumlah; ?></td>
				<td><?php echo $rs->satuan; ?></td>
				<td><?php echo $rs->keterangan; ?></td>
				<td><?php if($rs->cito!=''){ echo "<img src='images/centang.png' width='20' height='20'>";} ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>