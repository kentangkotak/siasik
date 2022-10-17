<?php include("../../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	$sql=$conn->query("select penetapan_pagu.notrans as notrans,penetapan_pagu.kodekegiatan as kodekegiatan,
						penetapan_pagu.kodeorganisasi1 as kodeorganisasi1,
						penetapan_pagu.kodeorganisasi2 as kodeorganisasi2,penetapan_pagu.kodeorganisasi3 as kodeorganisasi3,
						penetapan_pagu.namaorganisasi as namaorganisasi,
						penetapan_pagu.kegiatanblud as kegiatanblud,t_tampung_pagu.pagu as paguawal,
						t_tampung_pagu.pagu as sisa,penetapan_pagu.tahun as tahun
						from penetapan_pagu,t_tampung_pagu where penetapan_pagu.tahun='".$_SESSION["anggaran_tahun"]."' 
						and penetapan_pagu.kodekegiatan=t_tampung_pagu.kodekegiatanblud and penetapan_pagu.notrans='".$_GET['notrans']."' ");
	$rs=$sql->fetch_object();
	$sqlbelanja=$conn->query("select sum(totalkepake) as totalbelanja from(			
											select spjpanjar_rinci.jumlahbelanjapanjar as totalkepake 
											from spjpanjar_heder,spjpanjar_rinci,npdpanjar_rinci
											where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_rinci.nonpdpanjar=npdpanjar_rinci.nonpdpanjar
											and spjpanjar_heder.verif=1 and spjpanjar_heder.kodekegiatanblud='".$rs->kodekegiatan."'
											and year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' group by npdpanjar_rinci.id
											union all											
											select sum(npkls_rinci.total) as totalkepake 
											from npkls_heder,npkls_rinci,npdls_rinci,npdls_heder 
											where npkls_heder.nopencairan=npkls_rinci.nopencairan and 
											npdls_rinci.nonpdls=npdls_heder.nonpdls and npdls_heder.nonpdls=npkls_heder.nonpdls 
											and npdls_heder.kodekegiatanblud='".$rs->kodekegiatan."' and
											npkls_rinci.nopencairan<>'' and year(npkls_heder.tglpencairan)='".$_SESSION["anggaran_tahun"]."'
											group by npkls_heder.nopencairan,npdls_rinci.itembelanja) as wew");
    $rsbelanja=$sqlbelanja->fetch_object();
	$totalbelanja=$rsbelanja->totalbelanja;
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	 <input type="hidden" name="notransawal" id="notransawal" value="<?php echo $_GET['notrans'];?>" />
	 <input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" value="<?php echo $rs->kodekegiatan;?>"/>
	 <input type="hidden" name="kode1" id="kode1" value="<?php echo $rs->kodeorganisasi1;?>"/>
	 <input type="hidden" name="kode2" id="kode2" value="<?php echo $rs->kodeorganisasi2;?>"/>
	 <input type="hidden" name="kode3" id="kode3" value="<?php echo $rs->kodeorganisasi3;?>"/>
	 <input type="hidden" name="organisasi_nama" id="organisasi_nama" value="<?php echo $rs->namaorganisasi;?>"/>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" value="<?php echo $rs->kegiatanblud;?>" readonly="yes"/>
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">ANGGARAN AWAL</label>
            <input type="text" class="form-control" name="nilairupiah" id="nilairupiah" readonly="yes" value="<?php echo rpz($rs->paguawal);?>"/>
        </div>
		<!--<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BELANJA</label>
            <input type="text" class="form-control" name="belanja" id="belanja" readonly="yes" value="<?php echo rpz($totalbelanja);?>"/>
        </div>-->
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI PERGESERAN</label>
            <input type="text" class="form-control" onKeyPress="if(event.keyCode==13){document.form.tsimpan.focus();" name="nilaiperubahan" id="nilaiperubahan" onkeyup="cariselisih();" onkeydown="cariselisih();"/>
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
<?php include("../../../close.php"); ?>
