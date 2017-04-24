<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Blog */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

    <?php
    if ($model->user_id == Yii::$app->user->id)
    {
        ?>
        <p>
            <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </p>
        <?php
    }
    ?>
    <hr>
    <h1><?=$model->description?></h1>
    <div style="">
        <img src="/<?=$model->image?>" style="">
        <span><?=$model->article?></span>
    </div>
    <div style="">
        <b>Автор: </b> <?=$model->user->surname . ' ' . $model->user->name?>
    </div>
    <hr>
    <div>
        <?= $this->render('../comment/_form', [
            'model' => $comment,
        ]) ?>
    </div>
    <div>
        <?php
        foreach ($model->comments as $key => $val)
        {
            ?>
                <div style="border: 1px dotted #3498db;padding:  20px 20px 40px; margin-bottom: 20px;">
                    <p>
                        <b>Комментарий: </b>
                        <?=$val->comment?>
                    </p>
                    <div style="float: left;">
                        <b>Пользователь: </b>
                        <?=$val->user->surname . " " . $val->user->name?>
                    </div>
                    <div style="float: right;">
                        <b>Дата создания: </b>
                        <?=$val->create_date?>
                    </div>
                </div>
            <?php
        }
        ?>
    </div>
</div>
