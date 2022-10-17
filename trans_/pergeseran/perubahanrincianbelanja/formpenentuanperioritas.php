<?php include("../../../conn.php"); ?>
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
            <input type="text" class="form-control" name="pptk" readonly="yes" id="pptk"value="<?php echo $rs->pptk;?>" />
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG</label>
            <input type="text" class="form-control" name="namabidang" readonly="yes" onChange="fungsikomplet(this.value);" id="namabidang" value="<?php echo $rs->namabidang;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" readonly="yes" id="kegiatan" value="<?php echo $rs->kegiatan;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL TRANSAKSI</label>
            <input type="text" class="form-control" name="tgltrans" readonly="yes" id="tgltrans" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $tanggaltrans;} ;?>" onClick="return getCalendar(document.form.tgltrans);" />
        </div>	
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">RUANG YANG MENGUSULKAN</label>
            <select class="select2_single form-control" tabindex="-1" name="ruangyangusul" id="ruangyangusul" readonly="yes">
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
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    <li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">RINCI</a></li>
	  </ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
				<div id="grid_nilai"></div>
			</div>
		</div>
	</div>
</div>
</html>
<?php include("../../../close.php"); ?>
