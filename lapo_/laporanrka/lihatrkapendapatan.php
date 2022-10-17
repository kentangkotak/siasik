<?php include("../../conn.php"); ?>
<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>RENCANA KERJA DAN ANGGARAN BELANJA
					TAHUN ANGGARAN  <?php echo  $_SESSION["anggaran_tahun"];?></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center"> 
					<thead>
						<tr>
							<th nowrap="nowrap" rowspan="2" class="column-title dt-head-center">Kode Rekening</th>
							<th nowrap="nowrap" rowspan="2" class="column-title">Uraian </th>
							<th nowrap="nowrap" colspan="3" class="column-title">Rincian Penghitungan</th>
							<th nowrap="nowrap" rowspan="2" class="column-title">Jumlah</th>
						</tr>
						<tr>
							<td>Volume</td>
							<td>Satuan</td>
							<td>Harga</td>
						</tr>
					</thead>
					<tbody>
						<?php 
							$sql_1=$conn->query("select kode1 as kode,uraian 
													from akun_permendagri50 
													where kode1=4 and kode2='' and kode3='' and kode4='' and kode5='' and kode6=''" ); 
							$rs_1=$sql_1->fetch_object();
						?>
						<tr>
							<td><?php echo $rs_1->kode; ?></td>
							<td><?php echo $rs_1->uraian; ?></td>
							<td><?php echo rp($rs_1->anggaran); ?></td>
						</tr>
					</tbody>
			</table>
			</br>
	 </div>
</div>
<?php include("../../close.php"); ?>