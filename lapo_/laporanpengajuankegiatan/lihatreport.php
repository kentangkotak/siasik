<?php include("../../conn.php"); ?>
<?php
	$data=explode( '|', $_GET['kodekegiatanblud'] );
	$kodekegiatanblud=$data[0];
	$kegiatanblud=$data[1];
	$kodepptk=$data[2];
	$namapptk=$data[3];
	
	$thn=$_GET['thn'];
	$bln=$_GET['bln'];
?>

<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<center>PEMERINTAH KOTA PROBOLINGGO</br>
			UOBK RSUD DOKTER MOHAMAD SALEH </br>
			REALISASI KEGIATAN BLUD</center>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<?php
				$sqlrinci=$conn->query("select koderekening,rincianbelanja,sum(pagupengusulan) as pagupengusulan,sum(jumlahpengusulanlalu) as jumlahpengusulanlalu,sum(jumlahpengusulansekang) as jumlahpengusulansekang,
				pagupengusulan-sum(jumlahpengusulanlalu)-sum(jumlahpengusulansekang) as sisa from(
					select t_tampung.koderek50 as koderekening,akun_permendagri50.uraian as rincianbelanja,
					sum(t_tampung.pagu) as pagupengusulan,'' as jumlahpengusulanlalu,'' as jumlahpengusulansekang 
					from t_tampung,akun_permendagri50 
					where t_tampung.kodekegiatanblud='".$kodekegiatanblud."' and t_tampung.tgl='".$thn."' and 
					concat_ws('.',akun_permendagri50.kode1,akun_permendagri50.kode2,akun_permendagri50.kode3,akun_permendagri50.kode4,akun_permendagri50.kode5,akun_permendagri50.kode6)=t_tampung.koderek50 
					group by koderek50
					UNION all
					select npdls_rinci.koderek50 as koderekening,'' as rincianbelanja,'' as pagupengusulan,sum(npdls_rinci.nominalpembayaran) as jumlahpengusulanlalu,
					'' as jumlahpengusulansekang
					from npdls_rinci,npdls_heder
					where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$kodekegiatanblud."' 
					and year(npdls_heder.tglnpdls)='".$thn."' and npdls_heder.verif='1'
					group by npdls_rinci.koderek50
					UNION all
					select npdpanjar_rinci.koderek50 as koderekening,'' as uraian,'' as pagupengusulan,sum(npdpanjar_rinci.totalpermintaanpanjar) as jumlahpengusulanlalu,
					'' as jumlahpengusulansekang
					from npdpanjar_heder,npdpanjar_rinci
					where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and npdpanjar_heder.kodekegiatanblud='".$kodekegiatanblud."' and year(npdpanjar_heder.tglnpdpanjar)='".$thn."'
					and npdpanjar_heder.verif='1'
					group by npdpanjar_rinci.koderek50
					 UNION all
					select npdls_rinci.koderek50 as koderekening,'' as rincianbelanja,'' as pagupengusulan,'' as jumlahpengusulanlalu,
					sum(npdls_rinci.nominalpembayaran) as jumlahpengusulansekang
					from npdls_rinci,npdls_heder
					where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.kodekegiatanblud='".$kodekegiatanblud."' 
					and year(npdls_heder.tglnpdls)='".$thn."' and npdls_heder.verif=''
					group by npdls_rinci.koderek50
					UNION all
					select npdpanjar_rinci.koderek50 as koderekening,'' as uraian,'' as pagupengusulan,'' as jumlahpengusulanlalu,
					sum(npdpanjar_rinci.totalpermintaanpanjar) as jumlahpengusulansekang
					from npdpanjar_heder,npdpanjar_rinci
					where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and npdpanjar_heder.kodekegiatanblud='".$kodekegiatanblud."' and year(npdpanjar_heder.tglnpdpanjar)='".$thn."'
					and npdpanjar_heder.verif=''
					group by npdpanjar_rinci.koderek50
			) as wew group by koderekening" );
$i=1;
			?>
		
				<table width="100%" class="table table-bordered table-striped jambo_table bulk_action dt-head-center" >
					<tr>
						<td width="25%">&nbsp;Program&nbsp;</td>
						<td width="1%">&nbsp;:&nbsp;</td>
						<td>&nbsp;PROGRAM PENUNJANG URUSAN PEMERINTAH DAERAH KABUPATEN/KOTA&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;Kegiatan&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td>&nbsp;PELAYANAN DAN PENUNJANG PELAYANAN BLUD&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;Kegiatan BLUD&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td>&nbsp;<?php echo $kegiatanblud;?>&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;Pejabat Teknis&nbsp;</td>
						<td>&nbsp;:&nbsp;</td>
						<td>&nbsp;<?php echo $namapptk;?>&nbsp;</td>
					</tr>
				</table>	
				<center><b> RINGKASAN KEGIATAN</b></center> 
				<table width="100%" class="table table-bordered table-striped jambo_table bulk_action dt-head-center">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode Rekening</th>
							<th>Rincian Belanja</th>
							<th>Pagu Pengusulan </th>
							<th>Jumlah Pengusulan Lalu</th>
							<th>Jumlah Pengusulan Sekarang</th>
							<th>Sisa Pagu</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rsrinci=$sqlrinci->fetch_object()){ ?>
						<tr>
							<td align="center"><?php echo $i; ?></td>
							<td><?php echo $rsrinci->koderekening; ?></td>
							<td><?php echo $rsrinci->rincianbelanja; ?></td>
							<td><?php echo rpzx($rsrinci->pagupengusulan); ?></td>
							<td align="right"><?php echo rpzx($rsrinci->jumlahpengusulanlalu); ?></td>
							<td align="right"><?php echo rpzx($rsrinci->jumlahpengusulansekang); ?></td>
							<td align="right"><?php echo rpzx($rsrinci->sisa); ?></td>
						</tr>
						<?php
							$i++;
							$subtotalpagupengusulan=$subtotalpagupengusulan+$rsrinci->pagupengusulan;
							$subtotalpagupengusulanlalu=$subtotalpagupengusulanlalu+$rsrinci->jumlahpengusulanlalu;
							$subtotalpagupengusulansekarang=$subtotalpagupengusulansekarang+$rsrinci->jumlahpengusulansekang;
							$subtotal=$subtotal+$rsrinci->sisa;
							}
						?>
						<tr>
							<td colspan="3" align="right"></td>
							<td align="right"><?php echo rpzx($subtotalpagupengusulan); ?></td>
							<td align="right"><?php echo rpzx($subtotalpagupengusulanlalu); ?></td>
							<td align="right"><?php echo rpzx($subtotalpagupengusulansekarang); ?></td>
							<td align="right"><?php echo rpzx($subtotal); ?></td>
						</tr>
					</tbody>
				</table>
				<table width="50%" align="right" border="0">
					<tr align="center">
						<td><strong>&nbsp;Pejabat Teknis<strong></td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;</td>
					</tr>
					<tr>
						<td>&nbsp;&nbsp;</td>
					</tr>
					<tr align="center">
						<td>&nbsp;<strong><u>( <?php echo $namapptk;?> )</u><strong>&nbsp;</td>
					</tr>
					<tr align="center">
						<td>&nbsp;<strong>NIP <?php echo $kodepptk;?> <strong>&nbsp;</td>
					</tr>
				</table>
			</div>
	</div>
</div>

<?php include("../../close.php"); ?>
<script>
// $(document).ready(function() { 
    // $('#datatable-button').DataTable( {
        // dom: 'Bfrtip',
        // buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
        // ]
    // } );
// } );
</script>