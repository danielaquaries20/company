# Company Profile Website - CodeIgniter 4

Website company profile dinamis dengan admin panel untuk PT. Samsudi Indoniaga Sedaya, dibangun menggunakan CodeIgniter 4 dengan arsitektur OOP modern.

## 🚀 Fitur Utama

### Frontend (Website Publik)

- **Responsive Design**: Website yang mobile-friendly dan SEO optimized
- **Dynamic Content**: Semua konten diambil dari database
- **Hero Section**: Background image dan tagline yang dapat diubah dari admin
- **About Section**: Informasi perusahaan dengan gambar yang dapat diupload
- **Services**: Layanan perusahaan dengan icon Font Awesome yang dapat dipilih
- **Partners**: Logo dan informasi partner/mitra dengan upload gambar
- **Contact Form**: Form kontak dengan notifikasi dan tersimpan ke database
- **Professional Icons**: Menggunakan Font Awesome 6.4.0

### Backend (Admin Panel)

- **Dashboard**: Statistik pesan dan overview data
- **Contact Management**: Kelola pesan masuk dari website dengan bulk actions
- **Company Settings**: Atur informasi perusahaan, upload logo, background
- **Services Management**: CRUD layanan dengan icon picker interaktif
- **Partners Management**: CRUD partner dengan upload logo
- **Image Upload**: Upload dan hapus gambar dengan preview dan validasi
- **User Management**: Login/logout admin dengan session
- **Password Management**: Ganti password admin
- **Data Initialization**: Setup data awal otomatis

## 📋 Requirements

- **PHP**: 8.1 atau lebih baru
- **Composer**: Package manager untuk PHP
- **Database**: MySQL 5.7+ atau MariaDB 10.3+
- **Web Server**: Apache/Nginx dengan mod_rewrite enabled
- **PHP Extensions**: `intl`, `mbstring`, `json`, `mysqlnd`, `xml`, `curl`, `gd`

## 🛠️ Instalasi & Setup

### 1. Download Project

```bash
# Clone atau download project ini
git clone [repository-url]
cd company-profile

# Atau extract dari ZIP file
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
# Copy environment file
cp env .env

# Edit .env file dan sesuaikan konfigurasi database
```

**Edit file `.env`:**

```env
# Database Configuration
database.default.hostname = localhost
database.default.database = company_profile_db
database.default.username = root
database.default.password = your_password
database.default.DBDriver = MySQLi

# App Configuration
app.baseURL = 'http://localhost:8080/'
app.indexPage = ''

# Environment
CI_ENVIRONMENT = development
```

### 4. Database Setup

```bash
# Buat database (via MySQL client atau phpMyAdmin)
CREATE DATABASE company_profile_db;

# Jalankan migrations
php spark migrate

# Seed data awal dan admin user
php spark db:seed AdminSeeder
```

### 5. Set Permissions

```bash
# Linux/Mac
chmod -R 755 writable/
chmod -R 755 public/assets/images/uploads/

# Windows (via PowerShell as Administrator)
icacls writable /grant Users:F /T
icacls public\assets\images\uploads /grant Users:F /T
```

### 6. Jalankan Server

```bash
# Development server
php spark serve

# Akses website: http://localhost:8080
# Akses admin: http://localhost:8080/admin/login
```

## 🔐 Login Admin

### Default Admin Credentials:

- **URL**: http://localhost:8080/admin/login
- **Username**: admin@company.com
- **Password**: admin123

> ⚠️ **PENTING:** Segera ganti password default setelah login pertama kali via menu "Ganti Password"!

## 📖 Panduan Penggunaan Admin

### 1. Dashboard (/)

- Lihat statistik pesan kontak
- Ringkasan data perusahaan
- Akses cepat ke fitur utama

### 2. Settings Management (/admin/settings)

- Edit informasi perusahaan (nama, tagline, deskripsi)
- Edit visi dan misi perusahaan
- Update informasi kontak (alamat, telepon, email, WhatsApp)
- Update hero section (judul dan subtitle)
- Upload dan kelola gambar (logo, background hero, gambar about)

### 3. Services Management (/admin/services)

