<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from t_terima_ppk where year(tgltrans)='".$_SESSION["anggaran_tahun"]."' order by tgltrans desc");
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
				<th>TANGGAL VERIF</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->idtrans; ?></td>
				<td><?php echo $rs->notadinas; ?></td>
				<td><?php echo $rs->notransfer; ?></td>
				<td><?php echo $rs->tgltrans; ?></td>
				<td><?php echo rpzx($rs->nilai); ?></td>
				<td><?php echo $rs->norekpengirim; ?></td>
				<td><?php echo $rs->norekpenerima; ?></td>
				<td><?php echo $rs->ket; ?></td>
				<td><?php echo $rs->tglverif; ?></td>
				<td>
				<?php if($_SESSION["anggaran_level"] == 'SUPER'){ ?>
					<a href="javascript:void(0)" onclick="batalverif('<?php echo $rs->idtrans; ?>')" class="btn btn-primary btn-xs">BATAL VERIFIKASI </a>
				<?php }else{ ?>
					SUDAH VERIFIKASI
				<?php } ?>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>