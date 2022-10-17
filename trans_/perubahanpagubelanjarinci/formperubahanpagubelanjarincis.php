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
            <label class="control-label">NO PERUBAHAN</label>
            <input type="text" class="form-control" name="noperubahan" id="noperubahan" readonly="yes" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NOTRANS PERIORITAS</label>
            <input type="text" class="form-control" name="notrans" id="notrans" readonly="yes" value="<?php echo $_GET['notrans'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label>
            <input type="text" class="form-control" name="pptk" id="pptk"value="<?php echo $rs->pptk;?>" readonly="yes"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG</label>
            <input type="text" class="form-control" name="namabidang" readonly="yes" onChange="fungsikomplet(this.value);" id="namabidang" value="<?php echo $rs->namabidang;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" readonly="yes" value="<?php echo $rs->kegiatan;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL TRANSAKSI</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" readonly="yes" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $tanggaltrans;} ;?>" onClick="return getCalendar(document.form.tgltrans);" />
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
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PERUBAHAN</label>
            <input type="text" class="form-control" name="tglperubahan" id="tglperubahan" value="<?php echo date('d/m/Y');?>" onClick="return getCalendar(document.form.tglperubahan);" />
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
							<input type="text" class="form-control" name="volume" id="volume"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">SATUAN</label> 
							<input type="text" class="form-control" name="satuan" id="satuan"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">HARGA</label> 
							<input type="text" class="form-control" name="harga" id="harga">
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">URAIAN REKENING MAPPING KE 108</label>
							<a href="javascript:void(0);" onclick="cari108();"><img src="images/search.gif" border="0" width="13px" /></a>
							<input type="text" class="form-control" name="uraianrek108" id="uraianrek108" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">URAIAN REKENING MAPPING KE 50</label>
							<a href="javascript:void(0);" onclick="cari50();"><img src="images/search.gif" border="0" width="13px" /></a>
							<input type="text" class="form-control" name="uraianrek50" id="uraianrek50" readonly="yes"/>
						</div>
						  <div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-1 ">
							<label class="control-label"> </label> 
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanperubahanpagubelanja();">
							</div>
						  </div>
					</form>
				</div>
			<div id="grid_nilai"></div>
			</div>
		</div>
	</div>
</div>
</html>
<?php include("../../close.php"); ?>
