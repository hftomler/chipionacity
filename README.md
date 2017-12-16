
![Logo](https://github.com/hftomler/chipionacity/blob/master/backend/web/imagenes/logohome.png)

Chipiona City. Web online de contratación de experiencias.
==========================================================

La principal funcionalidad de la aplicación web es la de ofrecer la contratación anticipada de servicios relacionados con el ocio y tiempo libre.

Pondrá a disposición del usuario la posibilidad de contratar y/o reservar online cualquier tipo de servicio disponible en la localidad y Costa Noroeste de la Provincia de Cádiz, desde alquiler de bicicletas hasta contratación de un guía turístico. Ofrecerá una amplísima variedad de servicios de ocio: Formación (clases de tenis, hípica, guitarra, inglés, vela, etc.), turismo tradicional (visita y entrada a los monumentos y museos de la localidad, con o sin guía), turismo medioambiental (rutas de senderismo, rutas en bicicleta, visita a corrales de pesca, visitas guiadas a parque dunar), Deporte (reserva de pistas deportivas, públicas o privadas), Náutica  (salidas en velero) o Restauración (reserva previa en restaurantes).

En definitiva intentará ofertar, agrupados en una sola web, la gran diversidad de servicios ofrecidos por autónomos, empresas e instituciones y que, en la actualidad, sólo es posible encontrar virtualmente de forma aislada e incluso algunos de ellos sólo de forma presencial.


Ir a [Documentación](https://github.com/hftomler/chipionacity/blob/master/guia/README.md)

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
