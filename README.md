
![Logo](<img width="400" alt="Group 33923" src="https://github.com/Abdhy-Samoedra/Qars-Software-Engineering/assets/54672937/7bf1ddac-64de-4bc8-903f-d55fdfa00a6e">)


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

