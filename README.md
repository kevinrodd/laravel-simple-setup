# Laravel Simple Setup

A visual setup routine for Laravel's environment (.env) file. <br>
Change your environment variables as you like in a visual guided wizard and check your Database credentials live during setup wizard.

![Screenshot](https://user-images.githubusercontent.com/20622736/44989340-d1359780-af8d-11e8-80d5-9c2a8ff230ab.png)


## Features
- Simple Install Routine for beginner and experts
- Integrated Laravel Basic Auth System Switch (You can turn it on/off during setup)
- Generate new App Key on the fly
- Database Connection Live Testing
- Automatically create database if not exist (No matter if mysql, postgresql or sqlite)
- Disable Database
- Detailled Final Step Overview showing your changes to the env before you submit
- and more!

![Screenshot](https://user-images.githubusercontent.com/20622736/44989341-d1359780-af8d-11e8-9b0e-851759296f52.png)


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 
### Prerequisites

- Laravel 5.6 and up
- PHP >= 7.1.3
- PDO PHP Extension


### Installing


Require this package with composer. It is recommended to only require the package for development.

```shell
composer require rowo/laravel-simple-setup --dev
```
Laravel 5.6 uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.


## Start Setup

Start your Laravel server with

```shell
php artisan serve
```

and go to /setup


## Authors

* **Kevin Rodd** - *Initial work* - [Kevin Rodd](https://github.com/kevinrodd)
* **Andreas Wolf** - *Initial work* - [AWolf86](https://github.com/Kappalores)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
