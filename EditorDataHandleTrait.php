<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-20 00:01
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles;

use Yii;

trait EditorDataHandleTrait
{
    /**
     * get data which had been handle for post method
     * @return array|mixed
     */
    public function getEditorDataHandle()
    {
        if ($handle = Yii::$app->controller->module->editorDataHandle) {
            return $handle::getEditorDataHandle();
        }

        return Yii::$app->getRequest()->post();

    }
}