<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\widgets\ActiveForm;

/* @var $model \hzhihua\articles\models\ArticleAndTag */
/* @var $this \yii\web\View */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
?>

<div class="article-and-tag-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'article_id')->textInput() ?>

        <?= $form->field($model, 'tag_id')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= HtmlHelper::submitButton(Yii::t('articles', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
