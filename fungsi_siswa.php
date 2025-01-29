data() {
include"koneksi.php";
$kode=$_GET['kode'];
	$sql="select * from t_siswa where user_id='".mysql_real_escape_string($kode)."'";
	if(!$query=mysql_query($sql)) die ("Pengambilan gagal1 profil");
	$row=mysql_fetch_array($query);

		$file ="../images/siswa/".$row[user_id].".jpg";
		$gbr="<img src='../images/noava.jpg' width='130' height='160' id='gambar' >";
		if (file_exists($file)) {
	        $gbr="<img src='../images/siswa/$row[user_id].jpg' width='130' height='160' id='gambar' >";
		}
		if ($row[kelamin]=='P') $kel='Perempuan';
		else $kel='Laki-laki';

	$data .="<center><br><table width=\"700\" border=\"3\"cellpadding=\"6\" cellspacing=\"3\" bgcolor=\"#00CC00\">
	<tr><td  valign=top width=20%>Nama</td><td width=50%>$row[nama]</td>
	<td rowspan=10 width=20%>$gbr</td></tr>
	<tr><td  valign=top>NIM</td><td>$row[user_id]</td></tr>  
	<tr><td  valign=top>Kelamin</td><td>$kel</td></tr>
	<tr><td  valign=top>Tmp/Tgl Lahir</td><td>$row[tmp_lahir],$row[tgl_lahir]</td></tr>
	<tr><td  valign=top>STTB/Tahun masuk</td><td>$row[sttb]</td></tr>
	<tr><td  valign=top>Kelas/alumni</td><td>$row[kelas]</td></tr>
	<tr><td  valign=top>NEM/IPK</td><td>$row[nem]</td></tr>
	<tr><td  valign=top>Agama/nama instansi </td><td>$row[agama]</td></tr>
	<tr><td  valign=top>Pimpinan/Orang tua</td><td>$row[wali]</td></tr>
	<tr><td  valign=top>Alamat Rumah/instansi</td><td >$row[alamat]<br>Telp.$row[telp]</td></tr>
	</table></center><br>";

return $data;
}


