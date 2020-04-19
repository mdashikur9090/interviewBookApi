# laravel-books-api

Books API Built in Laravel 6

### Setup application

```shell
composer install
cp .env-example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve --port=8000
```

### Books API Endpoint

http://localhost:8000/api/register
http://localhost:8000/api/login
http://localhost:8000/api/books
http://localhost:8000/api/book_details/{id}

