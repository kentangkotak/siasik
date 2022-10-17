<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from penyesesuaianperioritas_heder where notrans='".$_GET['notrans']."'");
	$rs=$sql->fetch_object();
	$tanggaltrans=out_tanggal("-",$rs->tgltrans);
	$usulan=str_replace(';',' ',$rs->usulan);
	
	$sqlsisapagu=$conn->query("select * from t_tampung_pagu where kodekegiatanblud='".$rs->kodekegiatan."' and tahun='".$_SESSION["anggaran_tahun"]."'");
	$rsisapagu=$sqlsisapagu->fetch_object();

?>
<script src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="noperubahan" id="noperubahan" />
	<input type="hidden" name="kodebidang" id="kodebidang" value="<?php echo $rs->kodebidang;?>" />
	<input type="hidden" name="kodepptk" id="kodepptk" value="<?php echo $rs->kodepptk;?>" />
	<input type="hidden" name="kodekegiatan" id="kodekegiatan" value="<?php echo $rs->kodekegiatan;?>" />
	<input type="hidden" name="koderuangpengusul" id="koderuangpengusul" value="<?php echo $rs->kdruang_pengusul;?>" />
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NOTRANS PERIORITAS</label>
            <input type="text" class="form-control" name="notrans" id="notrans" readonly="yes" value="<?php echo $_GET['notrans'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label>
            <input type="text" class="form-control" name="pptk" id="pptk" value="<?php echo $rs->pptk;?>" readonly="yes"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG</label>
            <input type="text" class="form-control" name="namabidang" onChange="fungsikomplet(this.value);" readonly="yes" id="namabidang" value="<?php echo $rs->namabidang;?>"/>
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
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" readonly="yes" value="<?php echo $rs->kegiatan;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PENYESUAIAN PERIORITAS</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" readonly="yes" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $tanggaltrans;} ;?>" onClick="return getCalendar(document.form.tgltrans);" />
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
				   <form name="form_rincix" id="form_rincix" class="form-horizontal form-label-left" onSubmit="return false;">
						<input type="hidden" name="koderek50" id="koderek50" />
						<input type="hidden" name="koderek108" id="koderek108" />
						<input type="hidden" name="nousulan" id="nousulan" />
						<input type="hidden" name="idpp" id="idpp" />
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">USULAN</label>
							<input type="text" class="form-control" name="usulan" id="usulan"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">VOLUME</label> 
							<input type="text" class="form-control" name="volume" id="volume" value="0.00" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">SATUAN</label> 
							<select class="select2_single form-control" tabindex="-1" name="satuan" id="satuan">
							<option value="">-Pilih-</option>
							<?php
								$conn_musrenbang = new mysqli("localhost","admin","alam02018sa","musrenbang");
								$sqlx=$conn_musrenbang->query("select * from rs9 order by rs1");
								while($rsx=$sqlx->fetch_object()){
							?>
								<option value="<?php echo $rsx->rs1;?>" ><?php echo $rsx->rs1;?></option>
							<?php }?>
							</select>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">HARGA</label> 
							<input type="text" class="form-control" name="harga" id="harga" value="0.00" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TOTAL ANGGARAN</label> 
							<input type="text" class="form-control" name="totalanggaran" id="totalanggaran" value="0.00" readonly="yes"/>
						</div>
					<!--	<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">BELANJA</label> 
							<input type="text" class="form-control" name="belanja" id="belanja" readonly="yes" value="0.00"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">SALDO SUB ANGGARAN</label> 
							<input type="text" class="form-control" name="nilai" id="nilai" readonly="yes" value="0.00"/>
						</div>-->
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">URAIAN REKENING MAPPING KE 108</label>
							<span id="carirekening108" style="visibility:visible;">
								<a href="javascript:void(0);" onclick="carirekening108();"><img src="images/search.gif" border="0" width="13px" /></a>
							</span>
							<input type="text" class="form-control" name="uraianrek108" id="uraianrek108" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">URAIAN REKENING MAPPING KE 50</label>
							<span id="carirekening50" style="visibility:visible;">
								<a href="javascript:void(0);" onclick="carirekening50();"><img src="images/search.gif" border="0" width="13px" /></a>
							</span>
							<input type="text" class="form-control" name="uraianrek50" id="uraianrek50" readonly="yes"/>
						</div>
					<!--	<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">OPERATOR</label>
							<select class="select2_single form-control" tabindex="-1" name="operator" id="operator">
							<option value="">-Pilih-</option>
								<option value="TAMBAH" >TAMBAH</option>
								<option value="KURANG" >KURANG</option>
							</select>
						</div>-->
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">VOLUME BARU</label> 
							<input type="text" class="form-control" onKeyPress="if(event.keyCode==13){document.form_rincix.hargabaru.focus();" value="0" name="volumebaru" id="volumebaru" onkeyup="hasilbaru(this.value);" onkeydown="hasilbaru(this.value);"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">HARGA BARU</label> 
							<input type="text" class="form-control" onKeyPress="if(event.keyCode==13){document.form_rincix.tsimpan.focus();" value="0" name="hargabaru" id="hargabaru" onkeyup="hasilbaru(this.value);" onkeydown="hasilbaru(this.value);"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TOTAL BARU</label> 
							<input type="text" class="form-control" name="totalbaru" id="totalbaru" value="0" readonly="yes"/>
						</div>
						<!--<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">SELISIH</label> 
							<input type="text" class="form-control" name="selisih" id="selisih" readonly="yes"/>
						</div>-->
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TANGGAL PERUBAHAN</label>
							<input type="text" class="form-control" name="tglperubahan" id="tglperubahan" value="<?php echo date('d/m/Y');?>" />
						</div>
						  <div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-1 ">
							<label class="control-label"> </label> 
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanperubahanrincianbelanja();">
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
<script>
	//document.form_rinci.totalbaru.value=document.form_rinci.volumebaru.value*document.form_rinci.hargabaru.value;
	//document.form_rinci.selisih.value=document.form_rinci.totalbaru.value-(document.form_rinci.harga.value*document.form_rinci.volume.value);
	$( '#volume' ).mask('000,000,000,000.00', {reverse: true});
	$( '#harga' ).mask('000,000,000,000.00', {reverse: true});
	$( '#volumebaru' ).mask('000,000,000,000.00', {reverse: true});
	$( '#volumebaru' ).mask('000,000,000,000.00', {reverse: true});
	$( '#hargabaru' ).mask('000,000,000,000.00', {reverse: true});
	$( '#totalbaru' ).mask('000,000,000,000.00', {reverse: false});
	$( '#selisih' ).mask('000,000,000,000.00', {reverse: false});
	
	//$('#tglperubahan').datetimepicker();
    
    $('#tglperubahan').datetimepicker({
        format: 'DD/MM/YYYY'
    });
    
    $('#myDatepicker3').datetimepicker({
        format: 'hh:mm A'
    });
    
    $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });

    $('#datetimepicker6').datetimepicker();
    
    $('#datetimepicker7').datetimepicker({
        useCurrent: false
    });
    
    $("#datetimepicker6").on("dp.change", function(e) {
        $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
    });
    
    $("#datetimepicker7").on("dp.change", function(e) {
        $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
    });
</script>
<?php include("../../../close.php"); ?>
