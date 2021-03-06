<?php
/**
 * @Author: cnzhihua
 * @Time: 18-2-18 23:40
 * @Github: https://github.com/Hzhihua
 */

namespace hzhihua\articles;

use Yii;

class MarkdownEditor implements EditorDataHandleInterface
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
            $data['Article']['preview_content'] = $data['article-content-html-code'];
        }

        return $data;
    }
}