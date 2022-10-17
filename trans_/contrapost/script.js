function datanpd(x){
	jfloading("sub_konten");
	//nominal=$("#nominal_"+x).val();
	$.get("trans_/contrapost/datanpd.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
			$( '#nominal_'+x ).mask('000,000,000,000.00', {reverse: true});
		}
	);
}

function datacontrapost(){
	jfloading("sub_konten");
	$.get("trans_/contrapost/datacontrapost.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formnpdcontra(nonpd,jenis){ 
	jfloading("sub_konten");
	$.get("trans_/contrapost/formnpd.php",{nonpd:nonpd,jenis:jenis},
		function(result){
			$("#sub_konten").html(result);
			gridrinci(nonpd);
		}
	);
}

async function gridrinci(nonpd){ 
	jfloading("grid_nilai");
	await $.get("trans_/contrapost/gridrinci.php",{nonpd:nonpd},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function simpancontrapost(koderek50,rincianbelanja,itembelanja,x,idpp){ 
    nominal=$("#nominal_"+x).val(); 
	
	nonpd=document.form.nonpd.value;
	jenis=document.form.jenis.value;
	tglcontrapost=document.form.tglcontrapost.value;
	if(nonpd==''){
		swal("Gagal..!!!", "NO. NPD TIDAK BOLEH KOSONG...!!!", "error");
	}else if(jenis==""){
		swal("Gagal..!!!", "JENIS TIDAK BOLEH KOSONG...!!!", "error");
	}else if(nominal==""){
		swal("Gagal..!!!", "NOMINAL NPD TIDAK BOLEH KOSONG...!!!", "error");
	}else{
		$.get('trans_/contrapost/simpan.php',{nonpd:nonpd,jenis:jenis,nominal:nominal,koderek50:koderek50,idpp:idpp,tglcontrapost:tglcontrapost},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						// document.form.nonpd.value=update[1];
						// gridrinci(update[1]);
						// document.getElementById('lokasilaka_content').style.visibility='hidden';
						// mati();
						//clearrincix();
						//nopdx=update[1];
						//$.get("trans_/npdls/getjumlahnpdls.php",{nonpdls:nopdx},function(result){
							//$("#contentPagu").html(result);
						//});
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);
	}
}

function hapusHeader(id){  
	swal({
	  title: "PERINGATAN",
	  text: "Apakah Anda Yakin Akan Menghapus Data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Ya, hapus ini!",
	  cancelButtonText: "Tidak!",
	  closeOnConfirm: false
	}, function (dismiss) {
			if(dismiss==true){
				$.get("trans_/contrapost/hapus_heder.php",{id:id},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								datacontrapost();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function kunci(id){
	jfloading("sub_konten");
	$.get("trans_/contrapost/kunci.php",{id:id},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datacontrapost();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

