# CodeIgniter 4 Application

Proyek aplikasi web berbasis CodeIgniter 4 dengan struktur lengkap dan siap untuk pengembangan.

## 📋 Deskripsi Proyek

Proyek ini adalah aplikasi web yang dibangun menggunakan framework CodeIgniter 4 versi 4.7. CodeIgniter adalah framework PHP yang ringan, cepat, fleksibel, dan aman untuk pengembangan aplikasi web.

## 🚀 Fitur Utama

- **Framework CodeIgniter 4.7** - Framework PHP modern dengan performa tinggi
- **Struktur MVC** - Pemisahan logika, tampilan, dan kontrol yang jelas
- **Autoloading PSR-4** - Sistem autoloading modern
- **Testing Framework** - PHPUnit untuk pengujian
- **Environment Configuration** - Konfigurasi lingkungan yang fleksibel
- **Security Features** - Fitur keamanan bawaan framework

## 📁 Struktur Proyek

```
├── app/                    # Direktori aplikasi utama
│   ├── Config/            # Konfigurasi aplikasi
│   │   ├── App.php        # Konfigurasi dasar aplikasi
│   │   ├── Database.php   # Konfigurasi database
│   │   ├── Routes.php     # Konfigurasi routing
│   │   └── ...            # File konfigurasi lainnya
│   ├── Controllers/       # Controller aplikasi
│   │   ├── BaseController.php
│   │   └── Home.php
│   ├── Database/          # Migrasi dan seeder database
│   │   ├── Migrations/
│   │   └── Seeds/
│   ├── Filters/           # Filter HTTP
│   ├── Helpers/           # Helper functions
│   ├── Language/          # File bahasa
│   ├── Libraries/         # Library kustom
│   ├── Models/           # Model data
│   ├── ThirdParty/       # Library pihak ketiga
│   └── Views/            # Template view
│       ├── errors/       # Halaman error
│       └── welcome_message.php
├── public/               # Direktori publik (web root)
│   ├── index.php        # Entry point aplikasi
│   ├── .htaccess        # Konfigurasi Apache
│   └── favicon.ico
├── tests/               # File pengujian
├── vendor/              # Dependensi Composer
├── writable/           # Direktori untuk file yang dapat ditulis
│   ├── cache/          # Cache
│   ├── logs/           # Log aplikasi
│   ├── session/        # Session files
│   └── uploads/        # File upload
├── .env                # Template environment variables
├── composer.json       # Dependensi PHP
├── composer.lock      # Lock file dependensi
├── phpunit.dist.xml   # Konfigurasi PHPUnit
└── spark              # CLI tool CodeIgniter
```

## ⚙️ Persyaratan Sistem

- **PHP 8.2** atau lebih tinggi
- **Ekstensi PHP yang diperlukan:**
  - intl
  - mbstring
  - json (default enabled)
  - mysqlnd (untuk MySQL)
  - libcurl (untuk HTTP\CURLRequest)

## 🛠️ Instalasi

### 1. Clone Repository
```bash
git clone [repository-url]
cd [project-directory]
```

### 2. Install Dependensi
```bash
composer install
```

### 3. Konfigurasi Environment
```bash
cp env .env
```

Edit file `.env` dan sesuaikan dengan konfigurasi lokal:
```env
# Base URL aplikasi
app.baseURL = 'http://localhost:8080/'

# Konfigurasi database
database.default.hostname = localhost
database.default.database = nama_database
database.default.username = username
database.default.password = password
database.default.DBDriver = MySQLi
```

### 4. Konfigurasi Web Server

**Apache:**
- Arahkan document root ke folder `public/`
- Pastikan mod_rewrite diaktifkan

**Nginx:**
```nginx
server {
    listen 80;
    server_name localhost;
    root /path/to/project/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

## 🚦 Penggunaan

### Menjalankan Aplikasi
```bash
# Menggunakan PHP built-in server
php spark serve
# atau
php -S localhost:8080 -t public/
```

Akses aplikasi di browser: `http://localhost:8080`

