<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from kontrakPengerjaan_header where nokontrak='".$_GET['nokontrak']."'");
	$rs=$sql->fetch_object();
	
	$tglmulaikontrak=out_tanggal("-",$rs->tglmulaikontrak);
	$tglakhirkontrak=out_tanggal("-",$rs->tglakhirkontrak);
	$tgltrans=out_tanggal("-",$rs->tgltrans);
	$kunci=$rs->kunci;
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO. TRANSAKSI</label>
            <input type="text" class="form-control" name="nokontrak" readonly="yes" id="nokontrak" value="<?php echo $_GET['nokontrak'] ;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
		<!--<input type="hidden" name="koderek50" id="koderek50" value="<?php echo $rs->kode50 ;?>">-->
		<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" value="<?php echo $rs->kodekegiatanblud ;?>">
            <label class="control-label">PERUSAHAAN</label>
            <select class="form-control" name="perusahaan" id="perusahaan">
            <option value="">-Pilih-</option>
            <?php
				$sqlx=$conn->query("select * from pihak_ketiga  order by nama");               
                while($rsx=$sqlx->fetch_object()){
            ?>
                <option value="<?php echo $rsx->kode.'|'.$rsx->nama.'|'.$rsx->kodemapingrs.'|'.$rsx->namasuplier;?>"<?php if($rsx->kode==$rs->kodeperusahaan){ echo "selected"; }?>><?php echo $rsx->nama;?></option>
            <?php }?>
            </select>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL MULAI KONTRAK</label>
            <input type="text" class="form-control" name="tglmulaikontrak" id="tglmulaikontrak" value="<?php if($_GET['nokontrak']==''){ echo date('d/m/Y');}else{ echo $tglmulaikontrak;} ;?>" onClick="return getCalendar(document.form.tglmulaikontrak);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL AKHIR KONTRAK</label>
            <input type="text" class="form-control" name="tglakhirkontrak" id="tglakhirkontrak" value="<?php if($_GET['nokontrak']==''){ echo date('d/m/Y');}else{ echo $tglakhirkontrak;} ;?>" onClick="return getCalendar(document.form.tglakhirkontrak);" />
        </div> 
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL TRANSAKSI</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?php if($_GET['nokontrak']==''){ echo date('d/m/Y');}else{ echo $tgltrans;} ;?>" onClick="return getCalendar(document.form.tgltrans);"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label>
            <select class="form-control" name="pptk" id="pptk">
            <option value="">-Pilih-</option>
            <?php
			if($_SESSION["anggaran_level"] == 'SUPER'){
				$sqlz=$conn->query("select * from mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' group by kodepptk order by namapptk");
			}else{
				$sqlz=$conn->query("select * from mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' and  kodebidang='".$_SESSION["anggaran_koderuangan"]."' group by kodepptk order by namapptk");
			}
                
                while($rsz=$sqlz->fetch_object()){
            ?>
                <option value="<?php echo $rsz->kodepptk.'|'.$rsz->namapptk ;?>" <?php if($rsz->namapptk==$rs->namapptk){ echo "selected"; }?>><?php echo $rsz->namapptk;?></option>
            <?php }?>
            </select>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PROGRAM</label>
            <input type="text" class="form-control" name="program" id="program" readonly="yes" value="PROGRAM PENUNJANG URUSAN PEMERINTAH DAERAH KABUPATEN/KOTA"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" readonly="yes" value="PELAYANAN DAN PENUNJANG PELAYANAN BLUD"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label>
			<a href="javascript:void(0);" onclick="carikegiatanblud();"><img src="images/search.gif" border="0" width="13px" /></a>
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" readonly="yes" value="<?php echo $rs->kegiatanblud ;?>"/>
        </div>
		<!--<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">URAIAN PEKERJAAN</label>
            <input type="text" class="form-control" name="uraianpekerjaan" id="uraianpekerjaanx" value="<?php echo $rs->uraianpekerjaan ;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI KEGIATAN</label>
            <input type="text" class="form-control" name="nilaikegiatan" readonly="yes" id="nilaikegiatan" value="<?php echo rpz($rs->nilaikegiatan) ;?>"/>
        </div>-->
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI KONTRAK</label>
			 <input type="text" class="form-control" name="nilaikontrak" id="nilaikontrak" value="<?php echo rpz($rs->nilaikontrak) ;?>"/>
        </div> 
		<div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
			<?php if( $kunci == ''){ ?>
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpankontrakPekerja();">
			 <?php } ?>
            </div>
          </div>
    </form>            
</div>
</html>
<script>

</script>
<?php include("../../close.php"); ?>
