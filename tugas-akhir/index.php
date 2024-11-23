<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simantik Web Data Industri di Kota Batam</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Simantik Web Data Industri di Kota Batam</h1>

        <table id="dataTable" class="display">
            <thead>
                <tr>
                    <!--<th>Jenis Izin Usaha</th>-->
                    <th>Bentuk Usaha</th>
                    <th>Nama Perusahaan</th>
                    <!--<th>NPWP</th>-->
                    <th>Jenis Industri</th>
                    <!--<th>Bidang Usaha</th>-->
                    <th>Alamat</th>
                    <!--<th>L/D</th>-->
                    <th>Nama Kawasan</th>
                    <th>Telepon</th>
                    <th>Fax</th>
                    <!--<th>Tenaga Kerja Laki</th>-->
                    <!--<th>Tenaga Kerja Perempuan</th>-->
                    <th>Total Tenaga Kerja</th>
                    <th>Jenis Penanaman Modal</th>
                    <th>Negara Penanam Modal</th>
                </tr>
                <tr>
                    <!--<th><input type="text" placeholder="Cari Jenis Izin" /></th>-->
                    <th><input type="text" placeholder="Cari Bentuk Usaha" /></th>
                    <th><input type="text" placeholder="Cari Nama Perusahaan" /></th>
                    <!--<th><input type="text" placeholder="Cari NPWP" /></th>-->
                    <th><input type="text" placeholder="Cari Jenis Industri" /></th>
                    <!--<th><input type="text" placeholder="Cari Bidang Usaha" /></th>-->
                    <th><input type="text" placeholder="Cari Alamat" /></th>
                    <!--<th><input type="text" placeholder="Cari L/D" /></th>-->
                    <th><input type="text" placeholder="Cari Nama Kawasan" /></th>
                    <th><input type="text" placeholder="Cari Telepon" /></th>
                    <th><input type="text" placeholder="Cari Fax" /></th>
                    <!--<th><input type="text" placeholder="Cari Tenaga Laki" /></th>-->
                    <!--<th><input type="text" placeholder="Cari Tenaga Perempuan" /></th>-->
                    <th><input type="text" placeholder="Cari Total Tenaga" /></th>
                    <th><input type="text" placeholder="Cari Jenis Modal" /></th>
                    <th><input type="text" placeholder="Cari Negara" /></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ke database
                $conn = new mysqli("localhost", "root", "", "perusahaan");

                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Query pencarian
                $sql = "SELECT * FROM perusahaan";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            
                            <td>" . htmlspecialchars($row['bentuk_usaha']) . "</td>
                            <td>" . htmlspecialchars($row['nama_perusahaan']) . "</td>
                            
                            <td>" . htmlspecialchars($row['jenis_industri']) . "</td>
                            
                            <td>" . htmlspecialchars($row['alamat_perusahaan']) . "</td>
                            
                            <td>" . htmlspecialchars($row['nama_kawasan']) . "</td>
                            <td>" . htmlspecialchars($row['telepon']) . "</td>
                            <td>" . htmlspecialchars($row['fax']) . "</td>
                            
                            <td>" . htmlspecialchars($row['total_tenaga_kerja']) . "</td>
                            <td>" . htmlspecialchars($row['jenis_penanaman_modal']) . "</td>
                            <td>" . htmlspecialchars($row['negara_penanam_modal']) . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='16'>Tidak ada data yang ditemukan.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            // Inisialisasi DataTables
            var table = $('#dataTable').DataTable({
                pageLength: 7,
                lengthMenu: [7, 10, 20, 50],
                orderCellsTop: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });

            // Tambahkan filter pencarian di header kolom
            $('#dataTable thead tr:eq(1) th').each(function (i) {
                $('input', this).on('keyup change', function () {
                    if (table.column(i).search() !== this.value) {
                        table.column(i).search(this.value).draw();
                    }
                });
            });
        });
    </script>
</body>
</html>
