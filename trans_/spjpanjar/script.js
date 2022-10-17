function formspjpanjar(nospjpanjar){
	jfloading("sub_konten");
	$.get("trans_/spjpanjar/formspjpanjar.php",{nospjpanjar:nospjpanjar},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			gridrinci(nospjpanjar);
			gridpajak(nospjpanjar);
			$( '#jumlahbelanjapanjar' ).mask('000,000,000,000.00', {reverse: true});
			$( '#pph21' ).mask('000,000,000,000.00', {reverse: true});
			$( '#pph22' ).mask('000,000,000,000.00', {reverse: true});
			$( '#pph23' ).mask('000,000,000,000.00', {reverse: true});
			$( '#pph25' ).mask('000,000,000,000.00', {reverse: true});
			$( '#pasal4' ).mask('000,000,000,000.00', {reverse: true});
			$( '#ppnpusat' ).mask('000,000,000,000.00', {reverse: true});
			$( '#utangpajakdaerah' ).mask('000,000,000,000.00', {reverse: true});
			if(nospjpanjar != undefined){
				mati();
			};
			kodekegiatanblud=document.form.kodekegiatanblud.value;
			$("#rincianbelanja").autocomplete({
				serviceUrl:'trans_/spjpanjar/autobyrincianbelanja.php?kodekegiatanblud='+kodekegiatanblud,
				type: "GET",
					onSelect: function (suggestions) {
						$('#rincianbelanja').val(suggestions.rincianbelanja50);
						$('#koderek50').val(suggestions.koderek50);
						document.form_rinci.itembelanja.focus();
						
						$("#itembelanja").autocomplete({
							serviceUrl:'trans_/spjpanjar/autobyitembelanja.php?koderek50='+suggestions.koderek50+'&kodekegiatanblud='+kodekegiatanblud,
							type: "GET",
								onSelect: function (suggestions) {
									$('#itembelanja').val(suggestions.itembelanja);
									$('#volume').val(suggestions.volume);
									$('#satuan').val(suggestions.satuan);
									$('#harga').val(suggestions.harga);
									$('#nopp').val(suggestions.nopp);
									$('#nousulan').val(suggestions.nousulan);
									$('#jumlahanggaran').val(suggestions.total);
									$('#iditembelanjanpd').val(suggestions.id);
									$('#nonpdpanjar').val(suggestions.nonpdpanjar);
									document.form_rinci.jumlahbelanjapanjar.focus();
								}
								
						});
					}
			});
		}
	);
}

function fungsikomplet(){  
	$("#notapanjar").autocomplete({
		serviceUrl:'trans_/spjpanjar/autobynotapanjar.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#notapanjar').val(suggestion.nonotapanjar);
				$('#kodepptk').val(suggestion.kodepptk);
				$('#kodekegiatanblud').val(suggestion.kodekegiatanblud);
				$('#pptk').val(suggestion.pptk);
				$('#program').val(suggestion.program);
				$('#kegiatan').val(suggestion.kegiatan);
				$('#jumlahanggaran').val(suggestion.total);
				$('#kegiatanblud').val(suggestion.kegiatanblud);
				
				document.form.pihakketiga.focus();
				
				$("#rincianbelanja").autocomplete({
					serviceUrl:'trans_/spjpanjar/autobyrincianbelanja.php?kodekegiatanblud='+suggestion.kodekegiatanblud+'&nonotapanjar='+suggestion.nonotapanjar,
					type: "GET",
						onSelect: function (suggestions) {
							$('#rincianbelanja').val(suggestions.rincianbelanja50);
							$('#koderek50').val(suggestions.koderek50);
							document.form_rinci.itembelanja.focus();
							
							$("#itembelanja").autocomplete({
								serviceUrl:'trans_/spjpanjar/autobyitembelanja.php?koderek50='+suggestions.koderek50+'&kodekegiatanblud='+suggestion.kodekegiatanblud,
								type: "GET",
									onSelect: function (suggestions) {
										$('#itembelanja').val(suggestions.itembelanja);
										$('#volume').val(suggestions.volume);
										$('#satuan').val(suggestions.satuan);
										$('#harga').val(suggestions.harga);
										$('#nopp').val(suggestions.nopp);
										$('#nousulan').val(suggestions.nousulan);
										$('#jumlahpenerimaanpanjar').val(suggestions.total);
										$('#iditembelanjanpd').val(suggestions.id);
										$('#nonpdpanjar').val(suggestions.nonpdpanjar);
										document.form_rinci.jumlahbelanjapanjar.focus();
									}
									
							});
						}
				});
		    }
	});
	$("#pihakketiga").autocomplete({
		serviceUrl:'trans_/spjpanjar/autobypihakketiga.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#pihakketiga').val(suggestion.nama);
				$('#kodepihakketiga').val(suggestion.kode);
				document.form.keterangan.focus();
		    }
	});
}

