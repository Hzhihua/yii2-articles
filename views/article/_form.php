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
use yiier\editor\EditorMdWidget;


/* @var $model \hzhihua\articles\models\Article */
/* @var $this \yii\web\View */
/* @var $form \hzhihua\articles\widgets\ActiveForm */

$defaultStatusId = ArticleStatus::getDefaultStatusId();

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


        <?= $form->field($model, 'content', ['options' => ['style' => 'width:100%;clear:both']])->widget(EditorMdWidget::className(), [
//                'options'=>[// html attributes
//                    'id'=>'content',
//                ],
                'clientOptions' => [
                    'heightt' => '580',
                    'width' => '100%',
//                    'previewTheme' => 'dark',
//                    'editorTheme' => 'pastel-on-dark',
                    'markdown' => HtmlHelper::htmlEncode($model->content), // 文本内容
                    'placeholder' => Yii::t('articles', 'You can edit article content in here'), // 文本内容提示
                    'codeFold' => true,
                    'syncScrolling' => true,
                    'saveHTMLToTextarea' => true,    // 保存 HTML 到 Textarea
                    'searchReplace' => true,
                    'watch' => true, // 关闭实时预览
                    'htmlDecode' => 'style,script,iframe|on*', // 开启 HTML 标签解析，为了安全性，默认不开启
                    'toolbar ' => false,             //关闭工具栏
                    'previewCodeHighlight' => true, // 关闭预览 HTML 的代码块高亮，默认开启
                    'emoji' => true,
                    'taskList' => true,
                    'tocm' => true,    // Using [TOCM]
                    'tex' => true,    // 开启科学公式TeX语言支持，默认关闭
                    'flowChart' => true,             // 开启流程图支持，默认关闭
                    'sequenceDiagram' => true,       // 开启时序/序列图支持，默认关闭,
                    'dialogLockScreen' => false,   // 设置弹出层对话框不锁屏，全局通用，默认为true
                    'dialogShowMask' => false,    // 设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                    'dialogDraggable' => false,    // 设置弹出层对话框不可拖动，全局通用，默认为true
                    'dialogMaskOpacity' => 0.4,    // 设置透明遮罩层的透明度，全局通用，默认值为0.1
                    'dialogMaskBgColor' => '#000', // 设置透明遮罩层的背景颜色，全局通用，默认为#fff
                    'imageUpload' => true,
                    'imageFormats' => ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'],
                    'imageUploadURL' => '/file/blog-upload?type=default&filekey=editormd-image-file',
                    'onfullscreen' => new \yii\web\JsExpression('function () {this.editor.css("border-radius", 0).css("z-index", 9999);}'),
                    'onfullscreenExit' => new \yii\web\JsExpression('function() {this.editor.css({zIndex: 10,border: "none","border-radius": "5px"});this.resize();}'),
                ]
            ]
        ) ?>


    </div>
    <div class="box-footer">
        <?= HtmlHelper::submitButton(Yii::t('articles', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>