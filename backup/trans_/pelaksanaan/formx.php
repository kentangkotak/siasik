<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	$sqlz=$conn->query("select rs32.rs1 as notrans,rs32.rs2 as noverif,rs32.rs3 as nousulan,rs32.rs4 as kodeusulan,rs32.rs5 as jenispelatihan,rs32.rs6 as tempat,rs32.rs7 as kategori,
						rs32.rs8 as penyelenggara,rs32.rs9 as tglmulai,rs32.rs10 as tglselesai,rs32.rs17 as namax,rs32.rs16 as nosurat,rs32.rs13 as jam,rs32.rs11 as tglsurat
						from rs32
						where rs32.rs1='".$_GET['notrans']."' ");
	$rsz=$sqlz->fetch_object();
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
        <input type="hidden" name="kodeusulan" id="kodeusulan" value="<?php echo $rsz->kodeusulan; ?>" />
        <input type="hidden" name="notrans" id="notrans" value="<?php echo $rsz->notrans; ?>" />
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. Usulan</label>
            <input type="text" class="form-control" name="nousulan" id="nousulan" value="<?php echo $rsz->nousulan; ?>" />
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. Verif</label>
            <input type="text" class="form-control" name="noverif" id="noverif" value="<?php echo $rsz->noverif; ?>"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Nama Pelatihan</label>
            <?php 
					$sqlx=mysqli_query($conn_musrenbang,"SELECT rs2 as usulan FROM rs1  where rs1='".$rsz->kodeusulan."' ");
					$rsx=$sqlx->fetch_object();
			?>
            <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $rsx->usulan; ?>"/>
        </div>
         <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Nama Pelatihan Secara Surat</label>
			<input type="text" class="form-control" name="namax" id="namax" value="<?php echo $rsz->namax; ?>"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Jenis Pelatihan</label>
            <select class="select2_single form-control" tabindex="-1" name="jenispelatihan" id="jenispelatihan">
            <option value="">-Pilih-</option>
            <?php
                $sql=$conn->query('select rs1,rs2 from rs1');
                while($rs=$sql->fetch_object()){
            ?>
                <option value="<?php echo $rs->rs1;?>" <?php if($rsz->jenispelatihan==$rs->rs1){ echo "selected"; }?>><?php echo $rs->rs2;?></option>
            <?php }?>
            </select>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">  
            <label class="control-label">Tempat Pelatihan</label>
             <select class="select2_single form-control" tabindex="-1" name="tempat" id="tempat">
            <option value="">-Pilih-</option>
            <?php
                $sql=$conn->query('select rs1,rs2 from rs4');
                while($rs=$sql->fetch_object()){
            ?>
                <option value="<?php echo $rs->rs1;?>" <?php if($rsz->tempat==$rs->rs1){ echo "selected"; }?>><?php echo $rs->rs2;?></option>
            <?php }?>
            </select>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Kategori Pelatihan</label>
            <select class="select2_single form-control" tabindex="-1" name="kategori" id="kategori">
            <option value="">-Pilih-</option>
            <?php
                $sql=$conn->query('select rs1,rs2 from rs2');
                while($rs=$sql->fetch_object()){
            ?>
                <option value="<?php echo $rs->rs1;?>" <?php if($rsz->kategori==$rs->rs1){ echo "selected"; }?>><?php echo $rs->rs2;?></option>
            <?php }?>
            </select>
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Penyelenggara</label>
            <select class="select2_single form-control" tabindex="-1" name="penyelenggara" id="penyelenggara">
            <option value="">-Pilih-</option>
            <?php
                $sql=$conn->query('select rs1,rs2 from rs3');
                while($rs=$sql->fetch_object()){
            ?>
                <option value="<?php echo $rs->rs1;?>" <?php if($rsz->penyelenggara==$rs->rs1){ echo "selected"; }?>><?php echo $rs->rs2;?></option>
            <?php }?>
            </select>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. Surat</label>
            <input type="text" class="form-control" name="nosurat" id="nosurat" value="<?php echo $rsz->nosurat ;?>" />
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Tanggal Mulai</label>
            <input type="text" class="form-control" name="tglmulai" id="tglmulai" onClick="return getCalendar(document.form.tglmulai);" value="<?php echo out_tanggal("-",$rsz->tglmulai) ;?>" onkeypress="if(event.keyCode==13){ document.form.tglmulai.focus(); $('#tglmulai').select(); }"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Tanggal Surat</label>
            <input type="text" class="form-control" name="tglsurat" id="tglsurat" onClick="return getCalendar(document.form.tglsurat);" value="<?php echo out_tanggal("-",$rsz->tglsurat) ;?>" onkeypress="if(event.keyCode==13){ document.form.tglsurat.focus(); $('#tglsurat').select(); }"/>
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Tanggal Selesai <a href="javascript: void(0);" /></label>
            <input type="text" class="form-control" name="tglselesai" id="tglselesai" onClick="return getCalendar(document.form.tglselesai);" value="<?php echo out_tanggal("-",$rsz->tglselesai) ;?>" onkeypress="if(event.keyCode==13){ document.form.tglselesai.focus(); $('#tglselesai').select(); }"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Jumlah Jam</label> 
            <input name="jam" id="jam" class="form-control" type="number" min="1" max="100" step="1" value="<?php echo $rsz->jam ;?>"/>
        </div>
    </form>            
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
        <input type="hidden" name="notrans" id="notrans" value="<?php echo $rsz->notrans; ?>"/>
        <input type="hidden" name="kodeusulanx" id="kodeusulanx" value="<?php echo $rsz->kodeusulan; ?>"/>
        <input type="hidden" name="noverifx" id="noverifx" value="<?php echo $rsz->noverif; ?>"/>
        <input type="hidden" name="nousulanx" id="nousulanx" value="<?php echo $rsz->nousulan; ?>"/>
        <input type="hidden" name="koderuangan" id="koderuangan"/>
        <input type="hidden" name="kategoripegawai" id="kategoripegawai"/>
         <input type="hidden" name="kodejabatan" id="kodejabatan"/>
        <input type="hidden" name="kodependidikan" id="kodependidikan"/>
        <input type="hidden" name="kodegolruang" id="kodegolruang"/>
        <input type="hidden" name="kodestatpegawai" id="kodestatpegawai"/>
       <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NIP/NIK</label>
            <input type="text" class="form-control" name="nip" id="nip" />
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">Nama</label>
            <input type="text" class="form-control" name="namapegawai" id="namapegawai" >
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">Ruangan</label> 
            <input type="text" class="form-control" name="ruangan" id="ruangan" readonly="yes" />
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">Jabatan</label> 
            <input type="text" class="form-control" name="jabatan" id="jabatan" readonly="yes" />
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">Pendidikan</label> 
            <input type="text" class="form-control" name="pendidikan" id="pendidikan" readonly="yes" />
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">Golongan Ruang</label> 
            <input type="text" class="form-control" name="golruang" id="golruang" readonly="yes" />
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">Status Kepegawaian</label> 
            <input type="text" class="form-control" name="statpeg" id="statpeg" readonly="yes" />
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">Kategori Pegawai</label> 
            <input type="text" class="form-control" name="kategoripeg" id="kategoripeg" readonly="yes" />
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label"></label>
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label"></label>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label"></label>
        </div>
         <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpan();">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="BATAL PELATIHAN" size="20" onClick="batal();">
            </div>
          </div>
    </form>
</div>            
<div id="grid_nilai"></div>
</html>
<?php include("../../close.php"); ?>
