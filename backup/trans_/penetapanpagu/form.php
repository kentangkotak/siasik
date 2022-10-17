<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	 <input type="hidden" class="form-control" name="notrans" id="notrans" />
	 <input type="hidden" class="form-control" name="kodekegiatanblud" id="kodekegiatanblud" />
	 <input type="hidden" class="form-control" name="kode1" id="kode1" />
	 <input type="hidden" class="form-control" name="kode2" id="kode2" />
	 <input type="hidden" class="form-control" name="kode3" id="kode3" />
	 <input type="hidden" class="form-control" name="organisasi_nama" id="organisasi_nama" />
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" />
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI RUPIAH</label>
            <input type="text" class="form-control" name="nilairupiah" id="nilairupiah" onblur="angka(this);" onkeyup="angka(this);" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			 <label class="control-label"> </label>
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN"  onClick="simpanpagu();">
        </div>
    </form>            
</div>
</html>
<?php include("../../close.php"); ?>
