<?php

use hzhihua\articles\helpers\Html;
use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\helpers\ArrayHelper;
use hzhihua\articles\widgets\ActiveForm;
use hzhihua\articles\models\ArticleTag;
use hzhihua\articles\models\ArticleStatus;
use hzhihua\articles\models\ArticleCategory;

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\Article */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
/* @var Yii::$app->controller->module \hzhihua\articles\Module */

$defaultStatusId = ArticleStatus::getDefaultStatusId();

/* @see \yii\web\View::render() */
switch (Yii::$app->controller->module->editor) {
    case 'markdown':
        $editorViewFile = '@vendor/hzhihua/yii2-articles/views/article/_markdown_editor.php';
        break;

    case 'ckeditor':
        $editorViewFile = '@vendor/hzhihua/yii2-articles/views/article/_ckeditor.php';
        break;

    default:
        $editorViewFile = Yii::$app->controller->module->editorViewFile ?: '@vendor/hzhihua/yii2-articles/views/article/_markdown_editor.php';
        break;
}

?>

<div class="article-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'title', ['options' => ['style' => 'width:33%;height:94px;float:left']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'is_top', ['options' => ['style' => 'width:33%;height:94px;margin:0 .5% 0 .5%;float:left']])->dropDownList([
            0 => Yii::t('articles', 'No'),
            1 => Yii::t('articles', 'Yes'),
        ],[
            'options' => [
                ($model->is_top ?: 0) => [
                    'Selected' => 'selected',
                ],
            ],
        ]) ?>

        <?= $form->field($model, 'status', ['options' => ['style' => 'width:33%;height:94px;float:left']])->dropDownList(ArrayHelper::map(ArticleStatus::selectAll(), 'id', 'name'), [
            'options' => [
                ($model->status_id ?: $defaultStatusId) => [
                    'Selected' => 'selected',
                ],
            ],
        ]) ?>

        <?= $this->render(Yii::$app->controller->module->selectizeViewFile, [
            'form' => $form,
            'model' => $model,
            'attribute' => 'tag',
        ])?>

        <?= $this->render(Yii::$app->controller->module->selectizeViewFile, [
            'form' => $form,
            'model' => $model,
            'attribute' => 'category',
        ])?>

        <?= $this->render(Yii::$app->controller->module->dateRangePickerViewFile, [
            'form' => $form,
            'model' => $model,
        ]) ?>

        <?= $form->field($model, 'description', ['options' => ['style' => 'clear:both']])->textarea() ?>

        <?= $this->render($editorViewFile, [
            'form' => $form,
            'model' => $model,
        ]) ?>

    </div>
    <div class="box-footer">
        <?= HtmlHelper::submitButton(Yii::t('articles', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>