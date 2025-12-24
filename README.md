# UAS_PEMROGRAMAN-WEB
# 🎸 Perunggu Band Official Website

Website resmi band Perunggu - Platform digital untuk menampilkan musik, merchandise, dan informasi band asal Indonesia.

## 📋 Deskripsi

Website ini merupakan platform lengkap untuk band Perunggu yang mencakup informasi band, streaming musik, toko merchandise, sistem pembayaran, dan formulir kontak. Dilengkapi dengan panel admin untuk mengelola konten secara dinamis.

## ✨ Fitur Utama

### 🎵 Frontend Features
- **Home Page** - Landing page dengan hero section yang menarik
- **The Band** - Profil lengkap personil band dengan foto dan bio
- **Listen** - Player musik dengan tracklist album dan link ke platform streaming
- **Merchandise Store** - Katalog produk merchandise dengan sistem pembelian
- **Payment System** - Halaman checkout lengkap dengan form pengiriman
- **Contact Form** - Formulir kontak dengan notifikasi real-time

### 🔐 Admin Panel
- **Secure Login System** - Autentikasi dengan username dan password
- **Auto Logout** - Otomatis logout setelah 30 menit tidak aktif
- **CRUD Merchandise** - Kelola produk merchandise (tambah, hapus)
- **Manage Messages** - Kelola pesan dari contact form
- **Order Management** - Lihat data pesanan pelanggan

### 💾 Data Management
- **Database Integration** - Semua data tersimpan di MySQL database
- **Session Management** - Pengelolaan sesi user dengan PHP session
- **Local Storage** - Menyimpan alamat pengiriman untuk kemudahan checkout

## 🛠️ Teknologi yang Digunakan

### Frontend
- HTML5
- CSS3 (Custom styling dengan CSS Variables)
- JavaScript (Vanilla JS)
- Font Awesome 6.5.0 (Icons)
- Google Fonts (Raleway)

### Backend
- PHP 8.x
- MySQL/MariaDB
- MySQLi Extension

## 📁 Struktur File

```
perunggu-website/
│
├── index.php              # Homepage
├── theband.php            # Halaman profil band
├── listen.php             # Halaman musik & streaming
├── merchandise.php        # Katalog merchandise
├── payment.php            # Halaman checkout
├── process_payment.php    # Proses pembayaran
├── contact.php            # Halaman kontak
├── admin.php              # Panel admin
├── koneksi.php            # Konfigurasi database
├── style.css              # Stylesheet utama
├── payment.js             # JavaScript untuk payment system
├── perunggu.sql           # Database schema & sample data
│
└── assets/
    ├── 1.png              # Background image
    ├── 2.png              # Band photo
    ├── fotoAlbumDalamDinamika.png
    ├── fotoAlbumMemorandum.png
    ├── fotoAlbumPendar.png
    ├── Hoodie.png
    ├── T-shirt.png
    └── Cap.png
```

## 🚀 Instalasi

### Prerequisites
- PHP 8.0 atau lebih tinggi
- MySQL/MariaDB
- Web Server (Apache/Nginx)
- XAMPP/WAMP/LAMP (untuk local development)

### Langkah Instalasi

1. **Clone atau Download Project**
   ```bash
   git clone https://github.com/yourusername/perunggu-website.git
   cd perunggu-website
   ```

2. **Setup Database**
   - Buka phpMyAdmin
   - Buat database baru dengan nama `perunggu_db`
   - Import file `perunggu.sql`

3. **Konfigurasi Database**
   
   Edit file `koneksi.php`:
   ```php
   $host = "localhost";
   $user = "root";        // Sesuaikan dengan username MySQL Anda
   $pass = "";            // Sesuaikan dengan password MySQL Anda
   $db   = "perunggu_db";
   ```

4. **Setup Admin Credentials**
   
   Edit file `admin.php` (line 15-16):
   ```php
   $admin_username = "admin";           // Ganti sesuai keinginan
   $admin_password = "perunggu2025";    // Ganti dengan password kuat
   ```

5. **Jalankan Web Server**
   - Letakkan folder project di `htdocs` (XAMPP) atau `www` (WAMP)
   - Start Apache dan MySQL
   - Akses via browser: `http://localhost/perunggu-website/`

## 📊 Database Schema

### Tabel `merchandise`
```sql
- id (INT, Primary Key, Auto Increment)
- nama (VARCHAR 150)
- deskripsi (TEXT)
- harga (INT)
- gambar (VARCHAR 255)
```

