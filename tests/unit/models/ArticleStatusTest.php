<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-9 12:41
 * @Github: https://github.com/Hzhihua
 */

use Codeception\Test\Unit;
use hzhihua\articles\models\ArticleStatus;

class ArticleStatusTest extends Unit
{

    public function testGetDefaultStatus()
    {
        $data = ArticleStatus::getDefaultStatus();
        codecept_debug($data);
//        $query = ArticleStatus::find()->where(['is_default_status' => 1]);
//        codecept_debug($query->createCommand()->getRawSql());
//        codecept_debug($query->asArray()->all());
    }
}