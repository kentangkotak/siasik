<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from kontrakPengerjaan_rinci where nokontrak='".$_GET['nokontrak']."'");
	$i=1;
?> 
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped bulk_action " id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO. KONTRAK</th>
				<th>RINCIAN BELANJA</th>
				<th>NILAI</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nofaktur; ?></td>
				<td><?php echo $rs->rincianbelanja; ?></td>
				<td><?php echo rp($rs->nilai); ?></td>
				<td>
				<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nokontrak; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++; $total=$total+$rs->nilai;}
			?>
			
		</tbody>
	</table>
<?php include("../../close.php"); ?>