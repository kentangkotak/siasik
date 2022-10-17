<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	if($_GET['x']==1){
		$sql=$conn->query("select max(urusan) as urusan from permendagri_50_c ");
		$rs=$sql->fetch_object();
		$urusan=$rs->urusan + 1;
	}else if($_GET['x']==2){
		$sql=$conn->query("select max(bidang_urusan) as bidang_urusan from permendagri_50_c where urusan='".$_GET['x1']."'");
		$rs=$sql->fetch_object();
		$urusan= $_GET['x1'];
		$bidangurusan=$rs->bidang_urusan + 1;
	}else if($_GET['x']==3){
		$sql=$conn->query("select max(program) as program from permendagri_50_c where urusan='".$_GET['x1']."' and bidang_urusan='".$_GET['x2']."'");
		$rs=$sql->fetch_object();
		$urusan= $_GET['x1'];
		$bidangurusan= $_GET['x2'];
		$program=$rs->program + 1;
	}else if($_GET['x']==4){
		$sql=$conn->query("select max(kegiatan) as kegiatan from permendagri_50_c where urusan='".$_GET['x1']."' and bidang_urusan='".$_GET['x2']."' and program='".$_GET['x3']."' ");
		$rs=$sql->fetch_object();
		$urusan= $_GET['x1'];
		$bidangurusan= $_GET['x2'];
		$program= $_GET['x3'];
		$kegiatan=$rs->kegiatan + 0.01;
	}else if($_GET['x']==5){
		$sql=$conn->query("select max(subkegiatan) as subkegiatan from permendagri_50_c where urusan='".$_GET['x1']."' and bidang_urusan='".$_GET['x2']."' 
		and program='".$_GET['x3']."' and kegiatan='".$_GET['x4']."'");
		$rs=$sql->fetch_object();
		$urusan= $_GET['x1'];
		$bidangurusan= $_GET['x2'];
		$program= $_GET['x3'];
		$kegiatan= $_GET['x4'];
		$subkegiatan=$rs->subkegiatan + 1;
	}
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodebagian" id="kodebagian">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">URUSAN</label>
            <input type="text" class="form-control" value="<?php echo $urusan; ?>" name="urusan" id="urusan"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG URUSAN</label>
            <input type="text" value="<?php echo $bidangurusan; ?>" class="form-control" name="bidangurusan" id="bidangurusan"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PROGRAM</label>
            <input type="text" class="form-control" value="<?php echo $program; ?>" name="program" id="program"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" value="<?php echo $kegiatan; ?>" name="kegiatan" id="kegiatan"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">SUB KEGIATAN</label>
            <input type="text" class="form-control" value="<?php echo $subkegiatan; ?>" name="sub_kegiatan" id="sub_kegiatan"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NOMENKLATUR</label>
            <input type="text" class="form-control" name="nomenklatur" id="nomenklatur"/>
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
