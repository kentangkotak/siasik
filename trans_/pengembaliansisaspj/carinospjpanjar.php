<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select spjpanjar_heder.nospjpanjar as nospjpanjar,spjpanjar_heder.tglspjpanjar as tglspjpanjar,spjpanjar_heder.notapanjar as notapanjar,
						spjpanjar_heder.kodepptk as kodepptk,spjpanjar_heder.namapptk as pptk,
						spjpanjar_heder.program as program,spjpanjar_heder.kegiatan as kegiatan,spjpanjar_heder.kodekegiatanblud as kodekegiatanblud,
						spjpanjar_heder.kegiatanblud as kegiatanblud,spjpanjar_heder.pihakketiga as pihakketiga,
						spjpanjar_heder.keterangan as keterangan,spjpanjar_heder.kunci as kunci,round(sum(spjpanjar_rinci.jumlahbelanjapanjar),2) as total
						from spjpanjar_heder left join spjpanjar_rinci
						on spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar where year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."'
						and spjpanjar_heder.kunci='1' and spjpanjar_heder.verif='1' and spjpanjar_heder.flag='' and spjpanjar_heder.nospjpanjar like '%".$usulantxt."%' 
						group by spjpanjar_heder.nospjpanjar");
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
			<th>NO. SPJ PANJAR</th>
			<th>PPTK</th>
			<th>PIHAK KETIGA</th>
			<th>KEGIATAN BLUD</th>
			<th>KETERANGAN</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nospjpanjar; ?></td>
			<td><?php echo $rs->pptk; ?></td>
			<td><?php echo $rs->pihakketiga; ?></td>
			<td><?php echo $rs->kegiatanblud; ?></td>
			<td><?php echo $rs->keterangan; ?></td>
			<td><input type="button" value="PILIH" onclick="pilihspjpanjar('<?php echo $rs->nospjpanjar;?>','<?php echo $rs->notapanjar;?>','<?php echo $rs->kodepptk; ?>','<?php echo $rs->pptk; ?>',
			'<?php echo $rs->program; ?>','<?php echo $rs->kegiatan; ?>','<?php echo $rs->kodekegiatanblud;?>','<?php echo $rs->kegiatanblud;?>');"></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		koderek50 = document.querySelector('#koderek50').value;
		kodekegiatanblud = document.querySelector('#kodekegiatanblud').value;
		$.get('trans_/npdls/cariitembelanjanonfarmasi.php',{
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