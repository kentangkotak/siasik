<?php include "../../conn.php";?>
<?php
	//if (!isset($_REQUEST['term'])) exit;
	$sql=$conn->query("select pegawai.nip as nip,pegawai.nama as nama,pegawai.bagian as koderuangan,m_bagian.namabagian as ruangan,pegawai.kategoripegawai as kategoripegawai,
							  m_kategori_peg.namakategoripeg as namakategori,m_kategori_peg.namakategoripeg as kategori,pegawai.jabatan as kodejabatan,m_jabatan.jabatan as jabatan,
						pegawai.pendidikan as kodependidikan,
						m_pendidikan.keterangan as pendidikan,pegawai.golruang as kodegolruang,m_golruang.golruang as golruang,pegawai.flag as kodestatpegawai,m_jenispegawai.jenispegawai as jenispegawai
						from pegawai,m_kategori_peg,m_jabatan,m_pendidikan,m_golruang,m_jenispegawai,m_bagian
						where pegawai.aktif='AKTIF' and pegawai.bagian=m_bagian.kodebagian and pegawai.jabatan=m_jabatan.kode_jabatan and m_kategori_peg.kodekategoripeg=pegawai.kategoripegawai 
						and pegawai.pendidikan=m_pendidikan.kode and pegawai.golruang=m_golruang.kode_gol and pegawai.flag=m_jenispegawai.kode_jenis and pegawai.nip like '%".$_GET['query']."%' order by pegawai.nip");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => $rs->nip .' || '.$rs->nama ,
				'data' => $rs->nip,
				'nama' => $rs->nama,
				'koderuangan' => $rs->koderuangan,
				'ruangan' => $rs->ruangan,
				'kategoripegawai' => $rs->kategoripegawai,
				'namakategori' => $rs->namakategori,
				'kodejabatan' => $rs->kodejabatan,
				'jabatan' => $rs->jabatan,
				'kodependidikan' => $rs->kodependidikan,
				'pendidikan' => $rs->pendidikan,
				'kodegolruang' => $rs->kodegolruang,
				'golruang' => $rs->golruang,
				'kodestatpegawai' => $rs->namakategori,
				'jenispegawai' => $rs->jenispegawai,
			);
		}
	}

	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>