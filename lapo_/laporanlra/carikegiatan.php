<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
		$sql=$conn->query("select * from mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' and kodebidang='".$_GET['kodebidang']."'");
	
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>KEGIATAN</th>
			<th>PPTK</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->kegiatan; ?></td>
			<td><?php echo $rs->namapptk; ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihkegiatan('<?php echo $rs->kodekegiatan;?>','<?php echo $rs->kegiatan;?>')">
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
<?php include "../../close.php";?>
</div>