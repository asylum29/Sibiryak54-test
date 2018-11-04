Installation guide
======================

* Install packages:
  ```
  composer install
  ```
* Create **.env** file from **.env.dist**
* Set database connection settings in **.env** file
* Create database
  ```
  php bin/console doctrine:database:create
  ```
* Invoke migrations
    ```
  php bin/console doctrine:migrations:migrate
  ```
* Run server
  ```
  php bin/console server:run
  ```
* Use command to check ip with console
  ```
  php bin/console app:check-ip {ip}
  ```
