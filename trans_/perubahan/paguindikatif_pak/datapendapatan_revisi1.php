<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select anggaran_pendapatan.id as id,anggaran_pendapatan.notrans as notrans,anggaran_pendapatan.bidang as bidang,
						anggaran_pendapatan.koderekeningblud as koderekeningblud,anggaran_pendapatan.uraian_rekening as uraian_rekening,
						t_tampung_pendapatan.saldo as nilai,
						anggaran_pendapatan.tahun as tahun
						from anggaran_pendapatan,t_tampung_pendapatan where anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."' 
						and t_tampung_pendapatan.notrans=anggaran_pendapatan.notrans
						union all
						select perubahan.id as id,perubahan.notrans as notrans,perubahan.bidang as bidang,
						perubahan.koderekeningblud as koderekeningblud,perubahan.uraian_rekening as uraian_rekening,
						t_tampung_pendapatan.saldo as nilai,
						perubahan.tahun as tahun
						from perubahan,t_tampung_pendapatan where perubahan.tahun='".$_SESSION["anggaran_tahun"]."' and perubahan.statusperubahan=2
						and t_tampung_pendapatan.notrans=perubahan.notrans group by perubahan.notrans");
	$i=1;
?>
<br />
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>BIDANG </th>
				<th>KODE REKENING BLUD </th>
				<th>URAIAN REKENING</th>
				<th>NILAI</th>
				<th>TAHUN</th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->notrans; ?></td>
				<td><?php echo $rs->bidang; ?></td>
				<td><?php echo $rs->koderekeningblud; ?></td>
				<td><?php echo $rs->uraian_rekening; ?></td>
				<td align="right"><?php echo rpzx($rs->nilai); ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<td>
					<a href="javascript:void(0)" onclick="formperubahan('<?php echo $rs->notrans; ?>','1')"><img src="images/edit.png" width="20" height="20"></a>
				</td>
				
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>
