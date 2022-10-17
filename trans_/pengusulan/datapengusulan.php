<?php include("../../conn.php"); ?>
<?php
	$conn_musrenbang = new mysqli("localhost","admin","alam02018sa","musrenbang");

	$sql=$conn_musrenbang->query("select rs4.rs1 as kode,rs2.rs2 as jenisusulan,rs3.rs2 as ruangan,rs4.rs3 as tahun,rs4.rs6 as verif
					   from rs2,rs3,rs4 
					   where rs4.rs2=rs3.rs1 and rs2.rs1=rs4.rs5 and (rs4.rs3=year(now())+1 or rs4.rs3=year(now())) order by rs4.rs1 desc");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>JENIS USULAN </th>
				<th>RUANGAN</th>
				<th>TAHUN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->kode; ?></td>
				<td><?php echo $rs->jenisusulan; ?></td>
				<td><?php echo $rs->ruangan; ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<td><a href="javascript:void(0)" onclick="viewrinci('<?php echo $rs->kode; ?>','<?php echo $i ?>')"class="btn btn-primary btn-xs"><i class="fa fa-folder" ></i> View </a></a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>