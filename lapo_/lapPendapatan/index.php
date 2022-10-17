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
	<link href="../../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="../../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
	<link href="../../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
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
	<script type="text/javascript" src="../../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="../../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<html>     
<html>
	<head>
		<script src="lapo_/lapPendapatan/script.js"></script>
	</head>
	<body onload="formPendapatanrekap()">
		<div class="konten">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tbdata_penerimaan" data-toggle="tab" onClick="formPendapatanrekap();">Laporan Rekap Pendapatan</a></li>
				<li><a href="#tbdata_penerimaan" data-toggle="tab" onClick="formbaku();">Buku Khas Umum</a></li>
				<!--<li><a href="#tbdata_penerimaan" data-toggle="tab" onClick="formbakurange();">Buku Khas Umum (Range)</a></li>-->
			</ul>
			<div id="sub_konten">
			</div>
		</div>
	</body>
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

function jfloading(layout){
	$("#"+layout).html("<img src='../../images/ld.gif' width='70'>");
}
function jfdata_table(){
	$('#dataTables-example').DataTable({
		responsive: true,
		retrieve: true
	});
}
function lihatrekappendapatan(){ 
	jfloading("grid_laporan");
	thn=document.form.thn.value;
		$.get("lihatrekappendapatan_wew.php",{thn:thn},function(result){
				$("#grid_laporan").html(result);
			}
		);
}
function formPendapatanrekap(){ 
	jfloading("sub_konten");
	$.get("formPendapatanrekap.php",
		function(result){ 
			$("#sub_konten").html(result);
		}
	);
}

function formbaku(){ 
	jfloading("sub_konten");
	$.get("formbaku.php",
		function(result){
			$("#sub_konten").html(result);
		}
	);
}

function formbakurange(){ 
	jfloading("sub_konten");
	$.get("formbakurange.php",
		function(result){
			$("#sub_konten").html(result);
			//$('#tgldari').datetimepicker({
			//	format: 'DD/MM/YYYY'
			//});
			// $('#tglsampai').datetimepicker({
				// format: 'DD.MM.YYYY'
			// });
		}
	);

}
</script>