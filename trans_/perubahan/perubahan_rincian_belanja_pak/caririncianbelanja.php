<div id='cariusulancontent'>
<?php include "../../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
			$sql=$conn->query("select * from(
			select idpp,usulan,koderek50,uraian50,koderek108,uraian108,round(sum(paguterakhir),2) as paguterakhirx,round(sum(realisasi),2) as realisasix,round(sum(paguterakhir)-sum(realisasi),2) as sisaanggaran,
								round(sum(npdbelumcair),2) as npdbelumcairx,round((sum(paguterakhir)-sum(realisasi))+sum(npdbelumcair),2) as pagualokasi from(
									select idpp,usulan as usulan,pagu as paguterakhir,'' as realisasi,'' as sisaanggaran,'' as npdbelumcair,'' as pagualokasi,
									koderek50 as koderek50,uraian50 as uraian50,koderek108 as koderek108,uraian108 as uraian108
									from t_tampung
									where tgl='".$_SESSION["anggaran_tahun"]."' and kodekegiatanblud='".$_GET['kodekegiatan']."'
									union all
									select spjpanjar_rinci.iditembelanjanpd as idpp,'' as usulan,'' as paguterakhir,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi,'' as sisaanggaran,'' as npdbelumcair,'' as pagualokasi,
									'' as koderek50,'' as uraian50,'' as koderek108,'' as uraian108
									from spjpanjar_heder,spjpanjar_rinci
									where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.kodekegiatanblud='".$_GET['kodekegiatan']."' and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."'
									group by spjpanjar_heder.nospjpanjar,spjpanjar_rinci.iditembelanjanpd
									union all
									select npdls_rinci.idserahterima_rinci as idpp,'' as usulan,'' as paguterakhir,sum(npdls_rinci.nominalpembayaran) as realisasi,'' as sisaanggaran,'' as npdbelumcair,'' as pagualokasi,
									'' as koderek50,'' as uraian50,'' as koderek108,'' as uraian108
									from npdls_heder,npdls_rinci
									where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET['kodekegiatan']."' and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.nopencairan<>''
									group by npdls_heder.nonpdls,npdls_rinci.idserahterima_rinci
									union all
									select npdls_rinci.idserahterima_rinci as idpp,'' as usulan,'' as paguterakhir,'' as realisasi,'' as sisaanggaran,sum(npdls_rinci.nominalpembayaran) as npdbelumcair,'' as pagualokasi,
									'' as koderek50,'' as uraian50,'' as koderek108,'' as uraian108
									from npdls_heder,npdls_rinci
									where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET['kodekegiatan']."' and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.nopencairan=''
									group by npdls_heder.nonpdls,npdls_rinci.idserahterima_rinci
								) as xxx group by idpp) as wew where usulan like '%".$usulantxt."%'");
$i=1;
?>
<input type='hidden' name='kodekegiatan' id='kodekegiatan' value='<?php echo $_GET['kodekegiatan']; ?>'>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>USULAN</th>
			<th>PAGU TERAKHIR</th>
			<th>REALISASI</th>
			<th>SISA ANGGARAN</th>
			<th>NPD BELUM CAIR</th>
			<th>PAGU ALOKASI</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->usulan; ?></td>
			<td><?php echo rpzx($rs->paguterakhirx); ?></td>
			<td><?php echo rpzx($rs->realisasix); ?></td>
			<td><?php echo rpzx($rs->sisaanggaran); ?></td>
			<td><?php echo rpzx($rs->npdbelumcairx); ?></td>
			<td><?php echo rpzx($rs->pagualokasi); ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihrincianbelanja('<?php echo $rs->idpp;?>','<?php echo str_replace(array("\n", "\r"), '', $rs->usulan);?>','<?php echo rpz($rs->paguterakhirx);?>',
				'<?php echo rpz($rs->realisasix);?>','<?php echo rpz($rs->sisaanggaran);?>','<?php echo rpz($rs->npdbelumcairx);?>','<?php echo rpz($rs->pagualokasi);?>',
				'<?php echo $rs->koderek50;?>','<?php echo str_replace(array("\n", "\r"), '', $rs->uraian50);?>','<?php echo $rs->koderek108;?>','<?php echo str_replace(array("\n", "\r"), '', $rs->uraian108);?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/perubahan/perubahan_rincian_belanja_pak/caririncianbelanja.php',{
			usulantxt:usulantxt,kodekegiatan:kodekegiatan
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../../close.php";?>
</div>