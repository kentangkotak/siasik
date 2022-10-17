function formpptk(){  
	jfloading("sub_konten");
	$.get("master_folder/pptk/form.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
		}
	);
}

function dataLog(){  
	jfloading("sub_konten");
	$.get("setting/loging/dataLog.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			jfdata_table(); 
		}
	);
}

function simpanpptk(){ 

	nip=document.form.nip.value;
	nama=document.form.nama.value;
	organisasi=document.form.organisasi.value;
			
	if(nip==''){
		swal("Gagal..!!!", "NIP Harus Diisi..!!!", "error");
	}else if(nama==''){
		swal("Gagal..!!!", "NAMA Harus Diisi..!!!", "error");
	}else if(organisasi==''){
		swal("Gagal..!!!", "Organisasi Harus Diisi..!!!", "error");
	}else{
		$.get("master_folder/pptk/simpanpptk.php",{nip:nip,nama:nama,organisasi:organisasi},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
					formpptk();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		});
	}  
}

function hapuspptk(id){
	swal({
	  title: "PERINGATAN",
	  text: "Apakah Anda Yakin Akan Menghapus Data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Ya, hapus ini!",
	  cancelButtonText: "Tidak!",
	  closeOnConfirm: false
	},
	function(isConfirm){
		if(isConfirm==true){
			$.get("master_folder/pptk/hapuspptk.php",{id:id},
				function(result){ 
					if(result=="OK|"){
	  					swal("TERHAPUS!", "Data Sudah Terhapus", "success");
						datapptk();
					}else{
						swal("GAGAL", result, "error");
					}
				}
			);
		}
	});
}