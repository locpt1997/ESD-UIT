<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>  
    <?=Html::beginForm(['product/add-kiotviet-product'],'post');?>
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
            'fullName',
            'categoryName',
            'basePrice',
        ],
    ]); ?>
    <?= Html::endForm();?>

   

