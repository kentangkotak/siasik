function forminputsilpa(){
	jfloading("sub_konten");
	$.get("trans_/perubahan/silpa/formsilpa.php",
		function(result){
			$("#sub_konten").html(result);
			$('#tgl').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$('#thnsilpa').datetimepicker({
				format: 'YYYY'
			});
			$( '#nominal' ).mask('000,000,000,000.00', {reverse: true});
			gridrinci();
		}
	);
}

function gridrinci(){
	jfloading("grid_nilai");
	$.get("trans_/perubahan/silpa/gridrinci.php",
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function simpansilpa(){ 
    
	notrans=document.form.notrans.value; 
	tgl=document.form.tgl.value;
	thnsilpa=document.form.thnsilpa.value;
	nominal=document.form.nominal.value;

	if(tgl==''){
		swal("Gagal..!!!", "TANGGAL TIDAK BOLEH KOSONG....!!!", "error");
	}else if(thnsilpa==''){
		swal("Gagal..!!!", "TAHUN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nominal==''){
		swal("Gagal..!!!", "NOMINAL TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		//clearrinci();
		forminputsilpa();		
		$.get('trans_/perubahan/silpa/simpan.php',{notrans:notrans, 
				tgl:tgl, 
				thnsilpa:thnsilpa, 
				nominal:nominal},
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
			}
		);  
	}
}


function kunci(notrans){
	if(notrans == ''){
		swal("Gagal..!!!", "NO TRANSAKSI TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		$.get('trans_/perubahan/silpa/verif.php',{notrans:notrans},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH TERVERIF...", "success");
						gridrinci();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function edit(notrans,tanggal,tahun,nominal){ 
	document.form.notrans.value=notrans;
	document.form.tgl.value=tanggal;
	document.form.thnsilpa.value=tahun;
	document.form.nominal.value=nominal;
	
}