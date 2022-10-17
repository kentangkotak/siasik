<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
		$sql=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodepptk as kodepptk,penyesesuaianperioritas_heder.pptk as pptk,
						penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,penyesesuaianperioritas_rinci.usulan as usulan,
						penyesesuaianperioritas_heder.kodekegiatan as kodekegiatanblud,penyesesuaianperioritas_heder.kegiatan as kegiatanblud
						from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
						where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
						and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and penyesesuaianperioritas_heder.kunci=1 and
						penyesesuaianperioritas_rinci.usulan like '%".$usulantxt."%' and penyesesuaianperioritas_heder.kodepptk='".$_GET['kodepptk']."' group by notrans");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
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
			<td><?php echo $rs->kegiatanblud; ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihkegiatanblud('<?php echo $rs->kodekegiatanblud;?>','<?php echo $rs->kegiatanblud; ?>')">
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