### CLI Tools (Spark)
```bash
# Menampilkan bantuan
php spark help

# Membuat controller baru
php spark make:controller NamaController

# Membuat model baru
php spark make:model NamaModel

# Menjalankan migrasi
php spark migrate

# Menjalankan seeder
php spark db:seed NamaSeeder
```

## 🧪 Testing

### Menjalankan Tests
```bash
# Menjalankan semua test
composer test
# atau
php spark test

# Menjalankan test tertentu
vendor/bin/phpunit tests/unit/HealthTest.php
```

### Struktur Testing
- `tests/unit/` - Unit tests
- `tests/database/` - Database tests
- `tests/session/` - Session tests
- `tests/_support/` - Support files untuk testing

## 🔧 Konfigurasi Penting

### 1. Konfigurasi Aplikasi (`app/Config/App.php`)
- `$baseURL` - URL dasar aplikasi
- `$indexPage` - Nama file index
- `$defaultLocale` - Bahasa default
- `$appTimezone` - Zona waktu aplikasi

### 2. Konfigurasi Database (`app/Config/Database.php`)
- Konfigurasi koneksi database
- Multiple database connections
- Database testing configuration

### 3. Routing (`app/Config/Routes.php`)
```php
$routes->get('/', 'Home::index');
$routes->get('about', 'Page::about');
$routes->post('contact', 'Contact::submit');
```

## 📝 Pengembangan

### Membuat Controller Baru
```bash
php spark make:controller User
```

File controller akan dibuat di `app/Controllers/User.php`

### Membuat Model Baru
```bash
php spark make:model UserModel
```

File model akan dibuat di `app/Models/UserModel.php`

### Membuat View
Buat file view di `app/Views/` dengan ekstensi `.php`:
```php
<!-- app/Views/user/profile.php -->
<h1>Profil Pengguna</h1>
<p>Nama: <?= $user['name'] ?></p>
```

### Database Migrations
```bash
# Membuat migration baru
php spark make:migration CreateUsersTable

# Menjalankan migrasi
php spark migrate

# Rollback migrasi
php spark migrate:rollback
```

## 🔒 Keamanan

### 1. Environment Variables
- Simpan konfigurasi sensitif di file `.env`
- Jangan commit file `.env` ke repository

### 2. Input Validation
```php
$validation = \Config\Services::validation();
$validation->setRules([
    'email' => 'required|valid_email',
    'password' => 'required|min_length[8]'
]);
```

### 3. CSRF Protection
- Aktifkan CSRF protection di `app/Config/Security.php`
- Gunakan form helper untuk generate CSRF token

## 📊 Logging

Log aplikasi disimpan di `writable/logs/`
- Konfigurasi level log di `app/Config/Logger.php`
- Format log: `log-YYYY-MM-DD.log`

## 🧹 Maintenance

### Clear Cache
```bash
# Clear cache aplikasi
php spark cache:clear

# Clear cache view
rm -rf writable/cache/*
```

### Optimize Autoloader
```bash
composer dump-autoload -o
```

## 🤝 Kontribusi

1. Fork repository
2. Buat branch fitur (`git checkout -b feature/amazing-feature`)
3. Commit perubahan (`git commit -m 'Add amazing feature'`)
4. Push ke branch (`git push origin feature/amazing-feature`)
5. Buat Pull Request

## 📄 Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file [LICENSE](LICENSE) untuk detail.

## 📞 Dukungan

- **Dokumentasi Resmi:** [https://codeigniter.com/user_guide/](https://codeigniter.com/user_guide/)
- **Forum:** [https://forum.codeigniter.com/](https://forum.codeigniter.com/)
- **Slack:** [https://codeigniterchat.slack.com/](https://codeigniterchat.slack.com/)

## 🏗️ Status Proyek

**Versi:** CodeIgniter 4.7  
**Status:** Development  
**PHP Version:** ^8.2  
**Last Updated:** May 2026

---

**Catatan:** Pastikan untuk mengikuti best practices CodeIgniter 4 dan menjaga keamanan aplikasi dengan selalu mengupdate dependensi dan framework ke versi terbaru.