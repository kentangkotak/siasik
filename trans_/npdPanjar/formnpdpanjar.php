<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select npdpanjar_heder.*,npdpanjar_rinci.koderek50 as koderek50,npdpanjar_rinci.rincianbelanja50 as rincianbelanja50 
						from npdpanjar_heder left join npdpanjar_rinci on npdpanjar_rinci.nonpdpanjar=npdpanjar_heder.nonpdpanjar
						where npdpanjar_heder.nonpdpanjar='".$_GET['nonpdpanjar']."' ");
	$rs=$sql->fetch_object();
	$tglnpdpanjar=out_tanggal("-",$rs->tglnpdpanjar);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="kodepptk" id="kodepptk" onChange="fungsikomplet(this.value);" value="<?php echo $rs->kodepptk;?>"/>
		<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" onChange="fungsikomplet(this.value);" value="<?php echo $rs->kodekegiatanblud;?>"/>
		<input type="hidden" name="kodebidang" id="kodebidang" onChange="fungsikomplet(this.value);" value="<?php echo $rs->kodebidang;?>"/>
		<input type="hidden" name="bidang" id="bidang" onChange="fungsikomplet(this.value);" value="<?php echo $rs->bidang;?>"/>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO NPD</label>
            <input type="text" class="form-control" name="nonpd" id="nonpd" readonly="yes" value="<?php echo $_GET['nonpdpanjar'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL NPD</label>
            <input type="text" class="form-control" name="tglnpd" id="tglnpd" value="<?php if($_GET['nonpdpanjar']==''){ echo date('d/m/Y');}else{ echo $tglnpdpanjar;} ;?>" onClick="return getCalendar(document.form.tglnpd);" />
        </div>
	<!--	<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TRIWULAN</label>
             <select name="triwulan" id="triwulan" class="form-control">
                <option value="">-</option>
                <option value="TRIWULAN 1"<?php if($rs->triwulan=='TRIWULAN 1'){ echo "selected"; }?>>TRIWULAN 1</option>
				<option value="TRIWULAN 2"<?php if($rs->triwulan=='TRIWULAN 2'){ echo "selected"; }?>>TRIWULAN 2</option>
				<option value="TRIWULAN 3"<?php if($rs->triwulan=='TRIWULAN 3'){ echo "selected"; }?>>TRIWULAN 3</option>
				<option value="TRIWULAN 3"<?php if($rs->triwulan=='TRIWULAN 4'){ echo "selected"; }?>>TRIWULAN 4</option>
            </select>
        </div> -->
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label> 
			<a href="javascript:void(0);" onclick="caripptk();"><img src="images/search.gif" border="0" width="13px" /></a>
            <input type="text" class="form-control" name="pptk" id="pptk" value="<?php echo $rs->pptk;?>" readonly="yes" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PROGRAM</label> 
            <input type="text" class="form-control" name="program" id="program" readonly="yes" value="PROGRAM PENUNJANG URUSAN PEMERINTAH DAERAH KABUPATEN/KOTA" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label> 
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" readonly="yes" value="PELAYANAN DAN PENUNJANG PELAYANAN BLUD"/>
        </div>		
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label> 
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" readonly="yes" value="<?php echo $rs->kegiatanblud;?>"/>
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
						<input type="hidden" name="koderek50" id="koderek50" onChange="fungsikomplet(this.value);" value="<?php echo $rs->koderek50;?>"/>
						<input type="hidden" name="koderek108" id="koderek108" />
						<input type="hidden" name="uraian108" id="uraian108" />
						<input type="hidden" name="nopp" id="nopp" />
						<input type="hidden" name="nousulan" id="nousulan" />
						<input type="hidden" name="idpp" id="idpp" />
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">RINCIAN BELANJA</label>
							<a href="javascript:void(0);" onclick="caririncianbelanja();"><img src="images/search.gif" border="0" width="15" /></a>							
							<input type="text" class="form-control" readonly="yes" name="rincianbelanja" id="rincianbelanja" value="<?php echo $rs->rincianbelanja50;?>" />
						</div>
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">ITEM BELANJA</label>
							<a href="javascript:void(0);" onclick="cariitembelanja();"><img src="images/search.gif" border="0" width="15" /></a>
							<input type="text" class="form-control" name="itembelanja" id="itembelanja" readonly="yes"/>
						</div>
						 <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">VOLUME</label> 
							<input type="text" class="form-control" name="volume" id="volume" readonly="yes" />
						</div>
						 <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">SATUAN</label> 
							<input type="text" class="form-control" name="satuan" id="satuan" readonly="yes" />
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">HARGA ANGGARAN</label> 
							<input type="text" class="form-control" name="harga" id="harga" readonly="yes" />
						</div>		
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TOTAL ANGGARAN</label> 
							<input type="text" class="form-control" name="total" id="total" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">SISA ANGGARAN</label> 
							<input type="text" class="form-control" name="sisaanggaran" id="sisaanggaran" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">VOLUME PERMINTAAN PANJAR</label> 
							<input type="text" class="form-control" name="volumepermintaanpanjar" onkeyup="hasil(this.value);" onkeydown="hasil(this.value);" id="volumepermintaanpanjar" onkeypress="if(event.keyCode==13){ document.form_rinci.hargapermintaanpanjar.focus();}">
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">HARGA PERMINTAAN PANJAR</label> 
							<input type="text" class="form-control" name="hargapermintaanpanjar" onkeyup="hasil(this.value);" onkeydown="hasil(this.value);" id="hargapermintaanpanjar" onkeypress="if(event.keyCode==13){ document.form_rinci.tsimpan.focus(); }" />
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TOTAL PERMINTAAN PANJAR</label> 
							<input type="text" class="form-control" name="totalpermintaanpanjar" id="totalpermintaanpanjar" readonly="yes" />
						</div>
						  <div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-1 ">
							<label class="control-label"></label> 
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpannpdpanjar();">
							</div>
							<div class="col-md-3 col-sm-3 col-xs-1 ">
							<label class="control-label"></label> 
							   <input type="button" name="batal" class="btn btn-success btn-block" id="batal" value="CETAK" size="20" onClick="cetaknpdpanjar();">
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
