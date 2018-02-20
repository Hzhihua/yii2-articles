<?php

namespace hzhihua\articles;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use hzhihua\articles\behaviors\UserBehavior;
use hzhihua\articles\behaviors\I18NBehavior;
use hzhihua\articles\behaviors\ControllerBehavior;

/**
 * article module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'hzhihua\articles\controllers';

    /**
     * default route
     * @var string
     */
    public $defaultRoute = 'article/index';

    /**
     * @var \yii\db\Connection
     */
    public $db = 'db';

    /**
     * model table name
     * @var array
     */
    public $tableName = [
        'article' => '{{%article}}',
        'article_status' => '{{%article_status}}',
        'article_tag' => '{{%article_tag}}',
        'article_category' => '{{%article_category}}',
        'article_and_tag' => '{{%article_and_tag}}',
        'article_and_category' => '{{%article_and_category}}',
    ];

    /**
     * php date format for display in actionIndex/actionView
     * @var string
     */
    public $dateFormat = 'Y-m-d H:i:s';

    /**
     * attach behaviors to current controller
     *
     * ```php
     * [
     *      'hzhihua\articles\behaviors\I18NBehavior',
     *      'hzhihua\articles\behaviors\ControllerBehavior',
     * ],
     * ```
     * or
     * ```php
     * [
     *      [
     *          'class' => 'hzhihua\articles\behaviors\ControllerBehavior',
     *          'modelMap' => [
     *              'article' => 'hzhihua\articles\models\Article',
     *              'article-category' => [
     *                  'class' => 'hzhihua\articles\models\ArticleCategory',
     *                  'property1' => 'value1',
     *                  'property2' => 'value2',
     *              ],
     *          ],
     *      ],
     * ],
     * ```
     * @var array
     */
    public $controllerBehaviors = [];

    /**
     * editor view file path
     *
     * ** You must both configure $editor and $editorDataHandle **
     * @see $editorDataHandle
     *
     * Usage:
     * | $editor | $editorDataHandle |
     * | markdown | 'hzhihua\articles\MarkdownEditor' |
     * | ckeditor | 'hzhihua\articles\Ckeditor' |
     * | custom editor | custom editor data handle class |
     *
     * You can use 'markdown' or 'ckeditor' or path alias or absolute path within application
     * - [path alias](guide:concept-aliases) (e.g. "@app/views/site/index");
     * - absolute path within application (e.g. "//site/index"): the view name starts with double slashes.
     *
     * table column name is **content**
     * ```php
     * $form->field($model, 'content')
     * ```
     *
     * default markdown https://packagist.org/packages/yiier/yii2-editor.md
     * default ckeditor https://packagist.org/packages/2amigos/yii2-ckeditor-widget
     *
     * @var string
     * @see \yii\web\View::render()
     * @see @vendor/hzhihua/yii2-articles/views/article/_markdown_editor.php
     * @default @vendor/hzhihua/yii2-articles/views/article/_markdown_editor.php
     */
    public $editor = 'markdown';

    /**
     * editor data handle class which must be implements the interface of [[\hzhihua\articles\EditorDataHandleInterface]]
     *
     * ** You must both configure $editor and $editorDataHandle **
     * @see $editor
     *
     * Usage:
     * | $editor | $editorDataHandle |
     * | markdown | 'hzhihua\articles\MarkdownEditor' |
     * | ckeditor | 'hzhihua\articles\Ckeditor' |
     * | custom editor | custom editor data handle class |
     *
     * @var string
     */
    public $editorDataHandle = 'hzhihua\articles\MarkdownEditor';

    /**
     * register asset source
     * @var string
     */
    public $asset = 'dmstr\web\AdminLteAsset';

    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        // register asset source
        ($this->asset)::register(Yii::$app->controller->getView());

        // attach behaviors for current controller
        $this->attachControllerBehaviors();

        return parent::beforeAction($action);
    }

    /**
     * attach behaviors to current controller
     * @return array
     */
    public function attachControllerBehaviors()
    {
        $behaviors = ArrayHelper::merge($this->controllerBehaviors, [
            I18NBehavior::className(),
            ControllerBehavior::className()
        ]);

        Yii::$app->controller->attachBehaviors($behaviors);
    }

}
