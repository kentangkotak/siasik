<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
		$sqlcari=$conn->query("select * from notapanjar_heder where nonotapanjar='".$_GET['notapanjar']."'");
		$rscari=$sqlcari->fetch_object();
			$sql=$conn->query("select * from (
								select id,koderek50,kodekegiatanblud,nonpdpanjar,itembelanja,volume,satuan,hargapermintaanpanjar,rincianbelanja50,nopp,
								nousulan,idpp,round(sum(total)) as total,round(sum(beli)) as beli,koderek108,round(sum(total-beli)) as sisasaldo from(
													select npdpanjar_rinci.id as id,npdpanjar_rinci.koderek50 as koderek50,npdpanjar_heder.kodekegiatanblud as kodekegiatanblud,
													npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_rinci.itembelanja as itembelanja,npdpanjar_rinci.volumepermintaanpanjar as volume,
													npdpanjar_rinci.satuan as satuan,npdpanjar_rinci.hargapermintaanpanjar as hargapermintaanpanjar,npdpanjar_rinci.rincianbelanja50 as rincianbelanja50,
													npdpanjar_rinci.nopp as nopp,npdpanjar_rinci.nousulan as nousulan,npdpanjar_rinci.idpp as idpp,
													npdpanjar_rinci.totalpermintaanpanjar as total,'' as beli,npdpanjar_rinci.koderek108 as koderek108
													from npdpanjar_heder,npdpanjar_rinci,notapanjar_heder
													where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar 
													and year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and notapanjar_heder.nonpd='".$rscari->nonpd."' 
													and	notapanjar_heder.nonpd=npdpanjar_heder.nonpdpanjar and npdpanjar_heder.kunci=1
													union all
													select '' as id,'' as koderek50,'' as kodekegiatanblud,'' as nonpdpanjar,'' as itembelanja,'' as volume,'' as satuan,'' as hargapermintaanpanjar,
													'' as rincianbelanja50,'' as nopp,'' as nousulan,spjpanjar_rinci.iditembelanjanpd as idpp,'' as total,spjpanjar_rinci.jumlahbelanjapanjar as beli,'' as koderek108
													from spjpanjar_rinci,spjpanjar_heder
													where spjpanjar_rinci.nospjpanjar=spjpanjar_heder.nospjpanjar and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."'
													and spjpanjar_rinci.nonpdpanjar='".$rscari->nonpd."') as wew group by idpp) as xxx where sisasaldo <> 0 and rincianbelanja50 
													like '%".$usulantxt."%'");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>KODE REKENING 50</th>
			<th>URAIAN REKENING 50</th>
			<th>RINCIAN BELANJA</th>
			<th>YANG AKAN DIBELANJAKAN</th>
			<th>SISA</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->koderek50; ?></td>
			<td><?php echo $rs->rincianbelanja50; ?></td>
			<td><?php echo $rs->itembelanja; ?></td>
			<td><?php echo rpzx($rs->total); ?></td>
			<td><?php echo rpzx($rs->sisasaldo); ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihitembelanja('<?php echo $rs->itembelanja;?>','<?php echo $rs->volumepermintaanpanjar; ?>',
				'<?php echo $rs->satuan;?>','<?php echo rpz($rs->hargapermintaanpanjar); ?>',
				'<?php echo $rs->nopp;?>','<?php echo $rs->nousulan; ?>',
				'<?php echo $rs->idpp;?>','<?php echo $rs->nonpdpanjar; ?>','<?php echo rpz($rs->total); ?>',
				'<?php echo $rs->koderek50; ?>','<?php echo $rs->rincianbelanja50; ?>','<?php echo $rs->sisasaldo; ?>','<?php echo $rs->koderek108; ?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/spjpanjar/cariitembelanja.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>