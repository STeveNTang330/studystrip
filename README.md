# StudyStrip - Platform Pembelajaran Komik Interaktif 📚

Aplikasi web pembelajaran berbasis Laravel yang menggabungkan materi edukasi dengan format komik interaktif. Platform ini dirancang untuk meningkatkan engagement siswa melalui visual storytelling dan memudahkan guru untuk membuat konten pembelajaran yang menarik.

---

## 🎯 Fitur Utama

### 🎓 **Untuk Siswa:**
- **Katalog Komik**: Browse koleksi komik pembelajaran
- **Comic Reader Interaktif**: Page-flip animation, navigation, reward system
- **Dashboard**: Akses cepat ke komik dan pengumuman
- **Chat & Komunitas**: Berkomunikasi dalam study groups

### 👨‍🏫 **Untuk Guru:**
- **Studio Perakitan Komik**: Drag-and-drop upload multi-page
- **Manajemen Komik**: Create, edit, delete, preview
- **Admin Dashboard**: Kategori, quiz, pengumuman, tabel nilai
- **Reporting**: Export ke Google Sheets

---

## 📸 Screenshots

### **1. Login Page**
Clean dan modern authentication interface dengan:
- STUDYstrip branding (navy & orange colors)
- Email & password input dengan icons
- Remember me checkbox
- Forgot password & sign up links
- Responsive card layout
- Light gradient background

![Login Page](docs/screenshots/01-login.png)

### **2. Teacher Upload Studio**
Two-column drag-and-drop interface untuk membuat komik:

**Left Column - Asset Library:**
- File upload dengan drag-drop atau browse
- Thumbnail previews (60x60px)
- File size display
- Delete buttons per asset
- Badge showing assigned panel

**Right Column - Story Board:**
- Auto-generating panels (6+)
- Visual feedback: scale, color, opacity
- Drag asset → drop ke panel
- Panel image preview
- Reset button
- Helper tips

![Upload Komik Studio](docs/screenshots/02-upload-komik.png)

### **3. Comic Reader**
Interactive page-flip reader dengan:
- **St.PageFlip animation** (400x550px)
- Dynamic page loading
- Previous/Next navigation
- Chapter indicator
- Confetti animation saat selesai
- Reward claim button dengan anti-spam
- Galaxy gradient background
- SweetAlert modal notifications

![Comic Reader](docs/screenshots/03-baca-komik.png)

### **4. Comic Management Dashboard**
Tabel manajemen komik dengan:
- Chapter number (badge)
- Title & description
- Page count (badge)
- Preview link (eye icon)
- Delete button
- Responsive table design

![Manajemen Komik](docs/screenshots/04-manajemen-komik.png)

### **5. Admin Sidebar Layout**
Modern admin interface dengan:
- **280px Fixed Sidebar**: Gradient background, section labels
- **Menu Items**:
  - MENU UTAMA: Beranda
  - MANAJEMEN KONTEN: Kategori, Komik, Upload, Kuis
  - PEMANTAUAN: Nilai, Pengumuman, Chat
