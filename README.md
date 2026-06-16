# Intern Test - Customer Management System

## Deskripsi Project

Aplikasi Customer Management System berbasis Laravel 10 yang dibuat untuk memenuhi kebutuhan technical test internship/fullstack developer.

Aplikasi ini menyediakan fitur:

- Authentication Login
- User Management (CRUD)
- Customer Management (CRUD)
- Generate Customer ID Otomatis
- Status Customer (NEW CUSTOMER & LOYAL CUSTOMER)
- Email Notification menggunakan Gmail SMTP
- Queue Database
- Scheduler Email Otomatis
- Dashboard Statistik
- AJAX & DataTables Server Side
- Responsive Modern UI

---

## Teknologi yang Digunakan

### Backend

- Laravel 10
- PHP 8+
- MySQL
- Eloquent ORM
- Queue Database
- Laravel Scheduler

### Frontend

- Bootstrap 5
- Bootstrap Icons
- jQuery
- DataTables
- SweetAlert2
- Chart.js

### Email

- Gmail SMTP
- Laravel Mail
- Queue Job

---

## Instalasi

### Clone Repository

```bash
git clone <repository-url>
```

Masuk ke folder project:

```bash
cd intern-test
```

---

### Install Dependency

```bash
composer install
```

---

### Copy Environment

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

---

### Konfigurasi Database

Edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intern_test
DB_USERNAME=root
DB_PASSWORD=
```

---

### Konfigurasi Queue

```env
QUEUE_CONNECTION=database
```

---

### Konfigurasi Email

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=nabillapasha66@gmail.com
MAIL_PASSWORD=tedkzcubmriofsjb
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=nabillapasha66@gmail.com
MAIL_FROM_NAME="Intern Test"

```

---

### Jalankan Migration

```bash
php artisan migrate
```

---

### Jalankan Seeder

```bash
php artisan db:seed
```

---

### Jalankan Project

```bash
php artisan serve
```

---

## Menjalankan Queue Worker

Buka terminal baru:

```bash
php artisan queue:work
```

Queue digunakan untuk:

- Email Customer Baru
- Email Loyal Customer
- Scheduler Email

---

## Menjalankan Scheduler

Buka terminal baru:

```bash
php artisan schedule:work
```

Scheduler digunakan untuk:

- Mengirim email promo otomatis setiap 1 jam

---

## Struktur Database

### users

| Field    | Type    |
| -------- | ------- |
| id       | bigint  |
| username | varchar |
| name     | varchar |
| email    | varchar |
| password | varchar |

---

### customers

| Field      | Type      |
| ---------- | --------- |
| user_id    | varchar   |
| name       | varchar   |
| email      | varchar   |
| status     | enum      |
| created_at | timestamp |
| updated_at | timestamp |

---

### customer_sequences

| Field       | Type    |
| ----------- | ------- |
| seq_date    | date    |
| last_number | integer |

---

## Fitur Customer

### Tambah Customer

Saat customer dibuat:

- Status otomatis NEW CUSTOMER
- Customer ID otomatis terbentuk

Contoh:

```text
16062026001
16062026002
16062026003
```

Sistem otomatis mengirim email promo:

```text
UNTUNGTERUS
Diskon 10%
```

menggunakan Queue.

---

### Loyal Customer

Saat status customer diubah menjadi:

```text
LOYAL CUSTOMER
```

sistem otomatis mengirim email:

```text
MAKINUNTUNG
Diskon 20%
```

menggunakan Queue.

---

## Dashboard

Dashboard menampilkan:

- Total Customer
- Total New Customer
- Total Loyal Customer
- Pie Chart Statistik Customer

---

## Scheduler Email

Scheduler berjalan setiap:

```text
1 Jam
```

untuk mengirim ulang promo berdasarkan status customer.

### NEW CUSTOMER

Promo:

```text
UNTUNGTERUS
Diskon 10%
```

### LOYAL CUSTOMER

Promo:

```text
MAKINUNTUNG
Diskon 20%
```

---

## Akun Login Default

### Administrator

```text
Email    : admin@gmail.com
Password : password
```

---

## Author

Technical Test Project

Laravel 10 Customer Management System

Created by:
Nabila Pasha
