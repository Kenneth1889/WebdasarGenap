<?php
// [NRP] - [Nama]
session_start();

// Fitur Logout: Jika mendeteksi ?action=logout di URL, hancurkan session
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Proteksi Halaman: Mencegah akses langsung ke dashboard jika belum login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - 2572013</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="alert alert-success d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></h4>
                </div>
                <p class="card-text">Anda telah berhasil login dan masuk ke halaman dashboard.</p>
                
                <a href="dashboard.php?action=logout" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>