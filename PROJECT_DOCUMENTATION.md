# 📚 StudyStrip - Platform Pembelajaran Komik Interaktif

## Deskripsi Proyek

**StudyStrip** adalah platform pembelajaran berbasis web yang menggabungkan materi edukasi dengan format komik interaktif. Platform ini dirancang untuk meningkatkan engagement siswa melalui visual storytelling dan memudahkan guru untuk membuat konten pembelajaran yang menarik.

### Fitur Utama

#### 🎓 **Untuk Siswa:**
- **Katalog Komik**: Browsing koleksi komik pembelajaran yang tersedia
- **Comic Reader Interaktif**: 
  - Animasi page-flip yang smooth (400x550px)
  - Navigasi chapter dan halaman
  - Konfetti animation saat menyelesaikan komik
  - Sistem reward claim dengan anti-spam protection
- **Dashboard Siswa**: Akses cepat ke komik dan pengumuman

#### 👨‍🏫 **Untuk Guru:**
- **Studio Perakitan Komik**: Interface drag-and-drop untuk membuat komik
  - Upload multi-file aset visual (JPG, PNG, SVG, WebP, GIF)
  - Penyusunan halaman visual dengan storyboard interaktif
  - Live preview asset arrangement
  - Support untuk animasi GIF
- **Manajemen Komik**: Dashboard untuk mengelola komik yang sudah dibuat
  - View, edit, delete komik
  - Lihat statistik pembacaan
- **Berbagai Tool Admin**: Kategori, Quiz, Pengumuman, Chat, Tabel Nilai

---

## 📸 Screenshot Proyek

### 1. **Login Page**
Halaman autentikasi dengan desain modern dan clean:
- Email/password input fields
- Remember me checkbox
- Link daftar untuk user baru

```
┌─────────────────────────────────────┐
│           STUDYstrip                │
│                                     │
│        Selamat Datang               │
│                                     │
│  Email:    [________________]       │
│  Password: [________________]       │
│                                     │
│  ☐ Ingat saya    Lupa Sandi?       │
│                                     │
│         [ Login ]                   │
│                                     │
│  Belum punya akun? Daftar di sini   │
└─────────────────────────────────────┘
```

### 2. **Student Dashboard**
Homepage untuk siswa dengan:
- Greeting personalized
- List komik terbaru
- Informasi chapter dan status pembacaan
- Quick navigation ke katalog

### 3. **Comic Reader (Katalog Komik)**
Halaman pembacaan komik dengan fitur:
- **Page Flip Animation**: Animasi page-turning yang realistis
  - Fixed dimension: 400x550px
  - Smooth transition effect
  - Cover page dengan episode info
- **Navigation Controls**:
  - Previous/Next buttons
  - Chapter indicator
  - Progress bar
- **Completion Features**:
  - Confetti animation di halaman akhir
  - "Claim Reward" button
  - Anti-spam protection (1 reward per user per comic)
