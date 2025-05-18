# Panduan Setup Project materi-bimbingan-karir-wd

Panduan ini akan membantu Anda melakukan setup project materi-bimbingan-karir-wd yang di-clone dari repository dengan benar dan efisien.

## Prasyarat

-   Git terinstall di komputer Anda
-   PHP (versi yang sesuai dengan requirement materi-bimbingan-karir-wd project)
-   Composer terinstall
-   Node.js & NPM (jika project menggunakan frontend assets)
-   Database (MySQL)

## Langkah-Langkah Setup

### 1. Clone Repository GitHub

```bash
git clone https://github.com/bengkelkodingdev/materi-bimbingan-karir-wd.git
cd materi-bimbingan-karir-wd
```

### 2. Install Dependencies via Composer

```bash
composer install
```

### 3. Buat File Environment

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database pada File .env

Buka file `.env` dan sesuaikan konfigurasi database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

### 6. Jalankan Migrasi Database

```bash
php artisan migrate
```

### 7. Jalankan Seeder

```bash
php artisan db:seed
```

### 8. Install Dependencies Frontend

```bash
npm install
```

### 9. Compile Assets Frontend

```bash
npm run build
```

### 10. Buat Symbolic Link untuk Storage (Jika Diperlukan)

```bash
php artisan storage:link
```

### 11. Jalankan Aplikasi

```bash
php artisan serve
```

### 11. Akses Aplikasi melalui Browser
