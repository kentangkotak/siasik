<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select serahterima50.*,serahterima_heder.kodekegiatanblud as kodeblud from serahterima50,serahterima_heder 
						where serahterima50.noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."' and 
						serahterima50.noserahterimapekerjaan=serahterima_heder.noserahterimapekerjaan");
	$i=1;
?>

<table class="table table-hover table-bordered table table-striped" id="dataTables-example" width="100%">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE REKENING 50</th>
				<th>URAIAN KODE REKENING 50</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->uraianrek50; ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_rekekning50('<?php echo $rs->id; ?>','<?php echo $rs->noserahterimapekerjaan; ?>',
					'<?php echo $rs->kodeblud; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php $i++;} 
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>