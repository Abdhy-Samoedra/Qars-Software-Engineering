
![Logo](https://private-user-images.githubusercontent.com/54672937/312338775-3c82cd46-2e13-4b5c-9e12-932e5a52e976.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MTAzMTI3NDksIm5iZiI6MTcxMDMxMjQ0OSwicGF0aCI6Ii81NDY3MjkzNy8zMTIzMzg3NzUtM2M4MmNkNDYtMmUxMy00YjVjLTllMTItOTMyZTVhNTJlOTc2LnBuZz9YLUFtei1BbGdvcml0aG09QVdTNC1ITUFDLVNIQTI1NiZYLUFtei1DcmVkZW50aWFsPUFLSUFWQ09EWUxTQTUzUFFLNFpBJTJGMjAyNDAzMTMlMkZ1cy1lYXN0LTElMkZzMyUyRmF3czRfcmVxdWVzdCZYLUFtei1EYXRlPTIwMjQwMzEzVDA2NDcyOVomWC1BbXotRXhwaXJlcz0zMDAmWC1BbXotU2lnbmF0dXJlPWMwOTQ5YzlhMzNkZjU3ZTU0Y2FhOTBhM2U3ZmM2NmE0MGUwOTM5N2I2YzVmMDhmNmUxY2M4YTJhN2FlYjUwZTcmWC1BbXotU2lnbmVkSGVhZGVycz1ob3N0JmFjdG9yX2lkPTAma2V5X2lkPTAmcmVwb19pZD0wIn0.ay8blCHjkH1xOgPs6TO3_BerZtU7uRODGghNDpaMcv4)


# QARS (Quick Auto-mobile Renting Service)

Qars is a legitimate, extravagant yet refined services which lends the ability to acquire various types of automobile on just a few touches. It's main goal is to give the people the transportation they need anytime, anywhere according to their needs. Although it's essentiality is for renting automobiles, it also has features that complement the service, thus making it complete, such as lost and found, rating each rent experience, each vehicle preview, rewards system, and many more that will soon added in the near future!


## Features

- Booking
- Payment
- Lost and Found Forum
- Rating and Review
- Experience Point


## Tech Stack

**Client:** Laravel, PHP, TailwindCSS , Javascript

**Server:** Ngrok


## Installation

Download and install laragon

```bash
  https://laragon.org/index.html
```
Laravel Download 

```bash
  https://laravel.com/docs/10.x/installation

```
Laravel Installation

```bash
  composer global require laravel/installer
  laravel new example-app
  php artisan serve
```

Clone Repository

```bash
    git clone <project-name>
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan serve
    php artisan storage:link
```
Install Jetstream

```bash
    install laravel jetstream
    composer require laravel/jetstream
    php artisan jetstream:install livewire
    npm install
    npm run build
    php artisan migrate
    php artisan vendor:publish --tag=jetstream-views
```

Build CSS

```bash
    npm install
    npm run build
    npm run dev
```
    

Install and publish Datatable file

```bash
    composer require yajra/laravel-datatables-oracle:^10.0
    php artisan vendor:publish --tag=datatables

```
Install Midtrans

```bash
    composer require midtrans/midtrans-php
```

Run Admin Seeder

```bash
    php artisan db:seed
```

## Troubleshooting


Run this command if the route doesnt exist
```bash
  php artisan cache:clear
  php artisan route:cache

```

## Authors

- [@Daniel](https://github.com/danielchristophersantoso)
- [@Joel](https://github.com/JoEdwrd)
- [@Abdhy](https://github.com/Abdhy-Samoedra)
- [@Ryan](https://github.com/ryanceha)
- [@Bella](https://github.com/bellaarsita)


## Demo

https://131b-182-16-186-50.ngrok-free.app

