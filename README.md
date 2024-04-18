# [README in English](README-en.MD)

# Ceci est mon package newyoutube

[![Dernière version sur Packagist](https://img.shields.io/packagist/v/leknoppix/newyoutube.svg?style=flat-square)](https://packagist.org/packages/leknoppix/newyoutube)
[![Statut de l'action des tests GitHub](https://img.shields.io/github/actions/workflow/status/leknoppix/newyoutube/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/leknoppix/newyoutube/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Statut de l'action du style de code GitHub](https://img.shields.io/github/actions/workflow/status/leknoppix/newyoutube/fix-php-code-style-issues.yml?branch=main&label=style%20de%20code&style=flat-square)](https://github.com/leknoppix/newyoutube/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Téléchargements totaux](https://img.shields.io/packagist/dt/leknoppix/newyoutube.svg?style=flat-square)](https://packagist.org/packages/leknoppix/newyoutube)

C'est ici que votre description devrait aller. Limitez-la à un paragraphe ou deux. Envisagez d'ajouter un petit exemple.

## Installation

Vous pouvez installer le package via Composer :

```bash
composer require leknoppix/newyoutube
```

Vous pouvez publier et exécuter les migrations avec :

```bash
php artisan vendor:publish --tag="newyoutube-migrations"
php artisan migrate
```

Vous pouvez publier le fichier de configuration avec :

```bash
php artisan vendor:publish --tag="newyoutube-config"
```

Voici le contenu du fichier de configuration publié :

```php
return [
];
```

Facultativement, vous pouvez publier les vues en utilisant:

```bash
php artisan vendor:publish --tag="newyoutube-views"
```

## Utilisation

```php
$newYoutube = new Leknoppix\NewYoutube();
echo $newYoutube->echoPhrase('Hello, Leknoppix!');
```

## Tests

```bash
composer test
```

## Journal des modifications

Veuillez consulter [CHANGELOG](CHANGELOG.md) pour plus d'informations sur les changements récents.

## Contribuer

Veuillez consulter [CONTRIBUTING](CONTRIBUTING.md) pour plus de détails.

## Vulnérabilités de sécurité

Veuillez consulter [our security policy](../../security/policy) sur la manière de signaler les vulnérabilités de sécurité.

## Crédits

- [Pascal Canadas](https://github.com/leknoppix)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
