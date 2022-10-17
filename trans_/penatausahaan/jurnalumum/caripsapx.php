<div id='cariusulancontent'>
<?php include "../../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select concat_ws('.',kode1,kode2,kode3,kode4) as kode,uraian as uraian 
						from akun_psap13 
						where uraian like '%".$usulantxt."%' and kode4<>''");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>KODE PSAP 13</th>
			<th>URAIAN PSAP13</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->kode; ?></td>
			<td><?php echo $rs->uraian; ?></td>
			<td><input type="button" value="PILIH" onclick="pilihkode('<?php echo $rs->kode;?>','<?php echo $rs->uraian; ?>');"></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/penatausahaan/jurnalumum/caripsapx.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../../close.php";?>
</div>