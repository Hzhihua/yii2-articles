<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\widgets\ActiveForm;

/* @var $model \hzhihua\articles\models\ArticleCategory */
/* @var $this \yii\web\View */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
?>

<div class="article-category-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        
    </div>
    <div class="box-footer">
        <?= HtmlHelper::submitButton(Yii::t('articles', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
