function formanggaranperkegiatan(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/laporanmanajerial/anggaranperkegiatan/formanggaranperkegiatan.php",
		function(result){ 
			$("#sub_konten").html(result);
		}
	);
}

function caribidang(){
	$.fancybox({
		'href'			:'lapo_/laporanmanajerial/anggaranperkegiatan/caribidang.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihbidang(kodebidang,bidang){ 
	document.form.kodebidang.value=kodebidang;
	document.form.bidang.value=bidang;
	document.form.pptk.value='';
	$.fancybox.close();
}

function caripptk(){
	kodebidang=document.form.kodebidang.value;
	$.fancybox({
		'href'			:'lapo_/laporanmanajerial/anggaranperkegiatan/caripptk.php?kodebidang='+kodebidang,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihpptk(kodepptk,namapptk){ 
	document.form.kodepptk.value=kodepptk;
	document.form.pptk.value=namapptk;
	$.fancybox.close();
}

function carilaporananggaranperkegiatan(){  
	kodebidang=document.form.kodebidang.value;
	kodepptk=document.form.kodepptk.value;
	
	jfloading("grid_laporan");
		$.get("lapo_/laporanmanajerial/anggaranperkegiatan/carilaporananggaranperkegiatan.php",{kodebidang:kodebidang,kodepptk:kodepptk},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}
