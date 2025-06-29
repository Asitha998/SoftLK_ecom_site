# SoftLK

SoftLK is a web-based ecommerce application designed to sell video games. This project is built using PHP and runs on the XAMPP server.

## Features

- User-friendly interface
- Efficient software tracking
- Scalable architecture

## Requirements

- XAMPP server
- PHP 7.4 or higher
- MySQL database

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/SoftLK.git
    ```
2. Move the project to your XAMPP `htdocs` directory:
    ```bash
    mv SoftLK /c:/xampp/htdocs/
    ```
3. Start the XAMPP server and ensure Apache and MySQL are running.
4. Import the database:
    - Open phpMyAdmin.
    - Create a new database (e.g., `softlk_db`).
    - Import the provided SQL file located in the `database` folder.
5. Update the database configuration in `connection.php`:
    ```php
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'softlk_db');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    ```

## Usage

1. Open your browser and navigate to:
    ```
    http://localhost/SoftLK/
    ```
2. Log in or register to start using the application.

## Technologies Used

1. Frontend:

    HTML, CSS, JavaScript
    Bootstrap for responsive design

2. Backend:

    PHP for server-side logic
    MySQL for database management

3. Libraries:

    PHPMailer for email notifications
