<?php
include_once "koneksi.php";
    $firstname = filter_input(INPUT_GET, 'nama');
    $email = filter_input(INPUT_GET, 'email');
    $btnSubmit = filter_input(INPUT_GET, 'btnSubmit');
    if ($simpan) {
        try {
            $sql = "INSERT INTO MyGuests (firstname, email) VALUES (:firstname, :email)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':firstname' => $firstname,
                ':email' => $email 
            ]);
            echo "New record created successfully";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>