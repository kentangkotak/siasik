<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
		$sql=$conn->query("select * from mappingpptkkegiatan where id='".$_GET['id']."'");
		$rs=$sql->fetch_object();
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="x" id="x" value="<?php echo $_GET['id'] ;?>">
	<input type="hidden" name="kodepptk" id="kodepptk" value="<?php echo $rs->kodepptk ;?>">
	<input type="hidden" name="kodebidang" id="kodebidang" value="<?php echo $rs->kodebidang ;?>">
	<input type="hidden" name="bidang" id="bidang" value="<?php echo $rs->bidang ;?>">
	<input type="hidden" name="kodekegiatan" id="kodekegiatan" value="<?php echo $rs->kodekegiatan ;?>">
	<input type="hidden" name="alias" id="alias" value="<?php echo $rs->alias ;?>">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NAMA PPTK</label>
            <input type="text" class="form-control" name="namapptk" id="namapptk" value="<?php echo $rs->namapptk ;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $rs->kegiatan ;?>"/>
        </div>
		<div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanmappingpptkkegiatan();">
            </div>
          </div>
    </form>            
</div>
<div id="grid_pelatihan"></div>
</div>
</html>
<?php include("../../close.php"); ?>
