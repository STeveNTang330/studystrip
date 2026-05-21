# StudyStrip - Tugas Dokumentasi Proyek

## 1. 📸 Screenshot Proyek

### **Login Page**
```
╔════════════════════════════════════════╗
║          STUDYstrip                    ║
║                                        ║
║        Selamat Datang                  ║
║  Silakan masuk ke akun Anda            ║
║                                        ║
║  📧 Email:                             ║
║     [________________________________] ║
║                                        ║
║  🔒 Kata Sandi:                        ║
║     [________________________________] ║
║                                        ║
║  ☐ Ingat saya          Lupa Sandi? 🔗 ║
║                                        ║
║          [ LOGIN ]                     ║
║                                        ║
║  Belum punya akun? Daftar di sini 🔗  ║
╚════════════════════════════════════════╝
```
- Desain modern dengan branding StudyStrip
- Email & password fields dengan icon
- Remember me checkbox
- Forgot password link
- Sign up link untuk user baru

---

### **Dashboard Guru - Upload Komik (Section 1)**
```
╔═══════════════════════════════════════════════════════════╗
║  Studio Perakitan Komik                    [← Kembali]   ║
║  Rancang bab komik interaktif dengan skenario & aset      ║
╠═══════════════════════════════════════════════════════════╣
║  1. INFORMASI DASAR BAB                                   ║
╠═══════════════════════════════════════════════════════════╣
║                                                            ║
║  Nomor Bab: [__]    Judul Materi: [________________]       ║
║                                                            ║
║  Deskripsi / Sinopsis:                                    ║
║  [________________________________________________]        ║
║  [________________________________________________]        ║
║  [Tuliskan ringkasan cerita atau materi...]               ║
║                                                            ║
╚═══════════════════════════════════════════════════════════╝
```

---

### **Dashboard Guru - Upload Komik (Section 2 - Drag & Drop Interface)**

#### **Left Column - Asset Library**
```
╔═══════════════════════════════════╗
║  📦 Pustaka Aset          [reset] ║
║                                    ║
║  Unggah & atur halaman komik      ║
║  dengan drag-drop.                ║
║                                    ║
║  ┌──────────────────────────────┐ ║
║  │   ☁️  Tarik file di sini     │ ║
║  │        atau                  │ ║
║  │   [ 📁 Pilih File ]          │ ║
║  └──────────────────────────────┘ ║
║                                    ║
║  ┌──────────────────────────────┐ ║
║  │[🖼️]  image1.jpg             │ ║
║  │      512 KB                  │ ║
║  │      ✓ Panel 1               │ ║
║  │              [🗑️ Hapus]      │ ║
║  └──────────────────────────────┘ ║
║                                    ║
║  ┌──────────────────────────────┐ ║
║  │[🖼️]  image2.png             │ ║
║  │      384 KB                  │ ║
║  │              [🗑️ Hapus]      │ ║
║  └──────────────────────────────┘ ║
║                                    ║
╚═══════════════════════════════════╝
```

#### **Right Column - Story Board**
```
╔══════════════════════════════════════════════════════════╗
║  🎬 Story Board                            [Reset]      ║
║                                                          ║
║  Setiap panel akan menjadi halaman komik                ║
║  Atur urutan dengan cara seret-seret asset             ║
╠══════════════════════════════════════════════════════════╣
║                                                          ║
║  Panel 1      Panel 2      Panel 3      Panel 4         ║
║  ┌────────┐  ┌────────┐  ┌────────┐  ┌────────┐        ║
║  │ Drag   │  │ Drag   │  │[🖼️]   │  │ Drag   │        ║
║  │ asset  │  │ asset  │  │        │  │ asset  │        ║
║  │  ke    │  │  ke    │  │   [X]  │  │  ke    │        ║
║  │ sini   │  │ sini   │  │        │  │ sini   │        ║
║  └────────┘  └────────┘  └────────┘  └────────┘        ║
║                                                          ║
║  Panel 5      Panel 6                                   ║
║  ┌────────┐  ┌────────┐                                 ║
║  │ Drag   │  │ Drag   │                                 ║
║  │ asset  │  │ asset  │                                 ║
║  │  ke    │  │  ke    │                                 ║
║  │ sini   │  │ sini   │                                 ║
║  └────────┘  └────────┘                                 ║
║                                                          ║
║  💡 Tip: Drag aset dari library atau klik untuk         ║
║     auto-assign ke panel kosong pertama                 ║
║                                                          ║
║         [ Bersihkan ]  [ Rakit & Simpan Komik ]         ║
╚══════════════════════════════════════════════════════════╝
```

