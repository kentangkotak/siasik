SELECT sum(total) as awal,sum(kepake) as kepake,sum(sisa) as sisa from(
select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,total,nousulan,idpp,itembelanja,
						kepake,sisa
						from(
								  select notrans,kodekegiatan,kegiatanblud,koderek50,uraian50,koderek108,uraian108,usulan,jumlahacc,satuan,harga,total,nousulan,idpp,itembelanja,
								  round(sum(totalkepake),2) as kepake,round(total-sum(totalkepake),2) as sisa
								  from(
											select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
											penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
											penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
											penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.jumlahacc as jumlahacc,penyesesuaianperioritas_rinci.satuan as satuan,
											penyesesuaianperioritas_rinci.harga as harga,penyesesuaianperioritas_rinci.nilai as total,penyesesuaianperioritas_rinci.nousulan as nousulan,
											penyesesuaianperioritas_rinci.id as idpp,penyesesuaianperioritas_rinci.usulan as itembelanja,'' as totalkepake
											from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
											where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
											and penyesesuaianperioritas_rinci.kunci=''
											and year(penyesesuaianperioritas_heder.tgltrans)='2021'
											union all
											select '' as notrans,spjpanjar_heder.kodekegiatanblud as kodekegiatan,'' as kegiatanblud,
											'' as koderek50,'' as uraian50,
											'' as koderek108,'' as uraian108,
											'' as usulan,'' as jumlahacc,'' as satuan,
											'' as harga,'' as total,'' as nousulan,
											'' as idpp,spjpanjar_rinci.itembelanja as itembelanja,spjpanjar_rinci.jumlahbelanjapanjar as totalkepake 
											from spjpanjar_heder,spjpanjar_rinci 
											where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar 
											and spjpanjar_heder.verif=1 and year(spjpanjar_heder.tglspjpanjar)='2021'
											union all
											select '' as notrans,npkls_rinci.kodekegiatanblud as kodekegiatan,'' as kegiatanblud,
											'' as koderek50,'' as uraian50,
											'' as koderek108,'' as uraian108,
											'' as usulan,'' as jumlahacc,'' as satuan,
											'' as harga,'' as total,'' as nousulan,
											'' as idpp,npdls_rinci.itembelanja as itembelanja,sum(npkls_rinci.total) as total 
                                            from npkls_heder,npkls_rinci,npdls_rinci,npdls_heder
                                            where npkls_heder.nopencairan=npkls_rinci.nopencairan and 
                                            npdls_rinci.nonpdls=npdls_heder.nonpdls and npdls_heder.nonpdls=npkls_heder.nonpdls 
											and
                                            npkls_rinci.nopencairan<>'' and year(npkls_heder.tglpencairan)='2021'
                                            group by npkls_heder.nopencairan,npdls_rinci.itembelanja
											
											) as wew 
								  group by kodekegiatan,itembelanja)
						as xxx)xxxxxxxx