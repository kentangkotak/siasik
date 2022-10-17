<?php include("../../../conn.php"); ?>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
	
	$tgl=in_tanggal("/",trim($_GET['tgl']));
	$tglx=in_tanggal("/",trim($_GET['tglx']));

	$tgl_1=explode( '-', $tgl );
	$thn=$tgl_1[0];
?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">-->
<?php
		$sql=$conn->query("select kodepptk,namapptk,kegiatan from mappingpptkkegiatan where tahun='".$thn."' group by kodepptk");
	
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN MANAJERIAL ANGGARAN & REALISASI PER KODE REKENING50 </br>
				TAHUN <?php echo $thn;?> </center>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
					<thead>
						<tr>
							<th class="text-center">PPTK</th>
							<th class="text-center">KODE 108</th>
							<th class="text-center">URAIAN 108</th>
							<th class="text-center">ANGGARAN</th>
							<th class="text-center">REALISASI</th>
							<th class="text-center">SALDO</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td><?php echo $rs->namapptk; ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
								$sqlx=$conn->query("select kode,uraian,round(sum(anggaran),2) as anggaranx,round(sum(realisasi),2) as realisasix,round(sum(anggaran)-sum(realisasi),2) as saldo from(
													   select t_tampung.koderek50 as kode,t_tampung.uraian50 as uraian,sum(t_tampung.pagu) as anggaran,'' as realisasi 
													   from penyesesuaianperioritas_heder,t_tampung
													   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans 
													   and year(penyesesuaianperioritas_heder.tgltrans)= '".$thn."'
													   and penyesesuaianperioritas_heder.kodepptk='".$rs->kodepptk."'
													   GROUP by t_tampung.koderek50
													   union all
													   select npdls_rinci.koderek50 as kode,'' as uraian,'' as anggaran,sum(npdls_rinci.totalls) as realisasi
														from npdls_heder,npdls_rinci,npkls_heder
														where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.nonpdls=npkls_heder.nonpdls
														and npkls_heder.tglpencairan >='".$tgl."' and npkls_heder.tglpencairan <='".$tglx."'
														and npdls_heder.kodepptk='".$rs->kodepptk."'													   
														GROUP by npdls_rinci.koderek50	
													   union all
													   select spjpanjar_rinci.koderek50 as kode,'' as uraian,'' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi
													   from spjpanjar_heder,spjpanjar_rinci
													   where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.verif=1
													   and spjpanjar_heder.tglspjpanjar >='".$tgl."' and spjpanjar_heder.tglspjpanjar <='".$tglx."'
													   and spjpanjar_heder.kodepptk='".$rs->kodepptk."'
													   group by spjpanjar_rinci.koderek50
											) as xxx group by kode");
							
						?>
						<?php while($rsx=$sqlx->fetch_object()){ ?>
						<tr>
							<td></td>
							<td><?php echo $rsx->kode; ?></td>
							<td><?php echo $rsx->uraian; ?></td>
							<td align="right"><?php echo rpzx($rsx->anggaranx); ?></td>
							<td align="right"><?php echo rpzx($rsx->realisasix); ?></td>
							<td align="right"><?php echo rpzx($rsx->saldo); ?></td>
						</tr>
						<?php
							$i++;
							}
						?>
						<?php
							$i++;
							}
						?>
					</tbody>
			</table>
			</br>
	 </div>
</div>
<?php include("../../../close.php"); ?>