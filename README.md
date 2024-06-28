<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Yii 2 Advanced Project Template is a skeleton [Yii 2](https://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

php init

php -S localhost:8000

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
----------------------------------------------------------------

Notes

Bower.io - репозиторий для пакетов js и css [npm install -g bower]
******************************************************************
Dependency Manager for Composer. Без установки NPM or Bower. Установка пакетов из Bower через composer [composer global require "fxp/composer-asset-plugin:~1.3"]
Использование: composer require bower-asset/jquery
******************************************************************
https://asset-packagist.org замена Bower. Composer + Bower + NPM = friends forever!
Для использования добавляем:
"repositories": [
        {
            "type": "composer",
            "url": "https://asset-packagist.org"
        }]
Будет обрабатывать:
"require": {
    "bower-asset/bootstrap": "^3.3",
    "npm-asset/jquery": "^2.2"
}
******************************************************************
Add frontendUrlManager
Add backendUrlManager
******************************************************************
'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
            'cachePath' => '@common/runtime/cache'
        ],
    ],
Один кеш для админки и фронта
*******************************************************************
что при входе на http://front.loc заходить и на http://admin.front.loc
cookieValidationKey одикаковый в main-local.php backend & frontend
одинаковое имя сессии и куки
*******************************************************************