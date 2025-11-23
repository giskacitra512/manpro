# BiomediHub - Setup Documentation

## Project Overview
BiomediHub adalah platform digital untuk mahasiswa Teknik Biomedis Telkom University yang menyediakan akses materi kuliah dan forum diskusi.

## Fitur yang Telah Diimplementasikan

### 1. Tailwind CSS Configuration
- ✅ Configured dengan tema warna merah (primary) dan beige
- ✅ Custom color palette untuk branding
- ✅ Custom button components (btn-primary, btn-secondary)

### 2. Landing Page (resources/views/home.blade.php)
Landing page terdiri dari 3 section utama:

#### Home Section
- Hero section dengan gradient background merah
- Call-to-action buttons (Login/Register)
- Highlight fitur utama (Materi Lengkap, Forum Diskusi, Komunitas Aktif)

#### About Section
- Penjelasan tentang platform BiomediHub
- 3 feature cards: Materi Kuliah, Forum Diskusi, Sumber Daya
- Statistik platform (500+ Mahasiswa, 1000+ Materi, 24/7 Akses)

#### Contact Section
- Form kontak interaktif
- Informasi kontak lengkap (Alamat, Email, Telepon)
- Social media links

### 3. Navbar Component (resources/views/components/navbar.blade.php)
- ✅ Responsive navbar dengan mobile menu
- ✅ Navigation links (Home, About, Contact)
- ✅ Authentication buttons (Login/Register atau User info/Logout)
- ✅ Logo BiomediHub dengan initial "TB"

### 4. Authentication System

#### Routes (routes/web.php)
```php
GET  /          -> Landing page
GET  /login     -> Login form
POST /login     -> Process login
GET  /register  -> Register form
POST /register  -> Process registration
POST /logout    -> Logout user
```

#### Controller (app/Http/Controllers/AuthController.php)
- `showLoginForm()` - Menampilkan form login
- `login()` - Memproses login dengan validasi
- `showRegisterForm()` - Menampilkan form register
- `register()` - Memproses registrasi dengan validasi
- `logout()` - Logout dan clear session

#### Views
- `resources/views/auth/login.blade.php` - Form login dengan desain modern
- `resources/views/auth/register.blade.php` - Form registrasi dengan validasi password

## Tema Warna

### Primary (Merah)
- primary-50 to primary-900
- Digunakan untuk: buttons, links, accents

### Beige
- beige-50 to beige-900
- Digunakan untuk: backgrounds, secondary elements

## Cara Menjalankan Project

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

### 2. Migrasi Database
```bash
php artisan migrate
```

### 3. Compile Assets
```bash
npm install
npm run build
```

Atau untuk development dengan hot reload:
```bash
npm run dev
```

### 4. Jalankan Server
```bash
php artisan serve
```

Akses aplikasi di: http://localhost:8000

## File Structure

```
resources/
├── css/
│   └── app.css                    # Tailwind directives & custom components
├── views/
│   ├── home.blade.php            # Landing page
│   ├── auth/
│   │   ├── login.blade.php       # Login page
│   │   └── register.blade.php    # Register page
│   └── components/
│       └── navbar.blade.php      # Navbar component
│
app/
└── Http/
    └── Controllers/
        └── AuthController.php     # Authentication controller

routes/
└── web.php                        # Web routes

tailwind.config.cjs                # Tailwind configuration
```

## Fitur Keamanan
- ✅ Password hashing dengan bcrypt
- ✅ CSRF protection pada semua forms
- ✅ Session regeneration setelah login
- ✅ Password confirmation pada register
- ✅ Email validation
- ✅ Minimum password length (8 characters)

## Next Steps (Pengembangan Selanjutnya)
- [ ] Implementasi halaman dashboard setelah login
- [ ] Sistem upload dan manajemen materi kuliah
- [ ] Forum diskusi dengan kategori
- [ ] Profil user
- [ ] Email verification
- [ ] Password reset functionality
- [ ] Role management (Admin, Dosen, Mahasiswa)

## Support
Untuk pertanyaan atau bantuan, hubungi:
- Email: biomedihub@telkomuniversity.ac.id
- Tel: +62 22 7564108
