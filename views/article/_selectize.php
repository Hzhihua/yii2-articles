<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-20 13:43
 * @Github: https://github.com/Hzhihua
 */

use yii\web\JsExpression;
use hzhihua\articles\models\ArticleTag;
use hzhihua\articles\models\ArticleCategory;
use hzhihua\articles\models\ArticleAndTag;
use hzhihua\articles\models\ArticleAndCategory;
use hzhihua\articles\helpers\ArrayHelper;
use dosamigos\selectize\SelectizeDropDownList;

/* @var $this \yii\web\View */
/* @var $model \hzhihua\articles\models\Article */
/* @var $form \hzhihua\articles\widgets\ActiveForm */
/* @var $attribute string */
/* @see https://github.com/selectize/selectize.js/tree/master/docs */
$userId = (int) Yii::$app->getUser()->identity->getId();
$selectData = []; // all select data
$selectedData = ''; // data had been selected
$options = [
    'options' => [
        'style' => 'width:33%;height:94px;float:left;', // css style
    ]
];

switch ($attribute) {
    case 'tag':
        $selectData = ArticleTag::find()->where(['created_by' => $userId])->select(['id', 'name'])->asArray()->all();
        $selectedData = ArticleAndTag::find()->where(['article_id' => $model->id])->select('tag_id as _id')->asArray()->column();
        break;

    case 'category':
        $selectData = ArticleCategory::find()->where(['created_by' => $userId])->select(['id', 'name'])->asArray()->all();
        $selectedData = ArticleAndCategory::find()->where(['article_id' => $model->id])->select('category_id as _id')->asArray()->column();
        $options['options']['style'] = $options['options']['style'] . ';margin:0 .5% 0 .5%;';
        break;
}
$selectedData = implode(',', $selectedData ?: []);

$css = <<<CSS
div.selectize-dropdown-content > div > span {
    color: #000000;
}
CSS;

$js = <<<JS
var formatName = function(item) {return $.trim((item.name || ''));};
JS;

$this->registerJs($js);
$this->registerCss($css);
?>

<?= $form->field($model, $attribute, $options)->widget(SelectizeDropDownList::className(), [
    'options' => [
        'name' => "Article[{$attribute}][]",
    ],
    'clientOptions' => [
        'persist' => false,
        'maxItems' => null,
        'plugins' => ['remove_button'],
        'create' => false,
        'delimiter' => ',',
        'valueField' => 'id',
        'labelField' => 'name',
        'searchField' => [
            'name',
        ],
        'sortField' => [
            [
                'field' => 'id',
                'direction' => 'asc',
            ],
        ],
        'options' => $selectData,

        'render' => [
            'item' => new JsExpression("function(item, escape) { var name = formatName(item); return '<div>' + (name ? '<span class=\"name\">' + escape(name) + '</span>' : '') + '</div>';}"),
            'option' => new JsExpression("function(item, escape) { var name = formatName(item); var label = name; return '<div>' + '<span class=\"label\">' + escape(label) + '</span>' + '</div>';}"),
        ],
        // set default value
        'onInitialize' => new JsExpression("function () { this.setValue([{$selectedData}]) }"),
    ],
]) ?>

