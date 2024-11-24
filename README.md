<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This project is a web application built with **Laravel 11** and follows modern development standards. The project includes the following technologies:

- **Laravel 11**: A powerful web application framework for PHP.
- **MySQL**: A popular relational database management system.
- **PHP**: The server-side language used to develop the application.
- **Bootstrap 5**: A front-end framework for responsive web design.

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- Simple, fast routing engine.
- Powerful dependency injection container.
- Multiple back-ends for session and cache storage.
- Expressive, intuitive database ORM (Eloquent).
- Database agnostic schema migrations.
- Robust background job processing.
- Real-time event broadcasting.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Project Setup

Follow these steps to set up and run this project locally:

### 1. Clone the Repository
Clone the project using Git. You can choose one of the following options:

- **Using SSH**:
  ```bash
  git clone git@github.com:WildanAryaKusuma/asset-lsp.git
  ```
- **Using HTTPS**:
    ```bash
    git clone https://github.com/WildanAryaKusuma/asset-lsp.git
    ```

### 2. Install Dependencies
Install the required PHP dependencies via Composer:
```bash
composer install
```

### 3. Set Up the Database 
Make sureyou have a MySQL database setup, then update the .env file with your database credentials :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```
### 4. Run Migrations
Run the migrations to set up your database schema:

````bash
php artisan migrate
````

### 5. Link storage for Images
For images purpose, you must run this : 
```bash
php artisan storage:link
```

### 6. Serve the Application
Finally, serve your app locally : 
```bash
php artisan serve
```

You can now visit the application at `http://localhost:8000` or `http://127.0.0.1:8000` in your browser. 😋😋😋

