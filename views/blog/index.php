<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!--    --><?php //// echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'user_id',
//            'description',
//            'article:ntext',
//            'create_date',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>

    <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'list-view'],
            'itemView' => function ($model, $key, $index, $widget)
                {
                     return
                        "<a href='view/?id=$model->id'/><div style='margin: 40px; display: inline-block;'>" .
                            "<div style='width: 300px; float:left; margin-right: 30px;'>".
                                "<img src='/$model->image' style=''>".
                            "</div>".
                            Html::a(Html::encode($model->description), ['view', 'id' => $model->id]) .
                        "</div></a>".
                        "<hr>";
                },
        ])
    ?>
</div>
