<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select pengembaliansisapanjar_heder.nopengembaliansisapanjar as nopengembaliansisapanjar,pengembaliansisapanjar_heder.tglpengembaliansisapanjar as tglpengembaliansisapanjar,
						pengembaliansisapanjar_heder.nospjpanjar as nospjpanjar,pengembaliansisapanjar_heder.pptk as pptk,pengembaliansisapanjar_heder.program as program,
						pengembaliansisapanjar_heder.kegiatan as kegiatan,pengembaliansisapanjar_heder.kegiatanblud as kegiatanblud,pengembaliansisapanjar_heder.kunci as kunci,
						sum(pengembaliansisapanjar_rinci.sisapanjar) as sisapanjar
						from pengembaliansisapanjar_heder LEFT join pengembaliansisapanjar_rinci on
						pengembaliansisapanjar_heder.nopengembaliansisapanjar=pengembaliansisapanjar_rinci.nopengembaliansisapanjar
						where year(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)='".$_SESSION["anggaran_tahun"]."' and
						pengembaliansisapanjar_heder.nopengembaliansisapanjar='".$_GET['nopengembaliansisapanjar']."'
						group by pengembaliansisapanjar_heder.nopengembaliansisapanjar ");
	$rs=$sql->fetch_object();
	$tglpengembaliansisapanjar=out_tanggal("-",$rs->tglpengembaliansisapanjar);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="kodepptk" id="kodepptk" value="<?php echo $rs->kodepptk;?>" />
		<input type="hidden" name="notapanjar" id="notapanjar" value="<?php echo $rs->kodepptk;?>" />
		<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" value="<?php echo $rs->kodekegiatanblud;?>" />
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO PENGEMBALIAN SISA PANJAR</label>
            <input type="text" class="form-control" name="nopengembaliansisapanjar" id="nopengembaliansisapanjar" readonly="yes" value="<?php echo $_GET['nopengembaliansisapanjar'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PENGEMBALIAN SISA PANJAR</label>
            <input type="text" class="form-control" name="tglpengembaliansisapanjar" id="tglpengembaliansisapanjar" value="<?php if($_GET['nopengembaliansisapanjar']==''){ echo date('d/m/Y');}else{ echo $tglpengembaliansisapanjar;} ;?>" onClick="return getCalendar(document.form.tglpengembaliansisapanjar);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO NPD PANJAR</label>
			<a href="javascript:void(0);" onclick="carinonpdpanjar();"><img src="images/search.gif" border="0" width="13px" /></a>
            <input type="text" class="form-control" name="nospjpanjar" id="nospjpanjar" value="<?php echo $rs->nospjpanjar;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label>
            <input type="text" class="form-control" name="pptk" id="pptk" readonly="yes" value="<?php echo $rs->pptk ;?>"/>
        </div> 
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PROGRAM</label>
            <input type="text" class="form-control" name="program" readonly="yes" id="program" value="<?php echo $rs->program ;?>">
        </div>		
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" readonly="yes" id="kegiatan" value="<?php echo $rs->kegiatan ;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label>
            <input type="text" class="form-control" name="kegiatanblud" readonly="yes" id="kegiatanblud" value="<?php echo $rs->kegiatanblud ;?>">
        </div>
    </form>            
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="koderek50" id="koderek50" />
		<input type="hidden" name="idspj" id="idspj" />
		<input type="hidden" name="volume" id="volume" />
		<input type="hidden" name="satuan" id="satuan" />
		<input type="hidden" name="harga" id="harga" />
		<input type="hidden" name="nopp" id="nopp" />
		<input type="hidden" name="nousulan" id="nousulan" />
		<input type="hidden" name="nonpdpanjar" id="nonpdpanjar" />
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">RINCIAN BELANJA</label> 
            <input type="text" class="form-control" name="rincianbelanja" id="rincianbelanja" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">ITEM BELANJA</label>
			<a href="javascript:void(0);" onclick="cariitembelanja();"><img src="images/search.gif" border="0" width="13px" /></a>
            <input type="text" class="form-control" name="itembelanja" id="itembelanja" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">JUMLAH ANGGARAN</label> 
            <input type="text" class="form-control" name="jumlahanggaran" id="jumlahanggaran" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">JUMLAH PENERIMAAN PANJAR</label> 
            <input type="text" class="form-control" name="jumlahpenerimaanpanjar" id="jumlahpenerimaanpanjar" value="<?php echo rpz($rs->jumlahpenerimaanpanjar);?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">JUMLAH BELANJA PANJAR</label> 
            <input type="text" class="form-control" name="jumlahbelanjapanjar" readonly="yes" id="jumlahbelanjapanjar" onkeypress="if(event.keyCode==13){ document.form_rinci.sisapanjar.focus();hasil(this.value); }" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">SISA PANJAR</label> 
            <input type="text" class="form-control" name="sisapanjar" id="sisapanjar" readonly="yes"/>
        </div>
         <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanpengembaliansisapanjar();">
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
