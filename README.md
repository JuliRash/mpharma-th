<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## mPharma TH

This is a basic API that does Create, Read, Update, Delete actions and uploads csv that uses a queue and sends an alert after the upload is complete

### Requirements

-   [Docker](https://www.docker.com/get-started)

### Installation

<p>Clone the Repository </p>

```
$ git clone https://github.com/JuliRash/mpharma-th.git
```

<p>Navigate to the repository directory.</p>

```
$ cd mpharma-th
```

<p >Use Sail(Docker) To build the application</p>

```
$ ./vendor/bin/sail up -d
```

<p>Run Migration and Seed Demo data</p>

```
$ ./vendor/bin/sail migrate --seed
```

<p> Run The default queue this is useful to queue the </p>

```
$ ./vendor/bin/sail artisan queue:work --timeout=0
```

Documentation: https://documenter.getpostman.com/view/6597817/UVXnFZGE

Postman Collection: https://www.getpostman.com/collections/34d3ce33533e750956e9
