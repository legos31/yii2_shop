<?php

use backend\widgets\grid\RoleColumn;
use shop\entities\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use shop\helpers\UserHelper;

/** @var yii\web\View $this */
/** @var backend\forms\userSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'filter' => UserHelper::statusList(),
                'value' => function (User $model) {
                    return UserHelper::statusLabel($model->status);
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'role',
                'class' => RoleColumn::class,
                'filter' => $searchModel->rolesList(),
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d'],
                'filter' => \yii\jui\DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'date_from',
                    'dateFormat' => 'php:Y-m-d',
                    'options' => [
                        'class' => 'form-control',
                        'autocomplete' => 'off',
                    ]
                ]),
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, user $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
