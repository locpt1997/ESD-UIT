<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderDetail */

$this->title = 'Create Order Detail';
$this->params['breadcrumbs'][] = ['label' => 'Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProviderProduct,
        'filterModel' => $searchModelProduct,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'basePrice',
            'image',
            //'categoryid',
            //'onHand',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
