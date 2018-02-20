<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-19 14:31
 * @Github: https://github.com/Hzhihua
 */

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\Article */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
/* table column name is **content** in {{%article}} table */

use yii\web\JsExpression;
use yiier\editor\EditorMdWidget;
use hzhihua\articles\helpers\HtmlHelper;

?>

<?= $form->field($model, 'content')->widget(EditorMdWidget::className(), [
//        'options'=>[// html attributes
//            'id'=>'content',
//        ],
        'clientOptions' => [
            'heightt' => '580',
            'width' => '100%',
//            'previewTheme' => 'dark',
//            'editorTheme' => 'pastel-on-dark',
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
            'onfullscreen' => new JsExpression('function () {this.editor.css("border-radius", 0).css("z-index", 9999);}'),
            'onfullscreenExit' => new JsExpression('function() {this.editor.css({zIndex: 10,border: "none","border-radius": "5px"});this.resize();}'),
        ]
    ]
) ?>