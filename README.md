# 🏥 Sistem Informasi Poliklinik

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.47-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Status-Production_Ready-success?style=for-the-badge" alt="Status">
</p>

---

## 👨‍🎓 Identitas Mahasiswa

| Field            | Value                       |
| ---------------- | --------------------------- |
| **Nama**         | Naufal Arsyaputra Pradana   |
| **NIM**          | A11.2022.14606              |
| **Kelas**        | Bengkel Koding - WD02       |
| **Mata Kuliah**  | Pemrograman Web             |
| **Institusi**    | Universitas Dian Nuswantoro |
| **Tahun Ajaran** | 2024/2025                   |
| **Project**      | Capstone UAS Bengkel Koding |

---

## 📋 Tentang Project

**Sistem Informasi Poliklinik** adalah aplikasi manajemen klinik berbasis web yang dibangun menggunakan **Laravel 11.47** dan **PHP 8.3**. Aplikasi ini dirancang untuk memfasilitasi proses operasional poliklinik secara digital, mencakup:

- ✅ Pendaftaran pasien online
- ✅ Penjadwalan dokter
- ✅ Pemeriksaan pasien dan resep obat
- ✅ **Manajemen stok obat otomatis** (Capstone Feature)
- ✅ Riwayat medis terintegrasi

### 🌟 Capstone Feature: Manajemen Stok Obat

Project ini mengimplementasikan **sistem manajemen stok obat otomatis** sebagai fitur Capstone dengan kemampuan:

- ✅ Admin dapat **menambah/mengurangi/mengatur stok** secara manual
- ✅ Sistem **auto-deduct stok** saat dokter memberikan resep

---

## ⚡ Fitur-Fitur Utama

### 🔐 1. Sistem Autentikasi & Otorisasi

#### **Multi-Role Authentication**

- **Admin:** Full access ke semua modul manajemen
- **Dokter:** Akses ke jadwal, pemeriksaan, dan riwayat pasien
- **Pasien:** Akses pendaftaran poli dan riwayat pemeriksaan

#### **Security Features**

- ✅ Password hashing (bcrypt)
- ✅ Session management
- ✅ Role-based middleware
- ✅ CSRF protection
- ✅ Data isolation per dokter (privacy)

---

### 👨‍💼 2. Modul Admin

#### **A. Dashboard Admin**

- Statistik jumlah dokter, pasien, poli, obat

#### **B. Manajemen Poli**

- ✅ Create, Read, Update, Delete Poli

#### **C. Manajemen Dokter**

- ✅ CRUD data dokter
- ✅ Assign dokter ke poli

#### **D. Manajemen Pasien**

- ✅ CRUD data pasien
- ✅ Auto-generate No. Rekam Medis (format: YYYYMM-XXX)

#### **E. Manajemen Obat + Stock Management** ⭐ **(CAPSTONE)**

- ✅ CRUD data obat (nama, kemasan, harga)
- ✅ **Manual Stock Adjustment**:
    - **[+] Add Stock** - Tambah stok obat
    - **[-] Subtract Stock** - Kurangi stok obat (dengan validasi)
    - **[⚙] Set Stock** - Set stok ke nilai tertentu

---

### 👨‍⚕️ 3. Modul Dokter

#### **A. Dashboard Dokter**

- Jadwal praktek hari ini
- Jumlah pasien menunggu

#### **B. Manajemen Jadwal Periksa**

- ✅ Create jadwal praktek (hari, jam mulai, jam selesai)
- ✅ **Toggle Status Jadwal** (Aktif/Tidak Aktif)
    - Implementasi via form dengan hidden fields (simple, no custom method)
    - Update status tanpa mengubah data jadwal lainnya
- ✅ Edit dan hapus jadwal
- ✅ Validasi konflik jadwal

#### **C. Periksa Pasien** ⭐ **(CAPSTONE INTEGRATION)**

- ✅ **Lihat Daftar Antrian Pasien**
    - Filter berdasarkan jadwal dokter aktif hari ini
    - Urut berdasarkan nomor antrian
    - Status: Belum/Sudah diperiksa

