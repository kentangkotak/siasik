function formjurnalumum(nobukti){
	jfloading("sub_konten");
	$.get("trans_/penatausahaan/jurnalumum/formjurnalumum.php",{nobukti:nobukti},
		function(result){
			$("#sub_konten").html(result);
			$('#tanggal').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$( '#jumlah' ).mask('000,000,000,000.00', {reverse: true});
			gridrinci(nobukti);
			if(nobukti != undefined){
				mati();
			}
		}
	);
}

function gridrinci(nobukti){
	jfloading("grid_nilai");
	$.get("trans_/penatausahaan/jurnalumum/gridrinci.php",{nobukti:nobukti},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function caripsap(){
	$.fancybox({
		'href'			:'trans_/penatausahaan/jurnalumum/caripsap.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihkode(koderek,uraian){ 
	
	document.form_rinci.psap13.value=koderek;
	document.form_rinci.uraianpsap13.value=uraian;	
	$.fancybox.close();
}

function caripsapx(){
	$.fancybox({
		'href'			:'trans_/penatausahaan/jurnalumum/caripsapx.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihkodex(koderek,uraian){ 
	
	document.form_rinci.psap13.value=koderek;
	document.form_rinci.uraianpsap13.value=uraian;	
	$.fancybox.close();
}

function simpanjurnalumum(){ 
    
	nobukti=document.form.nobukti.value; 
	tanggal=document.form.tanggal.value;
	keterangan=document.form.keterangan.value; 
	
	psap13=document.form_rinci.psap13.value; 
	uraianpsap13=document.form_rinci.uraianpsap13.value;
	debitkredit=document.form_rinci.debitkredit.value;
	jumlah=document.form_rinci.jumlah.value;
		
	if(nobukti==''){
		swal("Gagal..!!!", "NO BUKTI TIDAK BOLEH KOSONG....!!!", "error");
	}else if(tanggal==''){
		swal("Gagal..!!!", "TANGGAL TIDAK BOLEH KOSONG....!!!", "error");
	}else if(keterangan==''){
		swal("Gagal..!!!", "KETERANGAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(psap13==''){
		swal("Gagal..!!!", "KODE PSAP13 TIDAK BOLEH KOSONG ATAU TERDAFTAR....!!!", "error");
	}else if(uraianpsap13==''){
		swal("Gagal..!!!", "RINCIAN PSAP13 TIDAK BOLEH KOSONG ATAU TERDAFTAR.....!!!", "error");
	}else if(debitkredit==''){
		swal("Gagal..!!!", "DEBET KREDIT HARUS DIPILIH....!!!", "error");
	}else if(jumlah==''){
		swal("Gagal..!!!", "JUMLAH TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		clearrinci(); 
		$.get('trans_/penatausahaan/jurnalumum/simpan.php',{nobukti:nobukti, 
				tanggal:tanggal, 
				keterangan:keterangan, 
				psap13:psap13,
				uraianpsap13:uraianpsap13,
				debitkredit:debitkredit,
				jumlah:jumlah},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						gridrinci(nobukti);
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function clearrinci(){
	document.form_rinci.psap13.value='';
	document.form_rinci.uraianpsap13.value='';
	document.form_rinci.debitkredit.value='';
	document.form_rinci.jumlah.value='';
}

function datajurnalumumx(){
	jfloading("sub_konten");
	$.get("trans_/penatausahaan/jurnalumum/datajurnalumum.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function verijurnalumum(){
	nobukti=document.form.nobukti.value;
	
	if(nobukti == ''){
		swal("Gagal..!!!", "NO BUKTI TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		$.get('trans_/penatausahaan/jurnalumum/verijurnalumum.php',{nobukti:nobukti},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH TERVERIF...", "success");
						formjurnalumum(nobukti);
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function mati(){
	document.form.nobukti.disabled=true;
	document.form.tanggal.disabled=true;
	document.form.keterangan.disabled=true;
}

function batalverifverijurnalumum(){
	nobukti=document.form.nobukti.value;
	
	if(nobukti == ''){
		swal("Gagal..!!!", "NO BUKTI TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		$.get('trans_/penatausahaan/jurnalumum/batalverifverijurnalumum.php',{nobukti:nobukti},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH TERVERIF...", "success");
						formjurnalumum(nobukti);
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}
