<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-24 09:17
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\Connection;

class DbBehavior extends Behavior
{
    public $db = null;

    /**
     * @return mixed
     */
    public function getDb()
    {
        $moduleDb = Yii::$app->controller->module->db;
        return $moduleDb instanceof Connection ?: Yii::$app->$moduleDb;
    }
}