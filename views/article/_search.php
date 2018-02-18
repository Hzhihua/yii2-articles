<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\widgets\ActiveForm;

/* @var $model \hzhihua\articles\models\search\ArticleSearch */
/* @var $this \yii\web\View */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'is_top') ?>

    <?= $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'public_time') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= HtmlHelper::submitButton(Yii::t('articles', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= HtmlHelper::resetButton(Yii::t('articles', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
