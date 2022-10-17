<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
		$sql=$conn->query("select * from pihak_ketiga where nama like '%".$usulantxt."%' and hidden<>1 ");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>PIHAK KETIGA</th>
			<th>ALAMAT</th>
			<th>TELEPON</th>
			<th>NPWP</th>
			<th>NO. REKENING</th>
			<th>BANK</th>
			<th>CONTACT PERSON</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nama; ?></td>
			<td><?php echo $rs->alamat; ?></td>
			<td><?php echo $rs->telepon; ?></td>
			<td><?php echo $rs->npwp; ?></td>
			<td><?php echo $rs->norek; ?></td>
			<td><?php echo $rs->bank; ?></td>
			<td><?php echo $rs->cp; ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihpihakketiga('<?php echo $rs->kode;?>','<?php echo $rs->nama; ?>',
				'<?php echo $rs->alamat; ?>','<?php echo $rs->telepon; ?>','<?php echo $rs->npwp; ?>','<?php echo $rs->norek; ?>',
				'<?php echo $rs->bank; ?>','<?php echo $rs->cp; ?>','<?php echo $rs->kodemapingrs; ?>','<?php echo $rs->namasuplier; ?>')">
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