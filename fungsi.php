<?php
	function get_nomer($huruf,$no){
		$jml=strlen($no);
		$nol="";
		for($i=1;$i<=5-$jml;$i++){
			$nol=$nol."0";
		}
		return $huruf.$nol.$no."/".date("m")."/".date("Y");
	}
	function get_nomerx($huruf,$no){
		$jml=strlen($no);
		$nol="";
		for($i=1;$i<=5-$jml;$i++){
			$nol=$nol."0";
		}
		return $huruf.$nol.$no;
	}
	function in_tanggal($delimiter,$tanggal){
		$tanggal1=explode($delimiter,$tanggal);
		return $tanggal1[2]."-".$tanggal1[1]."-".$tanggal1[0];
	}
	function in_tanggalx($delimiter,$tanggal){
		$tanggal1=explode($delimiter,$tanggal);
		return $tanggal1[2]."-".$tanggal1[0]."-".$tanggal1[1];
	}
	function rp($rp){
		return "Rp. ".number_format(intval($rp),0,"",".").",-";
	}
	function rpx($rp){
		return number_format($rp,0,"",".");
	}
	function rpz($rp){
		return number_format($rp,2,".",",");
	}
	function rpzx($rp){
		return "Rp. ".number_format($rp,2,".",",");
	}
	function out_tanggal($delimiter,$tanggal){
		$tanggal1=explode($delimiter,$tanggal);
		return $tanggal1[2]."/".$tanggal1[1]."/".$tanggal1[0];
	}
	function akhirbulan($month,$year){
		return idate('d',mktime(0,0,0,($month+1),0,$year));
	}
	function gennotran($n,$kode){
		$lbr=strlen($n);for($i=1;$i<=5-$lbr;$i++)
		return $n."/".date("m")."/".date("Y")."/".$kode;
	}
	function tanggal_indo($tanggal)
		{
			$bulan = array (1 =>   'Januari',
						'Februari',
						'Maret',
						'April',
						'Mei',
						'Juni',
						'Juli',
						'Agustus',
						'September',
						'Oktober',
						'November',
						'Desember'
					);
			$split = explode('-', $tanggal);
			return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		}
	
	function terbilang($x){
		$abil=array("","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan","Sepuluh","Sebelas");
		if($x<12)return " ".$abil[$x];
			elseif($x<20)return terbilang($x-10)."Belas";
			elseif($x<100)return terbilang($x/10)." Puluh".terbilang($x%10);
			elseif($x<200)return " Seratus".terbilang($x-100);
			elseif($x<1000)return terbilang($x/100)." Ratus".terbilang($x%100);
			elseif($x<2000)return " Seribu".Terbilang($x-1000);
			elseif($x<1000000)return terbilang($x/1000)." Ribu".terbilang($x%1000);
			elseif($x<1000000000)return terbilang($x/1000000)." Juta".terbilang($x%1000000);
			elseif($x<1000000000000)return terbilang($x/1000000000)." Miliar".terbilang($x%1000000000);
			//elseif($x<100000000000)return terbilang($x/100000000)." Triliun".terbilang($x%100000000);
	}
	
	// $wew=250000000000;
	// echo terbilang($wew);
	
	function rpy($rp){
		$a=$rp;
		$b=explode(".",$a);
		$rp=$b[0];
		$koma=$b[1];
		$rupiah="";
		$p=strlen($rp);while($p>3){
			$rupiah=".".substr($rp,-3).$rupiah;
			$l=strlen($rp)-3;
			$rp=substr($rp,0,$l);$p=strlen($rp);
			}
			if($koma==""||$koma==0||$koma==00){$rupiah=$rp.$rupiah;}else{$rupiah=$rp.$rupiah.",".$koma;}
			if($rupiah==0||$rupiah=="0,00")$rupiah="";
			return "Rp.".$rupiah;
			}
			
	function bulan($b){
		if($b=="1")return "Januari";
		if($b=="2")return "Februari";
		if($b=="3")return "Maret";
		if($b=="4")return "April";
		if($b=="5")return "Mei";if($b=="6")return "Juni";
		if($b=="7")return "Juli";if($b=="8")return "Agustus";
		if($b=="9")return "September";
		if($b=="10")return "Oktober";
		if($b=="11")return "November";
		if($b=="12")return "Desember";
	}
	
	function warna($a){$s=$a%2;if($s==0){$q="#FFFFFF";}else{$q="#ECF5FA";}return $q;}
	
	function bulanrum($bln){
		switch ($bln){
			case 1: 
				return "I";
				break;
			case 2:
				return "II";
				break;
			case 3:
				return "III";
				break;
			case 4:
				return "IV";
				break;
			case 5:
				return "V";
				break;
			case 6:
				return "VI";
				break;
			case 7:
				return "VII";
				break;
			case 8:
				return "VIII";
				break;
			case 9:
				return "IX";
				break;
			case 10:
				return "X";
				break;
			case 11:
				return "XI";
				break;
			case 12:
				return "XII";
				break;
		}
	}
	
	function aliasx($koderuangan){
		switch ($koderuangan){
			case "1.1.2": 
				return "KEU";
				break;
			case "1.2.1":
				return "YMD";
				break;
			case "1.1.3":
				return "LSDK";
				break;
			case "1.1.1":
				return "UMUM";
				break;
			case "1.2.3":
				return "KEPR";
				break;
			case "1.2.2":
				return "PNM";
				break;
		}
	}
	
	
	
?>