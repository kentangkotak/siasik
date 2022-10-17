<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from sppgu_heder where nosppgu='".$_GET['nosppgu']."' ");
	$rs=$sql->fetch_object();
	$tglsppgu=out_tanggal("-",$rs->tglsppgu);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodebendaharapengeluaran" id="kodebendaharapengeluaran" value="<?php echo $rs->kodebendaharapengeluaran ;?>"/>
	<input type="hidden" name="kodebank" id="kodebank" value="<?php echo $rs->kodebank ;?>"/>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO SPP GU</label> 
            <input type="text" class="form-control" name="nosppgu" id="nosppgu" readonly="yes" value="<?php echo $_GET['nosppgu'] ;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL SPP GU</label> 
            <input type="text" class="form-control" name="tglsppgu" id="tglsppgu" value="<?php if($_GET['nosppgu']==''){ echo date('d/m/Y');}else{ echo $tglsppgu;} ;?>" onClick="return getCalendar(document.form.tglsppgu);"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TRIWULAN</label>
             <select name="triwulan" id="triwulan" class="form-control">
                <option value="">-</option>
                <option value="TRIWULAN 1"<?php if($rs->triwulan=='TRIWULAN 1'){ echo "selected"; }?>>TRIWULAN 1</option>
				<option value="TRIWULAN 2"<?php if($rs->triwulan=='TRIWULAN 2'){ echo "selected"; }?>>TRIWULAN 2</option>
				<option value="TRIWULAN 3"<?php if($rs->triwulan=='TRIWULAN 3'){ echo "selected"; }?>>TRIWULAN 3</option>
            </select>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BENDAHARA PENGELUARAN</label> 
            <input type="text" class="form-control" name="bendaharapengeluaran" id="bendaharapengeluaran" value="<?php echo $rs->bendaharapengeluaran ;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">JUMLAH PENGELUARAN</label> 
            <input type="text" class="form-control" name="jumlahpengeluaran" id="jumlahpengeluaran" value="<?php echo $rs->jumlahpengeluaran ;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NAMA BANK</label> 
            <input type="text" class="form-control" name="namabank" id="namabank" value="<?php echo $rs->namabank ;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO REKENING</label> 
            <input type="text" class="form-control" name="norekening" id="norekening" readonly="yes" value="<?php echo $rs->norekening ;?>"/>
        </div>
    </form>            
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		<li class="active"><a href="#tabs-0">RINCIAN</a></li>	
	  </ul>
	</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" />
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO SPJ</label> 
            <input type="text" class="form-control" name="nospj" id="nospj"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL SPJ</label> 
            <input type="text" class="form-control" name="tglspj" id="tglspj" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label> 
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label> 
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI</label> 
            <input type="text" class="form-control" name="nilai" id="nilai"/>
        </div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
			<label class="control-label"></label> 
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanguu();">
            </div>
			<!--<div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="batal" class="btn btn-success btn-block" id="batal" value="HAPUS TRANSAKSI" size="20" onClick="hapustransaksi();">
            </div>-->
          </div>
    </form>
</div>                
<div id="grid_nilai"></div>
</html>
<?php include("../../close.php"); ?>
