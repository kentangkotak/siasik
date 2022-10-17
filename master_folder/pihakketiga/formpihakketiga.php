<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
		$sql=$conn->query("select * from pihak_ketiga where kode='".$_GET['kode']."'");
		$rs=$sql->fetch_object();
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kode" id="kode" value="<?php echo $_GET['kode'];?>">
	<input type="hidden" name="kodemapingrs" id="kodemapingrs" value="<?php echo $rs->kodemapingrs;?>">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NAMA PERUSAHAAN</label>
            <input type="text" class="form-control" name="namaperusahaan" id="namaperusahaan" value="<?php echo $rs->nama;?>" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">ALAMAT PERUSAHAAN</label>
            <input type="text" class="form-control" name="alamatperusahaan" id="alamatperusahaan" value="<?php echo $rs->alamat;?>" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NOMOR TELEPON PERUSAHAAN</label>
            <input type="text" class="form-control" name="teleponperusahaan" id="teleponperusahaan" value="<?php echo $rs->telepon;?>" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NPWP</label>
            <input type="text" class="form-control" name="npwp" id="npwp" value="<?php echo $rs->npwp;?>" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NAMA BANK</label>
            <input type="text" class="form-control" name="namabank" value="<?php echo $rs->bank;?>" id="namabank" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO. REK</label>
            <input type="text" class="form-control" name="norek" id="norek" value="<?php echo $rs->norek;?>" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">CONTACT PERSON</label>
            <input type="text" class="form-control" name="cp" id="cp" value="<?php echo $rs->cp;?>" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">MAPPING MASTER SIMRS</label>
            <input type="text" class="form-control" name="namasuplier" id="namasuplier" value="<?php echo $rs->namasuplier;?>" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label"></label>
        </div>
		<div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanpihakketiga();">
            </div>
          </div>
    </form>            
</div>

<div id="grid_pelatihan"></div>
</div>
</html>
<?php include("../../close.php"); ?>
