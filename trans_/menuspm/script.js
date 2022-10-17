function dataspp_spp_ter(){
	jfloading("sub_konten");
	$.get("trans_/menuspm/dataspp_spp_ter.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formCreateSpm(nosppup){ 
	jfloading("sub_konten");
	$.get("trans_/menuspm/formCreateSpm.php",{nosppup:nosppup},
		function(result){
			$("#sub_konten").html(result);
			$( '#jumlahspp' ).mask('000,000,000,000.00', {reverse: true});
		}
	);
}

function createSpm(){ 
	nosppup=document.formsppup.nosppup.value;
	tgltrans=document.formsppup.tgltrans.value;
	nip=document.formsppup.nip.value;
	bendaharapengeluaran=document.formsppup.bendaharapengeluaran.value;
	jumlahspp=document.formsppup.jumlahspp.value;
	namabank=document.formsppup.namabank.value;
	norekening=document.formsppup.norekening.value;
	uraian=document.formsppup.uraian.value;  
	
	nospm=document.form_spm.nomorspm.value; 
	tglspm=document.form_spm.tglspm.value;
	npwp=document.form_spm.npwp.value;
	uraianpekerjaan=document.form_spm.uraianpekerjaan.value; 
	
	if(bendaharapengeluaran == ''){
		swal("Gagal..!!!",'BENDAHARA PENGELUARAN TIDAK BOLEH KOSONG...!!!', "error");
	}else if(jumlahspp == ''){
		swal("Gagal..!!!",'BENDAHARA PENGELUARAN TIDAK BOLEH KOSONG...!!!', "error");
	}else if(namabank == ''){
		swal("Gagal..!!!",'NAMA BANK TIDAK BOLEH KOSONG...!!!', "error");
	}else if(norekening == ''){
		swal("Gagal..!!!",'NO REKENING TIDAK BOLEH KOSONG...!!!', "error");
	}else{
		$.get('trans_/menuspm/simpanSpm.php',{nosppup:nosppup,tgltrans:tgltrans,bendaharapengeluaran:bendaharapengeluaran,nip:nip,jumlahspp:jumlahspp,
		namabank:namabank,norekening:norekening,uraian:uraian,nospm:nospm,tglspm:tglspm,npwp:npwp,uraianpekerjaan:uraianpekerjaan},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form_spm.nomorspm.value=update[1];
						dataSpm();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);
	}
}

function dataSpm(){
	jfloading("sub_konten");
	$.get("trans_/menuspm/dataSpm.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

