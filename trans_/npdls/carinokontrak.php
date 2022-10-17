<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	if($_SESSION["anggaran_level"] == 'SUPER'){
		$sql=$conn->query("select serahterima_heder.*,pihak_ketiga.*,pptk.* from pihak_ketiga,serahterima_heder,pptk
							where serahterima_heder.kodepihakketiga=pihak_ketiga.kode and 
							serahterima_heder.kodepptk=pptk.nip and 
							serahterima_heder.nokontrak like '%".$usulantxt."%' 
							and serahterima_heder.flag='' and
							serahterima_heder.kunci='1' and year(serahterima_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' group by serahterima_heder.noserahterimapekerjaan");
	}else{
		$sql=$conn->query("select serahterima_heder.*,pihak_ketiga.*,pptk.* from pihak_ketiga,serahterima_heder,pptk
							where serahterima_heder.kodepihakketiga=pihak_ketiga.kode and 
							serahterima_heder.kodepptk=pptk.nip and 
							serahterima_heder.nokontrak like '%".$usulantxt."%' 
							and serahterima_heder.flag='' and
							serahterima_heder.kunci='1' and year(serahterima_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' group by serahterima_heder.noserahterimapekerjaan");
	}
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
			<th>NO SERAH TERIMA PEKERJAAN</th>
			<th>NOKONTRAK</th>
			<th>NAMA PERUSAHAAN</th>
			<th>PROGRAM</th>
			<th>KEGIATAN</th>
			<th>KEGIATAN BLUD</th>
			<!--<th>PERMEN 50</th>
			<th>URAIAN</th>
			<th>ANGGARAN</th>-->
			<th>NILAI KONTRAK</th>
		<!--	<th>TOTAL TAGIHAN</th> -->
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->noserahterimapekerjaan; ?></td>
			<td><?php echo $rs->nokontrak; ?></td>
			<td><?php echo $rs->namaperusahaan; ?></td>
			<td><?php echo $rs->program; ?></td>
			<td><?php echo $rs->kegiatan; ?></td>
			<td><?php echo $rs->kegiatanblud; ?></td>
		<!--<td><?php echo $rs->kode50; ?></td>
			<td><?php echo $rs->uraianpekerjaan; ?></td>
			<td><?php echo rpzx($rs->nilaikegiatan); ?></td>-->
			<td><?php echo rpzx($rs->totalpermintaanls); ?></td>
		<!--<td><?php echo rpzx($rs->tagihanfaktur); ?></td> -->
			<td>
				<input type="button" value="PILIH" onclick="pilihserahterimapekerjaan('<?php echo $rs->noserahterimapekerjaan;?>','<?php echo $rs->nokontrak; ?>'
				,'<?php echo $rs->program; ?>','<?php echo $rs->kegiatan; ?>','<?php echo $rs->namaperusahaan; ?>','<?php echo $rs->kodekegiatanblud; ?>'
				,'<?php echo $rs->kegiatanblud; ?>','<?php echo $rs->uraianpekerjaan; ?>','<?php echo $rs->kode50; ?>',
				'<?php echo $rs->bank; ?>','<?php echo $rs->norek; ?>','<?php echo $rs->npwp; ?>','<?php echo $rs->nopp; ?>','<?php echo $rs->kodepihakketiga; ?>',
				'<?php echo $rs->itembelanja; ?>','<?php echo $rs->idrinci; ?>','<?php echo $rs->volume; ?>','<?php echo $rs->satuan; ?>','<?php echo rpz($rs->harga); ?>',
				'<?php echo rpz($rs->totalls); ?>','<?php echo $rs->volumepermintaanls; ?>','<?php echo rpz($rs->hargapermintaanls); ?>','<?php echo rpz($rs->totalpermintaanls); ?>',
				'<?php echo $rs->satuanbaru; ?>','<?php echo rpz($rs->tagihanfaktur); ?>','<?php echo $rs->kodepptk; ?>','<?php echo $rs->namapptk; ?>','<?php echo $rs->kodeBagian; ?>',
				'<?php echo $rs->bagian; ?>')">
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