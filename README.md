<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## 🧩 Instalasi

### Prasyarat
- PHP 8.2 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL
- Git

### Langkah Instalasi

#### 1️⃣ Clone Repository
```bash
git clone https://github.com/frenkyestiawan/Mandiri_CRUD_Library.git
cd Mandiri_CRUD_Library
```

#### 2️⃣ Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

#### 3️⃣ Konfigurasi Environment
```bash
# Salin file environment
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mandiri_crud_library
DB_USERNAME=root
DB_PASSWORD=
```

#### 4️⃣ Setup Role, Storage & Gambar Produk

> **⚠️ PENTING:** Langkah ini wajib dilakukan agar seeder berjalan dengan baik!
```bash
# Install package spatie/laravel-permission
composer require spatie/laravel-permission

# Publish migration dan konfigurasi
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# Buat symbolic link untuk storage
php artisan storage:link

# Buat folder covers (jika belum ada)
mkdir -p storage/app/public/covers
```

**Salin gambar covers:**
Pindahkan/salin semua file gambar dari `public/assets/covers` ke `storage/app/public/covers`



#### 5️⃣ Generate Key & Migrasi Database
```bash
# Generate application key
php artisan key:generate

# Jalankan migrasi dan seeder
php artisan migrate --seed
```

#### 6️⃣ Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

#### 7️⃣ Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`

---

## 🔐 Akun Default

Setelah menjalankan seeder, gunakan kredensial berikut untuk login:

| Role | Email | Password |
|:-----|:------|:---------|
| 🔴 **Admin** | `admin@example.com` | `password` |
| 🔵 **Member** | `member1@example.com` sampai `member8@example.com` | `password` |

> **⚠️ KEAMANAN:** Segera ubah password default setelah instalasi pertama kali!

---
