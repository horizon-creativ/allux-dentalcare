
# Allux Dentalcare

Sebuah aplikasi booking klikik gigi berbasis website untuk Allux Dentalcare




## Requirements
- XAMPP / Laragon ``PHP 8.3``
- Git Bash ``Latest Version``
- Composer ``Latest Version``
- Visual Studio Code
- phpMyAdmin
## Installation
### 1. Cloning Project
Buat sebuah folder untuk menaruh project. Lokasi folder dapat berada di mana saja. **`Tidak disarankan menaruh folder di drive C`**.

Buka folder lalu klik kanan dan pilih `Open Git Bash Here`.

Jalankan Command:
```bash
  git clone https://github.com/horizon-creativ/allux-dentalcare
```
Sebuah folder project akan terbuat dengan nama `allux-dentalcare`.

Tutup Git Bash.

### 2. Install Core File
Masuk ke dalam folder `allux-dentalcare` lalu buka kembali Git Bash dengan cara klik kanan di dalam folder lalu `Open Git Bash Here`.

Jalankan Command:
```bash
  composer install
```

Tunggu hingga composer selesai menginstall semua core file dari Codeginiter 4.

**`Jangan tutup terminal Git Bash, nantinya akan digunakan untuk running project`**

### 3. Setup Project
Buat database baru menggunakan `phpMyAdmin`, nama database bebas.

Buka folder project menggunakan VSCode **``Tidak disarankan menggunakan Sublime``**.

Buatlah file .env pada root folder project.

Copy semua text yang berada di dalam file `env` ke dalam file `.env` baru.

Replace bagian ini sesuai dengan database MySQL mu:
```php
database.default.database = nama_database_kamu
database.default.username = username-database (biasanya root)
database.default.password = password-database (biasanya kosong)
```

Apabila sudah, silahkan save.

Buka terminal di dalam VSCode menggunakan ``Ctrl + ` ``.

Klik panah bawah kecil di bagian kanan atas dari terminal `(disebelah icon +)` lalu pilih Git Bash.

Jalankan command:
```bash
  php spark migrate
```
> Command diatas akan menginstal semua tabel yang dibutuhkan, lokasi tabel tabel berada pada `app/Database/Migrations`.

Jalankan command:
```bash
  php spark db:seed UserSeeder
```
> Command diatas akan membuat data user Superadmin yang digunakan untuk login di backoffice. Lokasi seeder berada pada `app/Database/Seeds`.

Data user superadmin untuk login adalah
- Email : `superadmin@gmail.com`
- Password : `superadmin123`

### 4. Run Project

Masih ingat Git Bash yang dibuka pada folder project? Nah disitu akan kita gunakan untuk running project.

Jalankan command:
```bash
  php spark serve
```

Biarkan terminal tetap berjalan selama running, apabila ditutup maka project akan berhenti running dan harus running ulang lagi.

Akses website menggunakan url: 
- Halaman User `http://localhost:8080/`
- Halaman Backoffice `http://localhost:8080/backoffice`
    
## Updating Project

Buka terminal pada VSCode.

Jalankan command:
```bash
  git pull origin master
```
> Command diatas akan mendownload file-file / update terbaru dari GitHub project.

Jalankan command:
```bash
  php spark migrate
```
Command diatas akan menginstal update dari tabel / kolom yang diberparui. Sebaiknya selalu dijalankan setelah melakukan `pull` dari GitHub untuk menghindari error pada saat trial.