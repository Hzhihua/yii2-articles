<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\widgets\ActiveForm;

/* @var $model \hzhihua\articles\models\search\ArticleAndCategorySearch */
/* @var $this \yii\web\View */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
?>

<div class="article-and-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'article_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= HtmlHelper::submitButton(Yii::t('articles', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= HtmlHelper::resetButton(Yii::t('articles', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
