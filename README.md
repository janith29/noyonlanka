Installation

Install Composer using detailed installation instructions here
Install Node.js using detailed installation instructions here

Clone repository

     git clone https://github.com/janith29/noyonlanka.git
    
first do:

1. `composer update`

2. `php artisan key:generate`



Before run below command TRY:

3.`php artisan config:cache`


then:
Before
change your .env file 

4. php artisan migrate:refresh --seed

If you get an error like a PDOException try editing your .env file and change DB_HOST=127.0.0.1 to DB_HOST=localhost or DB_HOST=mysql (for docker-compose environment).
Run

To start the PHP built-in server
5. `php artisan serve `


Now you can browse the site at http://localhost:8000

*If forked repository:*

**If you have cloned this repository from a your fork, follow below steps first:**


