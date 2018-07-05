<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>  
    <?=Html::beginForm(['category/add-kiotviet-category'],'post');?>
    <?=Html::submitButton('Save', ['class' => 'btn btn-info',]);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\CheckBoxColumn',
            'contentOptions'=>[ 'style'=>'width: 50px'],
            'checkboxOptions'=> function($model, $key, $index, $column) {
             return ["value" => $model->categoryId];
            }],
            'categoryId',
            'categoryName',
            'retailerId',
            'createdDate',
        ],
    ]); ?>
    <?= Html::endForm();?> 

   

