## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

# Installation du projet

Dans un premier temps, vérifiez que vous disposez d'un serveur local (**Wamp**, **Xampp**),
que vous avez procédé à l'installation de **composer**
([lien pour l'installation de composer](https://getcomposer.org/download/)), que
vous avez installé **Git** ([lien pour l'installation](https://git-scm.com/downloads))
et que vous disposiez de l'archive **Dossiers Laravel**.

Avant de cloner le repo git, vérifiez dans le fichier **php.ini** que la ligne
**extension=php_fileinfo.dll** (**Windows**) ou **php_value extension fileinfo.so**
(**Mac** ou **Linux**) ne soit pas commentée (donc pas de **;** devant la ligne), puis
redémarrez votre serveur.

Dans le dossier de votre serveur (**www** sous **Wamp**, **htdocs** sous **Xampp**), faites un clic droit
-> Git bash here -> et faites un clone du repo git
**https://github.com/MisterX25/GPNV.git** avec la commande
`git clone lien du repo`. Allez dans le dossier **Gestion_Projet_MAW2"** et
faites un `git checkout dev` afin de changer de branche.
Maintenant ouvrez l'archive **Dossiers Laravel** et copiez le contenu dans le
projet (Deux dossiers **vendor** et **test** ainsi que le fichier **.env**).
Dans la fenêtre de commande, faites un `composer update`afin de mettre à jour
les différents fichiers propres à Laravel. Il est possible que celui-ci vous
demande un **token**, copiez donc le lien qu'il vous fournit, connectez-vous
avec votre compte, générez un token et copiez-le dans la fenêtre de commande.
Maintenant, ouvrez un navigateur et allez dans **MySQL Workbench** et créez une bdd
nommée **GPNV**. Dans la fenêtre de commande, faites un `php artisan migrate --seed`
afin de charger toute la bdd.

Vous pouvez dès à présent utiliser le projet. Voici les différents logins avec leur
mot de passe:

**Login :** utilisateur@mail.com, **Mot de passe :** secret

**Login :** tournesol@mail.com, **Mot de passe :** secret
