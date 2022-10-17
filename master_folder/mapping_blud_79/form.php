<?php include("../../conn.php"); ?>
<?php
	if($_GET['kode']==''){
		$uraian_induk='';
	}
	else{
		$kode=explode('.',$_GET['kode']);
		$sql_kode="select uraian from akun_permendagri79 where";
		if(count($kode)==1){
			$sql_kode.=" kode1='".$kode[0]."' and (kode2 is null or kode2='')";
		}
		else{
			$sql_kode.=" kode1='".$kode[0]."' and kode2='".$kode[1]."'";
		}
		$sql_uraian=$conn->query($sql_kode);
		$rs_uraian=$sql_uraian->fetch_object();
		$uraian_induk=$rs_uraian->uraian;
	}
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kode_induk" id="kode_induk">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Kode Induk</label>
            <input type="text" class="form-control" readonly value="<?php echo $_GET['kode']; ?>" name="kode_induk" id="kode_induk"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Uraian Induk</label>
            <input type="text" readonly value="<?php echo $uraian_induk; ?>" class="form-control" name="uraian_induk" id="uraian_induk"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Kode</label>
            <input type="text" class="form-control" name="kode" id="kode"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Uraian Akun</label>
            <input type="text" class="form-control" name="uraian" id="uraian"/>
        </div>
		<div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpan();">
            </div>
          </div>
        </div>
    </form>
</div>

<div id="grid_pelatihan"></div>
</div>
</html>
<?php include("../../close.php"); ?>
