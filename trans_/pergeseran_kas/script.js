function formPergeseranKas(notrans,jenis){
	jfloading("sub_konten");
	$.get("trans_/pergeseran_kas/formPergeseranKas.php",{notrans:notrans},
		function(result){
			gridrinci();
			$("#sub_konten").html(result);
				$( '#totalpermintaanpanjar' ).mask('000,000,000,000.00', {reverse: false});
				$( '#jumlah' ).mask('000,000,000,000.00', {reverse: true});			
				caribatas(jenis);
				gridrinci(notrans);
				if(notrans != undefined){
					document.form.tgltrans.disabled=true;
					document.form.jenis.disabled=true;
					document.form.norek.disabled=true;
				}
		}
	);
}



function simpanpergeseran(){ 
    
	notrans=document.form.notrans.value;
	tgltrans=document.form.tgltrans.value;
	jenis=document.form.jenis.value;
	batas=document.form.batas.value;
	norek=document.form.norek.value;
	
	nonpk=document.form_rinci.nonpk.value;
	nonpd=document.form_rinci.nonpd.value;
	keterangan=document.form_rinci.keterangan.value;
	totalnpk=document.form_rinci.totalnpk.value;
	
	if(batas==''){
		swal("Gagal..!!!", "BATAS PERGESERAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(jenis==''){
		swal("Gagal..!!!", "JENIS HARUS DI PILIH...!!!", "error");
	}else if(norek==''){
		swal("Gagal..!!!", "NO REKENING & BANK HARUS DI ISI..!!!", "error");
	}else if(nonpk==''){
		swal("Gagal..!!!", "NO TRANSAKSI HARUS DI ISI..!!!", "error");
	}else if(totalnpk==''){
		swal("Gagal..!!!", "TOTAL NPK HARUS DI ISI..!!!", "error");
	}else{
		clear();
		$.get('trans_/pergeseran_kas/simpan.php',{notrans:notrans,tgltrans:tgltrans,jenis:jenis,batas:batas,
		norek:norek,nonpk:nonpk,keterangan:keterangan,totalnpk:totalnpk,nonpd:nonpd},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.notrans.value=update[1];
						gridrinci(update[1]);
						caribatas(jenis);
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function clear(){
	document.form_rinci.nonpk.value='';
	document.form_rinci.keterangan.value='';
	document.form_rinci.totalnpk.value='';
	document.form_rinci.nonpd.value='';
}

function dataPergeseranKas(){
	jfloading("sub_konten");
	$.get("trans_/pergeseran_kas/dataPergeseranKas.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function caribatas(x){
		$.get("trans_/pergeseran_kas/saldobankbendaharapengeluaran.php",{x:x},function(result){	
			var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					document.form.batasx.value=update[0];
					document.form.batas.value=update[1];
					if(x == 1){
						document.form_rinci.nonpk.disabled=true;
						//document.form_rinci.keterangan.disabled=true;
						document.form_rinci.totalnpk.disabled=true;
						document.getElementById('lokasilaka_content').style.visibility='visible';
						//caribatas(this.value);
					}else{
						document.form_rinci.nonpk.disabled=false;
						document.form_rinci.keterangan.disabled=false;
						document.form_rinci.totalnpk.disabled=false;
						document.getElementById('lokasilaka_content').style.visibility='hidden';
						//caribatas(this.value);
					}
				}
		});
}

function kunci(notrans){
	jfloading("sub_konten");
	$.get("trans_/pergeseran_kas/kunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					dataPergeseranKas();					
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(notrans){
	jfloading("sub_konten");
	$.get("trans_/pergeseran_kas/bukakunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					dataPergeseranKas();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function carinpk(){
	$.fancybox({
		'href'			:'trans_/pergeseran_kas/carinpk.php?',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilih(nonpk,totalnpk,nonpd){ 
	document.form_rinci.nonpk.value=nonpk; 
	document.form_rinci.totalnpk.value=totalnpk;
	document.form_rinci.nonpd.value=nonpd;
	document.form_rinci.keterangan.focus();
	$.fancybox.close();
}

function gridrinci(nonpk){ 
	jfloading("grid_nilai");
	$.get("trans_/pergeseran_kas/gridrinci.php",{nonpk:nonpk},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}


function view_detail_rinci(notrans){
	$.fancybox({
		'href'			:'trans_/pergeseran_kas/view_detail_rinci.php?notrans='+notrans,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function data_sudah_terverif(){
	jfloading("sub_konten");
	$.get("trans_/pergeseran_kas/data_sudah_terverif																																																																																																																																																																																			.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function hapusHeader(notrans){  
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
				$.get("trans_/pergeseran_kas/hapus_heder.php",{notrans:notrans},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								dataPergeseranKas();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function hapus_rinci(id,nonpdpanjar,nopp,nousulan,koderek50,usulan,jenis,notrans){  
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
				$.get("trans_/pergeseran_kas/hapus_rinci.php",{id:id,nonpdpanjar:nonpdpanjar,nopp:nopp,nousulan:nousulan,koderek50:koderek50,usulan:usulan},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(notrans);
								caribatas(jenis);
							}else{
								//alert(result);
								swal("Gagal..!!!", result, "error");
								caribatas(jenis);
							}
						}
					}
				);
			}
	});
	
}


