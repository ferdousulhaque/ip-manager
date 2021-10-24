# IP Manager

This is a simple application for managing IP Address with aliasing.

## Pre-requisite Application

For running this application, you need to have the following application in your host.

- Docker
- Node - Also in Docker if needed

## Bootstrap

Please copy the following example files and craete your own files.

```
cp -av .env.example .env

cp -av docker-compose.yml.example docker-compose.yml
```

## Languages

The following languages are used for the application

- PHP
- Typescript

## Framework

The framework used

- Lumen
- Angular

## Run Application

- Begin the application, you need to build the docker with the following command first and then start.

    ```
    docker-compose build

    docker-compose up -d
    ```

- Then need to install the required packages and do a dumpautoload

    ``` 
    docker-compose exec php composer install

    docker-compose exec php composer dumpautoload
    ```

- Now generate 2 keys for the application and JWT.

    - **Application Key**

    Copy the generated key and replace in the .env file for the APP_KEY

    ```
    echo "APP_KEY=base64:"`echo 'ip-manager by ferdous' | base64`
    ```
    *NOTE: Lumen does not come with the key:generate CLI command, so this is a easy way to generate.*
    - **JWT Key**
    ```
    docker-compose exec php php artisan jwt:secret
    ```

- Next Step is to provide permission to the storage directory and migration for the database 

    ``` 
    docker-compose exec chmod -Rf 777 storage
    
    docker-compose exec php php artisan migrate:fresh --seed
    ```

## Run APIs
For API import the following Postman JSON file in the directory

`ip-manager.json`

## NPM Install and Build the web packages
Please run the following command for the website to build from Typescript Compiler to Javascript

```
npm install

npx ng build --base-href http://localhost:8081/website/dist/website/
```

- via Docker

    ```
    docker-compose exec -w /app/website node npm install
    docker-compose exec -w /app/website npx ng build --base-href http://localhost:8081/website/dist/website/
    ```

## Run Tests

For running the application tests

```
docker-compose exec php php artisan migrate:fresh --seed

docker-compose exec php vendor/bin/phpunit ./tests --testdox --color
```

## Run Application

Finally go to the following URL to the browse the application

[IP Manager](http://localhost:8081/website/dist/website/)

## License