- ✅ **Form Pemeriksaan dengan Stock Management**:
    1. **Input Diagnosis:**
        - Tanggal periksa
        - Catatan pemeriksaan (min 10 karakter)
    2. **Pilih Obat dengan Info Stok Real-time:**
        - Dropdown menampilkan: "Nama Obat - Rp X (Stok: Y unit)"
        - Obat habis otomatis disabled dengan label "⚠ Stok Habis"
        - Warning visual untuk stok menipis
    3. **Input Jumlah Obat:**
        - Input quantity per obat
        - **Client-side validation**: Alert jika jumlah > stok
        - Dapat tambah multiple obat
    4. **Auto-Calculate Biaya:**
        - Jasa Dokter: Rp 150,000 (fixed)
        - Biaya Obat: Jumlah x Harga per obat
        - Total Biaya: Jasa + Obat
    5. **Validasi Stok Sebelum Save:**
        - Server-side validation untuk setiap obat
        - Error detail jika stok tidak cukup
        - Transaction rollback jika gagal
    6. **Auto-Deduct Stock:**
        - Stok otomatis berkurang setelah save berhasil
        - Logging perubahan stok
        - Update visual indicators

- ✅ **Error Handling Komprehensif:**
    - Alert jika stok tidak mencukupi
    - Detail obat mana yang bermasalah
    - Saran restock atau ganti obat

#### **D. Riwayat Pasien**

- ✅ Lihat semua pemeriksaan yang dilakukan
- ✅ **Security: Data isolation** - Hanya lihat pasien sendiri
- ✅ Detail obat yang diresepkan
- ✅ Biaya pemeriksaan

---

### 👤 4. Modul Pasien

#### **A. Dashboard Pasien**

- Info personal pasien
- No. Rekam Medis
- Status pendaftaran

#### **B. Daftar Poli**

- ✅ Pilih poli tujuan
- ✅ Pilih jadwal dokter yang aktif
- ✅ Input keluhan
- ✅ **Auto-assign nomor antrian** (sequential)
- ✅ Konfirmasi pendaftaran

#### **C. Riwayat Pendaftaran & Pemeriksaan**

- ✅ Lihat semua pendaftaran poli
- ✅ Status pemeriksaan (Belum/Sudah)
- ✅ Detail hasil pemeriksaan
- ✅ Resep obat yang diberikan
- ✅ Total biaya pemeriksaan

---

## 🛠️ Teknologi yang Digunakan

### **Backend**

```
- Laravel Framework: 11.47.0
- PHP: 8.3.16
- Database: MySQL 8.0+ (Primary) / SQLite (Alternative)
- Composer: 2.8.6
```

### **Frontend**

```
- Bootstrap: 5.3
- Font Awesome: 6.0
- SweetAlert2: 11.x (Alerts & Notifications)
- JavaScript: Vanilla JS (Stock validation)
```

### **Tools & Libraries**

```
- Eloquent ORM: Database operations
- Blade Templating: View rendering
- Laravel Mix/Vite: Asset compilation
- Migration & Seeder: Database management
```

---

## 📥 Instalasi

### **Prasyarat**

```bash
- PHP >= 8.3
- Composer >= 2.8
- MySQL >= 8.0 / MariaDB >= 10.3
- Web Server (Apache/Nginx) atau Laravel Built-in Server
```

### **Langkah-langkah Instalasi**

#### **1. Clone Repository**

```bash
git clone https://github.com/NaufalArsyaputraPradana/Poliklinik.git
cd poliklinik-app
```

#### **2. Install Dependencies**

```bash
composer install
```

#### **3. Buat Database MySQL**

```bash
# Login ke MySQL
mysql -u root -p

# Buat database baru
CREATE DATABASE poliklinik;

# Keluar dari MySQL
exit;
```

#### **4. Setup Environment**

```bash
# Copy file environment
copy .env.example .env

# Generate application key
php artisan key:generate
```

#### **5. Konfigurasi Database**

Edit file `.env` dan sesuaikan dengan konfigurasi MySQL Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=poliklinik
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

**Alternatif: SQLite (untuk Development/Testing):**

Jika ingin menggunakan SQLite sebagai alternatif:

```env
DB_CONNECTION=sqlite
# File database.sqlite akan auto-created
```

#### **6. Run Migration**

```bash
php artisan migrate 
```



