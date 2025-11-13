# Dashboard Inventory - PHP Version

Dashboard Serah Terima & Pengembalian Barang yang responsif dan interaktif, dibangun dengan PHP, Vanilla JavaScript, dan Tailwind CSS.

## 📁 Struktur Folder

```
SERAH TERIMA
├── admin/              → Halaman khusus untuk pengguna admin
├── assets/             → File statis (CSS, JS)
├── includes/           → Komponen reusable (modal, tabel, form)
├── super_admin/        → Halaman khusus untuk super admin
├── user/               → Halaman khusus untuk pengguna biasa
├── config.php          → Konfigurasi umum
├── index.php           → Landing page / login
├── koneksi.php         → Koneksi database
├── login.php           → Form login
├── login_procces.php   → Proses autentikasi
├── logout.php          → Proses logout
└── README.md           → Dokumentasi
```

## 🚀 Fitur

- ✅ **Collapsible Sidebar** - Sidebar yang bisa collapse/expand dengan animasi smooth
- ✅ **Responsive Design** - Tampilan optimal di desktop dan mobile
- ✅ **Interactive UI** - Animasi dan transisi yang smooth
- ✅ **Data Management** - CRUD untuk serah terima & pengembalian barang
- ✅ **Search & Filter** - Pencarian dan filter status data
- ✅ **Toast Notifications** - Notifikasi untuk aksi user
- ✅ **Modal Dialog** - Form tambah data dengan modal
- ✅ **Dashboard Stats** - Kartu statistik dengan visualisasi

## 🛠️ Teknologi

- **PHP** - Backend logic dan struktur halaman
- **Vanilla JavaScript** - Interaktivitas tanpa framework
- **Tailwind CSS** - Styling modern via CDN
- **Lucide Icons** - Icon library yang elegant

## 📦 Instalasi

1. **Copy folder ke web server**
   ```bash
   # Jika menggunakan XAMPP
   cp -r php-version/ /xampp/htdocs/inventory-dashboard/
   
   # Jika menggunakan Laravel Valet atau server lain
   # Sesuaikan path dengan konfigurasi server Anda
   ```

2. **Akses melalui browser**
   ```
   http://localhost/inventory-dashboard/
   ```

3. **Tidak perlu instalasi dependency** - Semua library diload dari CDN!

## 💡 Penggunaan

### Menu Navigasi
- **Dashboard** - Overview statistik dan data terbaru
- **Serah Terima** - Kelola data serah terima barang
- **Pengembalian** - Kelola data pengembalian barang
- **Pengaturan** - Konfigurasi aplikasi

### Fitur Sidebar
- Klik icon **hamburger** di navbar untuk collapse/expand sidebar
- Saat collapsed, hanya icon yang ditampilkan dengan tooltip
- Saat expanded, menampilkan icon dan label lengkap

### Tambah Data
1. Klik tombol **"Tambah Data"**
2. Isi form yang muncul
3. Klik **"Simpan"**
4. Notifikasi sukses akan muncul

### Search & Filter
- Gunakan search box untuk mencari data
- Gunakan dropdown filter untuk filter berdasarkan status
- Hasil akan diupdate secara real-time

## 🔧 Kustomisasi

### Mengubah Warna Tema
Edit di `index.php` bagian Tailwind config atau langsung di class:
```php
<!-- Contoh: Ubah dari orange ke blue -->
<header class="bg-gradient-to-r from-blue-500 to-blue-600">
```

### Menambah Menu
1. Tambah di array `$menuItems` di `index.php`
2. Buat file baru di `includes/pages/nama-menu.php`
3. Menu otomatis muncul di sidebar

### Integrasi Database
Ganti array data dengan query database:
```php
// Contoh di index.php
$handoverData = []; // Ganti dengan query
$result = mysqli_query($conn, "SELECT * FROM handover_data");
while($row = mysqli_fetch_assoc($result)) {
    $handoverData[] = $row;
}
```

## 📱 Responsif

- **Desktop** - Sidebar fixed dengan collapsible feature
- **Tablet** - Layout grid menyesuaikan
- **Mobile** - Sidebar overlay dengan backdrop

## 🎨 Komponen

### Stats Cards
Menampilkan statistik dengan icon dan trend:
```php
$stats = [
    ['title' => 'Label', 'value' => '123', 'icon' => 'package', 'color' => 'blue']
];
```

### Data Table
Tabel dengan search, filter, dan pagination:
- Auto search on keyup
- Filter by status
- Hover effects
- Responsive design

### Modal Dialog
Form dalam modal dengan backdrop:
- Close on backdrop click
- Close button
- Form validation
- Toast notification on submit

## 🔐 Security Note

Ini adalah versi demo. Untuk production:
- Implementasikan **CSRF protection**
- Gunakan **prepared statements** untuk database
- Validasi **input di server side**
- Implementasikan **authentication & authorization**
- Gunakan **HTTPS**

## 📝 Development Roadmap

- [ ] Integrasi database MySQL/PostgreSQL
- [ ] Sistem login & authentication
- [ ] Export data ke Excel/PDF
- [ ] Upload foto/dokumen
- [ ] Email notifications
- [ ] Dashboard analytics dengan chart
- [ ] Print receipt/bukti

## 🤝 Kontribusi

Silakan fork dan submit pull request untuk improvements!

## 📄 License

Free to use untuk project pribadi maupun komersial.

## 💬 Support

Untuk pertanyaan atau issues, silakan buat issue di repository ini.

---

**Dibuat dengan ❤️ menggunakan PHP & Tailwind CSS**
