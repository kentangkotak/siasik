function list(){
	jfloading("sub_konten");
	$.get("master_folder/akun_permendagri79/list.php",
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function simpan(){  
	kode_induk=document.form.kode_induk.value;
	kode=document.form.kode.value;
	uraian=document.form.uraian.value;
		
	if(kode==''){
		swal("Gagal", "Maaf, Kode kosong.", "warning");
	}else if(uraian==''){
		swal("Gagal", "Maaf, uraian kosong.", "warning");
	}else{
		$.get("master_folder/akun_permendagri79/simpan.php",
		{
			kode_induk:kode_induk,
			kode:kode,
			uraian:uraian
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
			$.get("master_folder/akun_permendagri79/hapus.php",{id:id},
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

function list_kode2(kode1){
	jfloading("sub_konten");
	$.get("master_folder/akun_permendagri79/list_kode2.php",
		{
			kode1:kode1
		},
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function list_kode3(kode2){
	jfloading("sub_konten");
	$.get("master_folder/akun_permendagri79/list_kode3.php",
		{
			kode2:kode2
		},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}


function list_kode4(kode3){
	jfloading("sub_konten");
	$.get("master_folder/akun_permendagri79/list_kode4.php",
		{
			kode3:kode3
		},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function list_kode5(kode4){
	jfloading("sub_konten");
	$.get("master_folder/akun_permendagri79/list_kode5.php",
		{
			kode4:kode4
		},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function list_kode6(kode5){
	jfloading("sub_konten");
	$.get("master_folder/akun_permendagri79/list_kode6.php",
		{
			kode5:kode5
		},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function _form(kode){
	jfloading("sub_konten");
	$.get("master_folder/akun_permendagri79/form.php",
		{
			kode:kode
		},
		function(result){
			$("#sub_konten").html(result);
			$('.select2').select2();
		}
	);
}