# Laravel Simple Setup

A visual setup routine for Laravel's environment (.env) file. <br>
Change your environment variables as you like in a visual guided wizard and check your Database credentials live during setup wizard.

## Features
- Simple Install Routine for beginner and experts
- Integrated Laravel Basic Auth System Switch (You can turn it on/off during setup)
- Generate new App Key on the fly
- Database Connection Live Testing
- Automatically create database if not exist (No matter if mysql, postgresql or sqlite)
- Disable Database
- Detailled Final Step Overview showing your changes to the env before you submit
- and more!


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

and click on 'Start Setup'


## Authors

* **Kevin Rodd** - *Initial work* - [GhostBC](https://github.com/ghostbc)
* **Andreas Wolf** - *Initial work* - [AWolf86](https://github.com/Kappalores)

## License

This project is licensed under the GNU General Public License v3.0 - see the [LICENSE.md](LICENSE.md) file for details
