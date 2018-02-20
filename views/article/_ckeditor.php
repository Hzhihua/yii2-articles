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

?>

<? $model->content = $model->preview_content ?>
<?= $form->field($model, 'content')->widget(CKEditor::className(), [
    'options' => ['rows' => 6],
    'preset' => 'full', /* @see \dosamigos\ckeditor\CKEditorTrait */
]) ?>
