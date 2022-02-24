## Installation

``` bash
# clone the repo
$ git clone https://gitlab.com/arnoldarmandosuwuh/food-donation-backend

# go into app's directory
$ cd food-donation-backend

# install app's dependencies
$ composer install

# install app's dependencies
$ npm install

```

### If you choice to use MySQL

Copy file ".env.example", and change its name to ".env".
Then in file ".env" complete this database configuration:
* DB_CONNECTION=mysql
* DB_HOST=127.0.0.1
* DB_PORT=3306
* DB_DATABASE=food-donation
* DB_USERNAME=root
* DB_PASSWORD=

### Next step

``` bash
# in your app directory
# generate laravel APP_KEY
$ php artisan key:generate

# run database migration and seed
$ php artisan migrate:refresh --seed

# publish sweetalert
$ php artisan sweetalert:publish

# generate mixing
$ npm run dev

# and repeat generate mixing
$ npm run dev
```

## Usage

``` bash
# start local server
$ php artisan serve

# test
$ php vendor/bin/phpunit
```

Open your browser with address: [localhost:8000](localhost:8000)  
Click "Login" on sidebar menu and log in with credentials:

* E-mail: _admin@admin.com_
* Password: _password_

--- 

### Using PSR

Please use this rules below:
* Class name using CamelCase with capitalize first word -> UserController, TransactionsController
* Function name using camelCase -> getUser, getData
* Variable name using snake_case -> $data_user, $full_name
* Add table, modify table, drop table always using migration
* Add dummy / default data must be use seeder 