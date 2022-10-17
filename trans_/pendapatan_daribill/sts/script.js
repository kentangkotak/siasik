function datastsbelumterverif(){
	jfloading("sub_konten");
	$.get("trans_/pendapatan_daribill/sts/datastsbelumterverif.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function datastssudahterverif(){
	jfloading("sub_konten");
	$.get("trans_/pendapatan_daribill/sts/datastssudahterverif.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function verif(notrans){  
	swal({
	  title: "PERINGATAN",
	  text: "Apakah Anda Yakin Akan Memverif Data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Ya, VERIF ini!",
	  cancelButtonText: "Tidak!",
	  closeOnConfirm: false
	}, function (dismiss) { 
			if(dismiss==true){
				$.get("trans_/pendapatan_daribill/sts/verifikasi.php",{notrans:notrans},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERVERIF...", "success");
								datastsbelumterverif();
							}else{
								//alert(result);
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function batalverif(notrans){  
	swal({
	  title: "PERINGATAN",
	  text: "Apakah Anda Yakin Akan Membatalkan Verif Data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Ya, Batal ini!",
	  cancelButtonText: "Tidak!",
	  closeOnConfirm: false
	}, function (dismissx) { 
			if(dismissx==true){
				$.get("trans_/pendapatan_daribill/sts/batalverifikasi.php",{notrans:notrans},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERVERIF...", "success");
								datastssudahterverif();
							}else{
								//alert(result);
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

