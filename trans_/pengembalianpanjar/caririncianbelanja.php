<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
		$sql=$conn->query("select * from npdpanjar_rinci where nonpdpanjar='".$_GET['nonpdpanjar']."' and rincianbelanja50 like '%".$usulantxt."%'");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>KODEREK 50</th>
			<th>URAIAN 50</th>
			<th>ITEMBELANJA</th>
			<th>VOLUME</th>
			<th>SATUAN</th>
			<th>HARGA</th>
			<th>TOTAL</th>
			<th>VOLUME PERMINTAAN PANJAR</th>
			<th>HARGA PERMINTAAN PANJAR</th>
			<th>TOTAL PERMINTAAN PANJAR</th>
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
			<td><?php echo $rs->volume; ?></td>
			<td><?php echo $rs->satuan; ?></td>
			<td><?php echo rpzx($rs->harga); ?></td>
			<td><?php echo rpzx($rs->total); ?></td>
			<td><?php echo $rs->volumepermintaanpanjar; ?></td>
			<td><?php echo rpzx($rs->hargapermintaanpanjar); ?></td>
			<td><?php echo rpzx($rs->totalpermintaanpanjar); ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilirincianbelanja('<?php echo $rs->nopp;?>','<?php echo $rs->nousulan; ?>',
				'<?php echo $rs->koderek50; ?>','<?php echo $rs->rincianbelanja50; ?>','<?php echo $rs->idpp; ?>','<?php echo $rs->itembelanja; ?>',
				'<?php echo $rs->volume; ?>','<?php echo $rs->satuan; ?>','<?php echo $rs->harga; ?>',
				'<?php echo $rs->total; ?>','<?php echo $rs->volumepermintaanpanjar; ?>','<?php echo $rs->hargapermintaanpanjar; ?>','<?php echo $rs->totalpermintaanpanjar; ?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/npdls/caripenerima.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>