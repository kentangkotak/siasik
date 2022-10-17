function data_belum_terverif(){ 
	jfloading("sub_konten");
	$.get("trans_/verif_pergeseran_kas/data_belum_terverif.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}


function verif(notrans){
	jfloading("sub_konten");
	$.get("trans_/verif_pergeseran_kas/kunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERVERIF...", "success");
					data_belum_terverif();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukaverif(notrans){
	jfloading("sub_konten");
	$.get("trans_/verif_pergeseran_kas/bukakunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "KUNCI SUDAH DIBUKA...", "success");
					data_sudah_terverif();	
				}else{
					swal("Gagal..!!!", result, "error");
					data_sudah_terverif();
				}
			}
		}
	);
}

function data_sudah_terverif(){ 
	jfloading("sub_konten");
	$.get("trans_/verif_pergeseran_kas/data_sudah_terverif.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}