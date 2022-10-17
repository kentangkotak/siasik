function formnpdpanjar(nonpdpanjar){
	jfloading("sub_konten");
	$.get("trans_/npdPanjar/formnpdpanjar.php",{nonpdpanjar:nonpdpanjar},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			gridrinci(nonpdpanjar);
			$( '#hargapermintaanpanjar' ).mask('000,000,000,000.00', {reverse: true});
			$( '#totalpermintaanpanjar' ).mask('000,000,000,000.00', {reverse: false});
			$( '#volumepermintaanpanjar' ).mask('000,000,000,000.00', {reverse: true});
			if(nonpdpanjar != undefined){
				mati();
			}
			$("#rincianbelanja").autocomplete({
				serviceUrl:'trans_/npdPanjar/autobyrincianbelanja.php?kodekegiatan='+$("#kodekegiatanblud").val(),
				type: "GET",
					onSelect: function (suggestions) {
						$('#rincianbelanja').val(suggestions.uraian50);
						$('#koderek50').val(suggestions.koderek50);
						document.form_rinci.itembelanja.focus();
						
						$("#itembelanja").autocomplete({
							serviceUrl:'trans_/npdPanjar/autobyitembelanja.php?koderek50='+$("#koderek50").val()+'&kodekegiatan='+$("#kodekegiatanblud").val(),
							type: "GET",
								onSelect: function (suggestions) {
									$('#itembelanja').val(suggestions.usulan);
									$('#volume').val(suggestions.jumlahacc);
									$('#satuan').val(suggestions.satuan);
									$('#harga').val(suggestions.harga);
									$('#nopp').val(suggestions.nopp);
									$('#nousulan').val(suggestions.nousulan);
									$('#total').val(suggestions.total);
									$('#volumepermintaanpanjar').val(suggestions.jumlahacc);
									$('#hargapermintaanpanjar').val(suggestions.harga);
									$('#totalpermintaanpanjar').val(suggestions.total);
									$('#idpp').val(suggestions.idpp);
									document.form.hargapermintaanpanjar.focus();
								}
								
						});
					}
									
			});
			$("#itembelanja").autocomplete({
				serviceUrl:'trans_/npdPanjar/autobyitembelanja.php?koderek50='+$("#koderek50").val()+'&kodekegiatan='+$("#kodekegiatanblud").val(),
				type: "GET",
					onSelect: function (suggestions) {
						$('#itembelanja').val(suggestions.usulan);
						$('#volume').val(suggestions.jumlahacc);
						$('#satuan').val(suggestions.satuan);
						$('#harga').val(suggestions.harga);
						$('#nopp').val(suggestions.nopp);
						$('#nousulan').val(suggestions.nousulan);
						$('#total').val(suggestions.total);
						$('#volumepermintaanpanjar').val(suggestions.jumlahacc);
						$('#hargapermintaanpanjar').val(suggestions.harga);
						$('#totalpermintaanpanjar').val(suggestions.total);
						$('#idpp').val(suggestions.idpp);
						document.form.hargapermintaanpanjar.focus();
					}
					
			});
			$.get("trans_/npdPanjar/getjumlahnpdpanjar.php",{nonpdpanjar:nonpdpanjar},function(result){
				$("#contentPagu").html(result);
			});
			
			
			document.form.totalpermintaanpanjar.value=vatotalpermintaanpanjarr
		}
	);
}

