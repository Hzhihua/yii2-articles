<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\widgets\ActiveForm;

/* @var $model \hzhihua\articles\models\search\ArticleCategorySearch */
/* @var $this \yii\web\View */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
?>

<div class="article-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= HtmlHelper::submitButton(Yii::t('articles', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= HtmlHelper::resetButton(Yii::t('articles', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
