<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "perusahaan";

$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil parameter pencarian dari form
$nama_perusahaan = isset($_GET['nama_perusahaan']) ? $_GET['nama_perusahaan'] : '';
$jenis_industri = isset($_GET['jenis_industri']) ? $_GET['jenis_industri'] : '';
$negara_penanam_modal = isset($_GET['negara_penanam_modal']) ? $_GET['negara_penanam_modal'] : '';

// Query untuk pencarian
$sql = "SELECT * FROM perusahaan WHERE 1=1";

if (!empty($nama_perusahaan)) {
    $sql .= " AND nama_perusahaan LIKE '%" . $conn->real_escape_string($nama_perusahaan) . "%'";
}
if (!empty($jenis_industri)) {
    $sql .= " AND jenis_industri LIKE '%" . $conn->real_escape_string($jenis_industri) . "%'";
}
if (!empty($negara_penanam_modal)) {
    $sql .= " AND negara_penanam_modal LIKE '%" . $conn->real_escape_string($negara_penanam_modal) . "%'";
}

// Eksekusi query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Data Simantik Web Data Industri di Kota Batam</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Hasil Pencarian</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Jenis Izin Usaha</th>
                        <th>Bentuk Usaha</th>
                        <th>Nama Perusahaan</th>
                        <th>NPWP</th>
                        <th>Jenis Industri</th>
                        <th>Bidang Usaha</th>
                        <th>Alamat</th>
                        <th>L/D</th>
                        <th>Nama Kawasan</th>
                        <th>Telepon</th>
                        <th>Fax</th>
                        <th>Tenaga Kerja Laki</th>
                        <th>Tenaga Kerja Perempuan</th>
                        <th>Total Tenaga Kerja</th>
                        <th>Jenis Penanaman Modal</th>
                        <th>Negara Penanam Modal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['jenis_izin_usaha']) ?></td>
                            <td><?= htmlspecialchars($row['bentuk_usaha']) ?></td>
                            <td><?= htmlspecialchars($row['nama_perusahaan']) ?></td>
                            <td><?= htmlspecialchars($row['npwp_perusahaan']) ?></td>
                            <td><?= htmlspecialchars($row['jenis_industri']) ?></td>
                            <td><?= htmlspecialchars($row['bidang_usaha']) ?></td>
                            <td><?= htmlspecialchars($row['alamat_perusahaan']) ?></td>
                            <td><?= htmlspecialchars($row['ld']) ?></td>
                            <td><?= htmlspecialchars($row['nama_kawasan']) ?></td>
                            <td><?= htmlspecialchars($row['telepon']) ?></td>
                            <td><?= htmlspecialchars($row['fax']) ?></td>
                            <td><?= htmlspecialchars($row['tenaga_kerja_laki']) ?></td>
                            <td><?= htmlspecialchars($row['tenaga_kerja_perempuan']) ?></td>
                            <td><?= htmlspecialchars($row['total_tenaga_kerja']) ?></td>
                            <td><?= htmlspecialchars($row['jenis_penanaman_modal']) ?></td>
                            <td><?= htmlspecialchars($row['negara_penanam_modal']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Tidak ada data yang ditemukan.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
