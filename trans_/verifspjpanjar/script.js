function gridrinci(nospjpanjar){ 
	jfloading("grid_nilai");
	$.get("trans_/verifspjpanjar/gridrinci.php",{nospjpanjar:nospjpanjar},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function dataspjpanjar(){ 
	jfloading("sub_konten");
	$.get("trans_/verifspjpanjar/dataspjpanjar.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function viewdetail(nospjpanjar){ 
	$.fancybox({
		'href'			:'trans_/verifspjpanjar/gridrinci.php?nospjpanjar='+nospjpanjar,
		'opacity'		: true,
		'autoSize'   	: true,
		'closeBtn'	    : true,
		'type'			: 'ajax',
		'z-index'		: '-1',
	}); 
}

function kunci(nospjpanjar){
	jfloading("sub_konten");
	$.get("trans_/verifspjpanjar/kunci.php",{nospjpanjar:nospjpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					dataspjpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function dataspjpanjarterverif(){ 
	jfloading("sub_konten");
	$.get("trans_/verifspjpanjar/dataspjpanjarterverif.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}



