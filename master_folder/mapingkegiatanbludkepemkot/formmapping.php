<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="level1" id="level1">
	<input type="hidden" name="level2" id="level2">
	<input type="hidden" name="level3" id="level3">
	<input type="hidden" name="level4" id="level4">
	<input type="hidden" name="level5" id="level5">
	<input type="hidden" name="organisasilama" id="organisasilama">
	<input type="hidden" name="bidang" id="bidang">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KODE KEGIATAN LEVEL 5</label>
            <input type="text" class="form-control" name="kodekegiatan" id="kodekegiatan" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NOMENKLATUR LEVEL 5</label>
            <input type="text" class="form-control" name="nomenklaturlevel5" id="nomenklaturlevel5"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NOMENKLATUR BLUD</label>
            <input type="text" class="form-control" name="nomenklaturblud" id="nomenklaturblud"/>
        </div>
		<div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanmapingpermen50keblud();">
            </div>
          </div>
    </form>            
</div>

<div id="grid_pelatihan"></div>
</div>
</html>
<?php include("../../close.php"); ?>
