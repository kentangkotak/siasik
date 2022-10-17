function formsppup(nosppup){ 
	jfloading("sub_konten");
	$.get("trans_/panjar/spp/formsppup.php",
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			$( '#jumlahspp' ).mask('000,000,000,000.00', {reverse: true});
			gridrinci(nosppup);
		}
	);
}

function fungsikomplet(){  
	$("#bendaharapengeluaran").autocomplete({
		serviceUrl:'trans_/panjar/spp/autobybendahara.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#nip').val(suggestion.nip);		
				document.form.jumlahspp.focus();
		    }
	});
	$("#namabank").autocomplete({
		serviceUrl:'trans_/panjar/spp/autobynamabank.php',
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
	
	// nonpdpanjar=document.form_rinci.nonpd.value; 
	// tglnpdpanjar=document.form_rinci.tglnpd.value;
	// triwulan=document.form_rinci.triwulan.value;
	// kodepptk=document.form_rinci.kodepptk.value;
	// pptk=document.form_rinci.pptk.value;  
	// program=document.form_rinci.program.value;
	// kegiatan=document.form_rinci.kegiatan.value;
	// kodekegiatanblud=document.form_rinci.kodekegiatanblud.value;
	// kegiatanblud=document.form_rinci.kegiatanblud.value;
	// total=document.form_rinci.totalnpd.value; 
	
	if(bendaharapengeluaran == ''){
		swal("Gagal..!!!",'BENDAHARA PENGELUARAN TIDAK BOLEH KOSONG...!!!', "error");
	}else if(namabank == ''){
		swal("Gagal..!!!",'NAMA BANK TIDAK BOLEH KOSONG...!!!', "error");
	}else if(norekening == ''){
		swal("Gagal..!!!",'NO REKENING TIDAK BOLEH KOSONG...!!!', "error");
	// }else if(nonpdpanjar == ''){
		// swal("Gagal..!!!",'NO NPD TIDAK BOLEH KOSONG...!!!', "error");
	}else{
		//clear();
		//mati();
		$.get('trans_/panjar/spp/simpansppup.php',{nosppup:nosppup,tgltrans:tgltrans,bendaharapengeluaran:bendaharapengeluaran,nip:nip,jumlahspp:jumlahspp,
		namabank:namabank,norekening:norekening,uraian:uraian
		//nonpdpanjar:nonpdpanjar,
		// tglnpdpanjar:tglnpdpanjar,
		// triwulan:triwulan,
		// kodepptk:kodepptk,
		// pptk:pptk,  
		// program:program,
		// kegiatan:kegiatan,
		// kodekegiatanblud:kodekegiatanblud,
		// kegiatanblud:kegiatanblud,
		// total:total
		},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.formsppup.nosppup.value=update[1];
						document.formsppup.jumlahspp.value=update[2];
						//gridrinci(update[1]);
						datasppup();
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
	$.get("trans_/panjar/spp/datasppup.php",
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
		window.open('trans_/panjar/spp/cetaksppup.php?x='+x,'','height=700,width=800,scrollbars=yes,resizable=yes');
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
					$.get("trans_/panjar/spp/kunci.php",{x:x},
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

function carinpd(){
	$.fancybox({
		'href'			:'trans_/panjar/spp/carinpd.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihnpd(nonpdpanjar,tglnpdpanjar,triwulan,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud,total){ 
	
	document.form_rinci.nonpd.value=nonpdpanjar; 
	document.form_rinci.tglnpd.value=tglnpdpanjar;
	document.form_rinci.triwulan.value=triwulan;
	document.form_rinci.kodepptk.value=kodepptk;
	document.form_rinci.pptk.value=pptk;  
	document.form_rinci.program.value=program;
	document.form_rinci.kegiatan.value=kegiatan;
	document.form_rinci.kodekegiatanblud.value=kodekegiatanblud;
	document.form_rinci.kegiatanblud.value=kegiatanblud;
	document.form_rinci.totalnpd.value=total; 
	
	$.fancybox.close();
}

function gridrinci(nosppup){ 
	jfloading("grid_nilai");
	$.get("trans_/panjar/spp/gridrinci.php",{nosppup:nosppup},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function clear(){
	document.form_rinci.nonpd.value=''; 
	document.form_rinci.tglnpd.value='';
	document.form_rinci.triwulan.value='';
	document.form_rinci.kodepptk.value='';
	document.form_rinci.pptk.value='';  
	document.form_rinci.program.value='';
	document.form_rinci.kegiatan.value='';
	document.form_rinci.kodekegiatanblud.value='';
	document.form_rinci.kegiatanblud.value='';
	document.form_rinci.totalnpd.value=''; 
}

function mati(){
	document.formsppup.tgltrans.disabled=true;
	document.formsppup.namabank.disabled=true;
	document.formsppup.uraian.disabled=true;
}
