<?php
	session_start();
	$conn=new mysqli("localhost","admin","sasa0102","siasik");
	//$conn_simpeg = new mysqli("localhost","admin","alam02018sa","kepegx");
	//$conn = new mysqli("192.168.0.200","admin","alam02018sa","demoanggaran");
	
	@error_reporting(E_ALL ^ E_NOTICE);
	@ini_set('display_errors', true);
	@ini_set('html_errors', false);
	@ini_set('error_reporting', E_ALL ^ E_NOTICE);

	include("fungsi.php");
?>