<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from mapping_blud_79 where akun='".$_GET['akun']."' and kelompok='".$_GET['kelompok']."' 
	and jenis='".$_GET['jenis']."' and objectx='".$_GET['objectx']."' and rincian='".$_GET['rincian']."' and subrincian='".$_GET['subrincian']."'");
	$rs=$sql->fetch_object();
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="akun" id="akun" value="<?php echo $rs->akun; ?>">
	<input type="hidden" name="kelompok" id="kelompok" value="<?php echo $rs->kelompok; ?>">
	<input type="hidden" name="jenis" id="jenis" value="<?php echo $rs->jenis; ?>">
	<input type="hidden" name="objectx" id="objectx" value="<?php echo $rs->objectx; ?>">
	<input type="hidden" name="rincian" id="rincian" value="<?php echo $rs->rincian; ?>">
	<input type="hidden" name="subrincian" id="subrincian" value="<?php echo $rs->subrincian; ?>">
	<input type="hidden" name="kode_791" id="kode_791" value="<?php echo $rs->kode_791; ?>">
	<input type="hidden" name="kode_792" id="kode_792" value="<?php echo $rs->kode_792; ?>">
	<input type="hidden" name="kode_793" id="kode_793" value="<?php echo $rs->kode_793; ?>">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Akun</label>
            <input type="text" class="form-control" readonly value="<?php echo $rs->akun.".".$rs->kelompok.".".$rs->jenis.".".$rs->objectx.".".$rs->rincian.".".$rs->subrincian; ?>" name="kode_akun" id="kode_akun"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Uraian</label>
            <input type="text" readonly value="<?php echo $rs->uraian; ?>" class="form-control" name="uraian_induk" id="uraian_induk"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Uraian Permendagri 79</label>
            <input type="text" value="<?php echo $rs->uraian_79; ?>" class="form-control" name="uraian_79" id="uraian_79"/>
        </div>
		<div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="Simpan" size="20" onClick="simpan_mapping();">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="treset" class="btn btn-success btn-block" id="tsimpan" value="Reset" size="20" onClick="reset_mapping();">
            </div>
          </div>
        </div>
    </form>
</div>

<div id="grid_pelatihan"></div>
</div>
</html>
<?php include("../../close.php"); ?>