- **Active State**: Yellow/orange highlight (#fff3e0)
- **Sticky Topbar**: Page title, breadcrumb, user dropdown
- **Responsive**: Mobile-friendly design

![Admin Layout](docs/screenshots/05-admin-layout.png)

---

## 🛠️ Tech Stack

### **Backend**
- **PHP 8.2+**
- **Laravel 12.0** - Web framework
- **Eloquent ORM** - Database ORM
- **Laravel Tinker** - Interactive shell
- **Google API Client 2.19** - Sheets integration

### **Frontend**
- **HTML5 + CSS3**
- **Bootstrap 5.3.2** - UI components
- **Tailwind CSS 4.0** - Utilities
- **Vite 7.0.7** - Build tool
- **Axios 1.11.0** - HTTP client

### **Frontend Libraries (CDN)**
- **St.PageFlip** - Page-flip animation
- **Sortable.js 1.15.0** - Drag-and-drop
- **SweetAlert2** - Beautiful modals
- **Canvas-Confetti** - Celebration effects
- **Lottie Player** - Animations
- **Font Awesome 6.x** - Icons

### **Database**
- **MySQL** (dengan Laravel Migrations)
- **Tables**: users, comics, comic_reads, chat_messages, pengumuman, dll

### **Development Tools**
- Composer, NPM, PHPUnit, Faker, Pint, Laravel Pail

---

## 🚀 Cara Menjalankan

### **Prerequisites**
```
✅ PHP 8.2+ (XAMPP included)
✅ Composer
✅ Node.js & NPM  
✅ MySQL (XAMPP included)
```

### **Setup & Run (5 menit)**

```bash
# 1. Navigate to project
cd d:\new-xampp\htdocs\studystrip

# 2. Install dependencies
composer install
npm install

# 3. Setup environment
copy .env.example .env
php artisan key:generate

# 4. Create & migrate database
# Di phpMyAdmin: CREATE DATABASE studystrip;
php artisan migrate

# 5. Optional: seed sample data
php artisan db:seed

# 6. Build frontend
npm run build

# 7. Start server (Terminal 1)
php artisan serve --port=8000

# 8. Optional: Watch frontend changes (Terminal 2)
npm run dev
```

**Access at:** http://localhost:8000

### **Default Credentials** (if seeded)
```
Student: student@example.com / password
Teacher: teacher@example.com / password
```

---

## 📁 Project Structure

```
studystrip/
├── app/
│   ├── Http/Controllers/ComicController.php
│   └── Models/ (User, Comic, ChatMessage, etc)
├── resources/
│   ├── views/
│   │   ├── guru/ (teacher pages)
│   │   ├── siswa/ (student pages)
│   │   ├── auth/
│   │   └── layouts/
│   ├── css/ & js/
├── routes/web.php
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── komik/ (comic assets: ID/pages/)
│   └── images/
├── config/
├── storage/
├── tests/
├── composer.json
├── package.json
├── vite.config.js
└── README.md
```

---

## ✨ Fitur-Fitur

| Fitur | Status | Teknologi |
|-------|--------|-----------|
| Drag-and-drop upload | ✅ | Sortable.js |
| Page-flip reader | ✅ | St.PageFlip |
| Confetti animation | ✅ | canvas-confetti |
| Reward system | ✅ | Laravel + SweetAlert |
| Admin sidebar | ✅ | Bootstrap + CSS |
| Multi-image support | ✅ | File validation |
| Responsive design | ✅ | Bootstrap |
| Dark mode | 🔄 | Planned |
| Character animation | 🔄 | Lottie (setup ready) |

---

## 🎯 Troubleshooting

### Error: Database Connection
```bash
# Check XAMPP MySQL is running
php artisan migrate
```

### Error: CSS/JS Not Loading
```bash
npm run build
php artisan view:clear
# Hard refresh: Ctrl+Shift+Del
```

### Error: File Upload Failed
```
Check:
- storage/ folder writable
- public/komik/ exists
- php.ini: upload_max_filesize = 50M
```

### Error: Route Not Found
```bash
php artisan route:clear
php artisan route:cache
```

---

## 📚 Documentation

- **Full Setup Guide**: See [PROJECT_DOCUMENTATION.md](./PROJECT_DOCUMENTATION.md)
- **Assignment Docs**: See [TUGAS_DOKUMENTASI.md](./TUGAS_DOKUMENTASI.md)

---

## 🔗 Repository

- **GitHub**: https://github.com/STeveNTang330/studystrip
- **Status**: ✅ Production Ready

---

## 📝 Notes

- **File Upload Limit**: 50MB per file
- **Supported Formats**: JPG, PNG, SVG, WebP, GIF (including animated)
- **Database**: MySQL 5.7+ or SQLite
- **Browser**: Modern browsers with HTML5 support

---

**Version**: 1.0  
**Last Updated**: May 22, 2026  
**License**: MIT
