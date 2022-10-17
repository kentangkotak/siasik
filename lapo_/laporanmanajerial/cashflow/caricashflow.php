<?php include("../../../conn.php"); ?>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">-->
<?php
	$tgl=in_tanggal("/",trim($_GET['tgl']));
	$tglx=in_tanggal("/",trim($_GET['tglx']));
	
	$data=explode( '-', $tgl );
	$thn=$data[0];
	$bln=$data[1];
	
	if($bln==1){
		$blnx=12;
		$thnx=$thn-1;
	}else{
		$blnx=$bln-1;
		$thnx=$thn;		
	}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN CASH FLOW </br>
				UNTUK PERIODE <?php echo $tgl;?> SAMPAI PERIODE <?php echo  $tglx;?> </center>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
					<thead>
						<tr>
							<th rowspan="2" class="text-center">ENTITAS</th>
							<th rowspan="2" class="text-center">KEGIATAN</th>
							<th rowspan="2" class="text-center">SALDO AWAL</th>
							<th colspan="4" class="text-center">PENERIMAAN</th>
							<th colspan="4" class="text-center">PENGELUARAN</th>
							<th colspan="4" class="text-center">SALDO AKHIR</th>
						</tr>
						<tr>
							<td class="text-center">BANK</td>
							<td class="text-center">TUNAI</td>
							<td class="text-center">KAS KECIL</td>
							<td class="text-center">TOTAL</td>
							<td class="text-center">BANK</td>
							<td class="text-center">TUNAI</td>
							<td class="text-center">KAS KECIL</td>
							<td class="text-center">TOTAL</td>
							<td class="text-center">BANK</td>
							<td class="text-center">TUNAI</td>
							<td class="text-center">KAS KECIL</td>
							<td class="text-center">TOTAL</td>
						</tr>
					</thead>
					<tbody>
						<?php
							$sqlsaldoppk=$conn->query("select sum(nilai) as saldoppk from t_terima_ppk where year(tgltrans)='".$thnx."' and month(tgltrans)='".$blnx."'");
							$rssaldoppk=$sqlsaldoppk->fetch_object();
							$saldoppk=$rssaldoppk->saldoppk;
						?>
						<?php
							$sql=$conn->query("select entitas,kegiatan,mbank,mtunai,mkaskecil,(mbank+mtunai+mkaskecil) as mtotal,kbank,ktunai,kkaskecil,(kbank+ktunai+kkaskecil)ktotal,
												(mbank-kbank) as sbank,(mtunai-ktunai) as stunai,(mkaskecil-kkaskecil) as skaskecil,((mbank+mtunai+mkaskecil)-(kbank+ktunai+kkaskecil)) as stotal
												from(
															   select 'PPK' as entitas,'Transfer Rekening RS' as kegiatan,sum(nilai) as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   '' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from t_terima_ppk
															   where date(tgltrans)>='".$tgl."' and date(tgltrans)<='".$tglx."'
															   union all
															   select '' as entitas,'Pencairan SPM UP' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   sum(jumlahspp) as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from transSpm
															   where date(tglSpm)>='".$tgl."' and date(tglSpm)<='".$tglx."'
															   union all
															   select '' as entitas,'Pencairan SPM GU' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   'belum selese' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   union all
															   select '' as entitas,'Pencairan LS' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   sum(npkls_rinci.total) as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from npkls_heder,npkls_rinci
															   where npkls_heder.nopencairan=npkls_rinci.nopencairan 
															   and date(npkls_heder.tglpindahbuku)>='2022-04-01' and date(npkls_heder.tglpindahbuku)<='".$tglx."' 
															   and npkls_heder.nopencairan<>''
													) as wew");
						?>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td><?php echo $rs->entitas; ?></td>
							<td><?php echo $rs->kegiatan; ?></td>
							<td></td>
							<td align="right"><?php if($rs->mbank == ''){ echo "";}else{ echo rpy($rs->mbank);} ?></td>
							<td align="right"><?php if($rs->mtunai == ''){ echo "";}else{ echo rpy($rs->mtunai);} ?></td>
							<td align="right"><?php if($rs->mkaskecil == ''){ echo "";}else{ echo rpy($rs->mkaskecil);} ?></td>
							<td align="right"><?php if($rs->mtotal == 0){ echo "";}else{ echo rpy($rs->mtotal);} ?></td>
							<td align="right"><?php if($rs->kbank == '' || $rs->kbank == 0){ echo "";}else{ echo rpy($rs->kbank);} ?></td>
							<td align="right"><?php if($rs->ktunai == ''){ echo "";}else{ echo rpy($rs->ktunai);} ?></td>
							<td align="right"><?php if($rs->kkaskecil == ''){ echo "";}else{ echo rpy($rs->kkaskecil);} ?></td>
							<td align="right"><?php if($rs->ktotal == 0){ echo "";}else{ echo rpy($rs->ktotal);} ?></td>
							<td align="right"><?php if($rs->sbank == '' || $rs->sbank == 0){ echo "";}else{ echo rpy($rs->sbank);} ?></td>
							<td align="right"><?php if($rs->stunai == 0){ echo "";}else{ echo rpy($rs->stunai);} ?></td>
							<td align="right"><?php if($rs->skaskecil == 0){ echo "";}else{ echo rpy($rs->skaskecil);} ?></td>
							<td align="right"><?php if($rs->stotal == 0){ echo "";}else{ echo rpy($rs->stotal);} ?></td>
						</tr>
						<?php
								$i++;
								$tmbank=$tmbank+$rs->mbank;
								$tmtunai=$tmtunai+$rs->mtunai;
								$tmkaskecil=$tmkaskecil+$rs->mkaskecil;
								$ttotal=$ttotal+$rs->mtotal;
								$tkbank=$tkbank+$rs->kbank;
								$tktunai=$tktunai+$rs->ktunai;
								$tkaskecil=$tkaskecil+$rs->kkaskecil;
								$tktotal=$tktotal+$rs->ktotal;
							}
								$saldobank=$tmbank-$tkbank;
								$saldotunai=$tmtunai-$tktunai;
								$saldokaskecil=$tmkaskecil-$tkaskecil;
								$saldototal=$ttotal-$tktotal;
						?>
						<tr style="background-color:#d5d363;">
							<td></td>
							<td></td>
							<td><?php echo $saldoppk;?></td>
							<td align="right"><?php if($tmbank == ''){ echo '';}else{ echo rpy($tmbank);} ;?></td>
							<td align="right"><?php if($tmtunai == ''){ echo '';}else{ echo rpy($tmtunai);} ;?></td>
							<td align="right"><?php if($tmkaskecil == ''){ echo '';}else{ echo rpy($tmkaskecil);} ;?></td>
							<td align="right"><?php if($ttotal == ''){ echo '';}else{ echo rpy($ttotal);} ;?></td>
							<td align="right"><?php if($tkbank == ''){ echo '';}else{ echo rpy($tkbank);} ;?></td>
							<td align="right"><?php if($tktunai == ''){ echo '';}else{ echo rpy($tktunai);} ;?></td>
							<td align="right"><?php if($tkaskecil == ''){ echo '';}else{ echo rpy($tkaskecil);} ;?></td>
							<td align="right"><?php if($tktotal == ''){ echo '';}else{ echo rpy($tktotal);} ;?></td>
							<td align="right"><?php if($saldobank == ''){ echo '';}else{ echo rpy($saldobank);} ;?></td>
							<td align="right"><?php if($saldotunai == ''){ echo '';}else{ echo rpy($saldotunai);} ;?></td>
							<td align="right"><?php if($saldokaskecil == ''){ echo '';}else{ echo rpy($saldokaskecil);} ;?></td>
							<td align="right"><?php if($saldototal == ''){ echo '';}else{ echo rpy($saldototal);} ;?></td>
						</tr>
						<?php
							$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
							$sQuery = $conn_simrs->query("select entitas,kegiatan,mbank,mtunai,mkaskecil,(mbank+mtunai+mkaskecil) as mtotal,kbank,ktunai,kkaskecil,(kbank+ktunai+kkaskecil)ktotal,
														(mbank-kbank) as sbank,(mtunai-ktunai) as stunai,(mkaskecil-kkaskecil) as skaskecil,((mbank+mtunai+mkaskecil)-(kbank+ktunai+kkaskecil)) as stotal
														from(
															 select 'BENDAHARA PENERIMAAN' as entitas,'Billing Pasien (Tunai Kasir)' as kegiatan,'' as mbank,sum(kwitansilog.total) as mtunai,'' as mkaskecil,'' as mtotal,
															 '' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															 from kwitansilog,rs4
															 where date(kwitansilog.tglx)>='".$tgl."' and date(kwitansilog.tglx)<='".$tglx."' 
															 and kwitansilog.userid=rs4.rs1 and kwitansilog.userid<>'51' and kwitansilog.batal=''
															 union all
															 select '' as entitas,'TBP (Kasir)' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															 '' as kbank,sum(kwitansilog.total) as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															 from tbp,kwitansilog
															 where tbp.no_tbp=kwitansilog.no_tbp and kwitansilog.batal='' and tbp.batal='' and 
															 date(tbp.tgl_tbp)>='".$tgl."' and date(tbp.tgl_tbp)<='".$tglx."'
															 union all
															 select '' as entitas,'TBP' as kegiatan,'' as mbank,sum(kwitansilog.total) as mtunai,'' as mkaskecil,'' as mtotal,
															 '' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															 from tbp,kwitansilog
															 where tbp.no_tbp=kwitansilog.no_tbp and kwitansilog.batal='' and tbp.batal='' and 
															 date(tbp.tgl_tbp)>='".$tgl."' and date(tbp.tgl_tbp)<='".$tglx."'
															 union all
															 select '' as entitas,'Transfer Rekening RS' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															 sum(keu_trans_bk.nilai) as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															 from keu_trans_bk,keu_rekening_master
															 where keu_trans_bk.noRekPenerima=keu_rekening_master.noRek and
															 date(keu_trans_bk.tglTrans)>='".$tgl."' and date(keu_trans_bk.tglTrans)<='".$tglx."' and keu_trans_bk.tglVerifPpk is not null
															 union all
															 select '' as entitas,'Penerimaan Uang (Khas Kecil)' as kegiatan,'' as mbank,'' as mtunai,sum(kwitansilog_uj.total) as mkaskecil,'' as mtotal,
															 sum(kwitansilog_uj.total) as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															 from kwitansilog_uj
															 WHERE DATE(kwitansilog_uj.tgl_entry)>='".$tgl."' AND DATE(kwitansilog_uj.tgl_entry)<='".$tglx."'
															 union all
															 select '' as entitas,'Pengeluaran Uang' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															 '' as kbank,'' as ktunai,sum(pengeluarankhaskecil.nominal) as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															 from pengeluarankhaskecil
															 where date(pengeluarankhaskecil.tanggalpengeluaran)>='".$tgl."' and date(pengeluarankhaskecil.tanggalpengeluaran)<='".$tglx."'
															 union all
															 select '' as entitas,'Pendapatan Lain-Lain (Tunai)' as kegiatan,'' as mbank,sum(rs260.rs4) as mtunai,'' as mkaskecil,'' as mtotal,
															 '' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															 from rs258 left join rs260 on rs258.rs1=rs260.rs1
															 where date(rs258.rs2)>='".$tgl."' and date(rs258.rs2)<='".$tglx."' and rs258.setor='Tunai'
															 union all
															 select '' as entitas,'Pendapatan Lain-Lain (Transfer)' as kegiatan,sum(rs260.rs4) as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															 '' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															 from rs258 left join rs260 on rs258.rs1=rs260.rs1
															 where date(rs258.rs2)>='".$tgl."' and date(rs258.rs2)<='".$tglx."' and rs258.setor='Setor'
															 union all
															 select '' as entitas,'PPH' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															 sum(nominal) as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															 from keu_bp_pph
															 where date(tglTrans)>='".$tgl."' and date(tglTrans)<='".$tgl."'
														) as wew");
						?>
						<?php while($rssim=$sQuery->fetch_object()){ ?>
						<tr>
							<td><?php echo $rssim->entitas; ?></td>
							<td><?php echo $rssim->kegiatan; ?></td>
							<td></td>
							<td align="right"><?php if($rssim->mbank == ''){ echo "";}else{ echo rpy($rssim->mbank);} ?></td>
							<td align="right"><?php if($rssim->mtunai == ''){ echo "";}else{ echo rpy($rssim->mtunai);} ?></td>
							<td align="right"><?php if($rssim->mkaskecil == ''){ echo "";}else{ echo rpy($rssim->mkaskecil);} ?></td>
							<td align="right"><?php if($rssim->mtotal == 0){ echo "";}else{ echo rpy($rssim->mtotal);} ?></td>
							<td align="right"><?php if($rssim->kbank == ''){ echo "";}else{ echo rpy($rssim->kbank);} ?></td>
							<td align="right"><?php if($rssim->ktunai == ''){ echo "";}else{ echo rpy($rssim->ktunai);} ?></td>
							<td align="right"><?php if($rssim->kkaskecil == ''){ echo "";}else{ echo rpy($rssim->kkaskecil);} ?></td>
							<td align="right"><?php if($rssim->ktotal == 0){ echo "";}else{ echo rpy($rssim->ktotal);} ?></td>
							<td align="right"><?php if($rssim->sbank == '' || $rssim->sbank == 0 ){ echo "";}else{ echo rpy($rssim->sbank);} ?></td>
							<td align="right"><?php if($rssim->stunai == 0){ echo "";}else{ echo rpy($rssim->stunai);} ?></td>
							<td align="right"><?php if($rssim->skaskecil == 0){ echo "";}else{ echo rpy($rssim->skaskecil);} ?></td>
							<td align="right"><?php if($rssim->stotal == 0){ echo "";}else{ echo rpy($rssim->stotal);} ?></td>
						</tr>
						<?php
								$i++;
								$tmbank_bk=$tmbank_bk+$rssim->mbank;
								$tmtunai_bk=$tmtunai_bk+$rssim->mtunai;
								$tmkaskecil_bk=$tmkaskecil+$rssim->mkaskecil;
								$ttotal_bk=$ttotal_bk+$rssim->mtotal;
								$tkbank_bk=$tkbank_bk+$rssim->kbank;
								$tktunai_bk=$tktunai_bk+$rssim->ktunai;
								$tkaskecil_bk=$tkaskecil_bk+$rssim->kkaskecil;
								$tktotal_bk=$tktotal_bk+$rssim->ktotal;
							}
								$saldobank_bk=$tmbank_bk-$tkbank_bk;
								$saldotunai_bk=$tmtunai_bk-$tktunai_bk;
								$saldokaskecil_bk=$tmkaskecil_bk-$tkaskecil_bk;
								$saldototal_bk=$ttotal_bk-$tktotal_bk;
						?>
						<tr style="background-color:#d5d363;">
							<td></td>
							<td></td>
							<td></td>
							<td align="right"><?php if($tmbank_bk == ''){ echo '';}else{ echo rpy($tmbank_bk);} ;?></td>
							<td align="right"><?php if($tmtunai_bk == ''){ echo '';}else{ echo rpy($tmtunai_bk);} ;?></td>
							<td align="right"><?php if($tmkaskecil_bk == ''){ echo '';}else{ echo rpy($tmkaskecil_bk);} ;?></td>
							<td align="right"><?php if($ttotal_bk == ''){ echo '';}else{ echo rpy($ttotal_bk);} ;?></td>
							<td align="right"><?php if($tkbank_bk == ''){ echo '';}else{ echo rpy($tkbank_bk);} ;?></td>
							<td align="right"><?php if($tktunai_bk == ''){ echo '';}else{ echo rpy($tktunai_bk);} ;?></td>
							<td align="right"><?php if($tkaskecil_bk == ''){ echo '';}else{ echo rpy($tkaskecil_bk);} ;?></td>
							<td align="right"><?php if($tktotal_bk == ''){ echo '';}else{ echo rpy($tktotal_bk);} ;?></td>
							<td align="right"><?php if($saldobank_bk == ''){ echo '';}else{ echo rpy($saldobank_bk);} ;?></td>
							<td align="right"><?php if($saldotunai_bk == ''){ echo '';}else{ echo rpy($saldotunai_bk);} ;?></td>
							<td align="right"><?php if($saldokaskecil_bk == ''){ echo '';}else{ echo rpy($saldokaskecil_bk);} ;?></td>
							<td align="right"><?php if($saldototal_bk == ''){ echo '';}else{ echo rpy($saldototal_bk);} ;?></td>
						</tr>
						<?php
							$sqlbp=$conn->query("select entitas,kegiatan,mbank,mtunai,mkaskecil,(mbank+mtunai+mkaskecil) as mtotal,kbank,ktunai,kkaskecil,(kbank+ktunai+kkaskecil)ktotal,
												(mbank-kbank) as sbank,(mtunai-ktunai) as stunai,(mkaskecil-kkaskecil) as skaskecil,((mbank+mtunai+mkaskecil)-(kbank+ktunai+kkaskecil)) as stotal
												from(
															   select 'BENDAHARA PENGELUARAN' as entitas,'Pencairan SPM UP' as kegiatan,sum(jumlahspp) as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   '' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from transSpm
															   where date(tglSpm)>='".$tgl."' and date(tglSpm)<='".$tglx."'
															   union all
															   select '' as entitas,'Pergeseran Kas (Pencairan Panjar)' as kegiatan,'' as mbank,sum(pergeseranTrinci.jumlah) as mtunai,'' as mkaskecil,'' as mtotal,
															   '' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from pergeseranTheder left join pergeseranTrinci
															   on pergeseranTheder.notrans=pergeseranTrinci.notrans 
															   where date(pergeseranTheder.tgltrans)>='".$tgl."' and date(pergeseranTheder.tgltrans)<='".$tglx."'
															   union all
															   select '' as entitas,'Nota Panjar' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   '' as kbank,sum(notapanjar_rinci.total) as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from notapanjar_heder,notapanjar_rinci
															   where notapanjar_heder.nonotapanjar=notapanjar_rinci.nonotapanjar
															   and date(notapanjar_heder.tglnotapanjar)>='".$tgl."' and date(notapanjar_heder.tglnotapanjar)<='".$tglx."'
															   union all
															   select '' as entitas,'Pencairan LS' as kegiatan,sum(npkls_rinci.total) as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   sum(npkls_rinci.total) as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from npkls_heder,npkls_rinci
															   where npkls_heder.nopencairan=npkls_rinci.nopencairan 
															   and date(npkls_heder.tglpindahbuku)>='".$tgl."' and date(npkls_heder.tglpindahbuku)<='".$tglx."'  and npkls_heder.nopencairan<>'' 
																and npkls_heder.kunci=1
															   union all
															   select '' as entitas,'Setoran Pajak' as kegiatan,
															   sum(npdls_pajak.pph21+npdls_pajak.pph22+npdls_pajak.pph23+npdls_pajak.pph25+npdls_pajak.pasal4+npdls_pajak.ppnpusat+npdls_pajak.pajakdaerah) as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   sum(npdls_pajak.pph21+npdls_pajak.pph22+npdls_pajak.pph23+npdls_pajak.pph25+npdls_pajak.pasal4+npdls_pajak.ppnpusat+npdls_pajak.pajakdaerah) as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from npdls_heder,npdls_pajak
															   where npdls_heder.nonpdls=npdls_pajak.nonpdls
															   and date(npdls_heder.tglnpdls)>='".$tgl."' and date(npdls_heder.tglnpdls)<='".$tglx."'
															   union all
															   select '' as entitas,'Contrapost' as kegiatan,sum(nominalcontrapost) as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   '' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from contrapost
															   where date(tglcontrapost)>='".$tgl."' and date(tglcontrapost)<='".$tglx."'
													) as wew");
						?>
						<?php while($rsbp=$sqlbp->fetch_object()){ ?>
						<tr>
							<td><?php echo $rsbp->entitas; ?></td>
							<td><?php echo $rsbp->kegiatan; ?></td>
							<td></td>
							<td align="right"><?php if($rsbp->mbank == ''){ echo "";}else{ echo rpy($rsbp->mbank);} ?></td>
							<td align="right"><?php if($rsbp->mtunai == ''){ echo "";}else{ echo rpy($rsbp->mtunai);} ?></td>
							<td align="right"><?php if($rsbp->mkaskecil == ''){ echo "";}else{ echo rpy($rsbp->mkaskecil);} ?></td>
							<td align="right"><?php if($rsbp->mtotal == 0){ echo "";}else{ echo rpy($rsbp->mtotal);} ?></td>
							<td align="right"><?php if($rsbp->kbank == ''){ echo "";}else{ echo rpy($rsbp->kbank);} ?></td>
							<td align="right"><?php if($rsbp->ktunai == ''){ echo "";}else{ echo rpy($rsbp->ktunai);} ?></td>
							<td align="right"><?php if($rsbp->kkaskecil == ''){ echo "";}else{ echo rpy($rsbp->kkaskecil);} ?></td>
							<td align="right"><?php if($rsbp->ktotal == 0){ echo "";}else{ echo rpy($rsbp->ktotal);} ?></td>
							<td align="right"><?php if($rsbp->sbank == '' || $rsbp->sbank == 0){ echo "";}else{ echo rpy($rsbp->sbank);} ?></td>
							<td align="right"><?php if($rsbp->stunai == 0){ echo "";}else{ echo rpy($rsbp->stunai);} ?></td>
							<td align="right"><?php if($rsbp->skaskecil == 0){ echo "";}else{ echo rpy($rsbp->skaskecil);} ?></td>
							<td align="right"><?php if($rsbp->stotal == 0){ echo "";}else{ echo rpy($rsbp->stotal);} ?></td>
						</tr>
						<?php
								$i++;
								$tmbankbp=$tmbankbp+$rsbp->mbank;
								$tmtunaibp=$tmtunaibp+$rsbp->mtunai;
								$tmkaskecilbp=$tmkaskecilbp+$rsbp->mkaskecil;
								$ttotalbp=$ttotalbp+$rsbp->mtotal;
								$tkbankbp=$tkbankbp+$rsbp->kbank;
								$tktunaibp=$tktunaibp+$rsbp->ktunai;
								$tkaskecilbp=$tkaskecilbp+$rsbp->kkaskecil;
								$tktotalbp=$tktotalbp+$rsbp->ktotal;
							}
								$saldobankbp=$tmbankbp-$tkbankbp;
								$saldotunaibp=$tmtunaibp-$tktunaibp;
								$saldokaskecilbp=$tmkaskecilbp-$tkaskecilbp;
								$saldototalbp=$ttotalbp-$tktotalbp;
						?>
						<tr style="background-color:#d5d363;">
							<td></td>
							<td></td>
							<td></td>
							<td align="right"><?php if($tmbankbp == ''){ echo '';}else{ echo rpy($tmbankbp);} ;?></td>
							<td align="right"><?php if($tmtunaibp == ''){ echo '';}else{ echo rpy($tmtunaibp);} ;?></td>
							<td align="right"><?php if($tmkaskecilbp == ''){ echo '';}else{ echo rpy($tmkaskecilbp);} ;?></td>
							<td align="right"><?php if($ttotalbp == ''){ echo '';}else{ echo rpy($ttotalbp);} ;?></td>
							<td align="right"><?php if($tkbankbp == ''){ echo '';}else{ echo rpy($tkbankbp);} ;?></td>
							<td align="right"><?php if($tktunaibp == ''){ echo '';}else{ echo rpy($tktunaibp);} ;?></td>
							<td align="right"><?php if($tkaskecilbp == ''){ echo '';}else{ echo rpy($tkaskecilbp);} ;?></td>
							<td align="right"><?php if($tktotalbp == ''){ echo '';}else{ echo rpy($tktotalbp);} ;?></td>
							<td align="right"><?php if($saldobankbp == '' || $saldobankbp == 0){ echo '';}else{ echo rpy($saldobankbp);} ;?></td>
							<td align="right"><?php if($saldotunaibp == ''){ echo '';}else{ echo rpy($saldotunaibp);} ;?></td>
							<td align="right"><?php if($saldokaskecilbp == ''){ echo '';}else{ echo rpy($saldokaskecilbp);} ;?></td>
							<td align="right"><?php if($saldototalbp == ''){ echo '';}else{ echo rpy($saldototalbp);} ;?></td>
						</tr>
						<tr>
							<td>PPTK</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
							$sqlpptk=$conn->query("select * from mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' group by kodepptk order by bidang");
						?>
						<?php while($rspptk=$sqlpptk->fetch_object()){ ?>
						<tr>
							<td><?php echo $rspptk->namapptk; ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
								$tmbankbpaksi=0;
								$tmtunaibpaksi=0;
								$tmkaskecilbpaksi=0;
								$ttotalbpaksi=0;
								$tkbankbpaksi=0;
								$tktunaibpaksi=0;
								$tkaskecilbpaksi=0;
								$tktotalbpaksi=0;
								$saldobankbpaksi=0;
								$saldotunaibpaksi=0;
								$saldokaskecilbpaksi=0;
								$saldototalbpaksi=0;
								
								$sqlkegiatan=$conn->query("select * from mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' and kodepptk='".$rspptk->kodepptk."'");
						?>
						<?php while($rskegiatan=$sqlkegiatan->fetch_object()){ ?>
						<tr style="background-color:#FFE4C4;">
							<td></td>
							<td><?php echo $rskegiatan->kegiatan; ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<?php
							$sqlaksi=$conn->query("select entitas,kegiatan,mbank,mtunai,mkaskecil,(mbank+mtunai+mkaskecil) as mtotal,kbank,ktunai,kkaskecil,(kbank+ktunai+kkaskecil)ktotal,
												(mbank-kbank) as sbank,(mtunai-ktunai) as stunai,(mkaskecil-kkaskecil) as skaskecil,((mbank+mtunai+mkaskecil)-(kbank+ktunai+kkaskecil)) as stotal
												from(
															   select '' as entitas,'Nota Panjar' as kegiatan,'' as mbank,sum(notapanjar_rinci.total) as mtunai,'' as mkaskecil,'' as mtotal,
															   '' as kbank,'' as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from notapanjar_heder,notapanjar_rinci
															   where notapanjar_heder.nonotapanjar=notapanjar_rinci.nonotapanjar
															   and date(notapanjar_heder.tglnotapanjar)>='".$tgl."' and date(notapanjar_heder.tglnotapanjar)<='".$tglx."'
															   and notapanjar_heder.kodepptk='".$rskegiatan->kodepptk."'
															   union all
															   select '' as entitas,'SPJ Panjar' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   '' as kbank,sum(spjpanjar_rinci.jumlahbelanjapanjar) as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from spjpanjar_heder left join spjpanjar_rinci
															   on spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar 
															   where date(spjpanjar_heder.tglspjpanjar)>='".$tgl."' and date(spjpanjar_heder.tglspjpanjar)<='".$tglx."'
															   and spjpanjar_heder.kodepptk='".$rskegiatan->kodepptk."'
															   union all
															   select '' as entitas,'Pengembalian Panjar' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   '' as kbank,sum(pengembalianpanjar_rinci.sisapanjar) as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from pengembalianpanjar_heder,pengembalianpanjar_rinci
															   where pengembalianpanjar_heder.nopengembalianpanjar=pengembalianpanjar_rinci.nopengembalianpanjar and
															   date(pengembalianpanjar_heder.tglpengembalianpanjar)>='".$tgl."' and date(pengembalianpanjar_heder.tglpengembalianpanjar)<='".$tglx."'
															   and pengembalianpanjar_heder.kodepptk='".$rskegiatan->kodepptk."'
															   union all
															   select '' as entitas,'Pengembalian Sisa Panjar' as kegiatan,'' as mbank,'' as mtunai,'' as mkaskecil,'' as mtotal,
															   '' as kbank,sum(pengembaliansisapanjar_rinci.sisapanjar) as ktunai,'' as kkaskecil,'' as ktotal,'' as sbank,'' as stunai,'' as skaskecil,'' as stotal
															   from pengembaliansisapanjar_heder LEFT join pengembaliansisapanjar_rinci on
															   pengembaliansisapanjar_heder.nopengembaliansisapanjar=pengembaliansisapanjar_rinci.nopengembaliansisapanjar
															   where date(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)>='".$tgl."' and date(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)>='".$tglx."'
															   and pengembaliansisapanjar_heder.kodepptk='".$rskegiatan->kodepptk."'
													) as wew");
						?>
						<?php while($rsaksi=$sqlaksi->fetch_object()){ ?>
						<tr>
							<td><?php echo $rsaksi->entitas; ?></td>
							<td><?php echo $rsaksi->kegiatan; ?></td>
							<td></td>
							<td align="right"><?php if($rsaksi->mbank == ''){ echo "";}else{ echo rpy($rsaksi->mbank);} ?></td>
							<td align="right"><?php if($rsaksi->mtunai == ''){ echo "";}else{ echo rpy($rsaksi->mtunai);} ?></td>
							<td align="right"><?php if($rsaksi->mkaskecil == ''){ echo "";}else{ echo rpy($rsaksi->mkaskecil);} ?></td>
							<td align="right"><?php if($rsaksi->mtotal == 0){ echo "";}else{ echo rpy($rsaksi->mtotal);} ?></td>
							<td align="right"><?php if($rsaksi->kbank == '' || $rsaksi->kbank == 0){ echo "";}else{ echo rpy($rs->kbank);} ?></td>
							<td align="right"><?php if($rsaksi->ktunai == ''){ echo "";}else{ echo rpy($rsaksi->ktunai);} ?></td>
							<td align="right"><?php if($rsaksi->kkaskecil == ''){ echo "";}else{ echo rpy($rsaksi->kkaskecil);} ?></td>
							<td align="right"><?php if($rsaksi->ktotal == 0){ echo "";}else{ echo rpy($rsaksi->ktotal);} ?></td>
							<td align="right"><?php if($rsaksi->sbank == '' || $rsaksi->sbank == 0){ echo "";}else{ echo rpy($rs->sbank);} ?></td>
							<td align="right"><?php if($rsaksi->stunai == 0){ echo "";}else{ echo rpy($rsaksi->stunai);} ?></td>
							<td align="right"><?php if($rsaksi->skaskecil == 0){ echo "";}else{ echo rpy($rsaksi->skaskecil);} ?></td>
							<td align="right"><?php if($rsaksi->stotal == 0){ echo "";}else{ echo rpy($rsaksi->stotal);} ?></td>
						</tr>
						<?php
								$i++;
								$tmbankbpaksi=$tmbankbpaksi+$rsaksi->mbank;
								$tmtunaibpaksi=$tmtunaibpaksi+$rsaksi->mtunai;
								$tmkaskecilbpaksi=$tmkaskecilbpaksi+$rsaksi->mkaskecil;
								$ttotalbpaksi=$ttotalbpaksi+$rsaksi->mtotal;
								$tkbankbpaksi=$tkbankbpaksi+$rsaksi->kbank;
								$tktunaibpaksi=$tktunaibpaksi+$rsaksi->ktunai;
								$tkaskecilbpaksi=$tkaskecilbpaksi+$rsaksi->kkaskecil;
								$tktotalbpaksi=$tktotalbpaksi+$rsaksi->ktotal;
							}
								$saldobankbpaksi=$tmbankbpaksi-$tkbankbpaksi;
								$saldotunaibpaksi=$tmtunaibpaksi-$tktunaibpaksi;
								$saldokaskecilbpaksi=$tmkaskecilbpaksi-$tkaskecilbpaksi;
								$saldototalbpaksi=$ttotalbpaksi-$tktotalbpaksi;
						?>
						<tr style="background-color:#d5d363;">
							<td></td>
							<td></td>
							<td></td>
							<td align="right"><?php if($tmbankbpaksi == ''){ echo '';}else{ echo rpy($tmbankbpaksi);} ;?></td>
							<td align="right"><?php if($tmtunaibpaksi == ''){ echo '';}else{ echo rpy($tmtunaibpaksi);} ;?></td>
							<td align="right"><?php if($tmkaskecilbpaksi == ''){ echo '';}else{ echo rpy($tmkaskecilbpaksi);} ;?></td>
							<td align="right"><?php if($ttotalbpaksi == ''){ echo '';}else{ echo rpy($ttotalbpaksi);} ;?></td>
							<td align="right"><?php if($tkbankbpaksi == ''){ echo '';}else{ echo rpy($tkbankbpaksi);} ;?></td>
							<td align="right"><?php if($tktunaibpaksi == ''){ echo '';}else{ echo rpy($tktunaibpaksi);} ;?></td>
							<td align="right"><?php if($tkaskecilbpaksi == ''){ echo '';}else{ echo rpy($tkaskecilbpaksi);} ;?></td>
							<td align="right"><?php if($tktotalbpaksi == ''){ echo '';}else{ echo rpy($tktotalbpaksi);} ;?></td>
							<td align="right"><?php if($saldobankbpaksi == '' || $saldobankbpaksi == 0){ echo '';}else{ echo rpy($saldobankbpaksi);} ;?></td>
							<td align="right"><?php if($saldotunaibpaksi == ''){ echo '';}else{ echo rpy($saldotunaibpaksi);} ;?></td>
							<td align="right"><?php if($saldokaskecilbpaksi == ''){ echo '';}else{ echo rpy($saldokaskecilbpaksi);} ;?></td>
							<td align="right"><?php if($saldototalbpaksi == ''){ echo '';}else{ echo rpy($saldototalbpaksi);} ;?></td>
							
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