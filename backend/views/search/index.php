<?php

echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
       'name',
        'brand_id',
        'category_id',
        'price_new'
        // ...
    ],
]);