<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	$sql=$conn_musrenbang->query("select rs7.rs1 as noverif,rs7.rs2 as nousulan,rs7.rs6 as kodejenisusulan,rs2.rs2 as jenisusulan,rs7.rs5 as koderuangan,rs3.rs2 as ruangan,rs7.rs7 as tahun,
								rs8.rs2 as kodeusulan,rs1.rs2 as usulan,rs8.rs3 as jumlah,rs8.rs6 as keterangan,rs8.rs7 as cito,rs1.rs5 as satuan
								from rs7,rs8,rs1,rs2,rs3
								where rs7.rs1=rs8.rs1 and rs7.rs1=rs8.rs1 and rs7.rs6=rs2.rs1 and rs7.rs5=rs3.rs1 and rs8.rs2=rs1.rs1 and rs7.rs8='1' 
								and rs7.rs7='2019' and rs7.rs6='7' and rs7.rs1='".$_GET['noverif']."'");
	$rs=$sql->fetch_object();
?>
<html>
	<head>
	</head>
	<body>
   
           
            
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;"> 
      <input type="hidden" name="kodejenisusulan" id="kodejenisusulan" value="<?php echo $rs->kodejenisusulan;?>">
      <input type="hidden" name="koderuangan" id="koderuangan" value="<?php echo $rs->koderuangan;?>">
      <input type="hidden" name="kodeusulan" id="kodeusulan" value="<?php echo $rs->kodeusulan;?>">
      <input type="hidden" name="cito" id="cito" value="<?php echo $rs->cito;?>">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. Verif</label>
            <input type="text" class="form-control" disabled="disabled" name="noverif" id="noverif" value="<?php echo $rs->noverif;?>">
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">  
            <label class="control-label">No. Usulan</label>
            <input type="text" class="form-control" disabled="disabled" name="nousulan" id="nousulan" value="<?php echo $rs->nousulan;?>">
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Jenis Usulan</label>
            <input type="text" class="form-control" disabled="disabled" name="jenisusulan" id="jenisusulan" value="<?php echo $rs->jenisusulan;?>">
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Ruangan</label>
            <input type="text" class="form-control" disabled="disabled" name="ruangan" id="ruangan" value="<?php echo $rs->ruangan;?>">
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Tahun</label>
            <input type="text" class="form-control" disabled="disabled" name="tahun" id="tahun" value="<?php echo $rs->tahun;?>">
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Usulan</label>
            <input type="text" class="form-control" disabled="disabled" name="usulan" id="usulan" value="<?php echo $rs->usulan;?>">
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Jumlah</label>
            <input type="text" class="form-control" disabled="disabled" name="jumlah" id="jumlah" value="<?php echo $rs->jumlah;?>">
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Keterangan</label>
            <input type="text" class="form-control" disabled="disabled" name="keterangan" id="keterangan" value="<?php echo $rs->keterangan;?>">
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Satuan</label>
            <input type="text" class="form-control" disabled="disabled" name="satuan" id="satuan" value="<?php echo $rs->satuan;?>">
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Tanggal Perencanaan</label> <a href="javascript: void(0);" onClick="return getCalendar(document.form.tglperencanaan);"><img src="images/1icon_cal.gif"  border="0" alt=""></a>
            <input type="text" class="form-control" name="tglperencanaan" id="tglperencanaan" value="<?php echo date('d/m/Y') ;?>" onkeypress="if(event.keyCode==13){ document.form.tglperencanaan.focus(); $('#tglperencanaan').select(); }">
        </div>
         <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Keterangan Petugas Diklat</label>
            <input type="text" class="form-control" name="keteranganx" id="keteranganx" onKeyUp="this.value = this.value.toUpperCase()" placeholder="Masukkan Nama Lengkap">
        </div>
       
        <div class="form-group">
          <div class="col-md-4 col-md-offset-3">
            <input type="button" name="simpan" class="btn btn-success" id="simpan" value="Simpan" size="20" onClick="simpan_rencana();">
          </div>
        </div>

      </form>
</div>
  </body>
</html>
<?php include("../../close.php"); ?>