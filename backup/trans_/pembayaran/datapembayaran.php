<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from rs6");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO. TRANSAKSI </th>
				<th>KODE REKENING</th>
				<th>UNTUK PEMBAYARAN</th>
				<th>NOMINAL </th>
				<th>PEMBAYARAN KE</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->rs1; ?></td>
				<td><?php echo $rs->rs2; ?></td>
				<td><?php echo $rs->rs3; ?></td>
				<td><?php echo $rs->rs4; ?></td>
				<td><?php echo $rs->rs5; ?></td>
				<td><?php if($rs->rs8==''){ ;?>
								<a href="javascript:void(0)" onclick="cetakkwitansi('<?php echo $rs->rs1; ?>')"><img src="images/printer.jpg" width="20" height="20"></a> 
					<?php } ?>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>