- Tambah layanan baru dengan icon picker
- Edit layanan existing
- Hapus layanan (dengan konfirmasi modal)
- Atur urutan tampilan layanan
- Toggle status aktif/nonaktif layanan

### 4. Partners Management (/admin/partners)

- Tambah partner baru dengan upload logo
- Edit partner existing
- Hapus partner (dengan konfirmasi modal)
- Atur urutan tampilan partner
- Toggle status aktif/nonaktif partner

### 5. Contact Messages (/admin/contacts)

- Lihat semua pesan dari form kontak
- Tandai pesan sebagai sudah dibaca
- Hapus pesan individual atau bulk delete
- Filter pesan berdasarkan status

### 6. Change Password (/admin/change-password)

- Ganti password admin
- Validasi password lama
- Konfirmasi password baru

## 🎨 Customization

### Menambah Icon Baru

1. Edit file `app/Views/admin/services.php`
2. Tambahkan icon baru di section icon picker
3. Gunakan class Font Awesome 6.4.0

### Upload Gambar

- **Formats**: JPG, JPEG, PNG, GIF
- **Max Size**: 5MB
- **Location**: `public/assets/images/uploads/`
- **Auto Resize**: Ya, untuk optimasi performa

### Styling

- **Main CSS**: `public/assets/css/main.css`
- **Admin CSS**: Inline di `app/Views/admin/layout.php`
- **Framework**: Custom CSS dengan Flexbox dan Grid

## 🚨 Troubleshooting

### Error "composer not found"

```bash
# Install Composer: https://getcomposer.org/download/
```

### Error "Access denied for user"

```bash
# Fix MySQL credentials di file .env
# Pastikan user MySQL memiliki permission untuk database
```

### Error "Class 'IntlDateFormatter' not found"

```bash
# Install PHP intl extension
# Ubuntu: sudo apt-get install php8.1-intl
# Windows: uncomment extension=intl di php.ini
```

### Upload Error "Permission denied"

```bash
# Set permission untuk upload folder
chmod -R 755 public/assets/images/uploads/
chmod -R 755 writable/
```

### Session Error

```bash
# Clear session dan cache
php spark cache:clear
rm -rf writable/session/*
```

### Reset Database

```bash
# Reset dan seed ulang
php spark migrate:refresh
php spark db:seed AdminSeeder
```

### Debug Mode

Untuk debugging, set di `.env`:

```env
CI_ENVIRONMENT = development
```

Cek log error di: `writable/logs/log-YYYY-MM-DD.php`

## 📁 Struktur Project

```
company-profile/
├── app/
│   ├── Controllers/
│   │   ├── CompanyProfile.php      # Main website controller
│   │   ├── Admin.php               # Admin panel controller
│   │   ├── ImageUpload.php         # Image upload handler
│   │   └── Api/
│   │       ├── CompanyApi.php      # Company API endpoints
│   │       └── PartnerApi.php      # Partner API endpoints
│   ├── Models/
│   │   ├── CompanySettingsModel.php
│   │   ├── AdminUserModel.php
│   │   ├── ServiceModel.php
│   │   ├── PartnerModel.php
│   │   └── ContactModel.php
│   ├── Views/
│   │   ├── company/                # Public website views
│   │   ├── admin/                  # Admin panel views
│   │   └── layouts/                # Layout templates
│   ├── Database/
│   │   ├── Migrations/             # Database migrations
│   │   └── Seeds/                  # Database seeders
│   └── Config/
│       └── Routes.php              # Application routes
├── public/
│   ├── assets/
│   │   ├── css/main.css           # Main stylesheet
│   │   └── images/uploads/        # Upload directory
│   └── index.php
├── writable/                      # Cache, logs, session
└── vendor/                        # Composer dependencies
```

## 🔄 API Endpoints

### Company Settings

- `GET /api/company/settings` - Get all settings
- `POST /api/company/settings` - Update single setting
- `POST /api/company/settings/bulk` - Bulk update settings

### Services

- `GET /api/company/services` - Get all services
- `POST /api/company/services` - Create service
- `PUT /api/company/services/{id}` - Update service
- `DELETE /api/company/services/{id}` - Delete service

### Partners

