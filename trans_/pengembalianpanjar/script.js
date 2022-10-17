function formpengembalianpanjar(nopengembalianpanjar){
	jfloading("sub_konten");
	$.get("trans_/pengembalianpanjar/formpengembalianpanjar.php",{nopengembalianpanjar:nopengembalianpanjar},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			gridrinci(nopengembalianpanjar);
			kodekegiatanblud=document.form.kodekegiatanblud.value;
			jumlahpenerimaanpanjar=document.form_rinci.jumlahpenerimaanpanjar.value;
			$("#rincianbelanja").autocomplete({
				serviceUrl:'trans_/pengembalianpanjar/autobyrincianbelanja.php?kodekegiatanblud='+kodekegiatanblud,
				type: "GET",
					onSelect: function (suggestions) {
						$('#rincianbelanja').val(suggestions.rincianbelanja50);
						$('#koderek50').val(suggestions.koderek50);
						document.form_rinci.itembelanja.focus();
						
						$("#itembelanja").autocomplete({
							serviceUrl:'trans_/pengembalianpanjar/autobyitembelanja.php?koderek50='+suggestions.koderek50+'&kodekegiatanblud='+kodekegiatanblud+'&jumlah='+jumlahpenerimaanpanjar,
							type: "GET",
								onSelect: function (suggestions) {
									$('#itembelanja').val(suggestions.itembelanja);
									$('#volume').val(suggestions.volume);
									$('#satuan').val(suggestions.satuan);
									$('#harga').val(suggestions.harga);
									$('#nopp').val(suggestions.nopp);
									$('#nousulan').val(suggestions.nousulan);
									$('#jumlahanggaran').val(suggestions.total);
									$('#idnpdpanjar').val(suggestions.id);
									$('#nonpdpanjar').val(suggestions.nonpdpanjar);
									document.form_rinci.jumlahbelanjapanjar.focus();
								}
								
						});
					}
			});
			if(nopengembalianpanjar != undefined){
				mati();
			}
		}
	);

}

function fungsikomplet(){  
	$("#notapanjar").autocomplete({
		serviceUrl:'trans_/pengembalianpanjar/autobynotapanjar.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#notapanjar').val(suggestion.nonotapanjar);
				$('#kodepptk').val(suggestion.kodepptk);
				$('#kodekegiatanblud').val(suggestion.kodekegiatanblud);
				$('#pptk').val(suggestion.pptk);
				$('#program').val(suggestion.program);
				$('#kegiatan').val(suggestion.kegiatan);
				$('#jumlahpenerimaanpanjar').val(suggestion.total);
				$('#sisapanjar').val(suggestion.total);
				$('#kegiatanblud').val(suggestion.kegiatanblud);
				
				$("#rincianbelanja").autocomplete({
					serviceUrl:'trans_/pengembalianpanjar/autobyrincianbelanja.php?kodekegiatanblud='+suggestion.kodekegiatanblud,
					type: "GET",
						onSelect: function (suggestions) {
							$('#rincianbelanja').val(suggestions.rincianbelanja50);
							$('#koderek50').val(suggestions.koderek50);
							document.form_rinci.itembelanja.focus();
							
							$("#itembelanja").autocomplete({
								serviceUrl:'trans_/pengembalianpanjar/autobyitembelanja.php?koderek50='+suggestions.koderek50+'&kodekegiatanblud='+suggestion.kodekegiatanblud+'&jumlah='+suggestion.total,
								type: "GET",
									onSelect: function (suggestions) {
										$('#itembelanja').val(suggestions.itembelanja);
										$('#volume').val(suggestions.volume);
										$('#satuan').val(suggestions.satuan);
										$('#harga').val(suggestions.harga);
										$('#nopp').val(suggestions.nopp);
										$('#nousulan').val(suggestions.nousulan);
										$('#jumlahanggaran').val(suggestions.total);
										$('#idnpdpanjar').val(suggestions.id);
										$('#nonpdpanjar').val(suggestions.nonpdpanjar);
										document.form_rinci.jumlahbelanjapanjar.focus();
									}
									
							});
						}
				});
				
		    }
	});
	$("#pihakketiga").autocomplete({
		serviceUrl:'trans_/pengembalianpanjar/autobypihakketiga.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#pihakketiga').val(suggestion.nama);
				$('#kodepihakketiga').val(suggestion.kode);
				document.form.keterangan.focus();
		    }
	});
}

