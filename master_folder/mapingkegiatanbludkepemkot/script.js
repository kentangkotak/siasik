function formmapping(){  
	jfloading("sub_konten");
	$.get("master_folder/mapingkegiatanbludkepemkot/formmapping.php",
		function(result){ 
			$("#sub_konten").html(result);
			fungsikomplet();
		}
	);
}

function fungsikomplet(){  
	$("#kodekegiatan").autocomplete({
		serviceUrl:'master_folder/mapingkegiatanbludkepemkot/autobykodekegiatan.php',
		type: "GET",
		    onSelect: function (suggestion) {
				$('#kodekegiatan').val(suggestion.rekapkode);
				$('#nomenklaturlevel5').val(suggestion.uraian);
				$('#level1').val(suggestion.level1);
				$('#level2').val(suggestion.level2);
				$('#level3').val(suggestion.level3);
				$('#level4').val(suggestion.level4);
				$('#level5').val(suggestion.level5);
		    }		    
	});
	$("#nomenklaturlevel5").autocomplete({
		serviceUrl:'master_folder/mapingkegiatanbludkepemkot/autobynomenklatur.php',
		type: "GET",
		    onSelect: function (suggestion) {
				$('#kodekegiatan').val(suggestion.rekapkode);
				$('#nomenklaturlevel5').val(suggestion.uraian);
				$('#level1').val(suggestion.level1);
				$('#level2').val(suggestion.level2);
				$('#level3').val(suggestion.level3);
				$('#level4').val(suggestion.level4);
				$('#level5').val(suggestion.level5);
		    }		    
	});
	$("#nomenklaturblud").autocomplete({
		serviceUrl:'master_folder/mapingkegiatanbludkepemkot/autobynomenklaturblud.php',
		type: "GET",
		    onSelect: function (suggestion) {
				$('#nomenklaturblud').val(suggestion.nomenklatur);
				$('#bidang').val(suggestion.bidang);
				$('#organisasilama').val(suggestion.organisasilama);
		    }		    
	});$("#uraian_79").autocomplete({
		serviceUrl:'master_folder/mapping_blud_79/ac_79.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kode_791').val(suggestion.kode1);
				$('#kode_792').val(suggestion.kode2);
				$('#kode_793').val(suggestion.kode3);
				$('#uraian_79').val(suggestion.value);
		    }

	});
	
}

function datamapping(){  
	jfloading("sub_konten");
	$.get("master_folder/mapingkegiatanbludkepemkot/list.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			jfdata_table(); 
		}
	);
}

function simpanmapingpermen50keblud(){ 

	level1=document.form.level1.value;
	level2=document.form.level2.value;
	level3=document.form.level3.value;
	level4=document.form.level4.value;
	level5=document.form.level5.value;
	rekapkode=document.form.kodekegiatan.value;
	organisasilama=document.form.organisasilama.value;
	bidang=document.form.bidang.value;
	kodekegiatan=document.form.kodekegiatan.value;
	nomenklaturlevel5=document.form.nomenklaturlevel5.value;
	nomenklaturblud=document.form.nomenklaturblud.value;
		
	if(kodekegiatan==''){
		swal("Gagal..!!!", "KODE KEGIATAN Harus Diisi..!!!", "error");
	}else if(nomenklaturlevel5==''){
		swal("Gagal..!!!", "NOMEN KLATUR Harus Diisi..!!!", "error");
	}else if(nomenklaturblud==''){
		swal("Gagal..!!!", "NOMEN KLATUR BLUD Harus Diisi..!!!", "error");
	}else{
		$.get("master_folder/mapingkegiatanbludkepemkot/simpanmapingkegiatanbludkepemkot.php",{level1:level1,level2:level2,level3:level3,level4:level4,
		level5:level5,rekapkode:rekapkode,organisasilama:organisasilama,bidang:bidang,kodekegiatan:kodekegiatan,nomenklaturlevel5:nomenklaturlevel5,nomenklaturblud:nomenklaturblud},function(result){
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