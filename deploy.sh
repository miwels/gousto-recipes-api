#!/bin/bash
echo '********** Changing folder permissions'
sudo chmod -R 777 storage bootstrap

echo '********** Running composer.'
composer install

echo '********** Creating config files'
cp .env.example .env
mkdir -p data
touch storage/database.sqlite

echo '********** Generating application key'
php artisan key:generate

echo '********** Setting up SQLite database'
php artisan db:seed --class=RecipiesTableSeeder

echo '**********  Serving the application'
php artisan serve
