
# Kasir Digital x Koperasi

Aplikasi web ini berguna untuk menganalisa, memantau barang, memantau penjualan, dan juga memantau pengeluaran secara realtime. menggunakan laravel sebagai framework utama.

# Struktur database

### Entity Relationship Diagram (ERD)
Sistem kasir digital ini terdiri dari beberapa entitas utama:
- **Member**
- **Produk**
- **Kategori**
- **User** (`admin`, `kasir`)
- **Transaksi**
- **Order**
- **OrderDetail**
- **Discounts**

---

### Struktur Tabel

#### **1. Member**
| Field Name  | Type  | Description |
|------------|-------|-------------|
| `id` (PK)  | int   | ID pelanggan |
| `full_name` | varchar | Nama lengkap pelanggan |
| `no_telp` (UNIQUE) | varchar | Nomor telepon pelanggan |
| `point` | decimal | Poin pelanggan hasil transaksi |
| `email` | varchar | Email pelanggan |
| `status` | enum(`active`, `inactive`) | Status aktivitas pelanggan |

---

#### **2. Produk**
| Field Name  | Type  | Description |
|------------|-------|-------------|
| `id` (PK)  | int   | ID produk |
| `name` | varchar | Nama produk |
| `category_id` (FK) | int | Jenis produk |
| `discount_id` (FK, NULLABLE) | int | Diskon dari produk |
| `price` | decimal | Harga produk |
| `stock` | int | Jumlah barang yang tersedia |
| `expired_at` | date | Barang Expired pada tanggal |
| `image_url` | varchar | Lokasi gambar produk |
| `description` | text | Deskripsi produk |
| `estimasi_keuntungan` | decimal | Perkalian dari stok dan harga produk (otomatis dihitung) |

---

#### **3. Kategori**
| Field Name  | Type  | Description |
|------------|-------|-------------|
| `id` (PK)  | int   | ID kategori |
| `name` | varchar | Nama kategori |
| `description` | text | Deskripsi kategori |

---

#### **4. User**
| Field Name  | Type  | Description |
|------------|-------|-------------|
| `id` (PK)  | int   | ID user |
| `username` | varchar | Username user |
| `full_name` | varchar | Nama lengkap user |
| `no_telp` (UNIQUE) | varchar | Nomor telepon user |
| `email` | varchar | Email user |
| `password` | varchar | Hasil hashing dari password |
| `profile_img` | varchar | Gambar profil user |
| `role` | enum(`admin`, `kasir`) | Role user |

---

#### **5. Transaksi**
| Field Name  | Type  | Description |
|------------|-------|-------------|
| `id` (PK)  | int   | ID transaksi |
| `order_id` (FK) | int | Order yang berkaitan |
| `member_id` (FK, NULLABLE) | int | Member yang memesan |
| `total_price` | decimal | Total pembelian |
| `cash` | decimal | Uang masuk dari pelanggan |
| `cash_change` | decimal | Kembalian dari cash - total_price |
| `payment_method` | enum(`cash`, `debit`, `credit`, `ewallet`) | Jenis pembayaran |
| `payment_status` | enum(`paid`, `unpaid`, `pending`) | Status pembayaran |

---

#### **6. Order**
| Field Name  | Type  | Description |
|------------|-------|-------------|
| `id` (PK)  | int   | ID order |
| `user_id` (FK) | int | Kasir yang menangani order |
| `order_date` | date | Tanggal pembelian |
| `total_items` | int | Total barang |
| `total_price` | decimal | Total pembelian |

---

#### **7. OrderDetail**
| Field Name  | Type  | Description |
|------------|-------|-------------|
| `id` (PK)  | int   | ID order detail |
| `order_id` (FK) | int | ID order |
| `product_id` (FK) | int | Barang yang dipilih |
| `quantity` | int | Jumlah barang |
| `total_price` | decimal | Total pembelian |

---

#### **8. Discounts**
| Field Name  | Type  | Description |
|------------|-------|-------------|
| `id` (PK)  | int   | ID diskon |
| `name` | varchar | Nama diskon (contoh: Promo Nampol) |
| `type` | enum(`percentage`, `fixed`) | Jenis diskon (persen atau nominal) |
| `value` | decimal | Besaran diskon dalam persen atau nominal |
| `start_date` | date | Tanggal awal diskon |
| `end_date` | date | Tanggal akhir diskon |
| `status` | enum(`active`, `inactive`) | Status diskon |

---

## Relasi Antar Tabel (Kardinalitas)
- **Member - Order** → 1:N (Satu member bisa memiliki banyak order, satu order hanya untuk satu member)
- **User Role - Order** → 1:N (Satu kasir/admin bisa menangani banyak order)
- **Order - Order Detail** → 1:N (Satu order bisa memiliki banyak detail order)
- **Order Detail - Produk** → 1:N (Satu produk bisa masuk dalam banyak order detail)
- **Produk - Kategori** → N:1 (Banyak produk bisa masuk dalam satu kategori)
- **Produk - Discounts** → N:1 (Satu diskon bisa berlaku untuk banyak produk)
- **Order - Discounts** → N:1 (Satu diskon bisa diterapkan ke banyak order)
- **Order - Transaksi** → 1:1 (Satu order hanya memiliki satu transaksi, dan satu transaksi hanya untuk satu order)

---

## Diagram Database
v1
![Kasir Digital](https://github.com/user-attachments/assets/8576cabc-eb5c-4222-84d9-cb0559a7ad7a)
v1-rev
![image](https://github.com/user-attachments/assets/39ca91fd-6840-4b7f-98f8-7e7ebaa21490)



# Flowchart
- nanti aja bikinnya, gampang awokaokwokw

# Todo

## todo v0.1 (2023)
- pikirin ui nya nanti kek gimana
- membuat project dengan bantuan framework laravel
- implementasi login menggunakan google account
- membuat tampilan barang yang tersedia secara publik
- membuat pembayaran online melalui app pihak ke-3 (midtrans).
- update tampilan menggunakan react.js + API dari laravel
- membuat delivery ke tempat, agar tidak terlalu menumpuk di koperasi
- implementasi API laravel ke aplikasi android.

## todo v0.2 (2025)
- ubah konsep menjadi kasir digital


# License
This project is licensed under the GPL v3 License - see the [LICENSE](LICENSE) file for details.


