<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>

<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
        <input type="hidden" name="notrans" id="notrans" />
         <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Nama Pelatihan Secara Surat</label>
			<input type="text" class="form-control" name="namax" id="namax"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Jenis Pelatihan</label>
            <select class="select2_single form-control" tabindex="-1" name="jenispelatihan" id="jenispelatihan">
            <option value="">-Pilih-</option>
            <?php
                $sql=$conn->query('select rs1,rs2 from rs1');
                while($rs=$sql->fetch_object()){
            ?>
                <option value="<?php echo $rs->rs1;?>"><?php echo $rs->rs2;?></option>
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
                <option value="<?php echo $rs->rs1;?>"><?php echo $rs->rs2;?></option>
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
                <option value="<?php echo $rs->rs1;?>"><?php echo $rs->rs2;?></option>
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
                <option value="<?php echo $rs->rs1;?>"><?php echo $rs->rs2;?></option>
            <?php }?>
            </select>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">No. Surat</label>
            <input type="text" class="form-control" name="nosurat" id="nosurat"/>
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Tanggal Mulai</label>
            <input type="text" class="form-control" name="tglmulai" id="tglmulai" onClick="return getCalendar(document.form.tglmulai);" value="<?php echo date('d/m/Y') ;?>" onkeypress="if(event.keyCode==13){ document.form.tglmulai.focus(); $('#tglmulai').select(); }"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Tanggal Surat</label>
            <input type="text" class="form-control" name="tglsurat" id="tglsurat" onClick="return getCalendar(document.form.tglsurat);" value="<?php echo date('d/m/Y') ;?>" onkeypress="if(event.keyCode==13){ document.form.tglsurat.focus(); $('#tglsurat').select(); }"/>
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Tanggal Selesai <a href="javascript: void(0);" /></label>
            <input type="text" class="form-control" name="tglselesai" id="tglselesai" onClick="return getCalendar(document.form.tglselesai);" value="<?php echo date('d/m/Y') ;?>" onkeypress="if(event.keyCode==13){ document.form.tglselesai.focus(); $('#tglselesai').select(); }"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Jumlah Jam</label> 
            <input name="jam" id="jam" class="form-control" type="number" min="1" max="100" step="1" />
        </div>
    </form>            
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
        <input type="hidden" name="notrans" id="notrans"/>
        <input type="hidden" name="kodeusulanx" id="kodeusulanx"/>
        <input type="hidden" name="noverifx" id="noverifx"/>
        <input type="hidden" name="nousulanx" id="nousulanx"/>
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
            <input type="text" class="form-control" name="kategoripeg" id="kategoripeg" readonly="yes"/>
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">No. STTP</label> 
            <input type="text" class="form-control" name="nosttp" id="nosttp"/>
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">File Depan</label>
           <input type="file" id="foto" name="foto" onChange="change_foto(this)" size="15" accept="image/*">
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">File Belakang</label>
           <input type="file" id="fotox" name="fotox" onChange="change_foto(this)" size="15" accept="image/*">
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
