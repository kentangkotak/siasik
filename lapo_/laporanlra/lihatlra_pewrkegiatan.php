<?php include("../../conn.php"); ?>
<!-- Datatables -->
    <link href="./vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="./vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
	
	<!-- Datatables -->
    <script src="./vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="./vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="./vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="./vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="./vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="./vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="./vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="./vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="./vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="./vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="./vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="./vendors/jszip/dist/jszip.min.js"></script>
    <script src="./vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="./vendors/pdfmake/build/vfs_fonts.js"></script>  
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
	
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$sqlsimPendapatan=$conn_simrs->query("select 
            month(tgl) bulan,
            round(sum(penerimaan),2) penerimaan
        from (
            select
                tgl,
                noRek,
                concat(ket,' (',noTrans,')') uraian,
                nilai penerimaan,
                1 urut
            from
                keu_trans_pendapatan
            where
                year(tgl)='".$_GET['thn']."'
            union all
            select
                rs258.rs2 tgl,
                rs258.noRek,
                concat(rs260.ket,' (',rs258.rs1,')') uraian,
                rs260.rs4 penerimaan,
                1 urut
            from
                rs258,
                rs260
            where
                rs258.rs1=rs260.rs1
                and year(rs258.rs2)='".$_GET['thn']."'
                and setor='Setor'
                and (rs258.tglBatal is null or rs258.tglBatal='0000-00-00 00:00:00')
            union all
            select tgl,noRek,uraian,sum(penerimaan) penerimaan,urut from (
            select
                keu_trans_setor.noSetor,
                keu_trans_setor.tgl,
                rs258.noRek,
                concat(keu_trans_setor.ket,' (',keu_trans_setor.noSetor,')') uraian,
                rs260.rs4 penerimaan,
                1 urut
            from
                rs258,
                rs260,
                keu_trans_setor
            where
                rs258.rs1=rs260.rs1
                and keu_trans_setor.noSetor = rs258.noSetor
                and year(keu_trans_setor.tgl)='".$_GET['thn']."'
                and setor<>'Setor'
                and (rs258.tglBatal is null or rs258.tglBatal='0000-00-00 00:00:00')
            union all
            select
                keu_trans_setor.noSetor,
                keu_trans_setor.tgl,
                keu_trans_setor.noRek,
                concat(ket,' (',keu_trans_setor.noSetor,')') uraian,
                tbp.nilai penerimaan,
                1 urut
            from
                keu_trans_setor,
                tbp
            where
                tbp.noSetor=keu_trans_setor.noSetor
                and year(keu_trans_setor.tgl)='".$_GET['thn']."'   
                and tbp.setor<>'Setor'
            ) as vTunai group by noSetor
            union all
            select
                keu_trans_setor.tgl,
                keu_trans_setor.noRek,
                concat(ket,' (',keu_trans_setor.noSetor,')') uraian,
                tbpuj.nilai penerimaan,
                1 urut
            from
                keu_trans_setor,
                tbpuj
            where
                tbpuj.noSetor=keu_trans_setor.noSetor
                and year(keu_trans_setor.tgl)='".$_GET['thn']."'
                and tbpuj.setor<>'Setor'
        ) as vBku group by year(tgl)");
	$rsPendapatan=$sqlsimPendapatan->fetch_object();
	$penerimaan=$rsPendapatan->penerimaan;
?>
<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN REALISASI ANGGARAN </br>
				UNTUK TAHUN YANG BERAKHIR SAMPAI 31 DESEMBER  <?php echo  $_GET['thn'];?> </center>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<?php
					$sql2=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
										uraian,sum(t_tampung_pendapatan.pagu) as anggaran
										from  akun50_miroring,t_tampung_pendapatan where akun=4 and kelompok is null and t_tampung_pendapatan.tahun='".$_GET['thn']."'" );
					$rs2=$sql2->fetch_object();
				?>
				<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
						<thead>
							<tr>
								<th nowrap="nowrap">KODE</th>
								<th nowrap="nowrap">URAIAN</th>
								<th nowrap="nowrap">ANGGARAN</th>
								<th nowrap="nowrap">REALISASI</th>
								<th nowrap="nowrap">SELISIH</th>
								<th nowrap="nowrap">(%)</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $rs2->kode; ?></td>
								<td><?php echo $rs2->uraian; ?></td>
								<td align="right"><?php echo rp($rs2->anggaran); ?></td>
								<td align="right"><?php echo rp($penerimaan); ?></td>
								<td align="right"><?php $selisih=$rs2->anggaran-$penerimaan; echo rp($selisih); ?></td>
								<td align="right"><?php $selisihpersen=$penerimaan/$rs2->anggaran*100; echo round($selisihpersen,2); ?>%</td>
							</tr>
							<?php
								$sql3=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,sum(t_tampung_pendapatan.pagu) as anggaran
													from  akun50_miroring,t_tampung_pendapatan where akun=4 and kelompok=1 and jenis is null and t_tampung_pendapatan.tahun='".$_GET['thn']."'");
								$rs3=$sql3->fetch_object();
							?>
								<tr>
									<td><?php echo $rs3->kode; ?></td>
									<td><?php echo $rs3->uraian; ?></td>
									<td align="right"><?php echo rp($rs3->anggaran); ?></td>
									<td align="right"><?php echo rp($penerimaan); ?></td>
									<td align="right"><?php $selisih=$rs3->anggaran-$penerimaan; echo rp($selisih); ?></td>
									<td align="right"><?php $selisihpersen=$penerimaan/$rs3->anggaran*100; echo round($selisihpersen,2); ?>%</td>
								</tr>
								<?php
								$sql4=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,sum(t_tampung_pendapatan.pagu) as anggaran
													from  akun50_miroring,t_tampung_pendapatan where akun=4 and kelompok=1 and jenis=04 and objectx is null and t_tampung_pendapatan.tahun='".$_GET['thn']."'");
								$rs4=$sql4->fetch_object();
								?>
								<tr>
									<td><?php echo $rs4->kode; ?></td>
									<td><?php echo $rs4->uraian; ?></td>
									<td align="right"><?php echo rp($rs4->anggaran); ?></td>
									<td align="right"><?php echo rp($penerimaan); ?></td>
									<td align="right"><?php $selisih=$rs4->anggaran-$penerimaan; echo rp($selisih); ?></td>
									<td align="right"><?php $selisihpersen=$penerimaan/$rs4->anggaran*100; echo round($selisihpersen,2); ?>%</td>
								</tr>
								<?php
								$sql5=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,sum(t_tampung_pendapatan.pagu) as anggaran
													from  akun50_miroring,t_tampung_pendapatan where akun=4 and kelompok=1 and jenis=04 and objectx=16 and rincian is null and t_tampung_pendapatan.tahun='".$_GET['thn']."'");
								$rs5=$sql5->fetch_object();
								?>
								<tr>
									<td><?php echo $rs5->kode; ?></td>
									<td><?php echo $rs5->uraian; ?></td>
									<td align="right"><?php echo rp($rs5->anggaran); ?></td>
									<td align="right"><?php echo rp($penerimaan); ?></td>
									<td align="right"><?php $selisih=$rs5->anggaran-$penerimaan; echo rp($selisih); ?></td>
									<td align="right"><?php $selisihpersen=$penerimaan/$rs5->anggaran*100; echo round($selisihpersen,2); ?>%</td>
								</tr>
								<?php
								$sql6=$conn->query("select wew.kode,wew.uraian,sum(t_tampung_pendapatan.pagu) as anggaran from(
													select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian
													from  akun50_miroring where subrincian is not null
													) as wew,t_tampung_pendapatan where t_tampung_pendapatan.koderekeningblud=wew.kode and t_tampung_pendapatan.tahun='".$_GET['thn']."' ");
								?>
								<?php while($rs6=$sql6->fetch_object()){ ?>
								<tr>
									<td><?php echo $rs6->kode; ?></td>
									<td><?php echo $rs6->uraian; ?></td>
									<td align="right"><?php echo rp($rs6->anggaran); ?></td>
									<td align="right"><?php echo rp($penerimaan); ?></td>
									<td align="right"><?php $selisih=$rs6->anggaran-$penerimaan; echo rp($selisih); ?></td>
									<td align="right"><?php $selisihpersen=$penerimaan/$rs6->anggaran*100; echo round($selisihpersen,2); ?>%</td>
								</tr>
								<?php
									$i++; $anggaranTotal=$anggaranTotal+$rs6->anggaran; $penerimaanTotal=$penerimaanTotal+$penerimaan;
										  $selisihTotal=$selisihTotal+$selisih; $selisihpersenTotal=$selisihpersenTotal+$selisihpersen;
									}
								?>
							<tr class="bodylist" valign="top";>
								<td colspan="2" align="right"><b>JUMLAH</b></td>
								<td align="right"><?php echo rp($anggaranTotal); ?></td>
								<td align="right"><?php echo rp($penerimaanTotal); ?></td>
								<td align="right"><?php echo rp($selisihTotal); ?></td>
								<td align="right"><?php echo round($selisihpersenTotal,2); ?>%</td>
							</tr>
								<?php
								$sql2x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx,sum(realisasi) as realisasix from(
															   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
															   uraian,'' as anggaran,'' as realisasi from  akun50_miroring where akun=5 and kelompok is null
															   union all
															   select '' as kode,'' as uraian,sum(t_tampung.pagu) as anggaran,'' as realisasi 
															   from penyesesuaianperioritas_heder,t_tampung
															   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."' 
															   union all
															   select '' as kode,'' as uraian,'' as anggaran,sum(npkls_rinci.total) as realisasi
															   from npkls_rinci,npkls_heder
															   where npkls_heder.nopencairan=npkls_rinci.nopencairan and year(npkls_heder.tglpencairan)='".$_GET['thn']."'
															   union all
															   select '' as kode,'' as uraian,'' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi
															   from spjpanjar_heder,spjpanjar_rinci
															   where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.verif=1
															   and year(spjpanjar_heder.tglspjpanjar)='".$_GET['thn']."'
													) as xxx");
								$rs2x=$sql2x->fetch_object();
								?>
								<tr>
									<td><b><?php echo $rs2x->kode; ?></b></td>
									<td><b><?php echo $rs2x->uraian; ?></b></td>
									<td align="right"><b><?php echo rp($rs2x->anggaranx); ?></b></td>
									<td align="right"><b><?php echo rp($rs2x->realisasix); ?></b></td>
									<td align="right"><b><?php $selisih=$rs2x->anggaranx-$rs2x->realisasix; echo rp($selisih); ?></b></td>
									<td align="right"><b><?php $selisihpersen=$rs2x->realisasix/$rs2x->anggaranx*100; echo round($selisihpersen,2); ?>%</b></td>
								</tr>
								<?php
								$sql3x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx,sum(realisasi) as realisasix from(
													   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													   uraian,'' as anggaran,'' as realisasi from  akun50_miroring where akun=5 and jenis is null and kelompok is not null 
													   union all
													   select SUBSTRING_INDEX(t_tampung.koderek50,'.',2) as kode,'' as uraian,sum(t_tampung.pagu) as anggaran,'' as realisasi 
													   from penyesesuaianperioritas_heder,t_tampung
													   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."'
													   group by SUBSTRING_INDEX(t_tampung.koderek50,'.',2)
													   union all
													   select SUBSTRING_INDEX(npdls_rinci.koderek50,'.',2) as kode,'' as uraian,'' as anggaran,sum(npkls_rinci.total) as realisasi
													   from npkls_rinci,npkls_heder,npdls_rinci
													   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_heder.nonpdls and year(npkls_heder.tglpencairan)='".$_GET['thn']."'
													   group by SUBSTRING_INDEX(npdls_rinci.koderek50,'.',2)
													   union all
													   select SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',2) as kode,'' as uraian,'' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi
													   from spjpanjar_rinci,spjpanjar_heder
													   where spjpanjar_rinci.nospjpanjar=spjpanjar_heder.nospjpanjar and spjpanjar_heder.verif=1
													   and year(spjpanjar_heder.tglspjpanjar)='".$_GET['thn']."'
													   group by SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',2)
													) as wew group by kode");
								?>
								<?php while($rs3x=$sql3x->fetch_object()){ 
									if($rs3x->anggaranx > 0){
								?>
								<tr>
									<td><b><?php echo $rs3x->kode; ?></b></td>
									<td><b><?php echo $rs3x->uraian; ?></b></td>
									<td align="right"><b><?php echo rp($rs3x->anggaranx); ?></b></td>
									<td align="right"><b><?php echo rp($rs3x->realisasix); ?></b></td>
									<td align="right"><b><?php $selisih=$rs3x->anggaranx-$rs3x->realisasix; echo rp($selisih); ?></b></td>
									<td align="right"><b><?php $selisihpersen=($rs3x->realisasix/$rs3x->anggaranx)*100; echo round($selisihpersen,2) ;?>%</b></td>
								</tr>
										<?php
										$sql4x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx,sum(realisasi) as realisasix from(
															   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
															   uraian,'' as anggaran,'' as realisasi from  akun50_miroring where akun=5 and jenis is not null and objectx is null
															   union all
															   select SUBSTRING_INDEX(t_tampung.koderek50,'.',3) as kode,'' as uraian,sum(t_tampung.pagu) as anggaran,'' as realisasi 
															   from penyesesuaianperioritas_heder,t_tampung
															   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."'
															   and SUBSTRING_INDEX(t_tampung.koderek50,'.',2)='".$rs3x->kode."' group by SUBSTRING_INDEX(t_tampung.koderek50,'.',3)
															   union all
															   select SUBSTRING_INDEX(npdls_rinci.koderek50,'.',3) as kode,'' as uraian,'' as anggaran,sum(npkls_rinci.total) as realisasi
															   from npkls_rinci,npkls_heder,npdls_rinci
															   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_heder.nonpdls and year(npkls_heder.tglpencairan)='".$_GET['thn']."'
															   and SUBSTRING_INDEX(npdls_rinci.koderek50,'.',2)='".$rs3x->kode."' group by SUBSTRING_INDEX(npdls_rinci.koderek50,'.',3)
															   union all
															   select SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',3) as kode,'' as uraian,'' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi
															   from spjpanjar_rinci,spjpanjar_heder
															   where spjpanjar_rinci.nospjpanjar=spjpanjar_heder.nospjpanjar and spjpanjar_heder.verif=1
													           and year(spjpanjar_heder.tglspjpanjar)='".$_GET['thn']."'
															   and SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',2)='".$rs3x->kode."' group by SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',3)
															) as wew group by kode");
										?>
										<?php while($rs4x=$sql4x->fetch_object()){ 
											if($rs4x->anggaranx > 0){
										?>
										<tr>
											<td><b><?php echo $rs4x->kode; ?></b></td>
											<td><b><?php echo $rs4x->uraian; ?></b></td>
											<td align="right"><b><?php echo rp($rs4x->anggaranx); ?></b></td>
											<td align="right"><b><?php echo rp($rs4x->realisasix); ?></b></td>
											<td align="right"><b><?php $selisih=$rs4x->anggaranx-$rs4x->realisasix; echo rp($selisih); ?></b></td>
											<td align="right"><b><?php $selisihpersen=($rs4x->realisasix/$rs4x->anggaranx)*100;  echo round($selisihpersen,2) ;?>%</b></td>
										</tr>
											<?php
											$sql5x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx,sum(realisasi) as realisasix from(
																   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
																   uraian,'' as anggaran,'' as realisasi from  akun50_miroring where akun=5 and objectx is not null and rincian is null
																   union all
																   select SUBSTRING_INDEX(t_tampung.koderek50,'.',4) as kode,'' as uraian,sum(t_tampung.pagu) as anggaran,'' as realisasi 
																   from penyesesuaianperioritas_heder,t_tampung
																   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."'
																   and SUBSTRING_INDEX(t_tampung.koderek50,'.',3)='".$rs4x->kode."' group by SUBSTRING_INDEX(t_tampung.koderek50,'.',4)
																   union all
																   select SUBSTRING_INDEX(npdls_rinci.koderek50,'.',4) as kode,'' as uraian,'' as anggaran,sum(npkls_rinci.total) as realisasi
																   from npkls_rinci,npkls_heder,npdls_rinci
																   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_heder.nonpdls and year(npkls_heder.tglpencairan)='".$_GET['thn']."'
																   and SUBSTRING_INDEX(npdls_rinci.koderek50,'.',3)='".$rs4x->kode."' group by SUBSTRING_INDEX(npdls_rinci.koderek50,'.',4)
																   union all
																   select SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',4) as kode,'' as uraian,'' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi
																   from spjpanjar_rinci,spjpanjar_heder
																   where spjpanjar_rinci.nospjpanjar=spjpanjar_heder.nospjpanjar and spjpanjar_heder.verif=1
													               and year(spjpanjar_heder.tglspjpanjar)='".$_GET['thn']."'
																   and SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',3)='".$rs4x->kode."' group by SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',4)
																) as wew group by kode");
											?>
											<?php while($rs5x=$sql5x->fetch_object()){ 
												if($rs5x->anggaranx > 0){
											?>
											<tr>
												<td><?php echo $rs5x->kode; ?></td>
												<td><?php echo $rs5x->uraian; ?></td>
												<td align="right"><?php echo rp($rs5x->anggaranx); ?></td>
												<td align="right"><?php echo rp($rs5x->realisasix); ?></td>
												<td align="right"><?php $selisih=$rs5x->anggaranx-$rs5x->realisasix; echo rp($selisih); ?></td>
												<td align="right"><?php $selisihpersen=($rs5x->realisasix/$rs5x->anggaranx)*100;  echo round($selisihpersen,2) ;?>%</td>
											</tr>
												<?php
												$sql6x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx,sum(realisasi) as realisasix from(
																	   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
																	   uraian,'' as anggaran,'' as realisasi from  akun50_miroring where akun=5 and rincian is not null and subrincian is null
																	   union all
																	   select SUBSTRING_INDEX(t_tampung.koderek50,'.',5) as kode,'' as uraian,sum(t_tampung.pagu) as anggaran,'' as realisasi 
																	   from penyesesuaianperioritas_heder,t_tampung
																	   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."'
																	   and SUBSTRING_INDEX(t_tampung.koderek50,'.',4)='".$rs5x->kode."' group by SUBSTRING_INDEX(t_tampung.koderek50,'.',5)
																	   union all
																	   select SUBSTRING_INDEX(npdls_rinci.koderek50,'.',5) as kode,'' as uraian,'' as anggaran,sum(npkls_rinci.total) as realisasi
																	   from npkls_rinci,npkls_heder,npdls_rinci
																	   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_heder.nonpdls and year(npkls_heder.tglpencairan)='".$_GET['thn']."'
																	   and SUBSTRING_INDEX(npdls_rinci.koderek50,'.',4)='".$rs5x->kode."' group by SUBSTRING_INDEX(npdls_rinci.koderek50,'.',5)
																	   union all
																	   select SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',5) as kode,'' as uraian,'' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi
																	   from spjpanjar_rinci,spjpanjar_heder
																	   where spjpanjar_rinci.nospjpanjar=spjpanjar_heder.nospjpanjar and spjpanjar_heder.verif=1
																	   and year(spjpanjar_heder.tglspjpanjar)='".$_GET['thn']."'
																	   and SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',4)='".$rs5x->kode."' group by SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',5)
																	) as wew group by kode");
												?>
												<?php while($rs6x=$sql6x->fetch_object()){ 
													if($rs6x->anggaranx > 0){
												?>
												<tr>
													<td><?php echo $rs6x->kode; ?></td>
													<td><?php echo $rs6x->uraian; ?></td>
													<td align="right"><?php echo rp($rs6x->anggaranx); ?></td>
													<td align="right"><?php echo rp($rs6x->realisasix); ?></td>
													<td align="right"><?php $selisih=$rs6x->anggaranx-$rs6x->realisasix; echo rp($selisih); ?></td>
													<td align="right"><?php $selisihpersen=($rs6x->realisasix/$rs6x->anggaranx)*100;  echo round($selisihpersen,2) ;?>%</td>
												</tr>
													<?php
													$sql7x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx,sum(realisasi) as realisasix from(
																		   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
																		   uraian,'' as anggaran,'' as realisasi from  akun50_miroring where akun=5 and subrincian is not null
																		   union all
																		   select SUBSTRING_INDEX(t_tampung.koderek50,'.',6) as kode,'' as uraian,sum(t_tampung.pagu) as anggaran,'' as realisasi 
																		   from penyesesuaianperioritas_heder,t_tampung
																		   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."'
																		   and SUBSTRING_INDEX(t_tampung.koderek50,'.',5)='".$rs6x->kode."' group by SUBSTRING_INDEX(t_tampung.koderek50,'.',6)
																		   union all
																		   select SUBSTRING_INDEX(npdls_rinci.koderek50,'.',6) as kode,'' as uraian,'' as anggaran,sum(npkls_rinci.total) as realisasi
																		   from npkls_rinci,npkls_heder,npdls_rinci
																		   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_heder.nonpdls and year(npkls_heder.tglpencairan)='".$_GET['thn']."'
																		   and SUBSTRING_INDEX(npdls_rinci.koderek50,'.',5)='".$rs6x->kode."' group by SUBSTRING_INDEX(npdls_rinci.koderek50,'.',6)
																		   union all
																		   select SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',6) as kode,'' as uraian,'' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi
																		   from spjpanjar_rinci,spjpanjar_heder
																		   where spjpanjar_rinci.nospjpanjar=spjpanjar_heder.nospjpanjar and spjpanjar_heder.verif=1
																		   and year(spjpanjar_heder.tglspjpanjar)='".$_GET['thn']."'
																		   and SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',5)='".$rs6x->kode."' group by SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',6)
																		) as wew group by kode");
													?>
													<?php while($rs7x=$sql7x->fetch_object()){ 
														if($rs7x->anggaranx > 0){
													?>
													<tr>
														<td><?php echo $rs7x->kode; ?></td>
														<td><?php echo $rs7x->uraian; ?></td>
														<td align="right"><?php echo rp($rs7x->anggaranx); ?></td>
														<td align="right"><?php echo rp($rs7x->realisasix); ?></td>
														<td align="right"><?php $selisih=$rs7x->anggaranx-$rs7x->realisasix; echo rp($selisih); ?></td>
														<td align="right"><?php $selisihpersen=($rs7x->realisasix/$rs7x->anggaranx)*100;  echo round($selisihpersen,2) ;?>%</td>
													</tr>
													<?php
														}
														$i++;
														}
													?>
												<?php
													}
													$i++;
													}
												?>
											<?php
												}
												$i++;
												}
											?>
										<?php
											}
											$i++;
											}
										?>
								<?php
									}
									$i++; 
									}
									$anggaranTotalx=$anggaranTotal+$rs2x->anggaranx;
									//$selisihTotal=$selisihTotal+$selisih; $selisihpersenTotal=$selisihpersenTotal+$selisihpersen;
								?>
								<tr class="bodylist" valign="top";>
									<td colspan="2" align="right"><b>JUMLAH</b></td>
									<td align="right"><b><?php echo rp($anggaranTotal); ?></b></td>
									<td align="right"><b><?php echo rp($rs2x->realisasix); ?></b></td>
									<td align="right"><b><?php echo rp($selisihTotal=$anggaranTotal-$rs2x->realisasix); ?><b></td>
									<td align="right"><b><?php $selisihpersen=$rs2x->realisasix/$rs2x->anggaranx*100; echo round($selisihpersen,2); ?>%</b></td>
								</tr>
						</tbody>
				</table>
				</br>
			</div>
		</div>
	</div>
</div>
<?php include("../../close.php"); ?>
<script>
$(document).ready(function() { 
    $('#datatable-button').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>