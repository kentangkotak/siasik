function formpembebasanpajakfarmasi(notrans,nopenerimaan){
	jfloading("sub_konten");
	$.get("trans_/pembebasanpajak/farmasi/form.php",{nopenerimaan:nopenerimaan},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			if(nopenerimaan != undefined){
				gridrincibebas(notrans);
				document.form.nopenerimaan.disabled=true;
				document.form.nofaktur.disabled=true;
				document.form.tsimpan.disabled=true;
			}
		}
	);
}

function fungsikomplet(){
	$("#nopenerimaan").autocomplete({
		serviceUrl:'trans_/pembebasanpajak/farmasi/autobynopenerimaan.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#nopenerimaan').val(suggestions.nopenerimaan);
				$('#nofaktur').val(suggestions.nofaktur);
				document.form.nopenerimaan.disabled=true;
				document.form.nofaktur.disabled=true;
			}
			
	});	
	$("#nofaktur").autocomplete({
		serviceUrl:'trans_/pembebasanpajak/farmasi/autobynofaktur.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#nofaktur').val(suggestions.nofaktur);
				$('#nopenerimaan').val(suggestions.nopenerimaan);
				document.form.nopenerimaan.disabled=true;
				document.form.nofaktur.disabled=true;
			}
			
	});	
}

function carifaktur(nopenerimaan){ 

	nopenerimaan=document.form.nopenerimaan.value; 
	nofaktur=document.form.nofaktur.value; 
		
	if(nopenerimaan==''){
		swal("Gagal..!!!", "NO PENERIMAAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nofaktur==''){
		swal("Gagal..!!!", "NO FAKTUR TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		$.get('trans_/pembebasanpajak/farmasi/carifaktur.php',{nopenerimaan:nopenerimaan},
			function(result){ 
				$("#grid_nilai").html(result);
			}
		);
	}
}

function bebaskan(nopenerimaan){ 
		
	if(nopenerimaan==''){
		swal("Gagal..!!!", "NO PENERIMAAN TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		$.get('trans_/pembebasanpajak/farmasi/simpanbebaspajak.php',{nopenerimaan:nopenerimaan},
			function(result){
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0] == "OK"){
						gridrincibebas(update[2]);
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);
	}
}

function gridrincibebas(notrans){ 
	jfloading("grid_nilai");
		$.get("trans_/pembebasanpajak/farmasi/gridrincibebas.php",{notrans:notrans},
			function(result){
				$("#grid_nilai").html(result);
				jfdata_tablex();
			}
		);
}

function datapembebasanpajak(){ 
	jfloading("sub_konten");
	$.get("trans_/pembebasanpajak/farmasi/datapembebasanpajak.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}