<?php 
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Metode tidak diizinkan.";
    exit;
}

// Ambil & sanitasikan
$productName   = mysqli_real_escape_string($conn, $_POST['productName'] ?? '');
$productPrice  = (int)($_POST['productPrice'] ?? 0);
$buyerName     = mysqli_real_escape_string($conn, $_POST['buyerName'] ?? '');
$buyerEmail    = mysqli_real_escape_string($conn, $_POST['buyerEmail'] ?? '');
$buyerPhone    = mysqli_real_escape_string($conn, $_POST['buyerPhone'] ?? '');
$address       = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
$city          = mysqli_real_escape_string($conn, $_POST['city'] ?? '');
$province      = mysqli_real_escape_string($conn, $_POST['province'] ?? '');
$postalCode    = mysqli_real_escape_string($conn, $_POST['postalCode'] ?? '');
$paymentMethod = mysqli_real_escape_string($conn, $_POST['paymentMethod'] ?? 'bank_transfer');

// Validasi wajib
if (
    $productName === '' ||
    $productPrice <= 0 ||
    $buyerName === '' ||
    $buyerEmail === '' ||
    $buyerPhone === '' ||
    $address === '' ||
    $city === '' ||
    $province === '' ||
    $postalCode === ''
) {
    echo "Data belum lengkap. Silakan isi semua field wajib.";
    exit;
}

// hitung total
$shipping = 15000;
$total    = $productPrice + $shipping;

// simpan
$sql = "INSERT INTO orders
        (`product`, `price`, `name`, `email`, `phone`, `address`, `city`, `province`, `postal_code`, `payment_method`, `total`)
        VALUES
        ('$productName', $productPrice, '$buyerName', '$buyerEmail', '$buyerPhone',
         '$address', '$city', '$province', '$postalCode', '$paymentMethod', $total)";

if (mysqli_query($conn, $sql)) {
    header("Location: success.php");
    exit;
} else {
    echo "Gagal menyimpan pesanan: " . mysqli_error($conn);
    exit;
}
?>
