function datanpkls(){ 
	jfloading("sub_konten");
	$.get("trans_/pencairanls/datanpkls.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function datanpklsyangcair(){ 
	jfloading("sub_konten");
	$.get("trans_/pencairanls/datanpklsyangcair.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function formnpkls(nonpk){
	jfloading("sub_konten");
	$.get("trans_/pencairanls/formpencairan.php",{nonpk:nonpk},
		function(result){
			$("#sub_konten").html(result);
			gridrinci(nonpk); 
			if(nonpk != undefined){
				document.form.tglnpk.disabled=true;
			}
		}
	);
}

function gridrinci(nonpk){ 
	jfloading("grid_nilai");
	$.get("trans_/pencairanls/gridrinci.php",{nonpk:nonpk},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function cairkan(){ 
    
	nopencairan=document.form.nopencairan.value; 
	tglpindahbuku=document.form.tglpindahbuku.value; 
	tglpencairan=document.form.tglpencairan.value;
	nonpk=document.form.nonpk.value;
	tglnpk=document.form.tglnpk.value;
		
	if(tglnpk==''){
		swal("Gagal..!!!", "TANGGAL HARUS DIISI....!!!", "error");
	}else if(nonpk==''){
		swal("Gagal..!!!", "NO. NPK TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		jfloading("sub_konten");
		$.get('trans_/pencairanls/simpan.php',{nonpk:nonpk,
				nopencairan:nopencairan,
				tglpindahbuku:tglpindahbuku,
				tglpencairan:tglpencairan},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.nopencairan.value=update[1];
						document.form.tglpindahbuku.disabled=true;
						document.form.tglpencairan.disabled=true;
						document.form.tsimpan.disabled=true;
						datanpklsyangcair();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function view_detail_rinci(nopencairan){
	$.fancybox({
		'href'			:'trans_/pencairanls/view_detail_rinci.php?nopencairan='+nopencairan,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}