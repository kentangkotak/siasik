function laporanRekapPengusulan(){ 
	jfloading("sub_konten");
	$.get("lapo_/lapRekapPengusulan/form.php",
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
		}
	);
}

function lihatlaporanRekapPengusulan(){ 
	thn=document.form.thn.value;
	
	jfloading("grid_laporan");
	$.get("lapo_/lapRekapPengusulan/lihatlaporanRekapPengusulan.php",{thn:thn},
		function(result){
			$("#grid_laporan").html(result);
			jfdata_table(); 
		}
	);	
}

function ExportToExcel_laporanRekapPengusulan() {
  var htmltable = document.getElementById('excel_repot_laporanRekapPengusulan');
  var html = htmltable.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}
