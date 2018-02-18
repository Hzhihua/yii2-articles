<?php

use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\widgets\ActiveForm;
use hzhihua\articles\helpers\ArrayHelper;
use hzhihua\articles\models\ArticleStatus;

/* @var $model \hzhihua\articles\models\ArticleStatus */
/* @var $this \yii\web\View */
/* @var $form \hzhihua\articles\widgets\ActiveForm */

$child = ArrayHelper::map(ArticleStatus::find()->asArray()->all(), 'id', 'name');
ArrayHelper::remove($child, $model->id);
$child[0] = Yii::t('articles', 'null');

?>

<div class="article-status-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'child')->dropDownList($child, [
            'options' => [
//                'value' => $model->child ?: 0,
                ($model->child ?: 0) => [
                    'Selected' => 'selected',
                ],
            ],
        ]) ?>

        <?= $form->field($model, 'is_default_status')->dropDownList([
            0 => Yii::t('articles', 'No'),
            1 => Yii::t('articles', 'Yes'),
        ],[
            'options' => [
                ($model->is_default_status ?: 0) => [
                    'Selected' => 'selected',
                ],
            ],
        ]) ?>

        <?= $form->field($model, 'is_allow_public')->dropDownList([
            0 => Yii::t('articles', 'No'),
            1 => Yii::t('articles', 'Yes'),
        ],[
            'options' => [
                ($model->is_allow_public ?: 0) => [
                    'Selected' => 'selected',
                ],
            ],
        ]) ?>

    </div>
    <div class="box-footer">
        <?= HtmlHelper::submitButton(Yii::t('articles', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