function fungsikomplet(){
	$("#pptk").autocomplete({
		serviceUrl:'trans_/npdPanjar/autobypptk.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kodepptk').val(suggestion.nip);
				$('#pptk').val(suggestion.nama);
				$('#bidang').val(suggestion.bidang);
				$('#kodebidang').val(suggestion.kodebidang);
				document.form.kegiatanblud.focus();
				
				$("#kegiatanblud").autocomplete({
					serviceUrl:'trans_/npdPanjar/autobykegiatan.php?nip='+suggestion.nip,
					type: "GET",
						onSelect: function (suggestions) {
							$('#kegiatanblud').val(suggestions.kegiatan);
							$('#kodekegiatanblud').val(suggestions.kodekegiatan);
							document.form_rinci.rincianbelanja.focus();
							
							$("#rincianbelanja").autocomplete({
								serviceUrl:'trans_/npdPanjar/autobyrincianbelanja.php?kodekegiatan='+suggestions.kodekegiatan,
								type: "GET",
									onSelect: function (suggestions) {
										$('#rincianbelanja').val(suggestions.uraian50);
										$('#koderek50').val(suggestions.koderek50);
										document.form_rinci.itembelanja.focus();
										
										kodekegiatan=document.form.kodekegiatanblud.value;
										$("#itembelanja").autocomplete({
											serviceUrl:'trans_/npdPanjar/autobyitembelanja.php?koderek50='+suggestions.koderek50+'&kodekegiatan='+kodekegiatan,
											type: "GET",
												onSelect: function (suggestions) {
													$('#itembelanja').val(suggestions.usulan);
													$('#volume').val(suggestions.jumlahacc);
													$('#satuan').val(suggestions.satuan);
													$('#harga').val(suggestions.harga);
													$('#nopp').val(suggestions.nopp);
													$('#nousulan').val(suggestions.nousulan);
													$('#total').val(suggestions.total);
													$('#volumepermintaanpanjar').val(suggestions.jumlahacc);
													$('#hargapermintaanpanjar').val(suggestions.harga);
													$('#totalpermintaanpanjar').val(suggestions.total);
													$('#idpp').val(suggestions.idpp);
													document.form_rinci.volumepermintaanpanjar.focus();
												}
												
										});
										
										
									}
									
							});
							
						}

				});
							
		    }

	});
		   
}

