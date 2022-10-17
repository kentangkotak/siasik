<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npkls_heder where nopencairan='".$_GET['nopencairan']."' ");
	$rs=$sql->fetch_object();
	$tglnpk=out_tanggal("-",$rs->tglnpk);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO PENCAIRAN</label>
            <input type="text" class="form-control" name="nopencairan" id="nopencairan" readonly="yes" value="<?php echo $_GET['nopencairan'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PINDAH BUKU</label>
            <input type="text" class="form-control" name="tglpindahbuku" id="tglpindahbuku" readonly="yes" value="<?php echo $rs->tglpindahbuku;?>" onClick="return getCalendar(document.form.tglpindahbuku);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PENCAIRAN</label>
            <input type="text" class="form-control" name="tglpencairan" id="tglpencairan" readonly="yes" value="<?php echo $rs->tglpencairan;?>" onClick="return getCalendar(document.form.tglpencairan);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO NPK LS</label>
            <input type="text" class="form-control" name="nonpk" id="nonpk" readonly="yes" value="<?php echo $rs->nonpk;?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL NPK LS</label>
            <input type="text" class="form-control" name="tglnpk" id="tglnpk" readonly="yes" value="<?php echo $rs->tglnpk;?>" onClick="return getCalendar(document.form.tglnpk);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">AKUN</label> 
            <input type="text" class="form-control" name="akun" id="akun" value="Akun BLUD" readonly="yes" value="<?php echo $rs->akun;?>"/>
        </div>
    </form>            
</div>
<?php
	$sql=$conn->query("select * from npkls_rinci where nopencairan='".$_GET['nopencairan']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO NPD</th>
				<th>TANGGAL</th>
				<th>KEGIATAN</th>
				<th>KEGIATAN BLUD</th>
				<th>TOTAL</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nonpdls; ?></td>
				<td><?php echo out_tanggal('-',$rs->tglnpd); ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td align="right"><?php echo rpzx($rs->total); ?></td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}
			?>
			<tr class="bodylist" valign="top";>
				<td colspan="5" align="right"><b>TOTAL</b></td>
				<td colspan="6" align="right"><?php echo rpzx($subtotal); ?></td>
			</tr>
		</tbody>
	</table>
<?php include("../../close.php"); ?>