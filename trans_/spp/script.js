function formsppup(){ 
	jfloading("sub_konten");
	$.get("trans_/spp/formsppup.php",
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			$( '#jumlahspp' ).mask('000,000,000,000.00', {reverse: true});
		}
	);
}

function fungsikomplet(){  
	$("#bendaharapengeluaran").autocomplete({
		serviceUrl:'trans_/spp/autobybendahara.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#nip').val(suggestion.nip);		
				document.form.jumlahspp.focus();
		    }
	});
	$("#namabank").autocomplete({
		serviceUrl:'trans_/spp/autobynamabank.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#norekening').val(suggestion.kodeRek);
				$('#namabank').val(suggestion.namabank);
		    }
			
	});
}

function simpansppup(){
	nosppup=document.formsppup.nosppup.value;
	tgltrans=document.formsppup.tgltrans.value;
	nip=document.formsppup.nip.value;
	bendaharapengeluaran=document.formsppup.bendaharapengeluaran.value;
	jumlahspp=document.formsppup.jumlahspp.value;
	namabank=document.formsppup.namabank.value;
	norekening=document.formsppup.norekening.value;
	uraian=document.formsppup.uraian.value;
	
	if(bendaharapengeluaran == ''){
		swal("Gagal..!!!",'BENDAHARA PENGELUARAN TIDAK BOLEH KOSONG...!!!', "error");
	}else if(jumlahspp == ''){
		swal("Gagal..!!!",'BENDAHARA PENGELUARAN TIDAK BOLEH KOSONG...!!!', "error");
	}else if(namabank == ''){
		swal("Gagal..!!!",'NAMA BANK TIDAK BOLEH KOSONG...!!!', "error");
	}else if(norekening == ''){
		swal("Gagal..!!!",'NO REKENING TIDAK BOLEH KOSONG...!!!', "error");
	}else{
		$.get('trans_/spp/simpansppup.php',{nosppup:nosppup,tgltrans:tgltrans,bendaharapengeluaran:bendaharapengeluaran,nip:nip,jumlahspp:jumlahspp,
		namabank:namabank,norekening:norekening,uraian:uraian},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.formsppup.nosppup.value=update[1];
						formsppup();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);
	}
}

function datasppup(){
	jfloading("sub_konten");
	$.get("trans_/spp/datasppup.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function cetaksppup(x){
	
	if(x==""){
		swal("Gagal..!!!", "APA YANG AKAN ANDA CETAK...???", "error");
	}else{
		window.open('trans_/spp/cetaksppup.php?x='+x,'','height=700,width=800,scrollbars=yes,resizable=yes');
	}
}

function key(x){
		swal({
		  title: "APAKAH ANDA AKAN MENGKUNCI & MENGIRIM TRANSAKSI INI...?",
		  text: "TEKAN OK JIKA IYA",
		  type: "info",
		  showCancelButton: true,
		  closeOnConfirm: true,
		  showLoaderOnConfirm: true
		}, function (dismiss) { 
				if(dismiss==true){
					$.get("trans_/spp/kunci.php",{x:x},
						function(result){ 
							if(result=="OK"){
		 						 setTimeout(function () {
								 	swal("TRANSAKSI SUDAH TERKUNCI!");
								 	datasppup();
								 },0);
							}else{
								swal(result);
							}
						});
				}
		});
}
