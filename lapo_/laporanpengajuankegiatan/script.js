function lihatreport(){ 
	jfloading("grid_nilai");
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	bln=document.form.bln.value;
	thn=document.form.thn.value;
		$.get("lapo_/laporanpengajuankegiatan/lihatreport.php",{kodekegiatanblud:kodekegiatanblud,bln:bln,thn:thn},
			function(result){
				$("#grid_nilai").html(result);
				//jfdata_tablex();
			}
		);
}

function formcaripengajuankegiatan(){ 
	jfloading("sub_konten");
	$.get("lapo_/laporanpengajuankegiatan/form.php",
		function(result){
			$("#sub_konten").html(result);
		}
	);
}

function cetakreport(){ 
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	bln=document.form.bln.value;
	thn=document.form.thn.value;
	
	window.open('lapo_/laporanpengajuankegiatan/cetakreport.php?kodekegiatanblud='+kodekegiatanblud+'&bln='+bln+'&thn='+thn,'','height=700,width=800,scrollbars=yes,resizable=yes');
}
