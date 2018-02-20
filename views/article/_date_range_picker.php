<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-20 11:49
 * @Github: https://github.com/Hzhihua
 */

use trntv\yii\datetime\DateTimeWidget;

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\Article */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
/* table column name is **public_time** in {{%article}} table */

?>

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
