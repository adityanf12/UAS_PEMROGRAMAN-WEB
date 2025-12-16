<?php
// merchandise.php
include "koneksi.php";

// Ambil data merchandise
$query = mysqli_query($conn, "SELECT * FROM merchandise");

if (!$query) {
    die("Query error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Merchandise Store</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    body {
      background-image: none !important;
      background-color: #262c26 !important;
    }
  </style>
</head>
<body>
  <header class="header">
    <h1 class="title">Merchandise Store</h1>

    <div class="social-icons">
      <a href="https://www.instagram.com/perunggu_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="icon ig">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="https://www.youtube.com/@PerungguOfficial" target="_blank" class="icon yt">
        <i class="fab fa-youtube"></i>
      </a>
      <a href="https://open.spotify.com/artist/0NbKRRBuiIUwS9irPvi7wD?si=W0YegVl7RdCfTFhwHvmtzg" target="_blank" class="icon sp">
        <i class="fab fa-spotify"></i>
      </a>
    </div>
  </header>

  <section class="products">
    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
      <div class="product-card">
        <img class="product-img"
             src="<?php echo htmlspecialchars($row['gambar']); ?>"
             alt="<?php echo htmlspecialchars($row['nama']); ?>" />

        <h3 class="product-name">
          <?php echo htmlspecialchars($row['nama']); ?>
        </h3>

        <p class="product-desc">
          <?php echo htmlspecialchars($row['deskripsi']); ?>
        </p>

        <p class="product-price">
          Rp <?php echo number_format((int)$row['harga'], 0, ',', '.'); ?>
        </p>

        <button class="buy-btn"
          onclick="buyProduct(
            '<?php echo addslashes($row['nama']); ?>',
            <?php echo (int)$row['harga']; ?>
          )">
          Buy Now
        </button>
      </div>
    <?php } ?>
  </section>

  <footer>
    <p>© 2025 Merchandise Store</p>
  </footer>

  <!-- FLOATING ADMIN BUTTON -->
    <a href="admin.php" class="floating-admin-btn" title="Admin Panel">
        🔐
    </a>

  <script>
    function buyProduct(productName, price) {
      // Simpan ke sessionStorage supaya payment.php bisa ambil
      sessionStorage.setItem('productName', productName);
      sessionStorage.setItem('productPrice', price);
      // Arahkan ke halaman payment.php
      window.location.href = 'payment.php';
    }
  </script>
</body>
</html>
