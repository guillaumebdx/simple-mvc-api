# Hackathon

## Description

Project for a hackathon organized by Wild Code School.

## Author

 - Amélie Guérin
 - Laetitia Gonçalves
 - Guillaume Erpeldinger

## Install

1. Clone the repo from Github.
2. Run `composer install`.
3. Create *config/api.php* from *config/api.php.dist* file and add your API key for windy
4. Create *config/db.php* from *config/db.php.dist* file and add your DB parameters. Don't delete the *.dist* file, it must be kept.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PWD', 'your_db_password');
```
5. Import `.sql` in your SQL server,
6. Run the internal PHP webserver with `php -S localhost:8000 -t public/`. The option `-t` with `public` as parameter means your localhost will target the `/public` folder.
7. Go to `localhost:8000` with your favorite browser.


##### Windows Users

If you develop on Windows, you should edit you git configuration to change your end of line rules with this command :

`git config --global core.autocrlf true`

## Link

https://www.wildcodeschool.com