function simpannpdpanjar(){ 
    
	nonpd=document.form.nonpd.value; 
	tglnpd=document.form.tglnpd.value; 
	//triwulan=document.form.triwulan.value; alert('')
	//saldopanjar=document.form.saldopanjar.value;
	kodepptk=document.form.kodepptk.value; 
	pptk=document.form.pptk.value; 
	program=document.form.program.value;
	kegiatan=document.form.kegiatan.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	kegiatanblud=document.form.kegiatanblud.value;
	kodebidang=document.form.kodebidang.value;
	bidang=document.form.bidang.value;
	
	koderek50=document.form_rinci.koderek50.value; 
	rincianbelanja=document.form_rinci.rincianbelanja.value;
	nopp=document.form_rinci.nopp.value;
	nousulan=document.form_rinci.nousulan.value;
	itembelanja=document.form_rinci.itembelanja.value; 
	volume=document.form_rinci.volume.value;
	harga=document.form_rinci.harga.value;
	total=document.form_rinci.total.value;
	satuan=document.form_rinci.satuan.value;
	volumepermintaanpanjar=document.form_rinci.volumepermintaanpanjar.value;
	hargapermintaanpanjar=document.form_rinci.hargapermintaanpanjar.value;
	totalpermintaanpanjar=document.form_rinci.totalpermintaanpanjar.value;
	idpp=document.form_rinci.idpp.value;
	sisaanggaran=document.form_rinci.sisaanggaran.value; 
	koderek108=document.form_rinci.koderek108.value; 
	uraian108=document.form_rinci.uraian108.value;
		
	if(kodepptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(pptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(kegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(koderek50==''){
		swal("Gagal..!!!", "RINCIAN BELANJA TIDAK BOLEH KOSONG ATAU RINCIAN BELANJA BELUM TERDAFTAR....!!!", "error");
	}else if(rincianbelanja==''){
		swal("Gagal..!!!", "RINCIAN BELANJA TIDAK BOLEH KOSONG ATAU RINCIAN BELANJA BELUM TERDAFTAR....!!!", "error");
	}else if(itembelanja==''){
		swal("Gagal..!!!", "ITEM BELANJA TIDAK BOLEH KOSONG....!!!", "error");
	}else if(hargapermintaanpanjar==''){
		swal("Gagal..!!!", "HARGA PERMINTAAN PANJAR TIDAK BOLEH KOSONG....!!!", "error");
	}else if(volumepermintaanpanjar==''){
		swal("Gagal..!!!", "VOLUME PERMINTAAN PANJAR TIDAK BOLEH KOSONG....!!!", "error");
	}else if(totalpermintaanpanjar==''){
		swal("Gagal..!!!", "TOTAL PERMINTAAN PANJAR TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		//clearrinci(); 
		$.get('trans_/npdPanjar/simpan.php',{nonpd:nonpd, 
				tglnpd:tglnpd, 
				//triwulan:triwulan, 
				//saldopanjar:saldopanjar,
				kodepptk:kodepptk, 
				pptk:pptk, 
				program:program,
				kegiatan:kegiatan,
				kodekegiatanblud:kodekegiatanblud,
				kegiatanblud:kegiatanblud,
				koderek50:koderek50,
				rincianbelanja:rincianbelanja,
				nopp:nopp,
				nousulan:nousulan,
				itembelanja:itembelanja,
				volume:volume,
				harga:harga,
				total:total,satuan:satuan,kodebidang:kodebidang,bidang:bidang,volumepermintaanpanjar:volumepermintaanpanjar,hargapermintaanpanjar:hargapermintaanpanjar,
				totalpermintaanpanjar:totalpermintaanpanjar,idpp:idpp,sisaanggaran:sisaanggaran,koderek108:koderek108,uraian108:uraian108},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.nonpd.value=update[1];
						gridrinci(update[1]);
						mati();
						clearrincix();
						nopdx=update[1];
						$.get("trans_/npdPanjar/getjumlahnpdpanjar.php",{nonpdpanjar:nopdx},function(result){
							$("#contentPagu").html(result);
						});
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function gridrinci(nonpd){
	jfloading("grid_nilai");
	$.get("trans_/npdPanjar/gridrinci.php",{nonpd:nonpd},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function mati(){
	
	document.form.tglnpd.disabled=true;
	document.form.triwulan.disabled=true;
	document.form.pptk.disabled=true;
	document.form.kegiatanblud.disabled=true;
	document.form.triwulan.disabled=true;
	document.form.tglnpd.disabled=true;
	//document.form_rinci.rincianbelanja.di
	//document.form_rinci.rincianbelanja.disabled=true;
}

function clearrinci(){
	document.form_rinci.itembelanja.value='';
	document.form_rinci.nopp.value='';
	document.form_rinci.nousulan.value='';
	document.form_rinci.satuan.value='';
	document.form_rinci.harga.value='';
	document.form_rinci.volume.value='';
	document.form_rinci.total.value='';
	document.form_rinci.volumepermintaanpanjar.value='';
	document.form_rinci.hargapermintaanpanjar.value='';
	document.form_rinci.totalpermintaanpanjar.value='';
	document.form_rinci.idpp.value='';
	document.form_rinci.sisaanggaran.value='';
}

function datanpdpanjar(){ 
	jfloading("sub_konten");
	$.get("trans_/npdPanjar/datanpdpanjar.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}


function hapus_rinci(id,nonpdpanjar,nopp,nousulan,koderek50,usulan){  
	swal({
	  title: "PERINGATAN",
	  text: "Apakah Anda Yakin Akan Menghapus Data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Ya, hapus ini!",
	  cancelButtonText: "Tidak!",
	  closeOnConfirm: false
	}, function (dismiss) { 
			if(dismiss==true){
				$.get("trans_/npdPanjar/hapus_rinci.php",{id:id,nonpdpanjar:nonpdpanjar,nopp:nopp,nousulan:nousulan,koderek50:koderek50,usulan:usulan},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(nonpdpanjar);
							}else{
								//alert(result);
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function hapusHeader(nonpdpanjar){  
	swal({
	  title: "PERINGATAN",
	  text: "Apakah Anda Yakin Akan Menghapus Data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Ya, hapus ini!",
	  cancelButtonText: "Tidak!",
	  closeOnConfirm: false
	}, function (dismiss) { 
			if(dismiss==true){
				$.get("trans_/npdPanjar/hapus_heder.php",{nonpdpanjar:nonpdpanjar},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								datanpdpanjar();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function kunci(nonpdpanjar){
	jfloading("sub_konten");
	$.get("trans_/npdPanjar/kunci.php",{nonpdpanjar:nonpdpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanpdpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nonpdpanjar){
	jfloading("sub_konten");
	$.get("trans_/npdPanjar/bukakunci.php",{nonpdpanjar:nonpdpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERBUKA...", "success");
					datanpdpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
					datanpdpanjar();
				}
			}
		}
	);
}

function hasil(volumepermintaanpanjar){
	hargapermintaanpanjar=document.form_rinci.hargapermintaanpanjar.value;
	$.get("trans_/npdPanjar/hasil.php",{hargapermintaanpanjar:hargapermintaanpanjar,volumepermintaanpanjar:volumepermintaanpanjar},function(result){ 
		document.form_rinci.totalpermintaanpanjar.value=result;
	});
}

function hasil(hargapermintaanpanjar){
	volumepermintaanpanjar=document.form_rinci.volumepermintaanpanjar.value;
	$.get("trans_/npdPanjar/hasil.php",{hargapermintaanpanjar:hargapermintaanpanjar,volumepermintaanpanjar:volumepermintaanpanjar},function(result){ 
		document.form_rinci.totalpermintaanpanjar.value=result;
	});
}

function cariitembelanja(){
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	koderek50=document.form_rinci.koderek50.value;
	$.fancybox({
		'href'			:'trans_/npdPanjar/cariitembelanja.php?kodekegiatanblud='+kodekegiatanblud+'&koderek50='+koderek50,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilih(usulan,jumlahacc,satuan,harga,notrans,nousulan,idpp,total,sisa,koderek108,uraian108){
	document.form_rinci.itembelanja.value=usulan; 
	document.form_rinci.volume.value=jumlahacc; 
	document.form_rinci.satuan.value=satuan;
	document.form_rinci.harga.value=harga;
	document.form_rinci.nopp.value=notrans;
	document.form_rinci.idpp.value=idpp; 
	document.form_rinci.nousulan.value=nousulan;
	document.form_rinci.total.value=total;
	document.form_rinci.volumepermintaanpanjar.value=jumlahacc;
	document.form_rinci.hargapermintaanpanjar.value=harga;
	document.form_rinci.totalpermintaanpanjar.value=total;
	document.form_rinci.sisaanggaran.value=sisa;
	document.form_rinci.koderek108.value=koderek108;
	document.form_rinci.uraian108.value=uraian108;
	$.fancybox.close();
}

function caripptk(){
	$.fancybox({
		'href'			:'trans_/npdPanjar/caripptk.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
	document.getElementById('caripptk').style.visibility='hidden';
}

function pilihpptk(kodepptk,nama,kodekegiatanblud,kegiatanblud,kodebidang,bidang){ 
	
	document.form.kodepptk.value=kodepptk;
	document.form.pptk.value=nama;
	document.form.kodekegiatanblud.value=kodekegiatanblud; 
	document.form.kegiatanblud.value=kegiatanblud;
	document.form.kodebidang.value=kodebidang;
	document.form.bidang.value=bidang;
	
	$.fancybox.close();
}

function caririncianbelanja(){
	//clearrinci();
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	$.fancybox({
		'href'			:'trans_/npdls/caririncianbelanja.php?kodekegiatanblud='+kodekegiatanblud,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihrincianbelanja(koderek50,uraian50){ 
	
	document.form_rinci.koderek50.value=koderek50;
	document.form_rinci.rincianbelanja.value=uraian50;	
	$.fancybox.close();
}

function cetaknpdpanjar(){ 
	nonpd=document.form.nonpd.value;
	if(nonpd==""){
		swal("Gagal..!!!", "APA YANG AKAN ANDA CETAK...???", "error");
	}else{
		window.open('trans_/npdPanjar/cetaknpdpanjar.php?nonpd='+nonpd,'','height=700,width=800,scrollbars=yes,resizable=yes');
	}
}


