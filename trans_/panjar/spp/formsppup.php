<?php include("../../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	$sql=$conn->query("select * from masterBendahara where jabatan='BENDAHARA PENGELUARAN' and flag=''");
	$rs=$sql->fetch_object();
?>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="formsppup" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="nip" id="nip" value="<?php echo $rs->nip;?>">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. SPP</label>
            <input type="text" class="form-control" name="nosppup" id="nosppup" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL SPP</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $tanggaltrans;} ;?>" onClick="return getCalendar(document.form.tgltrans);" />
        </div>	
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Bendahara Pengeluaran</label>
            <input type="text" class="form-control" name="bendaharapengeluaran" id="bendaharapengeluaran" value="<?php echo $rs->nama;?>" readonly="yes"/>
        </div>		
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">JUMLAH SPP</label>
            <input type="text" class="form-control" name="jumlahspp" id="jumlahspp"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Nama Bank</label>
            <input type="text" class="form-control" name="namabank" id="namabank" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. Rekening</label>
            <input type="text" class="form-control" name="norekening" id="norekening" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Uraian</label>
            <input type="text" class="form-control" name="uraian" id="uraian" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			<label class="control-label">&nbsp;</label>
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN"  onClick="simpansppup();">
		</div>
    </form>            
</div>
<!--<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    <li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">RINCI NPD</a></li>
	  </ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
				<div class="col-md-12 col-sm-12 col-xs-12">
				   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
				   <input type="hidden" name="kodepptk" id="kodepptk">
				   <input type="hidden" name="program" id="program">
				   <input type="hidden" name="kegiatan" id="kegiatan">
				   <input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud">
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">NO NPD</label>
							<a href="javascript:void(0);" onclick="carinpd();"><img src="images/search.gif" border="0" width="13px" /></a>
							<input type="text" class="form-control" name="nonpd" id="nonpd" readonly="yes"/>
						</div>
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">TGL NPD</label>
							<input type="text" class="form-control" name="tglnpd" id="tglnpd" readonly="yes" />
						</div>
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">TRIWULAN</label>
							<input type="text" class="form-control" name="triwulan" id="itembelanja" readonly="yes" />
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">PPTK</label> 
							<input type="text" class="form-control" name="pptk" id="pptk" readonly="yes" />
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">KEGIATAN BLUD</label> 
							<input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" readonly="yes" />
						</div>	
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TOTAL NPD</label> 
							<input type="text" class="form-control" name="totalnpd" id="totalnpd" readonly="yes"/>
						</div>
						
					</form>
					<div id="grid_nilai"></div>
				</div>
			</div>
		</div> 
	</div>
</div>	-->	
<?php include("../../../close.php"); ?>
