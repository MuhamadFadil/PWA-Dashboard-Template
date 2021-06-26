# Dashboard Template - PWA-CI4-AdminLTE-GroceryCRUD
## CodeIgniter 4 Development
[![Build Status](https://travis-ci.org/codeigniter4/CodeIgniter4.svg?branch=develop)](https://travis-ci.org/codeigniter4/CodeIgniter4)
[![Coverage Status](https://coveralls.io/repos/github/codeigniter4/CodeIgniter4/badge.svg?branch=develop)](https://coveralls.io/github/codeigniter4/CodeIgniter4?branch=develop)
[![Downloads](https://poser.pugx.org/codeigniter4/framework/downloads)](https://packagist.org/packages/codeigniter4/framework)
[![GitHub release (latest by date)](https://img.shields.io/github/v/release/codeigniter4/CodeIgniter4)](https://packagist.org/packages/codeigniter4/framework)
[![GitHub stars](https://img.shields.io/github/stars/codeigniter4/CodeIgniter4)](https://packagist.org/packages/codeigniter4/framework)
[![GitHub license](https://img.shields.io/github/license/codeigniter4/CodeIgniter4)](https://github.com/codeigniter4/CodeIgniter4/blob/develop/license.txt)
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/codeigniter4/CodeIgniter4/pulls)
<br>
## ScreenShoot | Layout
![image](https://user-images.githubusercontent.com/48039483/121282031-1fc4ad00-c903-11eb-8348-62607f65f848.png)

**Admin username and password:**
* Username: admin@admin.com
* pass: 123456

Output:

![image](https://user-images.githubusercontent.com/48039483/121282267-661a0c00-c903-11eb-882d-bfd204bbc9e4.png)

**Client username and password**
* Username: test@client.com
* pass:123456

Output:

![image](https://user-images.githubusercontent.com/48039483/121282714-2bfd3a00-c904-11eb-8830-881e44dd3b47.png)

![image](https://user-images.githubusercontent.com/48039483/121282750-3a4b5600-c904-11eb-84af-04b0e06da503.png)

## Kemudahan yang diberikan
### Fitur pada proyek Dashboard Template
* Fitur Progresive Web Apps (PWA)
* Dapat diunduh pada perangkat smartphone (Android dan iOS)
* Mode Offline 
* Push Notification
* Sistem caching yang handal
* Aplikasi yang diunduh dapat berjalan seperti aplikasi native

### CodeIgniter 4 & AdminLTE 3
> Memudahkan anda untuk menggunakan proyek ini, tanpa harus mengintegrasikan kembali AdminLTE pada CodeIgniter 4.

[Documentation CI4](https://codeigniter.com/docs) | [Documentation AdminLTE3](https://adminlte.io/docs/3.0/)

### Grocery CRUD versi 2.0.0
> Ditambah sudah integrasikan juga Grocery CRUD untuk memudahkan Create Read Update Delete.

[Documentation GroceryCRUD](https://www.grocerycrud.com/v1.x/documentation)

### Progresive Web Apps (PWA)
> Aplikasi Web sudah dintegrasikan juga dengan teknologi web PWA.

[Documentation PWA](https://developers.google.com/web/ilt/pwa)

### Struktur Program
<pre>
├── admin
│   ├── css
│   ├── framework
│   ├── module
│   ├── starter
│   ├── userguide
|   ├── README.md
|   ├── ...
│   └── workflow.md
├── app
│   ├── Config
│   │   ├── App.php
│   │   ├── Autoload.php
│   │   ├── ...
│   │   ├── GroceryCrud.php
│   │   ├── ...
│   │   ├── Format.php
│   │   ├── Honeypot.php
│   │   ├── ...
│   │   └── View.php
│   ├── Controllers
│   │   ├── BaseController.php
│   │   ├── ...
│   │   └── Home.php
│   ├── Database
│   ├── Libraries
│   │   ├── ...
│   │   ├── GroceryCrud.php
│   │   ├── Image_moo.php
│   │   ├── ...
│   │   └── Template.php
│   ├── Models
│   │   ├── Grocery_crud_model.php
│   │   ├── GroceryCrudModel.php
│   │   ├── PushModel.php
│   │   └── UsersModel.php
│   ├── ThirdParty
│   ├── Views
│   │   ├── errors
│   │   ├── parts
│   │   ├── ...
│   │   └── welcome_message.php
|   ├── .htaccess
|   ├── Common.php
│   └── index.html
├── public
│   ├── assets
│   │   ├── bootstrap
│   │   ├── plugins
│   │   ├── uploads
│   │   ├── ...
│   │   └── yarn.lock
│   ├── grocery-crud
│   │   ├── config
│   │   ├── css
│   │   ├── fonts
│   │   ├── js
│   │   ├── language
│   │   ├── texteditor
│   │   ├── themes
│   │   ├── ...
│   │   └── license-mit.txt
│   ├── images
│   ├── scripts
│   ├── connected.php
│   ├── ...
│   ├── manifest.json
│   ├── pwabuilder-sw.js
│   ├── index.php
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
├── systems
├── writable
└── spark</pre>

# Requirements 
- CodeIgniter >= 4.0 
- PHP versi >= 7.0
- Grocery CRUD 2.0.0
- XAMPP 
- Code Editor (dalam tutorial ini menggunakan Visual Studio Code)

# Installing Guide
## Link Tutorial Instalilasi 
[<<<<<<<link: dalam proses pembuatan>>>>>>>>](https://www.youtube.com/)
## Unduh File Repositori
1. Mengunduh file repositori
* Unduh secara langsung
  - Unduh file repositori dalam bentuk zip
* Dengan git
  - copy link berikut :
  ```bash
  https://github.com/MuhamadFadil/PWA-Dashboard-Template.git
  ```
  - Letakan sesuai dengan repositori yang diinginkan, lebih baik diletakan pada file `C:/xampp/htdocs`
## Siapkan XAMPP & Code Editor
1. Download XAMPP
  -- [Downlod XAMMP](https://www.apachefriends.org/download.html)
3. Download Visual Studio Code (VS Code)
  -- [Download VS Code](https://code.visualstudio.com/download)
## Instalisasi Dashboard Template
1. Extract file zip pada htdocs (pada folder XAMPP)
2. Buat nama folder proyek (pada turioal diberi nama PWADashboard)
3. Buka aplikasi XAMPP, kemudian lakukan konfigurasi berikut
   - Pada `config`, pilih `httpd.conf`
     ![image](https://user-images.githubusercontent.com/48039483/123469918-e176ff80-d61d-11eb-9027-0d123596b4c3.png)
   - Ubah isi file 
      ```bash
      DocumentRoot "C:/xampp/htdocs"
      <Directory "C:/xampp/htdocs">
      ```
      ke 
      
      ```bash
      DocumentRoot "C:/xampp/htdocs/PWADashboard"
      <Directory "C:/xampp/htdocs/PWADashboard">
      ```
    - Tentukan port yang diinginkan (secara default port:8080)
    - Kemudian, `start` pada Apache dan MySQL
      ![image](https://user-images.githubusercontent.com/48039483/123473659-1043a480-d623-11eb-9539-c458998a2970.png)
5. Jalankan http://localhost:8080/
## Membuat Database
1. Jalankan MySQL `admin` atau klik http://localhost:8080/phpmyadmin/
  ![image](https://user-images.githubusercontent.com/48039483/123473775-3cf7bc00-d623-11eb-9d0a-f08824b3c3c0.png)
3. Buat database baru
4. Beri nama databse (pada tutorial diberi nama pwadashboard_tb)
5. Import data SQL pada folder PWADashboard ke database yang dibuat
## Mengatur `.env`
1. Buka VS Code
2. Buka folder proyek PWADashboard
3. Membuka file `.env`, kemudian ubah isi file `.env`
  - Environment
  ```bash 
  CI_ENVIRONMENT = development
  #CI_ENVIRONMENT = production
  ```
  - Base URL Apps
  ```bash
  app.baseURL = 'http://localhost:8080/'
  ```
  - Database
  ```bash
  database.default.hostname = localhost
  database.default.database = pwadashboard_tb
  database.default.username = root
  database.default.password = 
  database.default.DBDriver = MySQLi
  ```
4. Melakukan penyesuaian pada file kode yang membutuhkan database, berikut file yang harus disesuaikan dengan databasenya:
    * /public
      - `connected.php`
    * app/Controller
      - `Setting.php`
      - `Users.php`
    * app/Models
      - `PushNotif.php`
      - `UsersModel.php`
 
## License
This package is free software distributed under the terms of the [MIT license](LICENSE.md).
