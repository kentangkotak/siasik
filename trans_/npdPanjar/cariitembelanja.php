<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select notrans,kodekegiatan,koderek50,koderek108,volume,satuan,harga,uraian108,idpp,itembelanja,
						total,kepake,sisa
						from(
								  select notrans,kodekegiatan,koderek50,koderek108,satuan,harga,uraian108,idpp,itembelanja,volume,
								  round(sum(total),2) as total,round(sum(totalkepake),2) as kepake,round(sum(total)-sum(totalkepake),2) as sisa
								  from(
											select t_tampung.notrans as notrans,t_tampung.kodekegiatanblud as kodekegiatan,t_tampung.koderek50 as koderek50,
											t_tampung.koderek108 as koderek108,
											t_tampung.satuan as satuan,t_tampung.volume as volume,
											t_tampung.harga as harga,akun_permendagri108.uraian as uraian108,
											t_tampung.idpp as idpp,t_tampung.usulan as itembelanja,t_tampung.pagu as total,'' as totalkepake
											from t_tampung
											LEFT JOIN akun_permendagri108 on
											t_tampung.koderek108=concat_ws('.',kode1,kode2,kode3,kode4,kode5,kode6,kode7)
											where t_tampung.koderek50='".$_GET["koderek50"]."'
											and t_tampung.kodekegiatanblud='".$_GET["kodekegiatanblud"]."'
											and tgl='".$_SESSION["anggaran_tahun"]."'
											union all
											select '' as notrans,'' as kodekegiatan,
											'' as koderek50,
											'' as koderek108,
											'' as volume,'' as satuan,
											'' as harga,'' as uraian108,
											spjpanjar_rinci.iditembelanjanpd as idpp,spjpanjar_rinci.itembelanja as itembelanja,'' as total,sum(spjpanjar_rinci.jumlahbelanjapanjar) as totalkepake 
											from spjpanjar_heder,spjpanjar_rinci 
											where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.kodekegiatanblud='".$_GET["kodekegiatanblud"]."' 
											and spjpanjar_rinci.koderek50='".$_GET["koderek50"]."'
											and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."'
											group by spjpanjar_heder.nospjpanjar,spjpanjar_rinci.iditembelanjanpd
											union all
											select '' as notrans,'' as kodekegiatan,
											'' as koderek50,
											'' as koderek108,
											'' as volume,'' as satuan,
											'' as harga,'' as uraian108,
											npdls_rinci.idserahterima_rinci as idpp,npdls_rinci.itembelanja as itembelanja,'' as total,sum(npdls_rinci.totalls) as totalkepake 
											from npdls_heder,npdls_rinci 
											where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET["kodekegiatanblud"]."' 
											and npdls_rinci.koderek50='".$_GET["koderek50"]."'
											and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' 
											group by npdls_heder.kodekegiatanblud,npdls_rinci.idserahterima_rinci) as wew 
								  group by idpp)
						as xxx where sisa > 0 and itembelanja like '%".$usulantxt."%'");
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
			<td><?php echo $rs->itembelanja; ?></td>
			<td><?php echo $rs->volume; ?></td>
			<td><?php echo $rs->satuan; ?></td>
			<td align="right" nowrap="nowrap"><?php echo rp($rs->harga); ?></td>
			<td align="right"><?php echo rp($rs->total); ?></td>
			<td align="right"><?php echo rp($rs->sisa); ?></td>
			<td><input type="button" value="PILIH" onclick="pilih('<?php echo $rs->itembelanja;?>','<?php echo rpz($rs->volume);?>','<?php echo $rs->satuan; ?>',
			'<?php echo rpz($rs->harga); ?>','<?php echo $rs->notrans;?>','<?php echo $rs->nousulan;?>','<?php echo $rs->idpp;?>','<?php echo rpz($rs->total);?>',
			'<?php echo rpz($rs->sisa);?>','<?php echo $rs->koderek108;?>','<?php echo $rs->uraian108;?>');"></td>
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