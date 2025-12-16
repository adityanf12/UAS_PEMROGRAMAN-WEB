<?php
include "koneksi.php";
$notif = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $message = mysqli_real_escape_string($conn, $_POST['message'] ?? '');

    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        $notif = "success";
    } else {
        $notif = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HI WE ARE PERUNGGU | Contact</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<script>
// NOTIFIKASI SHOW BANNER
function showContactNotification(message, type) {
    const oldNotif = document.querySelector('.notification-banner');
    if (oldNotif) oldNotif.remove();

    const notif = document.createElement('div');
    notif.className = 'notification-banner';
    notif.innerHTML = message;

    Object.assign(notif.style, {
        position: 'fixed',
        top: '0',
        left: '0',
        right: '0',
        width: '100%',
        padding: '15px',
        textAlign: 'center',
        fontSize: '17px',
        fontWeight: 'bold',
        color: 'white',
        zIndex: '999999',
        backgroundColor: type === 'success' ? '#1db954' : '#e74c3c',
        transform: 'translateY(-100%)',
        transition: 'transform 0.35s ease-out',
        boxShadow: '0 2px 8px rgba(0,0,0,0.3)'
    });

    document.body.appendChild(notif);

    setTimeout(() => {
        notif.style.transform = 'translateY(0)';
    }, 10);

    setTimeout(() => {
        notif.style.transform = 'translateY(-100%)';
        setTimeout(() => notif.remove(), 400);
    }, 2500);
}
</script>

<body>
    <header class="main-header">
        <nav class="navbar">
            <div class="logo">WE ARE PERUNGGU</div>
            <ul class="nav-links">
                <li><a href="index.php">HOME</a></li>
                <li><a href="theband.php">THE BAND</a></li>
                <li><a href="listen.php">LISTEN</a></li>
                <li><a href="merchandise.php">BUY MERCH</a></li>
                <li><a href="contact.php" class="active">CONTACT</a></li>
            </ul>
            <div class="social-icons">
                <a href="https://www.instagram.com/perunggu_?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="icon ig"><i class="fab fa-instagram"></i></a>
                <a href="ttps://www.youtube.com/@PerungguOfficial" target="_blank" class="icon yt"><i class="fab fa-youtube"></i></a>
                <a href="https://open.spotify.com/artist/0NbKRRBuiIUwS9irPvi7wD?si=W0YegVl7RdCfTFhwHvmtzg" target="_blank" class="icon sp"><i class="fab fa-spotify"></i></a>
            </div>
        </nav>
    </header>

    <section class="contact-section">
        <div class="container">
            <div class="contact-intro">
                <h1>CONTACT US</h1>
                <p>Punya pertanyaan atau ingin berkolaborasi? Kirim pesan kepada kami dan kami akan segera menghubungi Anda kembali.</p>
            </div>

            <div class="contact-content">
                <div class="contact-form-wrapper">
                    <h2>Send us a Message</h2>

                    <form class="contact-form"
                          id="contactForm"
                          action=""
                          method="POST">

                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   placeholder="Masukkan nama Anda"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   placeholder="Masukkan email Anda"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message"
                                      name="message"
                                      rows="6"
                                      placeholder="Tulis pesan Anda di sini..."
                                      required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">SEND MESSAGE</button>
                    </form>
                </div>

                <div class="contact-info-wrapper">
                    <h2>Get in Touch</h2>
                    <div class="contact-info">
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email</h4>
                                <p><a href="mailto:info@perunggu.com">info@perunggu.com</a></p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h4>Phone</h4>
                                <p>028-740-7980</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Location</h4>
                                <p>Jakarta, Indonesia</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-media-contact">
                        <h3>Follow Us</h3>
                        <div class="social-links">
                            <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="https://spotify.com" target="_blank"><i class="fab fa-spotify"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="footer-content-layout">
            <div class="booking-area full-width-right">
                <h4>Management & Booking</h4>
                <p>Email: <a href="mailto:info@perunggu.com">info@perunggu.com</a></p>
                <p>Phone: 028-740-7980</p>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="footer">
            &copy; 2025 by Perunggu.
        </div>
    </footer>

<?php if ($notif === "success"): ?>
<script>
    showContactNotification("✔ Pesan berhasil dikirim!", "success");
</script>
<?php endif; ?>

<?php if ($notif === "error"): ?>
<script>
    showContactNotification("❌ Gagal menyimpan pesan!", "error");
</script>
<?php endif; ?>
<!-- FLOATING ADMIN BUTTON -->
<a href="admin.php" class="floating-admin-btn" title="Admin Panel">
    🔐
</a>

</body>
</html>
