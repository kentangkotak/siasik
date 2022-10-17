<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from penyesesuaianperioritas_heder where notrans='".$_GET['notrans']."'");
	$rs=$sql->fetch_object();
	$tanggaltrans=out_tanggal("-",$rs->tgltrans);
	
	if($_GET['x'] == "BELUM"){
		$sql_rinci=$conn->query("select * from penyesesuaianperioritas_rinci where notrans='".$_GET['notrans']."' and id='".$_GET['id']."' 
		and statusperubahan='' and statusperubahan_pak=''");
	}else if($_GET['x'] == "SUDAH"){
		$sql_rinci=$conn->query("select perubahanrincianbelanja.koderek50 as koderek50,perubahanrincianbelanja.koderek108 as koderek108,perubahanrincianbelanja.nousulan as nousulan,
								perubahanrincianbelanja.idpp as idpp,perubahanrincianbelanja.usulan as usulan,perubahanrincianbelanja.volumebaru as jumlahacc,perubahanrincianbelanja.satuan as satuan,
								perubahanrincianbelanja.hargabaru as harga,perubahanrincianbelanja.uraian108 as uraian108,perubahanrincianbelanja.uraian50 as uraian50,perubahanrincianbelanja.totalbaru as nilai
								from perubahanrincianbelanja where perubahanrincianbelanja.notrans='".$_GET['notrans']."' and perubahanrincianbelanja.idpp='".$_GET['id']."'
								and statusperubahan='1' and statusperubahan_pak=''");
	}else if($_GET['x'] == "wew"){
		$sql_rinci=$conn->query("select perubahanrincianbelanja_pak.koderek50 as koderek50,perubahanrincianbelanja_pak.koderek108 as koderek108,perubahanrincianbelanja_pak.nousulan as nousulan,
								perubahanrincianbelanja_pak.idpp as idpp,perubahanrincianbelanja_pak.usulan as usulan,perubahanrincianbelanja_pak.volumebaru as jumlahacc,perubahanrincianbelanja_pak.satuan as satuan,
								perubahanrincianbelanja_pak.hargabaru as harga,perubahanrincianbelanja_pak.uraian108 as uraian108,perubahanrincianbelanja_pak.uraian50 as uraian50,perubahanrincianbelanja_pak.totalbaru as nilai
								from perubahanrincianbelanja_pak where perubahanrincianbelanja_pak.notrans='".$_GET['notrans']."' and perubahanrincianbelanja_pak.idpp='".$_GET['id']."'
								and statusperubahan='1' ");
	}
	$rs_rinci=$sql_rinci->fetch_object();
?>
<script src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="formx" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="noperubahan" id="noperubahan" />
	<input type="hidden" name="kodebidang" id="kodebidang" value="<?php echo $rs->kodebidang;?>" />
	<input type="hidden" name="kodepptk" id="kodepptk" value="<?php echo $rs->kodepptk;?>" />
	<input type="hidden" name="kodekegiatan" id="kodekegiatan" onChange="fungsikomplet(this.value);" value="<?php echo $rs->kodekegiatan;?>" />
	<input type="hidden" name="koderuangpengusul" id="koderuangpengusul" value="<?php echo $rs->kd_ruangpengusul;?>" />
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
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" readonly="yes" value="<?php echo $rs->kegiatan;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PENYESUAIAN PERIORITAS</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" readonly="yes" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $tanggaltrans;} ;?>" onClick="return getCalendar(document.form.tgltrans);" />
        </div>	
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PERUBAHAN</label>
            <input type="text" class="form-control" name="tglperubahan" id="tglperubahan" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $tanggaltrans;} ;?>" />
        </div>		
    </form>            
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
   <form name="form_rincix" id="form_rincix" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="koderek50" id="koderek50" value="<?php echo $rs_rinci->koderek50;?>"/>
		<input type="hidden" name="koderek108" id="koderek108" value="<?php echo $rs_rinci->koderek108;?>"/>
		<input type="hidden" name="nousulan" id="nousulan" value="<?php echo $rs_rinci->nousulan;?>"/>
		<input type="hidden" name="idpp" id="idpp" value="<?php echo $_GET['id'];?>" />
		<input type="hidden" name="status_x" id="status_x" value="<?php echo $_GET['x'];?>" />
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">USULAN</label>
            <input type="text" class="form-control" name="usulan" id="usulan" value="<?php echo $rs_rinci->usulan;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">VOLUME</label> 
            <input type="text" class="form-control" name="volume" id="volume" onblur="angka(this);" onkeyup="angka(this);" value="<?php echo rpz($rs_rinci->jumlahacc);?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">SATUAN</label> 
            <input type="text" class="form-control" name="satuan" id="satuan" readonly="yes" value="<?php echo $rs_rinci->satuan;?>"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">HARGA</label> 
            <input type="text" class="form-control" name="harga" id="harga" readonly="yes" value="<?php echo rpz($rs_rinci->harga);?>"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">URAIAN REKENING MAPPING KE 108</label>
            <input type="text" class="form-control" name="uraianrek108" id="uraianrek108" value="<?php echo $rs_rinci->uraian108;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">URAIAN REKENING MAPPING KE 50</label>
            <input type="text" class="form-control" name="uraianrek50" id="uraianrek50" value="<?php echo $rs_rinci->uraian50;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NILAI ANGGARAN</label> 
            <input type="text" class="form-control" name="nilai" id="nilai" value="<?php echo rpz($rs_rinci->nilai);?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">VOLUME BARU</label> 
            <input type="text" class="form-control" onKeyPress="if(event.keyCode==13){document.form_rincix.hargabaru.focus();" name="volumebaru" id="volumebaru"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">HARGA BARU</label> 
            <input type="text" class="form-control" onKeyPress="if(event.keyCode==13){document.form_rincix.tsimpan.focus();" name="hargabaru" id="hargabaru" onkeyup="hasilbaru(this.value);" onkeydown="hasilbaru(this.value);"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">TOTAL BARU</label> 
            <input type="text" class="form-control" name="totalbaru" id="totalbaru" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">SELISIH</label> 
            <input type="text" class="form-control" name="selisih" id="selisih"/>
        </div>
         <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
			<label class="control-label"> </label> 
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanperubahanpagubelanjax();">
            </div>
          </div>
    </form>
</div>                
<div id="grid_nilai"></div>
</html>
<script>
	//document.form_rinci.totalbaru.value=document.form_rinci.volumebaru.value*document.form_rinci.hargabaru.value;
	//document.form_rinci.selisih.value=document.form_rinci.totalbaru.value-(document.form_rinci.harga.value*document.form_rinci.volume.value);
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
