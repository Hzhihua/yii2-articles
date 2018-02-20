<?php

use hzhihua\articles\helpers\Html;
use hzhihua\articles\helpers\HtmlHelper;
use hzhihua\articles\helpers\ArrayHelper;
use hzhihua\articles\widgets\ActiveForm;
use hzhihua\articles\models\ArticleTag;
use hzhihua\articles\models\ArticleStatus;
use hzhihua\articles\models\ArticleCategory;
use trntv\yii\datetime\DateTimeWidget;
use dosamigos\selectize\SelectizeDropDownList;

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
                $defaultStatusId => [
                    'Selected' => 'selected',
                ],
            ],
        ]) ?>

        <?= $form->field($model, 'tag', ['options' => ['style' => 'width:33%;height:94px;float:left']])->widget(SelectizeDropDownList::className(), [
//            'name' => 'tag',
//            'items' => [
//                'Brian Reavis',
//                'Nikola Tesla',
//                'someone@gmail.com',
//            ],
            'clientOptions' => [
                'plugins' => [
                    'remove_button',
                ],
                'delimiter' => ',',
                'persist' => false,
                'create' => new \yii\web\JsExpression('function(input) {
        return {
            value: input,
            text: input
        }
    }'),
//                'maxItems' => null,
//                'valueField' => 'email',
//                'labelField' => 'name',
//                'searchField' => [
//                    'name',
//                    'email',
//                ],
//                'options' => [
//                    [
//                        'email' => 'brian@thirdroute.com',
//                        'name' => 'Brian Reavis',
//                    ],
//                    [
//                        'email' => 'nikola@tesla.com',
//                        'name' => 'Nikola Tesla',
//                    ],
//                    [
//                        'email' => 'someone@gmail.com',
//                        'name' => '<h1>somehere</h1>',
//                    ],
//                ],

            ],
        ]) ?>
        <?= $form->field($model, 'category', ['options' => ['style' => 'width:33%;height:94px;margin:0 .5% 0 .5%;float:left']])->textInput() ?>

        <?php $public_time = $model->public_time; $model->public_time = null ?>
        <?= $form->field($model, 'public_time', ['options' => ['style' => 'width:33%;height:94px;float:left']])->widget(DateTimeWidget::className(),[
            // 2018-02-09 11:29:48, 周五
            'momentDatetimeFormat' => 'YYYY-MM-DD HH:mm:ss',
            'clientOptions' => [
                'defaultDate' => date('Y-m-d H:i:s', $public_time ?: time()), // set default value
                'allowInputToggle' => true,
                'sideBySide' => true,
                'locale' => Yii::$app->language,
                'widgetPositioning' => [
                    'horizontal' => 'auto',
                    'vertical' => 'auto'
                ]
            ]
        ]);?>

        <?= $form->field($model, 'description', ['options' => ['style' => 'width:100%;float:left']])->textInput(['maxlength' => true]) ?>

        <?= $this->render($editorViewFile, [
            'form' => $form,
            'model' => $model,
        ]);?>

    </div>
    <div class="box-footer">
        <?= HtmlHelper::submitButton(Yii::t('articles', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>