- `GET /api/partners` - Get all partners
- `POST /api/partners` - Create partner
- `PUT /api/partners/{id}` - Update partner
- `DELETE /api/partners/{id}` - Delete partner

### Image Upload

- `POST /upload/image` - Upload image
- `POST /upload/delete-image` - Delete image

## 📱 Features Detail

### Icon Picker

- Grid layout dengan kategori icon
- Preview real-time
- Search functionality
- Auto-close setelah memilih
- Support 100+ Font Awesome icons

### Image Management

- Upload dengan drag & drop
- Preview sebelum upload
- Auto resize dan kompres
- Delete dari database dan filesystem
- Support multiple formats

### Contact Form

- Validasi client-side dan server-side
- Notification box custom
- Auto-save ke database
- Spam protection

### Partner Management

- Upload logo partner
- Sorting berdasarkan urutan
- Status aktif/nonaktif
- Bulk operations

## 🎯 Production Deployment

### 1. Server Requirements

- PHP 8.1+ dengan ekstensi yang diperlukan
- MySQL/MariaDB
- Apache/Nginx dengan mod_rewrite
- SSL Certificate (recommended)

### 2. Environment Setup

```env
CI_ENVIRONMENT = production
app.baseURL = 'https://yourdomain.com/'
```

### 3. Security

- Ganti password admin default
- Set permission file yang benar
- Enable HTTPS
- Configure firewall
- Regular backup database

### 4. Performance

- Enable OPcache
- Configure MySQL query cache
- Use CDN untuk assets
- Gzip compression
- Browser caching

## 🛡️ Security Features

### Authentication

- Secure admin login dengan session
- Password hashing dengan bcrypt
- CSRF protection pada semua form
- Session timeout dan regeneration

### Input Validation

- Server-side validation untuk semua input
- XSS protection dengan HTML escaping
- SQL injection prevention dengan prepared statements
- File upload validation (type, size, security)

### Image Upload Security

- File type validation
- MIME type checking
- File size limits
- Secure file naming
- Directory traversal prevention

## 📞 Support

Jika mengalami masalah atau butuh bantuan:

1. **Cek log error**: `writable/logs/`
2. **Reset database**: `php spark migrate:refresh && php spark db:seed AdminSeeder`
3. **Clear cache**: `php spark cache:clear`
4. **Check permissions**: Upload folder dan writable folder
5. **Verify environment**: File .env dan database connection

## ✅ Completed Features

### Frontend

- [x] Responsive design untuk semua device
- [x] Hero section dengan background image dinamis
- [x] About section dengan gambar dan konten dinamis
- [x] Services section dengan icon Font Awesome
- [x] Partners section dengan logo upload
- [x] Contact form dengan validasi dan notifikasi
- [x] Font Awesome 6.4.0 integration

### Backend Admin Panel

- [x] Admin authentication (login/logout)
- [x] Dashboard dengan statistik
- [x] Company settings management
- [x] Services CRUD dengan icon picker
- [x] Partners CRUD dengan image upload
- [x] Contact messages management
- [x] Image upload dengan preview dan validasi
- [x] Bulk actions untuk kontak
- [x] Password change functionality
- [x] Modal confirmations untuk delete
- [x] Real-time form validation
- [x] Responsive admin interface

### Technical

- [x] CodeIgniter 4 OOP architecture
- [x] RESTful API endpoints
- [x] Database migrations dan seeding
- [x] Session management
- [x] File upload dengan validasi
- [x] Error handling dan logging
- [x] Input sanitization
- [x] CSRF protection
- [x] Form validation client & server side

## 📝 License

Project ini dibuat untuk PT. Samsudi Indoniaga Sedaya menggunakan CodeIgniter 4 framework.

## 🔄 Changelog

### Version 1.0.0 (June 2025)

- Initial release dengan fitur lengkap
- Admin panel dengan authentication
- Dynamic content management
- Image upload dan management
- Contact form dengan database storage
- Services management dengan icon picker
- Partners management dengan logo upload
- Responsive design untuk semua device
- RESTful API endpoints
- Database migrations dan seeding

---

**Last Updated**: June 2025  
**Version**: 1.0.0  
**Framework**: CodeIgniter 4.6.1  
**Created with ❤️ for PT. Samsudi Indoniaga Sedaya**