function simpanspjpanjaar(){ 
    
	kodepptk=document.form.kodepptk.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	kodepihakketiga=document.form.kodepihakketiga.value;
	nospjpanjar=document.form.nospjpanjar.value;
	tglspjpanjar=document.form.tglspjpanjar.value;
	notapanjar=document.form.notapanjar.value;
	pptk=document.form.pptk.value;
	program=document.form.program.value;
	kegiatan=document.form.kegiatan.value;
	kegiatanblud=document.form.kegiatanblud.value;
	kodepihakketiga=document.form.kodepihakketiga.value;
	pihakketiga=document.form.pihakketiga.value;
	keterangan=document.form.keterangan.value; 

	koderek50=document.form_rinci.koderek50.value;
	rincianbelanja=document.form_rinci.rincianbelanja.value;
	itembelanja=document.form_rinci.itembelanja.value;
	iditembelanjanpd=document.form_rinci.iditembelanjanpd.value; 
	nopp=document.form_rinci.nopp.value; 
	nousulan=document.form_rinci.nousulan.value; 	
	volume=document.form_rinci.volume.value;
	satuan=document.form_rinci.satuan.value;
	harga=document.form_rinci.harga.value;
	jumlahanggaran=document.form_rinci.jumlahanggaran.value;
	jumlahpenerimaanpanjar=document.form_rinci.jumlahpenerimaanpanjar.value;
	jumlahbelanjapanjar=document.form_rinci.jumlahbelanjapanjar.value;
	sisapanjar=document.form_rinci.sisapanjar.value;
	nonpdpanjar=document.form_rinci.nonpdpanjar.value;
	sisasaldo=document.form_rinci.sisasaldo.value;
	koderek108=document.form_rinci.koderek108.value;
	
	if(pptk == ''){ 
		swal("Gagal..!!!", "PPTK KEGIATAN BELUM TERDAFTAR....!!!", "error");
	}else if(notapanjar==''){
		swal("Gagal..!!!", "NOTA PANJAR HARUS DI ISI..!!!", "error");
	}else if(program==''){
		swal("Gagal..!!!", "PROGRAM HARUS DI ISI..!!!", "error");
	}else if(tglspjpanjar==''){
		swal("Gagal..!!!", "TANGGAL  HARUS DI ISI..!!!", "error");
	}else if(kegiatan==''){
		swal("Gagal..!!!", "PROGRAM HARUS DI ISI..!!!", "error");
	}else if(kegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD HARUS DI ISI..!!!", "error");
	}else if(pihakketiga==''){
		swal("Gagal..!!!", "PIHAK KETIGA HARUS DI ISI..!!!", "error");
	}else if(rincianbelanja==''){
		swal("Gagal..!!!", "RINCIAN BELANJA HARUS DI ISI..!!!", "error");
	}else if(itembelanja==''){
		swal("Gagal..!!!", "ITEM BELANJA HARUS DI ISI..!!!", "error");
	}else if(jumlahbelanjapanjar==''){
		swal("Gagal..!!!", "JUMLAH BELANJA PANJAR BLUD HARUS DI ISI..!!!", "error");
	}else if(sisapanjar==''){
		swal("Gagal..!!!", "SISA PANJAR HARUS DI ISI..!!!", "error");
	}else{
		clearrinci();
		$.get('trans_/spjpanjar/simpan.php',{kodepptk:kodepptk,
		kodekegiatanblud:kodekegiatanblud,
		kodepihakketiga:kodepihakketiga,
		nospjpanjar:nospjpanjar,
		tglspjpanjar:tglspjpanjar,
		notapanjar:notapanjar,
		pptk:pptk,
		program:program,
		kegiatan:kegiatan,
		kegiatanblud:kegiatanblud,
		kodepihakketiga:kodepihakketiga,
		pihakketiga:pihakketiga,
		keterangan:keterangan,
		koderek50:koderek50,
		rincianbelanja:rincianbelanja,
		itembelanja:itembelanja,
		iditembelanjanpd:iditembelanjanpd,
		volume:volume,
		satuan:satuan,
		harga:harga,
		jumlahanggaran:jumlahanggaran,
		jumlahpenerimaanpanjar:jumlahpenerimaanpanjar,
		jumlahbelanjapanjar:jumlahbelanjapanjar,sisapanjar:sisapanjar,nousulan:nousulan,nopp:nopp,nonpdpanjar:nonpdpanjar,sisasaldo:sisasaldo,koderek108:koderek108},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.nospjpanjar.value=update[1];
						gridrinci(update[1]);
						mati();
						document.form_rinci.rincianbelanja.focus();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function hasil(){ 
	jumlahpenerimaanpanjar=document.form_rinci.sisasaldo.value;
	jumlahbelanjapanjar=document.form_rinci.jumlahbelanjapanjar.value; 
	
	$.get("trans_/spjpanjar/hasil.php",{jumlahpenerimaanpanjar:jumlahpenerimaanpanjar,jumlahbelanjapanjar:jumlahbelanjapanjar},function(result){  
			document.form_rinci.sisapanjar.value=result;
			//document.form_rinci.tsimpan.focus();
			}
	);
}

function clearrinci(){
	document.form_rinci.koderek50.value='';
	document.form_rinci.rincianbelanja.value='';
	document.form_rinci.itembelanja.value='';
	document.form_rinci.iditembelanjanpd.value=''; 
	document.form_rinci.nopp.value=''; 
	document.form_rinci.nousulan.value=''; 	
	document.form_rinci.volume.value='';
	document.form_rinci.satuan.value='';
	document.form_rinci.harga.value='';
	document.form_rinci.jumlahanggaran.value='';
	//document.form_rinci.jumlahpenerimaanpanjar.value='';
	document.form_rinci.jumlahbelanjapanjar.value='';
	document.form_rinci.sisapanjar.value='';
	document.form_rinci.nonpdpanjar.value='';
}

function mati(){
	document.form.tglspjpanjar.disabled=true;
	document.form.pihakketiga.disabled=true;
	document.form.keterangan.disabled=true;
	document.form.notapanjar.disabled=true;
	
	document.getElementById('carinotapanjar').style.visibility='hidden';
}

function gridrinci(nospjpanjar){ 
	jfloading("grid_nilai");
	$.get("trans_/spjpanjar/gridrinci.php",{nospjpanjar:nospjpanjar},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function dataspjpanjar(){ 
	jfloading("sub_konten");
	$.get("trans_/spjpanjar/dataspjpanjar.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function hapus_rinci(id,nospjpanjar,iditembelanjanpd,kodekegiatanblud,jumlahbelanjapanjar){  
	swal({
	  title: "APAKAH ANDA AKAN MENGHAPUS DATA INI...?",
	  text: "TEKAN OK JIKA IYA",
	  type: "info",
	  showCancelButton: true,
	  closeOnConfirm: true,
	  showLoaderOnConfirm: true
	}, function (dismiss) { 
			if(dismiss==true){
				$.get("trans_/spjpanjar/hapus_rinci.php",{id:id,nospjpanjar:nospjpanjar,iditembelanjanpd:iditembelanjanpd,kodekegiatanblud:kodekegiatanblud,jumlahbelanjapanjar:jumlahbelanjapanjar},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(nospjpanjar);
							}else{
								alert(result);
								//swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function kunci(nospjpanjar){
	jfloading("sub_konten");
	$.get("trans_/spjpanjar/kunci.php",{nospjpanjar:nospjpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					dataspjpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nospjpanjar){
	jfloading("sub_konten");
	$.get("trans_/spjpanjar/bukakunci.php",{nospjpanjar:nospjpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					dataspjpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function hapusHeader(nospjpanjar){  
	swal({
	  title: "APAKAH ANDA AKAN MENGHAPUS DATA INI...?",
	  text: "TEKAN OK JIKA IYA",
	  type: "info",
	  showCancelButton: true,
	  closeOnConfirm: true,
	  showLoaderOnConfirm: true
	}, function (dismiss) { 
			if(dismiss==true){
				$.get("trans_/spjpanjar/hapus_heder.php",{nospjpanjar:nospjpanjar},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								dataspjpanjar();
							}else{
								alert(result);
							}
						}
					}
				);
			}
	});
	
}

function simpanspjpanjaarpajak(){ 
    
	nospjpanjar=document.form.nospjpanjar.value; 
	pph21=document.form_pajak.pph21.value; 
	pph22=document.form_pajak.pph22.value;
	pph23=document.form_pajak.pph23.value;
	pph25=document.form_pajak.pph25.value;
	pasal4=document.form_pajak.pasal4.value;
	ppnpusat=document.form_pajak.ppnpusat.value;
	utangpajakdaerah=document.form_pajak.utangpajakdaerah.value;
	koderekening=document.form_pajak.koderek.value;
		
	if(nospjpanjar==''){
		swal("Gagal..!!!", "No. SPJ PANJAR TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		clearrinci();
		$.get('trans_/spjpanjar/simpanpajak.php',{nospjpanjar:nospjpanjar,pph21:pph21,pph22:pph22,pph23:pph23,pph25:pph25,pasal4:pasal4,ppnpusat:ppnpusat, 
				utangpajakdaerah:utangpajakdaerah,koderekening:koderekening},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						gridpajak(nospjpanjar);
						//$.fancybox.close();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function gridpajak(nospjpanjar){ 
	jfloading("grid_pajak");
	$.get("trans_/spjpanjar/grid_pajak.php",{nospjpanjar:nospjpanjar},
		function(result){ 
			$("#grid_pajak").html(result); 
			jfdata_table2(); 
		}
	);
}

function carinotapanjar(){
	$.fancybox({
		'href'			:'trans_/spjpanjar/carinotapanjar.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihnotapanjar(nonotapanjar,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud,total){ 
	document.form_rinci.rincianbelanja.value='';
	document.form_rinci.itembelanja.value=''; 
	document.form_rinci.jumlahanggaran.value='';
	document.form_rinci.jumlahpenerimaanpanjar.value='';
	document.form_rinci.jumlahbelanjapanjar.value='';
	
	document.form.notapanjar.value=nonotapanjar;
	document.form.kodepptk.value=kodepptk;
	document.form.pptk.value=pptk;
	document.form.program.value=program;
	document.form.kegiatan.value=kegiatan;
	document.form.kodekegiatanblud.value=kodekegiatanblud; 
	document.form.kegiatanblud.value=kegiatanblud;
	
	document.form.pihakketiga.value='';
	document.form.kodepihakketiga.value=''; 
	document.form.keterangan.value='';
	document.form_rinci.jumlahpenerimaanpanjar.value=total;
	
	$.fancybox.close();
}

function caririncianbelanja(){
	kodekegiatanblud=document.form.kodekegiatanblud.value; 
	$.fancybox({
		'href'			:'trans_/spjpanjar/caririncianbelanja.php?kodekegiatanblud='+kodekegiatanblud,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihrincianbelanja(rincianbelanja50,koderek50){
	document.form_rinci.rincianbelanja.value=rincianbelanja50;
	document.form_rinci.koderek50.value=koderek50;
	
	document.form_rinci.itembelanja.value='';
	document.form_rinci.jumlahanggaran.value='';
	//document.form_rinci.jumlahpenerimaanpanjar.value='';
	$.fancybox.close();
}

function cariitembelanja(){
	notapanjar=document.form.notapanjar.value; 
	$.fancybox({
		'href'			:'trans_/spjpanjar/cariitembelanja.php?notapanjar='+notapanjar,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihitembelanja(itembelanja,volumepermintaanpanjar,satuan,hargapermintaanpanjar,nopp,nousulan,id,
	nonpdpanjar,total,koderek50,rincianbelanja50,sisasaldo,koderek108){
	document.form_rinci.itembelanja.value=itembelanja;
	document.form_rinci.volume.value=volumepermintaanpanjar;
	document.form_rinci.satuan.value=satuan;
	document.form_rinci.harga.value=hargapermintaanpanjar;
	document.form_rinci.nopp.value=nopp;
	document.form_rinci.nousulan.value=nousulan;
	document.form_rinci.iditembelanjanpd.value=id;
	document.form_rinci.nonpdpanjar.value=nonpdpanjar;
	document.form_rinci.jumlahanggaran.value=total;
	document.form_rinci.satuan.value=satuan;
	document.form_rinci.koderek50.value=koderek50;
	document.form_rinci.rincianbelanja.value=rincianbelanja50;
	document.form_rinci.sisasaldo.value=sisasaldo;
	document.form_rinci.koderek108.value=koderek108;
	$.fancybox.close();
}