#### **7. Clear & Cache Configuration**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:cache
php artisan config:cache
```

#### **8. Start Development Server**

```bash
php artisan serve
```

#### **9. Akses Aplikasi**

```
URL: http://localhost:8000
```

---

## 🔐 Akun Testing

### **👨‍💼 Admin**

```
Email: admin@poliklinik.com
Password: password
```

**Akses:**

- ✅ CRUD Poli, Dokter, Pasien, Obat

---

### **👨‍⚕️ Dokter**

#### Dokter 1 (Poli Umum)

```
Email: dokter@poliklinik.com
Password: password
```

#### Dokter 2 (Poli Gigi)

```
Email: dokter.gigi@poliklinik.com
Password: password
```

#### Dokter 3 (Poli Anak)

```
Email: dokter.anak@poliklinik.com
Password: password
```

#### Dokter 4 (Poli Mata)

```
Email: dokter.mata@poliklinik.com
Password: password
```

**Akses:**

- ✅ CRUD Jadwal Periksa
- ✅ Periksa Pasien (with stock validation)
- ✅ Riwayat Pasien (filtered)

---

### **👤 Pasien**

```
Registrasi sendiri via: http://localhost:8000/register
Auto-generate No. Rekam Medis: YYYYMM-XXX
```

**Akses:**

- ✅ Daftar Poli (with queue system)
- ✅ Riwayat Pendaftaran & Pemeriksaan

---


## 🗄️ Struktur Database

### **Tabel Utama**

#### **users** (Multi-role: admin, dokter, pasien)

```
- id (PK)
- nama
- email (unique)
- password (hashed)
- alamat
- no_ktp (16 digit)
- no_hp (10-13 digit)
- no_rm (Auto-generate untuk pasien: YYYYMM-XXX)
- id_poli (FK untuk dokter)
- role (enum: admin, dokter, pasien)
- timestamps
```

#### **polis**

```
- id (PK)
- nama_poli
- keterangan
- timestamps
```

#### **jadwal_periksas**

```
- id (PK)
- id_dokter (FK → users)
- hari (varchar)
- jam_mulai (time)
- jam_selesai (time)
- aktif (boolean)
- timestamps
```

#### **obats** ⭐ (Capstone Feature)

```
- id (PK)
- nama_obat
- kemasan
- harga (integer)
- stok (integer, default: 0) ← CAPSTONE
- stok_minimum (integer, default: 10) ← CAPSTONE
- timestamps
```

#### **daftar_polis**

```
- id (PK)
- id_pasien (FK → users)
- id_jadwal (FK → jadwal_periksas)
- keluhan (text)
- no_antrian (integer, auto-increment per jadwal)
- timestamps
```

#### **periksas**

```
- id (PK)
- id_daftar_poli (FK → daftar_polis)
- tgl_periksa (datetime)
- catatan (text)
- biaya_periksa (integer)
- timestamps
```

#### **detail_periksas** ⭐ (Capstone Integration)

```
- id (PK)
- id_periksa (FK → periksas, cascade)
- id_obat (FK → obats, cascade)
- jumlah (integer, default: 1) ← CAPSTONE
- timestamps
```

---

## 📚 Referensi & Resources

### **Laravel Documentation**

- [Laravel 11.x Docs](https://laravel.com/docs/11.x)
- [Eloquent ORM](https://laravel.com/docs/11.x/eloquent)
- [Blade Templates](https://laravel.com/docs/11.x/blade)
- [Migrations](https://laravel.com/docs/11.x/migrations)
- [Validation](https://laravel.com/docs/11.x/validation)

### **Frontend Libraries**

- [Bootstrap 5](https://getbootstrap.com/docs/5.3/)
- [SweetAlert2](https://sweetalert2.github.io/)
- [Font Awesome](https://fontawesome.com/icons)

---


### **Developer**

- **Nama:** Naufal Arsyaputra Pradana
- **Email:** naufal.arsyaputra@students.dinus.ac.id
- **GitHub:** [NaufalArsyaputraPradana](https://github.com/NaufalArsyaputraPradana)
- **Institution:** Universitas Dian Nuswantoro

### **Repository**

- **URL:** [https://github.com/NaufalArsyaputraPradana/Poliklinik](https://github.com/NaufalArsyaputraPradana/Poliklinik)
- **Branch:** main
- **License:** Educational Purpose

---

## 📝 License & Copyright

Project ini dibuat untuk keperluan **pendidikan** sebagai tugas Capstone UAS Bengkel Koding 2025.

**© 2025 Naufal Arsyaputra Pradana - Universitas Dian Nuswantoro**

---


<p align="center">
  <strong>Made by Naufal Arsyaputra Pradana</strong><br>
  <sub>Bengkel Koding WD02 - Universitas Dian Nuswantoro</sub>
</p>

---

**Last Updated:** 29 Desember 2025  
**Version:** 1.0.0  
