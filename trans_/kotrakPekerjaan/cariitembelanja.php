<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,total,nousulan,idpp,itembelanja,
						kepake,sisa
						from(
								  select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,total,nousulan,idpp,itembelanja,
								  round(sum(totalkepake),2) as kepake,round(total-sum(totalkepake),2) as sisa
								  from(
											select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
											penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
											penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
											penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
											penyesesuaianperioritas_rinci.harga as harga,penyesesuaianperioritas_rinci.nilai as total,penyesesuaianperioritas_rinci.nousulan as nousulan,
											penyesesuaianperioritas_rinci.id as idpp,penyesesuaianperioritas_rinci.usulan as itembelanja,'' as totalkepake
											from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
											where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
											and penyesesuaianperioritas_rinci.koderek50='".$_GET["koderek50"]."'
											and penyesesuaianperioritas_rinci.kunci<>'2'
											and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatanblud"]."'
											and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
											union all
											select '' as notrans,'' as kodekegiatan,'' as kegiatanblud,'' as koderek50,'' as uraian50,'' as koderek108,'' as uraian108,
											'' as usulan,'' as jumlahacc,'' as satuan,'' as harga,'' as total,'' as nousulan,kontrakPengerjaan_rinci.idpprini as idpp,'' as itembelanja,kontrakPengerjaan_rinci.nilai as totalpake
											from kontrakPengerjaan_rinci,kontrakPengerjaan_header
											where kontrakPengerjaan_rinci.nokontrak=kontrakPengerjaan_header.nokontrak and
											kontrakPengerjaan_header.kode50='".$_GET["koderek50"]."' and kontrakPengerjaan_header.kodekegiatanblud='".$_GET["kodekegiatanblud"]."' and year(kontrakPengerjaan_header.tgltrans)='".$_SESSION["anggaran_tahun"]."'
											) as wew 
								  group by idpp)
						as xxx where sisa<>0 and usulan like '%".$usulantxt."%'");
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
			<th>USULAN</th>
			<th>JUMLAH ACC</th>
			<th>SATUAN</th>
			<th>HARGA</th>
			<th>TOTAL ANGGARAN</th>
			<th>SISA ANGGARAN</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->usulan; ?></td>
			<td><?php echo $rs->jumlahacc; ?></td>
			<td><?php echo $rs->satuan; ?></td>
			<td align="right" nowrap="nowrap"><?php echo rp($rs->harga); ?></td>
			<td align="right"><?php echo rp($rs->total); ?></td>
			<td align="right"><?php echo rp($rs->sisa); ?></td>
			<td><input type="button" value="PILIH" onclick="pilihcaribelanja('<?php echo $rs->usulan;?>','<?php echo rpz($rs->jumlahacc);?>','<?php echo $rs->satuan; ?>',
			'<?php echo rpz($rs->harga); ?>','<?php echo $rs->notrans;?>','<?php echo $rs->nousulan;?>','<?php echo $rs->idpp;?>','<?php echo rpz($rs->total);?>','<?php echo rpz($rs->sisa);?>');"></td>
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