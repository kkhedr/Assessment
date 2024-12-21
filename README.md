## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## bevatel app

It is blog management systems with two role Admin and Author

## How to use

this is very simple, Can use it with docker which run (docker compose u -d --build)
or without docker as you like it.

## use docker
run : docker compose u -d --build
and use http://127.0.0.1:8003 to access system.

## without docker
run : php artisan serve and got to enjoy

## for import Excel sheet file , you must run queue

## migrate and seeder
you must run : (php artisan migrate --seed) before start enjoy.

## import excel file 
 You must run php artisan queue:work
## we make permissions reflect in system auto when we use roles for authorized or return all user permissions in response if back-end and front-end seperated but task didn't that 
## THANKS :)
