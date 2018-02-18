<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-5 12:18
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles\behaviors;

use Yii;
use yii\base\Behavior;

class I18NBehavior extends Behavior
{
    public function init()
    {
        parent::init();

        // add i18n languages
        if (!isset(Yii::$app->getI18n()->translations['articles'])) {
            Yii::$app->getI18n()->translations['articles'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@vendor/hzhihua/yii2-articles/messages',
                'fileMap' => [
                    'articles' => 'articles.php',
                ],
            ];
        }
    }
}