<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from penyesesuaianperioritas_heder where notrans='".$_GET['notrans']."'");
	$rs=$sql->fetch_object();
	$tanggaltrans=out_tanggal("-",$rs->tgltrans);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodebidang" id="kodebidang" value="<?php echo $rs->kodebidang;?>" />
	<input type="hidden" name="kodepptk" id="kodepptk" value="<?php echo $rs->kodepptk;?>" />
	<input type="hidden" name="kodekegiatan" id="kodekegiatan" onChange="fungsikomplet(this.value);" value="<?php echo $rs->kodekegiatan;?>" />
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NOTRANS PERIORITAS</label>
            <input type="text" class="form-control" name="notrans" id="notrans" readonly="yes" value="<?php echo $_GET['notrans'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label>
            <input type="text" class="form-control" name="pptk" id="pptk"value="<?php echo $rs->pptk;?>" />
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG</label>
            <input type="text" class="form-control" name="namabidang" onChange="fungsikomplet(this.value);" id="namabidang" value="<?php echo $rs->namabidang;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $rs->kegiatan;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL TRANSAKSI</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $tanggaltrans;} ;?>" onClick="return getCalendar(document.form.tgltrans);" />
        </div>	
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">RUANG YANG MENGUSULKAN</label>
            <select class="select2_single form-control" tabindex="-1" name="ruangyangusul" id="ruangyangusul">
            <option value="">-Pilih-</option>
            <?php
				$conn_musrenbang = new mysqli("localhost","admin","alam02018sa","musrenbang");
                $sqlx=$conn_musrenbang->query("select * from rs3 where rs3=''");
                while($rsx=$sqlx->fetch_object()){
            ?>
                <option value="<?php echo $rsx->rs1.'|'.$rsx->rs2;?>" <?php if($rsx->rs1==$rs->kdruang_pengusul){ echo "selected"; }?>><?php echo $rsx->rs2;?></option>
            <?php }?>
            </select>
        </div>
    </form>            
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="nilai" id="nilai" />
		<input type="hidden" name="koderek50" id="koderek50" />
		<input type="hidden" name="koderek108" id="koderek108" />
		<input type="hidden" name="nousulan" id="nousulan" />
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">USULAN</label>
            <input type="text" class="form-control" name="usulan" id="usulan" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">VOLUME</label> 
            <input type="text" class="form-control" name="volume" id="volume" onblur="angka(this);" onkeyup="angka(this);" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">SATUAN</label> 
            <input type="text" class="form-control" name="satuan" id="satuan" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">HARGA</label> 
            <input type="text" class="form-control" name="harga" id="harga" onblur="angka(this);" onkeyup="angka(this);" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">URAIAN REKENING MAPPING KE 108</label>
            <input type="text" class="form-control" name="uraianrek108" id="uraianrek108" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">URAIAN REKENING MAPPING KE 50</label>
            <input type="text" class="form-control" name="uraianrek50" id="uraianrek50" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">JUMLAH DI ACC</label> 
            <input type="text" class="form-control" name="jumlahacc" id="jumlahacc" />
        </div>
         <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
			<label class="control-label"> </label> 
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanpenentuanprioritas();">
            </div>
          </div>
    </form>
</div>                
<div id="grid_nilai"></div>
</html>
<?php include("../../close.php"); ?>
