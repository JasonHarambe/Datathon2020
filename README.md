## Data Source
1. Malaysia Import Export by partner country, SITC 5D 2013-2019.csv
2. 1D -> 5D.csv

## Installation Requirement
- Laravel
- Composer
- NPM

## DB Setup
- Run 'php artisan migrate:fresh' before importing data into DB through Sequel Pro

## Installation Steps
- Download project as zip or pull project from git provider
- Inside project directory, run 'composer install' 
- Run 'npm install'
- Run 'cp .env.example .env'
- Change DB_DATABASE value inside .env file according to DB name
- Run 'php artisan key:generate:
- Run 'php artisan migrate:fresh'
- Import data into DB 
- Run 'php artisan serve'
