<div id='cariusulancontent'>
<?php include "../../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select concat_ws('.',kode1,kode2,kode3,kode4,kode5,kode6) kode,uraian 
						from akun_permendagri50 where uraian like '%".$usulantxt."%' and kode6<>'' and kode1=5");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>KODE REKENING 50</th>
			<th>URAIAN 50</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->kode; ?></td>
			<td><?php echo $rs->uraian; ?></td>

			<td>
				<input type="button" value="PILIH" onclick="pilihrekening50('<?php echo trim($rs->kode);?>','<?php echo str_replace(array("\n", "\r"), '', $rs->uraian);;?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/penyusunan/penyesuaianperioritas/carirekening50.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../../close.php";?>
</div>