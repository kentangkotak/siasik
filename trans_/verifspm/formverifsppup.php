<?php include("../../conn.php"); ?>
<?php
$sql=$conn->query("select * from transsppup where nosppup='".$_GET['nosppup']."' ");
$rs=$sql->fetch_object();
?>
<html>
<div class="x_title">
	<h2>DATA SPP UP</h2>
<div class="clearfix"></div>
</div>        
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="nip" id="nip">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. SPP </label>
            <input type="text" class="form-control" name="nosppup" id="nosppup" readonly="yes" value="<?php echo $_GET['nosppup'];?>";/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL SPP</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?php echo $rs->tglTrans;?>" readonly="yes" />
        </div>	
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Bendahara Pengeluaran</label>
            <input type="text" class="form-control" name="bendaharapengeluaran" id="bendaharapengeluaran" readonly="yes" value="<?php echo $rs->bendaharaKeluar;?>" />
        </div>		
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">JUMLAH SPP</label>
            <input type="text" class="form-control" name="jumlahspp" id="jumlahspp" onblur="angka(this);" readonly="yes" onkeyup="angka(this);" value="<?php echo $rs->jumlahspp;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Nama Bank</label>
            <input type="text" class="form-control" name="namabank" id="namabank" readonly="yes" value="<?php echo $rs->bank;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. Rekening</label>
            <input type="text" class="form-control" name="norekening" id="norekening" readonly="yes" value="<?php echo $rs->kodeRek;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Uraian</label>
            <input type="text" class="form-control" name="uraian" id="uraian" readonly="yes" value="<?php echo $rs->uraian;?>"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label"></label>
		   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="VERIFIKASI" onClick="verifSpp(document.form.nosppup.value);">
		</div>
    </form>            
</div>
<div class="clearfix"></div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
				
				
			  </div>
			</form>				
		
	</div>
</div>
</html>
<?php include("../../close.php"); ?>
