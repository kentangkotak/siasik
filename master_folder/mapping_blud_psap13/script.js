function data_akun_blud(){  
	jfloading("sub_konten");
	$.get("master_folder/mapping_blud_psap13/akunblud.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			jfdata_table(); 
		}
	);
}


function tingkat2(akun){ 
	jfloading("sub_konten");
	$.get("master_folder/mapping_blud_psap13/akunblud2.php",{akun:akun},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat3(akun,kelompok){
	jfloading("sub_konten");
	$.get("master_folder/mapping_blud_psap13/akunblud3.php",{akun:akun,kelompok:kelompok},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat4(akun,kelompok,jenis){
	jfloading("sub_konten");
	$.get("master_folder/mapping_blud_psap13/akunblud4.php",{akun:akun,kelompok:kelompok,jenis:jenis},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat5(akun,kelompok,jenis,objectx){
	jfloading("sub_konten");
	$.get("master_folder/mapping_blud_psap13/akunblud5.php",{akun:akun,kelompok:kelompok,jenis:jenis,objectx:objectx},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat6(akun,kelompok,jenis,objectx,rincian){
	jfloading("sub_konten");
	$.get("master_folder/mapping_blud_psap13/akunblud6.php",{akun:akun,kelompok:kelompok,jenis:jenis,objectx:objectx,rincian:rincian},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat7(akun,kelompok,jenis,objectx,rincian,subrincian){
	jfloading("sub_konten");
	$.get("master_folder/mapping_blud_psap13/akunblud7.php",{akun:akun,kelompok:kelompok,jenis:jenis,objectx:objectx,rincian:rincian,subrincian:subrincian},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function simpan_mapping(){ 
	akun=document.form.akun.value;
	kelompok=document.form.kelompok.value;
	jenis=document.form.jenis.value;
	objectx=document.form.objectx.value;
	rincian=document.form.rincian.value;
	subrincian=document.form.subrincian.value;
	kode_791=document.form.kode_791.value;
	kode_792=document.form.kode_792.value;
	kode_793=document.form.kode_793.value;
	uraian_79=document.form.uraian_79.value;
	
	if(kode_791==''){
		swal("Peringatan", "Tentukan uraian permendagri 79", "warning");
	}
	else{
		get_param = {
			akun:akun,
			kelompok:kelompok,
			jenis:jenis,
			objectx:objectx,
			rincian:rincian,
			subrincian:subrincian,
			kode_791:kode_791,
			kode_792:kode_792,
			kode_792:kode_792,
			uraian_79:uraian_79
		};
		//alert(JSON.stringify(get_param));
		$.get("master_folder/mapping_blud_psap13/simpan_mapping.php",get_param,
		function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
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

function mapping(akun,kelompok,jenis,objectx,rincian,subrincian){
	jfloading("sub_konten");
	$.get("master_folder/mapping_blud_psap13/mapping.php",{akun:akun,kelompok:kelompok,jenis:jenis,objectx:objectx,rincian:rincian,subrincian:subrincian},
		function(result){ 
			$("#sub_konten").html(result);
			ac_uraian79(); 
		}
	);
}

function ac_uraian79(){
	$("#uraian_79").autocomplete({
		serviceUrl:'master_folder/mapping_blud_psap13/ac_79.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kode_791').val(suggestion.kode1);
				$('#kode_792').val(suggestion.kode2);
				$('#kode_793').val(suggestion.kode3);
				$('#uraian_79').val(suggestion.value);
		    }

	});
}

function reset_mapping(){
	akun=document.form.akun.value;
	kelompok=document.form.kelompok.value;
	jenis=document.form.jenis.value;
	objectx=document.form.objectx.value;
	rincian=document.form.rincian.value;
	subrincian=document.form.subrincian.value;
	kode_791='';
	kode_792='';
	kode_793='';
	uraian_79='';
	
	get_param = {
		akun:akun,
		kelompok:kelompok,
		jenis:jenis,
		objectx:objectx,
		rincian:rincian,
		subrincian:subrincian,
		kode_791:kode_791,
		kode_792:kode_792,
		kode_792:kode_792,
		uraian_79:uraian_79
	};
	//alert(JSON.stringify(get_param));
	$.get("master_folder/mapping_blud_psap13/simpan_mapping.php",get_param,
	function(result){ 
		var update = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) { 
			if(update[0]=="OK"){  
				swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
			}else{
				swal("Gagal..!!!", result, "error");
			}
		}
	});
}