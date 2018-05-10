<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-19 23:33
 * @Github: https://github.com/Hzhihua
 */

use dosamigos\ckeditor\CKEditor;
use dosamigos\ckeditor\CKEditorInline;

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\Article */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
/* table column name is **content** in {{%article}} table */
/* @see https://packagist.org/packages/2amigos/yii2-ckeditor-widget */

//$this->registerJs("CKEDITOR.plugins.addExternal('image2', '/gp/backend/web/ckeditor_plugins/image2/plugin.js', '');");
?>

<? $model->content = $model->preview_content ?>
<?= $form->field($model, 'content')->widget(CKEditor::className(), [
//    'options' => ['rows' => 6],
    'preset' => 'custom', /* @see \dosamigos\ckeditor\CKEditorTrait */
    'clientOptions' => [
//        'extraPlugins' => 'uploadimage',
        'filebrowserUploadUrl' => 'http://localhost/gp/backend/web/index.php?r=article/article/file-upload',
        'filebrowserBrowseUrl' => 'http://localhost/gp/source/',
    ],
]) ?>
