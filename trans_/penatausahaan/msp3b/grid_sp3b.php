<?php include("../../../conn.php"); ?>
<?php
	$data=explode("-",$_GET['bulandantahun']);
	$tahun=$data[0];
	$bulan=$data[1];
	
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$sqlsimPendapatan=$conn_simrs->query("select sum(penerimaan) as penerimaan from (
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
						month(tgl)='".$bulan."' and
						year(tgl)='".$tahun."'
						and noTrans not like '%TBP-UJ%'
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
						and month(rs258.rs2)='".$bulan."'
						and month(rs258.rs2)='".$tahun."'
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
						and month(keu_trans_setor.tgl) ='".$bulan."'
						and year(keu_trans_setor.tgl) ='".$tahun."'
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
						and month(keu_trans_setor.tgl) ='".$bulan."'
						and year(keu_trans_setor.tgl) ='".$tahun."'
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
						and month(keu_trans_setor.tgl) ='".$bulan."'
						and year(keu_trans_setor.tgl) ='".$tahun."'
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
						month(tglTrans)='".$bulan."'
						and year(tglTrans)='".$tahun."'
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
						month(tglTrans)='".$bulan."'
						and year(tglTrans)='".$tahun."'
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
						month (tanggalpenerimaan)='".$bulan."'
						and year(tanggalpenerimaan)='".$tahun."'
				) as vBku order by tgl,urut");
	$rsPendapatan=$sqlsimPendapatan->fetch_object();
	$penerimaan=$rsPendapatan->penerimaan;
	
	$sql=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
						uraian
						from  akun50_miroring,t_tampung_pendapatan 
						where akun=4 and kelompok=1 and jenis=04 and objectx=16 and rincian=01 and subrincian is not null and t_tampung_pendapatan.tahun='".$tahun."'" );
	$rs=$sql->fetch_object();
?>
<table class="table table-hover table-bordered table table-striped">
	<thead>
		<tr>
			<th nowrap="nowrap">KODE</th>
			<th nowrap="nowrap">URAIAN</th>
			<th nowrap="nowrap">REALISASI</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $rs->kode; ?></td>
			<td><?php echo $rs->uraian; ?></td>
			<td align="right"><?php echo rpzx($penerimaan); ?></td>
		</tr>
		<?php
			$sqlx=$conn->query("select kode,uraian,round(sum(realisasi)-sum(kurangi),2) as realisasix from(
				   select SUBSTRING_INDEX(npdls_rinci.koderek50,'.',6) as kode,npdls_rinci.rincianbelanja as uraian,sum(npdls_rinci.nominalpembayaran) as realisasi,'' as kurangi
				   from npkls_rinci,npkls_heder,npdls_rinci
				   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_rinci.nonpdls 
				   and year(npkls_heder.tglpencairan)='".$tahun."' and month(npkls_heder.tglpencairan) ='".$bulan."' 
				   group by npdls_rinci.koderek50,npkls_heder.nopencairan,npdls_rinci.nonpdls
				   union all
				   select SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',6) as kode,spjpanjar_rinci.rincianbelanja50 as uraian,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi,'' as kurangi
				   from spjpanjar_rinci,spjpanjar_heder
				   where spjpanjar_rinci.nospjpanjar=spjpanjar_heder.nospjpanjar and spjpanjar_heder.verif=1
				   and year(spjpanjar_heder.tglspjpanjar)='".$tahun."' and month(spjpanjar_heder.tglspjpanjar)='".$bulan."'
				   group by SUBSTRING_INDEX(spjpanjar_rinci.koderek50,'.',6)
				   union all
				   select SUBSTRING_INDEX(koderek50,'.',6) as kode,rincianbelanja as uraian,'' as realisasi,sum(nominalcontrapost) as kurangi
				   from contrapost
				   where year(tglcontrapost)='".$tahun."' and MONTH(tglcontrapost)='".$bulan."' 
				   group by SUBSTRING_INDEX(koderek50,'.',6)
				) as wew group by kode");
			?>
			<?php while($rsx=$sqlx->fetch_object()){ ?>
			<tr>
				<td><?php echo $rsx->kode; ?></td>
				<td><?php echo $rsx->uraian; ?></td>
				<td align="right"><?php echo rpzx($rsx->realisasix); ?></td>
			</tr>
			<?php $subtotal=$subtotal+$rsx->realisasix; } ?>
			<tr>
				<td colspan="1" align="right">SUBTOTAL</td>
				<td align="right"><?php echo "PENDAPATAN==> ".rpzx($penerimaan); ?></td>
				<td align="right"><?php echo "BELANJA==> ".rpzx($subtotal); ?></td>
			</tr>
	</tbody>
</table>
<?php
	$sql_cek=$conn->query("select * from sp3b where year(bulan_realisasi) ='".$tahun."' and month(bulan_realisasi)='".$bulan."'");
	$rs=$sql_cek->fetch_object();
	
	if($rs->pendapatan == '' && $rs->realisasi == ''){
		$conn->query("update sp3b set pendapatan='".$penerimaan."',realisasi='".$subtotal."' where year(bulan_realisasi) ='".$tahun."' and month(bulan_realisasi)='".$bulan."' ");
	}
?>
<?php include("../../../close.php"); ?>