<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
			$sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_rinci.koderek50 as koderek50,npdpanjar_rinci.rincianbelanja50 as rincianbelanja50,
						npdpanjar_rinci.totalpermintaanpanjar as total
						from npdpanjar_heder,npdpanjar_rinci,notapanjar_heder
						where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and npdpanjar_rinci.rincianbelanja50 like '%".$usulantxt."%'
						and year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_heder.kodekegiatanblud='".$_GET['kodekegiatanblud']."' and 
						notapanjar_heder.nonpd=npdpanjar_heder.nonpdpanjar and npdpanjar_heder.kunci=1");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>RINCIAN BELANJA</th>
			<th>TOTAL</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->rincianbelanja50; ?></td>
			<td><?php echo rpzx($rs->total); ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihrincianbelanja('<?php echo $rs->rincianbelanja50;?>','<?php echo $rs->koderek50; ?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/spjpanjar/caririncianbelanja.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>