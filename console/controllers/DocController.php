<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class DocController extends Controller
{
    public function actionBuild(): void
    {
//        $swagger = Yii::getAlias('@vendor/bin/swagger');
//        $source = Yii::getAlias('@api/controllers');
//        $target = Yii::getAlias('@api/web/docs/swagger.json');
//
//        passthru('"' . PHP_BINARY . '"' . " \"{$swagger}\" \"{$source}\" --output \"{$target}\"");

        $openapi = \OpenApi\Generator::scan(['api/controllers']);
        header('Content-Type: application/x-yaml');
        echo $openapi->toYaml();
    }
}