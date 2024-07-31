<?php

namespace frontend\controllers;

use shop\entities\shop\Product\Product;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SearchController extends Controller
{
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->active(),
        ]);


        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }
}