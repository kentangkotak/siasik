function datarencana(){ 
	jfloading("sub_konten");
	$.get("perencanaan/diklat/dataperencanaan.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

