
# Tokobot

The Community Partnership Program (PKM) with the title "Development of a Financial Management Application for Mosque-Owned Enterprises to Empower Mosque Congregants in Rancamulya Village" involves analysis, design, and implementation of the UMKM Masjid application, as well as socialization of its usage.


## Requirements

- PHP 8.0 or higher
- Database (e.g., MySQL)
- Web Server (e.g., Apache, Nginx, IIS)


## Installation

* Install [Composer](https://getcomposer.org/download) and [Npm](https://nodejs.org/en/download)
* Clone the repository: `git clone https://github.com/zharmedia386/tokobot.git`
* Install dependencies: `composer install ; npm install ; npm run dev`
* Run `cp .env.example .env` for create .env file
* Run `php artisan migrate --seed` for migration database
* Run `php artisan storage:link` for create folder storage
* Detail login, Username : `admin` Password `123456`
* Run `php artisan queue:listen` for run queue
    

## Features

### 1. Register Account
Users can register on the application.

### 2. View product data
Users can view product details.

### 3. Record sales 
Users can record sales transactions.

### 4. View sales data
Users can view detailed sales transactions.

### 5. Record purchases
Users can record purchase transactions.

### 6. View purchase data
Users can view purchase transactions in detail.

### 7. Generate financial reports
Users can view financial reports in the form of balance sheets, cash flow statements, and profit and loss statements.

## Demo

Here's the quick demo of the app :
https://youtu.be/a8nPGJGxiV4


## License

[MIT](https://choosealicense.com/licenses/mit/)

## Screenshots

### Authentication Page
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Sign In — Tokobot.png" />\

### Home Page
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Home — Tokobot.png" />

### Asset Page
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Asset — Tokobot.png" />
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Form Asset — Tokobot.png" />

### Invoice Page
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Purchase Invoice — Tokobot (1).png" />
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Purchase Invoice — Tokobot.png" />

### Sales Page
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Penjualan — Tokobot (1).png" />
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Penjualan — Tokobot.png" />

### Purchase Page
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Pembelian — Tokobot (1).png" />
<img src="https://github.com/zharmedia386/tokobot/blob/master/public/image-readme/Pembelian — Tokobot.png" />
