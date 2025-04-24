# Kasir Digital x Koperasi

## Deskripsi
Kasir Digital x Koperasi adalah aplikasi berbasis web yang digunakan untuk menganalisis, memantau barang, memantau penjualan, dan mengelola pengeluaran secara realtime. Aplikasi ini dikembangkan menggunakan Laravel sebagai backend dan TailwindCSS untuk tampilan.

---

## Fitur Utama
- Manajemen produk dan kategori
- Sistem transaksi dan order
- Pengelolaan pelanggan (member)
- Diskon dan promosi
- Multi-user dengan peran berbeda (`admin`, `kasir`)
- Laporan penjualan

---

## Instalasi

### 1. Clone Repository
```sh
git clone https://github.com/username/repo-name.git
cd repo-name
```

### 2. Install Dependencies
```sh
composer install
npm install
```

### 3. Konfigurasi Environment
Buat file `.env` dari template:
```sh
cp .env.example .env
```
Lalu edit `.env` sesuai konfigurasi database dan aplikasi.

### 4. Generate Key & Migrasi Database
```sh
php artisan key:generate
php artisan migrate --seed
```

### 5. Jalankan Server
Untuk backend:
```sh
php artisan serve
```
Untuk frontend (TailwindCSS):
```sh
npm run dev
```

Akses aplikasi melalui `http://127.0.0.1:8000`.

---

## Menjalankan Queue Service

Aplikasi ini menggunakan queue untuk menangani proses yang berjalan di latar belakang, seperti notifikasi. Berikut cara menjalankannya:

### **Di Linux (Menggunakan Systemd Service)**

Buat file service di `/etc/systemd/system/kasir-queue.service` dengan isi berikut:

```
# Kasir Digital Queue Worker File
[Unit]
Description=Kasir Digital Queue Worker

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/project-kasir-digital/artisan queue:work --daemon
StartLimitInterval=180
StartLimitBurst=30
RestartSec=5s
[Install]
WantedBy=multi-user.target
```

> ubah `/var/www/project-kasir-digital` menjadi lokasi project anda.

Lalu jalankan perintah berikut:

```sh
sudo systemctl daemon-reload
sudo systemctl enable kasir-queue
sudo systemctl start kasir-queue
```

Untuk mengecek status service:

```sh
sudo systemctl status kasir-queue
```

### **Di Windows (Menggunakan Task Scheduler)**

1. Buka `Task Scheduler` di Windows.
2. Klik **Create Basic Task** → Isi nama dengan **Kasir Queue Worker**.
3. Pilih **When the computer starts**.
4. Pada bagian **Action**, pilih **Start a program**.
5. Pada bagian **Program/script**, masukkan path ke `php.exe`, contoh:
   ```
   C:\xampp\php\php.exe
   ```
6. Pada bagian **Add arguments**, tambahkan:
   ```
   artisan queue:work --daemon
   ```
   dengan path lengkap ke proyek Laravel, misalnya:
   ```
   C:\laragon\www\project-kasir-digital\artisan queue:work --daemon
   ```
7. Klik **Finish**, lalu jalankan task tersebut.

## Struktur Database
### **Entity Relationship Diagram (ERD)**
Sistem ini terdiri dari beberapa bagian utama:
- **Member**
- **Produk**
- **Kategori**
- **User** (`admin`, `kasir`)
- **Transaksi**
- **Order**
- **OrderDetail**
- **Discounts**

### **Hubungan Antar Tabel**
- **Member - Order** → 1:N
- **User - Order** → 1:N
- **Order - OrderDetail** → 1:N
- **OrderDetail - Produk** → 1:N
- **Produk - Kategori** → N:1
- **Produk - Discounts** → N:1
- **Order - Discounts** → N:1
- **Order - Transaksi** → 1:1

#### ** ERD v1 **
![Kasir Digital ERD v1.0](https://github.com/user-attachments/assets/8576cabc-eb5c-4222-84d9-cb0559a7ad7a)

#### ** ERD v1.1 **
![Kasir Digital ERD v1.1](https://github.com/user-attachments/assets/39ca91fd-6840-4b7f-98f8-7e7ebaa21490)

---

## Roadmap
### **Versi 0.1 (2023)**
- Desain tampilan aplikasi
- Membuat proyek dengan Laravel
- Login dengan Google Account
- Menampilkan daftar produk secara publik
- Integrasi pembayaran online (Midtrans)
- Update tampilan dengan React.js dan API Laravel
- Menyediakan fitur pengiriman pesanan
- Menyediakan API Laravel untuk aplikasi Android

### **Versi 0.2 (2025)**
- Mengubah konsep menjadi Kasir Digital

### **Versi 1.0.0 (Maret 2025)**
- Versi awal Kasir Digital dengan fitur utama seperti manajemen produk, transaksi, dan pelanggan.

### **Versi 1.1.0 (Maret 2025)**
- Menambahkan fitur notifikasi ke pelanggan melalui email dan WhatsApp.
- Menambahkan informasi pengirim pada email transaksi.
- Menyederhanakan cara pengiriman pesan WhatsApp.
- Memperbaiki tampilan pengiriman faktur.
- Memastikan notifikasi berjalan lebih lancar dengan sistem antrian.

Untuk detail lebih lanjut, silakan cek [halaman rilis](https://github.com/ItzKazuki/Kasir-Digital/releases).

---

## Lisensi
Proyek ini berlisensi di bawah GPL v3. Lihat file [LICENSE](LICENSE) untuk detailnya.

