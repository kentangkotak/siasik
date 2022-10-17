<div id='cariusulancontent'>
<?php include "../../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
		$sql=$conn->query("select * from mappingpptkkegiatan where bidang like '%".$usulantxt."%' and tahun='".$_SESSION["anggaran_tahun"]."' group by kodebidang");
	
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>BIDANG</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->bidang; ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihbidang('<?php echo $rs->kodebidang;?>','<?php echo $rs->bidang;?>')">
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