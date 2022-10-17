function datapenempatan_anggaran(){
	jfloading("sub_konten");
	$.get("trans_/penetapananggaran/datapenempatan_anggaran.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function pendapatan1(){
	jfloading("sub_konten");
	$.get("trans_/penetapananggaran/pendapatan1.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function pendapatan2(){
	jfloading("sub_konten");
	$.get("trans_/penetapananggaran/pendapatan2.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function pendapatan_rinci(){
	jfloading("sub_konten");
	$.get("trans_/penetapananggaran/pendapatan_rinci.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}


function tingkat1(){
	jfloading("sub_konten");
	$.get("trans_/penetapananggaran/tingkat1.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat2(){
	jfloading("sub_konten");
	$.get("trans_/penetapananggaran/tingkat2.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}
