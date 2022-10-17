<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php			
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select notrans,kodekegiatan,koderek50,koderek108,volume,satuan,harga,uraian50,idpp,itembelanja,
						total,kepake,sisa
						from(
								  select notrans,kodekegiatan,koderek50,koderek108,satuan,harga,uraian50,idpp,itembelanja,volume,
								  round(sum(total),2) as total,round(sum(totalkepake),2) as kepake,round(sum(total)-sum(totalkepake),2) as sisa
								  from(
											select t_tampung.notrans as notrans,t_tampung.kodekegiatanblud as kodekegiatan,t_tampung.koderek50 as koderek50,
											t_tampung.koderek108 as koderek108,
											t_tampung.satuan as satuan,t_tampung.volume as volume,
											t_tampung.harga as harga,akun50_miroring.uraian as uraian50,
											t_tampung.idpp as idpp,t_tampung.usulan as itembelanja,t_tampung.pagu as total,'' as totalkepake
											from t_tampung
											LEFT JOIN akun50_miroring on
											t_tampung.koderek50=concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian)
											where t_tampung.kodekegiatanblud='".$_GET["kodekegiatanblud"]."'
											and tgl='".$_SESSION["anggaran_tahun"]."'
											union all
											select '' as notrans,'' as kodekegiatan,
											'' as koderek50,
											'' as koderek108,
											'' as volume,'' as satuan,
											'' as harga,'' as uraian50,
											spjpanjar_rinci.iditembelanjanpd as idpp,spjpanjar_rinci.itembelanja as itembelanja,'' as total,sum(spjpanjar_rinci.jumlahbelanjapanjar) as totalkepake 
											from spjpanjar_heder,spjpanjar_rinci 
											where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.kodekegiatanblud='".$_GET["kodekegiatanblud"]."' 
											and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."'
											group by spjpanjar_heder.nospjpanjar,spjpanjar_rinci.iditembelanjanpd
											union all
											select '' as notrans,'' as kodekegiatan,
											'' as koderek50,
											'' as koderek108,
											'' as volume,'' as satuan,
											'' as harga,'' as uraian50,
											npdls_rinci.idserahterima_rinci as idpp,npdls_rinci.itembelanja as itembelanja,'' as total,sum(npdls_rinci.totalls) as totalkepake 
											from npdls_heder,npdls_rinci 
											where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$_GET["kodekegiatanblud"]."' 
											and year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' 
											group by npdls_heder.kodekegiatanblud,npdls_rinci.idserahterima_rinci) as wew 
								  group by koderek50)
						as xxx where sisa > 0 and itembelanja like '%".$usulantxt."%'");
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
			<!--<th>ITEM BELANJA</th>
			<th>TOTAL ANGGARAN</th>
			<th>SISA ANGGARAN</th>-->
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->koderek50; ?></td>
			<td><?php echo $rs->uraian50; ?></td>
			<!--<td><?php echo $rs->itembelanja; ?></td>
			<td align="right"><?php echo rp($rs->total); ?></td>
			<td align="right"><?php echo rp($rs->sisa); ?></td>-->
			<td><input type="button" value="PILIH" onclick="pilihrekening50('<?php echo $rs->koderek50;?>','<?php echo str_replace(array("\n", "\r"), '', $rs->uraian50);?>');"></td>
		</tr>
		<?php $i++; } //sisa > 0 and ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		kodekegiatanblud = document.querySelector('#kodekegiatanblud').value;
		$.get('trans_/serahterimapekerjaan/carirekening50.php',{
			usulantxt:usulantxt,
			kodekegiatanblud:kodekegiatanblud,
		},
		function(rs){ 
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>