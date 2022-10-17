<?php include("../../fungsi.php"); ?>
<!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress 
    <link href="../../vendors/nprogress/nprogress.css" rel="stylesheet"> -->
    <!-- iCheck -->
	<link href="../../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<link rel="stylesheet" href="../../fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
	<link rel="stylesheet" href="../../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="../../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />

    <!-- Custom Theme Style -->
    <link href="../../build/css/custom.min.css" rel="stylesheet">
	
	 <!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress
    <script src="../../vendors/nprogress/nprogress.js"></script>  -->
    <!-- iCheck -->
    <script src="../../vendors/iCheck/icheck.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
	<script type="text/javascript" src="../../fancybox/lib/jquery.mousewheel.pack.js"></script>
	<script type="text/javascript" src="../../fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>
	<script type="text/javascript" src="../../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="../../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<script type="text/javascript" src="../../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<html>     
<br/>     
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			<select name="thn" id="thn" class="form-control" tabindex="3">
					<?php for($x=(date("Y")-1);$x<=(date("Y")+1);$x++){ ?>
					<option value="<?php echo $x ; ?>" <?php if (date("Y")==$x) echo "selected" ;?>><?php echo $x ;?></option>
					<?php } ?>
			</select>
	    </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			<select name="jenis" id="jenis" class="form-control" tabindex="3">
					<option value="1">LEVEL 3</option>
					<option value="2">LEVEL 5</option>
			</select>
	    </div>   
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="LIHAT"  onClick="lihatrba();">
	    </div>
    </form>            
</div>
<div id="grid_laporan"></div>
</html>
<script>

function jfloading(layout){
	$("#"+layout).html("<img src='../../images/ld.gif' width='70'>");
}
function jfdata_table(){
	$('#dataTables-example').DataTable({
		responsive: true,
		retrieve: true
	});
}
function lihatrba(){ 
	jfloading("grid_laporan"); 
	thn=document.form.thn.value;
	jenis=document.form.jenis.value;
	if(jenis == 1){
		$.get("../../lapo_/laporanrba/lihatrba_wew.php",{thn:thn},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
	}else{
		$.get("../../lapo_/laporanrba/lihatrba_wew_level5.php",{thn:thn},
		function(result){
			$("#grid_laporan").html(result);
			jfdata_table(); 
		}
	);
	}
}
</script>
