<?php

use Yii;
use Codeception\Test\Unit;

class I18NTest extends Unit
{
    /**
     * @var \hzhihua\articles\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        Yii::$app->language = 'zh-CN';
        Yii::$app->getI18n()->translations['articles'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@vendor/hzhihua/yii2-articles/messages',
            'fileMap' => [
                'articles' => 'articles.php',
            ],
        ];
    }

    protected function _after()
    {
    }

    public function testI18nModel()
    {
        /* @var $model \hzhihua\articles\models\Article */
        $model = Yii::createObject('hzhihua\articles\models\Article');
        expect('I18N测试失败',$model->getAttributeLabel('id'))->equals('序号');
        expect('I18N测试失败',$model->getAttributeLabel('created_at'))->equals('创建时间');
    }

}