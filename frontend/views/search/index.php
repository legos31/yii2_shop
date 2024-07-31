<?php

echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => true,
    'columns' => [
        'name',
        'brand_id',
        'category_id',
        'price_new'
        // ...
    ],
]);