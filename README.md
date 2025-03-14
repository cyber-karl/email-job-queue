<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel Job & Queue System Learning

Using Job and Queue systems to send an email on subscribe.
To launch the project:

```shell
composer install
cp .env.example .env
sail up [-d]
cd frontend
npm i
npm run dev
```

You can then enter your email address in the UI and hit Subscribe.
This will then post to the backend, creating a new Email record, and using the Job system to queue a job to Notify the email.
You can run the following to watch the queue and have the notification be picked up and sent:

```shell
sail artisan queue:work
```

Finally, check your inbox (mailtrap):
http://localhost:8025
