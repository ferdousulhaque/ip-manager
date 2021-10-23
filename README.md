# IP Manager

This is a simple application for managing IP Address with aliasing.

## Languages

The following languages are used for the application

- PHP
- Javascript

## Framework

The framework used

- Lumen
- VueJs

## Run Application

- Begin the application, you need to build the docker with the following command first and then start.

    ```
    docker-compose build
    docker-compose up -d
    ```

- Then need to install the required packages

    ``` 
    docker-compose exec php composer install
    ```

- Next Step is to migration for the database 

    ``` 
    docker-compose exec chmod -Rf 777 storage
    docker-compose exec php composer install
    docker-compose exec php compose dumpautoload
    ```
 - Finally go to the following URL to the browse the application

    [IP Manager](http://localhost:8081/website/)

## Run APIs
For API import the following Postman JSON file in the directory

`ip-manager.json`
## Run Tests

For running the application tests

```
docker-compose exec php php artisan migrate:fresh --seed
docker-compose exec php vendor/bin/phpunit ./tests --testdox --color
```

## License