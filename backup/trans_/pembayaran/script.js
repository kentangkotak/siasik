function formpembayaran(){  
	jfloading("sub_konten");
	$.get("eks/pembayaran/form.php",
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet(notrans);
			//gridpeserta();
			$('.select2').select2();
		}
	);
}

function datapembayaran(){  
	jfloading("sub_konten");
	$.get("eks/pembayaran/datapembayaran.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}


function fungsikomplet(){  
	$("#koderekening").autocomplete({
		serviceUrl:'eks/pembayaran/autobykoderekening.php',
		type: "GET",
		    onSelect: function (suggestion) {
				$('#koderekening').val(suggestion.koderekening);
		    }
		    
	});
}

function gridpeserta(notrans){  
	jfloading("grid_nilai");
	$.get("eks/pembayaran/gridpeserta.php",{notrans:notrans},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function simpanbayar(){ 
    
	notrans=document.form.notrans.value;
	koderekening=document.form.koderekening.value;
	untukpembayaran=document.form.untukpembayaran.value;
	nominal=document.form.nominal.value;
	untuk=document.form.untuk.value;

	if(koderekening==''){
		swal("Gagal..!!!", "KODE REKENING HARUS DIISI..!!!", "error");
	}else if(untukpembayaran==''){
		swal("Gagal..!!!", "UNTUK PEMBAYARAN HARUS DIISI..!!!", "error");
	}else if(nominal==''){
		swal("Gagal..!!!", "NOMINAL HARUS DIISI..!!!", "error");
	}else if(untuk==''){
		swal("Gagal..!!!", "UNTUK HARUS DIISI..!!!", "error");
	}else{
		$.get('eks/pembayaran/simpan.php',{notrans:notrans,koderekening:koderekening,untukpembayaran:untukpembayaran,nominal:nominal,untuk:untuk},
			function(result){
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						clear();	
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);
	}
}

function clear(){
	document.form.notrans.value='';
	document.form.koderekening.value='';
	document.form.untukpembayaran.value='';
	document.form.nominal.value='';
	document.form.untuk.value='';
}

function cetakkwitansi(notrans){  
	q=confirm("APAKAH ANDA YAKIN UNTUK MEMBUAT KWITANSI TRANSAKSI INI...?");
	if(q==true){
		window.open("eks/pembayaran/kwitansiku.php?notrans="+notrans,"Kwitansi","height=700,width=700,scrollbars=yes,resizable=no").focus();
	}
}
