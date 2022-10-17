<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from serahterima_rinci where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<div class="table-responsive">
		<table class="table table-hover table-bordered table table-striped" id="dataTables-example2" width="100%">
			<thead>
				<tr>
					<th>No.</th>
					<th>NO PENERIMAAN </th>
					<th>TAGIHAN PENERIMAAN</th>
					<th>TOTAL</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php while($rs=$sql->fetch_object()){ ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td align="center"><a href="javascript:void(0)"; onClick="view_detail_rinci_faktur('<?php echo $rs->nopenerimaan; ?>')"><?php echo $rs->nopenerimaan; ?></a></td>
					<td align="right"><?php echo rpzx($rs->tagihanpenerimaan); ?></td>
					<td align="right"><?php echo rpzx($rs->tagihanfaktur); ?></td>
					<td>
						<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->noserahterimapekerjaan; ?>','<?php echo $rs->nopenerimaan; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
					</td>
				</tr>
				<?php $i++;} 
				?>
			</tbody>
		</table>
</div>
<?php include("../../close.php"); ?>