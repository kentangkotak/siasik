<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="formsppup" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="nip" id="nip">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. SPP</label>
            <input type="text" class="form-control" name="nosppup" id="nosppup" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL SPP</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $tanggaltrans;} ;?>" onClick="return getCalendar(document.form.tgltrans);" />
        </div>	
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Bendahara Pengeluaran</label>
            <input type="text" class="form-control" name="bendaharapengeluaran" id="bendaharapengeluaran" />
        </div>		
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">JUMLAH SPP</label>
            <input type="text" class="form-control" name="jumlahspp" id="jumlahspp" onblur="angka(this);" onkeyup="angka(this);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Nama Bank</label>
            <input type="text" class="form-control" name="namabank" id="namabank" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. Rekening</label>
            <input type="text" class="form-control" name="norekening" id="norekening" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Uraian</label>
            <input type="text" class="form-control" name="uraian" id="uraian" />
        </div>	
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label"> </label>
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN"  onClick="simpansppup();">
        </div>
    </form>            
</div>
</html>
<?php include("../../close.php"); ?>
