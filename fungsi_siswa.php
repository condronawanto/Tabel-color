<?php
function data() {
    // Include your database connection file
    include "koneksi.php"; // Make sure this sets up a $pdo PDO instance

    // Get kode from GET and validate it
    $kode = $_GET['kode'] ?? '';

    // Prepare SQL using PDO to prevent SQL injection
    $stmt = $pdo->prepare("SELECT * FROM t_siswa WHERE user_id = :kode");
    $stmt->execute(['kode' => $kode]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return "<p>Data siswa tidak ditemukan.</p>";
    }

    // Set image path
    $file = "../images/siswa/" . $row['user_id'] . ".jpg";
    $gbr = "<img src='../images/noava.jpg' width='130' height='160' id='gambar' >";
    if (file_exists($file)) {
        $gbr = "<img src='../images/siswa/{$row['user_id']}.jpg' width='130' height='160' id='gambar' >";
    }

    // Gender translation
    $kel = $row['kelamin'] === 'P' ? 'Perempuan' : 'Laki-laki';

    // Build output safely
    $data = "<center><br><table width=\"700\" border=\"3\" cellpadding=\"6\" cellspacing=\"3\" bgcolor=\"#00CC00\">
    <tr><td valign=top width=20%>Nama</td><td width=50%>" . htmlspecialchars($row['nama']) . "</td>
    <td rowspan=10 width=20%>$gbr</td></tr>
    <tr><td valign=top>NIM</td><td>" . htmlspecialchars($row['user_id']) . "</td></tr>
    <tr><td valign=top>Kelamin</td><td>$kel</td></tr>
    <tr><td valign=top>Tmp/Tgl Lahir</td><td>" . htmlspecialchars($row['tmp_lahir']) . ", " . htmlspecialchars($row['tgl_lahir']) . "</td></tr>
    <tr><td valign=top>STTB/Tahun masuk</td><td>" . htmlspecialchars($row['sttb']) . "</td></tr>
    <tr><td valign=top>Kelas/alumni</td><td>" . htmlspecialchars($row['kelas']) . "</td></tr>
    <tr><td valign=top>NEM/IPK</td><td>" . htmlspecialchars($row['nem']) . "</td></tr>
    <tr><td valign=top>Agama/nama instansi </td><td>" . htmlspecialchars($row['agama']) . "</td></tr>
    <tr><td valign=top>Pimpinan/Orang tua</td><td>" . htmlspecialchars($row['wali']) . "</td></tr>
    <tr><td valign=top>Alamat Rumah/instansi</td><td>" . nl2br(htmlspecialchars($row['alamat'])) . "<br>Telp. " . htmlspecialchars($row['telp']) . "</td></tr>
    </table></center><br>";

    return $data;
}
?>
