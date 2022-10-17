function formverifsppup(nosppup){ 
	jfloading("sub_konten");
	$.get("trans_/verifspm/formverifsppup.php",{nosppup:nosppup},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			$( '#jumlahspp' ).mask('000,000,000,000.00', {reverse: true});
		}
	);
}

function verifSpp(nosppup){
	swal({
	  title: "APAKAH ANDA YAKIN INGIN MEMVERIF SPP INI....????",
	  text: "TEKAN OK UNTUK SETUJU",
	  type: "info",
	  showCancelButton: true,
	  closeOnConfirm: false,
	  showLoaderOnConfirm: true
	}, function (dismiss) { 
			if(dismiss==true){
				$.get("trans_/verifspm/verifspp.php",{nosppup:nosppup},
					function(result){
						if(result=="OK"){
							 setTimeout(function () {
								swal("SPP INI SUDAH TERVERIFIKASI...!!!");
								dataspp_siap_upx();
							 }, 2000);
						}else{
							swal(result);
						}
					});
			}
	});
}

function dataspp_siap_up(){
	jfloading("sub_konten");
	$.get("trans_/verifspm/dataspp_siap_up.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function dataspp_siap_upx(){
	jfloading("sub_konten");
	$.get("trans_/verifspm/dataspp_siap_upx.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}