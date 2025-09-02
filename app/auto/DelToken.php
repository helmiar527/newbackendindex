<?php
ini_set('memory_limit', '2000M');
$servername = "192.168.1.90";
$username = "devlopment"; // ganti dengan username database Anda
$password = "4X-I4kJ5u(Cr@.t["; // ganti dengan password database Anda
$dbname = "devindex"; // ganti dengan nama database Anda

try {
  // Membuat koneksi menggunakan PDO
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // Mengatur mode error PDO untuk melempar exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  while (true) {
    // Ambil waktu saat ini dalam format yang sesuai
    $currentDateTime = time();

    // Query untuk mengambil data yang akan dihapus
    $selectSql = "SELECT * FROM token WHERE expiry_time < :currentDateTime";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bindParam(':currentDateTime', $currentDateTime);
    $selectStmt->execute();

    // Ambil semua record yang akan dihapus
    $expiredRecords = $selectStmt->fetchAll(PDO::FETCH_ASSOC);

    // Jika ada record yang akan dihapus, tampilkan datanya
    if (count($expiredRecords) > 0) {
      echo "Expired records to be deleted:\n";
      foreach ($expiredRecords as $record) {
        echo "ID: " . $record['id'] . ", Token: " . $record['token'] . ", Expiry Time: " . $record['expiry_time'] . "\n";
      }

      // Query untuk menghapus data yang sudah kedaluwarsa
      $deleteSql = "DELETE FROM token WHERE expiry_time < :currentDateTime";
      $deleteStmt = $conn->prepare($deleteSql);
      $deleteStmt->bindParam(':currentDateTime', $currentDateTime);
      $deleteStmt->execute();

      echo "Expired records deleted successfully\n";
    } else {
      echo "No expired records to delete.\n";
    }

    // Tunggu selama 1 detik sebelum melakukan penghapusan lagi
    sleep(1);
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

// Menutup koneksi (tidak perlu dalam loop infinite, tapi bisa ditambahkan jika ingin keluar dari loop)
$conn = null;
