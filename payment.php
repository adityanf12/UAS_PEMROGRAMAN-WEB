<?php
// payment.php (fixed)
// Mencoba baca dari GET sebagai fallback (jika developer mengirim via query string)
$productNameFromGet  = isset($_GET['product']) ? htmlspecialchars($_GET['product']) : '';
$productPriceFromGet = isset($_GET['price']) ? (int)$_GET['price'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment - Perunggu Merchandise</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* minimal style untuk memastikan elemen terlihat */
    .payment-section { padding: 20px; color: #fff; }
    .payment-form { max-width: 700px; margin-bottom: 30px; }
    .order-summary-sidebar { background:#1f1f1f; padding:15px; border-radius:6px; color:#fff; }
  </style>
</head>
<body>

  <section class="payment-section">
    <div class="container">
      <div class="payment-header">
        <h1>Complete Your Checkout</h1>
      </div>

      <div class="payment-layout" style="display:flex; gap:20px; align-items:flex-start;">

        <div class="payment-form-container" style="flex:1;">

            <!-- FORM DIMULAI DI SINI (HARUS ADA SEMUA INPUT DI DALAM) -->
            <form action="process_payment.php" method="POST" class="payment-form" id="paymentForm">

              <!-- Hidden inputs: diisi dari JS (sessionStorage) atau fallback GET (PHP) -->
              <input type="hidden" name="productName" id="hiddenProductName" value="<?php echo $productNameFromGet; ?>">
              <input type="hidden" name="productPrice" id="hiddenProductPrice" value="<?php echo $productPriceFromGet; ?>">

              <div class="form-section">
                <h2>1. Buyer Information</h2>
                <div class="form-group">
                  <label for="buyerName">Full Name *</label>
                  <input type="text" id="buyerName" name="buyerName" required>
                </div>
                <div class="form-row">
                  <div class="form-group">
                    <label for="buyerEmail">Email *</label>
                    <input type="email" id="buyerEmail" name="buyerEmail" required>
                  </div>
                  <div class="form-group">
                    <label for="buyerPhone">Phone Number *</label>
                    <input type="tel" id="buyerPhone" name="buyerPhone" required>
                  </div>
                </div>
              </div>

              <div class="form-section">
                <h2>2. Shipping Address</h2>

                <div class="saved-address-check">
                  <label for="useSavedAddress">
                      <input type="checkbox" id="useSavedAddress" onchange="toggleAddressForm()"> Use Saved Address
                  </label>
                </div>

                <div id="savedAddressDisplay" class="saved-address" style="display: none;">
                    <p id="displayAddress">Loading saved address.</p>
                    <button type="button" class="change-address-btn" onclick="document.getElementById('useSavedAddress').checked=false; toggleAddressForm()">Change Address</button>
                </div>

                <div id="addressFormFields">
                  <div class="form-group">
                    <label for="address">Address *</label>
                    <textarea id="address" name="address" required></textarea>
                  </div>
                  <div class="form-row">
                    <div class="form-group">
                      <label for="city">City *</label>
                      <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                      <label for="province">Province *</label>
                      <input type="text" id="province" name="province" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="postalCode">Postal Code *</label>
                    <input type="text" id="postalCode" name="postalCode" required>
                  </div>

                  <div class="save-address-check">
                    <label for="saveAddress">
                        <input type="checkbox" id="saveAddress"> Save this address for next time
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-section">
                <h2>3. Payment Method</h2>
                <div class="payment-methods">
                  <label class="payment-option">
                    <input type="radio" name="paymentMethod" value="bank_transfer" checked>
                    <div class="payment-card active">
                      <i class="fas fa-university"></i>
                      <span>Bank Transfer</span>
                    </div>
                  </label>

                  <label class="payment-option">
                    <input type="radio" name="paymentMethod" value="credit_card">
                    <div class="payment-card">
                      <i class="fas fa-credit-card"></i>
                      <span>Credit / Debit Card</span>
                    </div>
                  </label>

                  <label class="payment-option">
                    <input type="radio" name="paymentMethod" value="e_wallet">
                    <div class="payment-card">
                      <i class="fas fa-wallet"></i>
                      <span>E-Wallet</span>
                    </div>
                  </label>
                </div>
              </div>

              <button type="submit" class="submit-payment-btn">
                <i class="fas fa-lock"></i> Complete Payment
              </button>
            </form>
        </div>

        <aside class="order-summary-sidebar" style="width:320px;">
          <h3>Order Details</h3>
          <div class="summary-item">
            <span>Product</span>
            <!-- JS akan mengisi element ini -->
            <span id="sidebarProduct"><?php echo $productNameFromGet ?: '-'; ?></span>
          </div>
          <div class="summary-item">
            <span>Price</span>
            <span id="sidebarPrice">
              <?php
                if ($productPriceFromGet > 0) {
                  echo 'Rp ' . number_format($productPriceFromGet, 0, ',', '.');
                } else {
                  echo 'Rp 0';
                }
              ?>
            </span>
          </div>
          <div class="summary-item">
            <span>Shipping</span>
            <span>Rp 15.000</span>
          </div>
          <div class="summary-divider"></div>
          <div class="summary-total">
            <span>Total</span>
            <span id="sidebarTotal">
              <?php
                if ($productPriceFromGet > 0) {
                  echo 'Rp ' . number_format($productPriceFromGet + 15000, 0, ',', '.');
                } else {
                  echo 'Rp 15.000';
                }
              ?>
            </span>
          </div>
          <div class="security-badge" style="margin-top:12px;">
            <i class="fas fa-shield-alt"></i>
            <span>Secure Checkout</span>
          </div>
        </aside>
      </div>
    </div>
  </section>
  <!-- FLOATING ADMIN BUTTON -->
  <a href="admin.php" class="floating-admin-btn" title="Admin Panel">
      🔐
  </a>

  <script src="payment.js"></script>

</body>
</html>
