# Backend Developer Challenge

## About
This repo contain source code for the Backend Developer Challenge.

## Specification
Check requirement by `composer check-platform-reqs`

| Component     | Version       |
|---------------|---------------|
| PHP           | 7.1.3         |
| MySQL         | 8.0.20        |
| Redis         | 5.0.8         |
| Laravel       | 5.8           |

## Installation
1. git clone the repo.
2. cd to repo directory.
3. type `composer install` in command line.
4. copy `.env.example` to `.env` file.
5. modify the database access to your local development.
6. type `php artisan migrate --seed` in command line.
7. Post a trade message payload to `/api/consume` API
8. Access `/dashboard` with a browser to check the dashboard of all data


### Docker
```bash
# Create Network
docker network create bdc-network

# Create Database 
docker run --name bdc-db --net bdc-network -d -t -p 3306:3306 -e MYSQL_ROOT_PASSWORD=123456! mysql:8.0.20

# Create Redis 
docker run --name bdc-redis --net bdc-network -d -t redis

# Create Nginx (PHP-FPM)
docker run --name bdc-web --net bdc-network -d -t -p 80:8080 -v $(pwd):/var/www/html dannylhl/web-server:php7.3.6-fpm
```

### Coding Test
```bash
# To Run PHPUnit
docker exec -it bdc-web /bin/bash
./vendor/phpunit/phpunit/phpunit
```