function simpanpengembalianpanjar(){ 
    
	kodepptk=document.form.kodepptk.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	kodepihakketiga=document.form.kodepihakketiga.value;
	nopengembalianpanjar=document.form.nopengembalianpanjar.value;
	tglpengembalianpanjar=document.form.tglpengembalianpanjar.value;
	notapanjar=document.form.notapanjar.value;
	pptk=document.form.pptk.value;
	program=document.form.program.value;
	kegiatan=document.form.kegiatan.value;
	kegiatanblud=document.form.kegiatanblud.value;
	pihakketiga=document.form.pihakketiga.value;
	keterangan=document.form.keterangan.value; 

	koderek50=document.form_rinci.koderek50.value;
	rincianbelanja=document.form_rinci.rincianbelanja.value;
	itembelanja=document.form_rinci.itembelanja.value;
	idnpdpanjar=document.form_rinci.idnpdpanjar.value; 
	nopp=document.form_rinci.nopp.value; 
	nousulan=document.form_rinci.nousulan.value; 	
	volume=document.form_rinci.volume.value;
	satuan=document.form_rinci.satuan.value;
	harga=document.form_rinci.harga.value;
	jumlahanggaran=document.form_rinci.jumlahanggaran.value;
	jumlahpenerimaanpanjar=document.form_rinci.jumlahpenerimaanpanjar.value;
	jumlahbelanjapanjar=document.form_rinci.jumlahbelanjapanjar.value;
	sisapanjar=document.form_rinci.sisapanjar.value;
	
	if(pptk == ''){ 
		swal("Gagal..!!!", "PPTK KEGIATAN BELUM TERDAFTAR....!!!", "error");
	}else if(notapanjar==''){
		swal("Gagal..!!!", "NOTA PANJAR HARUS DI ISI..!!!", "error");
	}else if(program==''){
		swal("Gagal..!!!", "PROGRAM HARUS DI ISI..!!!", "error");
	}else if(tglpengembalianpanjar==''){
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
		$.get('trans_/pengembalianpanjar/simpan.php',{kodepptk:kodepptk,
		kodekegiatanblud:kodekegiatanblud,
		kodepihakketiga:kodepihakketiga,
		nopengembalianpanjar:nopengembalianpanjar,
		tglpengembalianpanjar:tglpengembalianpanjar,
		notapanjar:notapanjar,
		pptk:pptk,
		program:program,
		kegiatan:kegiatan,
		kegiatanblud:kegiatanblud,
		pihakketiga:pihakketiga,
		keterangan:keterangan, 
		koderek50:koderek50,
		rincianbelanja:rincianbelanja,
		itembelanja:itembelanja,
		idnpdpanjar:idnpdpanjar, 
		nopp:nopp, 
		nousulan:nousulan, 	
		volume:volume,
		satuan:satuan,
		harga:harga,
		jumlahanggaran:jumlahanggaran,
		jumlahpenerimaanpanjar:jumlahpenerimaanpanjar,
		jumlahbelanjapanjar:jumlahbelanjapanjar,
		sisapanjar:sisapanjar},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.nopengembalianpanjar.value=update[1];
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

function clearrinci(){
	document.form_rinci.koderek50.value='';
	document.form_rinci.rincianbelanja.value='';
	document.form_rinci.itembelanja.value='';
	document.form_rinci.idnpdpanjar.value=''; 
	document.form_rinci.nopp.value=''; 
	document.form_rinci.nousulan.value=''; 	
	document.form_rinci.volume.value='';
	document.form_rinci.satuan.value='';
	document.form_rinci.harga.value='';
	document.form_rinci.jumlahanggaran.value='';
	document.form_rinci.jumlahpenerimaanpanjar.value='';
	document.form_rinci.jumlahbelanjapanjar.value='';
	document.form_rinci.sisapanjar.value='';
}

function mati(){
	document.form.tglpengembalianpanjar.disabled=true;
	document.form.pihakketiga.disabled=true;
	document.form.keterangan.disabled=true;
	document.form.notapanjar.disabled=true;
}

function gridrinci(nopengembalianpanjar){ 
	jfloading("grid_nilai");
	$.get("trans_/pengembalianpanjar/gridrinci.php",{nopengembalianpanjar:nopengembalianpanjar},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function datapengembalianpanjar(){ 
	jfloading("sub_konten");
	$.get("trans_/pengembalianpanjar/datapengembalianpanjar.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function carinotapanjar(){
	$.fancybox({
		'href'			:'trans_/pengembalianpanjar/carinotapanjar.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihnotapanjar(nonotapanjar,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud,koderek50,rincianbelanja,nonpdpanjar,total){
	document.form.notapanjar.value=nonotapanjar;
	document.form.nonpdpanjar.value=nonpdpanjar;
	document.form.kodepptk.value=kodepptk;
	document.form.pptk.value=pptk; 
	document.form.program.value=program;
	document.form.kegiatan.value=kegiatan;
	document.form.kodekegiatanblud.value=kodekegiatanblud; 
	document.form.kegiatanblud.value=kegiatanblud;
	//document.form_rinci.jumlahanggaran.value=total;
	$.fancybox.close();
}

function caririncianbelanja(){
	nonpdpanjar=document.form.nonpdpanjar.value;
	if(nonpdpanjar == ''){
		swal("Gagal..!!!", 'NOTA PANJAR BELUM DI PILIH...!!!!', "error");
	}else{
		$.fancybox({
			'href'			:'trans_/pengembalianpanjar/caririncianbelanja.php?nonpdpanjar='+nonpdpanjar,
			'overlayOpacity':0,
			'opacity'		: true,
			'transitionIn'	: 'elastic',
			'type'			: 'ajax'
		});
	}
}

function pilirincianbelanja(nopp,nousulan,koderek50,rincianbelanja50,idpp,itembelanja,volume,satuan,harga,total,volumepermintaanpanjar,hargapermintaanpanjar,totalpermintaanpanjar){
	document.form_rinci.koderek50.value=koderek50;
	document.form_rinci.nopp.value=nopp;
	document.form_rinci.idnpdpanjar.value=idpp;
	document.form_rinci.volume.value=volume;
	document.form_rinci.satuan.value=satuan; 
	document.form_rinci.harga.value=harga;
	document.form_rinci.nousulan.value=nousulan;
	document.form_rinci.rincianbelanja.value=rincianbelanja50; 
	document.form_rinci.itembelanja.value=itembelanja;
	document.form_rinci.jumlahanggaran.value=total;
	document.form_rinci.jumlahpenerimaanpanjar.value=totalpermintaanpanjar;
	document.form_rinci.jumlahbelanjapanjar.value=0;
	document.form_rinci.sisapanjar.value=totalpermintaanpanjar;
	$.fancybox.close();
}

function hapus_rinci(id,nopengembalianpanjar){  
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
				$.get("trans_/pengembalianpanjar/hapus_rinci.php",{id:id,nopengembalianpanjar:nopengembalianpanjar},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(nopengembalianpanjar);
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

function kunci(nopengembalianpanjar){
	jfloading("sub_konten");
	$.get("trans_/pengembalianpanjar/kunci.php",{nopengembalianpanjar:nopengembalianpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datapengembalianpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nopengembalianpanjar){
	jfloading("sub_konten");
	$.get("trans_/pengembalianpanjar/bukakunci.php",{nopengembalianpanjar:nopengembalianpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datapengembalianpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
					datapengembalianpanjar();
				}
			}
		}
	);
}

function hapusHeader(nopengembalianpanjar){  
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
				$.get("trans_/pengembalianpanjar/hapus_heder.php",{nopengembalianpanjar:nopengembalianpanjar},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								datapengembalianpanjar();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}
