<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select penyesesuaianperioritas_heder.namabidang as namabidang,penyesesuaianperioritas_heder.pptk as pptk,penyesesuaianperioritas_rinci.koderek50 as koderek50,
penyesesuaianperioritas_rinci.uraian50 as uraian50,penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.nilai as anggaran
from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and penyesesuaianperioritas_rinci.koderek50='".$_GET['kode50']."' 
and year(tgltrans)='".$_SESSION["anggaran_tahun"]."'");
?>
<div id="excel_repot_rbabelanja">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<center>BIDANG YANG MENGUSULAN KODE REKEKNING </br>
				<?php echo  $_GET['kode50'];?> </br>
				UNTUK TAHUN YANG BERAKHIR SAMPAI 31 DESEMBER  <?php echo  $_SESSION["anggaran_tahun"];?> </center>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
						<thead>
							<tr>
								<th nowrap="nowrap">NAMA BIDANG</th>
								<th nowrap="nowrap">PPTK</th>
								<th nowrap="nowrap">KODE REKENING 50</th>
								<th nowrap="nowrap">URAIAN KODE REKENING 50</th>
								<th nowrap="nowrap">USULAN</th>
								<th nowrap="nowrap">ANGGARAN</th>
							</tr>
						</thead>
						<tbody>
						<?php while($rs=$sql->fetch_object()){;?>
							<tr>
								<td><b><?php echo $rs->namabidang; ?></b></td>
								<td><b><?php echo $rs->pptk; ?></b></td>
								<td><b><?php echo $rs->koderek50; ?></b></td>
								<td><b><?php echo $rs->uraian50; ?></b></td>
								<td><b><?php echo $rs->usulan; ?></b></td>
								<td align="right"><b><?php echo rp($rs->anggaran); ?></b></td>
							</tr>
						<?php
							 $i++; $total=$total+$rs->anggaran;}
							?>
							<tr class="bodylist" valign="top";>
								<td colspan="5" align="right"><b>JUMLAH</b></td>
								<td align="right"><b><?php echo rp($total); ?></b></td>
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
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>