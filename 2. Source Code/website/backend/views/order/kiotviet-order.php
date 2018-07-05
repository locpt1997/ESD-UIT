<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Category */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
    <?=Html::beginForm(['order/add-kiotviet-order'],'post');?>
    <?=Html::submitButton('Save', ['class' => 'btn btn-info',]);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\CheckBoxColumn',
            'contentOptions'=>[ 'style'=>'width: 50px'],
            'checkboxOptions'=> function($model, $key, $index, $column) {
             return ["value" => $model->id];
            }],
            'id',
            'code',
            'name',
        ],
    ]); ?>
    <?= Html::endForm();?> 