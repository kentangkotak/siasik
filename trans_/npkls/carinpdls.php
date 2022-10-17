<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select npdls_heder.nonpdls as nonpdls,npdls_heder.tglnpdls as tglnpdls,npdls_heder.kegiatan as kegiatan,npdls_heder.kodekegiatanblud as kodekegiatanblud,
							npdls_heder.kegiatanblud as kegiatanblud,sum(npdls_rinci.nominalpembayaran) as total
							from npdls_heder left join npdls_rinci on
							npdls_heder.nonpdls=npdls_rinci.nonpdls
							where year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.kunci=1 and npdls_heder.verif=1 and npdls_heder.flagnpk=''
							and npdls_heder.nonpdls like '%".$usulantxt."%' group by npdls_heder.nonpdls");
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
			<th>NO NPD LS</th>
			<th>TANGGAL NPD LS</th>
			<th>KEGIATAN</th>
			<th>KEGIATAN BLUD</th>
			<th>TOTAL</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nonpdls; ?></td>
			<td><?php echo $rs->tglnpdls; ?></td>
			<td><?php echo $rs->kegiatan; ?></td>
			<td><?php echo $rs->kegiatanblud; ?></td>
			<td align="right"><?php echo rpz($rs->total); ?></td>
			<td><input type="button" value="PILIH" onclick="pilihnpdls('<?php echo $rs->nonpdls;?>','<?php echo out_tanggal("-",$rs->tglnpdls);?>','<?php echo $rs->kegiatan; ?>',
			'<?php echo $rs->kodekegiatanblud; ?>','<?php echo $rs->kegiatanblud;?>','<?php echo rpz($rs->total);?>');"></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		koderek50 = document.querySelector('#koderek50').value;
		kodekegiatanblud = document.querySelector('#kodekegiatanblud').value;
		$.get('trans_/npkls/carinpdls.php',{
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