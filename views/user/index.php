<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">




    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php \app\common\widgets\BoxWidget::begin();?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [


            'id',
            'img_url' => [
                'attribute' => 'img_url',
                'format' => ['image',['width'=>'50','height'=>'50']],
                'value'     => function($model){
                    return $model->img_url;
                }
            ],
//            'access_token',
//            'open_id',
//            'refresh_token',
//            'union_id',
            //'expires_in',
            //'donation_money',
            'nickname',
            'sex',
            'donation_money',

            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php \app\common\widgets\BoxWidget::end();?>

</div>
