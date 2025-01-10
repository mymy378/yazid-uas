<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$result = mysqli_query($mysqli, "SELECT * FROM tiket_kereta WHERE username = '$username' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama - Pembelian Tiket Kereta</title>
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 10px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .logout-link {
            text-align: right;
            margin-bottom: 20px;
        }

        .logout-link a {
            color: #f44336;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-link a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td {
            font-size: 14px;
        }

        .table-container {
            overflow-x: auto;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Selamat datang, <?php echo $username; ?>!</h1>
        <div class="logout-link">
            <a href="logout.php">Logout</a>
        </div>

        <h2>Daftar Tiket Kereta</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pembelian</th>
                    <th>Jumlah Tiket</th>
                    <th>Status Pembayaran</th>
                </tr>
                <?php
                $i = 1;
                while ($tiket = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>$i</td>";
                    echo "<td>" . $tiket['tanggal_pembelian'] . "</td>";
                    echo "<td>" . $tiket['jumlah_tiket'] . "</td>";
                    echo "<td>" . $tiket['status_pembayaran'] . "</td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </table>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Pembelian Tiket Kereta - Semua Hak Dilindungi</p>
    </div>

</body>
</html>
