# Hardware_JosJis 🛒

**Anggota** = **Sayyid Ilmi Hubballillah (245150600111027)**
              **Sugeng Riadika (245150600111020)**

**Hardware_JosJis** adalah platform e-commerce berbasis web yang dirancang khusus untuk transaksi jual-beli perangkat keras komputer (hardware) dan laptop. Aplikasi ini dibangun menggunakan framework **Laravel** dengan antarmuka yang responsif dan sistem manajemen toko yang komprehensif.

![Laravel](https://img.shields.io/badge/Laravel-10%2B-red) ![Bootstrap](https://img.shields.io/badge/CSS-Custom-blue) ![Status](https://img.shields.io/badge/Status-Development-orange)

## 📋 Fitur Utama

Aplikasi ini membagi pengguna menjadi tiga peran utama dengan fungsionalitas berbeda:

### 1. Autentikasi & Pengguna (User)
* **Custom Login & Register:** Desain halaman masuk dan daftar yang terpisah (split-screen) dengan validasi input realtime.
* **Multi-Role System:** Mendukung peran Member (Pembeli), Seller (Penjual), dan Admin.

### 2. Member (Pembeli)
* **Katalog & Pencarian:** Menjelajahi produk berdasarkan kategori atau menggunakan fitur pencarian kata kunci.
* **Keranjang & Checkout:** Membeli produk dengan sistem validasi stok otomatis dan pengurangan saldo.
* **Top Up Saldo:** Fitur simulasi pengisian saldo akun untuk bertransaksi.
* **Riwayat Transaksi:** Memantau status pesanan (Diproses, Dikirim, Selesai).

### 3. Seller (Penjual)
* **Manajemen Toko:** Mendaftarkan toko baru dengan logo dan deskripsi kustom.
* **Manajemen Produk (CRUD):** * Menambah produk baru dengan upload gambar.
    * Mengedit detail produk (Harga, Stok, Berat, Deskripsi).
    * Menghapus produk.
* **Manajemen Pesanan:** Memproses pesanan masuk, update status pengiriman, dan input nomor resi.
* **Keuangan & Penarikan Dana:**
    * Dashboard ringkasan pendapatan.
    * Fitur *Withdrawal* (Tarik Dana) ke rekening bank pilihan.

### 4. Admin
* **Verifikasi Toko:** Menyetujui atau menolak pengajuan pembukaan toko baru.
* **Manajemen User:** Mengelola data pengguna aplikasi.

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** PHP (Laravel Framework)
* **Frontend:** Blade Templating Engine
* **Database:** MySQL
* **Styling:** Custom CSS (Flexbox Layout) & FontAwesome Icons
* **Autentikasi:** Laravel Auth

---

## ⚙️ Persyaratan Sistem

Pastikan komputer Anda telah terinstal:
* PHP >= 8.1
* Composer
* MySQL / MariaDB
* Web Server (Apache/Nginx/Laragon/XAMPP)

---

## 🚀 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lokal:

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/username-anda/hardware-josjis.git](https://github.com/username-anda/hardware-josjis.git)
    cd hardware-josjis
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment**
    Salin file contoh `.env` dan atur database:
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan sesuaikan koneksi database:
    ```env
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate Key & Migrasi Database**
    ```bash
    php artisan key:generate
    php artisan migrate
    ```

5.  **Setup Storage Link**
    Agar gambar produk yang diupload bisa diakses:
    ```bash
    php artisan storage:link
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Buka browser dan akses: `http://localhost:8000`

---

## 📂 Struktur File Penting

Berikut adalah lokasi file logika utama dalam proyek ini:

* **Controller Utama:** `app/Http/Controllers/MemberController.php` (Mengatur logika Member & Seller).
* **Routing:** `routes/web.php` (Mengatur alur URL dan Middleware).
* **Views (Frontend):**
    * `resources/views/auth/`: Halaman Login & Register.
    * `resources/views/member/`: Halaman Dashboard, Produk, dan Toko.
* **Styling:** `public/style.css`.

---

## 🤝 Kontribusi

Pull request dipersilakan. Untuk perubahan besar, harap buka *issue* terlebih dahulu untuk mendiskusikan apa yang ingin Anda ubah.

---