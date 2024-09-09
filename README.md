📦 My Awesome App
Aplikasi ini adalah solusi terbaik untuk manajemen data yang efisien, cepat, dan mudah digunakan. Ikuti langkah-langkah di bawah ini untuk mengatur dan menjalankan proyek di lokalmu!
🚀 Getting Started
Langkah-langkah berikut akan membantu kamu menyiapkan proyek dan mulai menjalankan aplikasi di lokal.

Prasyarat
Pastikan kamu memiliki beberapa tools berikut yang terinstal di sistemmu:

Composer
Node.js (termasuk NPM)
📂 Instalasi
Install Dependencies PHP dengan Composer

Pastikan composer telah terinstal. Jika belum, unduh dan install dari Composer Official Website. Setelah itu, jalankan perintah ini di direktori proyek:

bash
Copy code
composer install
Install Dependencies JavaScript dengan NPM

Install Node.js dan pastikan npm tersedia. Jika belum terinstall, unduh dan install dari Node.js Official Website. Setelah itu, install dependencies:

bash
Copy code
npm install
Konfigurasi Environment

Edit file .env.copy menjadi .env dengan perintah berikut:

bash
Copy code
mv .env.copy .env
Setelah itu, pastikan untuk menambahkan URL REST API backend dalam file .env. Contoh penambahan di .env:

bash
Copy code
BE_URL=http://example.com/api
📖 Dokumentasi API
Kamu bisa menemukan dokumentasi API lengkap di Swagger Documentation, di mana kamu bisa mencoba semua endpoint REST API yang disediakan oleh aplikasi ini.

🚩 Jalankan Aplikasi
Setelah semua langkah di atas selesai, kamu siap menjalankan aplikasi!

Jalankan Back-End

bash
Copy code
php artisan serve
Jalankan Front-End

bash
Copy code
npm run dev
🔧 Built With
PHP - Back-End
Laravel - Framework PHP
Node.js & NPM - Front-End Package Manager
Composer - PHP Dependency Manager
