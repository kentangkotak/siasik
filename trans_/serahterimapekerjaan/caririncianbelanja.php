<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
penyesesuaianperioritas_rinci.harga as harga,penyesesuaianperioritas_rinci.nilai as total,penyesesuaianperioritas_rinci.nousulan as nousulan,
penyesesuaianperioritas_rinci.id as idpp,penyesesuaianperioritas_rinci.usulan as itembelanja,'' as totalkepake
from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
and penyesesuaianperioritas_rinci.kunci=''
and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatanblud"]."'
and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' group by koderek50");
$i=1;
?>
<input type='hidden' name='koderek50' id='koderek50' value='<?php echo $_GET['koderek50']; ?>'>
<input type='hidden' name=kodekegiatanblud' id='kodekegiatanblud' value='<?php echo $_GET['kodekegiatanblud']; ?>'>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>KODE</th>
			<th>URAIAN</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->koderek50; ?></td>
			<td><?php echo $rs->uraian50; ?></td>
			<td><input type="button" value="PILIH" onclick="pilihcarikode50('<?php echo $rs->koderek50;?>','<?php echo $rs->uraian50; ?>');"></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		koderek50 = document.querySelector('#koderek50').value;
		kodekegiatanblud = document.querySelector('#kodekegiatanblud').value;
		$.get('trans_/npdPanjar/cariitembelanja.php',{
			usulantxt:usulantxt,
			koderek50:koderek50,
			kodekegiatanblud:kodekegiatanblud,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>