**Fitur Drag-and-Drop:**
- ✨ Visual feedback: opacity saat drag, scale saat hover
- 🎨 Color change: Panel berubah hijau saat siap drop
- 📸 Preview langsung setelah drop
- ♻️ Dapat menghapus asset atau panel
- 🔄 Reset button untuk clear semua

---

### **Comic Reader - Student Interface**
```
╔═══════════════════════════════════════════════════════════╗
║                     BAB 1: Hukum Newton                  ║
║                                                            ║
║              ╔════════════════════════╗                   ║
║              ║                        ║                   ║
║              ║    [Page Flip]         ║                   ║
║              ║    Animation            ║                   ║
║              ║    400x550px            ║                   ║
║              ║                        ║                   ║
║              ║    Smooth transitions   ║                   ║
║              ║    with realistic       ║                   ║
║              ║    page turning        ║                   ║
║              ║                        ║                   ║
║              ╚════════════════════════╝                   ║
║                                                            ║
║    [◀ Prev]  Halaman 3 dari 20  [Next ▶]                 ║
║                                                            ║
║    [💰 Klaim Reward]  [ 🎓 Selesai ]                      ║
║                                                            ║
╚═══════════════════════════════════════════════════════════╝

Fitur:
✅ Page-flip animation dengan St.PageFlip
✅ Dynamic page loading
✅ Navigation controls
✅ Confetti animation saat selesai
✅ Reward system dengan SweetAlert modal
✅ Anti-spam protection (1 claim per user)
```

---

### **Manajemen Komik - Dashboard Guru**
```
╔════════════════════════════════════════════════════════════════╗
║  📚 Manajemen Komik                                            ║
╠════════════════════════════════════════════════════════════════╣
║                                                                ║
║  No│ Bab │Judul          │Deskripsi    │Halaman│ Aksi        ║
║  ──┼─────┼───────────────┼─────────────┼────────┼──────────   ║
║  1 │ 1   │Hukum Newton   │Pengenalan   │ 15    │ 👁️ 🗑️      ║
║    │     │              │ gaya...     │       │              ║
║  ──┼─────┼───────────────┼─────────────┼────────┼──────────   ║
║  2 │ 2   │Energi Kinetik │Energi      │ 12    │ 👁️ 🗑️      ║
║    │     │              │ dalam gerak │       │              ║
║  ──┼─────┼───────────────┼─────────────┼────────┼──────────   ║
║                                                                ║
╚════════════════════════════════════════════════════════════════╝
```

---

### **Admin Sidebar Layout**
```
╔════════════════════════════════════════════════════════════════╗
║  280px                                                         ║
║  Fixed Sidebar                      Main Content (responsive)  ║
║                                                                ║
║  ┌──────────────┐                                             ║
║  │ 📚 Beranda   │                                             ║
║  │              │ MANAJEMEN KONTEN                            ║
║  │ 📁 Kategori │ ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━     ║
║  │ 📚 Komik    │                                             ║
║  │ ⬆️  Upload  │ Breadcrumb: Beranda / Unggah Komik         ║
║  │ 🎯 Kuis     │                                             ║
║  │              │ ┌─────────────────────────────────────────┐ ║
║  │ 📊 Nilai    │ │ Studio Perakitan Komik                  │ ║
║  │ 📢 Pengum   │ │                                         │ ║
║  │ 💬 Chat    │ │ [Content goes here...]                  │ ║
║  │              │ │                                         │ ║
║  │ 👤 Profile  │ └─────────────────────────────────────────┘ ║
║  │ 🚪 Logout  │                                             ║
║  │              │                                             ║
║  └──────────────┘                                             ║
│                                                                ║
```

