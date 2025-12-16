<?php
include "koneksi.php";
session_start();

// ============================================
// SISTEM LOGIN ADMIN
// ============================================

// Logout handler
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Login handler
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // GANTI USERNAME DAN PASSWORD SESUAI KEINGINAN ANDA
    $admin_username = "admin";
    $admin_password = "perunggu2025"; // Ganti password ini!
    
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['login_time'] = time();
        header("Location: admin.php");
        exit;
    } else {
        $login_error = "Username atau password salah!";
    }
}

// ============================================
// CEK LOGIN - WAJIB LOGIN SETIAP AKSES
// ============================================
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - Perunggu</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <style>
            body {
                background: linear-gradient(135deg, #1a1a1a 0%, #262c26 100%);
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
                font-family: 'Raleway', Arial, sans-serif;
            }
            
            .login-container {
                background-color: rgba(34, 34, 34, 0.95);
                padding: 50px 40px;
                border-radius: 15px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
                width: 100%;
                max-width: 400px;
                text-align: center;
                border: 2px solid #E0FBAB;
            }
            
            .login-logo {
                font-size: 3em;
                color: #E0FBAB;
                margin-bottom: 20px;
            }
            
            .login-container h2 {
                color: #E0FBAB;
                margin-bottom: 10px;
                font-size: 2em;
            }
            
            .login-container p {
                color: #ccc;
                margin-bottom: 30px;
                font-size: 0.9em;
            }
            
            .form-group {
                margin-bottom: 25px;
                text-align: left;
            }
            
            .form-group label {
                display: block;
                color: #fff;
                margin-bottom: 8px;
                font-weight: bold;
                font-size: 0.9em;
            }
            
            .form-group input {
                width: 100%;
                padding: 15px;
                background-color: rgba(255, 255, 255, 0.1);
                border: 1px solid #444;
                border-radius: 8px;
                color: #fff;
                font-size: 1em;
                transition: all 0.3s;
            }
            
            .form-group input:focus {
                outline: none;
                border-color: #E0FBAB;
                background-color: rgba(255, 255, 255, 0.15);
            }
            
            .login-btn {
                width: 100%;
                padding: 15px;
                background-color: #E0FBAB;
                color: #222;
                border: none;
                border-radius: 8px;
                font-size: 1.1em;
                font-weight: bold;
                cursor: pointer;
                transition: all 0.3s;
                margin-top: 10px;
            }
            
            .login-btn:hover {
                background-color: #d0eb9b;
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(224, 251, 171, 0.3);
            }
            
            .login-btn:active {
                transform: translateY(0);
            }
            
            .error-message {
                background-color: rgba(231, 76, 60, 0.2);
                color: #e74c3c;
                padding: 12px;
                border-radius: 8px;
                margin-bottom: 20px;
                border-left: 4px solid #e74c3c;
                text-align: left;
                font-size: 0.9em;
            }
            
            .back-link {
                display: inline-block;
                margin-top: 20px;
                color: #E0FBAB;
                text-decoration: none;
                font-size: 0.9em;
                transition: all 0.3s;
            }
            
            .back-link:hover {
                color: #d0eb9b;
            }
            
            .security-note {
                margin-top: 30px;
                padding-top: 20px;
                border-top: 1px solid #444;
                color: #999;
                font-size: 0.8em;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-logo">🔐</div>
            <h2>Admin Panel</h2>
            <p>Masukkan kredensial untuk mengakses</p>
            
            <?php if (isset($login_error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?= $login_error ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                </div>
                
                <button type="submit" name="login" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> LOGIN
                </button>
            </form>
            
            <a href="index.php" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Website
            </a>
            
            <div class="security-note">
                <i class="fas fa-shield-alt"></i> Halaman ini dilindungi
            </div>
        </div>
    </body>
    </html>
    <?php
    exit; // Stop execution jika belum login
}

// ============================================
// AUTO LOGOUT SETELAH 30 MENIT TIDAK AKTIF
// ============================================
$timeout_duration = 1800; // 30 menit (dalam detik)

if (isset($_SESSION['login_time'])) {
    $elapsed_time = time() - $_SESSION['login_time'];
    if ($elapsed_time > $timeout_duration) {
        session_destroy();
        header("Location: admin.php?timeout=1");
        exit;
    }
}
$_SESSION['login_time'] = time(); // Update waktu terakhir aktif

// ============================================
// CRUD MERCHANDISE
// ============================================
if (isset($_POST['add_merch'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga = (int)$_POST['harga'];
    $gambar = mysqli_real_escape_string($conn, $_POST['gambar']);
    
    mysqli_query($conn, "INSERT INTO merchandise (nama, deskripsi, harga, gambar) VALUES ('$nama', '$deskripsi', $harga, '$gambar')");
    header("Location: admin.php?success=add_merch");
    exit;
}

if (isset($_GET['delete_merch'])) {
    $id = (int)$_GET['delete_merch'];
    mysqli_query($conn, "DELETE FROM merchandise WHERE id = $id");
    header("Location: admin.php?success=delete_merch");
    exit;
}

// ============================================
// CRUD CONTACT MESSAGES
// ============================================
if (isset($_GET['delete_contact'])) {
    $id = (int)$_GET['delete_contact'];
    mysqli_query($conn, "DELETE FROM contact WHERE id = $id");
    header("Location: admin.php?success=delete_contact");
    exit;
}

$merch_query = mysqli_query($conn, "SELECT * FROM merchandise");
$contact_query = mysqli_query($conn, "SELECT * FROM contact ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Perunggu</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            padding: 20px;
            background: #1a1a1a;
            color: #fff;
            font-family: 'Raleway', Arial, sans-serif;
        }
        
        .admin-header {
            background: linear-gradient(135deg, #222 0%, #262c26 100%);
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px solid #E0FBAB;
        }
        
        .admin-header h1 {
            color: #E0FBAB;
            margin: 0;
            font-size: 2.5em;
        }
        
        .admin-info {
            text-align: right;
        }
        
        .admin-info p {
            margin: 5px 0;
            color: #ccc;
            font-size: 0.9em;
        }
        
        .logout-btn {
            background-color: #e74c3c;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background-color: #c0392b;
            transform: translateY(-2px);
        }
        
        .back-website {
            background-color: #E0FBAB;
            color: #222;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            font-weight: bold;
            transition: all 0.3s;
        }
        
        .back-website:hover {
            background-color: #d0eb9b;
            transform: translateY(-2px);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #222;
            border-radius: 8px;
            overflow: hidden;
        }
        
        th, td {
            border: 1px solid #333;
            padding: 12px;
            text-align: left;
        }
        
        th {
            background: #E0FBAB;
            color: #000;
            font-weight: bold;
        }
        
        tr:hover {
            background-color: #2a2a2a;
        }
        
        .btn {
            padding: 8px 15px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            font-size: 0.9em;
        }
        
        .btn-delete {
            background: #e74c3c;
            color: #fff;
            border: none;
        }
        
        .btn-delete:hover {
            background: #c0392b;
        }
        
        .form-section {
            background: #222;
            padding: 25px;
            margin: 20px 0;
            border-radius: 8px;
            border: 1px solid #E0FBAB;
        }
        
        .form-section h2 {
            color: #E0FBAB;
            margin-bottom: 20px;
        }
        
        .form-section input,
        .form-section textarea {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #444;
            border-radius: 5px;
            color: #fff;
            font-size: 1em;
        }
        
        .form-section input:focus,
        .form-section textarea:focus {
            outline: none;
            border-color: #E0FBAB;
        }
        
        .form-section button {
            background-color: #E0FBAB;
            color: #222;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1em;
            margin-top: 10px;
            transition: all 0.3s;
        }
        
        .form-section button:hover {
            background-color: #d0eb9b;
            transform: translateY(-2px);
        }
        
        .success-message {
            background-color: rgba(46, 204, 113, 0.2);
            color: #2ecc71;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #2ecc71;
        }
        
        .section-title {
            color: #E0FBAB;
            font-size: 2em;
            margin: 40px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #E0FBAB;
        }
    </style>
</head>
<body>

    <div class="admin-header">
        <div>
            <h1><i class="fas fa-user-shield"></i> Admin Panel</h1>
            <p style="color: #ccc; margin: 10px 0 0 0;">Kelola konten website Perunggu</p>
        </div>
        <div class="admin-info">
            <p><i class="fas fa-user"></i> <strong><?= $_SESSION['admin_username'] ?></strong></p>
            <p><i class="fas fa-clock"></i> Login: <?= date('d/m/Y H:i', $_SESSION['login_time']) ?></p>
            <a href="index.php" class="back-website"><i class="fas fa-home"></i> Ke Website</a>
            <a href="?logout=1" class="logout-btn" onclick="return confirm('Yakin ingin logout?')">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="success-message">
            <i class="fas fa-check-circle"></i> 
            <?php
            switch($_GET['success']) {
                case 'add_merch': echo 'Merchandise berhasil ditambahkan!'; break;
                case 'delete_merch': echo 'Merchandise berhasil dihapus!'; break;
                case 'delete_contact': echo 'Pesan berhasil dihapus!'; break;
            }
            ?>
        </div>
    <?php endif; ?>

    <!-- ADD MERCHANDISE FORM -->
    <div class="form-section">
        <h2><i class="fas fa-plus-circle"></i> Tambah Merchandise Baru</h2>
        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Produk" required>
            <textarea name="deskripsi" placeholder="Deskripsi Produk" rows="4" required></textarea>
            <input type="number" name="harga" placeholder="Harga (Rp)" required>
            <input type="text" name="gambar" placeholder="URL Gambar Produk" required>
            <button type="submit" name="add_merch">
                <i class="fas fa-save"></i> Tambah Produk
            </button>
        </form>
    </div>

    <!-- MERCHANDISE TABLE -->
    <h2 class="section-title"><i class="fas fa-shopping-bag"></i> Kelola Merchandise</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($merch_query)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nama']) ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td><?= htmlspecialchars(substr($row['deskripsi'], 0, 50)) ?>...</td>
            <td>
                <a href="?delete_merch=<?= $row['id'] ?>" 
                   class="btn btn-delete" 
                   onclick="return confirm('Hapus produk ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <!-- CONTACT MESSAGES TABLE -->
    <h2 class="section-title"><i class="fas fa-envelope"></i> Pesan dari Contact Form</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Pesan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($contact_query)): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars(substr($row['message'], 0, 100)) ?>...</td>
            <td>
                <a href="?delete_contact=<?= $row['id'] ?>" 
                   class="btn btn-delete" 
                   onclick="return confirm('Hapus pesan ini?')">
                    <i class="fas fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>