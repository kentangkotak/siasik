function formmapingpptkkegiatan(id){ 
	jfloading("sub_konten");
	$.get("master_folder/mappingpptkkegiatan/form.php",{id:id},
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			fungsikomplet();
			if(id != undefined){
				document.form.kegiatan.disabled=true;
			}
		}
	);
}

function fungsikomplet(){  
	$("#namapptk").autocomplete({
		serviceUrl:'master_folder/mappingpptkkegiatan/autobypptk.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kodepptk').val(suggestion.nip);
				$('#namapptk').val(suggestion.nama);
				$('#kodebidang').val(suggestion.kodebagian);
				$('#bidang').val(suggestion.bagian);
				$('#alias').val(suggestion.alias);
		    }

	});
	$("#kegiatan").autocomplete({
		serviceUrl:'master_folder/mappingpptkkegiatan/autobykodekegiatanblud.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kodekegiatan').val(suggestion.kode);
				$('#kegiatan').val(suggestion.nomenklatur);
		    }

	});
}

function datamapingpptkkegiatan(){  
	jfloading("sub_konten");
	$.get("master_folder/mappingpptkkegiatan/datamapingpptkkegiatan.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			jfdata_table(); 
		}
	);
}

function simpanmappingpptkkegiatan(){ 

	kodepptk=document.form.kodepptk.value;
	namapptk=document.form.namapptk.value;
	kodekegiatan=document.form.kodekegiatan.value;
	kegiatan=document.form.kegiatan.value;
	kodebidang=document.form.kodebidang.value;
	bidang=document.form.bidang.value;
	x=document.form.x.value;
	alias=document.form.alias.value;
			
	if(kodepptk==''){
		swal("Gagal..!!!", "PPTK HARSU DIISI...!!!/BELUM TERDAFTAR!!!", "error");
	}else if(kodekegiatan==''){
		swal("Gagal..!!!", "KODEKEGIATAN HARUS DIISI..!!!/BELUM TERDAFTAR....!!!", "error");
	}else{
		$.get("master_folder/mappingpptkkegiatan/simpanmappingpptkkegiatan.php",{kodepptk:kodepptk,namapptk:namapptk,kodekegiatan:kodekegiatan,kegiatan:kegiatan,kodebidang:kodebidang,bidang:bidang,x:x,alias:alias},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
					formmapingpptkkegiatan();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		});
	}  
}

function hapusmappingpptkkegiatan(id){
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
			$.get("master_folder/mappingpptkkegiatan/hapusmappingpptkkegiatan.php",{id:id},
				function(result){ 
					if(result=="OK|"){
	  					swal("TERHAPUS!", "Data Sudah Terhapus", "success");
						datamappingpptkkegiatan();
					}else{
						swal("GAGAL", result, "error");
					}
				}
			);
		}
	});
}