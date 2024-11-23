Cara menjalankan project (project di extract dalam htdocs jika menggunakan xampp)
Untuk menjalankan perintah-perintah berikut, buka terminal di VS Code atau editor kode lainnya:

1. Jalankan `composer install` untuk menginstal dependensi yang diperlukan.
2. Jalankan `npm install` untuk menginstal paket Node.js yang diperlukan.
3. Salin file `.env.example` dan ubah namanya menjadi `.env` menggunakan perintah `cp .env.example .env`.
4. Generate kunci aplikasi dengan menjalankan `php artisan key:generate`.
5. Migrasikan database menggunakan `php artisan migrate`.
6. Jika Anda ingin mengatur ulang database dan mengisinya dengan data palsu, jalankan `php artisan migrate:fresh --seed`.
7. Mulai server pengembangan dengan `php artisan serve`.
8. Di terminal baru, jalankan `npm run dev` untuk mengkompilasi aset.

Pastikan Anda berada di direktori yang benar sebelum menjalankan perintah-perintah ini.

AKUN
ROLE: ADMIN
email : admin@example.com
password : adminpassword

ROLE: USER
email : member@example.com
password : memberpassword
