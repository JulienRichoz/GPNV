# GPNV

## Requirements
- Laravel 5.3
- PHP >= 5.6.4
- Git

## Installation
> Note: This procedure explain only how to set up the site, not how to configure
> Laravel or create a server.

Once this project is copy in your server, go to the project root and
use the following command :`cp .env.example .env`.
Don't forget to create the database and grant access to the user.

Create the database by default the name is `GPNV`
Grant access to the user by default `root` with password `root`
> Eventually, you can open the file `.env` and change the database name, password, etc.
> depends on your needs.

Composer is require for this project, so use the command : `composer install`

After that, use the command : `php artisan key:generate` in order to generate
the APP_KEY for the project.

And finally, use the command : `php artisan migrate` and `php artisan db:seed`
for generating the database structure and adding the test datas.

>If you are on Linux os make sure that laravel has the necessary rights on the website directory

## Configuration Notes
These are the default logins informations, you don't need that if you haven't
use the command : `php artisan db:seed` during the installation.

 Login                 | Password
 ----------------------|----------
 utilisateur@mail.com  |  secret
 tournesol@mail.com    |  secret

## Use app in "Test Mode"
In order to use the site, an addon able to modify HTTP Header is needed.
Here is some addons for the most used browsers :
 - Mozilla Firefox : https://addons.mozilla.org/fr/firefox/addon/modify-headers/?src=search
 - Google Chrome : https://chrome.google.com/webstore/detail/modify-headers-for-google/innpjfdalfhpcoinfnehdnbkglpmogdi

In order to connect, for the first time, you must use one of the two accounts (add from the database seed).
The header to add is "X-Forwarded-User" and the value is :
 - For Teacher : 2
 - For Student : 1
