function form(){  
	jfloading("sub_konten");
	$.get("master_folder/organisasi/form.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
		}
	);
}

function list(){  
	jfloading("sub_konten");
	$.get("master_folder/organisasi/list.php",
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function simpan(){  
	kode1=document.form.kode1.value;
	kode2=document.form.kode2.value;
	kode3=document.form.kode3.value;
	kode4=document.form.kode4.value;
	nama=document.form.nama.value; 
		
	if(nama==''){
		swal("Gagal", "Maaf, nama organisasi kosong.", "success");
	}else{
		$.get("master_folder/organisasi/simpan.php",
		{
			kode1:kode1,
			kode2:kode2,
			kode3:kode3,
			kode4:kode4,
			nama:nama
		},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "Data telah tersimpan", "success");
					//gridpeserta(notrans);	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		});
	}  
}

function hapus(id){
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
			$.get("master_folder/organisasi/hapus.php",{id:id},
				function(result){ 
					if(result=="OK"){
	  					swal("TERHAPUS!", "Data Sudah Terhapus", "success");
						list();
					}else{
						swal("GAGAL", result, "error");
					}
				}
			);
		}
	});
}