### Tabel `contact`
```sql
- id (INT, Primary Key, Auto Increment)
- name (VARCHAR 255)
- email (VARCHAR 255)
- message (TEXT)
- created_at (TIMESTAMP)
```

### Tabel `orders`
```sql
- id (INT, Primary Key, Auto Increment)
- product (VARCHAR 255)
- price (INT)
- name (VARCHAR 255)
- email (VARCHAR 255)
- phone (VARCHAR 50)
- address (TEXT)
- city (VARCHAR 100)
- province (VARCHAR 100)
- postal_code (VARCHAR 20)
- payment_method (VARCHAR 50)
- total (INT)
- created_at (TIMESTAMP)
```

## 🔑 Login Admin

**Default Credentials:**
- Username: `admin`
- Password: `perunggu2025`

**⚠️ PENTING:** Segera ganti password default setelah instalasi!

## 🎨 Fitur Design

- **Responsive Design** - Tampilan optimal di berbagai ukuran layar
- **Modern UI/UX** - Interface yang clean dan user-friendly
- **Dark Theme** - Tema gelap dengan accent color hijau (#E0FBAB)
- **Smooth Animations** - Transisi dan hover effects yang smooth
- **Custom Notifications** - Banner notifikasi untuk user feedback

## 🔒 Security Features

- **SQL Injection Prevention** - Menggunakan `mysqli_real_escape_string()`
- **Session Management** - Pengelolaan sesi yang aman
- **Auto Logout** - Logout otomatis setelah 30 menit idle
- **XSS Prevention** - Menggunakan `htmlspecialchars()` untuk output
- **Admin Authentication** - Proteksi halaman admin dengan login

## 📱 Halaman Website

1. **Home** (`index.php`) - Landing page dengan CTA
2. **The Band** (`theband.php`) - Profil band dan personil
3. **Listen** (`listen.php`) - Musik player dan tracklist
4. **Merchandise** (`merchandise.php`) - Toko online merchandise
5. **Payment** (`payment.php`) - Checkout dan pembayaran
6. **Contact** (`contact.php`) - Formulir kontak
7. **Admin** (`admin.php`) - Panel administrasi

## 🛡️ Admin Panel Features

- **Dashboard** - Overview sistem
- **Add Merchandise** - Tambah produk baru
- **Delete Merchandise** - Hapus produk
- **View Orders** - Lihat pesanan (database only)
- **Manage Messages** - Kelola pesan kontak
- **Session Timeout** - Auto logout untuk keamanan

## 💡 Tips Penggunaan

1. **Merchandise Management:**
   - Upload gambar produk ke folder assets
   - Input URL gambar di form admin
   - Harga dalam format Rupiah (tanpa titik/koma)

2. **Payment System:**
   - Alamat pengiriman otomatis tersimpan di browser
   - Checkbox "Save Address" untuk menyimpan alamat
   - Data pesanan tersimpan di database

3. **Contact Form:**
   - Pesan tersimpan di database
   - Admin bisa lihat dan hapus pesan
   - Notifikasi sukses/error otomatis muncul

## 🔧 Customization

### Mengubah Warna Theme
Edit file `style.css`:
```css
:root {
    --accent-color: #E0FBAB;      /* Warna accent */
    --dark-bg: #222222;           /* Background gelap */
    --main-bg-color: #262c26;     /* Background utama */
}
```

### Mengubah Admin Password
Edit file `admin.php` line 15-16 atau buat sistem hash password.

### Menambah Social Media Links
Edit navigation dan footer di setiap file PHP.

## 📞 Support & Contact

- **Email:** info@perunggu.com
- **Phone:** 028-740-7980
- **Instagram:** [@perunggu_](https://www.instagram.com/perunggu_)
- **YouTube:** [PerungguOfficial](https://www.youtube.com/@PerungguOfficial)
- **Spotify:** [Perunggu](https://open.spotify.com/artist/0NbKRRBuiIUwS9irPvi7wD)

## 📝 License

© 2025 by Perunggu. All rights reserved.

## 🤝 Contributing

Untuk berkontribusi pada project ini:
1. Fork repository
2. Buat branch baru (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

## ⚠️ Disclaimer

Website ini dibuat untuk keperluan Projek UAS PEMROGRAMAN WEB. 

---

**Developed with ❤️ for Perunggu Band**
