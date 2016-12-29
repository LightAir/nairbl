# Nairbl
<p align="center">
    <img src="https://raw.githubusercontent.com/LightAir/nairbl/25c9b1056fadb6aaccbcf6d4d6ed651f7355c540/assets_src/images/logo_mini.png" alt="Nairbl"/>
</p>

Nairbl - is blog backend. Based on Lumen PHP Framework. Used dingo, jwt, fractal

[![Build Status](https://travis-ci.org/LightAir/nairbl-server.svg?branch=master)](https://travis-ci.org/LightAir/nairbl-server)
[![codecov](https://codecov.io/gh/LightAir/nairbl-server/branch/master/graph/badge.svg)](https://codecov.io/gh/LightAir/nairbl-server)
[![Codacy 
Badge](https://api.codacy.com/project/badge/Grade/09454f45c2bb42d5b95464fcc0332e0c)](https://www.codacy.com/app/the/nairbl-server?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=LightAir/nairbl-server&amp;utm_campaign=Badge_Grade)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)]()


# install

you can use composer
```
composer require lightair/nairbl-server
```

you can use Vagrant

```shell
vagrant up

mysqladmin create nairbl

sudo nano /etc/nginx/nginx.conf
```

in file nginx.conf set path to folder /var/www/default/public

```shell
cd /var/www/default/

composer install

php artisan jwt:secret

```

set APP_KEY in .env file

```shell
sudo service nginx restart

php artisan migrate

php vendor/bin/phpunit

```

#### What are you building?
Blog

#### What is a Lumen?
[Lumen](https://lumen.laravel.com/ "Lumen") is the younger brother of Laravel)

#### What will it be used for?
Any

#### Which two main programming languages are you using?
PHP

#### Which packages, libraries and APIs are you using?
Lumen Framework, dingo, jwt, fractal

#### Is it a fun or commercial project?
It a fun

#### On which website can people test it and give feedback?
[Github issues](https://github.com/LightAir/nairbl-server/issues "Github issues")

public@softroot.ru
