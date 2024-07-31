<?php

namespace backend\controllers;

use backend\forms\Shop\ProductSearch;
use shop\entities\shop\Product\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class SearchController extends Controller
{
    public function actionIndex() {

        $a = ['1', '2', '3', '4', '5'];
        $sum = 0;
        foreach ($a as &$b) {
            $sum += $b;

        }
        var_dump($b);
        $b = $sum * $sum;
        var_dump($b);die;
        //echo $sum;die;


        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModel = new ProductSearch();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
}