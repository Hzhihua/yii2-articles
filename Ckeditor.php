<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-20 00:21
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles;

use Yii;

class Ckeditor implements EditorDataHandleInterface
{
    /**
     * get data which had been handle for post method
     * @return array|mixed
     */
    public static function getEditorDataHandle()
    {
        static $data = [];

        if (empty($data)) {
            $data = Yii::$app->getRequest()->post();
            $data['Article']['preview_content'] = $data['Article']['content'];
        }

        return $data;
    }
}