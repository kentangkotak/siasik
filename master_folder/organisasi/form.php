<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodebagian" id="kodebagian">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Kode 1</label>
            <input type="text" class="form-control" name="kode1" id="kode1"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Kode 2</label>
            <input type="text" class="form-control" name="kode2" id="kode2"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Kode 3</label>
            <input type="text" class="form-control" name="kode3" id="kode3"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Kode 4</label>
            <input type="text" class="form-control" name="kode4" id="kode4"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Nama Organisasi</label>
            <input type="text" class="form-control" name="nama" id="nama"/>
        </div>
		<div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpan();">
            </div>
          </div>
    </form>            
</div>

<div id="grid_pelatihan"></div>
</div>
</html>
<?php include("../../close.php"); ?>
