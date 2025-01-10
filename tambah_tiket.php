<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jumlah_tiket = mysqli_real_escape_string($mysqli, $_POST['jumlah_tiket']);
    $status_pembayaran = mysqli_real_escape_string($mysqli, $_POST['status_pembayaran']);
    $tanggal_pembelian = date('Y-m-d'); // Menggunakan tanggal hari ini

    // Menyimpan data pembelian tiket ke database
    $sql = "INSERT INTO tiket_kereta (username, tanggal_pembelian, jumlah_tiket, status_pembayaran) 
            VALUES ('$username', '$tanggal_pembelian', '$jumlah_tiket', '$status_pembayaran')";

    if (mysqli_query($mysqli, $sql)) {
        $message = "Tiket berhasil dibeli!";
    } else {
        $error = "Gagal membeli tiket, coba lagi!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tiket - Pembelian Tiket Kereta</title>
    <style>
        /* Styling untuk form pembelian tiket */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-size: 16px;
            display: block;
            margin-bottom: 8px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-align: center;
            display: inline-block;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #45a049;
        }
        .error, .success {
            color: #f44336;
            text-align: center;
            margin-bottom: 10px;
        }
        .back-link {
            text-align: center;
            margin-top: 10px;
        }
        .back-link a {
            color: #2196F3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Tambah Tiket Kereta</h2>

        <?php
        if (isset($error)) {
            echo "<div class='error'>$error</div>";
        }

        if (isset($message)) {
            echo "<div class='success'>$message</div>";
        }
        ?>

        <form method="POST" action="tambah_tiket.php">
            <label for="jumlah_tiket">Jumlah Tiket:</label>
            <input type="number" name="jumlah_tiket" id="jumlah_tiket" required min="1">

            <label for="status_pembayaran">Status Pembayaran:</label>
            <select name="status_pembayaran" id="status_pembayaran" required>
                <option value="Belum Dibayar">Belum Dibayar</option>
                <option value="Sudah Dibayar">Sudah Dibayar</option>
            </select>

            <button type="submit" class="button">Beli Tiket</button>
        </form>

        <div class="back-link">
            <p><a href="index.php">Kembali ke Halaman Utama</a></p>
        </div>
    </div>

</body>
</html>
