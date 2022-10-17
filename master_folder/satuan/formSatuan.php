<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodebagian" id="kodebagian">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NAMA SATUAN</label>
            <input type="text" class="form-control" name="satuan" id="satuan" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanSatuan();">
            </div>
          </div>
    </form>            
</div>

<div id="grid_pelatihan"></div>
</div>
</html>
<?php include("../../close.php"); ?>
