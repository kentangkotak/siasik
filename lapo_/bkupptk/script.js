function formbkupptk(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bkupptk/formbkupptk.php",
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

function cariall(){  
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;
	//kodepptk=document.form.kodepptk.value;
	jfloading("grid_laporan");
		$.get("lapo_/bkupptk/bukukaspptk.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}

function caripptk(){
	$.fancybox({
		'href'			:'lapo_/bkupptk/caripptk.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
	document.getElementById('caripptk').style.visibility='hidden';
}

function pilihpptk(kodepptk,nama){ 
	
	document.form.kodepptk.value=kodepptk;
	document.form.pptk.value=nama;
	$.fancybox.close();
}

