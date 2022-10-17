function gridrinci(nonpd){ 
	jfloading("grid_nilai");
	$.get("trans_/verifnpdPanjar/gridrinci.php",{nonpd:nonpd},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function dataverifnpdPanjar(){ 
	jfloading("sub_konten");
	$.get("trans_/verifnpdpanjar/datanpdpanjar.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function viewdetail(nonpdpanjar){ 
	$.fancybox({
		'href'			:'trans_/verifnpdpanjar/gridrinci.php?nonpdpanjar='+nonpdpanjar,
		'opacity'		: true,
		'autoSize'   	: true,
		'closeBtn'	    : true,
		'type'			: 'ajax',
		'z-index'		: '-1',
	}); 
}

function kunci(nonpdpanjar){
	jfloading("sub_konten");
	$.get("trans_/verifnpdpanjar/kunci.php",{nonpdpanjar:nonpdpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					dataverifnpdPanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nonpdpanjar){
	jfloading("sub_konten");
	$.get("trans_/verifnpdpanjar/bukakunci.php",{nonpdpanjar:nonpdpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "KUNCI SUDAH DIBUKA...", "success");
					npdpanjarterverif();	
				}else{
					swal("Gagal..!!!", result, "error");
					npdpanjarterverif();
				}
			}
		}
	);
}


function npdpanjarterverif(){ 
	jfloading("sub_konten");
	$.get("trans_/verifnpdpanjar/datanpdpanjarterverif.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}