- **Visual Design**:
  - Galaxy gradient background (#2b1055)
  - Bootstrap responsive cards
  - Modal reward notification

### 4. **Upload Komik (Teacher Studio)**
Interface perakitan komik dengan 2 section utama:

**Section 1: Informasi Dasar Bab**
```
┌─────────────────────────────────────┐
│ Nomor Bab: [__]                     │
│ Judul: [________________________]   │
│ Deskripsi: [__________________]     │
│            [__________________]     │
└─────────────────────────────────────┘
```

**Section 2: Penyusunan Panel Visual (Drag & Drop)**

**Left Column - Pustaka Aset:**
```
┌──────────────────┐
│  Pustaka Aset    │
│                  │
│ ┌──────────────┐ │
│ │[IMG] File1   │ │  ← Drag dari sini
│ │ 256 KB       │ │
│ │ [✓] Panel 1  │ │
│ │       [del]  │ │
│ └──────────────┘ │
│ ┌──────────────┐ │
│ │[IMG] File2   │ │
│ │ 512 KB       │ │
│ │       [del]  │ │
│ └──────────────┘ │
└──────────────────┘
```

**Right Column - Story Board:**
```
┌─────────────────────────────────────────┐
│ Story Board                    [Reset] │
├─────────────────────────────────────────┤
│ Panel 1    Panel 2    Panel 3    Panel 4│
│ ┌─────┐  ┌─────┐  ┌─────┐  ┌─────┐    │
│ │Drag │  │Drag │  │[IMG]│  │Drag │    │
│ │here │  │here │  │     │  │here │    │
│ │     │  │     │  │ [x] │  │     │    │
│ └─────┘  └─────┘  └─────┘  └─────┘    │
│                                        │
│ Panel 5    Panel 6                     │
│ ┌─────┐  ┌─────┐                      │
│ │Drag │  │Drag │                      │
│ │here │  │here │                      │
│ │     │  │     │                      │
│ └─────┘  └─────┘                      │
│                                        │
│ 💡 Tip: Drag aset dari library atau   │
│    klik untuk auto-assign ke panel    │
└─────────────────────────────────────────┘
```

**Interaksi Drag-and-Drop:**
- **Visual Feedback**:
  - Asset dragging → Opacity 0.5
  - Hover panel → Scale 1.02, border green
  - Drop zone active → Background color change
  - After drop → Image preview di panel
- **Asset Management**:
  - Badge "Panel X" untuk asset yang sudah assigned
  - Delete button di setiap asset
  - Reset button untuk clear semua
- **File Submission**:
  - File diurutkan otomatis sesuai storyboard order
  - Validation minimal 1 asset
  - Hidden field `prompt_script` (auto-generated)

### 5. **Komik Management Dashboard (Teacher)**
Tabel manajemen komik dengan kolom:
- Index, Bab (badge), Judul, Deskripsi (truncated), Halaman (badge), Actions
- Actions: Preview link (eye icon), Delete form

### 6. **Admin Layout/Sidebar**
Layout admin dengan:
- **Sidebar** (280px fixed, gradient background):
  - MENU UTAMA: Beranda
  - MANAJEMEN KONTEN: Kategori & Genre, Manajemen Komik, Unggah Komik, Manajemen Kuis & Misi
  - PEMANTAUAN & INTERAKSI: Tabel Nilai Siswa, Pusat Pengumuman, Pusat Pesan (Chat)
  - Active state: Yellow/orange highlight (#fff3e0)
- **Topbar** (sticky):
  - Page title + breadcrumb
  - User dropdown (settings/logout)
- **Typography**: Orbitron font untuk branding

---

## 🛠️ Tech Stack

### **Backend**
| Technology | Version | Purpose |
|---|---|---|
| **PHP** | 8.2+ | Backend language |
| **Laravel** | 12.0 | Web framework, routing, ORM |
| **Laravel Tinker** | 2.10.1 | Interactive shell for debugging |
| **Google API Client** | 2.19 | Integration dengan Google Sheets (reporting) |

### **Database**
| Technology | Purpose |
|---|---|
| **MySQL/SQLite** | Relational database (via Laravel migrations) |
| **Eloquent ORM** | Object-relational mapping |

### **Frontend**
| Technology | Version | Purpose |
|---|---|---|
| **HTML5** | - | Markup structure |
| **Bootstrap** | 5.3.2 | CSS framework (responsive layout, components) |
| **Vite** | 7.0.7 | Frontend build tool & dev server |
| **Tailwind CSS** | 4.0.0 | Utility-first CSS framework |
| **JavaScript (ES6+)** | - | Client-side interactivity |
| **Axios** | 1.11.0 | HTTP client for API requests |

### **Frontend Libraries (CDN)**
| Library | Version | Purpose |
|---|---|---|
| **St.PageFlip** | Latest | Page-flip animation untuk comic reader |
| **Sortable.js** | 1.15.0 | Drag-and-drop untuk asset management |
| **SweetAlert2** | Latest | Beautiful modal alerts & confirmations |
| **Canvas-Confetti** | Latest | Confetti animation saat comic completion |
| **Lottie Player** | Latest | Animation layer support (setup ready) |
| **Font Awesome** | 6.x | Icon library |

### **Development Tools**
| Tool | Purpose |
|---|---|
| **Composer** | PHP package manager |
| **NPM** | Node package manager |
| **Concurrently** | Run multiple processes simultaneously |
| **Laravel Pail** | Realtime log monitoring |
| **Laravel Pint** | Code formatter |
| **PHPUnit** | Testing framework |
| **Faker** | Generate fake data for testing |

### **Architecture Pattern**
- **MVC Pattern**: Model-View-Controller
- **RESTful API**: For future mobile app integration
- **Middleware**: Authentication, CORS, etc.
- **Database Migrations**: Version control untuk database schema

---

## 🚀 Cara Menjalankan Kode

### **Prerequisites**
Sebelum menjalankan proyek, pastikan sudah terinstall:
- **PHP 8.2+** - [Download](https://www.php.net/downloads)
- **Composer** - [Download](https://getcomposer.org/)
- **Node.js & NPM** - [Download](https://nodejs.org/)
- **MySQL/SQLite** - Included dengan XAMPP
- **XAMPP** - [Download](https://www.apachefriends.org/) (sudah terinstall)

### **Setup Langkah-demi-Langkah**

#### **1. Clone/Extract Project**
```bash
# Jika belum ada di folder
cd d:\new-xampp\htdocs\studystrip
```

#### **2. Install Dependencies**

**A. PHP Dependencies**
```bash
composer install
```

**B. Frontend Dependencies**
```bash
npm install
```

#### **3. Setup Environment File**
```bash
# Copy .env example
cp .env.example .env
```

Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studystrip
DB_USERNAME=root
DB_PASSWORD=

APP_URL=http://localhost:8000
```

#### **4. Generate Application Key**
```bash
php artisan key:generate
```

#### **5. Create Database**
```bash
# Di MySQL (via phpMyAdmin atau command line)
CREATE DATABASE studystrip CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### **6. Run Database Migrations**
```bash
php artisan migrate
```

#### **7. (Optional) Seed Sample Data**
```bash
php artisan db:seed
```

#### **8. Build Frontend Assets**
```bash
npm run build
# Atau untuk development dengan watch:
npm run dev
```

### **Menjalankan Aplikasi**

#### **Option A: Using Artisan Command**
```bash
# Terminal 1: Start development server
php artisan serve --port=8000

# Terminal 2: (Optional) Run queue listener
php artisan queue:listen

# Terminal 3: (Optional) Watch frontend
npm run dev
```

Aplikasi akan accessible di: **http://localhost:8000**

#### **Option B: Using Composer Script**
```bash
# Run semua dalam satu command (recommended)
composer run dev
```

Ini akan start:
- PHP server (port 8000)
- Queue listener
- Vite dev server
- Pail log monitoring

### **Default Credentials**

Jika menggunakan seeder, akun default:

| Role | Email | Password |
|---|---|---|
| **Admin/Guru** | teacher@example.com | password |
| **Siswa** | student@example.com | password |

> 💡 Sesuaikan dengan credentials yang Anda buat di database seeder

### **Folder Structure**

```
studystrip/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Controller untuk handle requests
│   │   └── Middleware/      # Middleware untuk authentication
│   ├── Models/              # Database models (User, Comic, etc)
│   └── Providers/           # Service providers
├── database/
│   ├── migrations/          # Database schema files
│   ├── seeders/             # Sample data
│   └── factories/           # Factory untuk testing
├── resources/
│   ├── css/                 # Stylesheet
│   ├── js/                  # JavaScript files
│   └── views/               # Blade template files
│       ├── layouts/         # Master layout templates
│       ├── guru/            # Teacher pages
│       ├── siswa/           # Student pages
│       └── auth/            # Auth pages
├── routes/
│   └── web.php              # Route definitions
├── public/
│   ├── komik/               # Comic assets storage
│   │   ├── {comic_id}/pages/    # Pages untuk setiap comic
│   │   └── sample/          # Sample data untuk testing
│   └── images/              # Static images
├── storage/                 # File uploads, logs, cache
├── config/                  # Configuration files
├── vendor/                  # Composer packages
├── node_modules/            # NPM packages
├── artisan                  # Laravel command line
├── composer.json            # Composer dependencies
├── package.json             # NPM dependencies
├── vite.config.js           # Vite configuration
└── README.md                # Project readme
```

### **Common Commands**

```bash
# View all available commands
php artisan list

# Create migration file
php artisan make:migration create_table_name

# Make model with migration & factory
php artisan make:model ModelName -m -f

# Create controller
php artisan make:controller ControllerName

# View all routes
php artisan route:list

# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Start fresh (reset database)
php artisan migrate:refresh --seed

# Run tests
composer run test
```

### **Troubleshooting**

#### **Issue: "Connection refused" atau "Database error"**
```bash
# Pastikan MySQL running di XAMPP
# Cek credentials di .env match dengan database

# Reset database:
php artisan migrate:refresh
```

#### **Issue: "Route not found" atau "404 error"**
```bash
# Clear route cache
php artisan route:clear

# Verify routes
php artisan route:list
```

#### **Issue: Assets tidak loading (CSS/JS kosong)**
```bash
# Rebuild frontend
npm run build

# Clear view cache
php artisan view:clear

# Hard refresh browser (Ctrl+Shift+Del)
```

#### **Issue: File upload tidak bisa**
- Check `storage/` folder permissions (harus writable)
- Verify `public/komik/` folder exists
- Check server file upload limit di `php.ini`:
  ```ini
  upload_max_filesize = 50M
  post_max_size = 50M
  ```

#### **Issue: "No application encryption key"**
```bash
php artisan key:generate
```

### **Development Tips**

1. **Hot Reload Frontend**:
   ```bash
   npm run dev  # Vite akan auto-reload saat ada perubahan
   ```

2. **Debug dengan Tinker**:
   ```bash
   php artisan tinker
   >>> User::all();
   >>> Comic::find(1)->pages;
   ```

3. **Tail Logs in Real-time**:
   ```bash
   php artisan pail
   ```

4. **Run Specific Seeder**:
   ```bash
   php artisan db:seed --class=DatabaseSeeder
   ```

5. **Format Code dengan Pint**:
   ```bash
   ./vendor/bin/pint
   ```

---

## 🎯 Fitur Utama dalam Detail

### **Comic Reader Features**
- ✅ St.PageFlip animation (400x550px)
- ✅ Dynamic page loading dari file system
- ✅ Confetti animation on completion
- ✅ SweetAlert modal untuk reward claim
- ✅ Anti-spam reward system (1 claim per user per comic)
- ✅ Galaxy gradient background
- ✅ Responsive design with Bootstrap

### **Upload Komik Features**
- ✅ Multi-file upload dengan validasi
- ✅ Drag-and-drop asset management (Sortable.js)
- ✅ Visual storyboard dengan 6+ panels
- ✅ Real-time visual feedback (scale, color, opacity)
- ✅ Auto-ordering berdasarkan storyboard arrangement
- ✅ Asset deletion dengan index recalculation
- ✅ Reset button untuk clear semua
- ✅ Support format: JPG, PNG, SVG, WebP, GIF

### **Admin Features**
- ✅ Modern sidebar layout (280px fixed)
- ✅ Sticky topbar dengan breadcrumb
- ✅ Active menu state highlighting
- ✅ User dropdown menu
- ✅ Responsive mobile design

---

## 📝 File Utama yang Dimodifikasi

### **Backend**
- `app/Http/Controllers/ComicController.php` - Comic CRUD & file handling
- `app/Models/Comic.php` - Comic model & relationships
- `routes/web.php` - Route definitions

### **Frontend - Views**
- `resources/views/guru/upload-komik.blade.php` - Teacher upload interface
- `resources/views/guru/komik.blade.php` - Comic management dashboard
- `resources/views/siswa/baca-komik.blade.php` - Comic reader
- `resources/views/layouts/master-guru.blade.php` - Admin layout

### **Configuration**
- `.env` - Environment variables
- `config/filesystems.php` - File storage configuration
- `database/migrations/*` - Database schema

---

## 📞 Support & Documentation

- **Laravel Docs**: https://laravel.com/docs
- **Bootstrap Docs**: https://getbootstrap.com/docs
- **Vite Docs**: https://vitejs.dev/
- **St.PageFlip Docs**: https://page-flip.dev/
- **Sortable.js Docs**: https://sortablejs.github.io/Sortable/

---

**Last Updated**: May 22, 2026  
**Project Status**: ✅ Fully Functional
