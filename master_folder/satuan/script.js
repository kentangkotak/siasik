function formSatuan(){  
	jfloading("sub_konten");
	$.get("master_folder/satuan/formSatuan.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
		}
	);
}

function listSatuan(){  
	jfloading("sub_konten");
	$.get("master_folder/satuan/listSatuan.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			jfdata_table(); 
		}
	);
}

function simpanSatuan(){  
	satuan=document.form.satuan.value;
		
	if(satuan==''){
		swal("Gagal..!!!", "SATUAN Harus Diisi..!!!", "error");
	}else{
		$.get("master_folder/satuan/simpanSatuan.php",{satuan:satuan},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
					//gridpeserta(notrans);	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		});
	}  
}

function hapusbagian(id){
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
			$.get("master_folder/bagian/hapusbagian.php",{id:id},
				function(result){ 
					if(result=="OK"){
	  					swal("TERHAPUS!", "Data Sudah Terhapus", "success");
						listbagian();
					}else{
						swal("GAGAL", result, "error");
					}
				}
			);
		}
	});
}