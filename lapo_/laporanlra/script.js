function lihatlra_asli(){ 
	
	kodebidang=document.form.kodebidang.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;
	$.get("lapo_/laporanlra/cek_dulu.php",{tgl:tgl,tglx:tglx},
		function(result){
			if(result == "OK"){
				jfloading("grid_nilai");
				if(kodekegiatanblud == '' && kodebidang == ''){
					$.get("lapo_/laporanlra/lihatlra.php",{tgl:tgl,tglx:tglx},
							function(result){
								$("#grid_nilai").html(result);
								jfdata_tablex(); 
							}
						);
				}else if(kodebidang != '' && kodekegiatanblud == '' ){
					$.get("lapo_/laporanlra/lihatlra_perbidang.php",{kodebidang:kodebidang,tgl:tgl,tglx:tglx},
						function(result){
							$("#grid_nilai").html(result);
							jfdata_tablex();
						}
					);
				}else{
					$.get("lapo_/laporanlra/lihatlra_perkegiatan.php",{kodekegiatanblud:kodekegiatanblud,kodebidang:kodebidang,tgl:tgl,tglx:tglx},
						function(result){
							$("#grid_nilai").html(result);
							jfdata_tablex();
						}
					);
				}
			}else{
				swal("Gagal..!!!", result, "error");
			}
		}
	);
}

function reportlra(){ 
	jfloading("sub_konten");
	$.get("lapo_/laporanlra/formlra.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_tablex();
			$('#tgl').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$('#tglx').datetimepicker({
				format: 'DD/MM/YYYY'
			});
		}
	);
}

function ExportToExcel_laporanLRA() {
  var htmltable = document.getElementById('excel_repot_laporanLRA');
  var html = htmltable.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}

function caribagian(){
	$.fancybox({
		'href'			:'lapo_/laporanlra/caribagian.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihbidang(kodebidang,bidang){ 
	document.form.kodebidang.value=kodebidang;
	document.form.bidang.value=bidang;
	document.form.kodekegiatanblud.value='';
	document.form.kegiatanblud.value='';
	$.fancybox.close();
}

function carikegiatan(){
	kodebidang=document.form.kodebidang.value;
	if(kodebidang == ''){
		swal("Gagal..!!!", 'ANDA HARUS PILIH BIDANG TERLEBIH DAHULU....!!!', "error");
	}else{
		$.fancybox({
			'href'			:'lapo_/laporanlra/carikegiatan.php?kodebidang='+kodebidang,
			'overlayOpacity':0,
			'opacity'		: true,
			'transitionIn'	: 'elastic',
			'type'			: 'ajax'
		});
	}
}

function pilihkegiatan(kodekegiatan,numenklatur){ 
	document.form.kodekegiatanblud.value=kodekegiatan;
	document.form.kegiatanblud.value=numenklatur;
	$.fancybox.close();
}
