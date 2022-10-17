<div id='cariusulancontent'>
<?php include "../../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
		$sql=$conn->query("select * from mappingpptkkegiatan where namapptk like '%".$usulantxt."%' 
							and tahun='".$_SESSION["anggaran_tahun"]."' and kodebidang='".$_GET['kodebidang']."' group by kodepptk");
	
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>NIP</th>
			<th>NAMA PPTK</th>
			<th>BIDANG</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->kodepptk; ?></td>
			<td><?php echo $rs->namapptk; ?></td>
			<td><?php echo $rs->bidang; ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihpptk('<?php echo $rs->kodepptk;?>','<?php echo $rs->namapptk;?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('lapo_/laporanmanajerial/anggaranperkegiatan/caribidang.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../../close.php";?>
</div>