**Design Elements:**
- 280px fixed sidebar dengan gradient background
- Menu section labels: MENU UTAMA, MANAJEMEN KONTEN, PEMANTAUAN & INTERAKSI
- Active state: Yellow/orange highlight (#fff3e0)
- Sticky topbar dengan page title & breadcrumb
- Responsive mobile design

---

## 2. 🛠️ Tech Stack yang Digunakan

### **Backend Framework**
```
┌─────────────────────────────────────┐
│ PHP 8.2+                           │
│ └─ Laravel 12.0 (Web Framework)    │
│    └─ Eloquent ORM                 │
│    └─ Blade Template Engine        │
│    └─ Laravel Tinker               │
│                                     │
└─────────────────────────────────────┘
```

### **Frontend Framework & Libraries**
```
┌─────────────────────────────────────┐
│ HTML5 + CSS3                        │
│ │                                   │
│ ├─ Bootstrap 5.3.2 (UI Components) │
│ ├─ Tailwind CSS 4.0.0 (Utilities)  │
│ │                                   │
│ └─ JavaScript (ES6+)                │
│    ├─ Vite 7.0.7 (Build Tool)      │
│    ├─ Axios 1.11.0 (HTTP Client)   │
│    │                                 │
│    └─ Frontend Libraries (CDN):     │
│       ├─ St.PageFlip (Page-flip)   │
│       ├─ Sortable.js 1.15.0 (D&D)  │
│       ├─ SweetAlert2 (Modals)      │
│       ├─ Canvas-Confetti (Effects) │
│       ├─ Lottie Player (Animations)│
│       └─ Font Awesome 6.x (Icons)  │
│                                     │
└─────────────────────────────────────┘
```

### **Database**
```
┌─────────────────────────────────────┐
│ MySQL / SQLite                      │
│ (via Laravel Migrations)            │
│                                     │
│ Tables:                             │
│ • users                             │
│ • comics                            │
│ • comic_reads (reward tracking)     │
│ • chat_messages                     │
│ • kelompok_belajar (study groups)   │
│ • pengumuman (announcements)        │
│                                     │
└─────────────────────────────────────┘
```

### **Integrations**
- **Google API Client 2.19** - Google Sheets reporting
- **File Storage** - Public disk for comic assets

### **Development Tools**
| Tool | Version | Purpose |
|------|---------|---------|
| Composer | Latest | PHP package manager |
| NPM | Latest | Node package manager |
| Concurrently | 9.0.1 | Run multiple processes |
| Laravel Pail | 1.2.2 | Log monitoring |
| PHPUnit | 11.5.50 | Testing framework |
| Faker | 1.23 | Test data generation |
| Pint | 1.24 | Code formatter |

---

## 3. 🚀 Cara Menjalankan Kodenya

### **Prerequisites**
Sebelum menjalankan, pastikan sudah terinstall:
- ✅ **PHP 8.2+** (Included di XAMPP)
- ✅ **Composer** (Package manager PHP)
- ✅ **Node.js & NPM** (Frontend build tools)
- ✅ **MySQL** (Included di XAMPP)
- ✅ **XAMPP** (Sudah terinstall)

---

### **Step 1: Navigate to Project Directory**
```bash
cd d:\new-xampp\htdocs\studystrip
```

---

### **Step 2: Install Dependencies**

**Install PHP packages:**
```bash
composer install
```

**Install Frontend packages:**
```bash
npm install
```

---

### **Step 3: Setup Environment**

**Copy environment file:**
```bash
copy .env.example .env
```

**Edit `.env` file** (sesuaikan database):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studystrip
DB_USERNAME=root
DB_PASSWORD=

APP_URL=http://localhost:8000
```

---

### **Step 4: Generate Application Key**
```bash
php artisan key:generate
```

---

### **Step 5: Create Database**

Buka **phpMyAdmin** (http://localhost/phpmyadmin) atau gunakan command line:
```bash
mysql -u root -p
> CREATE DATABASE studystrip CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
> EXIT;
```

---

### **Step 6: Run Database Migrations**
```bash
php artisan migrate
```

Jika ada error, reset terlebih dahulu:
```bash
php artisan migrate:fresh
```

---

### **Step 7: (Optional) Seed Sample Data**
```bash
php artisan db:seed
```

---

### **Step 8: Build Frontend Assets**

**For Production:**
```bash
npm run build
```

**For Development (with watch):**
```bash
npm run dev
```

---

### **Step 9: Start the Development Server**

**Option A: Run server saja**
```bash
php artisan serve --port=8000
```

Buka browser: **http://localhost:8000**

---

**Option B: Run lengkap (recommended)**

Buka **3 terminal secara bersamaan:**

**Terminal 1 - Backend Server:**
```bash
php artisan serve --port=8000
```

**Terminal 2 - Frontend Watch (real-time)**
```bash
npm run dev
```

**Terminal 3 - Queue (optional, untuk background jobs):**
```bash
php artisan queue:listen
```

---

### **Quick Start Command (All-in-One)**
```bash
# Composer script yang sudah dikonfigurasi
composer run dev
```

Ini akan automatically start:
- PHP server
- Queue listener
- Frontend vite dev server
- Log monitoring

---

### **Accessing the Application**

| User Type | URL | Email | Password |
|-----------|-----|-------|----------|
| **Siswa** | http://localhost:8000 | student@example.com | password |
| **Guru** | http://localhost:8000/guru | teacher@example.com | password |
| **Admin** | http://localhost:8000/admin | admin@example.com | password |

> 💡 Sesuaikan email/password dengan yang Anda set di database seeder

---

### **Menjalankan Tests (Optional)**
```bash
# Run all tests
composer run test

# Run specific test file
php artisan test tests/Feature/ComicTest.php

# Run with verbose output
php artisan test --verbose
```

---

### **Clear Cache (Jika ada error)**
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Rebuild caches
php artisan config:cache
php artisan view:cache
php artisan route:cache
```

---

### **Troubleshooting**

#### ❌ **Error: Database Connection**
```bash
# Pastikan MySQL running di XAMPP
# Pastikan kredensial di .env benar
php artisan migrate
```

#### ❌ **Error: "Route not found"**
```bash
php artisan route:clear
php artisan route:cache
```

#### ❌ **Error: CSS/JS tidak loading**
```bash
npm run build
php artisan view:clear
# Hard refresh browser: Ctrl+Shift+Del
```

#### ❌ **Error: File upload tidak bisa**
```
Check permissions:
- storage/ folder harus writable
- public/komik/ folder harus ada

Check php.ini:
- upload_max_filesize = 50M
- post_max_size = 50M
```

---

## 📝 Folder Structure
```
studystrip/
├── app/Http/Controllers/
│   └── ComicController.php (Upload, Read, Delete, Reward)
├── app/Models/
│   ├── User.php
│   ├── Comic.php
│   └── ComicRead.php (Reward tracking)
├── resources/views/
│   ├── guru/
│   │   ├── upload-komik.blade.php (Studio Upload)
│   │   ├── komik.blade.php (Management)
│   │   └── dashboard.blade.php
│   ├── siswa/
│   │   ├── baca-komik.blade.php (Reader)
│   │   └── katalog.blade.php
│   ├── layouts/
│   │   ├── master-guru.blade.php (Admin layout)
│   │   └── app.blade.php (Student layout)
│   └── auth/
├── routes/
│   └── web.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── komik/ (Comic assets storage)
│   │   ├── 1/pages/ (Comic ID folders)
│   │   └── sample/ (Test data)
│   └── images/
├── resources/js/ & css/
├── config/
├── storage/
├── composer.json
├── package.json
└── vite.config.js
```

---

## ✅ Checklist Sebelum Submit

- [ ] Server berjalan tanpa error
- [ ] Database terisi data
- [ ] Login berhasil
- [ ] Halaman loading dengan benar
- [ ] CSS/JS/Assets muncul dengan benar
- [ ] Drag-and-drop upload komik berfungsi
- [ ] Comic reader page-flip bekerja
- [ ] Tombol reward dapat diklik
- [ ] Admin sidebar merespons dengan baik

---

**Status**: ✅ Ready to Deploy  
**Last Updated**: May 22, 2026
