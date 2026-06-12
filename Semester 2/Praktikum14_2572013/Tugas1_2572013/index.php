<?php
    include_once "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $nama = "John Doe";
    echo "Ini dari PHP.";
    echo "<p>Nama saya adalah $nama.</p>";
    ?>
<h2>Halo, <?php echo $nama;?></h2>
<fieldset>
    <legend>Isian Data </legend>
    <form action="proses.php" method="get">
        <input type="text" name="nama" placeholder="First Name">
        <input type="email" name="email" placeholder="Email">
        <input type="submit" name= "btnSubmit" value="Kirim">
    </form>
    <br>
    <?php
    $keyword = ISSET($_GET['keyword']) ? trim($_GET['keyword']) : '';
    ?>
    <form action="index.php" method="get">
        <input type="text" name="keyword" value="<?= htmlspecialchars($keyword);?>" placeholder="Cari nama...">
        <input type="submit" name= "btnSearch" value="Cari">
    </form>
    <?php
    $msg = isset($_GET['msg']) ? trim($_GET['msg']) : '';
    echo "<span style='color: red;'>$msg</span>";

try {
    // Sesuaikan nama kolom dengan yang ada di phpMyAdmin (user_id dan first_name)
    $sql = "SELECT user_id, first_name, email FROM pengguna";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    if ($keyword != '') {
                $sql = "SELECT user_id, first_name, email FROM pengguna WHERE first_name LIKE :keyword OR email LIKE :keyword";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
            } else {
                $sql = "SELECT user_id, first_name, email FROM pengguna";
                $stmt = $conn->prepare($sql);
            }
            $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<table border='1'><tr><th>ID</th><th>Firstname</th><th>Email</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            // Sesuaikan juga key array di sini
            echo "<td>" . $row['user_id'] . "</td>"; 
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
</body>
</html>
