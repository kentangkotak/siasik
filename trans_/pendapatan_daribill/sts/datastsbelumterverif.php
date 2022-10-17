<?php include("../../../conn.php"); ?>
<?php
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$sql=$conn_simrs->query("
	select
            *
        from 
            keu_trans_bk,keu_rekening_master
        where keu_trans_bk.noRekPenerima=keu_rekening_master.norek and keu_trans_bk.noRekPenerima='0121161061' and 
            (keu_trans_bk.batal='' or keu_trans_bk.batal) is null and (keu_trans_bk.tglVerifPpk='0000-00-00 00:00:00' or keu_trans_bk.tglVerif is null)
			and year(keu_trans_bk.tglTrans)='".$_SESSION["anggaran_tahun"]."' and flagverif='' group by noTransfer order by keu_trans_bk.tglTrans desc");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>ID TRANS </th>
				<th>NOTA DINAS</th>
				<th>NO TRANSFER</th>
				<th>Tanggal</th>
				<th>NILAI</th>
				<th>NO REKENING PENGIRIM</th>
				<th>NO REKENING PENERIMA</th>
				<th>KET</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->idTrans; ?></td>
				<td><?php echo $rs->notaDinas; ?></td>
				<td><?php echo $rs->noTransfer; ?></td>
				<td><?php echo $rs->tglTrans; ?></td>
				<td><?php echo rpzx($rs->nilai); ?></td>
				<td><?php echo $rs->noRekPengirim; ?></td>
				<td><?php echo $rs->noRekPenerima; ?></td>
				<td><?php echo $rs->ket; ?></td>
				<td>
					<a href="javascript:void(0)" onclick="verif('<?php echo $rs->idTrans; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i>VERIFIKASI </a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>