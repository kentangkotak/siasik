<?php include("../../conn.php"); ?>
<?php
	$bln=$_GET["bln"];
	$thn=$_GET["thn"];
	
	if($bln==1){
		$blnx=12;
		$thnx=$thn-1;
	}else{
		$blnx=$bln-1;
		$thnx=$thn;		
	}
	
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
	
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$sql=$conn_simrs->query("
        select * from (
            select
                tgl,
                keu_saldo_awal.noRek,
                concat('Saldo ',keu_rekening_master.namaRek) uraian,
                0 penerimaan,
                0 pengeluaran,
                keu_saldo_awal.saldoAwal saldo,
                0 urut
            from
                keu_saldo_awal,
                keu_rekening_master
            where
                keu_saldo_awal.noRek=keu_rekening_master.noRek
                and keu_saldo_awal.thn='".$thn."'
                and keu_saldo_awal.bln='".$bln."'
            union all
            select
                tgl,
                noRek,
                concat(ket,' (',noTrans,')') uraian,
                nilai penerimaan,
                0 pengeluaran,
                0 saldo,
                1 urut
            from
                keu_trans_pendapatan
            where
                year(tgl)='".$thn."'
                and month(tgl)='".$bln."'
            union all
            select
                rs258.rs2 tgl,
                rs258.noRek,
                concat(rs260.ket,' (',rs258.rs1,')') uraian,
                rs260.rs4 penerimaan,
                0 pengeluaran,
                0 saldo,
                1 urut
            from
                rs258,
                rs260
            where
                rs258.rs1=rs260.rs1
                and year(rs258.rs2)='".$thn."'
                and month(rs258.rs2)='".$bln."'
                and setor='Setor'
                and (rs258.tglBatal is null or rs258.tglBatal='0000-00-00 00:00:00')
            union all
            select tgl,noRek,uraian,sum(penerimaan) penerimaan,pengeluaran,saldo,urut from (
            select
                keu_trans_setor.noSetor,
                keu_trans_setor.tgl,
                rs258.noRek,
                concat(keu_trans_setor.ket,' (',keu_trans_setor.noSetor,')') uraian,
                rs260.rs4 penerimaan,
                0 pengeluaran,
                0 saldo,
                1 urut
            from
                rs258,
                rs260,
                keu_trans_setor
            where
                rs258.rs1=rs260.rs1
                and keu_trans_setor.noSetor = rs258.noSetor
                and year(keu_trans_setor.tgl)='".$thn."'
                and month(keu_trans_setor.tgl)='".$bln."'
                and setor<>'Setor'
                and (rs258.tglBatal is null or rs258.tglBatal='0000-00-00 00:00:00')
            union all
            select
                keu_trans_setor.noSetor,
                keu_trans_setor.tgl,
                keu_trans_setor.noRek,
                concat(ket,' (',keu_trans_setor.noSetor,')') uraian,
                tbp.nilai penerimaan,
                0 pengeluaran,
                0 saldo,
                1 urut
            from
                keu_trans_setor,
                tbp
            where
                tbp.noSetor=keu_trans_setor.noSetor
                and year(keu_trans_setor.tgl)='".$thn."'
                and month(keu_trans_setor.tgl)='".$bln."'   
                and tbp.setor<>'Setor'
            ) as vTunai group by noSetor
            union all
            select
                keu_trans_setor.tgl,
                keu_trans_setor.noRek,
                concat(ket,' (',keu_trans_setor.noSetor,')') uraian,
                tbpuj.nilai penerimaan,
                0 pengeluaran,
                0 saldo,
                1 urut
            from
                keu_trans_setor,
                tbpuj
            where
                tbpuj.noSetor=keu_trans_setor.noSetor
                and year(keu_trans_setor.tgl)='".$thn."'
                and month(keu_trans_setor.tgl)='".$bln."'
                and tbpuj.setor<>'Setor'
            union all
            select
                tglTrans tgl,
                noRekPengirim noRek,
                concat(ket,' (',idTrans,')') uraian,
                0 penerimaan,
                nilai pengeluaran,
                0 saldo,
                2 urut
            from
                keu_trans_bk
            where
                year(tglTrans)='".$thn."'
                and month(tglTrans)='".$bln."'
                and (batal is null or batal='')
            union all
            select
                tglTrans tgl,
                noRek,
                concat(ket,' (',id,')') uraian,
                0 penerimaan,
                nominal pengeluaran,
                0 saldo,
                2 urut
            from
                keu_bp_pph
            where
                year(tglTrans)='".$thn."'
                and month(tglTrans)='".$bln."'
                and (batal is null or batal='')
            union all
            select
                date(tanggalpenerimaan) tgl,
                noRek,
                concat(keterangan,' (',nomorpenerimaan,')') uraian,
                0 penerimaan,
                nominal pengeluaran,
                0 saldo,
                2 urut
            from
                penerimaandaribank
            where
                year(tanggalpenerimaan)='".$thn."'
                and month(tanggalpenerimaan)='".$bln."'
        ) as vBku order by tgl,urut
    ");

	$i=1;
	$sisa=0;
?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbarekapitulasi()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rekapitulasi">-->
<div id="excel_repot_rbabelanja">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				REKAP PENDAPATAN </br>
				UNTUK TAHUN YANG BERAKHIR SAMPAI 31 DESEMBER  <?php echo  $thn;?> </center>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
						<thead>
							<tr>
								<th >No.</th>
								<th>TANGGAL</th>
								<th>URAIAN</th>
								<th>SALDO</th>
								<th>PENERIMAAN</th>
								<th>PENGELUARAN</th>
								<th>SALDO SISA</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$totalPenerimaan = 0;
								$totalPengeluaran = 0;
							?>
							<?php while($bs=$sql->fetch_object() ){ 
								$totalPenerimaan += $bs->penerimaan;
								$totalPengeluaran += $bs->pengeluaran;
							?>
							<tr  class="bodylist" valign="top" bgcolor="<?php echo warna($i);?>">
								<td align="center"><?php echo $i; ?></td>
								<td nowrap="nowrap"><?php echo $bs->tgl; ?></td>
								<!-- <td><?php echo $bs->uraian." - ".$bs->noRek; ?></td> -->
								<td><?php echo $bs->uraian; ?></td>
								<td align="right"><?php if($bs->saldo==0){echo '';}else{echo rp($bs->saldo);} ?></td>
								<td align="right"><?php if($bs->penerimaan==0){echo '';}else{echo rp($bs->penerimaan);} ?></td>
								<td align="right"><?php if($bs->pengeluaran==0){echo '';}else{echo rp($bs->pengeluaran);} ?></td>
								<td align="right"><?php $sisa=$sisa+$bs->saldo+$bs->penerimaan-$bs->pengeluaran; echo rp(round($sisa,2));?></td>
							</tr>
							
							<?php
								$i++;
								}
							?>
							<tr style="background-color: #FFFFFF">
								<td align="right" colspan="3">&nbsp;<?php echo rp($rs->awalx); ?></td>
								<td align="right">&nbsp;</td>
								<td align="right">&nbsp;<?php echo rp($totalPenerimaan); ?></td>
								<td align="right">&nbsp;<?php echo rp($totalPengeluaran); ?></td>
								<td align="right">&nbsp;<?php echo rp($sisa); ?></td>
							</tr>
						</tbody>
				</table>
				</br>
			</div>
		</div>
	</div>
</div>
<?php include("../../close.php"); ?>