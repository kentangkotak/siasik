<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
	if($_SESSION["anggaran_koderuangan"] == ''){
		$sql=$conn->query("select * from mappingpptkkegiatan where namapptk like '%".$usulantxt."%' and tahun='".$_SESSION["anggaran_tahun"]."' group by kodepptk");
	}else{
		$sql=$conn->query("select * from mappingpptkkegiatan where namapptk like '%".$usulantxt."%' and tahun='".$_SESSION["anggaran_tahun"]."'
		and kodebidang='".$_SESSION["anggaran_koderuangan"]."' group by kodepptk");
	}

$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>NIP</th>
			<th>NAMA</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->kodepptk; ?></td>
			<td><?php echo $rs->namapptk; ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihpptk('<?php echo $rs->kodepptk;?>','<?php echo $rs->namapptk; ?>'
				,'<?php echo $rs->kodebidang; ?>','<?php echo $rs->bidang; ?>','<?php echo $rs->kodekegiatan; ?>','<?php echo $rs->kegiatan; ?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/npdls/caripptk.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>