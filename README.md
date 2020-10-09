<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About Project

This is a typical CRUD application for student examination questions.

-   Questions can be categorized.
-   A question can have a maximum of 4 options
-   An option has an optional score
-   Categories, questions and options can be Created Read Updated and Deleted
-   Enjoy

## Installation

-   clone the repo
-   run composer install
-   run yarn install / npm install
-   run npm run production / yarn production
-   copy .env.example to .env and fill the database mysql configuration
-   run php artisan key:generate to generate application key
-   run php artisan serve to spawn a development server or configure apache or your webserver to send all non static requests to public/index.php and all static requests to its appropriate directory. for instance css static request can be found under public/css directory.
