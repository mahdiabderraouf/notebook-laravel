Notebook app API built with Laravel.

## How to install

First make sure you have composer and laravel installed (https://laravel.com/docs/8.x/installation).

1. Clone this repository.
2. Cd into your project.
3. Run `composer install`.
4. Create a .env file and copy the content of .env.example into it.
5. Run `php artisan key:generate`.
6. Create a mysql database and update your .env file with your database configuration : 
    ```DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```
7. Run `php artisan migrate`, add the --seed flag if you want to generate some fake data : `php artisan migrate --seed`, now you can login with the user john.doe@gmail.com and password: 'password'.
8. Serve the API by running `php artisan serve`.
9. You can now consume the API.
