<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
	$sql=$conn->query("select * from penyesesuaianperioritas_heder where kegiatan like '%".$usulantxt."%' and kodekegiatan='".$_GET['kodekegiatanblud']."' and kunci=1 and year(tgltrans)= '".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>`
		<tr>
			<th>No.</th>
			<th>KEGIATAN BLUD</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->kegiatan; ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihkegiatanblud('<?php echo $rs->kodekegiatan;?>','<?php echo $rs->kegiatan; ?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/npdls/carinokontrak.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>
