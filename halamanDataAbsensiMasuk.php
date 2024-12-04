<?php 
include("connect.php");

// Query untuk mengambil data dari tabel kedatangan dan pegawai menggunakan INNER JOIN
$query = "
    SELECT 
        kedatangan.kedatangan_id,
        pegawai.nip,
        pegawai.nama,
        pegawai.jabatan,
        kedatangan.waktu_kedatangan
    FROM kedatangan
    INNER JOIN pegawai ON kedatangan.pegawai_id = pegawai.id
    ORDER BY kedatangan.waktu_kedatangan ASC
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Data Absensi Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="assets/css/generalStyle.css">
</head>
<body>
<header>
    <div class="offcanvas-lg offcanvas-start sidebar bg-white shadow" tabindex="1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header d-lg-none">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group list-group-flush ms-4 mt-lg-4">
                <a href="halamanDashboard.php" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="bi bi-speedometer me-3"></i><span>Dashboard</span>
                </a>
                <a href="halamanDataKaryawan.php" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="bi bi-people-fill me-3"></i><span>Data Karyawan</span>
                </a>
                <a href="halamanTambahDataPegawai.php" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="bi bi-person-add me-3"></i><span>Tambah Karyawan</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action py-2 ripple active" aria-current="true">
                    <i class="bi bi-person-fill-up me-3"></i><span>Data Absensi Masuk</span>
                </a>
                <a href="halamanDataAbsensiKeluar.php" class="list-group-item list-group-item-action py-2 ripple">
                    <i class="bi bi-person-fill-down me-3"></i><span>Data Absensi Keluar</span>
                </a>
                <a href="#" style="text-decoration:none;" class="d-grid gap-2 col-10 mx-auto mt-5">
                    <button class="btn btn-danger text-light" type="button">Log Out</button>
                </a>
            </div>
        </div>
    </div>
    <nav class="navbar bg-primary navbar-dark nav-top fixed-top shadow-sm">
        <div class="container-fluid">
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">
                <img src="assets/img/mainIcon.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-center">
                Smart Office
            </a>
        </div>
    </nav>
</header>
<div id="main">
    <div class="page-heading mb-4">
        <h1>Data Absensi Masuk</h1>
    </div>
    <div class="page-content">
        <!-- Bagian Tabel -->
<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">No</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Waktu Kedatangan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Cek apakah ada data dalam hasil query
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        // Loop untuk menampilkan data jika ada
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <th scope="row"><?php echo $no++; ?></th>
                                <td><?php echo $row['nip']; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['jabatan']; ?></td>
                                <td><?php echo $row['waktu_kedatangan']; ?></td>
                                <td class="d-flex gap-2">
                                    <a href="#" style="text-decoration:none">
                                        <button type="button" class="btn btn-outline-primary"><i class="bi bi-list-columns-reverse me-2"></i>Lihat</button>
                                    </a>
                                </td>
                            </tr>
                        <?php } 
                    } else { 
                        // Jika tidak ada data, tampilkan pesan
                        ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data absensi masuk</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
