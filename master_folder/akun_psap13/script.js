function forms(kode){  alert();
/* 	jfloading("sub_konten");
	$.get("master_folder/akun_psap13/form.php",
		{
			kode:kode
		},
		function(result){
			$("#sub_konten").html(result);
			$('.select2').select2();
		}
	); */
}

function list(){
	jfloading("sub_konten");
	$.get("master_folder/akun_psap13/list.php",
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function simpan(){  
	no=document.form.no.value;
	nomenklatur=document.form.nomenklatur.value;
	prioritas=document.form.prioritas.value;
	_organisasi=document.form._organisasi.value.split('|');
	organisasi_nama=_organisasi[0];
	organisasi_kode1=_organisasi[1];
	organisasi_kode2=_organisasi[2];
	organisasi_kode3=_organisasi[3];
		
	if(nomenklatur==''){
		swal("Gagal", "Maaf, nama organisasi kosong.", "success");
	}else{
		$.get("master_folder/akun_psap13/simpan.php",
		{
			no:no,
			nomenklatur:nomenklatur,
			prioritas:prioritas,
			organisasi_kode1:organisasi_kode1,
			organisasi_kode2:organisasi_kode2,
			organisasi_kode3:organisasi_kode3,
			organisasi_nama:organisasi_nama
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
			$.get("master_folder/akun_psap13/hapus.php",{id:id},
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
	$.get("master_folder/akun_psap13/list_kode2.php",
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
	$.get("master_folder/akun_psap13/list_kode3.php",
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
	$.get("master_folder/akun_psap13/list_kode4.php",
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
	$.get("master_folder/akun_psap13/list_kode5.php",
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
	$.get("master_folder/akun_psap13/list_kode6.php",
		{
			kode5:kode5
		},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}