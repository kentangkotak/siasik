<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	$sql=$conn->query("select * from perubahanpagu where noperubahan='".$_GET['noperubahan']."'");
	$rs=$sql->fetch_object();
	
	$sqlx=$conn->query("select kodekegiatanx,sum(subtotal) as subtotalall from(
							select kodekegiatan as kodekegiatanx,sum(total) as subtotal from penetapan_pagu where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan=''
							union all
							select kodekegiatan as kodekegiatanx,perubahan as subtotal from perubahanpagu where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='')
		as wew");
	$rsx=$sqlx->fetch_object();
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	 <input type="hidden" class="form-control" name="noperubahan" id="noperubahan" value="<?php echo $_GET['noperubahan'];?>"/>
	 <input type="hidden" class="form-control" name="notransawal" id="notransawal" value="<?php echo $rs->notransawal;?>" />
	 <input type="hidden" class="form-control" name="kodekegiatanblud" id="kodekegiatanblud" value="<?php echo $rs->kodekegiatan;?>"/>
	 <input type="hidden" class="form-control" name="kode1" id="kode1" value="<?php echo $rs->kodeorganisasi1;?>"/>
	 <input type="hidden" class="form-control" name="kode2" id="kode2" value="<?php echo $rs->kodeorganisasi2;?>"/>
	 <input type="hidden" class="form-control" name="kode3" id="kode3" value="<?php echo $rs->kodeorganisasi3;?>"/>
	 <input type="hidden" class="form-control" name="organisasi_nama" id="organisasi_nama" value="<?php echo $rs->namaorganisasi;?>"/>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" value="<?php echo $rs->kegiatanblud;?>" readonly="yes"/>
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">ANGGARAN</label>
            <input type="text" class="form-control" name="nilairupiah" id="nilairupiah" readonly="yes" value="<?php echo rpz($rs->total);?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PERUBAHAN</label>
            <input type="text" class="form-control" name="nilaiperubahan" id="nilaiperubahan" onkeyup="cariselisih(this.value);" onkeydown="cariselisih(this.value);"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">SELISIH</label>
            <input type="text" class="form-control" name="selisih" id="selisih" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			 <label class="control-label"> </label>
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN"  onClick="simpanperubahan();">
        </div>
    </form>            
</div>
</html>
<?php include("../../close.php"); ?>