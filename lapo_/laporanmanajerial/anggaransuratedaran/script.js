function formsuratedaran(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/laporanmanajerial/anggaransuratedaran/formsuratedaran.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('#tahun').datetimepicker({
				format: "yyyy",
				viewMode: "years", 
				minViewMode: "years"
			});
		}
	);
}

function carilaporansuratedaran(){ 
	tahun=document.form.thn.value; 
	jfloading("grid_laporan");
		$.get("lapo_/laporanmanajerial/anggaransuratedaran/carilaporansuratedaran.php",{tahun:tahun},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}
