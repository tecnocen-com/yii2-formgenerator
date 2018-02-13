Tecnocen Form Generator
=======================

Libreria para generar dinamicamente formularios usando una base de datos.

[![Latest Stable Version](https://poser.pugx.org/tecnocen/yii2-formgenerator/v/stable)](https://packagist.org/packages/tecnocen/yii2-formgenerator)
[![Total Downloads](https://poser.pugx.org/tecnocen/yii2-formgenerator/downloads)](https://packagist.org/packages/tecnocen/yii2-formgenerator)
[![Code Coverage](https://scrutinizer-ci.com/g/tecnocen-com/yii2-formgenerator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/tecnocen-com/yii2-formgenerator/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/tecnocen-com/yii2-formgenerator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/tecnocen-com/yii2-formgenerator/?branch=master)

Scrutinizer [![Build Status Scrutinizer](https://scrutinizer-ci.com/g/tecnocen-com/yii2-formgenerator/badges/build.png?b=master&style=flat)](https://scrutinizer-ci.com/g/tecnocen-com/yii2-formgenerator/build-status/master)
Travis [![Build Status Travis](https://travis-ci.org/tecnocen-com/yii2-formgenerator.svg?branch=master&style=flat?style=for-the-badge)](https://travis-ci.org/tecnocen-com/yii2-formgenerator)

## Iniciando

Estas instrucciones te generaran una copia del proyecto funcional y ejecutable
en tu maquina local para propositos de despliegue y realizacion de pruebas. Vea
la seccion Despliegue para las notas de como desplegar el proyecto en un sistema
productivo.

### Prerequisitos

- Instalar PHP 7.0 or superior
- [Composer Instalado](https://getcomposer.org/doc/00-intro.md)

Los demas requerimientos son revisados por composer al instalar el sistema en
el proximo paso.

### Instalacion
----------------

Puedes usar composer para instalar la libreria `tecnocen/yii2-formgenerator` con
el comando;

`composer require tecnocen/yii2-formgenerator`

o editar el archivo `composer.json`

```json
require: {
    "tecnocen/yii2-formgenerator": "*",
}
```

### Despliegue

Correr las migraciones requeridas.

`php yii migrate/up -p=@tecnocen/formgenerator/migrations`

Que instala la siguiente estructura.
![Database Diagram](diagram.png)

#### Uso en backend con ROA
---------------------------

El soporte para ROA es muy simple y puede habilitarse solo con agregar el
modulo de version al contenedos de api que sera usado para contener los
recursos.

```php
class Api extends \tecnocen\roa\modules\ApiContainer
{
   $versions = [
       // other versions
       'fg1' => ['class' => 'tecnocen\formgenerator\roa\module\Version'],
   ];
}
```

Despues puedes acceder al modulo para revisar los recursos disponibles.

- data-type
- field
- field/<field_id:\d+>/rule
- field/<field_id:\d+>/rule/<rule_id:\d+>/property
- form
- form/<form_id:\d+>/section
- form/<form_id:\d+>/section/<section_id:\d+>/field
- form/<form_id:\d+>/solicitude
- form/<form_id:\d+>/solicitude/<solicitude_id:\d+>/value

Que implementan funcionalidades CRUD para formgenerator.

Alternativamente puedes agregar las rutas de los recursos a una version
existente.

## Correr las pruebas

Esta libreria contiene herramientas para habilitar entorno de pruebas usando
composer scripts. Para mas informacion ver la seccion [Entorno de Pruebas](CONTRIBUTING.md)

### Despliegue de pruebas.

Para desplegar el ambiente de pruebas cree o edite el archivo
`tests/_app/config/db.local.php` con las configuraciones para el componente
`yii\base\Application::$db` exclusivas a tu entorno local.

Una vez configurado corra el comando.

```
composer deploy-tests
```

### Correr pruebas

Correr las pruebas con el comando.

```
composer run-tests
```

Correr las pruebas con cobertura de codigo.

```
composer run-coverage
```

## Use Cases

TO DO

## Built With

* Yii 2: The Fast, Secure and Professional PHP Framework [http://www.yiiframework.com](http://www.yiiframework.com)

## Code of Conduct

Please read [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) for details on our code of conduct.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/tecnocen-com/yii2-formgenerator/tags).

_Considering [SemVer](http://semver.org/) for versioning rules 9, 10 and 11 talk about pre-releases, they will not be used within the Tecnocen-com._

## Authors

* [**Angel Guevara**](https://github.com/Faryshta) - *Initial work* - [Tecnocen.com](https://github.com/Tecnocen-com)
* [**Carlos Llamosas**](https://github.com/neverabe) - *Initial work* - [Tecnocen.com](https://github.com/Tecnocen-com)

See also the list of [contributors](https://github.com/tecnocen-com/yii2-formgenerator/graphs/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* TO DO - Hat tip to anyone who's code was used
* TO DO - Inspiration
* TO DO - etc

[![yii2-workflow](https://img.shields.io/badge/Powered__by-Tecnocen.com-orange.svg?style=for-the-badge)](https://www.tecnocen.com/)
