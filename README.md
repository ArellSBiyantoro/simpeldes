
# Simpeldes Gonoharjo

Project PPK ORMAWA HIMA ILKOM UNNES yang bekerja sama dengan Desa Gonoharjo, Kendal untuk mengimplementasikan sistem pelayanan desa yang dikombinasikan dengan IOT Sistem perairan persawahan untuk membantu menaikkan kualitas produksi.


Untuk Menjalakan Website di lokal :
## Requirements
 - [Git](https://git-scm.com/)
 - [Composer](https://getcomposer.org/)
 - [Web Server](https://www.apachefriends.org/)
 - [PHP ^8.1](https://www.php.net/)

## Langkah - Langkah Instalasi
- Download source code atau clone github
- Buka terminal pada folder
- Selanjutnya masukkan perintah ini
```bash
  composer install --no-dev
  cp .example.env .env
  php artisan key:generate
```
- Kemudian buat database dan sesuikan database pada file .env
```bash
  php artisan migrate
  php artisan optimize:clear
  php artisan serve
```
- server berhasil dijalankan
## Online Demo

[E Desa](https://e-desa.up.railway.app/)

