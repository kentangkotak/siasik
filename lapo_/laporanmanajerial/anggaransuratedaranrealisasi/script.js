function formsuratedaranrealisasi(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/laporanmanajerial/anggaransuratedaranrealisasi/formsuratedaranrealisasi.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('#tgl').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$('#tglx').datetimepicker({
				format: 'DD/MM/YYYY'
			});
		}
	);
}

function carilaporansuratedaranrealisasi(){ 
	tahun=document.form.thn.value; 
	jfloading("grid_laporan");
		$.get("lapo_/laporanmanajerial/anggaransuratedaranrealisasi/carilaporansuratedaranrealisasi.php",{tahun:tahun},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}
