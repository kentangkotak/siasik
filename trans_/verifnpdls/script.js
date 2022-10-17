function gridrinci(nonpd){ 
	jfloading("grid_nilai");
	$.get("trans_/verifnpdls/gridrinci.php",{nonpd:nonpd},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function datanpdlsbelumterverif(){ 
	jfloading("sub_konten");
	$.get("trans_/verifnpdls/datanpdlsbelumterverif.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function viewdetail(nonpdls){ 
	$.fancybox({
		'href'			:'trans_/verifnpdls/gridrinci.php?nonpdls='+nonpdls,
		'opacity'		: true,
		'autoSize'   	: true,
		'closeBtn'	    : true,
		'type'			: 'ajax',
		'z-index'		: '-1',
	}); 
}

function kunci(nonpdls){
	jfloading("sub_konten");
	$.get("trans_/verifnpdls/kunci.php",{nonpdls:nonpdls},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanpdlsbelumterverif();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nonpdls){
	jfloading("sub_konten");
	$.get("trans_/verifnpdls/bukakunci.php",{nonpdls:nonpdls},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "KUNCI SUDAH DIBUKA...", "success");
					datanpdlssudahterverif();	
				}else{
					swal("Gagal..!!!", result, "error");
					datanpdlssudahterverif();
				}
			}
		}
	);
}


function datanpdlssudahterverif(){ 
	jfloading("sub_konten");
	$.get("trans_/verifnpdls/datanpdlssudahterverif.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}



