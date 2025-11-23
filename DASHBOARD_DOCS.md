# BiomediHub - Dashboard System Documentation

## 🎉 Fitur Lengkap yang Telah Diimplementasikan

### ✅ Role-Based Access Control (RBAC)
Sistem memiliki 2 role utama:
1. **Admin** - Full access untuk mengelola materi
2. **Mahasiswa** - Akses read-only untuk melihat dan download materi

### ✅ Dashboard Admin
**URL**: `/admin/dashboard`

**Fitur:**
- Dashboard overview dengan statistik
- CRUD lengkap untuk materi kuliah
- Upload file (PDF, DOC, DOCX, PPT, PPTX)
- Organisasi materi per semester (1-8)
- Quick actions untuk akses cepat

**Halaman Admin:**
- `/admin/dashboard` - Dashboard utama
- `/admin/materials` - Daftar semua materi
- `/admin/materials/create` - Tambah materi baru
- `/admin/materials/{id}/edit` - Edit materi

### ✅ Dashboard Mahasiswa
**URL**: `/mahasiswa/dashboard`

**Fitur:**
- Dashboard dengan overview materi
- Browse materi per semester
- View detail materi lengkap
- Download file materi
- Read-only access (tidak bisa edit/delete)

**Halaman Mahasiswa:**
- `/mahasiswa/dashboard` - Dashboard utama
- `/mahasiswa/materials?semester={1-8}` - Daftar materi per semester
- `/mahasiswa/materials/{id}` - Detail materi

### ✅ Sidebar Component
Komponen sidebar reusable yang digunakan di kedua dashboard:
- **File**: `resources/views/components/sidebar.blade.php`
- Navigasi berbeda untuk admin dan mahasiswa
- User info display
- Logout functionality
- Semester navigation (untuk mahasiswa)

## 📊 Database Schema

### Tabel: `roles`
```
id          - Primary Key
name        - Role name (admin, mahasiswa)
display_name- Human readable name
description - Role description
timestamps
```

### Tabel: `users`
```
id          - Primary Key
role_id     - Foreign Key to roles
name        - User name
email       - Unique email
password    - Hashed password
timestamps
```

### Tabel: `materials`
```
id          - Primary Key
title       - Material title
description - Short description
content     - Full content
file_path   - Path to uploaded file
semester    - Semester (1-8)
mata_kuliah - Course name
user_id     - Foreign Key to users (uploader)
timestamps
```

## 🔐 Default Akun

### Admin Account
- Email: `admin@biomedihub.com`
- Password: `password123`
- Role: Administrator

### Mahasiswa Account
- Email: `mahasiswa@biomedihub.com`
- Password: `password123`
- Role: Mahasiswa

## 🚀 Cara Penggunaan

### 1. Setup Database
Pastikan database sudah dikonfigurasi di `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biomed_hub
DB_USERNAME=root
DB_PASSWORD=
```

### 2. Migrasi & Seed
```bash
php artisan migrate:fresh --seed
```

### 3. Storage Link
```bash
php artisan storage:link
```

### 4. Jalankan Server
```bash
# Terminal 1: Dev Server
npm run dev

# Terminal 2: PHP Server
php artisan serve
```

### 5. Akses Aplikasi
- Landing Page: http://localhost:8000
- Login: http://localhost:8000/login
- Register: http://localhost:8000/register

## 📁 Struktur File

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AdminDashboardController.php
│   │   ├── MahasiswaDashboardController.php
│   │   ├── MaterialController.php
│   │   └── AuthController.php
│   └── Middleware/
│       └── CheckRole.php
├── Models/
│   ├── Role.php
│   ├── Material.php
│   └── User.php
│
resources/
├── views/
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   └── materials/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       └── edit.blade.php
│   ├── mahasiswa/
│   │   ├── dashboard.blade.php
│   │   ├── materials.blade.php
│   │   └── material-detail.blade.php
│   └── components/
│       ├── navbar.blade.php
│       └── sidebar.blade.php
│
database/
├── migrations/
│   ├── 2024_01_01_000000_create_roles_table.php
│   └── 2024_01_01_000001_create_materials_table.php
└── seeders/
    └── RoleSeeder.php
```

## 🎨 Fitur UI/UX

### Tema Warna
- **Primary (Merah)**: Buttons, accents, highlights
- **Beige**: Backgrounds, secondary elements
- Gradient backgrounds untuk hero sections
- Hover effects dan transitions

### Responsive Design
- Mobile-friendly sidebar
- Responsive grid layouts
- Adaptive navigation

### Components
- Custom button styles (btn-primary, btn-secondary)
- Card components untuk materi
- Form inputs dengan Tailwind styling
- Icons dari Heroicons

## 🔒 Security Features

### RBAC Implementation
- Middleware `CheckRole` untuk proteksi route
- Role-based redirects setelah login
- Permission checking di controller level

### File Upload Security
- Validasi tipe file (PDF, DOC, DOCX, PPT, PPTX)
- Maximum file size: 10MB
- Secure file storage di `storage/app/public/materials`

## 📝 Workflow

### Admin Workflow
1. Login sebagai admin
2. Redirect ke admin dashboard
3. Bisa CRUD materi:
   - Create: Tambah materi baru dengan file
   - Read: Lihat semua materi
   - Update: Edit materi yang ada
   - Delete: Hapus materi
4. Filter materi per semester
5. Quick access untuk semua fungsi

### Mahasiswa Workflow
1. Login/Register sebagai mahasiswa
2. Redirect ke mahasiswa dashboard
3. Browse materi per semester (1-8)
4. Klik materi untuk lihat detail lengkap
5. Download file jika tersedia
6. Read content dalam platform

## 🎯 Perbedaan Admin vs Mahasiswa

| Fitur | Admin | Mahasiswa |
|-------|-------|-----------|
| View Materi | ✅ | ✅ |
| Create Materi | ✅ | ❌ |
| Edit Materi | ✅ | ❌ |
| Delete Materi | ✅ | ❌ |
| Upload File | ✅ | ❌ |
| Download File | ✅ | ✅ |
| Filter Semester | ✅ | ✅ |
| User Management | ✅ | ❌ |

## 🔄 Future Enhancements (Opsional)

- [ ] Forum diskusi per materi
- [ ] Comment system
- [ ] Rating/review materi
- [ ] Search functionality
- [ ] Advanced filtering (by mata kuliah, date)
- [ ] Export data ke Excel/PDF
- [ ] Email notifications
- [ ] Material favorites/bookmarks
- [ ] Progress tracking untuk mahasiswa
- [ ] Analytics dashboard untuk admin

## 🐛 Troubleshooting

### File Upload Tidak Berfungsi
```bash
php artisan storage:link
chmod -R 775 storage
```

### Role Tidak Ter-assign
```bash
php artisan migrate:fresh --seed
```

### CSS Tidak Muncul
```bash
npm run build
# atau
npm run dev
```

## 📞 Support

Untuk bantuan atau pertanyaan:
- Email: biomedihub@telkomuniversity.ac.id
- Documentation: Lihat file ini

---

**BiomediHub** - Portal Materi Kuliah & Forum Diskusi
Teknik Biomedis, Telkom University
© 2024
