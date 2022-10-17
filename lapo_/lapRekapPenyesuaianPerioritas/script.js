function laporanRekapPenyesuaianPerioritas(){ 
	jfloading("sub_konten");
	$.get("lapo_/lapRekapPenyesuaianPerioritas/form.php",
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
		}
	);
}

function lihatlaporanRekapPenyesuaianPerioritas(){ 
	thn=document.form.thn.value;
	bidang=document.form.bidang.value;
	
	jfloading("grid_laporan");
	if(bidang==''){
		$.get("lapo_/lapRekapPenyesuaianPerioritas/lihatlaporanRekapPenyesuaianPerioritasall.php",{thn:thn},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
	}else{
		$.get("lapo_/lapRekapPenyesuaianPerioritas/lihatlaporanRekapPenyesuaianPerioritas.php",{thn:thn,bidang:bidang},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
	}
}

function ExportToExcel_laporanRekapPenyesuaianperioritas() {
  var htmltable = document.getElementById('excel_repot_laporanRekapPenyesuaianperioritas');
  var html = htmltable.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}

function ExportToExcel_laporanRekapPenyesuaianperioritasall() {
  var htmltable = document.getElementById('excel_repot_laporanRekapPenyesuaianperioritasall');
  var html = htmltable.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}
