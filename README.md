# Project CRUD

### Project setup steps:

- Go to project root directory from terminal
- Copy and paste `.env.example` into `.env` file in root directory
  ```shell
  cp .env.example .env
  ```
- Create the database with name `crud`
- Do necessary change in `.env` file (optional)
- Set the APP_URL as per your requirement into .env file
- Set the FILESYSTEM_DISK=public into .env file
- Run following commands:
  ```shell
  composer install
  php artisan key:generate
  php artisan migrate:fresh --seed
  php artisan storage:link
  ```

- Created test cases only for Projects table CRUD
  ```shell
  php artisan test
  ```

- Here crud\CRUD-breeze.postman_collection.json is the json file of postman collection for all APIs
    ```shell
    Note: You need to create environment and need
    to set there value of "url" variable. And after
    that before calling any API you need to choose
    created enviroment
    ```
