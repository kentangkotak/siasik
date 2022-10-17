<?php include("../../../conn.php"); ?>
<?php
$sql = $conn->query("select * from anggaran_pendapatan_pak where notrans='" . $_GET['notrans'] . "'");
$rs = $sql->fetch_object();
?>
<html>
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
        <input type="hidden" name="notrans" id="notrans" value="<?php echo $_GET['notrans']; ?>">
        <input type="hidden" name="koderekeningblud" id="koderekeningblud" value="<?php echo $rs->koderekeningblud; ?>">
        <input type="hidden" name="map79" id="map79" value="<?php echo $rs->map79; ?>">
        <input type="hidden" name="kode79" id="kode79" value="<?php echo $rs->kode79; ?>">
        <input type="hidden" name="uraian79" id="uraian79" value="<?php echo $rs->uraian79; ?>">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG/BAGIAN</label>
            <select class="select2_single form-control" tabindex="-1" name="bidang" id="bidang">
                <option value="">-Pilih-</option>
                <?php
                $sql = $conn->query("select * from organisasi where kode4='' and kode3<>''");
                while ($rsx = $sql->fetch_object()) {
                ?>
                    <option value="<?php echo $rsx->nama; ?>" <?php if ($rsx->nama == $rs->bidang) {
                                                                    echo "selected";
                                                                } ?>><?php echo $rsx->nama; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">URAIAN REKENING BLUD</label>
            <input type="text" class="form-control" name="uraian" id="uraian" value="<?php echo $rs->uraian_rekening; ?>" />
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI RUPIAH</label>
            <input type="text" class="form-control" name="nilairupiah" id="nilairupiah" value="<?php echo rpz($rs->nilai); ?>" />
        </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label"> </label>
            <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" onClick="simpanpendapatan();">
        </div>
    </form>
</div>
<table cellpadding="0" border="0" cellspacing="0" width="100%">
    <tr valign="top">
        <td style="font-family:Verdana;color:#000000;font-weight:bold;text-align:center;color:red;text-decoration:underline;background-color:#CCCCCC;">JUMLAH PENDAPATAN P.A.K</td>
        <td rowspan="2"></td>
    </tr>
    <tr>
        <td style="font-family:Verdana;">
            <div id="jumlkunjungan"></div>
        </td>
    </tr>
</table>

</html>
<?php include("../../../close.php"); ?>