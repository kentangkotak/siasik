<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="form" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodebagian" id="kodebagian">
    <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Nomor</label>
            <input type="text" class="form-control" name="no" id="no" readonly="yes"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Nomenklatur</label>
            <input type="text" class="form-control" name="nomenklatur" id="nomenklatur"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Prioritas</label>
            <input type="text" class="form-control" name="prioritas" id="prioritas"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Organisasi</label>
            <select name="_organisasi" id="_organisasi" class="form-control">
                <option value="">-</option>
                <?php
                    $organisasi_sql=$conn->query("select * from organisasi where kode3 is not null;");
                    while($organisasi_rs=$organisasi_sql->fetch_object()){
                        $organisasi_val=$organisasi_rs->nama
                        ."|".$organisasi_rs->kode1
                        ."|".$organisasi_rs->kode2
                        ."|".$organisasi_rs->kode3;
                ?>
                <option value="<?php echo $organisasi_val; ?>"><?php echo $organisasi_rs->nama; ?></option>
                <?php } ?>
            </select>
        </div>
		<div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpan();">
            </div>
          </div>
        </div>
    </form>            
</div>
<div id="grid_pelatihan"></div>
</div>
</html>
<?php include("../../close.php"); ?>
