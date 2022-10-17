function formsp3b(){
	jfloading("sub_konten");
	$.get("trans_/penatausahaan/msp3b/formsp3b.php",
		function(result){
			$("#sub_konten").html(result);
			$('#tanggal').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$('#bulantahun').datetimepicker({
				format: 'MM/YYYY'
			});
			$( '#jumlah' ).mask('000,000,000,000.00', {reverse: true});
			//grid_sp3b(); 
			// if(nonpk != undefined){
				// document.form.tglnpk.disabled=true;
			// }
		}
	);
}

function grid_sp3b(bulandantahun){ 
	jfloading("grid_sp3b");
	$.get("trans_/penatausahaan/msp3b/grid_sp3b.php",{bulandantahun:bulandantahun},
		function(result){ 
			$("#grid_sp3b").html(result); 
			jfdata_table(); 
		}
	);
}


function simpansp3b(){
	nomor=document.form.nomor.value; 
	tanggal=document.form.tanggal.value;
	bulantahun=document.form.bulantahun.value; 
	
	if(tanggal==''){
		swal("Gagal..!!!", "TANGGAL INPUT TIDAK BOLEH KOSONG....!!!", "error");
	}else if(bulantahun==''){
		swal("Gagal..!!!", "BULAN REALISASI TIDAK BOLEH KOSONG BOLEH KOSONG....!!!", "error");
	}else{
		//clearrinci(); 
		$.get('trans_/penatausahaan/msp3b/simpansp3b.php',{nomor:nomor, 
				tanggal:tanggal, 
				bulantahun:bulantahun},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						grid_sp3b(update[1]); 
						nomorx=update[2];
						document.form.nomor.value=nomorx;
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function datasp3b(){
	jfloading("sub_konten");
	$.get("trans_/penatausahaan/msp3b/datasp3b.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function kunci(nosp3b){
	jfloading("sub_konten");
	$.get("trans_/penatausahaan/msp3b/kunci.php",{nosp3b:nosp3b},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datasp3b();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function cetaksp3b(nosp3b){ 
	if(nosp3b==""){
		swal("Gagal..!!!", "APA YANG AKAN ANDA CETAK...???", "error");
	}else{
		window.open('trans_/penatausahaan/msp3b/cetaksp3b.php?nosp3b='+nosp3b,'','height=700,width=800,scrollbars=yes,resizable=yes');
	}
}